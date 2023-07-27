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
                        <h4>Services</h4>
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
                        <h5></h5>
                        <div class="card-header-right">
                           <i class="icofont icofont-spinner-alt-5"></i>
                        </div>
                     </div>
                     <div class="card-block">
                        <form action="{{$data->sAction}}" method="post">
                            @csrf
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Description *</label>
                              <div class="col-sm-10">
                              <textarea class="tinymce-editor" name="description">@if(isset($record)) {{$record->description}}@else{{old('description')}}@endif</textarea>  
                              </div>
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
<script src="{{asset('files/assets/tinymce/tinymce.min.js')}}"></script>
<script>
tinymce.init({
  selector: 'textarea',  // change this value according to your HTML
  max_height: 1000
});
</script>
@endsection