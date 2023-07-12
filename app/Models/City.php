<?php

namespace App\Models;

class City extends CustomModel
{
    protected $fillable = [
        'city_name','country_id','state_id','district_id'   
    ];
    public function getDistrict(){
        return $this->belongsTo(District::class,'district_id');
    }
}
