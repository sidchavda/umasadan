<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\District;
use App\Models\City;
class UserAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'present_address',
        'permanent_address',
        'addhar_no'        
    ];

    protected $appends = ['pr_address','pe_address'];

    public function getPrAddressAttribute()
    {
        return json_decode($this['present_address']);
    }
    public function getPeAddressAttribute() 
    {
        return json_decode($this['permanent_address']);
    }

    public function getDistrict(){
        return $this->belongsTo(District::class,'district_id');
    }
    public function getCity(){
        return $this->belongsTo(City::class,'city_id');
    }  
}
