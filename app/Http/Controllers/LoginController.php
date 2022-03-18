<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_delete'=>0])){
            return redirect()->route('beranda');
        }

        return redirect()->back()->with('error','Email atau password salah');
    }
}
