@extends('admin.layouts.app')

@section('title', 'Cadastro de usuários')

@section('content')
    <h1>Novo usuário</h1>

    {{--@include('admin.includes.erros')--}}

    <form action="{{route('users.store')}}" method="POST">
        @include('admin.users.partials.form')
    </form>
@endsection 