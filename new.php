<?php
    session_start();
    require('dbconnect.php');
    require('functions.php');

    // ログイン判定
    $member = isSignin($db);

    //新規投稿
    if (!empty($_POST)) {
        if ($_POST['title'] == '') {
            $error['title'] = 'blank';
        }

        if ($_POST['comment'] == '') {
            $error['comment'] = 'blank';
        }

        // 対象画像拡張子は.jpgとJEPG
        $fileName = $_FILES['image']['name'];
        if(!empty($fileName)) {
            $ext = substr($fileName, -4);
            if ($ext != '.jpg' && $ext != '.JPG' && $ext != 'jpeg' && $ext != 'JPEG') {
                $error['image'] = 'type';
            }
        }

        // エラーがなければ
        if(empty($error)){
            echo 'hoge';
            $image = date('YmdHis') . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],'vote_photo/' . $image);
            $sql = sprintf('INSERT INTO photos SET photo_path="%s" , title="%s" , comment="%s" , member_id="%d", created=NOW()',
                $image,
                m($db, $_POST['title']),
                m($db, $_POST['comment']),
                m($db, $member['id']),
                date('Y-m-d H:i:s')
            );
            mysqli_query($db, $sql) or die(mysqli_error($db));

            header('Location: index.php');
            exit();
        }
    }
?>

  <!DOCTYPE html>
  <html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>Photovote</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.css">
  </head>
  <body>
  <!--
  ===================================================================
  ヘッダー
  -->
  <!-- 他ページと統一でrequireにより取得 -->
  <?php require('header.php'); ?>

  <!--
  ===================================================================
  コンテンツ
  -->

  <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading"><strong>新規投稿</strong>
        <small>&nbsp;&nbsp;&nbsp;&nbsp;あなたのベストショットを投稿しよう！</small>
      </div>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="panel-body">
          <h5>写真をアップロードしてください。<span class="required">*</span></h5>
          <input type="file" name="image">
          <?php if(!empty($error['image'])): ?>
            <?php if($error['image'] == 'blank'): ?>
              <p class="required">選択されていません</p>
            <?php endif; ?>
            <?php if($error['image'] == 'type'): ?>
              <p class="required">jpgで指定してください</p>
            <?php endif; ?>
          <?php endif; ?>
          <br>
          <div class="control-group">
            <h5>投稿タイトルを入力してください。<span class="required">*</span></h5>
            <div class="controls">
              <?php if(!empty($_POST['title'])): ?>
                <input type="text" name="title" value="<?php echo h($_POST['title']); ?>">
              <?php else: ?>
                <input type="text" name="title" value="">
              <?php endif; ?>
              <!-- phpでエラー内容出力 -->
              <?php if(!empty($error['title'])): ?>
                <?php if($error['title'] == 'blank'): ?>
                  <p class="required">投稿タイトルを入力してください。</p>
                <?php endif; ?>
              <?php endif; ?>
            </div>
          </div>
          <br>
          <div class="control-group">
            <h5>写真に関するエピソードを書いてみんなにアピールしよう！<span class="required">*</span></h5>
          </div>
          <div class="controls">
            <?php if(!empty($_POST['comment'])): ?>
              <textarea class="photo_message" name="comment" value="<?php echo h($_POST['comment']); ?>"></textarea>
            <?php else: ?>
              <textarea type="text" class="photo_message" name="comment"></textarea>
            <?php endif; ?>
            <?php if(!empty($error['comment'])): ?>
              <?php if($error['comment'] == 'blank'): ?>
                <p class="required"><i class=""></i>エピソードを入力してください。</p>
              <?php endif; ?>
            <?php endif; ?>
            <input type="submit" class="btn btn-sm btn-primary btn-post" id="js-upload-submit" value="投稿する">
            <a href="index.php" class="btn btn-sm btn-primary btn-post">戻る</a>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- /container -->

  <!--
  ===================================================================
  フッター
  -->
  <div class="container">
    <div class="row"><hr>
      <div class="col-lg-12">
        <p class="muted_footer">© 2016 <a href="http://nexseed.net">Nexseed inc</a>. All rights reserved</p>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="./assets/js/jquery-1.12.3.min.js"></script>
  <script type="text/javascript" src="./assets/js/bootstrap.js"></script>
  <script type="text/javascript" src="./assets/js/main.js"></script>
  </body>
  </html>
