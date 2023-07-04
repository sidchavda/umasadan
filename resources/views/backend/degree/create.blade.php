@extends('backend.layouts.master') 
@section('content')
<div class="pcoded-inner-content">
   <div class="main-body">
      <div class="page-wrapper">
         <div class="page-header">
            <div class="row align-items-end">
               <div class="col-lg-8">
                  <div class="page-header-title">
                     <div class="d-inline">
                        <h4>Degree</h4>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="page-header-breadcrumb">
                     
                  </div>
               </div>
            </div>
         </div>
         <div class="page-body">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header">
                        <h5>{{$data->sLable}}</h5>
                        <div class="card-header-right">
                           <i class="icofont icofont-spinner-alt-5"></i>
                        </div>
                     </div>
                     <div class="card-block">
                        <form action="{{$data->sAction}}" method="post">
                            @csrf
                            @if(isset($record)) <input name="_method" type="hidden" value="PUT"> @endif
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Name *</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" name="degree_name" placeholder="Enter Degree name" value="@isset($record){{$record->degree_name}}@else{{old('degree_name')}}@endif" required>
                              </div>
                                @error('degree_name') 
                                    <div class="alert alert-danger">{{ $message }}</div> 
                                @enderror
                           </div>
                           <div class="form-group row col-md-3">
                                <button type="submit" class="btn btn-out btn-success btn-square">Submit</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="styleSelector"></div>
</div>
@endsection