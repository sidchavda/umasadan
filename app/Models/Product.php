<?php

namespace App\Models;

use App\Models\Product;

class Product extends CustomModel
{
    
    protected $fillable = [
        'product_name','category_id','create_by'   
    ];
    public function getCategory(){
        return  $this->belongsTo(Category::class,'category_id');
     }
}
