<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\Business\BusinessRepositoryInterface;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $buRepo;

    public function __construct(BusinessRepositoryInterface $buRepository)
    {
        $this->buRepo = $buRepository;
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

        //For Medical
        $where = ['category_id' => 4];
        $data['medical'] = $this->buRepo->getDataCount($where);

        //For Technician
        $where = ['category_id' => 3];
        $data['technician'] = $this->buRepo->getDataCount($where);

        return view('home',compact('data'));
    }
}
