<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar menu-light ">
    <div class="navbar-wrapper">
        <div class="navbar-content scroll-div">

            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="{{ asset('assets/img/avatar2.jpg') }}" alt="User-Profile-Image">
                    <div class="user-details">
                        <div id="more-details">Admin</div>
                    </div>
                </div>
            </div>

            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('documents.index') }}" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-book"></i></span>
                        <span class="pcoded-mtext">Dokumen</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('progress.index') }}" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Progress</span>
                    </a>
                </li> --}}

                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-shuffle"></i>
</span>
                        <span class="pcoded-mtext">Workflow</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ route('types.index') }}">Jenis Dokumen</a></li>
                        <li><a href="{{ route('workflows.index') }}">Step Workflow</a></li>
                    </ul>
                </li>



                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                        <span class="pcoded-mtext">Management</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="/profil">User Profile</a></li>
                        <li>
                            <a href=""
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->
