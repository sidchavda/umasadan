<!DOCTYPE html>
<html lang="en">
   <head>
      <title>{{env('APP_NAME')}}</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="#">
      <meta name="keywords" content="{{env('APP_NAME')}}">
      <meta name="author" content="#">
      <!-- <link rel="icon" href="https://demo.dashboardpack.com/adminty-html/files/assets/images/favicon.ico" type="image/x-icon"> -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{asset('files/bower_components/bootstrap/dist/css/bootstrap.min.css')}}"> 
      <link rel="stylesheet" href="{{asset('files/assets/pages/chart/radial/css/radial.css')}}" type="text/css" media="all">
      <link rel="stylesheet" type="text/css" href="{{asset('files/assets/icon/feather/css/feather.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('files/assets/css/style.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('files/assets/css/jquery.mCustomScrollbar.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('files/assets/icon/themify-icons/themify-icons.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('files/assets/icon/icofont/css/icofont.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('files/assets/icon/font-awesome/css/font-awesome.min.css')}}">
      <style>
         .editClass,.deleteClass{
            font-size:large
         }
      </style>
   </head>
   <body>
      <div class="theme-loader">
         <div class="ball-scale">
            <div class="contain">
               <div class="ring">
                  <div class="frame"></div>
               </div>
               <div class="ring">
                  <div class="frame"></div>
               </div>
               <div class="ring">
                  <div class="frame"></div>
               </div>
               <div class="ring">
                  <div class="frame"></div>
               </div>
               <div class="ring">
                  <div class="frame"></div>
               </div>
               <div class="ring">
                  <div class="frame"></div>
               </div>
               <div class="ring">
                  <div class="frame"></div>
               </div>
               <div class="ring">
                  <div class="frame"></div>
               </div>
               <div class="ring">
                  <div class="frame"></div>
               </div>
               <div class="ring">
                  <div class="frame"></div>
               </div>
            </div>
         </div>
      </div>
      <div id="pcoded" class="pcoded">
         <div class="pcoded-overlay-box"></div>
         <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header">
               <div class="navbar-wrapper">
                  <div class="navbar-logo">
                     <a class="mobile-menu" id="mobile-collapse" href="#!">
                     <i class="feather icon-menu"></i>
                     </a>
                     <a href="https://demo.dashboardpack.com/adminty-html/index.html">
                     <img class="img-fluid" src="{{asset('files/assets/images/logo.png')}}" alt="Theme-Logo" />
                     </a>
                     <a class="mobile-options">
                     <i class="feather icon-more-horizontal"></i>
                     </a>
                  </div>
                  <div class="navbar-container">
                     <ul class="nav-left">
                        <!-- <li class="header-search">
                           <div class="main-search morphsearch-search">
                              <div class="input-group">
                                 <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                                 <input type="text" class="form-control">
                                 <span class="input-group-addon search-btn"><i class="feather icon-search"></i></span>
                              </div>
                           </div>
                        </li> -->
                        <li>
                           <a href="#!" onclick="javascript:toggleFullScreen()">
                           <i class="feather icon-maximize full-screen"></i>
                           </a>
                        </li>
                     </ul>
                     <ul class="nav-right">
                        <!-- <li class="header-notification">
                           <div class="dropdown-primary dropdown">
                              <div class="dropdown-toggle" data-toggle="dropdown">
                                 <i class="feather icon-bell"></i>
                                 <span class="badge bg-c-pink">5</span>
                              </div>
                              <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                 <li>
                                    <h6>Notifications</h6>
                                    <label class="label label-danger">New</label>
                                 </li>
                                 <li>
                                    <div class="media">
                                       <img class="d-flex align-self-center img-radius" src="{{asset('files/assets/images/avatar-4.jpg')}}" alt="Generic placeholder image">
                                       <div class="media-body">
                                          <h5 class="notification-user">John Doe</h5>
                                          <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                                             elit.
                                          </p>
                                          <span class="notification-time">30 minutes ago</span>
                                       </div>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="media">
                                       <img class="d-flex align-self-center img-radius" src="{{asset('files/assets/images/avatar-3.jpg')}}" alt="Generic placeholder image">
                                       <div class="media-body">
                                          <h5 class="notification-user">Joseph William</h5>
                                          <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                                             elit.
                                          </p>
                                          <span class="notification-time">30 minutes ago</span>
                                       </div>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="media">
                                       <img class="d-flex align-self-center img-radius" src="{{asset('files/assets/images/avatar-4.jpg')}}" alt="Generic placeholder image">
                                       <div class="media-body">
                                          <h5 class="notification-user">Sara Soudein</h5>
                                          <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                                             elit.
                                          </p>
                                          <span class="notification-time">30 minutes ago</span>
                                       </div>
                                    </div>
                                 </li>
                              </ul>
                           </div>
                        </li> -->
                       
                        <li class="user-profile header-notification">
                           <div class="dropdown-primary dropdown">
                              <div class="dropdown-toggle" data-toggle="dropdown">
                                 <img src="{{asset('files/assets/images/avatar-4.jpg')}}" class="img-radius" alt="User-Profile-Image">
                                 <span>John Doe</span>
                                 <i class="feather icon-chevron-down"></i>
                              </div>
                              <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                 <li>
                                    <a href="user-profile.html">
                                    <i class="feather icon-user"></i> Profile
                                    </a>
                                 </li>
                                 <!-- <li>
                                    <a href="email-inbox.html">
                                    <i class="feather icon-mail"></i> My Messages
                                    </a>
                                 </li>
                                 <li>
                                    <a href="auth-lock-screen.html">
                                    <i class="feather icon-lock"></i> Lock Screen
                                    </a>
                                 </li> -->
                                 <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="feather icon-log-out"></i>   {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                 </li>
                              </ul>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </nav>