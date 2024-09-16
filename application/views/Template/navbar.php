<nav class="main-header navbar navbar-expand-md border-bottom-0 navbar-dark navbar-navy">
    <div class="container">
        <a href="<?= site_url('home'); ?>">
            <span class="brand-text">
                <h2 style="
        color:white;
        font-family:Helvetica Neue,Helvetica,Arial,sans-serif;
        text-align:center;
        padding-right: 60px;
        ">
                    <b>E-NDK</b>
                </h2>
            </span>
        </a>
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle fontpoppins">Main Menu</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="<?= site_url('entry/add'); ?>" class="dropdown-item fontpoppins">Entry NDK </a></li>
                        <li><a href="<?= site_url('entry'); ?>" class="dropdown-item fontpoppins">List NDK</a></li>
                    </ul>
                </li>
                <?php if ($this->fungsi->user_login()->group == 'GR1') {  ?>
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="nav-link dropdown-toggle fontpoppins">Admin</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                            <li><a href="<?= site_url('entry/deleted'); ?>" class="dropdown-item fontpoppins">NDK - Delete </a></li>
                            <li><a href="<?= site_url('entry/all'); ?>" class="dropdown-item fontpoppins">NDK - All </a></li>
                        </ul>
                    </li>
                <?php  } ?>
            </ul>
        </div>

        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-info text-sm fontpoppins">Hello, <b> &nbsp;<?= $this->session->userdata('ses_name') ?></b></span>

                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?= site_url('user/edit_profile/' . $this->session->userdata('ses_id')); ?>">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= site_url('auth/logout'); ?>" class="dropdown-item button-logout">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>