<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Auth;
class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'sub_cat_name','category_id'   
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
    public function getCategory(){
       return  $this->belongsTo(Category::class,'category_id');
    }
}
