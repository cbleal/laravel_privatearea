<?php

namespace App\Http\Controllers;

use App\Classes\Enc;
use App\Classes\Logger;
use App\Classes\Random;
use App\Http\Requests\FrmLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Main extends Controller
{   
    private $R;
    private $Enc;
    private $Logger;

    public function __construct() {
        $this->R = new Random();
        $this->Enc = new Enc();
        $this->Logger = new Logger();
    }

    /**
     * CONTROLA O FLUXO DE SESSÃO
     * - Faz uma verificação através do método privado checkSession() se existe
     *   um atributo usuário na sessão. Se houver, é redirecionado para a rota "home",
     *   que chama o método home() deste controller, senão, o fluxo é direcionado para 
     *   a rota login que chama o método login() deste controller.
     */
    public function index()
    {      
        if ($this->checkSession()) {  // verifica se existe um usuário na sessão
            echo 'LOGADO';  // se houver, mostra LOGADO
            return redirect()->route('home');
        } else {  // senão
            return redirect()->route('login');  // direciona para login
        }
    }

    /**
     * MÉTODO RETORNA A EXISTÊNCIA DO ATRIBUTO 'user' NA SESSÃO 
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
                        
            // log
            $this->Logger->log('error', $email . ' - Login inválido!');

            session()->flash('erros', ['Usuário/Senha não cadastrado.']);  // coloca na sessão o erro

            return redirect()->route('login');  // redireciona para login
        }
     
        # login é válido, vamos criar a sessão
        session()->put('user', $user);  // coloca o usuário na sessão

        // log
        // Log::channel('main')->info("{$user->name} efetuou login.");
        $this->Logger->log('info', 'Efetuou login.');

        return redirect()->route('index');  // redireciona para login com o usuário correto
    }

    /**
     * LIMPA O CONTEÚDO DA SESSÃO
     */
    public function logout()
    {
        // log
        // $user = session('user');
        // Log::channel('main')->info("{$user->name} efetuou logout.}");
        $this->Logger->log('info', 'Efetuou logout.');

        session()->forget('user');  // tira o atributo user da sessão

        return redirect()->route('index');  // redireciona para rota index
    }
    

    /**
     * CHAMA A VIEW HOME (VIEW PRINCIPAL DA APLICAÇÃO), MAS ANTES FAZ UM TESTE PARA SABER SE
     * A SESSÃO ESTÁ ATIVA
     */
    public function home()
    {
        if (!$this->checkSession()) {  // se a sessão retornar false (vazia)
            return redirect()->route('login');  // é redirecionado para rota login
        }

        $users = User::all();

        $data = [
            'smstoken' => $this->R->SMSToken(),
            'users' => $users,
        ];
        
        return view('home', $data);  // se passar na verificação, a view home é chamada
    }

    public function edit($id_user)
    {
        $id_user = $this->Enc->desencriptar($id_user);
        
        echo "O id do usuário é " . $id_user;
    }

    public function encript($id_usuario)
    {
        $id_usuario = $this->Enc->encriptar($id_usuario);
        echo "O id do usuário é {$id_usuario}";
    }

    public function desencipt($hash)
    {
        $hash = $this->Enc->desencriptar($hash);

        echo "Valor: " . $hash;
    }

    public function upload(Request $request)
    {
        // VALIDAÇÃO DO UPLOAD
        $validate = $request->validate(
            // RULES
            [
                'ficheiro' => 'required|image|mimes:jpeg|max:20|dimensions:min_width=100,min_height=100,max_width=1000,max_height=500',
            ],
            // MESSAGES
            [
                'ficheiro.required' => 'O campo ficheiro é obrigatório.',
                'ficheiro.image' => 'O ficheiro deve ser uma imagem.',
                'ficheiro.mimes' => 'O ficheiro deve ser no formato jpg.',
                'ficheiro.max' => 'O ficheiro não pode ser maior que 20 kb.',
                'ficheiro.dimensions' => 'Dimensões inválidas.',
            ]
        );

        // $request->ficheiro->storeAs('public/images', 'novo.png');
        // $request->ficheiro->store('public/images');
        echo "Concluído.";
    }
    
    public function list_files()
    {
        $files = Storage::files('public/pdfs');

        echo '<pre>';
        print_r($files);
    }

    public function download($file)
    {
        return response()->download("storage/pdfs/{$file}");
    }
}
