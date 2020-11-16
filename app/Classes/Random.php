<?php

namespace App\Classes;

class Random 
{
    public function teste() {
        echo 'RANDOM!!!!';
    }

    public function SMSToken()
    {
        $smsToken = rand(10000, 99999);
        return $smsToken;
    }
}