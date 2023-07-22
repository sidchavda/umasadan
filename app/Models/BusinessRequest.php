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
    
    protected $casts = [
        'present_address' => 'array'
    ];
    public function getDistrict(){
        return $this->belongsTo(District::class,'district_id');
    }
    public function getCity(){
        return $this->belongsTo(City::class,'city_id');
    }
    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }
    public function getRequestDetail(){
        return $this->hasOne(BusinessRequestDetail::class,'b_r_id'); 
    }
    public function getCategory(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function getSubCategory(){
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }
    
}
