<?php
mb_internal_encoding("utf8");

session_start();

?>

<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>マイページ登録</title>
    <link rel="stylesheet" type="text/css" href="mypage_hensyu.css">
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
    
    <form action="mypage_update.php" method="post">
           
            <div class="hello">
                <?php echo "こんにちは！  ".$_SESSION['name']."さん"; ?>
            </div>
       <br>
            
        
            <div class="confirm">
                <div class="profile_pic">
                    <img src="<?php echo $_SESSION['picture']; ?>">
                </div>
            
                <div class="basic_info">
                    <p>氏名: <input type="text" size="30" value=" <?php echo $_SESSION['name']; ?>" name="name">
                    </p>
                    <p>メールアドレス: <input type="text" size="30" value=" <?php echo $_SESSION['mail']; ?>" name="mail">
                    </p>
                    <p>パスワード: <input type="text" size="30" value=" <?php echo $_SESSION['password']; ?>" name="password">
                    </p>   
                </div>
            </div>
        
           <div class="shita">
            <p>コメント: <input type="text" size="60" value=" <?php echo $_SESSION['comments']; ?>" name="comments">
            </p>
           </div>

        <input type="submit" class="submit_button" value="登録内容を変更">
    </form>
    </div>
	<footer>
    copyright © internous| 4each blog the which provides A to Z about programming.
	</footer>



</body>
</html>