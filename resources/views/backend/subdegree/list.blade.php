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
                            <h5>Sub Degree List</h5>
                            <a href="{{$data->sAction}}" class="btn btn-inverse pull-right">{{$data->sLable}}</a> 
                        </div>
                        <div class="card-block">
                            <div class="dt-responsive table-responsive">
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <th>#</th>
                                        <th>Sub Degree Name</th>
                                        <th>Degree Name</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach($records as $value)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$value->sub_degree_name}}</td>
                                            <td>@if(isset($value->getDegree->degree_name)){{$value->getDegree->degree_name}}@endif</td>
                                            <td>{{$value->created_at->format('d M Y')}}</td>
                                            <td>
                                            <a href="{{route('admin.subdegree.edit',['subdegree' => $value->id])}}"><i class="fa fa-edit editClass" aria-hidden="true"></i></a>
                                            &nbsp;
                                            <a href="{{route('admin.subdegree.destroy',['subdegree' => $value->id])}}"  onclick="deleteRow(event)"><i class="fa fa-trash deleteClass" aria-hidden="true"></i></a>
                                            <form id="delete-form" action="{{route('admin.subdegree.destroy',['subdegree' => $value->id])}}" method="POST" class="d-none"> 
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE"> 
                                            </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>District Name</th>
                                            <th>City Name</th>
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

