

<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">

                <div class="mx-3 sidebar-brand-text">SI CAKEP</div>
            </a>

            <!-- Divider -->
            <hr class="my-0 sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->


            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Bidang</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="/bidang/datalaporangtk">Data Laporan GTK</a>
                        <a class="collapse-item" href="/bidang/datalaporanpaud">Data Laporan PAUD</a>
                        <a class="collapse-item" href="/bidang/datalaporanpubkom">Data Laporan PUBLIKASI</a>
                        <a class="collapse-item" href="/bidang/datalaporansdsmk">Data Laporan SD & SMK</a>

                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">



            <!-- Heading -->


            <!-- Heading -->

            @if (Auth::user()->bidang != 'admin')
            @else

            <div class="sidebar-heading">
                Admin
            </div>
            <li class="nav-item">
                <a class="nav-link" href="/userdata">
                    <i class="fas fa-fw fa-table"></i>
                    <span>data user</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/datakategori">
                    <i class="fas fa-fw fa-table"></i>
                    <span>data kategori</span></a>
            </li>
            @endif



            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="border-0 rounded-circle" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->


</ul>
<!-- Main Content -->
