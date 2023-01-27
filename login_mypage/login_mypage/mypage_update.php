<?php
mb_internal_encoding("utf8");
session_start();
//DB
$pdo = new PDO('mysql:dbname=lesson01;host=localhost:3306;','root', 'root');
//prepared
$stmt = $pdo->prepare("update login_mypage set name = ?, mail = ?, password = ?, comments = ? where id = ?");

$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['comments']);
$stmt->bindValue(5,$_SESSION['id']);
$stmt->execute();

$stmt = $pdo->prepare("select * from login_mypage where mail = ? && password = ?");
$stmt->bindValue(1,$_POST['mail']);
$stmt->bindValue(2,$_POST['password']);
$stmt->execute();

$pdo = NULL;

while($row=$stmt->fetch()){
	$_SESSION['id']=$row['id'];
	$_SESSION['name']=$row['name'];
	$_SESSION['mail']=$row['mail'];
	$_SESSION['password']=$row['password'];
	$_SESSION['picture']=$row['picture'];
	$_SESSION['comments']=$row['comments'];
  }

header("Location:http://localhost/site01/login_mypage/login_mypage/mypage.php");

?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>マイページ編集</title>
		<link rel="stylesheet" href="mypage_update.css" type="text/css">
	</head>
   
		<header>
			<img src="4eachblog_logo.jpg">
				
		</header>
		<main>
			<div class="logout">
				<a href="log_out.php">ログアウト</a>
			</div>
            <div class="mypage">
                <a href="mypage.php">マイページに戻る</a> 
            </div>
			<div class="after_hensyu">編集が完了しました。</div>
		</main>
				
			<footer>
				copyright © internous| 4each blog the which provides A to Z about programming.  
			</footer>
</html>