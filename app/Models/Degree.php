<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Degree extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'degree_name'   
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
}
