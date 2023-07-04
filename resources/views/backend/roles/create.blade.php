@extends('backend.layouts.master') 
@push('css')
<link rel="stylesheet" href="{{asset('files/bower_components/select2/dist/css/select2.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('files/bower_components/bootstrap-multiselect/dist/css/bootstrap-multiselect.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('files/bower_components/multiselect/css/multi-select.css')}}" />
@endpush
@section('content')
<div class="pcoded-inner-content"> 
   <div class="main-body">
      <div class="page-wrapper">
         <div class="page-header">
            <div class="row align-items-end">
               <div class="col-lg-8">
                  <div class="page-header-title">
                     <div class="d-inline">
                        <h4>Roles</h4>
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
                            @if(isset($role)) <input name="_method" type="hidden" value="PUT"> @endif
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Name *</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" name="name" placeholder="Enter role name" value="@isset($role){{$role->name}}@else{{old('name')}}@endif" required>
                              </div>
                                @error('name') 
                                    <div class="alert alert-danger">{{ $message }}</div> 
                                @enderror
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Permissions *</label>
                              <div class="col-sm-10">
                                 <select class="js-example-basic-multiple col-sm-12" multiple="multiple" name="permission[]">
                                    @foreach($permission as $value)
                                    <option value="{{$value->id}}" @if(!empty($rolePermissions) && in_array($value->id, $rolePermissions)) selected @endif >{!!convert_permission_name($value->name)!!}</option>
                                    @endforeach
                                 </select> 
                              </div> 
                                @error('permission') 
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
@push('js')
<script type="text/javascript" src="{{asset('files/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script type="text/javascript" src="{{asset('files/bower_components/bootstrap-multiselect/dist/js/bootstrap-multiselect.js')}}"></script>
<script type="text/javascript" src="{{asset('files/bower_components/multiselect/js/jquery.multi-select.js')}}"></script>
<script type="text/javascript" src="{{asset('files/assets/pages/advance-elements/select2-custom.js')}}"></script>
@endpush