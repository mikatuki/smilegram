<?php

if (!empty($_POST['id']) && !empty($_POST['pass'])) {
  session_start();

  $error_msg = "";

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

  // ユーザIDでSELECTする
  $sql = 'SELECT * FROM user WHERE id = :id';
  $stmt = $db->prepare($sql);
  $stmt->execute([':id'=>$_POST['id']]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // ユーザがいない
  if(!$user){
      $error_msg = 'ユーザ名かパスワードが正しくありません。';
  }

  // パスワードチェック
  if(!password_verify($_POST['pass'], $user['pass'])){
      $error_msg = 'ユーザ名かパスワードが正しくありません。';
  }

  if (password_verify($_POST['pass'], $user['pass']) && $user) {
    // ログイン
    $_SESSION['login'] = true;
    $_SESSION['name'] = $user['name'];
    $_SESSION['icon'] = $user['icon'];

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
    <title>smilegram</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="icon/favicon.ico">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="main.js"></script>

  <head>
    <meta charset="utf-8">
    <title>Smilegram_login</title>
  </head>
  <body>

    <main class="front_loginBox">
      <h2 class="front_titleLogo">Smilegram</h2>

      <form class="front_loginForm" action="login.php" method="post">

        <p class="error_message"><?php echo $error_msg ?></p>

        <table class="front_loginForm-Box">
          <tr>
            <td class="front_loginForm-Box_itemName"> <p class="front_loginForm_id">ID </p></td>
            <td class="front_loginForm-Box_item"><input type="text" name="id" value=""></td>
          </tr>
          <tr>
            <td class="front_loginForm-Box_itemName"> <p class="front_loginForm_psw">パスワード </p></td>
            <td class="front_loginForm-Box_item"><input type="text" name="pass" value=""></td>
          </tr>
        </table>

        <label class="front_loginForm_submit" for="valueBtn">
          ログイン
          <input type="submit" value="" id="valueBtn" style="display: none">
        </label>
      </form>

    </main>

  </body>
</html>
