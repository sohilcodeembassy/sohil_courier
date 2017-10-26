<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
        $this->middleware('guest',['except' => ['logout','userLogout']]);
    }

    public function userLogout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }

    // public function sendLoginResponse(Request $request)
    // {   
    //     $request->session()->regenerate();

    //     $this->clearLoginAttempts($request);

    //     echo '<pre>';
    //     print_r($this->guard()->user()->role);exit;

    //     foreach ($this->guard()->user()->role as $role) {
    //         if($role->name == 'admin'){
    //             return redirect('admin');
    //         }elseif($role->name == 'editor'){
    //             return redirect('admin/editor');
    //         }
    //     }
    // }
}