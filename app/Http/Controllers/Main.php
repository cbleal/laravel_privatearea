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
        $erros = session('erros');
        $data = [];
        if (!empty($erros)) {
            $data = [
                'erros' => $erros
            ];
        }
        return view('login', $data);
    }

    // ================================================================
    public function login_submit(FrmLoginRequest $request)
    {
        // validação
        $request->validated();

        // verificar dados de login
        $email = trim($request->input('email'));
        $password = trim($request->input('senha'));

        $user = User::where('email', $email)->first();

        if (!$user) {
            session()->flash('erros', ['Usuário não cadastrado']);
            return redirect()->route('login');
        }

        // verificar se a senha está correta
        if (!Hash::check($password, $user->password)) {
            echo 'NOK';            
        } 

        // criar a sessão
        echo "SESSÃO !!!";
    }
}
