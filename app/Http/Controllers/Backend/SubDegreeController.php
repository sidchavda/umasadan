<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\Degree\DegreeRepositoryInterface;
use App\Repositories\Interfaces\Degree\SubDegreeRepositoryInterface;
use DB;
class SubDegreeController extends Controller
{
    protected $degreeRepo;
    protected $subDegreeRepo;
    public $sLable;
    public $sAction;

    public function __construct(
        DegreeRepositoryInterface $degreeRepo,SubDegreeRepositoryInterface $subDegreeRepo
        ){ 
            $this->degreeRepo = $degreeRepo;
            $this->subDegreeRepo = $subDegreeRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->sLable = 'Add';
        $this->sAction = route('admin.subdegree.create');
        $input = [];$with = ['getDegree:id,degree_name'];$order = ['id' => 'desc'];
        $records = $this->subDegreeRepo->getAllRecords($input,$with,$order);
      
        return view('backend.subdegree.list',['data' => $this,'records' => $records]);  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->sLable = 'Add SubDegree';
        $this->sAction = route('admin.subdegree.store');
        $input = [];$with = [];$order = ['id' => 'desc'];$select = 'id,degree_name';
        $degree = $this->degreeRepo->getAllRecords($input,$with,$order,[],false,$select);
        return view('backend.subdegree.create',['data' => $this,'degrees' => $degree]);
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'sub_degree_name' => 'required',           
            'degree_id' => 'required|numeric'           
        ]);
        DB::beginTransaction();
        try{
            $data = $request->except('_token');
            $this->subDegreeRepo->create($data); 
            DB::commit(); 
            return redirect()->route('admin.subdegree.index')->with('success',"SubDegree has been added"); 
        }
        catch(\Exception $e){  
            DB::rollback();
            return redirect()->route('admin.subdegree.store')->with('error',"Something went wrong");
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
        $this->sLable = 'Edit Sub Degree';
        $this->sAction = route('admin.subdegree.update',['subdegree' => $id]);
        $record = $this->subDegreeRepo->getbyId($id); 
        $order =['id'=>'desc'];
        $degree = $this->degreeRepo->getAllRecords([],[],$order);
        return view('backend.subdegree.create',['data' => $this,'record' => $record,'degrees' => $degree]);
     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'sub_degree_name' => 'required',           
            'degree_id' => 'required|numeric'           
        ]);
        DB::beginTransaction();
        try{
            $data = $request->except(['_token','_method']);
            $this->subDegreeRepo->update($id,$data); 
            DB::commit();  
            return redirect()->route('admin.subdegree.index')->with('success',"SubDegree has been updated"); 
        }
        catch(\Exception $e){  
            DB::rollback();
            return redirect()->route('admin.subdegree.update',['subdegree' => $id])->with('error',"Something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try{
            $this->subDegreeRepo->delete($id);
            DB::commit(); 
            return redirect()->route('admin.subdegree.index')->with('success',"SubDegree has been deleted"); 
        }
        catch(\Exception $e){   
            DB::rollback();
            return redirect()->route('admin.subdegree.index')->with('error',"Something went wrong");
        }    
    }
}
