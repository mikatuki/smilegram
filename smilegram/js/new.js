$(function() {

  // アップロードしたい画像の表示
  $('#initial_icon').on('change', function (e) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $("#icon-preview").attr('src', e.target.result);
        $("#icon-preview").removeClass('is-close');
        $(".new_icon_btn").css('display','none');
    }
    reader.readAsDataURL(e.target.files[0]);
  });

  $('.new_submit').click(function() {
    var showName = $('.new_show-name').children('input').val();
    var id_macth = $('.new_id').children('input').val().match(/^[A-Za-z0-9]*$/);
    var psw_macth = $('.new_psw').children('input').val().match(/^[A-Za-z0-9]*$/);

    var check = "";

    $('.new_show-name').children('p').text('');
    $('.new_id').children('p').text('');
    $('.new_psw').children('p').text('');

    if(showName == "") {
      $('.new_show-name').children('p').text('入力してください。');
      check++;
    }

    if(id_macth == null || id_macth[0] == "") {
      $('.new_id').children('p').text('半角英数で入力してください。');
      check++;
    }

    if(psw_macth == null || psw_macth[0] == "") {
      $('.new_psw').children('p').text('半角英数で入力してください。');
      check++;
    }

    if (check == "") {
      $('.new_form').submit();
    }

  });

});
