<?php
    session_start();

    // 外部ファイルの読み込み
    require('dbconnect.php');
    require('functions.php');

    //ログイン
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
            $sql = sprintf('DELETE FROM `likes` WHERE member_id=%d AND photo_id=%d',
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

    //いいね数順で投稿写真データを取得
    $sql = sprintf('SELECT photos.*, COUNT(likes.photo_id) AS cnt FROM photos LEFT JOIN likes ON photos.id=likes.photo_id GROUP BY photos.id ORDER BY cnt DESC LIMIT %d,24',
        $start
    );

    $photos = mysqli_query($db, $sql) or die(mysqli_error($db));
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
  <?php require('header.php'); ?>
  <!--
  ===================================================================
  コンテンツ
  -->
  <div class="container">
    <div class="row">
      <section id="pinBoot">
        <?php while ($photo = mysqli_fetch_assoc($photos)): ?>
          <?php
              $sql = sprintf('SELECT * FROM `likes` WHERE member_id=%d
                              AND photo_id=%d',
                              $_SESSION['id'],
                              $photo['id']
                            );
              $likes = mysqli_query($db, $sql) or die(mysqli_error($db));

              $sql = sprintf('SELECT COUNT(*) AS likes FROM likes WHERE photo_id=%d', $photo['id']);
              $counts = mysqli_query($db, $sql) or die(mysql_error($db));
              $count = mysqli_fetch_assoc($counts);
          ?>

          <article class="white-panel">
            <div class="box">
              <a href="#" data-toggle="modal" data-target="#<?php echo h($photo['id']); ?>">
                <img src="vote_photo/<?php echo h($photo['photo_path']); ?>" alt="">
              </a>
              <div class="modal fade" id="<?php echo h($photo['id']); ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <button type="button" class="btn_close" data-dismiss  ="modal" aria-label="Close">close
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
                          <input type="submit" class="btn btn-sm btn-primary" value="投票を取り消す">
                        </div>
                      <?php else: ?>
                        <input type="hidden" name="like" value="like">
                        <input type="hidden" name="photo_id" value="<?php echo h($photo['id']); ?>">
                        <div id="button">
                          <input type="submit" class="btn btn-sm btn-primary" value="この写真に投票する">
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
              <h5>
                <?php echo h($photo['title']); ?>
              </h5>
              <p>
                <?php echo h($photo['comment']); ?>
              </p>
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

  <div id="paging">
    <ul style="padding: 0;">
      <?php if ($page > 1) { ?>
        <li><a href="index.php?page=<?php print($page - 1); ?>">Back<i class="fa fa-backward" aria-hidden="true"></i></a>&nbsp;&nbsp;</li>
      <?php } else { ?>
        <li>First<i class="fa fa-backward" aria-hidden="true">&nbsp;&nbsp;</i></li>
      <?php } ?>
      <?php if ($page < $maxPage) { ?>
        <li>&nbsp;&nbsp;<a href="index.php?page=<?php print($page + 1); ?>"><i class="fa fa-forward" aria-hidden="true">Next</i></a></li>
      <?php } else { ?>
        </li>&nbsp;&nbsp;<i class="fa fa-forward" aria-hidden="true">End</i></li>
      <?php } ?>
    </ul>
  </div>

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
