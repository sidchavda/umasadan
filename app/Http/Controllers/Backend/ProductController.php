<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\Product\ProductRepositoryInterface;
use App\Repositories\Interfaces\Category\SubCategoryRepositoryInterface;
use DB;
class ProductController extends Controller
{
    protected $productRepo;
    protected $subCategoryRepo;

    public function __construct(
        ProductRepositoryInterface $productRepo,
        SubCategoryRepositoryInterface $categoryRepo,
        ){ 
            $this->productRepo = $productRepo;
            $this->subCategoryRepo = $categoryRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->sLable = 'Add';
        $this->sAction = route('admin.product.create');
        $input = [];$with = ['getSubCategory:id,sub_cat_name'];$order = ['id' => 'desc'];
        $records = $this->productRepo->getAllRecords($input,$with,$order);
      
        return view('backend.product.list',['data' => $this,'records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->sLable = 'Add Product';
        $this->sAction = route('admin.product.store');
        $input = ['category_id' => 2];$with = [];$order = ['id' => 'desc'];$select = 'id,sub_cat_name';
        $categories = $this->subCategoryRepo->getAllRecords($input,$with,$order,[],false,$select);
        return view('backend.product.create',['data' => $this,'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',           
            'sub_category_id' => 'required|numeric'           
        ]);
        DB::beginTransaction();
        try{
            $data = $request->except('_token');
            $this->productRepo->create($data); 
            DB::commit(); 
            return redirect()->route('admin.product.index')->with('success',"Product has been added"); 
        }
        catch(\Exception $e){  
            dd($e);
            DB::rollback();
            return redirect()->route('admin.product.store')->with('error',"Something went wrong");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->sLable = 'Edit Product ';
        $this->sAction = route('admin.product.update',['product' => $id]);
        $record = $this->productRepo->getbyId($id); 
        $order =['id'=>'desc'];
        $category = $this->subCategoryRepo->getAllRecords([],[],$order);
        return view('backend.product.create',['data' => $this,'record' => $record,'categories' => $category]);
     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'product_name' => 'required',           
            'sub_category_id' => 'required|numeric'           
        ]);
        DB::beginTransaction();
        try{
            $data = $request->except(['_token','_method']);
            $this->productRepo->update($id,$data); 
            DB::commit();  
            return redirect()->route('admin.product.index')->with('success',"Product has been updated"); 
        }
        catch(\Exception $e){  
            DB::rollback();
            return redirect()->route('admin.product.update',['product' => $id])->with('error',"Something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try{
            $this->productRepo->delete($id);
            DB::commit(); 
            return redirect()->route('admin.product.index')->with('success',"Product has been deleted"); 
        }
        catch(\Exception $e){   
            DB::rollback();
            return redirect()->route('admin.product.index')->with('error',"Something went wrong");
        }  
    }
}
