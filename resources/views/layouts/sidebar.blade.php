<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color:#303030" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    @if (Auth::user()->role == 'admin')
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        @else
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/books">
    @endif
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fa fa-book"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Digital Perpustakaan</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @if (Auth::user()->role == 'admin')
        <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="/dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
    @endif
    <!-- Nav Item - Dashboard -->

    @if (Auth::user()->role == 'admin')
        <!-- Divider -->
        <hr class="sidebar-divider">
    @else
    @endif

    <!-- Heading -->
    @if (Auth::user()->role != 'admin')
    @else
        <div class="sidebar-heading">
            Kategori dan Buku
        </div>
    @endif

    <!-- Nav Item - Pages Collapse Menu -->
    @if (Auth::user()->role != 'admin')
        <li class="nav-item {{ Request::is('books*') ? 'active' : '' }}">
            <a class="nav-link " href="/books">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Buku</span></a>
        </li>
    @else
        <li class="nav-item {{ Request::is('categories*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('categories.index') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Kategori</span></a>
        </li>
        <li class="nav-item {{ Request::is('books*') ? 'active' : '' }}">
            <a class="nav-link " href="/books">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Buku</span></a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->
