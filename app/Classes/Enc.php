<?php

namespace App\Classes;

class Enc
{
    public function encriptar($valor)
    {
        return bin2hex( openssl_encrypt($valor, 'aes-256-cbc', 
                        'MordCAnwUHoXY9kETc4AojaAsB4DQCTr', OPENSSL_RAW_DATA, 
                        'jH8dQUpkfpdGggKw') );    
    }

    public function desencriptar($valor_encriptado)
    {
        // verificar se a hash é válida
        if (strlen($valor_encriptado) % 2 != 0) {
            return null;
        }

        return openssl_decrypt( hex2bin($valor_encriptado), 'aes-256-cbc',
                        'MordCAnwUHoXY9kETc4AojaAsB4DQCTr', OPENSSL_RAW_DATA,
                        'jH8dQUpkfpdGggKw');
    }
}