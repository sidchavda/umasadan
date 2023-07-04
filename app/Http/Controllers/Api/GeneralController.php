<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\City;
class GeneralController extends BaseController
{
    protected $district;
    protected $city;
    public function __construct(
        District $district,
        City $city,
        )
    {
        $this->district = $district;
        $this->city = $city;
    }

    public function getDistrict(){ 
        $districts = $this->district->all();
        if($districts->count() > 0){
            return $this->sendResponse($districts,trans('messages.records_found'),200);
        }else{
            return  $this->sendError([],trans('messages.records_not_found'),config('constants.status_code.not_found'));  
        }
    }

    public function getCity(Request $request){  
        $city = $this->city->where(function($query) use ($request){
            if(!empty($request->district_id)){
                $query->where('district_id',$request->district_id);
            }
        })->get();
        if($city->count() > 0){ 
            return $this->sendResponse($city,trans('messages.records_found'),200);
        }else{
            return  $this->sendError([],trans('messages.records_not_found'),config('constants.status_code.not_found'));  
        }
    }
}
