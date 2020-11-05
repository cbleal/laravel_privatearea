@extends('layouts.login_layout')

@section('conteudo')
    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-4 offset-sm-4">

                <h4>LOGIN</h4>
                <hr>

                {{-- erros de validação --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>     
                    </div>                          
                @endif
                
                {{-- erros de login --}}
                @if (isset($erros))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($erros as $erro)
                                <li>{{ $erro }}</li>                        
                            @endforeach
                        </ul>
                    </div>                              
                @endif

                {{-- form --}}
                <form action="{{ route('login_submit') }}" method="post">
                    
                    {{-- csrf --}}
                    @csrf

                    <div class="form-group">
                        <label>E-mail:</label>
                        <input type="text" name="email" class="form-control" placeholder="Digite seu e-mail">
                        
                        {{-- <div>
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div> --}}
                        {{-- @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror --}}
                    </div>

                    <div class="form-group">
                        <label>Senha:</label>
                        <input type="password" name="senha" class="form-control" placeholder="Digite sua senha">

                        {{-- <div>
                            @error('senha')
                                {{ $message }}
                            @enderror
                        </div> --}}
                        {{-- @error('senha')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror --}}
                    </div>

                    <div class="form-group">                        
                        <input type="submit" value="Entrar" class="btn btn-primary">
                    </div>

                </form>
                {{-- /form --}}

            </div>
        </div>
    </div>
@endsection
