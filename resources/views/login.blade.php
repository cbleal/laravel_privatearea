@extends('layouts.login_layout')

@section('conteudo')
    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-4 offset-sm-4">

                <h4>LOGIN</h4>
                <hr>

                {{-- form --}}
                <form action="{{ route('login_submit') }}" method="post">
                    
                    {{-- csrf --}}
                    @csrf

                    <div class="form-group">
                        <label>Usuário:</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Senha:</label>
                        <input type="password" name="senha" class="form-control">
                    </div>

                    <div class="form-group">                        
                        <input type="submit" value="Entrar" class="btn btn-success">
                    </div>

                </form>
                {{-- /form --}}

            </div>
        </div>
    </div>
@endsection
