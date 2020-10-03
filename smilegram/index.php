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
$smt = $db -> prepare('select * from images');
$smt->execute();

// 実行結果を配列に返す。
$result = $smt->fetchAll(PDO::FETCH_ASSOC);

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
    <script src="./js/main.js"></script>

  </head>
  <body>
    <header class="header">
      <span class="header_logo">Smilegram</span>

        <span class="header_logout">
          <form class="" action="logout.php" method="post">
            <label for="logout_btn"> ログアウト <input type="submit" id="logout_btn" name="logout" value="" style="display: none"></label>
          </form>
        </span>

    </header>

    <main>
      <div class="mainContent">

        <section class="profile">
          <div class="userProfile">
            <div class="userProfile_img"><img src="image/akai.jpg" alt="プロフィール写真"></div>

            <div class="userProfile_textBox">
              <h2 class="userProfile_textBox_id">tour_2020</h2>
              <h2 class="userProfile_textBox_name">あかいさん</h2>
            </div>
          </div>

          <div class="userProfile_numbers">
            <div class="userProfile_numbers_postarea">
              <div class="">投稿</div>
              <div class="userProfile_numbers_post"><?php echo count($result); ?>件</div>
            </div>
            <a href="join.php">
              <div class="userProfile_numbers_postarea">
                <div class="">参加</div>
                <div class="userProfile_numbers_follower">びと</div>
            </a>
            </div>

            <a href="add_page.php">
              <div class="userProfile_numbers_postarea">
                <div class="">画像</div>
                <div class="userProfile_numbers_follow">投稿</div>
            </a>

          </div>

        </section>

        <div class="postImages">
          <?php  foreach ($result as $low): ?>

          <div class="postImage_image" id="<?php echo $low['image_id'] ?>" ><img src="<?php echo $low['img']; ?>" alt=""></div>

          <?php endforeach; ?>
        </div>

      </div>
    </main>
    <footer class="footer">
      お疲れ様でした！！！
    </footer>
  </body>
</html>
