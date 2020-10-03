<?php

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

  // 拡張子をみる
  $tmp = pathinfo($_FILES['icon']['name']);
  $extension = $tmp['extension'];
  // 名前の変更
  $tempfile = $_FILES['icon']['tmp_name'];
  $filename = 'user_icon/' . $_POST['id']. date("Ymd-His") .'.'.$extension;

  // 画像の保存
  if (is_uploaded_file($tempfile)) {
    if ( move_uploaded_file($tempfile , $filename )) {
    // アップロードしました。";
    } else {
      // ファイルをアップロードできません。
      header( "Location:./new.html" ) ;
      exit ;
    }
  }else {
    // ファイルが選択されていません。;
    header( "Location: ./new.html" ) ;
    exit ;

  }

  // 正規表現の確認
  if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['id']) || !preg_match("/^[a-zA-Z0-9]+$/", $_POST['psw'])) {
    header( "Location:new.html" ) ;
    exit ;
  }

  // パスワードのハッシュ可
  $hash = password_hash($_POST['psw'], PASSWORD_BCRYPT);

  // 保存する
  $sql = 'INSERT INTO user(user_id, id, name, pass, icon) VALUES (:user_id, :id, :name, :pass, :icon)';
  $stmt = $db->prepare($sql);
  $stmt->execute([ ':user_id'=>'', ':id'=>$_POST['id'], ':name'=>$_POST['user'], ':pass'=>$hash, ':icon'=>$filename ]);

  $message = "登録が完了しました。";

  $db = null;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=320,initial-scale=1">
    <title>完了</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="icon/favicon_0.ico">
    <style media="screen">
      p {
        text-align: center;
        margin-top: 70px;
      }
    </style>
  </head>
  <body>
    <header class="header">
      <div class="header_text">完了</div>
    </header>

    <main>
      <p><?php echo $message; ?></p>
    </main>
  </body>
</html>
