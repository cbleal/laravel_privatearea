@extends('layouts.login_layout')

@section('conteudo')
    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-4 offset-sm-4">

                <h4>LOGIN</h4>
                <hr>

                {{-- @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>                               
                @endif --}}

                {{-- form --}}
                <form action="{{ route('login_submit') }}" method="post">
                    
                    {{-- csrf --}}
                    @csrf

                    <div class="form-group">
                        <label>Usuário:</label>
                        <input type="text" name="email" class="form-control">
                        
                        <div>
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Senha:</label>
                        <input type="password" name="senha" class="form-control">

                        <div>
                            @error('senha')
                                {{ $message }}
                            @enderror
                        </div>
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
