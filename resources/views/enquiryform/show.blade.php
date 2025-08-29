<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $form->title }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/css/argon.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css" integrity="sha512-TQQ3J4WkE/rwojNFo6OJdyu6G8Xe9z8rMrlF9y7xpFbQfW5g8aSWcygCQ4vqRiJqFsDsE1T6MoAOMJkFXlrI9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #additional_contact_info {
            display: none;
        }
    </style>
</head>

<body class='bg-white'>

    <div class="container">
        <header style='border-bottom:2px solid red'>
            <div class="row justify-content-between">
                <div class="col-md-4">
                    <img src="{{ $officeSettings->app_logo }}" alt="">
                </div>
                <div class="col-md-4">
                    <table>
                        <tbody>
                            <tr><td colspan="2"><b>{{ $officeSettings->app_name }}</b></td></tr>
                            <tr><td colspan="2">{{ $officeSettings->app_name }}</td></tr>
                            <tr><td colspan="2">T: {{ $officeSettings->contact_phone }}</td></tr>
                            <tr><td colspan="2">E: {{ $officeSettings->contact_email }}</td></tr>
                            <tr><td colspan="2">W: {{ $officeSettings->contact_email }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </header>

        <main class='mt-4'>
            <h1 class='display-4 text-center text-underlined'><u>{{ $form->title }}</u></h1>
            <form action="{{ $form->form_url }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="form_id" value="{{ $form->id }}">

                @includeIf('enquiryform.forms.' . $form->type, ['row' => null])

                <div class="g-recaptcha" data-sitekey="6LeKX5gqAAAAAPwgUlPo9fSCFR9Ljq2sRv6-jo2q"></div>
                {!! isError($errors, 'g-recaptcha-response', "Please solve the captcha and try again.") !!}

                <div class="form-group container">
                    <input class="form-check-input" type="checkbox" id="allow" name="allow" value="1" />
                    <label for="allow">
                        I consent {{ $officeSettings->app_name }} to contact me regarding my enquiry and add my details to their mailing list.
                        I consent {{ $officeSettings->app_name }} to record my Internet Protocol (IP) address upon submission of this enquiry form.
                        I consent {{ $officeSettings->app_name }} to hold my personal information and IP address on their web server in the UK or in the EEA in compliance with Data Protection Act 2018 (GDPR).
                    </label>
                </div>

                {!! isError($errors, 'allow', "Please tick the consent box above to comply with Data Protection Act 2018 (GDPR).") !!}

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary" style="width: 150px;">Send</button>
                </div>
            </form>
        </main>

        <br><br>
        <table style="border:1px">
            <tbody>
                <tr>
                    <td width="100%">
                        {{ $officeSettings->app_name }}. Registered in {{ $officeSettings->registered_in }},
                        Company Registration No. <b>{{ $officeSettings->registration_no }}</b>,
                        Regulated by {{ $officeSettings->regulated_by }},
                        Authorisation No. <b>{{ $officeSettings->regulation_no }}</b>.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Scripts --}}
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('#date_of_decision').datepicker({ format: "dd/mm/yyyy" });

        $(document).ready(function () {
            $('#contact_person_address').hide();

            $('#contact_person_address_option').on('change', function () {
                if ($(this).val() === 'yes') {
                    $('#contact_person_address').show();
                    $('#additional_contact_info').show();
                } else {
                    $('#contact_person_address').hide();
                    $('#additional_contact_info').hide();
                }
            });
        });
    </script>

</body>

</html>
