<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login System</title>
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/adminlte/css/adminlte.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="alert alert-danger" role="alert" style="display:none;">
            <strong id="msg-info"></strong>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Masukkan Email Dan Password</p>
                <form id="form-login" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="jhon@rumahweb.co.id">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="pass" placeholder="Password">
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
                            <input type="submit" name="submit" value="Login" class="btn btn-primary btn-block btn_1">
                        </div>
                    </div>
                </form>
                <p class="mt-4 mb-0">
                    Belum punya akun? Daftar <a href="<?= base_url('register') ?>" class="text-center"> disini </a>
                </p>
                <p class="mt-1 mb-0">
                    Panduan penggunaan sistem baca <a href="<?= base_url('Panduan Penggunaan system.pdf') ?>" target="_blank" class="text-center"> disini </a>
                </p>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/adminlte/js/adminlte.js"></script>
    <script>
        var base_url = '<?= base_url() ?>';
    </script>
    <script src="<?= base_url('assets') ?>/js/login.js?t=<?=time()?>"></script>

</body>

</html>