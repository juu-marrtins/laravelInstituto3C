<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class UserController extends Controller
{
    public function index(){    
        $users = User::paginate(10); //User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create(){
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request){
        User::create($request->validated());

        return redirect()
        ->route('users.index')
        ->with('success', 'Usuario cadastrado com sucesso.');
    }

    public function edit(string $id){
        //$user = User::where('id', '=', $id)->firs(); nao precisa passar o igual

        //$user = User::where('id', $id)->firs();  //firstOrFail();
        if (!$user = User::find($id)){
            return redirect()
            ->route('users.index')
            ->with('message', 'Usuário não cadastrado');
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, string $id){ //para editar sem senha 
        if (!$user = User::find($id)){
            return back()
            ->with('message', 'Usuário não cadastrado');
        }
        $data = $request->only('name', 'email');
        if($request->password){
            $data['password'] = bcrypt($request->password); //atualiza a senha
        }
        $user->update($data);

        return redirect()
        ->route('users.index')
        ->with('success', 'Usuario atualizado com sucesso.');
    }

    public function show(string $id){
        if (!$user = User::find($id)){
            return redirect()
            ->route('users.index')
            ->with('message', 'Usuário não cadastrado');
        }

        return view('admin.users.show', compact('user'));
    }

    public function destroy(string $id){
        if (!$user = User::find($id)){
            return redirect()
            ->route('users.index')
            ->with('message', 'Usuário não cadastrado');
        }
        //nao permite que o proprio usuario se delete
        /*if(FacadesAuth::user()->id === $user->id){
            return redirect()
            ->route('users.index')
            ->with('success', 'Voce nao pode deletar seu proprio usuario.');
        };*/

        $user->delete(); //delete tudo, ou passa array especificando
        return redirect()
        ->route('users.index')
        ->with('success', 'Usuario deletado com sucesso.');
    }
}