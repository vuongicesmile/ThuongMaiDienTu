<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function loginAdmin()
    {
        if(auth()->check()) {
            return redirect()->to('home');
        }
        return view('login');
    }
    public function postloginAdmin(Request $request)
    {

//        dd($request->has('remember-me'));
        $remember = $request->has('remember-me') ? true:false;
        //attempt : dang nhap voi thong tin dang nhap
        if(auth()->attempt([
            'email' =>$request->email,
            'password' =>$request->password
        ],$remember)) {
            return redirect()->to('home');
        }
        echo "Thong tin dang nhap khong hop le";
    }
}
