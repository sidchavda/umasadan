<?php

namespace App\Models;

use App\Models\Product;

class Product extends CustomModel
{
    
    protected $fillable = [
        'product_name','sub_category_id','create_by'   
    ];
    public function getSubCategory(){
        return  $this->belongsTo(SubCategory::class,'sub_category_id');
     }
}
