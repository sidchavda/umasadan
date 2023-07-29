@extends('backend.layouts.master') 
@section('content')
<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>
<div class="pcoded-inner-content">
   <div class="main-body">
      <div class="page-wrapper">
         <div class="page-header">
            <div class="row">
               <div class="col-sm-12">
                  @include('backend.layouts.message')
                  <div class="card">
                     <div class="card-header">
                        <h5><b>Status:</b>
                        @php $class = ''; @endphp 
                        @if($record->status === 'Pending')
                        @php $class = 'badge badge-warning'; @endphp
                        @elseif($record->status === 'Accept')
                        @php $class = 'badge badge-success'; @endphp
                        @elseif($record->status === 'Reject')
                        @php $class = 'badge badge-danger'; @endphp
                        @endif 
                        
                        <span class="{{$class}}" style="color:white">{{$record->status}}</span></h5>
                        <div class="status pull-right">
                        @if(in_array($record->status,['Pending','Reject']))
                        <a onclick="return confirm('Are you sure want to change?');" href="{{route('admin.request.detail',['id' => $record->id])}}?status=1" class="btn btn-primary">Accept</a>
                        @endif
                        @if(in_array($record->status,['pending','Accept']))
                        <a onclick="return confirm('Are you sure want to change?');" href="{{route('admin.request.detail',['id' => $record->id])}}?status=2" class="btn btn-danger">Reject</a>
                        @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="page-body">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     @isset($record->getCreatedUser)
                     <div class="card-header">
                        <center>
                           <h5><b>Basic Detail (Request(Job) Owner Detail)</b></h5>
                        </center>
                        <br><br>
                        <h5><b>Full Name</b> : {{$record->getCreatedUser->full_name}}</h5>
                        <br><br>
                        <h5><b>Mobile</b> : {{$record->getCreatedUser->mobile_number}}</h5>
                        <br><br>
                        <h5><b>Email</b> : {{$record->getCreatedUser->email}}</h5>
                        <br><br>
                        <h5><b>Gender</b> : {{$record->getCreatedUser->gender}}</h5>
                     </div>
                     @endisset
                  </div>
                  <div class="card">
                     <div class="card-header">
                        <center>
                           <h5><b>Request Company Detail</b></h5> 
                        </center>
                        <br><br>
                        <h5><b>Company Name</b> : {{$record->business_name}}</h5>
                        <br><br>
                        <h5><b>Comapany Address</b> : {{$record->searchable_address}}</h5>
                        <br><br>
                        <h5><b>Degree</b> : {{$record->getRequestDetail->getDegree->degree_name}}</h5>
                        <br><br>
                        <h5><b>Sub Degree</b> : @isset($record->get_sub_degree) {{implode(',',$record->get_sub_degree)}} @endisset</h5>
                        <br><br>
                        <h5><b>Section</b> : {{$record->getRequestDetail->section}}</h5>
                        <br><br>
                        <h5><b>Job Day Type</b> : {{ucfirst($record->getRequestDetail->job_day_type)}}</h5>
                        <br><br>
                        <h5><b>Shift</b> : {{ucfirst($record->getRequestDetail->shift)}}</h5>
                        <br><br>
                        <h5><b>Working Platform</b> : {{ucfirst($record->getRequestDetail->work_platform)}}</h5>
                        <br><br>
                        <h5><b>Working Hours</b> : {{$record->getRequestDetail->working_hours}}</h5>
                        <br><br>
                        <h5><b>Experience Year</b> : {{$record->getRequestDetail->experience_year}}</h5>
                        <br><br>
                     </div>
                  </div>
                  @if($record->category_id != 1)
                  <div class="card">
                     <div class="card-header">
                        <center>
                           <h5><b>Products & Delievery</b></h5>
                        </center>
                        <br><br>
                        <h5><b>Delivery Type</b> : {{ucfirst($record->getRequestDetail->delivery_type)}}</h5><br><br>
                        @isset($record->products)
                           @foreach($record->products as $value)
                           <h5><b>Product {{$loop->iteration}} </b> : {{$value}}</h5><br>
                           @endforeach
                        @endisset
                     </div>
                  </div>
                  @endif 

                  <div class="card">
                     <div class="card-header">
                        <center>
                           <h5><b>Description</b></h5>
                        </center>
                        <br><br>
                        <h5><b>Description</b> : {{ucfirst($record->getRequestDetail->description)}}</h5><br><br>
                     </div>
                  </div>
                  @if(file_exists(public_path('/').'upload/proof/'.$record->getRequestDetail->id_proof) && !empty($record->getRequestDetail->id_proof))
                  <div class="card">
                     <div class="card-header">
                        <center>
                           <h5><b>Id Proof</b></h5>
                        </center>
                        <br><br>
                        <img width="50%" src="{{url('/')}}/upload/proof/{{$record->getRequestDetail->id_proof}}" />
                        <a class="btn btn-primary pull-right" href="{{url('/')}}/upload/proof/{{$record->getRequestDetail->id_proof}}" download="id-proof">Download File</a>
                     </div>
                  </div>
                  @endif

               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="styleSelector"></div>
</div>
@endsection