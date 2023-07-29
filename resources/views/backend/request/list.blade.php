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
                        <h5><strong>
                        @switch($category_id)
                            @case(1)
                                <span> Company Requests</span>
                                @break

                            @case(3)
                                <span>Technician Request</span>
                                @break
                            
                            @case(2)
                                <span>Home Industry</span>
                                @break    

                            @case(4)
                                <span>Medical Request</span>
                                @break    

                            @default
                                <span>List</span>
                        @endswitch
                        </strong></h5>
                        </div>
                        <div class="card-block">
                            <div class="dt-responsive table-responsive">
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <th>#</th>
                                        <th>Company Name</th>
                                        <th>Mobile Number</th>
                                        <th>City</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach($records as $value)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$value->business_name}}</td>
                                            <td>{{$value->mobile_number}}</td>
                                            <td>{{$value->getCity->city_name}}</td>
                                            <td>
                                            @php $class = ''; @endphp 
                                            @if($value->status === 'Pending')
                                            @php $class = 'badge badge-warning'; @endphp
                                            @elseif($value->status === 'Accept')
                                            @php $class = 'badge badge-success'; @endphp
                                            @elseif($value->status === 'Reject')
                                            @php $class = 'badge badge-danger'; @endphp
                                            @endif 
                                                <span class="{{$class}}" style="color:white">{{$value->status}}</span></td>
                                            <td>{{$value->created_at->format('d M Y')}}</td>
                                            <td>
                                            <a href="{{route('admin.request.detail',['id' => $value->id])}}"><i class="fa fa-eye editClass" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th>#</th>
                                        <th>Company Name</th>
                                        <th>Mobile Number</th>
                                        <th>City</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th> 
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

