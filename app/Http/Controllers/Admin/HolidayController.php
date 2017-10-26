<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Holiday;

class HolidayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('admin');
    }

    public function holiday(){
    	$wa_state = Holiday::where('state_code', 'wa')->get();
    	$vic_state = Holiday::where('state_code', 'vic')->get();
    	$tas_state = Holiday::where('state_code', 'tas')->get();
    	$nsw_state = Holiday::where('state_code', 'nsw')->get();
    	$sa_state = Holiday::where('state_code', 'sa')->get();
    	$qld_state = Holiday::where('state_code', 'qld')->get();
    	$nt_state = Holiday::where('state_code', 'nt')->get();
    	return view('admin.holiday.holiday',['wa_state' => $wa_state, 'vic_state' => $vic_state, 'tas_state' => $tas_state, 'nsw_state' => $nsw_state, 'sa_state' => $sa_state, 'qld_state' => $qld_state, 'nt_state' => $nt_state]);
    }

    public function postHoliday(Request $request){
    	$this->validate($request, [
    		'holiday_state' => 'required',
    		'holiday_date' => 'required',
            'status' => 'required|numeric',
    	]);

    	$holiday_state = $request->holiday_state;
    	$holiday_date = date('Y-m-d', strtotime($request->holiday_date));

    	foreach ($holiday_state as $key => $value) {
    		$holiday = Holiday::where('holiday_date','=',$holiday_date)->where('state_code','=',$value)->first();

    		if(empty($holiday)){
	    		$holiday = new Holiday();
	    	}
	    	$holiday->state_code = $value;
	    	$holiday->holiday_date = $holiday_date;
	    	$holiday->status = $request->status;
	    	$holiday->save();
    	}

    	return redirect()->route('admin.holiday')->with('success', 'Holiday add successfully!');
    }

    public function editHoliday($id){
    	$holiday = Holiday::where('id','=',$id)->first();
    	return view('admin.holiday.editHoliday',['holiday' => $holiday]);
    }

}
