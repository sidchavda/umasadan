<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\User\UserRepositoryInterface;
use App\Repositories\Interfaces\User\UserAddressRepositoryInterface;
use Validator;
use DB;
use ApiToken;
class AuthController extends BaseController
{
    protected $userRepo;
    protected $userAddressRepo;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserAddressRepositoryInterface $userAddressRepository
    )
    {
        $this->userRepo = $userRepository;
        $this->userAddressRepo = $userAddressRepository;
    }

    public function login(Request $request){
       
        $param = $request->all();
        $validator = Validator::make($param, [
            'mobile_number' => 'required|numeric',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
        if ($validator->fails())
        {
            return $this->sendError([],implode(',',$validator->errors()->all()),400);
        }
        DB::beginTransaction();
        try{
            $aOtpData = $this->userRepo->generateOtp();
            $param['otp'] = $aOtpData['otp'];
            $param['otp_expiration'] = $aOtpData['otp_expiration'];
            $user = $this->userRepo->getSingleRecords(['mobile_number' => $param['mobile_number']]);
            
            if (empty($user)) {
                $user = $this->userRepo->create($param);
            }else{
                $post['otp'] = $aOtpData['otp'];
                $post['otp_expiration'] = $aOtpData['otp_expiration'];
                $user = $this->userRepo->update($user->id,$param);  
            }
            DB::commit();
            $response = ['otp' => $user->otp];
            return $this->sendResponse($response,trans('messages.otp_send'),200);
        }
        catch(\Exception $e){ 
           DB::rollback();
           $response['error'] = !empty($e->getMessage())?$e->getMessage() : '';
           return  $this->sendError($response,trans('messages.something'),500);
        }

    }
    public function verifyOtp(Request $request){
        $postData = $request->all();
        $validator = Validator::make($postData, [
            'mobile_number' => 'required|max:10',
            'otp' => 'required|max:4',
        ]);
        $response = [];
        if ($validator->fails())
        {
            return $this->sendError($response,implode(',',$validator->errors()->all()),400);
        }
        $response = [];
        $user = $this->userRepo->getSingleRecords(['mobile_number' => $postData['mobile_number']]);
        if ($user) {
            ## check otp is valid or not 
            $checkOtp = $this->userRepo->getSingleRecords(['mobile_number' => $postData['mobile_number'],'otp' => $postData['otp']]);
            if(empty($checkOtp)){
                return $this->sendError($response,trans('messages.otp_invalid'),400);  
            }

            ## check otp expiration time
            if(strtotime(now()) >strtotime($user->otp_expiration)){
                return $this->sendError($response,trans('messages.otp_expired'),400); 
            }
            $param = ['otp' => null,'otp_expiration' =>  null];
            $this->userRepo->update($user->id,$param);  

            ## display  login type wise data
            ## if verified otp then create token
            $token = ApiToken::createToken($user->id);
            $response = ['user_id' => $user->id,'name' => $user->full_name,'role' => 
            isset($user->roles[0]->name) ? $user->roles[0]->name : '','token' => $token];
            
            return $this->sendResponse($response,trans('messages.verify_success'),200);  
        }else {
            return $this->sendError($response,trans('messages.user_not'),404);
        } 
    }

    public function addRegistrationDetail(Request $request){
        $postData = $request->all();
        $validator = Validator::make($postData, [
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'mobile_number' => 'required|numeric',
            'dob' => 'required',
            'gender' => 'required',
            'district_id' => 'required',
            'city_id' => 'required',
            'present_address' => 'required',
            'permanent_address' => 'required'

        ]);
        $response = [];
        if ($validator->fails())
        {
            return $this->sendError($response,implode(',',$validator->errors()->all()),400);
        }
        $response = [];
        DB::beginTransaction();
        try{
            $token = $request->bearerToken();
            $userData = ApiToken::getUserDetail($token);
            $user = $this->userRepo->updateUserRecords($userData->id,$postData);
            $this->userAddressRepo->updateAddress($userData->id,$postData);
            $user->assignRole('Mobile-User');    
            DB::commit();
            $response = ['user_detail' => $user];
            return $this->sendResponse($response,trans('messages.update_records'),200);
        }
        catch(\Exception $e){ 
           DB::rollback();
           $response['error'] = !empty($e->getMessage())?$e->getMessage() : '';
           return  $this->sendError($response,trans('messages.something'),500);
        }
    }
}
