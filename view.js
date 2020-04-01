$(function (){

  var test ="";
  var voice = "";

  // バックボタンを押した時の遷移
  $('.backBtn').click(function () {
    var headerName = '';
    headerName = $('.header_text').text();

    if (headerName == "コメント" || headerName == "のっとコメント！") {
      $('.header_text').text("写真");
      $('.viewcard').removeClass('is-close');
      $('.viewcomment').addClass('is-close');
    } else {
      window.location.href = 'index.html';
    }
  })

  $.getJSON('https://mikatuki.github.io/smilegram/test.json', function(data){
    var query = location.search;
    var value = query.split('=');
    var i = value[1];

    $('.viewImage_profile_name').text(data[i].name);
    $('.viewcard_comment').text(data[i].message);
    $('.viewImage_profile_img').children('img').attr('src', 'image/'+data[i].user_icon);
    $('.viewcard_img').children('img').attr('src', 'image/'+data[i].img);
    voice = data[i].voice;

    test = data[i].comment;
    var name = "";
    var icon = "";

    for (var i = 0; i < test.length; i++) {

      $('.viewcomment').append('<div class="viewcomment_message"><div class="viewcomment_message_img" id="'+i+'"><img></div><div class="viewcomment_message_textBox" id="text'+i+'"><p class="viewcomment_message_text_name">'+test[i].name+'</p><p class="viewcomment_message_text_text">'+test[i].text+'</p></div>');
      $('#'+i).children('img').attr('src', 'image/'+test[i].icon);

      if(test[i].name == "") {
        $('#'+i).children('img').remove();
        $('#text'+i).append('<style>#text'+i+':before { display: none; } </style>');
      }
    }

  });

  // ハートボタンを押した時
  $('.linkBox_heart').click(function () {
    if (voice != "") {
      $('#sound-file').attr('src', 'voice/'+voice);
      $( '#sound-file' )[0].currentTime = 0;
      $( '#sound-file' )[0].play() ;
    } else {
      $('#sound-file').attr('src', 'voice/shine1.wav');
      $( '#sound-file' )[0].currentTime = 0;
      $( '#sound-file' )[0].play() ;
    }
  })

  // コメントボタンを押した時の遷移
  $('.linkBox_comment').click(function () {
    $('.viewcomment').removeClass('is-close');
    $('.viewcard').addClass('is-close');

    if(test) {
      $('.header_text').text("コメント");
    } else {
      $('.header_text').text("のっとコメント！");
      // $('.viewcomment').css('background-image', 'url(image/IMG_7355.jpg)');
      // $('.viewcomment').css('background-size', 'cover');
      // $('.viewcomment').css('height', '100vh');
    }
  })

})
