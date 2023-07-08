<?php

namespace App\Repositories\Implementation\User;

use App\Base\BaseRepository;
use App\Models\User;
use App\Repositories\Interfaces\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use DB;
use Datatables;
class UserRepository  extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    protected $userModel; 

    /**
     * UserRepository constructor.
     *
     * @param User $userModel
     */
    public function __construct(User $userModel)
    {
        parent::__construct($userModel);
        $this->userModelRepo = $userModel;
    }

    public function generateOtp(){ 
        $otp = random_number();
        $expMin = '+'.config('constants.otp_expiration_min').' minutes';
        $newDate = date('Y-m-d H:i:s', strtotime($expMin));
        return ['otp' => $otp,'otp_expiration' =>  $newDate];
    }

    public function updateUserRecords(int $userId,array $data){
        $postData = [
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'mobile_number' => $data['mobile_number'],
            'dob' => $data['dob'],
            'gender' => $data['gender']
        ];
        return $this->update($userId,$postData);
    }
    public function getRolebasedUsers(){
        return $this->userModelRepo::with('getAddress.getDistrict')->role('Mobile-User')->orderBy('id','desc')->get();
    }
    
}
?>