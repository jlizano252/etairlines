<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EtairlinesRegistration extends Model
{
    protected $fillable = [
        'name',
        'school',
        'residence',
        'phone',
        'email',
        'interest_one',
        'interest_two',
        'coupon_code',
        'email_sent_at',
    ];

    protected $casts = [
        'email_sent_at' => 'datetime',
    ];
}
