<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

    <!-- Sidebar - Brand -->

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="#"><i class="fas fa-fw fa-tachometer-alt"></i><span>Panel</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Bölümler
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.index') }}" >
            <i class="fas fa-fw fa-cog"></i>
            <span>Users</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('gift_box.index') }}" >
            <i class="fas fa-fw fa-cog"></i>
            <span>Gift box</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('gift.index') }}" >
            <i class="fas fa-fw fa-cog"></i>
            <span>Gift</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
