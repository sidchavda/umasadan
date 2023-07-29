<?php

namespace App\Repositories\Implementation\Business;

use App\Base\BaseRepository;
use App\Models\BusinessRequestDetail;
use App\Repositories\Interfaces\Business\BusinessDetailRepositoryInterface;
use App\Repositories\Interfaces\Degree\SubDegreeRepositoryInterface;
use App\Repositories\Interfaces\Product\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection; 
use DB;
use Datatables;
use App\Traits\FileUpload;
class BusinessDetailRepository  extends BaseRepository implements BusinessDetailRepositoryInterface
{
    use FileUpload; 
    /**
     * @var BusinessDetail
     */
    protected $businessDetailRepo;
    protected $subDegreeRepo;
    protected $productRepo;

    /**
     * BusinessRequest constructor.
     *
     * @param BusinessRequestDetail $businessDetail
     */
    public function __construct(BusinessRequestDetail $businessDetail,SubDegreeRepositoryInterface $subDegreeRepo, ProductRepositoryInterface $productRepo)
    {
        parent::__construct($businessDetail);
        $this->businessDetailRepo = $businessDetail;
        $this->subDegreeRepo = $subDegreeRepo;
        $this->productRepo = $productRepo;
    }

    public function storeData(array $data){
        
       
        $postArray = [
            'b_r_id' => $data['b_r_id'],
            'experience_year' => $data['experience_year'],
            'business_desc' => $data['business_desc'],
        ];
        $categoryId = $data['category_id'];
        switch($categoryId) {
            case 1:
                $postArray['degree_id'] = $data['degree_id'];
                $postArray['sub_degree_id'] = isset($data['sub_degree_id'])?$data['sub_degree_id']:Null;
                $postArray['section'] = $data['section']; 
                $postArray['job_day_type'] = $data['job_day_type'];
                $postArray['shift'] = $data['shift'];
                $postArray['work_platform'] = $data['work_platform'];
                $postArray['working_hours'] = $data['working_hours'];
            break;
            case 2:
                $products = $data['products'];
                if(!empty($data['product_name'])){
                    $products = $this->addValueInJson($data); 
                }
                $postArray['delivery_type'] = $data['delivery_type'];
                $postArray['products'] = $data['products'];
            default:    
        }
        if(!empty($data['id_proof'])){
            $fileName = $this->uploadFile($data['id_proof'],'proof');
            if($fileName){
                $postArray['id_proof'] = $fileName;
            }
        }
      
        $this->businessDetailRepo->create($postArray); 
    }

    public function addValueInJson($data){
        $productName = $data['product_name'];
        $jsonArray = json_decode($data['products'],true); 
        $postArray = ['category_id' => $data['category_id'],'product_name' => $productName,'activated' => 0,'create_by' => $data['user_id']];
        $productId = DB::table('products')->insertGetId($postArray);
        array_push($jsonArray,$productId);
        return json_encode($jsonArray);
    }

    public function getDetail($id){
        $with = ['getMainRequest:id,business_name,email,mobile_number,present_address,status,searchable_address','getDegree:id,degree_name'];
        $select = ['id','b_r_id','degree_id','sub_degree_id','experience_year','section','delivery_type','job_day_type','shift','work_platform','working_hours','business_desc','products','id_proof','created_at'];
        // $select = [];
        $records = $this->getSingleRecords(['b_r_id' => $id],$select,$with); 
        if(!empty($records->sub_degree_id)){
            $subDegress = json_decode($records->sub_degree_id);
            $records->get_sub_degree= $this->subDegreeRepo->getMultipleRecords($subDegress);
        }
        if(!empty($records->products)){
            $products = json_decode($records->products);
            $records->products = $this->productRepo->getMultipleRecords($products);
            if(!empty($aData->products)){ 
                $records->products = array_column($aData->products, 'product_name');
            }
        }
        return  $records;  
      
    }
}
?>