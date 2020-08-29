<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function check()
    {

    $referer = request()->server('HTTP_REFERER');

    $credentials = [
            'username' => request()->get('username'),
            'password' => request()->get('password'),
        ];

        $remember = request()->get('remember') === 'on';

        if(!Auth::attempt($credentials, $remember)){
            return redirect($referer)->withErrors(['username' => 'Username or password incorrect']);
        }

        return redirect()->to($referer);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->to(request()->server('HTTP_REFERER'));
    }
}
