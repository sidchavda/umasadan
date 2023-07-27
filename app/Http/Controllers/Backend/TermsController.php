<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Term;
use App\Models\Service;
class TermsController extends Controller
{
    protected $term;
    protected $service;
    public function __construct(
        Term $term,Service $service
         ){ 
            $this->term = $term;
            $this->service = $service;
    }
    public function updateTerm(Request $request){
        $this->sLable = 'Add Term';
        $this->sAction = route('admin.term');
        $data = $this->term->first();
        if ($request->isMethod('post')) {
            if(empty($data)){
                $this->term->create(['description' => $request->description]);
            }else{
                $data->description = $request->description;
                $data->save();
            }
        } 
        return view('backend.term.create',['data' => $this,'record' => $data]); 
    }
    public function updateService(Request $request){
        $this->sLable = 'Add Service'; 
        $this->sAction = route('admin.service');
        $data = $this->service->first();
        if ($request->isMethod('post')) {
            if(empty($data)){
                $this->service->create(['description' => $request->description]);
            }else{
                $data->description = $request->description;
                $data->save();
            }
        } 
        return view('backend.service.create',['data' => $this,'record' => $data]); 
    }
}
