@extends('admin.layouts.app')

@section('title', 'Detalhes do usuario')

@section('content')
    <h1>Editar usuario</h1>
    <ul>
        <li>Nome: {{$user->name}}</li>
        <li>E-mail: {{$user->email}}</li>
    </ul>
    <form action="{{ route('users.destroy', $user->id) }}" method="post">
        @csrf 
        @method('delete')
        <button type="subtmit">Deletar</button>
    </form>

@endsection 