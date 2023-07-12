<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\District;
use App\Models\City;

class BusinessRequest extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function getDistrict(){
        return $this->belongsTo(District::class,'district_id');
    }
    public function getCity(){
        return $this->belongsTo(City::class,'city_id');
    }
}
