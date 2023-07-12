<?php

namespace App\Models;

class SubDegree extends CustomModel
{
    protected $fillable = [
        'sub_degree_name' ,'degree_id'  
    ];
    
    public function getDegree(){
        return  $this->belongsTo(Degree::class,'degree_id');
     }
}
