<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="{{ site_url('') }}" class="brand-link bg-info">
        <img src="{{ asset('cpanel/img/_logo.png') }}" alt="Logo" class="brand-image"
            style="opacity: .8">
        <span class="brand-text font-weight"><b>{{ getenv('APP_NAME') }}</b></span>
    </a>
    <!-- Profile panel -->
    <div class="user-profile d-flex">
        <div class="profile-canvas" style="background-image: linear-gradient(135deg,rgba(45,53,61,.79) 0,rgba(45,53,61,.5) 100%),url({{ asset('cpanel/img/bg.jpg') }})"></div>
        <a href="#" class="profile-link">
            <img src="{{ asset('cpanel/img/_admin.png') }}" alt="Logo" class="brand-image img-circle elevation-3">
            <span class="brand-text profile-text font-weight-light"><b>{{ $this->session->username }}</b></span>
        </a>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2 sidebar-container">
            <ul class="nav nav-pills nav-sidebar flex-column sidebar-menu" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
                <li class="nav-item {{ @$activeMenu == 'beranda' ? 'menu-open' : '' }}">
                    <a href="{{ site_url('') }}" class="nav-link {{ @$activeMenu == 'beranda' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            Beranda
                        </p>
                    </a>
				</li>
                <li class="nav-item {{ @$activeMenu == 'pemesanan' ? 'menu-open' : '' }}">
                    <a href="{{ site_url('pemesanan') }}" class="nav-link {{ @$activeMenu == 'pemesanan' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-ticket"></i>
                        <p>
                            Pemesanan
                        </p>
                    </a>
				</li>
				<li class="nav-item {{ @$activeMenu == 'jadwal' ? 'menu-open' : '' }}">
                    <a href="{{ site_url('jadwal') }}" class="nav-link {{ @$activeMenu == 'jadwal' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-clock-o"></i>
                        <p>
                            Jadwal
                        </p>
                    </a>
				</li>
				<li class="nav-item {{ @$activeMenu == 'kursi' ? 'menu-open' : '' }}">
                    <a href="{{ site_url('kursi') }}" class="nav-link {{ @$activeMenu == 'kursi' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-table"></i>
                        <p>
                            Kursi
                        </p>
                    </a>
				</li>
				<li class="nav-item {{ @$activeMenu == 'bis' ? 'menu-open' : '' }}">
                    <a href="{{ site_url('bis') }}" class="nav-link {{ @$activeMenu == 'bis' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-bus"></i>
                        <p>
                            Bis
                        </p>
                    </a>
				</li>
				<li class="nav-header">MASTER</li>
				<li class="nav-item {{ @$activeMenu == 'bisjenis' ? 'menu-open' : '' }}">
                    <a href="{{ site_url('bisjenis') }}" class="nav-link {{ @$activeMenu == 'bisjenis' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-certificate"></i>
                        <p>
                            Jenis Bis
                        </p>
                    </a>
				</li>
				<li class="nav-item {{ @$activeMenu == 'rute' ? 'menu-open' : '' }}">
                    <a href="{{ site_url('rute') }}" class="nav-link {{ @$activeMenu == 'rute' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-road"></i>
                        <p>
                            Rute
                        </p>
                    </a>
				</li>
				<li class="nav-item {{ @$activeMenu == 'pemesan' ? 'menu-open' : '' }}">
                    <a href="{{ site_url('pemesan') }}" class="nav-link {{ @$activeMenu == 'pemesan' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Pemesan
                        </p>
                    </a>
				</li>
				<li class="nav-item {{ @$activeMenu == 'admin' ? 'menu-open' : '' }}">
                    <a href="{{ site_url('admin') }}" class="nav-link {{ @$activeMenu == 'admin' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Admin
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
