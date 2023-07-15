<?php

namespace App\Models;

class Degree extends CustomModel
{
    protected $fillable = [
        'degree_name'   
    ];
    public function getSubDegree(){ 
        return $this->hasMany(SubDegree::class,'id');
    }
}
