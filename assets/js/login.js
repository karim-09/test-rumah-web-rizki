$(function() {

  'use strict'
  $("#form-login").submit(function(event) {
    event.preventDefault();
    $(".btn_1").prop('disabled', true);
    $(".btn_1").val('Loging....');
    $(".btn_1").css('background', '#726469');
    var form_data = $('#form-login').serialize();
    $.ajax({
      url: base_url + "/login_proses",
      type: "POST",
      data: form_data,
      dataType: "JSON",
      success: function(data) {
        if(data.status == false){
          // alert(data.msg);
          $(".alert").css('display', '');
          $('#msg-info').html(data.msg);
          $(".btn_1").prop('disabled', false);
          $(".btn_1").val('Login');
          $(".btn_1").css('background', '');
        }else{
          location.href = data.link;
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
        $(".alert").css('display', '');
        $('#msg-info').html('Gagal, Terjadi kesalahan');
        $(".btn_1").prop('disabled', false);
        $(".btn_1").val('Login');
        $(".btn_1").css('background', '');
      }
    });
  });
})
