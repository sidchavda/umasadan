<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\Degree\DegreeRepositoryInterface;
use DB;

class DegreeController extends Controller
{
    protected $DegreeRepo;
    public $sLable;
    public $sAction;

    public function __construct(
       DegreeRepositoryInterface $DegreeRepo
        ){ 
            $this->DegreeRepo = $DegreeRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        $this->sLable = 'Add';
        $this->sAction = route('admin.degree.create');
        $input = [];$with = [];$order = ['id' => 'desc'];
        $records = $this->DegreeRepo->getAllRecords($input,$with,$order);
        return view('backend.degree.list',['data' => $this,'records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->sLable = 'Add Degree';
        $this->sAction = route('admin.degree.store');
        $input = [];$with = [];$order = ['id' => 'desc'];
        return view('backend.Degree.create',['data' => $this]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'degree_name' => 'required',           
        ]);
        DB::beginTransaction();
        try{
            $data = $request->except('_token');
            $this->DegreeRepo->create($data); 
            DB::commit(); 
            return redirect()->route('admin.degree.index')->with('success',"Degree has been added"); 
        }
        catch(\Exception $e){  
            DB::rollback();
            return redirect()->route('admin.degree.store')->with('error',"Something went wrong");
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
        $this->sLable = 'Edit Degree';
        $this->sAction = route('admin.degree.update',['degree' => $id]);
        $record = $this->DegreeRepo->getbyId($id); 
        $order =['id'=>'desc'];
        return view('backend.degree.create',['data' => $this,'record' => $record]);
     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'degree_name' => 'required'       
        ]);
        DB::beginTransaction();
        try{
            $data = $request->except(['_token','_method']);
            $this->DegreeRepo->update($id,$data); 
            DB::commit();  
            return redirect()->route('admin.degree.index')->with('success',"Degree has been updated"); 
        }
        catch(\Exception $e){  
            DB::rollback();
            return redirect()->route('admin.degree.update',['Degree' => $id])->with('error',"Something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try{
            $this->DegreeRepo->delete($id);
            DB::commit(); 
            return redirect()->route('admin.degree.index')->with('success',"Degree has been deleted"); 
        }
        catch(\Exception $e){  
            DB::rollback();
            return redirect()->route('admin.degree.index')->with('error',"Something went wrong");
        }
    }
}
