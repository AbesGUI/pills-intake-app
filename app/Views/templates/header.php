<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/styles/templates.css">
<nav class="navbar navbar-expand-lg navbar-dark p-3 btn-lg" id="headerNav">
    <div class="container-fluid">
        <a class="navbar-brand d-block d-lg-none" href="#">
            <img src="<?php echo base_url('/images/pills.png') ?>" height="80"/>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php if (session()->get('isLoggedIn')): ?>
            <div class=" collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mx-auto ">
                    <li class="nav-item">
                        <a class="nav-link mx-2 btn-outline-primary <?php if (current_url() == base_url('/index.php/profile')) {
                            echo 'active';
                        } ?>" aria-current="page" href="<?php echo base_url(); ?>/profile">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 btn-outline-primary <?php if (current_url() == base_url('/index.php/drugs')) {
                            echo 'active';
                        } ?>" href="<?php echo base_url(); ?>/drugs">Drug List</a>
                    </li>
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link mx-2" href="<?php echo base_url(); ?>/profile">
                            <img src="<?php echo base_url('/images/pills.png') ?>" width="120px"/>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 btn-outline-primary" href="<?php echo base_url(); ?>/signout">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 btn-outline-primary <?php if (current_url() == base_url('/index.php/schedule')) {
                            echo 'active';
                        } ?>" href="<?php echo base_url(); ?>/schedule">New schedule</a>
                    </li>
                </ul>
            </div>
        <?php else: ?>
            <div class=" collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mx-auto ">
                    <li class="nav-item">
                        <a class="nav-link mx-2 btn-outline-primary <?php if (current_url() == base_url('/index.php/drugs')) {
                            echo 'active';
                        } ?>" href="<?php echo base_url(); ?>/signin">Signin</a>
                    </li>
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link mx-2" href="<?php echo base_url(); ?>/signin">
                            <img src="<?php echo base_url('/images/pills.png') ?>" width="120px"/>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 btn-outline-primary" href="<?php echo base_url(); ?>/signup">Signup</a>
                    </li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</nav>