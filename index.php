<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>LINE爆撃君</title>
  <link rel="stylesheet" href="css/style0.css">
</head>
<body>

  <header>LINE爆撃君へようこそ！</header>

  <div class="container">
    <img
      src="bakuhatu.jpg"
      alt="爆撃対象"
      class="bomb-image"
      id="clickableImage"
    />
    <div class="message">LINE爆撃君を爆撃しよう！（画像を10回クリックしてね！）<br>このサイトに対して攻撃は絶対にやめてください🥺🥺🥺お願いします<br>(これはフリではありません）マジでお願いします</div>
  </div>

  <script>
    let clickCount = 0;
    const image = document.getElementById('clickableImage');

    image.addEventListener('click', () => {
      clickCount++;
      if (clickCount >= 1) {
        window.location.href = 'login.php'; // ← 遷移先を変更可能
      }
    });
  </script>

</body>
</html>
