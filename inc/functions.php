<?php
// XSS対策
function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

// CSRF対策 トークンの生成
function set_token() {
  if (!isset($_SESSION['token'])) {
      $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
  }
}

// CSRF対策 トークンの確認
function check_token() {
  if (empty($_POST['token']) || $_POST['token'] != $_SESSION['token']) {
    echo '不正な投稿（トークンが一致しません。）';
    exit();
  }
}




// ログイン状態のチェック関数

function check_session_id()
{
  if (!isset($_SESSION["session_id"]) ||$_SESSION["session_id"] !== session_id()) {
    // ログインしていない
    // ログインフォームへリダイレクト
    header('Location: ./');
    exit();
  } else {
    session_regenerate_id(true);
    $_SESSION["session_id"] = session_id();
  }
}