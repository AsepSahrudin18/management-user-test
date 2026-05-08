 <!-- Dashboard -->
 <li class="menu-item active">
     <a href="/" class="menu-link">
         <i class="menu-icon tf-icons bx bx-home-circle"></i>
         <div data-i18n="Analytics">Dashboard</div>
     </a>
 </li>


 <li class="menu-header small text-uppercase">
     <span class="menu-header-text">Pages</span>
 </li>
 <li class="menu-item">
     <a href="javascript:void(0);" class="menu-link menu-toggle">
         <i class="menu-icon tf-icons bx bx-dock-top"></i>
         <div data-i18n="Account Settings">Account Settings</div>
     </a>
     <ul class="menu-sub">
         <li class="menu-item">
             <a href="{{ route('users.index') }}" class="menu-link">
                 <div data-i18n="Account">Management User</div>
             </a>
         </li>
     </ul>
 </li>
