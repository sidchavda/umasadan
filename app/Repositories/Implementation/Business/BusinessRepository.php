<?php

namespace App\Repositories\Implementation\Business;

use App\Base\BaseRepository;
use App\Models\BusinessRequest;
use App\Repositories\Interfaces\Business\BusinessRepositoryInterface;
use Illuminate\Database\Eloquent\Collection; 
use DB;
use Datatables;
class BusinessRepository  extends BaseRepository implements BusinessRepositoryInterface
{
    /**
     * @var Business
     */
    protected $businessRequest; 

    /**
     * BusinessRequest constructor.
     *
     * @param BusinessRequest $businessRequest
     */
    public function __construct(BusinessRequest $businessRequest)
    {
        //Load model
        parent::__construct($businessRequest);
        $this->businessRequestRepo = $businessRequest;
    }
    public function storeData($data){
        $postParam = ['category_id' => $data['category_id'],'sub_category_id' => $data['sub_category_id'],'business_name' => $data['business_name'],'mobile_number' => $data['mobile_number'],'district_id' => $data['district_id'],'city_id' => $data['city_id'],'present_address' => $data['present_address'],'create_by' => $data['user_id']];
        $buData = $this->businessRequestRepo->create($postParam);
        //Update Full Address
        $reqquestData = $this->updateFullAddress($buData->id);
        return $reqquestData; 
    }

    public function updateFullAddress(int $buId){
        $data = $this->getById($buId,['getDistrict','getCity']);
        $jsonData = json_decode($data->present_address);
        $address = [];
        $address[0] = isset($jsonData->addr1) ? $jsonData->addr1:'';
        $address[1] = isset($jsonData->addr2) ? $jsonData->addr2:'';
        $address[2] = isset($jsonData->pincode) ? $jsonData->pincode:'';
        $address[3] = isset($data->getCity->city_name) ? $data->getCity->city_name:'';
        $address[4] = isset($data->getDistrict->district_name) ? $data->getDistrict->district_name:'';
       return  $this->update($buId,['searchable_address' => implode(',',$address)]); 
    }
}
?>