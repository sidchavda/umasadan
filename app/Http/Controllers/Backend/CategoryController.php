<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\Category\CategoryRepositoryInterface;
use DB;

class CategoryController extends Controller
{
    protected $categoryRepo;
    public $sLable;
    public $sAction;

    public function __construct(
       CategoryRepositoryInterface $categoryRepo
        ){ 
            $this->categoryRepo = $categoryRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        $this->sLable = 'Add';
        $this->sAction = route('admin.category.create');
        $input = [];$with = [];$order = ['id' => 'desc'];
        $records = $this->categoryRepo->getAllRecords($input,$with,$order);
        return view('backend.category.list',['data' => $this,'records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->sLable = 'Add Category';
        $this->sAction = route('admin.category.store');
        $input = [];$with = [];$order = ['id' => 'desc'];
        return view('backend.category.create',['data' => $this]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'cat_name' => 'required',           
        ]);
        DB::beginTransaction();
        try{
            $data = $request->except('_token');
            $this->categoryRepo->create($data); 
            DB::commit(); 
            return redirect()->route('admin.category.index')->with('success',"Category has been added"); 
        }
        catch(\Exception $e){  
            DB::rollback();
            return redirect()->route('admin.category.store')->with('error',"Something went wrong");
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
        $this->sLable = 'Edit Category';
        $this->sAction = route('admin.category.update',['category' => $id]);
        $record = $this->categoryRepo->getbyId($id); 
        $order =['id'=>'desc'];
        return view('backend.category.create',['data' => $this,'record' => $record]);
     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'cat_name' => 'required'       
        ]);
        DB::beginTransaction();
        try{
            $data = $request->except(['_token','_method']);
            $this->categoryRepo->update($id,$data); 
            DB::commit();  
            return redirect()->route('admin.category.index')->with('success',"Category has been updated"); 
        }
        catch(\Exception $e){  
            DB::rollback();
            return redirect()->route('admin.category.update',['category' => $id])->with('error',"Something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try{
            $this->categoryRepo->delete($id);
            DB::commit(); 
            return redirect()->route('admin.category.index')->with('success',"Category has been deleted"); 
        }
        catch(\Exception $e){  
            DB::rollback();
            return redirect()->route('admin.category.index')->with('error',"Something went wrong");
        }
    }
}
