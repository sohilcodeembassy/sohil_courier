<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Package;
use App\PackageSize;
use App\PackageTypes;
use App\UserPackages;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('admin');
    }


    public function package(){
    	$users = User::orderBy('first_name','ASC')->get();
    	$packages = Package::orderBy('package_name','ASC')->get();
    	return view('admin.Package.package', ['users' => $users, 'packages' => $packages]);
    }

    public function postPackage(Request $request){
    	$this->validate($request, [
            'package_name' => 'required',
            'package_type' => 'required',
            'package_value' => 'required',
            'status' => 'required',
        ]);

        $package_name = $request->package_name;
        $package_type = $request->package_type;
		$package_value = $request->package_value;
		$status = $request->status;

		$size_array = $request->size;
		$length_array = $request->length;
		$width_array = $request->width;
		$height_array = $request->height;
		$lwh_measurement_array = $request->lwh_measurement;
		$weight_array = $request->weight;
		$weight_measurement_array = $request->weight_measurement;

		$type1_array = $request->type1;
		$type2_array = $request->type2;
		
		$users_array = $request->users;
		$user_id = implode(',', $users_array);

		$users = User::whereIn('id', $users_array)->get();
		// echo '<pre>';
		// print_r($users);
		// echo $type1_json = json_encode($type1_array);
		//	exit;

		$package = new Package();
		$package->package_name = $package_name;
		$package->package_type = $package_type;
		$package->package_value = $package_value;
		$package->users = $user_id;
		$package->status = $request->status;

		if($package->save()){

			$package_id = $package->id;

			//UserPackages add
			foreach ($users as $key => $value) {
				$userPackages = new UserPackages();
				$userPackages->user_id = $value->id;
				$userPackages->package_id = $package_id;
				$userPackages->status = '1';
				$userPackages->save();
			}

			//package size add
			for ($i=0; $i <sizeof($size_array) ; $i++) { 
				$size = $size_array[$i];
				$length = $length_array[$i];
				$width = $width_array[$i];
				$height = $height_array[$i];
				$lwh_measurement = $lwh_measurement_array[$i];
				$weight = $weight_array[$i];
				$weight_measurement = $weight_measurement_array[$i];

				if($length == ''){
					$length = 0;
				}
				
				if($width == ''){
					$width = 0;
				}
				
				if($height == ''){
					$height = 0;
				}
				
				if($weight == ''){
					$weight = 0;
				}

				$packageSize = new PackageSize();
				$packageSize->package_id = $package_id;
				$packageSize->size = $size;
				$packageSize->length = $length;
				$packageSize->width = $width;
				$packageSize->height = $height;
				$packageSize->lwh_measurement = $lwh_measurement;
				$packageSize->weight = $weight;
				$packageSize->weight_measurement = $weight_measurement;
				$packageSize->status = '1';
				$packageSize->save();
			}

			//Type1 and Type2 add
			$type1_json = json_encode($type1_array);
			$type2_json = json_encode($type2_array);

			if(!empty($type1_array[0]) || !empty($type2_array[0])){
				$packageTypes =  new PackageTypes();
				$packageTypes->package_id = $package_id;
				$packageTypes->type1 = $type1_json;
				$packageTypes->type2 = $type2_json;
				$packageTypes->status = '1';
				$packageTypes->save();

			}else{
				$packageTypes =  new PackageTypes();
				$packageTypes->package_id = $package_id;
				$packageTypes->type1 = '0';
				$packageTypes->type2 = '0';
				$packageTypes->status = '1';
				$packageTypes->save();
			}

			return redirect()->route('admin.package')->with('success', 'Package add successfully.');

		}else{
			return redirect()->route('admin.package')->with('error', 'Some problem for add Package');
		}

    }

    public function editPackage($id){
    	$users = User::orderBy('first_name','ASC')->get();
    	$package = Package::where('id','=',$id)->first();
    	$packagesize = PackageSize::where('package_id','=',$id)->get();
    	$packagetypes = PackageTypes::where('package_id','=',$id)->first();
    	$type1_array = json_decode($packagetypes->type1);
        $type2_array = json_decode($packagetypes->type2);
        // echo '<pre>';
        // print_r($type1_array);
        // exit;
    	return view('admin.Package.editPackage', ['users' => $users, 'package' => $package, 'packagesize' => $packagesize, 'packagetypes' => $packagetypes, 'type1_array' => $type1_array, 'type2_array' => $type2_array]);
    }

    public function postEditPackage(Request $request){
    	$this->validate($request, [
            'package_name' => 'required',
            'package_type' => 'required',
            'package_value' => 'required',
            'status' => 'required',
        ]);

    	$package_id = $request->package_id;

        $package_name = $request->package_name;
        $package_type = $request->package_type;
		$package_value = $request->package_value;
		$status = $request->status;

		$package_size_id_array = $request->package_size_id;

		$size_array = $request->size;
		$length_array = $request->length;
		$width_array = $request->width;
		$height_array = $request->height;
		$lwh_measurement_array = $request->lwh_measurement;
		$weight_array = $request->weight;
		$weight_measurement_array = $request->weight_measurement;

		$type1_array = $request->type1;
		$type2_array = $request->type2;

		$package = Package::where('id','=',$package_id)->first();
		$package->package_name = $package_name;
		$package->package_type = $package_type;
		$package->package_value = $package_value;
		$package->status = $status;

		if($package->save()){
			//package size add
			for ($i=0; $i <sizeof($size_array) ; $i++) { 
				$size = $size_array[$i];
				$length = $length_array[$i];
				$width = $width_array[$i];
				$height = $height_array[$i];
				$lwh_measurement = $lwh_measurement_array[$i];
				$weight = $weight_array[$i];
				$weight_measurement = $weight_measurement_array[$i];

				if($length == ''){
					$length = 0;
				}
				
				if($width == ''){
					$width = 0;
				}
				
				if($height == ''){
					$height = 0;
				}
				
				if($weight == ''){
					$weight = 0;
				}

				// echo '<pre>';
				// print_r($package_size_id_array);

				if(isset($package_size_id_array[$i])){
					$package_size_id = $package_size_id_array[$i];
					$packageSize = PackageSize::where('id','=',$package_size_id)->where('package_id','=',$package_id)->first();
				}else{
					$packageSize = new PackageSize();					
				}

				$packageSize->package_id = $package_id;
				$packageSize->size = $size;
				$packageSize->length = $length;
				$packageSize->width = $width;
				$packageSize->height = $height;
				$packageSize->lwh_measurement = $lwh_measurement;
				$packageSize->weight = $weight;
				$packageSize->weight_measurement = $weight_measurement;
				$packageSize->status = '1';
				$packageSize->save();
			}
			
		//Type1 and Type2 add
			$type1_json = json_encode($type1_array);
			$type2_json = json_encode($type2_array);

			if(!empty($type1_array[0]) || !empty($type2_array[0])){
				$packageTypes =  PackageTypes::where('package_id','=',$package_id)->first();
				$packageTypes->package_id = $package_id;
				$packageTypes->type1 = $type1_json;
				$packageTypes->type2 = $type2_json;
				$packageTypes->status = '1';
				$packageTypes->save();

			}else{
				$packageTypes =  PackageTypes::where('package_id','=',$package_id)->first();
				$packageTypes->package_id = $package_id;
				$packageTypes->type1 = '0';
				$packageTypes->type2 = '0';
				$packageTypes->status = '1';
				$packageTypes->save();
			}

			return redirect()->route('admin.package')->with('success', 'Package update successfully.');

		}else{
			return redirect()->route('admin.package')->with('error', 'Some problem for update Package');
		}
		
    }


}
