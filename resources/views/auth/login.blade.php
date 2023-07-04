<!DOCTYPE html>
<html lang="en">
   <head>
      <title>{{env('APP_NAME')}}</title> 
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="#">
      <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
      <meta name="author" content="#">
      <link rel="icon" href="{{asset('files/assets/images/favicon.ico')}}" type="image/x-icon">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{asset('files/bower_components/bootstrap/dist/css/bootstrap.min.css')}}"> 
      <link rel="stylesheet" type="text/css" href="{{asset('files/assets/icon/themify-icons/themify-icons.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('files/assets/icon/icofont/css/icofont.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('files/assets/css/style.css')}}">
   </head>
   <body class="fix-menu">
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
      <section class="login-block">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <form class="md-float-material form-material" method="POST" action="{{ route('login') }}">
                        @csrf
                     <div class="text-center">
                        <img src="{{asset('files/assets/images/logo.png')}}" alt="logo.png">
                     </div>
                     <div class="auth-box card">
                        <div class="card-block">
                           <div class="row m-b-20">
                              <div class="col-md-12">
                                 <h3 class="text-center">Sign In</h3>
                              </div>
                           </div>
                           <div class="form-group form-primary">
                              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required placeholder="Your Email Address" autocomplete="email" autofocus>
                              <span class="form-bar"></span>
                              @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           </div>
                           <div class="form-group form-primary">
                              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Password" autocomplete="current-password">
                              <span class="form-bar"></span>
                              @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           </div>
                           <div class="row m-t-25 text-left">
                              <div class="col-12">
                                 <div class="checkbox-fade fade-in-primary d-">
                                    <label>
                                    <input  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                    <span class="text-inverse">{{ __('Remember Me') }}</span>
                                    </label>
                                 </div>
                                 @if (Route::has('password.request'))
                                    <div class="forgot-phone text-right f-right">
                                        <a href="{{ route('password.request') }}" class="text-right f-w-600"> {{ __('Forgot Your Password?') }}</a>
                                    </div>
                                 @endif
                              </div>
                           </div>
                           <div class="row m-t-30">
                              <div class="col-md-12">
                                 <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Sign
                                 in</button>
                              </div>
                           </div>
                           <hr/>
                           <div class="row">
                              <div class="col-md-10">
                                 <p class="text-inverse text-left m-b-0">Thank you.</p>
                                 <p class="text-inverse text-left"><a href="https://demo.dashboardpack.com/adminty-html/index.html"><b class="f-w-600">Back
                                    to website</b></a>
                                 </p>
                              </div>
                              <div class="col-md-2">
                                 <img src="{{asset('files/assets/images/auth/Logo-small-bottom.png')}}" alt="small-logo.png">
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </section>
      <script type="text/javascript" src="{{asset('files/bower_components/jquery/dist/jquery.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('files/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('files/bower_components/popper.js/dist/umd/popper.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('files/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('files/bower_components/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
      <script type="text/javascript" src="{{asset('files/bower_components/modernizr/modernizr.js')}}"></script>
      <script type="text/javascript" src="{{asset('files/bower_components/modernizr/feature-detects/css-scrollbars.js')}}"></script>
      <script type="text/javascript" src="{{asset('files/bower_components/i18next/i18next.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('files/bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('files/bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('files/bower_components/jquery-i18next/jquery-i18next.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('files/assets/js/common-pages.js')}}"></script>
   </body>
</html>