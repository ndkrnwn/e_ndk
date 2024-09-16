<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> <?= $title ?> </title>
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/input/input.field.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/adminlte.min.css?v=3.2.0">
    <link rel="shortcut icon" href="<?= base_url('assets/'); ?>dist/img/first_resources.jpg">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"> -->

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>

<body class="hold-transition login-page">
    <?php $this->view('message') ?>
    <div class="login-box">
        <div class="login-logo">
            <span style="
                     font-family:Helvetica Neue,Helvetica,Arial,sans-serif;
                     font-size:32px;
                     color:#495057;
                     "> <b>First Resources</b>
            </span>
            <span style="
                     font-family:Helvetica Neue,Helvetica,Arial,sans-serif;
                     font-size:24px;
                     color:#495057;
                     ">
                <p> E - NDK System Apps </p>
            </span>
        </div>

        <div class="card card-outline card-gray ">
            <div class="card-body login-card-body">
                <p class="login-box-msg text-gray">Log in to start your session</p>
                <br />
                <form action="<?= site_url('auth/proses') ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control input-area">
                        <label class="label">Username</label>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control input-area">
                        <label class="label">Password</label>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <div class="col-4">
                            <button type="submit" name="login" id="button-login" class="btn btn-secondary btn-block">Log In</button>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>


    <script src="<?= base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>

    <script src="<?= base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url('assets/'); ?>dist/js/adminlte.min.js?v=3.2.0"></script>

    <!-- SweetAlert2 -->
    <script src="<?= base_url('assets/'); ?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?= base_url('assets/'); ?>plugins/sweetalert2/sweetshow.js"></script>

    <script>
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            var flash = $('#swalFailed').data('flash');
            if (flash) {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Failed.',
                    text: 'Sorry, your username or password are incorrect !',
                    width: 600,
                    // padding: '3em',
                    color: '#716add',
                    // background: '#fff url(/images/trees.png)',
                    // backdrop: 'rgba(0,0,123,0.4) url("/images/nyan-cat.gif") left top no-repeat',
                    howClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                })
            };
        });
    </script>
</body>

</html>