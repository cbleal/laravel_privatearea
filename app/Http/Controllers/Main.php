<?php

namespace App\Http\Controllers;

use App\Http\Requests\FrmLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Main extends Controller
{   
    /**
     * CONTROLA O FLUXO DE SESSÃO
     * - Faz uma verificação através do método privado checkSession() se existe
     *   um atributo usuário na sessão. Se houver, é mostrado LOGADO, senão, o fluxo
     *   é direcionado para a rota login que chama o método login() deste controller.
     */
    public function index()
    {      
        if ($this->checkSession()) {  // verifica se existe um usuário na sessão
            echo 'LOGADO';  // se houver, mostra LOGADO
        } else {  // senão
            return redirect()->route('login');  // direciona para login
        }
    }

    /**
     * MÉTODO RETORNA A EXISTÊNCIA DO ATRIBUTO 'user' NA SESSÃO     * 
     */
    private function checkSession()
    {
        return session()->has('user');
    }

    /**
     * CHAMA O FORMULÁRIO LOGIN, MANDA JUNTO OS ERROS QUE TIVEREM SIDO GERADOS NA
     * SUAS VALIDAÇÕES.
     */
    public function login()
    {
                     
        if ($this->checkSession()) {  // se existe sessão
            return redirect()->route('index');  // é redirecionado para index
        }
       
        $erros = session('erros');  // pega os erros que estão na sessão
        $data = [];  // array que irá receber os erros
        if (!empty($erros)) {  // se os erros da sessão não estiverem vazios
            $data = [
                'erros' => $erros  // o array recebe o conteúdo de erros da sessão
            ];
        }

        return view('login', $data);  // é redirecionado para o formulário de login
    }

    /**
     * RECEBE A SUBMISSÃO DO FORMULÁRIO DE LOGIN, TRATA OS DADOS FAZENDO AS SUAS
     * VALIDAÇÕES, SE HOUVEREM ERROS, OS MESMOS SÃO COLOCADOS NA SESSÃO, SENÃO 
     * O FLUXO É REDIRECIONADO PARA INDEX JÁ COM O USUÁRIO DEVIDAMENTE COLOCADO NA SESSÃO
     */
    public function login_submit(FrmLoginRequest $request)
    {        
        # verifica se houve submissão (POST) do formulário
        if (!$request->isMethod('POST')) {
            return redirect()->route('index');
        }
                
        # verifica se já existe sessão, se existir, é mandado para index        
        if ($this->checkSession()) {
            return redirect()->route('index');
        }

        # validação feita pelo request de FrmLoginRequest
        $request->validated();

        # verificar dados de login
        $email = trim($request->input('email'));
        $password = trim($request->input('senha'));

        # pesquisa no banco pelo email digitado
        $user = User::where('email', $email)->first();

        # se não encontrou o usuário com o email digitado
        if (!$user or !Hash::check($password, $user->password)) {            
            session()->flash('erros', ['Usuário/Senha não cadastrado.']);  // coloca na sessão o erro            
            return redirect()->route('login');  // redireciona para login
        }

        # verificar se a senha está correta
        // if (!Hash::check($password, $user->password)) {  // se a senha não confere no banco
        //     session()->flash('erros', ['Senha inválida.']);  // coloca na sessão o erro
        //     return redirect()->route('login');  // redireciona para login
        // } 

        # login é válido, vamos criar a sessão
        session()->put('user', $user);  // coloca o usuário na sessão
        return redirect()->route('index');  // redireciona para login com o usuário correto
    }
}
