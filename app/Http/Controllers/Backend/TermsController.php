<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Term;
class TermsController extends Controller
{
    protected $term;
    public function __construct(
        Term $term
         ){ 
             $this->term = $term;
    }
    public function updateTerm(Request $request){
        $this->sLable = 'Add City';
        $this->sAction = route('admin.term');
        $data = $this->term->first();
        if ($request->isMethod('post')) {
            if(empty($data)){
                $this->term->create(['description' => $request->description]);
            }
        } 
        return view('backend.term.create',['data' => $this,'record' => $data]); 
    }
}
