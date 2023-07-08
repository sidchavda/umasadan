<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id','sub_category_id','business_name','email','mobile_number','district_id',
        'city_id','present_address','status','searchable_address'  
    ]; 
}
