@extends('backend.layouts.master') 
@include('backend.layouts.datatable') 
@section('content')
<div class="pcoded-inner-content">
   <div class="main-body">
      <div class="page-wrapper">
         <div class="page-body">
            <div class="row">
               <div class="col-sm-12">
                  @include('backend.layouts.message')
                  <div class="card">
                     <div class="card-header">
                        <h5>Customer List</h5>
                     </div>
                     <div class="card-block">
                        <div class="dt-responsive table-responsive">
                           <table id="simpletable" class="table table-striped table-bordered nowrap">
                              <thead>
                                 <th>#</th>
                                 <th>Name</th>
                                 <th>Mobile Number</th>
                                 <th>District - City</th>
                                 <th>Created Date</th>
                                 <th>Action</th>
                              </thead>
                              <tbody>
                                @foreach($records as $value)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$value->full_name}}</td> 
                                    <td>@if(isset($value->mobile_number)){{$value->mobile_number}}@endif</td> 
                                    <td>{{$value->getAddress->getDistrict->district_name}} - {{$value->getAddress->getCity->city_name}}</td>
                                    <td>{{$value->created_at->format('d M Y')}}</td>
                                    <td>
                                        <a href="{{route('admin.customer.detail',['id' => $value->id])}}"><i class="fa fa-eye editClass" aria-hidden="true"></i></a>
                                    </td> 
                                </tr>
                                @endforeach
                              </tbody>
                              <tfoot>
                                 <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Mobile Number</th>
                                    <th>District - City</th>
                                    <th>Created Date</th>
                                 </tr>
                              </tfoot>
                           </table>
                        </div>
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