<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    function logout()
    {
        Auth::logout();
        return redirect(' ');
    }
    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email harus diisi',
            'password.required' => 'Password harus diisi',
        ]);

        $infoLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infoLogin)) {
            if (Auth::user()->role_id == 1) {
                return redirect('superadmin');
            } elseif (Auth::user()->role_id == 2) {
                return redirect('ketua');
            }elseif(Auth::user()->role_id == 3){
                return redirect('bendahara1');
            }elseif(Auth::user()->role_id == 4){
                return redirect('bendahara2');
            }else{
                return redirect('pengunjung');
            }
        } else {
            return redirect('')->withErrors('username dan password salah')->withInput();
        }
    }
}
