<?php

namespace App\Models;
use App\Models\Category;
class SubCategory extends CustomModel
{
    protected $fillable = [
        'sub_cat_name','category_id'   
    ];
    public function getCategory(){
       return  $this->belongsTo(Category::class,'category_id');
    }
}
