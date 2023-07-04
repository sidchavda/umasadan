<?php

namespace App\Repositories\Implementation\User;

use App\Base\BaseRepository;
use App\Models\UserAddress;
use App\Repositories\Interfaces\User\UserAddressRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use DB;
use Datatables; 
class UserAddressRepository  extends BaseRepository implements UserAddressRepositoryInterface
{
    /**
     * @var UserAddress
     */
    protected $userAddressModel; 

    /**
     * UserAddressRepository constructor.
     *
     * @param User $userModel
     */
    public function __construct(UserAddress $userAddressModel)
    {
        parent::__construct($userAddressModel);
        $this->userAddressModelRepo = $userAddressModel;
    }

    public function updateAddress(int $userId, array $data){
        $postData = [
            'user_id' => $userId,
            'district_id' => $data['district_id'],
            'city_id' => $data['city_id'], 
            'present_address' => $data['present_address'],
            'permanent_address' => $data['permanent_address'],
            'addhar_no' => isset($data['addhar_no']) ? $data['addhar_no'] :''
        ];
        $data = $this->getSingleRecords(['user_id' => $userId]);
        if($data){
          return $this->userAddressModelRepo->where(['user_id'=>$userId])->update($postData);
        }else{
           return $this->create($postData);
        } 
    }
}
?>