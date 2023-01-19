<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>ログイン：家族さま</title>
  <link rel="stylesheet" href="../css/common.css" />
</head>
<body>
  <section class="l-section">
    <h1 class="c-heading -first">ログイン</h1>
    <div class="d-container">
      <form action="receive.php" method="post" class="p-login">
        <dl>
          <dt><label for="username">名前</label></dt>
          <dd>
            <input type="text" name="username" id="username">
          </dd>
          <dt><label for="password">パスワード</label></dt>
          <dd>
            <input type="password" name="password" id="password">
          </dd>
        </dl>
        <p class="l-btn"><input type="submit" value="ログイン" class="c-button -btn -red"></p>
      </form>
    </div>
  </section>
</body>
</html>