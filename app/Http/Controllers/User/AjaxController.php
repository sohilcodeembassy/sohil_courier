<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Suburb;
use Response;


class AjaxController extends Controller
{
    
    public function searchSuburb(Request $request)
    {
        $single_array = array();
        $result = array();
       $term = $request->term;
        $suburb = Suburb::where("locality","like","%$term%")->orwhere("pin_code","like","%$term%")->orderBy("id","ASC")->get();
        $suburb_array = $suburb->toArray();
        foreach($suburb_array as $value)
        {
            
            $single_array["id"] = $value["id"];
            $single_array["city"] = $value["locality"];
            $single_array["pin_code"] = $value["pin_code"];
            $single_array["state"] = $value["state"];
            $result[] = $single_array;
            
        }
        
        return Response::json($result);
        
//        echo "<pre>";
//          print_r($result);
//        print_r($suburb->toArray());
        
    }

}

