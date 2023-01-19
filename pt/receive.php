<?php
  // セッションの開始
  session_start();

  // ファイルの読み込み
  require_once('../inc/config.php');
  require_once('../inc/functions.php');

  // ログインユーザーを変数で管理
  $username = $_POST['username']; // ユーザー名
  $password = $_POST['password']; // パスワード


  // データベースへ接続
  $dbh = new PDO(DSN, DB_USER, DB_PASSWORD);
  $sql = 'SELECT * FROM users_table WHERE username=:username AND password=:password AND deleted_at IS NULL';
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':username', $username, PDO::PARAM_STR);
  $stmt->bindValue(':password', $password, PDO::PARAM_STR);
  try {
    $status = $stmt->execute();
  } catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
  }

// ユーザ有無で条件分岐
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  if (!$user) {
    // ログイン失敗
    header('Location: ./');
    exit();
  } else {
    $_SESSION = array();
    $_SESSION['session_id'] = session_id();
    $_SESSION['is_admin'] = $user['is_admin'];
    $_SESSION['username'] = $user['username'];

    header('Location: mypage.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>ログイン完了：利用者さま</title>
  <link rel="stylesheet" href="../css/common.css" />
</head>
<body>
  <section class="l-section">
    <h1 class="c-heading">ログイン完了</h1>

    <p class="u-center d-spacer" data-y="min:smallBottom"><?php echo htmlspecialchars($msg, ENT_QUOTES, 'UTF-8'); ?></p>

    <ul>
      <li class="l-btn_secondary">
        <a href="mypage.php" class="c-button_secondary -btn_secondary">マイページ</a>
      </li>
      <li class="l-btn_secondary">
        <a href="./" class="c-button_secondary -btn_secondary">ログイン画面に戻る</a>
      </li>
    </ul>
  </section>
</body>
</html>