<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IsoCountry extends Model
{
    //
    //
    protected $fillable = ['id','title','iso_code', 'long_name', 'num_code', 'alpa_2_code', 'calling_code', 'order'];
    const CREATED_AT = 'created';
	const UPDATED_AT = 'updated';
}
