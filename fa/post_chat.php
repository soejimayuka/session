<?php
  // セッションの開始
  session_start();

  // ファイルの読み込み
  require_once('../inc/config.php');
  require_once('../inc/functions.php');

  check_session_id();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メッセージ投稿</title>
  <link rel="stylesheet" href="../css/common.css" />
</head>
<body>
  <p class="p-breadcrumbs_wrapper"><a href="mypage.php" class="p-breadcrumbs">マイページに戻る</a></p>
  <section class="l-section">
    <div class="d-container">
      <form action="add_chat.php" method="post" name="form">

        <p>
          <input type="hidden" id="person" name="person" value="fam">
        </p>

        <h2 class="c-heading -third">メッセージ</h2>
        <div class="p-post_input -comment">
          <textarea name="txt" id="txt"></textarea>
        </div>

        <p>
          <input type="hidden" name="token" value="<?php echo h($_SESSION['token']); ?>">
        </p>

        <p class="l-btn d-spacer" data-y="min:smallTop min:smallBottom"><input type="submit" value="送信" class="c-button -btn -red"></p>


      </form>
    </div>
  </section>
</body>
</html>