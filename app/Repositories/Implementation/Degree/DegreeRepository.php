<?php

namespace App\Repositories\Implementation\Degree;

use App\Base\BaseRepository;
use App\Models\Degree;
use App\Repositories\Interfaces\Degree\DegreeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use DB;
use Datatables;
class DegreeRepository  extends BaseRepository implements DegreeRepositoryInterface
{
    /**
     * @var Degree
     */
    protected $degreeModel; 

    /**
     * DegreeRepository constructor.
     *
     * @param Degree $DegreeModel
     */
    public function __construct(Degree $degreeModel)
    {
        parent::__construct($degreeModel); 
        $this->degreeModelRepo = $degreeModel;
       
    }

    

    

}
?>