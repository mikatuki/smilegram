<?php

if (!empty($_POST['message']) && !empty($_FILES['addImage'])) {
  session_start();

  $error_m = "";

  // // データベースの接続
  // $dsn = 'mysql:dbname=smilegram;host=localhost';
  // $user = 'root';
  // $password = 'root';

  // データベースの接続
  $dsn = 'mysql:dbname=smile2020_smilegram;host=mysql1.php.xdomain.ne.jp';
  $user = 'smile2020_kity';
  $password = 'helloKity';


  try{
    $db = new PDO($dsn, $user, $password,array(PDO::ATTR_EMULATE_PREPARES => false));
  } catch (PDOException $e) {
   exit('データベース接続失敗。'.$e->getMessage());
  }

  // 拡張子をみる
  $tmp = pathinfo($_FILES['addImage']['name']);
  $extension = $tmp['extension'];

  // if (!exif_imagetype($extension) ) {
  //   $error_m = "画像ファイルではありません。";
  // }

  // 名前の変更
  $tempfile = $_FILES['addImage']['tmp_name'];
  $filename = 'image/' . date("Ymd-His") .'.'.$extension;

  // 画像の保存
  if (is_uploaded_file($tempfile)) {
    if ( move_uploaded_file($tempfile , $filename )) {
    // アップロードしました。";
    } else {
      $error_m = "ファイルをアップロードできません。";
    }
  }else {
    $error_m = "ファイルが選択されていません。";
  }

  if($error_m == "") {
    // 保存する
    $sql = 'INSERT INTO images(image_id, user_icon, user_name, img, message) VALUES (:image_id, :user_icon, :user_name, :img, :message)';
    $stmt = $db->prepare($sql);
    $stmt->execute([ ':image_id'=>'', ':user_icon'=>$_SESSION['icon'], ':user_name'=>$_SESSION['name'], ':img'=>$filename, ':message'=>$_POST['message'] ]);
    $db = null;

    header( "Location:./index.php" ) ;
    exit ;

  }

}
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
    <script src="./js/add.js"></script>

    <title>写真追加</title>
  </head>
  <body>
    <header class="header">
      <span class="backBtn"><a href="index.php">モイ</a></span>
      <div class="header_text">写真追加</div>
    </header>

    <main>
        <div class="add_profile">
          <form class="add_profile_form" action="add_page.php" method="post" enctype="multipart/form-data">

            <label for="add_img" class="add_img_text">
              <span class="add_img_text_btn"></span>
              <input type="file" id="add_img" name="addImage" value="" style="display:none">
              <img id="preview" class="is-close">
            </label>

            <div class="add_message">
              <p class="error_message"><?php echo $error_m ?></p>
              <textarea name="message" rows="8" cols="80"></textarea>
            </div>

            <label class="add_submit" for="add_valueBtn">
               投稿 <input type="submit" value="" id="add_valueBtn" style="display: none">
            </label>

        </form>
      </div>
    </main>
  </body>

</html>
