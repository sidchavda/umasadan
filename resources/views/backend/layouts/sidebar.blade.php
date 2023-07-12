<style>
   .activeMenu{
      color:#FE8A7D!important
   }
</style>
<div class="pcoded-main-container">
<div class="pcoded-wrapper">
<nav class="pcoded-navbar">
   <div class="pcoded-inner-navbar main-menu">
      <div class="pcoded-navigatio-lavel">Navigation</div>
      <!-- <ul class="pcoded-item pcoded-left-item">
         <li class="">
            <a href="{{route('admin.category.index')}}">
            <span class="pcoded-micon"><i class="feather icon-feather"></i></span>
            <span class="pcoded-mtext {{ Route::is('admin.category.*') ? 'activeMenu' : '' }}">Category</span>
            </a>
         </li>
      </ul> -->
   
      <ul class="pcoded-item pcoded-left-item">
         <li class="pcoded-hasmenu {{ Route::is('admin.category.*') || Route::is('admin.subcategory.*') ? 'pcoded-trigger' : '' }}">
               <a href="javascript:void(0)">
               <span class="pcoded-micon"><i class="feather icon-gitlab"></i></span>
               <span class="pcoded-mtext">Categories</span>
               </a> 
               <ul class="pcoded-submenu">
                  <li class="{{ Route::is('admin.category.*') ? 'active' : '' }}">
                     <a href="{{route('admin.category.index')}}">
                     <span class="pcoded-mtext">Main Catgeory</span>
                     </a>
                  </li>
                  <li class="{{ Route::is('admin.subcategory.*') ? 'active' : '' }}">
                     <a href="{{route('admin.subcategory.index')}}">
                     <span class="pcoded-mtext">Sub Category</span>
                     </a>
                  </li>
               </ul>
         </li>
      </ul>
      <ul class="pcoded-item pcoded-left-item">
         <li class="">
            <a href="{{route('admin.product.index')}}">
            <span class="pcoded-micon"><i class="feather icon-feather"></i></span>
            <span class="pcoded-mtext {{ Route::is('admin.product.*') ? 'activeMenu' : '' }}">Product</span>
            </a>
         </li>
      </ul>
      <ul class="pcoded-item pcoded-left-item">
         <li class="pcoded-hasmenu {{ Route::is('admin.degree.*') || Route::is('admin.subdegree.*') ? 'pcoded-trigger' : '' }}">
               <a href="javascript:void(0)">
               <span class="pcoded-micon"><i class="feather icon-gitlab"></i></span>
               <span class="pcoded-mtext">Degrees</span>
               </a> 
               <ul class="pcoded-submenu">
                  <li class="{{ Route::is('admin.degree.*') ? 'active' : '' }}">
                     <a href="{{route('admin.degree.index')}}">
                     <span class="pcoded-mtext">Main Degree</span>
                     </a>
                  </li>
                  <li class="{{ Route::is('admin.subcategory.*') ? 'active' : '' }}">
                     <a href="{{route('admin.subdegree.index')}}">
                     <span class="pcoded-mtext">Sub Degree</span>
                     </a>
                  </li>
               </ul>
         </li>
      </ul>
      <ul class="pcoded-item pcoded-left-item">
         <li class="pcoded-hasmenu {{ Route::is('admin.role.*') || Route::is('admin.district.*') || Route::is('admin.city.*') ? 'pcoded-trigger' : '' }}">
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
                  <li class="{{ Route::is('admin.role.*') ? 'active' : '' }}">
                     <a href="{{route('admin.role.index')}}">
                     <span class="pcoded-mtext">Roles</span> 
                     </a>
                  </li>
               </ul>
         </li>
      </ul>
   </div>
</nav>