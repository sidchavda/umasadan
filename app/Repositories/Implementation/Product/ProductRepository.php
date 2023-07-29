<?php

namespace App\Repositories\Implementation\Product;

use App\Base\BaseRepository;
use App\Models\Product;
use App\Repositories\Interfaces\Product\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use DB;
use Datatables;
class ProductRepository  extends BaseRepository implements ProductRepositoryInterface
{
    /**
     * @var Product
     */
    protected $productModelRepo; 

    /**
     * ProductRepository constructor.
     *
     * @param Product $ProductModel
     */
    public function __construct(Product $productModel)
    {
        parent::__construct($productModel);
        $this->productModelRepo = $productModel;
    }
    public function getMultipleRecords(array $data){
        return $this->productModelRepo->select('id','product_name')->whereIn('id',$data)->get()->toArray();
       
    }
}
?>