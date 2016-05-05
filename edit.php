<?php
    session_start();
    require('dbconnect.php');
    require('functions.php');

    //ログイン
    $member = isSignin($db);

    $id = $_REQUEST['id'];
    $sql = 'SELECT * FROM photos WHERE id='.$id;
    $result = mysqli_query($db, $sql) or die (mysqli_error($db));
    $photo = mysqli_fetch_assoc($result);

    $error = array();

    if (!empty($_POST)) {


        //エラー項目の確認
        if (strlen($_POST['comment']) > 500){
          $error['comment'] = 'length';
        }

        if ($_POST['comment'] == '') {
          $error['comment'] = 'blank';
        }

        // 編集後のコメントを登録
        if (isset($_POST['comment']) && empty($error['comment'])) {
          $new_comment = $_POST['comment'];

          $sql = sprintf('UPDATE photos SET comment="%s" WHERE id=%d',
                  m($db, $new_comment),
                  m($db, $id)
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
  <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.css">
  <!-- ↑bootstrapの読み込み宣言を先にする -->
  <link rel="stylesheet" type="text/css" href="./assets/css/main.css">
  <link rel="stylesheet" type="text/css" href="./assets/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="./assets/font-awesome/css/font-awesome.css">
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
      <div class="panel-heading"><strong>『<?php echo h($photo['title']) ?>』のエピソードを編集しますか？</strong>
      </div>
      <div class="panel-body">
         <!-- Standar Form -->
        <h5>投稿されている写真は変更できません。&nbsp;&nbsp;
          <?php if ($_SESSION['id'] == $photo['member_id']): ?>
             [<a class="jump_delete" href="delete.php?id=<?php echo h($photo['id']); ?>" onclick="return confirm('本当に削除しますか？'); ">削除はこちら</a>]
          <?php endif; ?>
        </h5>
        <img class="photo_show" src="vote_photo/<?php echo h($photo['photo_path']) ; ?>">
        <br><br>

        <!-- エピーソード編集部分 -->
        <div class="control-group">
          <h5>エピソードの編集ができます。<span class="required">*</span></h5>
          <form action="" method="post" enctype="multipart/form-data">
            <?php if(!empty($_POST['comment'])): ?>
              <textarea type="text" name="comment" class="photo_message"><?php echo h($photo['comment']); ?></textarea>
            <?php else: ?>
              <textarea type="text" name="comment" class="photo_message"><?php echo h($photo['comment']); ?></textarea>
            <?php endif; ?>
            <?php if(!empty($error['comment'])): ?>
              <?php if($error['comment'] == 'blank'): ?>
                <p class="required">エピソードを入力してください。</p>
              <?php endif; ?>
              <?php if($error['comment'] == 'length'): ?>
                <p class="required">エピソードは500文字以内で入力してください。</p>
              <?php endif; ?>
            <?php endif; ?>
            <input type="submit" class="btn btn-sm btn-primary btn-post" value="編集完了">
          </form>
        </div>
      </div>
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
        <p class="muted pull-right">© 2016 <a href="http://nexseed.net">Nexseed.inc</a> All rights reserved</p>
        </div>
      </div>
    </div>
  </div>
  <!-- jsファイルの読み込みはbodyの一番下がデファクトリスタンダード -->
  <!-- jQueryファイルが一番最初 -->
  <script type="text/javascript" src="./assets/js/jquery-1.12.3.min.js"></script>
  <!-- jQueryファイルの次にbootstrapのJSファイル -->
  <script type="text/javascript" src="./assets/js/bootstrap.js"></script>
  <script type="text/javascript" src="./assets/js/main.js"></script>
</body>
</html>
