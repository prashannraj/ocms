<?php

namespace App\Http\Controllers\Admin;

use App\Mail\EnquiryVerifyMail;
use App\Models\User;
use App\Models\OfficeSetting;
use App\Models\EmailSender;
use App\Models\EnquiryForm;
use App\Models\IsoCountry;
use App\Models\RawInquiry;
use App\Notifications\NewEnquiryAlert;
use App\Rules\GoogleRecaptcha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use OCILob;

class EnquiryFormController extends Controller
{
    public function index()
    {
        $forms = EnquiryForm::paginate(20);
        return view('enquiryform.index', compact('forms'));
    }

    public function create()
    {
        return view('enquiryform.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'name' => 'required',
            'description' => 'nullable',
            'status' => 'required',
            'type' => 'required'
        ]);

        do {
            $uuid = Str::random(5);
        } while (EnquiryForm::where('uuid', $uuid)->exists());

        $data['uuid'] = $uuid;
        EnquiryForm::create($data);

        return redirect()->route('enquiryform.index')->with('success', 'Enquiry form created successfully.');
    }

    public function show($id)
    {
        $form = EnquiryForm::findOrFail($id);
        $countries = IsoCountry::orderBy('order', 'desc')->get();
        $officeSettings = OfficeSetting::first();

        return view('enquiryform.show', compact('form', 'countries', 'officeSettings'));
    }

    public function display($uuid)
    {
        $form = EnquiryForm::where('uuid', $uuid)->firstOrFail();
        $form->increment('hits');
        $countries = IsoCountry::orderBy('order', 'desc')->get();
        $officeSettings = OfficeSetting::first();

        return view('enquiryform.show', compact('form', 'countries', 'officeSettings'));
    }

    public function edit($id)
    {
        $form = EnquiryForm::findOrFail($id);
        return view('enquiryform.edit', compact('form'));
    }

    public function update(Request $request, $id)
    {
        $enq = EnquiryForm::findOrFail($id);
        $data = $request->validate([
            'title' => 'required',
            'name' => 'required',
            'description' => 'nullable',
            'status' => 'required',
            'type' => 'required'
        ]);
        $enq->update($data);

        return redirect()->route('enquiryform.index')->with('success', 'Enquiry form updated successfully.');
    }

    public function destroy($id)
    {
        EnquiryForm::findOrFail($id)->delete();
        return redirect()->route('enquiryform.index')->with('success', 'Enquiry form deleted.');
    }

    public function fillup(Request $request, $uuid)
    {
        $form = EnquiryForm::where('uuid', $uuid)->firstOrFail();
        $request->validate([
            'g-recaptcha-response' => ['required', new GoogleRecaptcha],
            'email' => 'required|email',
        ]);

        if (method_exists($this, $form->type)) {
            return $this->{$form->type}($request, $form);
        }

        abort(404);
    }

    public function general(Request $request, EnquiryForm $form)
    {
        $data = $request->only('email', 'contact_number', 'country_code', 'enquiry');
        $data['form_id'] = $form->id;
        $data['unique_code'] = Str::random(8);
        $inq = RawInquiry::create($data);
        $inq->update(['extra_details' => json_encode(['ip' => $request->ip()])]);

        Mail::send(new EnquiryVerifyMail(['row' => $inq, 'officeSettings' => OfficeSetting::first()]));

        $users = EmailSender::whereIn('id', [4, 5])->get();
        Notification::send($users, new NewEnquiryAlert($inq));

        return view('enquiryform.success', compact('inq'));
    }

    public function immigration(Request $request, EnquiryForm $form)
    {
        $data = $request->all();
        $data['form_id'] = $form->id;
        $data['unique_code'] = Str::random(8);

        foreach (['refusal_document', 'appellant_passport', 'proff_address'] as $field) {
            if ($request->hasFile($field)) {
                $filename = time() . '-' . $request->$field->getClientOriginalName();
                $data[$field] = Storage::disk('uploads')->putFileAs($field, $request->$field, $filename);
            }
        }

        $inq = RawInquiry::create($data);
        $inq->update(['extra_details' => json_encode(['ip' => $request->ip()])]);

        Mail::send(new EnquiryVerifyMail(['row' => $inq, 'officeSettings' => OfficeSetting::first()]));

        $users = EmailSender::whereIn('id', [4, 5])->get();
        Notification::send($users, new NewEnquiryAlert($inq));

        return view('enquiryform.success', compact('inq'));
    }
}
