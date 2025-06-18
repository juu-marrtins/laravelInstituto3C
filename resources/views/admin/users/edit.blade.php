@extends('admin.layouts.app')

@section('title', 'Editar usuário')

@section('content')
    <h1>Editar usuário: {{$user->name}}</h1>

    {{--@include('admin.includes.erros')--}}
    
    <form action="{{route('users.update', $user->id)}}" method="POST">
        @method('put')
        @include('admin.users.partials.form')
    </form>

@endsection 