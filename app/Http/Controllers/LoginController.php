<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index(){
        return view('Auth.login');
    }

    public function store(Request $request){
        $this->validate($request, [
            'email'=> 'required|email',
            'password'=> 'required'
        ]);

        //esta comprobacion es para validar los datos si estan correctos en la base de datos
        if(!auth()->attempt($request->only('email','password'), $request->remember)){
            return back()->with('mensaje', 'credenciales Incorrectas');
        }
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
