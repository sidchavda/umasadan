<?php

namespace App\Repositories\Implementation\District;

use App\Base\BaseRepository;
use App\Models\District;
use App\Repositories\Interfaces\District\DistrictRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use DB;
use Datatables;
class DistrictRepository  extends BaseRepository implements DistrictRepositoryInterface
{
    /**
     * @var District
     */
    protected $districtModel; 

    /**
     * BlogRepository constructor.
     *
     * @param District $districtModel
     */
    public function __construct(District $districtModel)
    {
        parent::__construct($districtModel);
        $this->districtModelRepo = $districtModel;
    }

}
?>