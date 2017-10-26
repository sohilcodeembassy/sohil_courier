<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;


class AdminLoginController extends Controller
{	

	public function __construct(){
		$this->middleware('guest:admin',['except' => ['logout']]);
	}

    public function showLoginForm(){
    	return view('admin.auth.admin-login');
    }
    public function login(Request $request){

    	//Validate the data
    	$this->validate($request, [
			'email' => 'required|email',
			'password' => 'required|min:6'
    	]);

    	//Attempt to log the user in
    	if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password],$request->remember)){
    		//if successful, then redirect to their intended location
    		//return redirect()->intended(route('admin.dashboard'));
            // echo '<pre>';
            // print_r(Auth::guard('admin')->user()->role);exit;
                foreach (Auth::guard('admin')->user()->role as $role) {
                    if($role->name == 'admin'){
                        return redirect('admin');
                    }elseif($role->name == 'editor'){
                        return redirect('admin/editor');
                    }
                }
    	}

    	//if unsuccessful, then redirect back to the login with form data 
    	return redirect()->back()->withInput($request->only('email','remember'));
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/');
    }

    // public function sendLoginResponse(Request $request)
    // {   
    //     $request->session()->regenerate();

    //     $this->clearLoginAttempts($request);

    //     foreach ($this->guard('admin')->role as $role) {
    //         if($role->name == 'admin'){
    //             return redirect('admin');
    //         }elseif($role->name == 'editor'){
    //             return redirect('admin/editor');
    //         }
    //     }
    // }
}
