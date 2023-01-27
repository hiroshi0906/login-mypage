<?php
mb_internal_encoding("utf8");
session_start();

//db接続
try{
    $pdo = new PDO('mysql:dbname=lesson01;host=localhost:3306;','root', 'root');  
} catch(PDOException $e) {
    die("<p>申し訳ございません。サーバーが混み合っており一時的にアクセスができません。<br>しばらくしてから再度ログインをしてください。</p>
    <a href='http://localhost/site01/login_mypage/login_mypage/login.php'>ログイン画面へ</a>"
);
}

$mail = $_POST['mail'];
$password = $_POST['password'];

//指定したハッシュがパスワードにマッチしているかチェック
if(password_verify($password,$user_data["password"])){
     //DBのユーザー情報をセッションに保存
     $_SESSION['mail'] = $member['mail'];
     $_SESSION['name'] = $member['name'];
     $msg = 'ログインしました。';
     $link = '<a href="index.php">ホーム</a>';
}else{
    $msg = 'メールアドレスもしくはパスワードが間違っています。';
    $link = '<a href="login.php">戻る</a>';
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

        <meta charset="utf-8">
        <link rel="stylesheet" href="login_error.css" type="text/css">
        <title>ログインエラー</title>
    </head> 
    <body>

    <header>
		<img src="4eachblog_logo.jpg">
		<div class="login">
            <a href="login.php">ログイン</a><br>
            <a href="register.php">会員登録</a>
        </div>
	</header>
    
    <div class="container">
    
    <div class="keikoku">メールアドレスかパスワードが間違っています</div>
        
        
        <div class="toroku">
        <form action="mypage.php" method="post" >
            <p>メールアドレス</p><input type="text" value="<?php echo $_POST['mail']; ?>" name="mail">
            
            <p>パスワード</p>
            <input type="password" value="<?php echo $_POST['password']; ?>" name="password"><br>
            <input type="checkbox" class="checkbox"> ログイン状態を保持する<br>
            <input type="submit" size="35" class="button" value="ログイン">
         </form>
		</div>
        
    
    
    </div>




        
        <footer>
         copyright © internous| 4each blog the which provides A to Z about programming.
        </footer>
    </body>
    
</html>