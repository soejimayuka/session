<?php
  // セッションの開始
  session_start();

  // ファイルの読み込み
  require_once('../inc/config.php');
  require_once('../inc/functions.php');

  check_session_id();

// chat_app
  try {
    // データベースへ接続
    $dbh_chat = new PDO(DSN_chat, DB_USER_chat, DB_PASSWORD_chat);

     // エラー発生時に「PDOException」という例外を投げる設定に変更
    $dbh_chat->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL文の作成
   $sql_chat = 'SELECT * FROM posts WHERE id = ?';

    // ステートメント用意　?は後から変数を埋め込むマークだと知らせる
    $stmt_chat = $dbh_chat->prepare($sql_chat);

    // プレースホルダーに値をガッチャンコ
    $stmt_chat->bindValue(1, (int)$_GET['id'] , PDO::PARAM_INT);

    // ステートメントを実行　ガッチャンコしたときはexecuteで実行する　queryメソッドはできない
    $stmt_chat->execute();

    // 実行結果を連想配列として取得　fetchとfetchAllがある 1件なのでfetchでOK
    $result_chat = $stmt_chat->fetch(PDO::FETCH_ASSOC);
    // echo '<pre>';
    // print_r($result_chat);
    // echo '<pre>';

    // データベースとの接続を終了
    $dbh_chat = null;

  } catch (PDOException $e) {
    //　例外発生時の処理
    echo 'エラー' . h($e->getMessage());
    exit();
  }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FA:メッセージ編集</title>
  <link rel="stylesheet" href="../css/common.css" />
</head>
<body>
  <p class="p-breadcrumbs_wrapper"><a href="mypage.php" class="p-breadcrumbs">マイページに戻る</a></p>
  <section class="l-section">
    <div class="d-container">
      <h1 class="c-heading -third">メッセージの編集</h1>


      <form action="update_chat.php" method="post" enctype="multipart/form-data">


        <div class="p-post_input -comment">
          <textarea name="txt" id="txt" cols="30" rows="10"><?php echo h($result_chat["txt"]); ?></textarea>
        </div>
        <p><input type="hidden" name="id" value="<?php echo h($result_chat['id']); ?>"></p>
        <p><input type="hidden" name="token" value="<?php echo h($_SESSION['token']); ?>"></p>

        <p class="l-btn d-spacer" data-y="min:smallTop min:smallBottom"><input type="submit" value="変更" class="c-button -btn -red"></p>
      </form>
    </div>
  </section>
</body>
</html>