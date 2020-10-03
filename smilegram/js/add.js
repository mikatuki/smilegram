$(function() {

  //アップロードしたい画像の表示
  $('#add_img').on('change', function (e) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $("#preview").attr('src', e.target.result);
        $("#preview").removeClass('is-close');
        $(".add_img_text_btn").css('display','none');
    }
    reader.readAsDataURL(e.target.files[0]);
});


});
