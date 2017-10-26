<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Country;
use App\Company_address;
use App\Communication_user_email;
use App\Timezone;
use App\PricingPortalApi;
use App\Api;

use Mail;
use Auth;
use Hash;
use Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('admin');
    }

    public function user(){
    	$country = Country::orderBy('country','ASC')->get();
    	$users = User::orderBy('created_at', 'desc')->get();

    	// foreach ($users as $key => $value) {
    	// 	echo '<pre>';
    	// 	echo $value->first_name;
    	// 	print_r($value->company_address->company_name);
    	// }
    	// exit;

    	return view('admin.User.user',['users' => $users,'country' => $country]);
    }

    public function postUser(Request $request){
          
        $this->validate($request, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'suburb_id' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'user_type' => 'required',
            'country' => 'required',
            'website' => 'required',
            'how_found' => 'required',
            'account_type' => 'required',
            'sender_type' => 'required',
            'receiver_type' => 'required',
            'company_name' => 'required',
            'company_suburb_id' => 'required',
            'company_country' => 'required',
            'company_address1' => 'required',
            'company_address2' => 'required',
            'company_city' => 'required',
            'company_state' => 'required',
            'company_postcode' => 'required',
        ]);

        $communication_email_array = $request->c_email;

        $password = $this->random_password(8);
    	$account_no  = '0'.$this->random_password_length_10(9);

        // echo '<pre>';
        // print_r($communication_email_array);exit;

        $user = new User();
        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($password);
        $user->phone = $request->phone;
        $user->address1 = $request->address1;
        $user->address2 = $request->address2;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->suburb_id = $request->suburb_id;
        $user->postal_code = $request->postcode;
        $user->website = $request->website;
        $user->account_type = $request->account_type;
        $user->user_found = $request->how_found;
        $user->account_number = $account_no;
        $user->user_type = $request->user_type;
        $user->sender_type = $request->sender_type;
        $user->receiver_type = $request->receiver_type;
        $user->set_default = $request->set_default;
        $user->status = '1';

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
            $company_address->suburb_id = $request->company_suburb_id;
            $company_address->state = $request->company_state;
            $company_address->city = $request->company_city;
            $company_address->postal_code = $request->company_postcode;

            if($company_address->save()){
                $data = [
	                'email' => $request->email,
	                'password' => $password,
	            ];

	            $from = 'admin@austranslogistics.com.au';
	            $emails = ['sohils413@gmail.com', 'am_it@live.com'];
	            Mail::send('admin.EmailTemplate.welcome', ['data' => $data], function ($message) use($emails, $from)
	            {
	                $message->from($from, 'Welcome Notification');
	                $message->to($emails)->subject('Welcome Notification');
	            });
	            //echo "success";
	            return redirect()->route('admin.user')->with('success', 'User Add successfully!');
                
            }else{
                //echo 'c error';
                return redirect()->route('admin.user')->with('error', 'Some problem for Add User');
            }
            
        }else{
            //echo 'u error';
            return redirect()->route('admin.user')->with('error', 'Some problem for Add User');
        }
    }

    public function editUser($id){
    	$country = Country::orderBy('country','ASC')->get();
    	$user = User::where('id', '=', $id)->first();
    	return view('admin.User.editUser',['user' => $user,'country' => $country]);
    }


    public function postEditUser(Request $request){
    	$this->validate($request, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required',
            'phone' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'suburb_id' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'user_type' => 'required',
            'country' => 'required',
            'website' => 'required',
            'how_found' => 'required',
            'account_type' => 'required',
            'sender_type' => 'required',
            'receiver_type' => 'required',
            'company_name' => 'required',
            'company_suburb_id' => 'required',
            'company_country' => 'required',
            'company_address1' => 'required',
            'company_address2' => 'required',
            'company_city' => 'required',
            'company_state' => 'required',
            'company_postcode' => 'required',
        ]);

        $communication_email_array = $request->c_email;
        $user_id = $request->id;

        $user = User::where('id','=',$user_id)->first();
        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address1 = $request->address1;
        $user->address2 = $request->address2;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->suburb_id = $request->suburb_id;
        $user->postal_code = $request->postcode;
        $user->website = $request->website;
        $user->account_type = $request->account_type;
        $user->user_found = $request->how_found;
        $user->user_type = $request->user_type;
        $user->sender_type = $request->sender_type;
        $user->receiver_type = $request->receiver_type;
        $user->set_default = $request->set_default;

        if($user->save()){

        	$communication_user_email_array = Communication_user_email::where('user_id','=',$user_id)->pluck('email')->toArray();
        	$communication_user_email = Communication_user_email::where('user_id','=',$user_id)->get();
        	if(count($communication_email_array) == count($communication_user_email)){
        		if(!empty($communication_email_array)){
	                foreach ($communication_email_array as $key => $value) {
	                    $communication_user_email[$key]->email = $value;
	                    $communication_user_email[$key]->save();
	                }
	            }
        	}else{
        		// echo 'differance';
        		// echo '<pre>';
        		// print_r($communication_user_email_array);
        		// print_r($communication_email_array);
        		//exit;
        		if(!empty($communication_email_array)){
        			foreach ($communication_email_array as $key => $value) {
        				if(in_array($value, $communication_user_email_array)){
        					$communication_user_email[$key]->email = $value;
	                    	$communication_user_email[$key]->save();
        				}else{
        					$communication_user_email = new Communication_user_email();
        					$communication_user_email->user_id = $user_id;
        					$communication_user_email->email = $value;
	                    	$communication_user_email->save();
        				}
        			}
        		}
        	}
        	
            $company_address = Company_address::where('user_id','=',$user_id)->first();
            $company_address->company_name = $request->company_name;
            $company_address->address1 = $request->company_address1;
            $company_address->address2 = $request->company_address2;
            $company_address->country = $request->company_country;
            $company_address->suburb_id = $request->company_suburb_id;
            $company_address->state = $request->company_state;
            $company_address->city = $request->company_city;
            $company_address->postal_code = $request->company_postcode;

            if($company_address->save()){
               
	            //echo "c success";
	            return redirect()->route('admin.user')->with('success', 'User Add successfully!');
                
            }else{
                //echo 'c error';
                return redirect()->route('admin.user')->with('error', 'Some problem for Add User');
            }
            
        }else{
            //echo 'u error';
            return redirect()->route('admin.user')->with('error', 'Some problem for Add User');
        }

    }


    public function memberPortal($id){
    	$user = User::where('id', '=', $id)->first();
    	$timezone = Timezone::orderBy('country_name','ASC')->get();
    	return view('admin.User.memberPortal', ['user' => $user, 'timezone' => $timezone]);
    }

    public function postMemberPortal(Request $request){    	
    	$this->validate($request, [
            'timezone' => 'required',
        ]);

    	$user_id = $request->user_id;
    	$password = $request->password;
    	$user = User::where('id', '=', $user_id)->first();
    	if(isset($password)){
    		$user->password = bcrypt($password);
    	}
    	$user->timezone = $request->timezone;

    	if($user->save()){
    		$data = [
	            'email' => $user->email,
	            'password' => $password,
	        ];

	        $from = 'admin@austranslogistics.com.au';
	        $emails = ['sohils413@gmail.com', 'am_it@live.com'];
	        Mail::send('admin.EmailTemplate.welcome', ['data' => $data], function ($message) use($emails, $from)
	        {
	            $message->from($from, 'Member Portal Notification');
	            $message->to($emails)->subject('Member Portal Notification');
	        });
    		return redirect()->route('admin.user')->with('success', 'User member portal access successfully!');
    	}else{
    		return redirect()->route('admin.user')->with('error', 'Some problem for member portal access');
    	}

    }


    public function pricingPortal($id){
    	$user = User::where('id', '=', $id)->first();
    	$user_id = $user->id;
    	$domestic_pricingPortalApi = PricingPortalApi::where('api_type','=','domestic')->where('user_id', '=', $user_id)->get();
    	$international_pricingPortalApi = PricingPortalApi::where('api_type','=','international')->where('user_id', '=', $user_id)->get();

    	$domestic_pp_active_api = PricingPortalApi::where('api_type','=','domestic')->where('status', '1')->get();
    	$international_pp_active_api = PricingPortalApi::where('api_type','=','international')->where('status', '1')->get();

    	$domestic_api = Api::where('type','=','domestic')->where('status','=','1')->orderBy('created_at', 'desc')->get();
    	$international_api = Api::where('type','=','international')->where('status','=','1')->orderBy('created_at', 'desc')->get();

    	return view('admin.User.pricingPortal', ['user' => $user, 'domestic_pricingPortalApi' => $domestic_pricingPortalApi, 'international_pricingPortalApi' => $international_pricingPortalApi, 'domestic_pp_active_api' =>$domestic_pp_active_api, 'international_pp_active_api' =>$international_pp_active_api,'domestic_api' => $domestic_api, 'international_api' => $international_api]);
    }


    public function postPricingPortal(Request $request){
    	$this->validate($request, [
            'api_name' => 'required',
            'price_modifier' => 'required',
        ]);

    	$user_id = $request->user_id; 
    	$api_id = $request->api_name;
    	$api_type = $request->api_type;
    	
    	$PricingPortalApi = PricingPortalApi::where('api_id','=',$api_id)->where('api_type','=',$api_type)->first();
    	if(empty($PricingPortalApi)){
    		$PricingPortalApi = new PricingPortalApi();
    	}

    	$PricingPortalApi->user_id = $user_id;
    	$PricingPortalApi->api_id = $api_id;
    	$PricingPortalApi->api_type = $api_type;
    	$PricingPortalApi->price_modifier = $request->price_modifier;
    	$PricingPortalApi->status = $request->status;

    	if($PricingPortalApi->save()){
    		return redirect()->route('admin.user.pricing.portal',['id' => $user_id])->with('success', 'Pricing Portal '.$api_type.' API add successfully!');
    	}else{
    		return redirect()->route('admin.user.pricing.portal',['id' => $user_id])->with('error', 'Some problem for add Pricing Portal'.$api_type.' Pricing Portal API');
    	}

    }



    public function random_password($length = 8) {
	    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
	    $password = substr(str_shuffle($chars), 0, $length);
	    return $password;
	}
	public function random_password_length_10($length) {
	    $chars = "0123456789";
	    $password = substr(str_shuffle($chars), 0, $length);
	    return $password;
	}

}
