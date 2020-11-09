<?php

namespace App\Classes;

class Tools 
{
    public function printData($data)
    {
        if (is_array($data) || is_object($data)) {
            echo '<pre>';
            print_r($data);
        } else {
            echo $data;
        }
        
    }

    public function teste()
    {
        echo 'HELLO HELLO';
    }
}