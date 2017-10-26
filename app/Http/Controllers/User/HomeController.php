<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Country;
use App\Company_address;
use App\Communication_user_email;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }
    
    public function about()
    {
        return view('about');
    }

    public function services()
    {
        return view('services');
    }

    public function contact()
    {
        return view('contact');
    }

     public function blog()
    {
        return view('blog');
    }
    
    public function showRegistrationForm()
    {
        $country = Country::orderBy('country','ASC')->get();
        return view('auth.register',['country' => $country]);
    }
    
    public function RegisterUser(Request $request){

        // echo '<pre>';
        // print_r($request->user_suburb_id);
        // exit;
          
        $this->validate($request, [
            'user_firstname' => 'required|string|max:255',
            'user_lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'user_phone' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'user_phone' => 'required',
            'user_address1' => 'required',
            'user_city' => 'required',
            'user_state' => 'required',
            'user_postcode' => 'required',
            'user_country' => 'required',
            'user_website' => 'required',
            'user_account_type' => 'required',
            'user_how_found' => 'required',
            'company_name' => 'required',
            'company_address1' => 'required',
            'company_address2' => 'required',
            'company_city' => 'required',
            'company_state' => 'required',
            'company_postcode' => 'required',
            'company_country' => 'required',
        ]);

        $communication_email_array = $request->user_c_email;

        // echo '<pre>';
        // print_r($communication_email_array);exit;

        $user = new User();
        $user->first_name = $request->user_firstname;
        $user->last_name = $request->user_lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->user_phone;
        $user->address1 = $request->user_address1;
        $user->address2 = $request->user_address2;
        $user->country = $request->user_country;
        $user->state = $request->user_state;
        $user->city = $request->user_city;
        $user->suburb_id = $request->user_suburb_id;
        $user->postal_code = $request->user_postcode;
        $user->website = $request->user_website;
        $user->account_type = $request->user_account_type;
        $user->user_found = $request->user_how_found;

        if($user->save()){
            $user_id = $user->id;

            if(!empty($communication_email_array)){
                foreach ($communication_email_array as $key => $value) {
                    $communication_user_email = new Communication_user_email();
                    $communication_user_email->user_id = $user_id;
                    $communication_user_email->email = $value;
                    $communication_user_email->save();
                }
            }

            $company_address = new Company_address();
            $company_address->user_id = $user_id;
            $company_address->company_name = $request->company_name;
            $company_address->address1 = $request->company_address1;
            $company_address->address2 = $request->company_address2;
            $company_address->country = $request->company_country;
            $company_address->state = $request->company_state;
            $company_address->city = $request->company_city;
            $company_address->postal_code = $request->company_postcode;

            if($company_address->save()){
                echo 'sucess';
                if(Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password])){
                    return redirect()->route('home');
                }
            }else{
                echo 'c error';
            }
            
        }else{
            echo 'u error';
        }
          
    }
   
}
