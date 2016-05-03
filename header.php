<?php
    $url = $_SERVER['REQUEST_URI'];
    //※ここ後ほど消します
    //__DIR__ . /ディレクトリ名;
    // echo __DIR__;
?>

    <!--=========================　Header　===========================-->
    <!--=========================　URLにより条件を分岐させる　===========================-->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <?php if($url=="users/"): ?>
              <a class="navbar-brand" href="<?php echo __DIR__; ?>/users/index.php">
          <?php else: ?>
              <a class="navbar-brand" href="<?php echo __DIR__; ?>/index.php">
          <?php endif; ?>
            <i class="fa fa-camera-retro fa-1x fa-spin"></i>
          </a>
          <?php if($url=="users/index.php"||"users/edit.php"||"users/setting.php"||"users/view.php"): ?>
              <a href="../index.php" class="navbar-brand">Photo vote</a>
          <?php else: ?>
              <a href="index.php" class="navbar-brand">Photo vote</a>
          <?php endif; ?>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
              <?php if($url=="users/"): ?>
                  <li><a href="<?php echo __DIR__; ?>/new.php">新規投稿</a></li>
                  <li><a href="<?php echo __DIR__; ?>/users/index.php?id=<?php echo h($_SESSION['id']); ?>">会員情報</a></li>
              <?php else: ?>
                  <li><a href="<?php echo __DIR__; ?>/new.php">新規投稿</a></li>
                  <li><a href="<?php echo __DIR__; ?>/users/index.php?id=<?php echo h($_SESSION['id']); ?>">会員情報</a></li>
              <?php endif; ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <!--↑bootstrapでは、右端に寄せるクラス-->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span id="heder_p_icon">
                  <?php if($url=="users/index.php"||"users/edit.php"||"users/setting.php"||"users/view.php"): ?>
                      <img src="member_picture/<?php echo h($member['picture_path']); ?>">
                  <?php else: ?>
                      <img src="users/member_picture/<?php echo h($member['picture_path']); ?>">
                  <?php endif; ?>
                </span> 
                <strong><?php echo h($member['nick_name']); ?>さん</strong>
                <span class="glyphicon glyphicon-chevron-down"></span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <div class="navbar-login">
                    <div class="row">
                      <div class="col-lg-4">
                        <p class="text-center">
                          <?php if($url=="users/index.php"||"users/edit.php"||"users/setting.php"||"users/view.php"): ?>
                              <span><img class="profile_picture" src="member_picture/<?php echo h($member['picture_path']); ?>"></span>
                          <?php else: ?>
                              <span><img class="profile_picture" src="users/member_picture/<?php echo h($member['picture_path']); ?>"></span>
                          <?php endif; ?>
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
                          <?php if($url=="users/index.php"||"users/edit.php"||"users/setting.php"||"users/view.php"): ?>
                              <p><a href="../signout.php" class="btn btn-danger btn-block">サインアウト</a></p>
                          <?php else: ?>
                              <p><a href="signout.php" class="btn btn-danger btn-block">サインアウト</a></p>
                          <?php endif; ?>
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
