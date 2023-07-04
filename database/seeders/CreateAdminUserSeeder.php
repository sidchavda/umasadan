<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Hash;
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
        	'name' => 'SuperAdmin', 
        	'email' => 'superadmin@gmail.com',
        	'password' =>  Hash::make('12345678')
        ]); 
  
        $role = Role::create(['name' => 'Super-Admin']);
        $userRole = Role::create(['name' => 'Mobile-User']);
   
        $permissions = Permission::pluck('id','id')->all();
  
        $role->syncPermissions($permissions);
        // $userRole->syncPermissions(['9' =>'9']); 
        $user->assignRole([$role->id]); 
    }
}
