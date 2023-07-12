<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class CustomModel extends Model
{
    use HasFactory;
    
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