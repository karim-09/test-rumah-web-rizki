<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed ">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-dark navbar-info">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>

            </ul>
            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="px-2">
                        <button name="logout" class="btn btn-danger logout"><i class="fas fa-sign-out-alt"></i></button>
                    </div>
                </li>
            </ul>
        </nav>

        <script type="text/javascript">
        document.querySelector(".logout").addEventListener('click', function() {
            swal({
                title: "Yakin anda akan keluar?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Logout",
                closeOnConfirm: false
            }, function() {
                $.ajax({
                    url: "<?= base_url() ?>logout",
                    type: "POST",
                    success: function(data) {

                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });
                swal("Keluar!", "Anda Berhasil Keluar.", "success");
            });
        })
        </script>