<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\User\UserRepositoryInterface;

class UserController extends Controller
{
    protected $userRepo;
    public function __construct(UserRepositoryInterface $userRepo){
        $this->userRepo = $userRepo; 
    }
    
    public function index() { 
        $records = $this->userRepo->getRolebasedUsers();
        return view('backend.user.list',['records' => $records]);
    }

    public function detail(int $id){
        $with = ['getAddress.getDistrict','getAddress.getCity']; 
        $record = $this->userRepo->getById($id,$with);
        
        return view('backend.user.detail',['record' => $record]);
    }
}
