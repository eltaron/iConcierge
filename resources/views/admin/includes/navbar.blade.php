
<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
<div class="ms-md-auto pe-md-3 d-flex align-items-center">
    
</div>
<ul class="navbar-nav  justify-content-end">
    <li class="nav-item d-flex align-items-center">
        @auth
        <a href="{{url('admin/profile')}}" class="nav-link text-body font-weight-bold px-0">
            <i class="fa fa-user me-sm-1" aria-hidden="true"></i>
            <span class="d-sm-inline d-none">Profile</span>
        </a>
        @else
        <a href="{{url('admin/logout')}}" class="nav-link text-body font-weight-bold px-0">
            <i class="fa fa-user me-sm-1" aria-hidden="true"></i>
            <span class="d-sm-inline d-none">Sign In</span>
        </a>
        @endauth

    </li>
    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
            </div>
        </a>
    </li>
</ul>
</div>

