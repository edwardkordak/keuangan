<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="#!" class="b-brand">
            <span class="b-title">MO-AKURAT</span>
            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="" class="logo-thumb">
        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                <div class="search-bar">
                    <input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
                    <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head" style="background-color: #FCB91E">
                            <img src="{{ asset('assets/img/avatar2.jpg') }}" class="img-radius"
                                alt="User-Profile-Image">
                            <span>{{ Auth::user()->name }}</span>

                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button style="border: none; background: none;" class="dud-logout" title="logout"> <i
                                        class="feather icon-log-out"></i></button>
                            </form>
                        </div>
                        <ul class="pro-body">
                            <li><a href="/profil" class="dropdown-item"><i class="feather icon-user m-r-5"></i>
                                    Profile</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>
