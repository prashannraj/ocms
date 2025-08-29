<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficeSetting extends Model
{
    //
    protected $fillable = [
        'app_name',
        'app_logo',
        'app_favicon',
        'contact_email',
        'contact_phone',
        'address',
        'website',
        'footer_text',
        'timezone',
        'details',
    ];
}
