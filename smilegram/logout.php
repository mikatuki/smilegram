<?php
session_start();

//セッション変数のクリア
$_SESSION = array();

//セッションクリア
@session_destroy();

header( "Location:./login.php" ) ;
exit ;


 ?>
