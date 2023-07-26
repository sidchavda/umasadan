<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\City;
use App\Repositories\Interfaces\Category\CategoryRepositoryInterface;
use App\Repositories\Interfaces\Category\SubCategoryRepositoryInterface;
use App\Repositories\Interfaces\Degree\DegreeRepositoryInterface;
use App\Repositories\Interfaces\Degree\SubDegreeRepositoryInterface;
use App\Repositories\Interfaces\Product\ProductRepositoryInterface;
class GeneralController extends BaseController
{
    protected $subDegreeRepo;
    protected $degreeRepo;
    protected $district;
    protected $city;
    protected $productRepo;
    public function __construct(
        District $district,
        City $city,
        CategoryRepositoryInterface $categoryRepo,
        SubCategoryRepositoryInterface $subCategoryRepo,
        DegreeRepositoryInterface $degreeRepo,
        SubDegreeRepositoryInterface $subDegreeRepo,
        ProductRepositoryInterface $productRepo
        
        )
    {
        $this->district = $district;
        $this->city = $city;
        $this->categoryRepo = $categoryRepo;
        $this->subCategoryRepo = $subCategoryRepo;
        $this->degreeRepo = $degreeRepo; 
        $this->subDegreeRepo = $subDegreeRepo;
        $this->productRepo = $productRepo;
    }

    public function getDistrict(){ 
        $districts = $this->district->all();
        if($districts->count() > 0){
            return $this->sendResponse($districts,trans('messages.records_found'),200);
        }else{
            return  $this->sendError([],trans('messages.records_not_found'),config('constants.status_code.not_found'));  
        }
    }

    public function getCity(Request $request){  
        $city = $this->city->where(function($query) use ($request){
            if(!empty($request->district_id)){
                $query->where('district_id',$request->district_id);
            }
        })->get();
        if($city->count() > 0){ 
            return $this->sendResponse($city,trans('messages.records_found'),200);
        }else{
            return  $this->sendError([],trans('messages.records_not_found'),config('constants.status_code.not_found'));  
        }
    }

    public function getCategory(){ 
        $input = [];$with = ['getSubCategory:id'];$order = ['id' => 'desc'];$select = 'id,cat_name';
        $categories = $this->categoryRepo->getAllRecords($input,$with,$order,[],false,$select);
        $categories->each(function ($category) {
            $category->is_subcategory = $category->getSubCategory->isNotEmpty();
        });
        if($categories->count() > 0){
            return $this->sendResponse($categories,trans('messages.records_found'),200);
        }else{
            return  $this->sendError([],trans('messages.records_not_found'),config('constants.status_code.not_found'));  
        }
    }

    public function getSubCategory(Request $request){  
        $input = ['category_id' => $request->category_id];
        $with = [];$order = ['id' => 'desc'];$select = 'id,sub_cat_name,category_id';
        $subCategories = $this->subCategoryRepo->getAllRecords($input,$with,$order,[],false,$select);
      
        if($subCategories->count() > 0){ 
            return $this->sendResponse($subCategories,trans('messages.records_found'),200);
        }else{
            return  $this->sendError([],trans('messages.records_not_found'),config('constants.status_code.not_found'));  
        }
    }

    public function getDegree(){ 
        $input = [];$with = ['getSubDegree'];$order = ['id' => 'desc'];$select = 'id,degree_name';
        $degrees = $this->degreeRepo->getAllRecords($input,$with,$order,[],false,$select);
        $degrees->each(function ($degree) {
            $degree->is_subdegree = $degree->getSubDegree->isNotEmpty();
        });
        if($degrees->count() > 0){
            return $this->sendResponse($degrees,trans('messages.records_found'),200);
        }else{
            return  $this->sendError([],trans('messages.records_not_found'),config('constants.status_code.not_found'));  
        }
    }

    public function getSubDegree(Request $request){  
        $input = ['degree_id' => $request->degree_id];
        $with = [];$order = ['id' => 'desc'];$select = 'id,sub_degree_name,degree_id';
        $subDegrees = $this->subDegreeRepo->getAllRecords($input,$with,$order,[],false,$select);
      
        if($subDegrees->count() > 0){ 
            return $this->sendResponse($subDegrees,trans('messages.records_found'),200);
        }else{
            return  $this->sendError([],trans('messages.records_not_found'),config('constants.status_code.not_found'));  
        }
    }

    public function getProducts(Request $request){   
        $input = ['sub_category_id' => $request->sub_category_id];
        $with = [];$order = ['id' => 'desc'];$select = 'id,product_name,sub_category_id';
        $products = $this->productRepo->getAllRecords($input,$with,$order,[],false,$select);
      
        if($products->count() > 0){ 
            return $this->sendResponse($products,trans('messages.records_found'),200);
        }else{
            return  $this->sendError([],trans('messages.records_not_found'),config('constants.status_code.not_found'));  
        }
    }
}
