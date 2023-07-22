<?php

namespace App\Repositories\Implementation\Degree;

use App\Base\BaseRepository;
use App\Models\SubDegree;
use App\Repositories\Interfaces\Degree\SubDegreeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use DB;
use Datatables;
class SubDegreeRepository  extends BaseRepository implements SubDegreeRepositoryInterface
{
    /**
     * @var SubDegree 
     */
    protected $subDegreeModel;  

    /**
     * SubDegreeRepository constructor.
     *
     * @param subDegree $SubDegreeModel
     */
    public function __construct(SubDegree $subDegreeModel)
    {
        parent::__construct($subDegreeModel); 
        $this->subDegreeModelRepo = $subDegreeModel;
    } 

    public function getMultipleRecords(array $data){
        return $this->subDegreeModelRepo->select('id','sub_degree_name')->whereIn('id',$data)->get()->toArray();
       
    }

}
?>