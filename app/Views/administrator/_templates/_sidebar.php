<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">App</div>
        <ul class="pcoded-item pcoded-left-item">
            <?php
            if (session()->get('s_Level') == '01') {
            ?>
                <li class="">
                    <a href="<?= base_url('admin/dashboard'); ?>">
                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
   
                <li class="pcoded-hasmenu ">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Master</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="<?= base_url('admin/drainase'); ?>">
                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Drainase</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        <li class=" ">
                            <a href="<?= base_url('admin/layer'); ?>">
                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Layer</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="<?= base_url('admin/berita'); ?>">
                        <span class="pcoded-micon"><i class="ti-book"></i><b>BG</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Berita</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/pengaduan'); ?>">
                        <span class="pcoded-micon"><i class="ti-announcement"></i><b>PG</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Pengaduan</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
             <li>
                    <a href="<?= base_url('admin/user'); ?>">
                        <span class="pcoded-micon"><i class="ti-user"></i><b>US</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">User</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            <?php
                # code...
            } else {
            ?>
                <li class="">
                    <a href="<?= base_url('admin/dashboard'); ?>">
                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/berita'); ?>">
                        <span class="pcoded-micon"><i class="ti-book"></i><b>BG</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Berita</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                       <li>
                    <a href="<?= base_url('admin/pengaduan'); ?>">
                        <span class="pcoded-micon"><i class="ti-announcement"></i><b>PG</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Pengaduan</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>

    </div>
</nav>