<div class="pcoded-main-container">
<div class="pcoded-wrapper">
<nav class="pcoded-navbar">
   <div class="pcoded-inner-navbar main-menu">
      <div class="pcoded-navigatio-lavel">Navigation</div>
      <ul class="pcoded-item pcoded-left-item">
         <li class="pcoded-hasmenu {{ Route::is('admin.district.*') || Route::is('admin.city.*') ? 'pcoded-trigger' : '' }}">
               <a href="javascript:void(0)">
               <span class="pcoded-micon"><i class="feather icon-gitlab"></i></span>
               <span class="pcoded-mtext">Settings</span>
               </a>
               <ul class="pcoded-submenu">
                  <li class="{{ Route::is('admin.district.*') ? 'active' : '' }}">
                     <a href="{{route('admin.district.index')}}">
                     <span class="pcoded-mtext">Districts</span>
                     </a>
                  </li>
                  <li class="{{ Route::is('admin.city.*') ? 'active' : '' }}">
                     <a href="{{route('admin.city.index')}}">
                     <span class="pcoded-mtext">Cities</span>
                     </a>
                  </li>
               </ul>
         </li>
      </ul>
   </div>
</nav>