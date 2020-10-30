<?php

namespace App\Http\Controllers;

use App\Http\Requests\FrmLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        return view('login');
    }

    // ================================================================
    public function login_submit(FrmLoginRequest $request)
    {
        // validação
        $request->validated();

        // verificar dados de login
        $email = $request->input('email');
        $password = $request->input('senha');

        $user = User::where('email', $email)->first();

        if (!$user) {
            echo 'Erro';
            return;
        }

        // verificar se a senha está correta
        if (Hash::check($password, $user->password)) {
            echo 'OK';            
        } else {
            echo 'NOK';
        }

        // criar a sessão 
    }
}
