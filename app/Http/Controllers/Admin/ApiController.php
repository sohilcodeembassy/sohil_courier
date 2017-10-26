<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Api;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('admin');
    }

    public function api(){
    	$domestic_api = Api::where('type','=','domestic')->orderBy('created_at', 'desc')->get();
    	$domestic_active_api = Api::where('type','=','domestic')->where('status', '1')->get();

    	$international_api = Api::where('type','=','international')->orderBy('created_at', 'desc')->get();
    	$international_active_api = Api::where('type','=','international')->where('status', '1')->get();

    	return view('admin.api.api',['domestic_api' => $domestic_api, 'domestic_active_api' => $domestic_active_api ,'international_api' => $international_api, 'international_active_api' => $international_active_api]);
    }

    public function postApi(Request $request){
    	$this->validate($request, [
    		'api_name' => 'required|string|max:30',
    		'slug_name' => 'required|string|max:30',
            'status' => 'required|numeric',
            'access_quote_live_url' => 'required',
            'access_booking_live_url' => 'required',
            'access_label_live_url' => 'required',
            'access_live_usernm' => 'required',
            'access_live_password' => 'required',
            'access_quote_test_url' => 'required',
            'access_booking_test_url' => 'required',
            'access_label_test_url' => 'required',
            'access_test_usernm' => 'required',
            'access_test_password' => 'required',
    	]);
    	$slug_name = strtolower($request->slug_name);
    	$api_type = $request->api_type;



    	$api = Api::where('slug','=',$slug_name)->where('type','=',$api_type)->first();
    	if(empty($api)){
    		$api = new Api();
    	}

    	$api->name = $request->api_name;
    	$api->slug = strtolower($request->slug_name);
    	$api->type = $api_type;
    	$api->status = $request->status;
        $api->access_quote_live_url = $request->access_quote_live_url;
        $api->access_booking_live_url = $request->access_booking_live_url;
        $api->access_label_live_url = $request->access_label_live_url;
        $api->access_live_usernm = $request->access_live_usernm;
        $api->access_live_password = $request->access_live_password;
        $api->access_quote_test_url = $request->access_quote_test_url;
        $api->access_booking_test_url = $request->access_booking_test_url;
        $api->access_label_test_url = $request->access_label_test_url;
        $api->access_test_usernm = $request->access_test_usernm;
        $api->access_test_password = $request->access_test_password;
        if(isset($request->mode)){
            $api->mode = $request->mode;
        }else{
            $api->mode = 'test';
        }

    	if($api->save()){
            return redirect()->route('admin.api')->with('success', ''.$api_type.' API add successfully!');
        }else{
            return redirect()->route('admin.api')->with('error', 'Some problem for add '.$api_type.' API');
        }
    }

    public function editApi($id){
    	$api = Api::where('id','=',$id)->first();
    	return view('admin.api.editapi',['api' => $api]);
    }

    public function postEditApi(Request $request){
    	$this->validate($request, [
    		'api_name' => 'required|string|max:30',
    		'slug_name' => 'required|string|max:30',
            'status' => 'required|numeric',
            'access_quote_live_url' => 'required',
            'access_booking_live_url' => 'required',
            'access_label_live_url' => 'required',
            'access_live_usernm' => 'required',
            'access_live_password' => 'required',
            'access_quote_test_url' => 'required',
            'access_booking_test_url' => 'required',
            'access_label_test_url' => 'required',
            'access_test_usernm' => 'required',
            'access_test_password' => 'required',
    	]);

    	$api_type = $request->api_type;

    	$api = Api::where('id','=',$request->id)->first();
    	$api->name = $request->api_name;
    	$api->status = $request->status;
        $api->access_quote_live_url = $request->access_quote_live_url;
        $api->access_booking_live_url = $request->access_booking_live_url;
        $api->access_label_live_url = $request->access_label_live_url;
        $api->access_live_usernm = $request->access_live_usernm;
        $api->access_live_password = $request->access_live_password;
        $api->access_quote_test_url = $request->access_quote_test_url;
        $api->access_booking_test_url = $request->access_booking_test_url;
        $api->access_label_test_url = $request->access_label_test_url;
        $api->access_test_usernm = $request->access_test_usernm;
        $api->access_test_password = $request->access_test_password;
        if(isset($request->mode)){
            $api->mode = $request->mode;
        }else{
            $api->mode = 'test';
        }

    	if($api->save()){
            return redirect()->route('admin.api')->with('success', ''.$api_type.' API update successfully!');
        }else{
            return redirect()->route('admin.api')->with('error', 'Some problem for update '.$api_type.' API');
        }
    }


}
