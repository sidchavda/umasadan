<?php

namespace App\Repositories\Implementation\Category;

use App\Base\BaseRepository;
use App\Models\SubCategory;
use App\Repositories\Interfaces\Category\SubCategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use DB;
use Datatables;
class SubCategoryRepository  extends BaseRepository implements SubCategoryRepositoryInterface
{
    /**
     * @var SubCategory 
     */
    protected $subCategoryModel; 

    /**
     * SubCategoryRepository constructor.
     *
     * @param SubCategory $SubCategoryModel
     */
    public function __construct(SubCategory $subCategoryModel)
    {
        parent::__construct($subCategoryModel); 
        $this->subCategoryModelRepo = $subCategoryModel;
    } 

    public function getMultipleRecords(array $data){
        return $this->subCategoryModelRepo->select('id','sub_cat_name')->whereIn('id',$data)->get()->toArray();
       
    }

}
?>