<?php
mb_internal_encoding("utf8");

//DB
$pdo = new PDO('mysql:dbname=lesson01;host=localhost:3306;','root', 'root');
//prepared
$stmt = $pdo->prepare("insert into login_mypage(name,mail,password,picture,comments)values(?,?,?,?,?)");


$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['path_filename']);
$stmt->bindValue(5,$_POST['comments']);

$stmt->execute();
$pdo = NULL;

header('Location:after_register.html');
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>マイページ登録</title>
		<link rel="stylesheet" href="after_register.css" type="text/css">
	</head>
	<body>
		<div class="thanks">登録ありがとうございました。</div>
	</body>
</html>
