@extends('backend.layouts.master')

@section('content')
<div class="pcoded-inner-content">
                        <div class="main-body">
                           <div class="page-wrapper">
                              <div class="page-body">
                                 <div class="row">
                                    <div class="col-xl-4 col-md-6">
                                    <a href="{{route('admin.request')}}?category_id=1">
                                       <div class="card bg-c-yellow text-white">
                                          <div class="card-block">
                                             <div class="row align-items-center">
                                                <div class="col">
                                                   <p class="m-b-5">Total Company Request</p>
                                                   <h4 class="m-b-0">{{$data['company']}}</h4>
                                                </div>
                                                <div class="col col-auto text-right">
                                                   <i class="feather icon-user f-50 text-c-yellow"></i>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </a>   
                                    </div>
                                    <div class="col-xl-4 col-md-6">
                                    <a href="{{route('admin.request')}}?category_id=3">
                                       <div class="card bg-c-green text-white">
                                          <div class="card-block">
                                             <div class="row align-items-center">
                                                <div class="col">
                                                   <p class="m-b-5">Total Technician Request</p>
                                                   <h4 class="m-b-0">{{$data['technician']}}</h4>
                                                </div>
                                                <div class="col col-auto text-right">
                                                   <i class="feather icon-credit-card f-50 text-c-green"></i>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </a>
                                    </div>
                                    <div class="col-xl-4 col-md-6">
                                    <a href="{{route('admin.request')}}?category_id=4">
                                       <div class="card bg-c-pink text-white">
                                          <div class="card-block">
                                             <div class="row align-items-center">
                                                <div class="col">
                                                   <p class="m-b-5">Total Medical Request</p>
                                                   <h4 class="m-b-0">{{$data['medical']}}</h4>
                                                </div>
                                                <div class="col col-auto text-right">
                                                   <i class="feather icon-book f-50 text-c-pink"></i>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </a>
                                    </div>
                                    <!-- <div class="col-xl-3 col-md-6">
                                       <div class="card bg-c-blue text-white">
                                          <div class="card-block">
                                             <div class="row align-items-center">
                                                <div class="col">
                                                   <p class="m-b-5">Orders</p>
                                                   <h4 class="m-b-0">$5,242</h4>
                                                </div>
                                                <div class="col col-auto text-right">
                                                   <i class="feather icon-shopping-cart f-50 text-c-blue"></i>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div> -->
                                 </div>
                              </div>
                           </div>
                           <div id="styleSelector"></div>
                        </div>
                     </div>
@endsection
