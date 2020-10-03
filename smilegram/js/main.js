$ (function () {

  var width = $('.postImage_image').width();
  $('.postImage_image').height(width);

  var width = $('.joinMember_box_card').width();
  $('.joinMember_box_card_icon').height(width);

  // 画像をクリックした時の動作
  $('.postImages').on('click','.postImage_image',function () {
    var i = $(this).attr('id');
    location.href = 'view_image.php?image='+i;
  })

})
