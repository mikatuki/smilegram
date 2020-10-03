$(function (){

  var test ="";
  var voice = "";

  // バックボタンを押した時の遷移
  $('.backBtn').click(function () {
    var headerName = '';
    headerName = $('.header_text').text();

    if (headerName == "コメント") {
      $('.header_text').text("写真");
      $('.viewcard').removeClass('is-close');
      $('.commentArea').addClass('is-close');
    } else {
      window.location.href = 'index.php';
    }
  })

  // ハートボタンを押した時
  $('.linkBox_heart').click(function () {
      $('#sound-file').attr('src', 'voice/shine1.wav');
      $( '#sound-file' )[0].currentTime = 0;
      $( '#sound-file' )[0].play() ;
  })

  // コメントボタンを押した時の遷移
  $('.linkBox_comment').click(function () {
    $('.commentArea').removeClass('is-close');
    $('.viewcard').addClass('is-close');
    $('.header_text').text("コメント");

  })

})
