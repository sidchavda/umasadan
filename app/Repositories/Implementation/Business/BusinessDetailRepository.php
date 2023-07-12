<?php

namespace App\Repositories\Implementation\Business;

use App\Base\BaseRepository;
use App\Models\BusinessRequestDetail;
use App\Repositories\Interfaces\Business\BusinessDetailRepositoryInterface;
use Illuminate\Database\Eloquent\Collection; 
use DB;
use Datatables;
class BusinessDetailRepository  extends BaseRepository implements BusinessDetailRepositoryInterface
{
    /**
     * @var BusinessDetail
     */
    protected $businessDetailRepo; 

    /**
     * BusinessRequest constructor.
     *
     * @param BusinessRequestDetail $businessDetail
     */
    public function __construct(BusinessRequestDetail $businessDetail)
    {
        parent::__construct($businessDetail);
        $this->businessDetailRepo = $businessDetail;
    }

    public function storeData(array $data){
        $postParam = [
                    'degree_id' => $data['degree_id'],
                    'sub_degree_id' => $data['sub_degree_id'],
                    'experience_year' => $data['experience_year'],
                    'delivery_type' => $data['delivery_type'],
                    'job_day_type' => $data['job_day_type'],
                    'shift' => $data['shift'],
                    'work_platform' => $data['work_platform'],
                    'working_hours' => $data['working_hours'],
                    'business_desc' => $data['business_desc'],
                    'b_r_id' => $data['b_r_id']
        ];  
        $this->businessDetailRepo->create($postParam); 
    }
}
?>