<?php
session_start();
if(!isset($_SESSION['username'])) {
  $_SESSION['username'] = ''; 
}

if(isset($_POST['email'])){
  $_SESSION['email'] = $_POST['email'];
  header("Location: Top.php");
  exit();
}

if(isset($_POST['delete'])) {
  //セッション変数初期化
  $_SESSION = array();

//cookieを削除する
if(!isset($_COOKIE['PHPSESSID'])){
    setcookie(session_name(), '', time()-42000, '/');
}

//セッション破棄
session_destroy();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <title>新規登録 | LINE爆撃くん</title>
  <link rel="stylesheet" href="css/style2.css">
</head>
<body>
  <div class="wrapper">
    <header class="header">
      <div class="header-logo">🧠 LINE爆撃くん</div>
      
    </header>

    <div class="container">
      <div class="login-container">
        <h1>📝ログイン</h1>       
        
        <form id="authForm" action="" method="post">
          <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" required>
          </div>
          <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" id="password" required>
          </div>
          <button type="submit">ログイン</button>
          <a href="newadd.php">サインアップ画面へ</a>
        </form>

        <p id="message" style="color: red;">初めての方はサインアップをお願いします！</p>
      </div>
    </div>
  </div>

  <script type="module" src="script/acuh.js"></script>
</body>
</html>
