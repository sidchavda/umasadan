<?php

namespace App\Models;

class Category extends CustomModel
{
    protected $fillable = [
        'cat_name'   
    ];

    public function getSubCategory(){ 
        return $this->hasMany(SubCategory::class,'id');
    }
    
}
