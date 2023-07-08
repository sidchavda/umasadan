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
                        <h4>Detail Page</h4>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="page-body">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header">
                        <center><h5><b>Basic Detail</b></h5></center><br><br>
                        
                        <h5><b>Full Name</b> : {{$record->full_name}}</h5>
                        <h5 class="pull-right"><b>Mobile</b> : {{$record->mobile_number}}</h5><br><br>
                        
                        <h5><b>Dob</b> : {{\Carbon\Carbon::parse($record->dob)->format('d M Y')}}</h5>
                        <h5 class="pull-right"><b>Gender</b> : {{ucfirst($record->gender)}}</h5><br><br>
                        
                        <h5 class=""><b>Marital Status</b> : {{ucfirst($record->marital_status)}}</h5><br><br>
                     </div>
                     <hr>
                     <div class="card-header"> 
                        <center><h5><b>Basic Address</b></h5></center><br><br>
                        
                        <h5><b>Present Address</b> : @if(!empty($record->getAddress->pr_address))
                        {{ucfirst($record->getAddress->pr_address->addr1)}},{{ucfirst($record->getAddress->pr_address->addr2)}},
                        {{ucfirst($record->getAddress->getDistrict->district_name)}},
                        {{ucfirst($record->getAddress->getCity->city_name)}},
                        {{ucfirst($record->getAddress->pr_address->pincode)}},
                        @endif</h5><br><br>

                        <h5><b>Perment Address</b> : @if(!empty($record->getAddress->pe_address))
                        {{ucfirst($record->getAddress->pe_address->addr1)}},{{ucfirst($record->getAddress->pe_address->addr2)}},
                        {{ucfirst($record->getAddress->getDistrict->district_name)}},
                        {{ucfirst($record->getAddress->getCity->city_name)}},
                        {{ucfirst($record->getAddress->pr_address->pincode)}},
                        @endif</h5>
                        
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