<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\Business\BusinessRepositoryInterface;
use Auth;
use App\Repositories\Interfaces\User\UserRepositoryInterface;
use Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $buRepo;

    public function __construct(BusinessRepositoryInterface $buRepository,UserRepositoryInterface $userRepo)
    {
        $this->buRepo = $buRepository;
        $this->userRepo = $userRepo; 
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];
        //For company
        $where = ['category_id' => 1];
        $data['company'] = $this->buRepo->getDataCount($where);

        //For Gruhudhyog
        $where = ['category_id' => 2];
        $data['gruhudhyog'] = $this->buRepo->getDataCount($where);

        //For Medical
        $where = ['category_id' => 4];
        $data['medical'] = $this->buRepo->getDataCount($where);

        //For Technician
        $where = ['category_id' => 3];
        $data['technician'] = $this->buRepo->getDataCount($where);

        return view('home',compact('data'));
    }
    public function profile(Request $request){
        return view('profile');
    }
    public function updateProfile(Request $request){
        $userId = Auth::user()->id;
        $this->validate($request, [
            'email' => 'required|email|unique:users,email,'.$userId,           
        ]);
        $data = ['first_name' => $request->first_name,'email' => $request->email];
        if($request->password){
            $data['password'] = Hash::make($request->password); 
        }
        $this->userRepo->update($userId,$data);
        return redirect()->route('admin.profile')->with('success',"Profile has been updated");
    }
}
