<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\GstLevy;

class GstLevyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('admin');
    }

    public function getlevy(){
    	$gstLevy = GstLevy::first();
    	return view('admin.GstLevy.gstLevy',['gstLevy' => $gstLevy]);
    }

}
