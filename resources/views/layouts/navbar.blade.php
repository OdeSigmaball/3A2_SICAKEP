
<div id="content-wrapper" class="d-flex flex-column">

<div class="content">

<nav class="bg-white shadow navbar navbar-expand navbar-light topbar static-top">
    <img width="50" src="{{ URL::to('/') }}/images/BPMP Logo.jpg" alt="Logo 1" class="ml-3 logo">
    <img width="50" src="{{ URL::to('/') }}/images/tutwurihandayani.png" alt="Logo 1" class="ml-3 ">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="mr-3 btn btn-link d-md-none rounded-circle">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->


    <!-- Topbar Navbar -->
    <ul class="ml-auto navbar-nav">


        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - User Information -->
        <li class="mr-4 nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">



            <span class="mr-2 text-gray-600 d-none d-lg-inline small">{{ Auth::user()->username }}  <i class="ml-1 text-gray-500 fas fa-user fa-sm fa-fw"></i></span>


            </a>
            <!-- Dropdown - User Information -->
            <div class="shadow dropdown-menu dropdown-menu-right animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/profile">
                    <i class="mr-2 text-gray-400 fas fa-user fa-sm fa-fw"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                            @csrf

                    <a class="dropdown-item"  href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>

        </li>

    </ul>

</nav>

</div>

