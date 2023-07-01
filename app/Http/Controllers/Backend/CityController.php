<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\City\CityRepositoryInterface;
use App\Repositories\Interfaces\District\DistrictRepositoryInterface;
use DB;
class CityController extends Controller
{
    protected $cityRepo;
    public $sLable;
    public $sAction;

    public function __construct(
        CityRepositoryInterface $cityRepo,DistrictRepositoryInterface $districtRepo
        ){ 
            $this->cityRepo = $cityRepo;
            $this->districtRepo = $districtRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->sLable = 'Add';
        $this->sAction = route('admin.district.create');
        $input = [];$with = ['getDistrict:id,district_name'];$order = ['id' => 'desc'];
        $records = $this->cityRepo->getAllRecords($input,$with,$order);
      
        return view('backend.city.list',['data' => $this,'records' => $records]);  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->sLable = 'Add City';
        $this->sAction = route('admin.city.store');
        $input = [];$with = [];$order = ['id' => 'desc'];$select = 'id,district_name';
        $districts = $this->districtRepo->getAllRecords($input,$with,$order,[],false,$select);
        return view('backend.city.create',['data' => $this,'districts' => $districts]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'city_name' => 'required',           
            'district_id' => 'required|numeric'           
        ]);
        DB::beginTransaction();
        try{
            $data = $request->except('_token');
            $data['country_id'] = 1; $data['state_id'] = 1;
            $this->cityRepo->create($data); 
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
        $this->sLable = 'Edit City';
        $this->sAction = route('admin.city.update',['city' => $id]);
        $record = $this->cityRepo->getbyId($id); 
        $order =['id'=>'desc'];
        $districts = $this->districtRepo->getAllRecords([],[],$order);
        return view('backend.city.create',['data' => $this,'record' => $record,'districts' => $districts]);
     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'city_name' => 'required',           
            'district_id' => 'required|numeric'           
        ]);
        DB::beginTransaction();
        try{
            $data = $request->except(['_token','_method']);
            $this->cityRepo->update($id,$data); 
            DB::commit();  
            return redirect()->route('admin.city.index')->with('success',"City has been updated"); 
        }
        catch(\Exception $e){  
            DB::rollback();
            return redirect()->route('admin.city.store')->with('error',"Something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try{
            $this->cityRepo->delete($id);
            DB::commit(); 
            return redirect()->route('admin.city.index')->with('success',"City has been deleted"); 
        }
        catch(\Exception $e){  
            DB::rollback();
            return redirect()->route('admin.city.index')->with('error',"Something went wrong");
        }    
    }
}
