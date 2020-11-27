@extends('layouts.home_layout')

@php
    $enc = new App\Classes\Enc();
@endphp

@section('conteudo')
    <div>
        {{-- <h3>conteúdo da aplicação</h3>
        <p>SMS TOKEN: <strong>{{ $smstoken }}</strong></p> --}}
        <h3>LISTA DE USUÁRIOS</h3>
        <hr>
        
        <ul>
            @foreach ($users as $user)
                <li><a href="{{ route('main_edit', ['id' => $enc->encriptar($user->id)]) }}">Editar</a>
                     - {{ $user->name }}</li>
            @endforeach
        </ul>
    </div>
    <div>
        {{-- <img src="{{ asset('storage/images/lion.jpg') }}"> --}}
        <h3>Upload de Arquivos</h3>
        <form action="{{ route('main_upload') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="ficheiro">
            <input type="submit" value="Enviar">
        </form>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
