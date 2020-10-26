<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Main extends Controller
{
    // =================================================================
    public function index()
    {
        // verifica se o usuário está logado
        if (session()->has('user')) {
            echo 'logado';
        } else {
            return redirect()->route('login');
        }
    }

    // ================================================================
    public function login()
    {
        echo 'formulário de login';
    }
}
