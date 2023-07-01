<?php

namespace App\Repositories\Implementation\City;

use App\Base\BaseRepository;
use App\Models\City;
use App\Repositories\Interfaces\City\CityRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use DB;
use Datatables;
class CityRepository  extends BaseRepository implements CityRepositoryInterface
{
    /**
     * @var City
     */
    protected $cityModel; 

    /**
     * CityRepository constructor.
     *
     * @param City $cityModel
     */
    public function __construct(City $cityModel)
    {
        parent::__construct($cityModel);
        $this->cityModelRepo = $cityModel;
    }

}
?>