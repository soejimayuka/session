<?php
  // セッションの開始
  session_start();

  // ファイルの読み込み
  require_once('../inc/config.php');
  require_once('../inc/functions.php');

  check_session_id();


  try {
    // データベースへ接続
    $dbh = new PDO(DSN, DB_USER, DB_PASSWORD);

    // エラー発生時に「PDOException」という例外を投げる設定に変更
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL文の作成　記事IDと一致するレコードの抽出　SQLインジェクションの脆弱性対策
    $sql = 'SELECT * FROM posts WHERE created >= CURRENT_DATE';

    // ステートメント用意　?は後から変数を埋め込むマークだと知らせる
    $stmt = $dbh->prepare($sql);

    // SQLを実行
    $stmt = $dbh->query($sql);

    // 実行結果を連想配列として取得　fetchとfetchAllがある 1件なのでfetchでOK
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    // echo '<pre>';
    // print_r($result);
    // echo '<pre>';




    // SQL文の作成
    // 日付
    $sql = 'SELECT created FROM posts ORDER BY created DESC LIMIT 7 ';

    // SQLを実行
    $stmt = $dbh->query($sql);

    // 実行結果を連想配列として取得
    $createds = $stmt->fetchALL(PDO::FETCH_ASSOC);
    // echo '<pre>';
    // print_r($createds);
    // echo '<pre>';



    // SQL文の作成
    // 体温
    $sql = 'SELECT temp FROM posts ORDER BY created DESC LIMIT 7 ';

    // SQLを実行
    $stmt = $dbh->query($sql);

    // 実行結果を連想配列として取得
    $temps = $stmt->fetchALL(PDO::FETCH_ASSOC);
    // echo '<pre>';
    // print_r($temps);
    // echo '<pre>';


    // SQL文の作成
    // 脈拍
    $sql = 'SELECT pulse FROM posts ORDER BY created DESC LIMIT 7 ';
    // SQLを実行
    $stmt = $dbh->query($sql);

    // 実行結果を連想配列として取得
    $pulses = $stmt->fetchALL(PDO::FETCH_ASSOC);


    // SQL文の作成
    // 最高血圧
    $sql = 'SELECT sbp FROM posts ORDER BY created DESC LIMIT 7 ';

    // SQLを実行
    $stmt = $dbh->query($sql);

    // 実行結果を連想配列として取得
    $sbps = $stmt->fetchALL(PDO::FETCH_ASSOC);


    // SQL文の作成
    // 最低血圧
    $sql = 'SELECT dbp FROM posts ORDER BY created DESC LIMIT 7 ';

    // SQLを実行
    $stmt = $dbh->query($sql);

    // 実行結果を連想配列として取得
    $dbps = $stmt->fetchALL(PDO::FETCH_ASSOC);
    // print_r($dbps);



    // データベースとの接続を終了
    $dbh = null;

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
  <title>今日の体調</title>
  <link rel="stylesheet" href="../css/common.css" />
</head>
<body>

  <p class="p-breadcrumbs_wrapper"><a href="mypage.php" class="p-breadcrumbs">マイページに戻る</a></p>
  <section class="l-section">
    <div class="d-container">
      <p class="p-detail_timeTitle">入力した時間：</p>
      <p class="p-detail_time">
        <time datetime="<?php if(!empty($result)){echo h($result['created']); }?>">
      <?php  if(!empty($result)){echo h(date('Y/m/d h:i', strtotime($result['created'])));} ?></time>
      </p>


      <div class="p-detail">
        <p class="p-detail_title">今日の体調は</p>
        <p class="p-detail_result">
          <?php
          if (!empty($result)) {
            echo h($result['cond']);
          }else{
            echo h("まだ入力されていません");
          }
          ?>
        </p>
        <p class="p-detail_title">今日の体温は</p>
        <p class="p-detail_result">
          <?php
          if (!empty($result)) {
            echo h($result['temp']);
          }else{
            echo h("まだ入力されていません");
          }
          ?>
        </p>
        <p class="p-detail_title">今日の脈拍は</p>
        <p class="p-detail_result">
          <?php
          if (!empty($result)) {
            echo h($result['pulse']);
          }else{
            echo h("まだ入力されていません");
          }
          ?>
        </p>
        <p class="p-detail_title">今日の血圧は</p>
        <p class="p-detail_result">
          <?php
          if (!empty($result)) {
            echo h($result['sbp']); ?><span>／</span><?php echo h($result['dbp']);
          }else{
            echo h("まだ入力されていません");
          }
          ?>
        </p>

      </div>

      <h2 class="c-heading -third">あなたのメッセージ</h2>
      <div class="p-chatInput__wrapper">
        <p class="p-detail_result -message">
          <?php
          if (!empty($result)) {
            echo h($result['comment']);
          }else{
            echo h("");
          }
          ?>
        </p>
      </div>
  </section>


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


  <!-- データ取得/created -->
  <?php
  $array_created = []
?>

  <?php foreach($createds as $row) : ?>
  <?php array_push($array_created, $row['created']) ?>
  <?php endforeach; ?>


  <?php
  $strings_createds = [date('m/d', strtotime($array_created[6])), date('m/d', strtotime($array_created[5])),date('m/d', strtotime($array_created[4])),date('m/d', strtotime($array_created[3])),date('m/d', strtotime($array_created[2])),date('m/d', strtotime($array_created[1])),date('m/d', strtotime($array_created[0]))];
  $json_array_created = json_encode($strings_createds,JSON_NUMERIC_CHECK);
?>


  <!-- データ取得/temp -->
  <?php
  $array_temp = []
?>

  <?php foreach($temps as $row) : ?>
  <?php array_push($array_temp, $row['temp']) ?>
  <?php endforeach; ?>
  <?php
  $strings_temps = [$array_temp[6], $array_temp[5],$array_temp[4],$array_temp[3],$array_temp[2],$array_temp[1],$array_temp[0]];
  $json_array_temp = json_encode($strings_temps,JSON_NUMERIC_CHECK);
?>
  <!-- データ取得/pulse -->
  <?php
  $array_pulse = []
?>
  <?php foreach($pulses as $row) : ?>
  <?php array_push($array_pulse, $row['pulse']) ?>
  <?php endforeach; ?>
  <?php
  $strings_pulses = [$array_pulse[6], $array_pulse[5],$array_pulse[4],$array_pulse[3],$array_pulse[2],$array_pulse[1],$array_pulse[0]];
  $json_array_pulse = json_encode($strings_pulses,JSON_NUMERIC_CHECK);
?>
  <!-- データ取得/sbp -->
  <?php
  $array_sbp = []
?>
  <?php foreach($sbps as $row) : ?>
  <?php array_push($array_sbp, $row['sbp']) ?>
  <?php endforeach; ?>
  <?php
  $strings_sbps = [$array_sbp[6], $array_sbp[5],$array_sbp[4],$array_sbp[3],$array_sbp[2],$array_sbp[1],$array_sbp[0]];
  $json_array_sbp = json_encode($strings_sbps,JSON_NUMERIC_CHECK);
?>
  <!-- データ取得/dbp -->
  <?php
  $array_dbp = []
?>
  <?php foreach($dbps as $row) : ?>
  <?php array_push($array_dbp, $row['dbp']) ?>
  <?php endforeach; ?>
  <?php
  $strings_dbps = [$array_dbp[6], $array_dbp[5],$array_dbp[4],$array_dbp[3],$array_dbp[2],$array_dbp[1],$array_dbp[0]];
  $json_array_dbp = json_encode($strings_dbps,JSON_NUMERIC_CHECK);
?>

  <section class="l-section -second">
    <div class="d-container">
      <div class=p-chart_wrapper>
        <p class="p-chart_txt">♥ 体温</p>
        <canvas class="radar" id="myChart_temp"></canvas>
      </div>
      <div class=p-chart_wrapper>
        <p class="p-chart_txt">♥ 心拍数</p>
        <canvas class="radar" id="myChart_pulse"></canvas>
      </div>
      <div class=p-chart_wrapper>
        <p class="p-chart_txt">♥ 血圧</p>
        <canvas class="radar" id="myChart_bp"></canvas>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


  <script>
  //js-chart 体温
  const ctx_temp = document.getElementById('myChart_temp');
  var myChart_temp = new Chart(ctx_temp, {
    type: 'line',
    data: {
      labels: <?php echo $json_array_created ?>,
      datasets: [{
        label: '体温',
        data: <?php echo $json_array_temp ?>,
        borderWidth: 3,
        borderColor: "rgba(255,182,185,1)",
      }]
    },
    options: {
      scales: {
        r: {
          angleLines: {
            display: false
          },
          suggestedMin: 0,
          suggestedMax: 10
        }
      },
      plugins: {
        legend: {
          display: false
        }
      }
    }
  });

  //js-chart 脈拍
  const ctx_pulse = document.getElementById('myChart_pulse');
  var myChart_pulse = new Chart(ctx_pulse, {
    type: 'line',
    data: {
      labels: <?php echo $json_array_created ?>,
      datasets: [{
        label: '脈拍',
        data: <?php echo $json_array_pulse ?>,
        borderWidth: 3,
        borderColor: "rgba(213,164,207,1)",
      }]
    },
    options: {
      scales: {
        r: {
          angleLines: {
            display: false
          },
          suggestedMin: 0,
          suggestedMax: 10
        }
      },
      plugins: {
        legend: {
          display: false
        }
      }
    }
  });

  //js-chart 血圧
  const ctx_bp = document.getElementById('myChart_bp');
  var myChart_pulse = new Chart(ctx_bp, {
    type: 'line',
    data: {
      labels: <?php echo $json_array_created ?>,
      datasets: [{
          label: '最高血圧',
          data: <?php echo $json_array_sbp ?>,
          borderWidth: 3,
          borderColor: "rgba(187,222,214,1)",
        },
        {
          label: '最低血圧',
          data: <?php echo $json_array_dbp ?>,
          borderWidth: 3,
          borderColor: "rgba(138,198,209,1)",
        },
      ]
    },
    options: {
      scales: {
        r: {
          angleLines: {
            display: false
          },
          suggestedMin: 0,
          suggestedMax: 10
        }
      },
      plugins: {
        legend: {
          display: false
        }
      }
    }
  });
  </script>


</body>
</html>