<div class="content-wrapper">
    <div class="content-header">
        <div id="wait" style="display: none;"></div>
        <div class=" container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="flex-row-reverse col-xs-12 col-md-6">
                        <button type="button" class="btn btn-success text-white btn-add pl-2">Tambah</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th>Nama Depan</th>
                                    <th>Nama Belakang</th>
                                    <th width="100px" style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                if (count($dt_list) > 0) {
                                    foreach ($dt_list as $key => $list) { ?>
                                        <tr>
                                            <td class="text-center"><?= $key+1; ?></td>
                                            <td><?= $list['firstName']; ?></td>
                                            <td><?= $list['lastName']; ?></td>
                                            <td class="text-center">
                                                <div class="">
                                                    <button class="btn btn-white btn-sm" onclick="edit_data(`<?= $list['id'] ?>`);" title="Edit"><i class="fas fa-edit" style="color: #00a3ea;"></i></button>
                                                    <button class="btn btn-white btn-sm" onclick="delete_data(`<?= $list['id'] ?>`);" title="Delete"><i class="fas fa-trash" style="color: #e50000;"></i></button>
                                                </div>

                                            </td>
                                        </tr>
                                <?php
                                    }
                                } ?>
                            </tbody>
                        </table>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <p>Showing 1 to <?=$pages['count']?> of <?=$pages['count_total']?> entries</p>
                            </div>
                            <div class="col-md-6">
                                <ul class="pagination justify-content-end">

                                    <?php
                                    $jumlah_page = $pages['pages_total'];
                                    $jumlah_number = $pages['pages']; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
                                    $start_number = ($page > 1) ? $page : 1;
                                    $end_number = ($jumlah_page > ($start_number+2)) ? $start_number+2 : $jumlah_page;

                                    if ($page == 1) {
                                        echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
                                        echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
                                    } else {
                                        $link_prev = ($page > 1) ? $page - 1 : 1;
                                        echo '<li class="page-item halaman-table"><a class="page-link" href="'.base_url($this->uri->segment(1).'?page=1').'">First</a></li>';
                                        echo '<li class="page-item halaman-table"><a class="page-link" href="'.base_url($this->uri->segment(1).'?page=').$link_prev.'"><span aria-hidden="true">&laquo;</span></a></li>';
                                    }

                                    for ($i = $start_number; $i <= $end_number; $i++) {
                                        $link_active = ($page == $i) ? ' active' : '';
                                        if($link_active == ''){
                                            $linknum = base_url($this->uri->segment(1).'?page=').$i;
                                        }else{
                                            $linknum = '#';
                                        }
                                        echo '<li class="page-item halaman-table ' . $link_active . '"><a class="page-link" href="'.$linknum.'">' . $i . '</a></li>';
                                    }

                                    if ($page == $jumlah_page) {
                                        echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                                        echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
                                    } else {
                                        $link_next = ($page < $jumlah_page) ? floatval($page) + 1 : $jumlah_page;
                                        echo '<li class="page-item halaman-table"><a class="page-link" href="'.base_url($this->uri->segment(1).'?page=').$link_next.'"><span aria-hidden="true">&raquo;</span></a></li>';
                                        echo '<li class="page-item halaman-table"><a class="page-link" href="'.base_url($this->uri->segment(1).'?page=').$jumlah_page.'">Last</a></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal" id="modal_form" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" id="mhead">
                <h4 class="modal-title text-white">Modal Heading</h4>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form action="#" id="form-data" class="form-horizontal">
                <div class="modal-body">
                    <input type="hidden" value="" name="data_id"/>
                    <div class="form-group">
                        <label for="nama_depan" class="col-form-label">Nama Depan:</label>
                        <input type="text" class="form-control" name="nama_depan" id="nama_depan" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_belakang" class="col-form-label">Nama Belakang:</label>
                        <input type="text" class="form-control" name="nama_belakang" id="nama_belakang" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Password: <span class="infoPass text-danger"></span></label>
                        <input type="password" class="form-control" name="password" id="password" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Ulangi Password: <span class="infoPass text-danger"></span></label>
                        <input type="password" class="form-control" name="password2" id="password2" autocomplete="off" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" id="btnSave" class="btn text-white btn_1" value="Save">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on('click', ".btn-add", function(event) {
        event.preventDefault();
        save_method = 'add';
        $('#form-data')[0].reset();
        $('[name="data_id"]').val('');
        $('.infoPass').html('');
        $('[name="email"]').prop("readonly", false);
        $('[name="password"]').prop("required", true);
        $('[name="password2"]').prop("required", true);
        $('#mhead').removeClass('bg-warning');
        $('#mhead').addClass('bg-success');
        $('#btnSave').removeClass('btn-warning');
        $('#btnSave').addClass('btn-success');
        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah Data');
    });

    function edit_data(id)
    {
      $('#wait').show();
      save_method = 'update';
      $('#form-data')[0].reset();

      $.ajax({
        url : "<?=base_url('dashboard/edit/')?>"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            if(data.status = true){
                $('[name="data_id"]').val(data.id);
                $('[name="nama_depan"]').val(data.firstName); 
                $('[name="nama_belakang"]').val(data.lastName); 
                $('[name="email"]').val(data.email); 

                $('.infoPass').html('<small>Isi jika ingin mengubah password</small>');
                $('[name="email"]').prop("readonly", true);
                $('[name="password"]').prop("required", false);
                $('[name="password2"]').prop("required", false);
                $('#mhead').addClass('bg-warning');
                $('#mhead').removeClass('bg-success');
                $('#btnSave').addClass('btn-warning');
                $('#btnSave').removeClass('btn-success');
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Data');
            }else{
              alert('server tidak merespon, silahkan coba lagi');
            }
            $('#wait').hide();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert('Error, silahkan hubungi developer untuk perbaikan');
          $('#wait').hide();
        }
      });
    }

    function delete_data(id)
    {
        swal({
            title: 'Apakah yakin akan hapus data?',
            text: "Anda akan menghapus data user dari sistem!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#bd2130',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            closeOnConfirm: false
        },function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url : "<?=base_url('dashboard/delete/')?>",
                    type: "POST",
                    data: {id:id},
                    dataType: "JSON",
                    success: function(data)
                    {
                      if(data.status == true){
                        swal({
                             title: 'Berhasil', 
                             text: data.msg, 
                             type: 'success',
                             allowEscapeKey : false
                          },
                          function(){ 
                             $('#wait').show();
                             location.reload();
                          }
                        );                            
                      }else{
                        swal(
                        'Gagal',
                        data.msg,
                        'warning'
                        );
                      }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                      alert('Error, silahkan hubungi developer untuk perbaikan');
                    }
                });  
            }
        }) 
    }

    $(document).ready(function() {
        $("#form-data").submit(function(event){
            event.preventDefault();
            $(".btn_1").prop('disabled', true);
            $(".btn_1").val('Saving....');
            $(".btn_1").css('background', '#726469');
            var request_method = $(this).attr("method");
            var form_data = new FormData(this);
            var post_url;
            if(save_method == 'add'){
                post_url = "<?=base_url('dashboard/insert')?>";
            }else{
                post_url = "<?=base_url('dashboard/update')?>";
            }
            $.ajax({
                url : post_url,
                type:"post",
                data:form_data,
                dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                success: function(data)
                {
                    if(data.status == true){
                        $('#modal_form').modal('hide');
                        swal({
                            title: "Good job", 
                            text: data.msg, 
                            type: "success",
                            allowEscapeKey : false
                        },
                        function(){ 
                            $('#wait').show();
                            location.reload();
                        });              
                    }else{
                        alert(data.msg);
                        $(".btn_1").prop('disabled', false);
                        $(".btn_1").val('Save');
                        $(".btn_1").css('background', '');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error, silahkan hubungi developer untuk perbaikan');
                    $(".btn_1").prop('disabled', false);
                    $(".btn_1").val('Save');
                    $(".btn_1").css('background', '');
                }
            });
        });
    });
</script>