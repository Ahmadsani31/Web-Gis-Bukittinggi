<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">

        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="ti-menu"></i>
            </a>
            <a class="mobile-search morphsearch-search" href="#">
                <i class="ti-search"></i>
            </a>
            <a href="<?= base_url('admin'); ?>">
                <img class="img-fluid" src="<?= base_url('assets/admin/'); ?>images/logo-logo.png" alt="Theme-Logo" />
            </a>
            <a class="mobile-options">
                <i class="ti-more"></i>
            </a>
        </div>
        <div class="navbar-container container-fluid">
            <ul class="nav-left">

                <li>
                    <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a>
                    </div>
                </li>

                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()">
                        <i class="ti-fullscreen"></i>
                    </a>
                </li>
                <li>
                    WebGis Drainase Kota Bukittinggi
                    <a href="<?= base_url('/'); ?>" target="_blank">
                        <span class="label label-primary">Klik Untuk Lihat Website</span>
                    </a>
                </li>
            </ul>

            <ul class="nav-right">

                <li class="header-notification">
                    <a href="#!">
                        <i class="ti-bell"></i>
                        <span class="icon-notif "></span>
                    </a>
                    <ul class="show-notification">
                        <li>
                            <h6>Notifications</h6>
                        </li>
                        <div class="scroll" id="notifikasi">

                        </div>

                    </ul>
                </li>

                <li class="user-profile header-notification">
                    <a href="#!">
                        <img src="<?= base_url('assets/admin/'); ?>images/profile.png" class="img-radius" alt="User-Profile-Image">
                        <span><?= session()->get('s_Nama'); ?></span>
                        <i class="ti-angle-down"></i>
                    </a>
                    <ul class="show-notification profile-notification">
                        <li>
                            <a href="<?= base_url('logout'); ?>">
                                <i class="ti-layout-sidebar-left"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>