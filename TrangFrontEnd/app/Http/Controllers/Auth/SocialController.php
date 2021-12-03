<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    //
    public  function redirectGoogle() {
        return Socialite::driver('google')->redirect();
    }
    public function processGoogleLogin(){
        $googleUser = Socialite::driver('google')->user();
        //dd($googleUser);
        //b2: lưu thông tin googleId
        if(!$googleUser) {
            // không cho phép đăng nhập
            echo('dang nhap khong thanh cong');
            //return response()->redirect(route('login.checkout'));
        }
        $systemUser = Customer::firstOrNew(
            ['google_id'=>$googleUser->id],
            [
                'name'=>$googleUser->name,
                'email'=>$googleUser->email,
            ]
        );

        // cho phep dang nhap
        Auth::loginUsingId($systemUser->id);
        return redirect('/');
    }
}
