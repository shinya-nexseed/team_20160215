<?php
    $url = $_SERVER['REQUEST_URI'];
    //debug
    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // var_dump($url);
?>

    <!--=========================　Header　===========================-->
    <!--=========================　URLにより条件を分岐させる　===========================-->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <?php if(strpos($url,'/team_20160215/users/index.php') !== false || strpos($url,'/team_20160215/users/edit.php') !== false || strpos($url,'/team_20160215/users/view.php') !== false || strpos($url,'/team_20160215/users/setting.php') !== false): ?>
              <a class="navbar-brand" href="../index.php"><i class="fa fa-camera-retro fa-1x fa-spin"></i></a>
          <?php else: ?>
              <a class="navbar-brand" href="index.php"><i class="fa fa-camera-retro fa-1x fa-spin"></i></a>
          <?php endif; ?>
          <!-- 下記の$urlとREQUEST_URI内にある$url(var_dumpしたもの)が一致していること -->
          <?php if(strpos($url,'/team_20160215/users/index.php') !== false || strpos($url,'/team_20160215/users/edit.php') !== false || strpos($url,'/team_20160215/users/view.php') !== false || strpos($url,'/team_20160215/users/setting.php') !== false): ?>
              <a href="../index.php" class="navbar-brand">Photo vote</a>
          <?php else: ?>
              <a href="index.php" class="navbar-brand">Photo vote</a>
          <?php endif; ?>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
              <?php if(strpos($url,'/team_20160215/users/index.php') !== false || strpos($url,'/team_20160215/users/edit.php') !== false || strpos($url,'/team_20160215/users/view.php') !== false || strpos($url,'/team_20160215/users/setting.php') !== false): ?>
                  <li><a href="../rank.php" >ランキング</a></li>
                  <li><a href="../new.php">新規投稿</a></li>
                  <li><a href="../users/index.php">会員情報</a></li>
              <?php else: ?>
                  <li><a href="rank.php" >ランキング</a></li>
                  <li><a href="new.php">新規投稿</a></li>
                  <li><a href="users/index.php">会員情報</a></li>
              <?php endif; ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <!--↑bootstrapでは、右端に寄せるクラス-->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span id="heder_p_icon">
                  <?php if(strpos($url,'/team_20160215/users/index.php') !== false || strpos($url,'/team_20160215/users/edit.php') !== false || strpos($url,'/team_20160215/users/view.php') !== false || strpos($url,'/team_20160215/users/setting.php') !== false): ?>
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
                          <?php if(strpos($url,'/team_20160215/users/index.php') !== false || strpos($url,'/team_20160215/users/edit.php') !== false || strpos($url,'/team_20160215/users/view.php') !== false || strpos($url,'/team_20160215/users/setting.php') !== false): ?>
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
                          <?php if(strpos($url,'/team_20160215/users/index.php') !== false || strpos($url,'/team_20160215/users/edit.php') !== false || strpos($url,'/team_20160215/users/view.php') !== false || strpos($url,'/team_20160215/users/setting.php') !== false): ?>
                              <a href="view.php?id=<?php echo $member['id']; ?>" class="btn btn-primary btn-block btn-sm">マイプロフィール</a>
                              <a href="setting.php?id=<?php echo $_SESSION['id']; ?>" class="btn btn-primary btn-block btn-sm">設定</a>
                              <a href="edit.php?id=<?php echo $_SESSION['id']; ?>" class="btn btn-danger btn-block btn-sm">Edit</a>
                          <?php else: ?>
                              <a href="users/view.php?id=<?php echo $member['id']; ?>" class="btn btn-primary btn-block btn-sm">マイプロフィール</a>
                              <a href="users/setting.php?id=<?php echo $_SESSION['id']; ?>" class="btn btn-primary btn-block btn-sm">設定</a>
                              <a href="users/edit.php?id=<?php echo $_SESSION['id']; ?>" class="btn btn-danger btn-block btn-sm">Edit</a>
                          <?php endif; ?>
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
                          <?php if(strpos($url,'/team_20160215/users/index.php') !== false || strpos($url,'/team_20160215/users/edit.php') !== false || strpos($url,'/team_20160215/users/view.php') !== false || strpos($url,'/team_20160215/users/setting.php') !== false): ?>
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
