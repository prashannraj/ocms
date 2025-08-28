<?php

use App\Models\EmailSender;

if (!function_exists('getEmailSender')) {
    function getEmailSender($id)
    {
        return EmailSender::findOrFail($id);
    }
}
