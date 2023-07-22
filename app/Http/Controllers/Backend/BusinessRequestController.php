<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\Business\BusinessRepositoryInterface;
use App\Repositories\Interfaces\Business\BusinessDetailRepositoryInterface;

class BusinessRequestController extends Controller
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

    public function getRequest(Request $request){
        $input = ['category_id' => $request->category_id];$with = ['getCity'];$order = ['id' => 'desc'];
        $records = $this->buRepo->getAllRecords($input,$with,$order);
        return view('backend.request.list',['records' => $records,'category_id' => $request->category_id]);
    }

    public function getRequestDetail(int $id){
        $input = ['id' => $id];$with = ['getDistrict','getCity','getRequestDetail','getCategory','getSubCategory'];
        $select = [];
        $aData = $this->buRepo->getSingleRecords($input,$select,$with);
        return view('backend.request.detail',['record' => $aData]);
    }
}
