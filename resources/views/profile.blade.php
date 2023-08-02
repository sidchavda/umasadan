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
                        <h4>User Profile</h4>
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
                        <h5>Profile</h5>
                        <div class="card-header-right">
                           <i class="icofont icofont-spinner-alt-5"></i>
                        </div>
                     </div>
                     <div class="card-block">
                        <form action="{{route('admin.profile')}}" method="post">
                            @csrf
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Name *</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" name="first_name" placeholder="Enter name" value="{{\Auth::user()->first_name}}" required>
                              </div>
                                @error('first_name') 
                                    <div class="alert alert-danger">{{ $message }}</div> 
                                @enderror
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Email *</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" name="email" placeholder="Enter email" value="{{\Auth::user()->email}}" required>
                              </div>
                                @error('email') 
                                    <div class="alert alert-danger">{{ $message }}</div> 
                                @enderror
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Change Password</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" name="password" placeholder="Enter password" value="">
                              </div>
                           </div>
                           <div class="form-group row col-md-3">
                                <button type="submit" class="btn btn-out btn-success btn-square">Update</button>
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