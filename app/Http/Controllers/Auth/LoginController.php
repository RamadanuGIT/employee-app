<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index(){
        return view('auth.login');
    }

    public function processLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'Email Wajib Diisi',
            'password.required' => 'Passwprd Wajib Diisi'
        ]);

        $credential = $request->only('email','password');

        if (Auth::guard('user')->attempt($credential)) {
            $user = Auth::guard('user')->user();
            if ($user) {
                return redirect()->route('admin.dashboard')->with('success','Login Berhasil');
            }
        }else{
            return redirect()->back()->with('error','Email atau Password kamu salah!');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
