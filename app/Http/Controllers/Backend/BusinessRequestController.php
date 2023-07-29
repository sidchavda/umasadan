<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\Business\BusinessRepositoryInterface;
use App\Repositories\Interfaces\Business\BusinessDetailRepositoryInterface;
use App\Repositories\Interfaces\Degree\SubDegreeRepositoryInterface;
use App\Repositories\Interfaces\Product\ProductRepositoryInterface;
use Session;
class BusinessRequestController extends Controller
{
    protected $buRepo;
    protected $buDetailRepo;
    protected $subDegreeRepo;
    protected $productRepo;

    public function __construct(
        BusinessRepositoryInterface $buRepository,
        BusinessDetailRepositoryInterface $buDetailRepository,
        SubDegreeRepositoryInterface $subDegreeRepo,
        ProductRepositoryInterface $productRepo,
    )
    {
        $this->buRepo = $buRepository;
        $this->buDetailRepo = $buDetailRepository;
        $this->subDegreeRepo = $subDegreeRepo;
        $this->productRepo = $productRepo;
    }

    public function getRequest(Request $request){
        $input = ['category_id' => $request->category_id];$with = ['getCity'];$order = ['id' => 'desc'];
        $records = $this->buRepo->getAllRecords($input,$with,$order);
        return view('backend.request.list',['records' => $records,'category_id' => $request->category_id]);
    }

    public function getRequestDetail(Request $request, int $id){
        
        $input = ['id' => $id];$with = ['getCreatedUser','getDistrict','getCity','getRequestDetail.getDegree','getCategory','getSubCategory'];
        $select = [];
        $aData = $this->buRepo->getSingleRecords($input,$select,$with);
        if($request->status){
            $aData->status = ($request->status == 1)?'accept':'reject';
            $aData->save();
            Session::flash('success', 'Request status has been changed');  
        }
        if(!empty($aData->getRequestDetail->sub_degree_id)){
            $subDegress = json_decode($aData->getRequestDetail->sub_degree_id);
            $aData->get_sub_degree = $this->subDegreeRepo->getMultipleRecords($subDegress);
            if(!empty($aData->get_sub_degree)){
                $aData->get_sub_degree = array_column($aData->get_sub_degree, 'sub_degree_name');
            }
        }
        if(!empty($aData->getRequestDetail->products)){
            $products = json_decode($aData->getRequestDetail->products);
            $aData->products = $this->productRepo->getMultipleRecords($products);
            if(!empty($aData->products)){
                $aData->products = array_column($aData->products, 'product_name');
            }
        }
        // dd($aData);
        return view('backend.request.detail',['record' => $aData]);
    }
}
