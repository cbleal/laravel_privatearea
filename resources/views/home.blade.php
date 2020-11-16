@extends('layouts.home_layout')

@section('conteudo')
    <div>
        <h3>conteúdo da aplicação</h3>
        <p>SMS TOKEN: <strong>{{ $smstoken }}</strong></p>
    </div>    
@endsection
