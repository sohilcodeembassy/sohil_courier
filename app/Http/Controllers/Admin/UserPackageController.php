<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Package;
use App\PackageSize;
use App\PackageTypes;
use App\UserPackages;

class UserPackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('admin');
    }

    public function userPackage(){
    	$users = User::orderBy('first_name','ASC')->get();
    	$packages = Package::orderBy('package_name','ASC')->get();
    	// echo '<pre>';
    	// print_r($packages->toArray());
    	// exit;
    	return view('admin.UserPackage.userPackage', ['users' => $users, 'packages' => $packages , 'controller' => $this]);
    }
    public function findUpackage($user_id, $p_id){
    	$UserPackages = UserPackages::where('package_id','=',$p_id)->where('user_id','=',$user_id)->first();

    	if(!empty($UserPackages)){
    		$status = $UserPackages->status;
    	}else{
    		$status = '0';
    	}
    	return $status;
    }


}
