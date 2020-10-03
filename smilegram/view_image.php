<?php
session_start();

// データベースの接続
// $dsn = 'mysql:dbname=smilegram;host=localhost';
// $user = 'root';
// $password = 'root';

$dsn = 'mysql:dbname=smile2020_smilegram;host=mysql1.php.xdomain.ne.jp';
$user = 'smile2020_kity';
$password = 'helloKity';


try{
  $db = new PDO($dsn, $user, $password,array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
 exit('データベース接続失敗。'.$e->getMessage());
}

if(isset($_GET['image']) ) {
  $image = $_GET['image'];
}

// コメント投稿
if (!empty($_POST['comment']) ) {

    // 保存する
    $sql = 'INSERT INTO comments(comment_id, img_id, icon, name, comment) VALUES (:comment_id, :img_id, :icon, :name, :comment)';
    $stmt = $db->prepare($sql);
    $stmt->execute([ ':comment_id'=>'', ':img_id'=>$image, ':icon'=>$_SESSION['icon'], ':name'=>$_SESSION['name'], ':comment'=>$_POST['comment'] ]);
    // $db = null;
    ?>
    <style media="screen">

    </style>
    <?php

}
// コメントの表示
$smt = $db -> prepare('SELECT * FROM comments WHERE img_id = :img_id ');
$smt->execute([':img_id'=>$image]);
$result = $smt->fetchAll(PDO::FETCH_ASSOC);

// 画像の表示
$sql = 'SELECT * FROM images WHERE image_id = :image_id';
$stmt = $db->prepare($sql);
$stmt->execute([':image_id'=>$image]);
$add_image = $stmt->fetch(PDO::FETCH_ASSOC);

 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=320,initial-scale=1">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="icon/favicon.ico">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="./js/view.js"></script>

    <title>メッセージ</title>
  </head>
  <body>
    <header class="header">
      <span class="backBtn">モイ</span>
      <div class="header_text">写真</div>
    </header>
    <main>
      <div class="viewcard">

        <div class="viewImage_profile">
          <div class="viewImage_profile_img">
            <img src="<?php echo $add_image['user_icon']; ?>" alt="">
          </div>
          <span class="viewImage_profile_name"><?php echo $add_image['user_name'] ?></span>
        </div>

        <div class="viewcard_img">
          <img src="<?php echo $add_image['img'] ?>" alt="">
        </div>

        <div class="linkBox">
          <span class="linkBox_heart"></span>
          <audio id="sound-file" preload="auto"></audio>
          <span class="linkBox_comment"></span>
        </div>

        <div class="viewcard_comment"><?php echo $add_image['message'] ?></div>

      </div>

      <div class="commentArea is-close">

        <div class="viewcomment">

          <?php foreach ($result as $key): ?>

            <div class="viewcomment_message">
              <div class="viewcomment_message_img" id="'+i+'"><img src="<?php echo $key['icon']; ?>"> </div>
              <div class="viewcomment_message_textBox" id="text'+i+'">
                <p class="viewcomment_message_text_name"><?php echo $key['name']; ?></p>
                <p class="viewcomment_message_text_text"><?php echo $key['comment']; ?></p>
              </div>
            </div>

          <?php endforeach; ?>

        </div>


        <div class="comment">
          <form class="comment_form" action="" method="post">
            <textarea name="comment" rows="2" cols="80"></textarea>
            <label class="comment_submit" for="comment_valueBtn">
               投稿 <input type="submit" value="" id="comment_valueBtn" style="display: none">
            </label>
          </form>
        </div>

      </div>
    </main>

    <footer class="footer">
      Have Fun!
    </footer>

  </body>
</html>
