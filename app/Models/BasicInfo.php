<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class BasicInfo extends Model
{
    //
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $table = 'basic_infos';

    protected $appends = ['age', 'date_of_birth', 'delete_at_formatted', 'full_name', 'full_name_with_title', 'address', 'address_html', 'mobile_number', 'email_address', 'next_of_kin', 'visa_followup_date'];

    protected $dates = ["dob", 'delete_at'];

    use SoftDeletes; //add this line


    public function getDobAttribute($value)
    {
        if ($value == null) return $value;
        $value = Carbon::parse($value);
        return $value->format(config('constant.date_format'));
    }

    public function setDobAttribute($value)
    {
        if ($value == null) {
            $this->attributes['dob'] = null;
        } else {

            $this->attributes['dob'] = Carbon::createFromFormat(config('constant.date_format'), $value)->format('Y-m-d');
        }
    }

    public function getAgeAttribute()
    {
        if (!$this->dob) {
            return '';
        }

        return Carbon::createFromFormat(config('constant.date_format'), $this->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');

    }

    public function getDateOfBirthAttribute()
    {
        if (!$this->dob) {
            return '';
        }
        $birthDate = date('d F Y', strtotime($this->attributes['dob']));
        return $birthDate;
    }

    public function dob_format($format)
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['dob'])->format($format);
    }

    public function getAddressAttribute()
    {
        $d = $this->studentAddressDetails()->latest()->first();
        if ($d == null) {
            return "";
        } else {
            return $d->overseas_address . ", " . $d->overseas_postcode . ", " . $d->country_name;
        }
    }


    public function getAddressHtmlAttribute()
    {
        $d = $this->studentAddressDetails()->latest()->first();
        if ($d == null) {
            return "";
        } else {
            return $d->overseas_address . "<br>" . $d->overseas_postcode . "<br>" . $d->country_name;
        }
    }

    public function getFullNameAttribute()
    {
        return $this->f_name . ' ' . $this->m_name . ' '  . $this->l_name;
    }

    public function getFullNameWithTitleAttribute()
    {
        return $this->title . '. ' .  $this->f_name . ' ' . $this->m_name . ' '  . $this->l_name;
    }

    public function getAllApplicationsAttributes()
    {
        $collections = collect();
        foreach ($this->immigrationApplications as $immig) {
            $collections->push($immig);
        }
        foreach ($this->admissionApplications as $adm) {
            $collections->push($adm);
        }

        return $collections;
    }



    public function studentAddressDetails()
    {
        return $this->hasMany(ClientAddressDetail::class, 'basic_info_id', 'id');
    }

    public function addresses()
    {
        return $this->hasMany(ClientAddressDetail::class, 'basic_info_id', 'id');
    }

 


    public  function getMobileNumberAttribute()
    {
        $d = $this->studentContactDetails()->latest()->first();
        if ($d == null) {
            return "";
        } else {
            return $d->contact_mobile;
        }
    }

    public function getEmailAddressAttribute()
    {
        $d = $this->studentContactDetails()->latest()->first();
        if ($d == null) {
            return "";
        } else {
            return $d->primary_email;
        }
    }

    public function getNationalityAttribute()
    {
        return ($this->passport()->latest()->first()) ? $this->passport()->latest()->first()->country->title : '';
    }


    

    


    public function getVisaFollowupDateAttribute()
    {
        $d = $this->currentvisa()->latest()->whereStatus("Active")->first();
        if ($d == null) return '-';
        $followupdate = $d->expiry_date_raw->subMonths(5)->format(config('constant.date_format'));
        return $followupdate;
    }


    public function getDeleteAtFormattedAttribute()
    {
        if ($this->delete_at) {
            return $this->delete_at->format(config('constant.date_format'));
        }

        return "-";
    }


    public function forceDelete()
    {

        foreach ($this->communicationlogs as $log) {
            $log->delete();
        }

        foreach ($this->documents as $document) {
            $document->delete();
        }

        foreach ($this->invoices as $invoice) {
            $invoice->delete();
        }

        foreach ($this->receipts as $receipt) {
            $receipt->delete();
        }

        foreach ($this->studentContactDetails as $std) {
            $std->delete();
        }


        return parent::forceDelete();
    }
}
