<?php

namespace App\Repositories\Implementation\Category;

use App\Base\BaseRepository;
use App\Models\Category;
use App\Repositories\Interfaces\Category\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use DB;
use Datatables;
class CategoryRepository  extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * @var Category
     */
    protected $categoryModel; 

    /**
     * CategoryRepository constructor.
     *
     * @param Category $CategoryModel
     */
    public function __construct(Category $categoryModel)
    {
        parent::__construct($categoryModel); 
        $this->categoryModelRepo = $categoryModel;
    }

    

}
?>