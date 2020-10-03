<?php
  session_start();

  if(empty($_SESSION['name']) ) {
    header( "Location:./login.php" ) ;
    exit ;
  }
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

  // 画像の表示
  $smt = $db -> prepare('select * from user');
  $smt->execute();

  // 実行結果を配列に返す。
  $result = $smt->fetchAll(PDO::FETCH_ASSOC);

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=320,initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="icon/favicon.ico">
    <title>参加してるひと</title>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="./js/main.js"></script>
  </head>
  <body>
    <header class="header">
      <span class="backBtn"><a href="index.php">モイ</a></span>
      <div class="header_text">参加してるひと</div>
    </header>
    <main>
      <div class="joinMember">
        <div class="joinMember_box">
          <?php foreach ($result as $key ) :?>

            <div class="joinMember_box_card">
              <div class="joinMember_box_icon">
                <img class="joinMember_box_card_icon" src="<?php echo $key['icon']; ?>" alt=""> </div>
              <div class="joinMember_box_profile_name"><?php echo $key['name']; ?></div>
            </div>

          <?php endforeach; ?>

        </div>


      </div>
    </main>

    <footer class="footer">
      Innovators
    </footer>

  </body>
</html>
