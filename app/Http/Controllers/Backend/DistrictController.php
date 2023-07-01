<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Repositories\Interfaces\District\DistrictRepositoryInterface;
class DistrictController extends Controller
{
    protected $districtRepo;
    public $sLable;
    public $sAction;

    public function __construct(
        DistrictRepositoryInterface $districtRepo
        ){ 
            $this->districtRepo = $districtRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->sLable = 'Add';
        $this->sAction = route('admin.district.create');
        $input = [];$with = [];$order = ['id' => 'desc']; 
        $records = $this->districtRepo->getAllRecords($input,$with,$order);
        return view('backend.district.list',['data' => $this,'records' => $records]); 
    }  

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->sLable = 'Add District';
        $this->sAction = route('admin.district.store');
        return view('backend.district.create',['data' => $this]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $this->validate($request, [
            'district_name' => 'required'           
        ]);
        DB::beginTransaction();
        try{
            $data = $request->except('_token');
            $data['country_id'] = 1; $data['state_id'] = 1;
            $this->districtRepo->create($data); 
            DB::commit(); 
            return redirect()->route('admin.district.index')->with('success',"District has been added"); 
        }
        catch(\Exception $e){  
            DB::rollback();
            return redirect()->route('admin.district.store')->with('error',"Something went wrong");
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
        $this->sLable = 'Edit District';
        $this->sAction = route('admin.district.update',['district' => $id]);
        $record = $this->districtRepo->getbyId($id); 
        return view('backend.district.create',['data' => $this,'record' => $record]);
     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'district_name' => 'required'           
        ]);
        DB::beginTransaction();
        try{
            $data = $request->except(['_token','_method']);
            $this->districtRepo->update($id,$data); 
            DB::commit(); 
            return redirect()->route('admin.district.index')->with('success',"District has been updated"); 
        }
        catch(\Exception $e){  
            DB::rollback();
            return redirect()->route('admin.district.index')->with('error',"Something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try{
            $this->districtRepo->delete($id);
            DB::commit(); 
            return redirect()->route('admin.district.index')->with('success',"District has been deleted"); 
        }
        catch(\Exception $e){  
            DB::rollback();
            return redirect()->route('admin.district.store')->with('error',"Something went wrong");
        }    
    }
}
