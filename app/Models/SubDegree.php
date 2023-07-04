<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class SubDegree extends Model
{
    use HasFactory;
    protected $fillable = [
        'sub_degree_name' ,'degree_id'  
    ];
    
    
    public static  function boot()
    {
        parent::boot();
        // beforeCreate
        self::creating(function($model) {
            $model->create_by = Auth::user()->id;
            return true; 
        });  
        self::updating(function($model) { 
            $model->create_by = Auth::user()->id;
            return true; 
        }); 
    }

    public function getDegree(){
        return  $this->belongsTo(Degree::class,'degree_id');
     }
}
