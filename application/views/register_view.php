<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/adminlte/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
    <style type="text/css">
        #wait {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('<?php echo base_url(); ?>assets/img/ajax-loader.gif') 50% 50% no-repeat rgb(0, 0, 0, 0.36);
        }
    </style>
</head>

<body class="hold-transition register-page">
    <div id="wait" style="display: none;"></div>
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Form Register</p>
            <form id="form-data" method="post">
                <div class="input-group mb-3">
                    <input type="text" name="nama_depan" class="form-control" placeholder="Nama Depan" required="">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="nama_belakang" class="form-control" placeholder="Nama Belakang" required="">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required="">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password2" class="form-control" placeholder="Ulangi Password" required="">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                </div>
            </form>
            <p class="mt-4 mb-0">
                Sudah punya akun? Silahkan<a href="<?= base_url() ?>" class="text-center"> Login </a>
            </p>
        </div>
    </div>

    <script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/adminlte/js/adminlte.js"></script>
    <script>
        var base_url = '<?= base_url() ?>';
    </script>
    <script src="<?= base_url('assets') ?>/js/register.js?t=<?=time()?>"></script>
</body>

</html>