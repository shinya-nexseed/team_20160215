<?php
    session_start();
    // 外部ファイルの読み込み
    require('../dbconnect.php');
    require('../functions.php');
    // ログイン判定
    $member = isSignin($db);
    // いいね機能
    if (!empty($_POST)) {
        if ($_POST['like'] === 'like'){
            $sql = sprintf('INSERT INTO `likes` SET member_id=%d, photo_id=%d',
                            $_SESSION['id'], //ログインしているidのデータ
                            $_POST['photo_id']
                          );
            mysqli_query($db, $sql) or die(mysqli_error($db));
        } else {
            // いいねデータの削除
            $sql = sprintf('DELETE FROM `likes` WHERE
                            member_id=%d AND photo_id=%d',
                            $_SESSION['id'],
                            $_POST['photo_id']
                          );
            mysqli_query($db, $sql) or die(mysqli_error($db));
        }
    }
    // ページング機能
    if (isset($_REQUEST['page'])) {
        $page = $_REQUEST['page'];
    } else {
        $page = 1;
    }
    if ($page == '') {
        $page = 1;
    }
    $page = max($page, 1);
    $sql = 'SELECT COUNT(*) AS cnt FROM photos';
    $recordSet = mysqli_query($db, $sql);
    $table = mysqli_fetch_assoc($recordSet);
    $maxPage = ceil($table['cnt'] / 24);
    $page = min($page, $maxPage);
    $start = ($page - 1) * 24;
    $start = max(0, $start);
    // 投稿写真データをここで取得
    $sql = sprintf('SELECT * FROM photos WHERE member_id = %d ORDER BY created DESC LIMIT %d,
          24',
          $_GET['id'],
          $start
    );
    $photos = mysqli_query($db, $sql) or die (mysqli_error($db));

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Photovote</title>
  <!-- bootstrapの方が先 -->
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css"> 
  <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/sample.css">
  <link rel="stylesheet" href="css/common.css">

</head>
<body>
    <!-- 
        =======================================================
        ヘッダー
    -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container"> 
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span> 
        </button>
        <a href="/" class="navbar-brand">Photovote</a>
      </div>
      <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="new.html">新規投稿</a></li>
            <li><a href="index.php">会員一覧</a></li>
          </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-user"></span> 
                <strong><?php echo $member['nick_name']; ?></strong>
                <span class="glyphicon glyphicon-chevron-down"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <div class="navbar-login">
                  <div class="row">
                    <div class="col-lg-4">
                      <p class="text-center">
                        <span class="glyphicon glyphicon-user icon-size"></span>
                      </p>
                    </div>
                    <div class="col-lg-8">
                      <p class="text-left"><strong><?php echo $member['nick_name']; ?></strong></p>
                      <p class="text-left small"><?php echo $member['introduction']; ?></p>
                      <p class="text-left">
                        <a href="view.php" class="btn btn-primary btn-block btn-sm">マイプロフィール</a>
                        <a href="setting.php" class="btn btn-primary btn-block btn-sm">設定</a>
                      </p>
                    </div>
                  </div>
                </div>
              </li>
              <li class="divider"></li>
              <li>
                <div class="navbar-login navbar-login-session">
                  <div class="row">
                    <div class="col-lg-12">
                      <p>
                        <a href="#" class="btn btn-danger btn-block">ログアウト</a>
                      </p>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    </div>

<div class="container">
  <div class="row">
    <legend>My Profile</legend>
    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
      <div class="col-xs-4 col-xs-offset-2">
        <img src="member_picture/<?php echo $member['picture_path']; ?>" alt="" class="imgView" width="100px" height="100px"><br>
      </div>
      <div class="fb-profile-text">   
        <div class="col-xs-4">
            <h1><?php echo ($member['nick_name']); ?></h1>
            <p><?php echo ($member['introduction']); ?></p>
            <a href="edit.php" class="btn pull-right btn-danger" style="margin-left: 10px;">Edit</a>
            <a href="../index.php" class="btn pull-right btn-warning">Home</a>
          <div class="form-group">
          </div>     
        </div>
      </div>          
    </form>
  </div>
</div>
<br><br><br>
<hr>
    <!-- 
        =======================================================
        コンテンツ
    -->

    <div class="container">
      <div class="row">
        <section id="pinBoot">
          <?php while ($photo = mysqli_fetch_assoc($photos)):?>
            <?php
                // ログインユーザーが選択している写真にいいね!しているデータを取得
                $sql = sprintf('SELECT * FROM `likes` WHERE member_id=%d
                                AND photo_id=%d',
                                $_SESSION['id'],
                                $photo['id']
                              );
                $likes = mysqli_query($db, $sql) or die(mysqli_error($db));
                // 表示されている写真のidを元に、そのidに紐づくいいね!データが何件あるかカウントする
                $sql = sprintf('SELECT COUNT(*) AS likes FROM likes WHERE photo_id=%d', $photo['id']);
                $counts = mysqli_query($db, $sql) or die(mysql_error($db));
                $count = mysqli_fetch_assoc($counts);
            ?>
            <article class="white-panel">
              <div class="box">
                <a href="#" data-toggle="modal" data-target="#<?php echo h($photo['id']); ?>">
                  <img src="../vote_photo/<?php echo h($photo['photo_path']); ?>" alt="">
                </a>
                <div class="modal fade" id="<?php echo h($photo['id']); ?>" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <button type="button" class="btn_close" data-dismiss="modal" aria-label="Close">close
                      </button>
                      <div class="modal-body">
                        <img src="vote_photo/<?php echo h($photo['photo_path']); ?>">
                        <h4><?php echo h($photo['title']); ?></h4>
                        <p><?php echo h($photo['comment']); ?></p>
                        <p class="vote_count">
                          <i class="fa fa-gratipay fa-2x" aria-hidden="true"></i>
                          現在の投票数<?php echo h($count['likes']) ;?>
                        </p>
                      </div>
                      <form action="" method="post">
                        <?php if ($like = mysqli_fetch_assoc($likes)): ?>
                          <input type="hidden" name="like" value="unlike" >
                          <input type="hidden" name="photo_id" value="<?php echo h($photo['id']); ?>" >
                          <div id="button">
                            <input type="submit"  class="btn btn-sm btn-primary"value="投票を取り消す">
                          </div>
                        <?php else: ?>
                          <input type="hidden" name="like" value="like">
                          <input type="hidden" name="photo_id" value="<?php echo h($photo['id']); ?>">
                          <div id="button">
                            <input type="submit" class="btn btn-sm btn-primary" value="この写真に投票!">
                          </div>
                        <?php endif; ?>
                      </form>
                      <div class="jump-edit">
                        <?php if ($_SESSION['id'] == $photo['member_id']): ?>
                           [<a href="edit.php?id=<?php echo h($photo['id']); ?>">編集はこちら</a>/
                            <a href="delete.php?id=<?php echo h($photo['id']); ?>" onclick="return confirm('本当に削除しますか？'); ">削除</a>]
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
                <h5><?php echo ($photo['title']); ?></h5>
                <p><?php echo h($photo['comment']); ?></p>
                <p class="vote_count">
                  <i class="fa fa-gratipay fa-2x" aria-hidden="true"></i>
                  投票数<?php echo h($count['likes']) ;?>
                </p>
              </div>
            </article>
          <?php endwhile; ?>
        </section>
        <hr>
      </div>
    </div>
    <div class="paging">
      <ul>
        <?php if ($page > 1) { ?>
          <li><a href="view.php?id=<?php $_GET['id']; ?>page=<?php print($page - 1); ?>">前のページへ</a></li>
        <?php } else { ?>
          <li></li>
        <?php } ?>
        <?php if ($page < $maxPage) { ?>
          <li><a href="view.php?id=<?php $_GET['id']; ?>page=<?php print($page + 1); ?>">次のページへ</a></li>
        <?php } else { ?>
          </li></li>
        <?php } ?>
      </ul>
    </div>

    <!-- 
        =======================================================
        フッター
    -->
    <div class="container">
      <div class="row">
      <hr>
        <div class="col-lg-12">
          <div class="col-md-8">
            <a href="#">Terms of Service</a> | <a href="#">Privacy</a>    
          </div>
          <div class="col-md-4">
            <p class="muted pull-right">© 2013 Company Name. All rights reserved</p>
          </div>
        </div>
      </div>
    </div>


<!-- JSファイルの読み込みはbodyの一番下がデファクトスタンダード -->
<script type="text/javascript" src="../assets/js/jquery-1.12.3.min.js"></script>
<!-- jQueryファイルが一番最初 -->
<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
<!-- jQueryファイルの次にbootstrapのJSファイル -->
<script type="text/javascript" src="../assets/js/main.js"></script>
</body>
</html>