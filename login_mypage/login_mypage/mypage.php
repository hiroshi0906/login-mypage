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

if(empty($_SESSION['id'])){
    header("Location:login_error.php");
}


if(!empty($_POST['login_keep'])){
    $_SESSION['login_keep']=$_POST['login_keep'];
}

if(!empty($_SESSION['id']) && !empty($_SESSION['login_keep'])){
    setcookie('mail',$_SESSION['mail'],time()+60*60*24*7);
    setcookie('password',$_SESSION['password'],time()+60*60*24*7);
    setcookie('login',$_SESSION['login_keep'],time()+60*60*24*7);
} else if(empty($_SESSION['login_keep'])){
    setcookie('mail','',time()-1);
    setcookie('password','',time()-1);
    setcookie('login_keep','',time()-1);
}

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="mypage.css" type="text/css">
        <title>マイページ登録</title>
    </head> 
    <body>
   
        <header>
            <img src="4eachblog_logo.jpg">
            <div class="logout">
                <a href="log_out.php">ログアウト</a>
            </div>
        </header>
        
            <div class="box">
                <h1>会員情報</h1>
                <div class="hello">
                    <?php echo "こんにちは！  ".$_SESSION['name']."さん"; ?>
                </div>
                <div class="profile_pic">
                    <img src="<?php echo $_SESSION['picture']; ?>">
                </div>
                <div class="basic_info">
                    <p>氏名: <?php echo $_SESSION['name']; ?></p>
                    <p>メール: <?php echo $_SESSION['mail']; ?></p>
                    <p>パスワード: <?php echo $_SESSION['password']; ?></p>
                </div>
                <div class="comments">
                    <p>コメント: <?php echo $_SESSION['comments']; ?></p> 
                </div>
                <br>
                
                <form action="mypage_hensyu.php" method="post" class="form_center">
                    <input type="hidden" value="<?php echo rand(1,10);?>" name="form_mypage">
                    <input type="submit" class="submit_button" size="35" value="編集する">
                </form>   
            </div>
 
  
            
        <footer>
            copyright © internous| 4each blog the which provides A to Z about programming.  
        </footer>
    </body>
    
</html>