<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Blog_category;
use App\Blog;
use App\Api;
use App\Holiday;
use App\User;
use App\Company_address;
use App\Communication_user_email;
use App\PricingPortalApi;
use App\GstLevy; 
use App\Package;
use App\PackageSize;
use App\PackageTypes;
use App\UserPackages;

class AjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('admin');
    }


    //---------------------------------------User Management------------------------------------------------
    public function userStatus(Request $request){
        $user = User::where('id','=',$request->id)->first();
        if($request->status == 'Deactive'){
            $user->status = '1';
            if($user->save()){
                return json_encode(array('status' => 'success','action' => 'deactive'));
            }else{
                return json_encode(array('status' => 'error'));
            }
        }elseif($request->status == 'Active'){
            $user->status = '0';
            if($user->save()){
                return json_encode(array('status' => 'success','action' => 'active'));
            }else{
                return json_encode(array('status' => 'error'));
            }
        }
    }

    public function userDelete(Request $request){
        $id = $request->id;
        
        $c_delete = Company_address::where('user_id','=',$id)->delete();
        $c_email_delete = Communication_user_email::where('user_id','=',$id)->delete();

        $user = User::where('id','=',$id)->delete();
        //$user = true;
        if($user){
            return json_encode(array('status' => 'success'));
        }else{
            return json_encode(array('status' => 'error'));
        }
    }

    public function userCommunicationEmailDelete(Request $request){
        $user_id = $request->user_id;
        $id = $request->id;
        $c_email_delete = Communication_user_email::where('user_id','=',$user_id)->where('id','=',$id)->delete();
        //$c_email_delete = true;
        if($c_email_delete){
            return json_encode(array('status' => 'success'));
        }else{
            return json_encode(array('status' => 'error'));
        }
    }

    public function pricingPortalStatus(Request $request){
        $PricingPortalApi = PricingPortalApi::where('id','=',$request->id)->first();
        if($request->status == 'Deactive'){
            $PricingPortalApi->status = '1';
            if($PricingPortalApi->save()){
                return json_encode(array('status' => 'success','action' => 'deactive'));
            }else{
                return json_encode(array('status' => 'error'));
            }
        }elseif($request->status == 'Active'){
            $PricingPortalApi->status = '0';
            if($PricingPortalApi->save()){
                return json_encode(array('status' => 'success','action' => 'active'));
            }else{
                return json_encode(array('status' => 'error'));
            }
        }
    }

    public function pricingPortalDelete(Request $request){
        $id = $request->id;
        
        $PricingPortalApi = PricingPortalApi::where('id','=',$id)->delete();
        //$PricingPortalApi = true;
        if($PricingPortalApi){
            return json_encode(array('status' => 'success'));
        }else{
            return json_encode(array('status' => 'error'));
        }
    }

    public function pricingPortalApiAllStatus(Request $request){
         //echo $request->status;
        // echo '<br>';
        // echo $request->api_type;exit;
        //$api = Api::where('id','=',$request->id)->first();
        $api_type = $request->api_type;
        $user_id = $request->user_id;

        if($request->status == 'disable'){
            $PricingPortalApi = PricingPortalApi::where('api_type','=',$api_type)->where('user_id','=',$user_id)->update(['status' => '0']);
            if($PricingPortalApi){
                return json_encode(array('status' => 'success','action' => 'disable'));
            }else{
                return json_encode(array('status' => 'error'));
            }

        }elseif($request->status == 'enable'){
            $PricingPortalApi = PricingPortalApi::where('api_type','=',$api_type)->update(['status' => '1']);
            if($PricingPortalApi){
                return json_encode(array('status' => 'success','action' => 'enable'));
            }else{
                return json_encode(array('status' => 'error'));
            }
        }
    }


    //---------------------------------------Blog Category Management------------------------------------------------
    public function blogCategoryStatus(Request $request){
        $blog_category = Blog_category::where('id','=',$request->id)->first();
        if($request->status == 'Deactive'){
            $blog_category->status = '1';
            if($blog_category->save()){
                return json_encode(array('status' => 'success','action' => 'deactive'));
            }else{
                return json_encode(array('status' => 'error'));
            }
        }elseif($request->status == 'Active'){
            $blog_category->status = '0';
            if($blog_category->save()){
                return json_encode(array('status' => 'success','action' => 'active'));
            }else{
                return json_encode(array('status' => 'error'));
            }
        }
    }

    public function blogCategoryDelete(Request $request){
        $blog_category = Blog_category::where('id','=',$request->id)->delete();
        //$blog_category = true;
        if($blog_category){
            return json_encode(array('status' => 'success'));
        }else{
            return json_encode(array('status' => 'error'));
        }
    }

    //---------------------------------------Blog Management------------------------------------------------
    public function blogStatus(Request $request){
        $blog = Blog::where('id','=',$request->id)->first();
        if($request->status == 'Deactive'){
            $blog->status = '1';
            if($blog->save()){
                return json_encode(array('status' => 'success','action' => 'deactive'));
            }else{
                return json_encode(array('status' => 'error'));
            }
        }elseif($request->status == 'Active'){
            $blog->status = '0';
            if($blog->save()){
                return json_encode(array('status' => 'success','action' => 'active'));
            }else{
                return json_encode(array('status' => 'error'));
            }
        }
    }

    public function blogDelete(Request $request){
        $blog = Blog::where('id','=',$request->id)->first();
        $blog_image = $blog->image;
        $blog_image_path = public_path().'/backend/assets/images/blog_images/'.$blog_image;
        $blog_image_thumbnail_path = public_path().'/backend/assets/images/blog_images/thumbnail/'.$blog_image;
        unlink($blog_image_path);
        unlink($blog_image_thumbnail_path);
        $blog = Blog::where('id','=',$request->id)->delete();
        //$blog = true;
        if($blog){
            return json_encode(array('status' => 'success'));
        }else{
            return json_encode(array('status' => 'error'));
        }
    }

    //---------------------------------------API Management------------------------------------------------
    public function apiStatus(Request $request){
        $api = Api::where('id','=',$request->id)->first();
        if($request->status == 'Deactive'){
            $api->status = '1';
            if($api->save()){
                return json_encode(array('status' => 'success','action' => 'deactive'));
            }else{
                return json_encode(array('status' => 'error'));
            }
        }elseif($request->status == 'Active'){
            $api->status = '0';
            if($api->save()){
                return json_encode(array('status' => 'success','action' => 'active'));
            }else{
                return json_encode(array('status' => 'error'));
            }
        }
    }

    public function apiDelete(Request $request){
        $api = Api::where('id','=',$request->id)->delete();
        //$api = true;
        if($api){
            return json_encode(array('status' => 'success'));
        }else{
            return json_encode(array('status' => 'error'));
        }
    }

    public function apiAllStatus(Request $request){
         //echo $request->status;
        // echo '<br>';
        // echo $request->api_type;exit;
        //$api = Api::where('id','=',$request->id)->first();
        $api_type = $request->api_type;

        if($request->status == 'disable'){
            $api = Api::where('type','=',$api_type)->update(['status' => '0']);
            if($api){
                return json_encode(array('status' => 'success','action' => 'disable'));
            }else{
                return json_encode(array('status' => 'error'));
            }

        }elseif($request->status == 'enable'){
            $api = Api::where('type','=',$api_type)->update(['status' => '1']);
            if($api){
                return json_encode(array('status' => 'success','action' => 'enable'));
            }else{
                return json_encode(array('status' => 'error'));
            }
        }
    }

    //---------------------------------------GST & LEVY Management------------------------------------------------
    public function getlevyEdit(Request $request){
        $field = $request->field;
        $value = $request->value;

        $gstLevy = GstLevy::first();
        $gstLevy->$field = $value;
        if($gstLevy->save()){
            return json_encode(array('status' => 'success'));
        }else{
            return json_encode(array('status' => 'error'));
        }
    }

    //---------------------------------------Package Management------------------------------------------------
    public function ajaxGetPackageMeasurement(Request $request){
        $package_id = $request->package_id;
        $size_id = $request->size_id;

        $packagesize = PackageSize::where('id','=',$size_id)->where('package_id','=',$package_id)->first();
        // echo '<pre>';
        // print_r($packagesize->toArray());
        return json_encode(array('status' => 'success','row' => $packagesize));

    }

    public function deletePackageSize(Request $request){
        $id = $request->id;
        $packagesize = PackageSize::where('id','=',$id)->delete();
        //$packagesize = true;
        if($packagesize){
            return json_encode(array('status' => 'success',));
        }else{
            return json_encode(array('status' => 'error'));
        }
    }

    public function packageDelete(Request $request){
        $package_id = $request->id;
        $package_delete = Package::where('id','=',$package_id)->delete();
        //$package_delete = true;
        if($package_delete){
            PackageSize::where('package_id','=',$package_id)->delete();
            PackageTypes::where('package_id','=',$package_id)->delete();
            UserPackages::where('package_id','=',$package_id)->delete();
            return json_encode(array('status' => 'success'));
        }else{
            return json_encode(array('status' => 'error'));
        }
    }


    //-----------------------------------User Package Management------------------------------------------------
    public function userPackageActiveDeactive(Request $request){
        $user_id = $request->user_id;
        $package_id = $request->package_id;
        $status = $request->status;

        if(isset($user_id) && isset($package_id)){
            $user_package = UserPackages::where('user_id','=',$user_id)->where('package_id','=',$package_id)->first();

            if(!empty($user_package)){
                if($status == 'active'){
                    $user_package->status = '0';
                    if($user_package->save()){
                        return json_encode(array('status' => 'success','package_status' => 'deactive'));
                    }else{
                        return json_encode(array('status' => 'error'));
                    }

                }elseif($status == 'deactive'){
                    $user_package->status = '1';
                    if($user_package->save()){
                        return json_encode(array('status' => 'success','package_status' => 'active'));
                    }else{
                        return json_encode(array('status' => 'error'));
                    }
                }
            }else{
                $user_package = new UserPackages();
                $user_package->user_id = $user_id;
                $user_package->package_id = $package_id;
                $user_package->status = '1';
                if($user_package->save()){
                    return json_encode(array('status' => 'success','package_status' => 'active'));
                }else{
                    return json_encode(array('status' => 'error'));
                }
            }   

        }else{
            return json_encode(array('status' => 'error'));
        }    

    }


    //---------------------------------------Holiday Management------------------------------------------------
    public function holidayStatus(Request $request){
        $holiday = Holiday::where('id','=',$request->id)->first();
        if($request->status == 'Deactive'){
            $holiday->status = '1';
            if($holiday->save()){
                return json_encode(array('status' => 'success','action' => 'deactive'));
            }else{
                return json_encode(array('status' => 'error'));
            }
        }elseif($request->status == 'Active'){
            $holiday->status = '0';
            if($holiday->save()){
                return json_encode(array('status' => 'success','action' => 'active'));
            }else{
                return json_encode(array('status' => 'error'));
            }
        }
    }

    public function holidayDelete(Request $request){
        $holiday = Holiday::where('id','=',$request->id)->delete();
        //$holiday = true;
        if($holiday){
            return json_encode(array('status' => 'success'));
        }else{
            return json_encode(array('status' => 'error'));
        }
    }

}
