<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\Business\BusinessRepositoryInterface;
use App\Repositories\Interfaces\Business\BusinessDetailRepositoryInterface;
use Validator;
use DB;
use ApiToken;
class BusinessRequestController extends BaseController
{
    protected $buRepo;
    protected $buDetailRepo;

    public function __construct(
        BusinessRepositoryInterface $buRepository,
        BusinessDetailRepositoryInterface $buDetailRepository
    )
    {
        $this->buRepo = $buRepository;
        $this->buDetailRepo = $buDetailRepository;
    } 

    public function addRequest(Request $request){
        $param = $request->all();
        $validator = $this->validateParam($param); 
        if ($validator->fails())
        {
            return $this->sendError([],implode(',',$validator->errors()->all()),400);
        }       
        DB::beginTransaction();
        try{
            $response = [];
            $token = $request->bearerToken();
            $userData = ApiToken::getUserDetail($token);
            $param['user_id'] = $userData->id;
            //store basic detail
            $requestDetail = $this->buRepo->storeData($param);
            $param['b_r_id'] = $requestDetail->id;
            //store additional detail
            $this->buDetailRepo->storeData($param);
            DB::commit();
            return $this->sendResponse($response,trans('messages.request_submit'),200);
        }
        catch(\Exception $e){   
           DB::rollback();
           $response['error'] = !empty($e->getMessage())?$e->getMessage() : '';
           return  $this->sendError($response,trans('messages.something'),500);
        } 
    }

    public function validateParam(array $param){
    //   dd($param);
        $validationArray = [
            'category_id' => 'required|numeric',
            // 'sub_category_id' => 'required|numeric',
            'business_name' => 'required', 
            'mobile_number' => 'required',
            'district_id' => 'required',
            'city_id' => 'required',
            'present_address' => 'required',
            'experience_year' => 'numeric',
            'id_proof' => 'image|mimes:jpg,png',
            'business_desc'=>  'required'
        ]; 
        $categoryId = $param['category_id'];
        switch($categoryId) {
            case 1:
                $validationArray['degree_id'] = 'required|numeric';
                // $validationArray['sub_degree_id'] = 'required|numeric';
                $validationArray['section'] = 'required|string';
                $validationArray['job_day_type'] = 'in:fulltime,parttime';
                $validationArray['shift'] = 'in:day,night';
                $validationArray['work_platform'] = 'in:home,office';
                $validationArray['working_hours'] = 'numeric';
            break;
            case 2:
                $validationArray['delivery_type'] = 'in:home,pickup';
                $validationArray['products'] = 'required';
            default:    
        }
        $validator = Validator::make($param,$validationArray);
        return $validator;        
    }
    public function getRequest(Request $request){
        $filter = ['category_id' => $request->category_id];
        $records = $this->buRepo->getData($filter);
        if($records->count() > 0){
            return $this->sendResponse($records,trans('messages.records_found'),200);
        }else{
            return  $this->sendError([],trans('messages.records_not_found'),config('constants.status_code.not_found'));  
        } 
    }

    public function getRequestDetail(int $id){
        try{
            $requestDetail  = $this->buDetailRepo->getDetail($id); 
            if(!empty($requestDetail)){
                return $this->sendResponse($requestDetail,trans('messages.records_found'),200);
            }else{
                return  $this->sendError([],trans('messages.records_not_found'),config('constants.status_code.not_found'));  
            }   
        }
        catch(\Exception $e){ 
           $response['error'] = !empty($e->getMessage())?$e->getMessage() : '';
           return  $this->sendError($response,trans('messages.something'),500);
        }
    }
}
