<?php

namespace App\Helpers;

class FormatService
{
    public static function formatPhoneNumber($phone_number): array|string
    {
        $phone = substr(preg_replace('/[^0-9]/', '', str_replace([' ', '-'], '', trim($phone_number))), -8);
        return substr_replace($phone, '-', 4, 0);
    }
}
