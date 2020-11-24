<?php

namespace App\Classes;

use Illuminate\Support\Facades\Log;

class Logger
{
    public function log($level, $message)
    {
        if (session()->has('user')) {
            $message = '[' . session('user')->name . '] - ' . $message;
            Log::channel('main')->$level($message);
        } else {
            $message = '[N/A] ' . $message;
            Log::channel('main')->$level($message);
        }
        
    }
}