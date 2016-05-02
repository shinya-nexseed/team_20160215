<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>Photovote</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
    <!-- ↑bootstrapの読み込み宣言を先にする -->
    <link rel="stylesheet" type="text/css" href="/assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="/assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/font-awesome/css/font-awesome.css">
  </head>
  <body>
    <!--
    ===================================================================
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
          <a class="navbar-brand" href="index.php">
            <i class="fa fa-camera-retro fa-1x fa-spin"></i>
          </a>
          <a href="index.php" class="navbar-brand">Photo vote</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="new.php">新規投稿</a></li>
            <li><a href="users/index.php?id=<?php echo h($_SESSION['id']); ?> " >会員情報</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <!--↑bootstrapでは、右端に寄せるクラス-->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span id="heder_p_icon"><img src="users/member_picture/<?php echo h($member['picture_path']); ?>"></span> 
                <strong><?php echo h($member['nick_name']); ?>さん</strong>
                <span class="glyphicon glyphicon-chevron-down"></span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <div class="navbar-login">
                    <div class="row">
                      <div class="col-lg-4">
                        <p class="text-center">
                          <span><img class="profile_picture" src="users/member_picture/<?php echo h($member['picture_path']); ?>"></span>
                        </p>
                      </div>
                      <div class="col-lg-8">
                        <p class="text-left"><strong><?php echo h($member['nick_name']); ?></strong></p>
                        <p class="text-left small"><?php echo h($member['email']); ?></p>
                        <p class="text-left">
                          <a href="users/index.php?=<?php echo h($_SESSION['id']); ?>" class="btn btn-primary btn-block btn-sm">マイプロフィール
                          </a>
                        </p>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="divider">
                  <li>
                    <div class="navbar-login navbar-login-session">
                      <div class="row">
                        <div class="col-lg-12">
                          <p><a href="signout.php" class="btn btn-danger btn-block">サインアウト</a></p>
                        </div>
                      </div>
                    </div>
                  </li>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </body>
</html>
