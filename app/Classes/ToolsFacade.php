<?php

namespace App\Classes;

use Illuminate\Support\Facades\Facade;

class ToolsFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'Tools';
    }
}