$(function() {

  'use strict'
  $("#form-data").submit(function(event) {
    event.preventDefault();
    $('#wait').show();
    var form_data = $('#form-data').serialize();
    $.ajax({
      url: base_url + "/register_proses",
      type: "POST",
      data: form_data,
      dataType: "JSON",
      success: function(data) {
        if (data.status == true) {
          $('#form-data')[0].reset();
          alert(data.msg);
          window.location.assign(base_url);
        } else {
          alert(data.msg);
          $('#wait').hide();
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
        $('#wait').hide();
      }
    });
  });
})
