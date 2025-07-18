<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>五人組登録画面</title>
  <link rel="stylesheet" href="css/style4.css">
</head>
<body>
  <!-- ヘッダー -->
  <div class="wrapper">
        <header class="header">
            <div class="header-logo">🧠 LINE爆撃くん</div>
            <nav class="nav-menu">
            <ul>
              <li><a href="login.php">📝 新規会員登録/ログイン</a></li>
              <li><a href="Top.php">🏠 ホーム</a></li>
              <li><a href="">👥 グループ情報</a></li>
              <li><a href="mypage.php">👤 マイページ（ユーザー情報）</a> </li>
              <li><a href="zinkaku.php">🔔 通知キャラ設定ガチャ</a> </li>
              <li><p><?php echo $_SESSION['email'] ?></p></li>
              <li><a href="login.php">ログアウト</a> </li>
            </ul>
            </nav>
        </header>

  <div class="container">
    <h1>👥 グループ 登録画面</h1>

    <!-- グループID登録 -->
    <section class="group-section">
      <h2>グループIDの登録</h2>
      <input type="text" id="groupIdInput" placeholder="グループIDを入力">
      <button id="registerGroupBtn">登録</button>
      <p id="groupStatus" class="status-msg"></p>
    </section>

    <!-- メンバー一覧 -->
    <section class="member-section">
      <h2>メンバー一覧</h2>
      <ul id="memberList">
        <!-- メンバーが追加される -->
      </ul>
      <input type="text" id="memberNameInput" placeholder="メンバー名を入力">
      <button id="addMemberBtn">追加</button>
    </section>

    <!-- 爆撃ルール表示 -->
    <section class="rules-section">
      <h3>爆撃ルールを選択</h3>
      <form id="rulesForm">
        <label>
          <input type="checkbox" name="rule" value="毎週最低1タスクを完了させる">
          🌟 毎週最低1タスクを完了させる
        </label><br>
        <label>
          <input type="checkbox" name="rule" value="未達成者は全員から圧を受ける">
          💣 未達成者は全員から圧を受ける
        </label><br>
        <label>
          <input type="checkbox" name="rule" value="進捗はグループ全員に共有される">
          👁️ 進捗はグループ全員に共有される
        </label><br>
        <label>
          <input type="checkbox" name="rule" value="3回サボると罰ゲーム（任意）">
          🚫 3回サボると罰ゲーム（任意）
        </label><br>
        <label>
          <input type="checkbox" name="rule" value="メンバーのランダム相互チェック">
          🎲 メンバーのランダム相互チェック
        </label><br>
        <button type="button" id="saveRulesBtn">ルールを保存</button>
      </form>

      <h4>✅ 選択中のルール</h4>
      <ul id="selectedRulesList"></ul>
    </section>
  </div>

  <script src="script/gonigumi.js"></script>
</body>
</html>

