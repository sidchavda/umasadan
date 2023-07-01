@include('backend.layouts.header')
@stack('css')
@include('backend.layouts.sidebar')
<div class="pcoded-content">
@yield('content')
</div>
@include('backend.layouts.footer')
@stack('js')
