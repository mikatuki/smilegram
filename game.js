$(function () {

  var num = 8;
  var sugoi = 0;

  var atrk = [{"question": 'erumo.jpg',"answer": 'セサミストリート4-Dムービーマジック'},{"question": 'fly.jpg',"answer": 'フライング・スヌーピー'},
  {"question": 'minion.jpg',"answer": 'ミニオン・ハチャメチャ・ライド'},{"question": 'space.jpg',"answer": 'スペース・ファンタジー・ザ・ライド'},
  {"question": 'hippo.jpg',"answer": 'フライト・オブ・ザ・ヒッポグリフ'},{"question": 'kity.jpg',"answer": 'ハローキティのリボン・コレクション'},
  {"question": 'waa.jpg',"answer": 'ジュラシック・パーク・ザ・ライド'},{"question": 'joze.jpg',"answer": 'ジョーズ'} ] ;

  $('.start').click(function() {

      $('.gameText').children('p').text("");
      $('.gameText').children('img').attr('src', 'image/'+atrk[num-1].question);

      $('.start').addClass('is-close');
      $('.wakaru').removeClass('is-close');
      $('.muri').removeClass('is-close');
  })

  $('.wakaru').click(function() {
    var text =  $('.wakaru').text();

    if(text == '次') {
      $('.wakaru').text('わかる');
      $('.muri').text('むり');
    }else {
      sugoi++;
    }

    num--;

    if(num > 0) {
      $('.gameText').children('p').text("");
      $('.gameText').children('img').attr('src', 'image/'+atrk[num-1].question);

      $('.start').addClass('is-close');
      $('.wakaru').removeClass('is-close');
      $('.muri').removeClass('is-close');

    } else {
      console.log(sugoi);
      switch (sugoi) {
        case 1:
        case 2:
          sugoi = 'あんまり';
          break;
        case 3:
        case 4:
          sugoi = 'まあまあ';
          break;
        case 5:
        case 6:
          sugoi = 'すごい';
          break;
        case 7:
        case 8:
          sugoi = 'プロ';
          break;
      }

      $('.gameText').children('img').attr('src', '');
      $('.gameText').children('p').text(sugoi);

      $('.start').text('さいすたーと');
      $('.start').removeClass('is-close');
      $('.wakaru').addClass('is-close');
      $('.muri').addClass('is-close');

      num = 8;
      sugoi = 0;
    }
  })

  $('.muri').click(function() {
    $('.gameText').children('p').text(atrk[num-1].answer);
    $('.wakaru').text('次');
    $('.muri').text('((｀･∀･´))');
  })


})
