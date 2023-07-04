<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'district_id',
        'city_id',
        'present_address',
        'permanent_address',
        'addhar_no'        
    ]; 
}
