<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BusinessRequest;
class BusinessRequestDetail extends Model
{
    use HasFactory;
    protected $guarded = []; 

    protected $casts = [
        'sub_degree_id' => 'array'
    ];
    public function getMainRequest(){ 
        return $this->belongsTo(BusinessRequest::class,'b_r_id','id');
    }
    public function getDegree(){
        return $this->belongsTo(Degree::class,'degree_id');
    }
}
