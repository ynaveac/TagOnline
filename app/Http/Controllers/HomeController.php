<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(){
        return view ('home.index');
    }

    public function index(){
        return view ('login');
    }

    public function userLogin(Request $request){
       
        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){
            toast('Usuario correctamente Logeado','success');
            $request->session()->regenerate();
            return view ('home.index');
        }

        toast('Email o Password son incorrectos','error');
        return view ('login');

    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        toast('Session Finalizada con Exito','success');
        return redirect('login');
    }

}

?>