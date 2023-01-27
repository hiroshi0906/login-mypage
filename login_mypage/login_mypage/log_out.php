<?php


mb_internal_encoding("utf8");
session_start();

//db接続
try{
    $pdo = new PDO('mysql:dbname=lesson01;host=localhost:3306;','root', 'root');  
}catch(PDOException $e){
    die("<p>申し訳ございません。サーバーが混み合っており一時的にアクセスができません。<br>しばらくしてから再度ログインをしてください。</p>
    <a href='http://localhost/site01/login_mypage/login_mypage/login.php'>ログイン画面へ</a>"
);
}
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
<title>ログアウト</title>
</head>
<body>
<h1>
<font size='5'>ログアウトしました</font>
</h1>
<p><a href='login.php'>ログインページに戻る</a></p>
</body>
</html>