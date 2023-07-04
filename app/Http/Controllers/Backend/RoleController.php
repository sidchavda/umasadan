<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
class RoleController extends Controller
{
   
    public $sLable;
    public $sAction;
    
    /**
     * Role Construct 
     *  
     */
    public function __construct(){

        // $this->middleware('permission:role-list', ['only' => ['index','show']]);
        // $this->middleware('permission:role-create', ['only' => ['create','store']]);
        // $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:role-delete', ['only' => ['delete']]); 

        
    } 

    /**
     * Role List
     * @return View
     */
    public function index(){
        $this->sLable = 'Add';
        $this->sAction = route('admin.role.create');

        $roles = Role::with('permissions:name')->where('name','!=','Super-Admin')
        ->where('name','!=','User')->orderBy('id','ASC')->get();
        return view('backend.roles.list',['data' => $this,'records'=>$roles]); 
    }

    /**
     * Add Role View
     * @return View
     */
    public function create(){
        $this->sLable = 'Add Role';
        $this->sAction = route('admin.role.store');

        $permission = Permission::get();
        return view('backend.roles.create',['data' => $this,'permission'=>$permission]); 
    }
    /**
     * Store Role
     * @param Request $request
     * @thorw exception
     * @return Route
     */
    public function store(Request $request){ 
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        DB::beginTransaction();
        try{
            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permission'));
            DB::commit();
            return redirect()->route('admin.role.index')->with('success',"Role has been added"); 
        }catch(\Exception $e){
            DB::rollback(); 
            return redirect()->route('admin.role.store')->with('error',"Something went wrong");
        }
     
    }

    /**
     * Get Particular Role
     * @param int $id (Role Id) Request $request
     * @return View
     */
    public function edit($id = ''){
        $role = Role::find($id);
        $permission = Permission::get();
        $this->sLable = 'Edit Role';
        $this->sAction = route('admin.role.update',['role' => $id]); 
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('backend.roles.create',['role' => $role,'permission' => $permission,'rolePermissions' => $rolePermissions,'data' => $this]);  
    }

     /**
     * Update Role
     * @param Request $request
     * @thorw exception
     * @return Route
     */
    public function update(Request $request, $id) 
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name,'.$id,
            'permission' => 'required',
        ]);
        DB::beginTransaction();
        try{
            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->save();
            $role->syncPermissions($request->input('permission')); 
            DB::commit();
            return redirect()->route('admin.role.index')->with('success',"Role has been updated"); 
        }catch(\Exception $e){ 
            DB::rollback(); 
            return redirect()->route('admin.role.store')->with('error',"Something went wrong");
        }
    }

    /**
     * Delete Role
     * @param int $id (Role Id)
     * @return Route
     */
    public function delete($id){ 
        $role = Role::where('id',$id)->first();
        $role->delete();
        DB::table("role_has_permissions")->where('role_id',$id)->delete();
        Session::flash('success', trans('messages.delete_records'));
        
        ## Store log
        $message = trans('messages.role_delete',['name' => $role->name]);
        storeActicityLog(trans('messages.delete'),$message,Auth::user(),$role);

        return redirect()->route('role.index');
    }
}
