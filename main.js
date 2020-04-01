$ (function () {

  // 画像の読み込み
  $.getJSON('https://mikatuki.github.io/smilegram/test.json', function(data){
    $('.userProfile_numbers_post').text(data.length+'件');

      for (var i = 0; i < data.length; i++) {
        $('.postImages').append('<div class="postImage_image"><img src="image/'+data[i].img+'"alt=""></div>');
        var width = $('.postImage_image').width();
        $('.postImage_image').height(width);
      }
  });

  // 画像をクリックした時の動作
  $('.postImages').on('click','.postImage_image',function () {
    var i = $('.postImage_image').index(this);
    location.href = 'view_image.html?image='+i;
  })


})
