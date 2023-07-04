<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\Category\CategoryRepositoryInterface;
use App\Repositories\Interfaces\Category\SubCategoryRepositoryInterface;
use DB;
class SubCategoryController extends Controller
{
    protected $categoryRepo;
    protected $subCategoryRepo;
    public $sLable;
    public $sAction;

    public function __construct(
        CategoryRepositoryInterface $categoryRepo,SubCategoryRepositoryInterface $subCategoryRepo
        ){ 
            $this->categoryRepo = $categoryRepo;
            $this->subCategoryRepo = $subCategoryRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->sLable = 'Add';
        $this->sAction = route('admin.subcategory.create');
        $input = [];$with = ['getCategory:id,cat_name'];$order = ['id' => 'desc'];
        $records = $this->subCategoryRepo->getAllRecords($input,$with,$order);
      
        return view('backend.subcategory.list',['data' => $this,'records' => $records]);  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->sLable = 'Add SubCategory';
        $this->sAction = route('admin.subcategory.store');
        $input = [];$with = [];$order = ['id' => 'desc'];$select = 'id,cat_name';
        $category = $this->categoryRepo->getAllRecords($input,$with,$order,[],false,$select);
        return view('backend.subcategory.create',['data' => $this,'categories' => $category]);
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'sub_cat_name' => 'required',           
            'category_id' => 'required|numeric'           
        ]);
        DB::beginTransaction();
        try{
            $data = $request->except('_token');
            $this->subCategoryRepo->create($data); 
            DB::commit(); 
            return redirect()->route('admin.subcategory.index')->with('success',"Subcategory has been added"); 
        }
        catch(\Exception $e){  
            DB::rollback();
            return redirect()->route('admin.subcategory.store')->with('error',"Something went wrong");
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
        $this->sLable = 'Edit Sub Category';
        $this->sAction = route('admin.subcategory.update',['subcategory' => $id]);
        $record = $this->subCategoryRepo->getbyId($id); 
        $order =['id'=>'desc'];
        $category = $this->categoryRepo->getAllRecords([],[],$order);
        return view('backend.subcategory.create',['data' => $this,'record' => $record,'categories' => $category]);
     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'sub_cat_name' => 'required',           
            'category_id' => 'required|numeric'           
        ]);
        DB::beginTransaction();
        try{
            $data = $request->except(['_token','_method']);
            $this->subCategoryRepo->update($id,$data); 
            DB::commit();  
            return redirect()->route('admin.subcategory.index')->with('success',"Subcategory has been updated"); 
        }
        catch(\Exception $e){  
            DB::rollback();
            return redirect()->route('admin.subcategory.update',['subcategory' => $id])->with('error',"Something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try{
            $this->subCategoryRepo->delete($id);
            DB::commit(); 
            return redirect()->route('admin.subcategory.index')->with('success',"Subcategory has been deleted"); 
        }
        catch(\Exception $e){   
            DB::rollback();
            return redirect()->route('admin.subcategory.index')->with('error',"Something went wrong");
        }    
    }
}
