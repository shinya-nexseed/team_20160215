<?php
    session_start();
    require('../dbconnect.php');
    require('../functions.php');

    //signup.php以外からの本ページへの遷移を阻止する
    if(!isset($_SESSION['join'])){
        header('Location: index.php');
        exit();
    }

    //メインの処理
    if(!empty($_POST)){
        $sql = sprintf('INSERT INTO members SET nick_name="%s", email="%s", password="%s", picture_path="%s", created=NOW(), modified=NOW(), introduction=""',
                    mysqli_real_escape_string($db, $_SESSION['join']['nick_name']),
                    mysqli_real_escape_string($db, $_SESSION['join']['email']),
                    mysqli_real_escape_string($db, sha1($_SESSION['join']['password'])),
                    mysqli_real_escape_string($db, $_SESSION['join']['image']),
                    date('Y-m-d H:i:s')
                    );
        mysqli_query($db, $sql) or die(mysqli_error($db));
        unset($_SESSION['join']);
        header('Location: thanks.php');
        exit();
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Photo vote</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
  </head>
  <body>
    <!---========== Content ==========--->
    <div class="container-fluid">
      <h1><i class="fa fa-camera-retro"></i> Photovote</h1>
      <div class="container">

        <!---========== resistration form ==========--->
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
              <div class="panel-body">
                <div class="row">
                  <div class="col-lg-12">
                    <!-- form start -->
                    <form action="thanks.php" method="post" id="register-form" role="form" style="display: block;">
                      <input type="hidden" name="action" value="submit">
                      <h2>Sign Up</h2>
                      <p class="message">
                        入力内容を確認し、<br>この内容でよろしければ「送信」ボタンを押してください。
                      </p>

                      <!---========== status bar ==========--->
                      <section>
                        <div class="wizard">
                          <div class="wizard-inner">
                            <div class="connecting-line">
                            </div>
                              <ul class="nav nav-tabs" role="tablist">

                                <li role="presentation" class="disabled">
                                  <a href="signup.html" data-toggle="tab" aria-controls="step1" role="tab" title="書き直す">
                                    <span class="round-tab">
                                      <i class="fa fa-pencil"></i>
                                    </span>
                                  </a>
                                </li>

                                <li role="presentation" class="active">
                                  <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                                    <span class="round-tab">
                                      <i class="fa fa-check"></i>
                                    </span>
                                  </a>
                                </li>

                                <li role="presentation" class="disabled">
                                  <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                                    <span class="round-tab">
                                      <i class="fa fa-hand-peace-o"></i>
                                    </span>
                                  </a>
                                </li>
                              </ul>
                          </div>
                        </div>
                      </section>
                      <!-- status bar end -->

                      <!-- form confirmation -->
                      <div class="form-group">
                        <img id="profile-img" class="profile-img-card" src="../member_picture/<?php echo htmlspecialchars($_SESSION["join"]["image"], ENT_QUOTES, 'UTF-8'); ?>" width="100" height="100" alt="<?php echo htmlspecialchars($_SESSION['join']['nick_name'], ENT_QUOTES, 'UTF-8'); ?>">
                        <table class="confirm">
                            <th><span class="cfm-item">Username</span></th>
                            <td><?php echo htmlspecialchars($_SESSION['join']['nick_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                          <tr>
                            <th><span class="cfm-item">Email Address</span></th>
                            <td><?php echo htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                          <tr>
                            <th><span class="cfm-item">Password</span></th>
                            <td>**********</td>
                          <tr>
                        </table>
                      </div>
                      <!-- rewrite and submit button -->
                      <div class="form-group">
                        <div class="row">
                          <div class="col-xs-6 form-group pull-left">
                            <a href="signup.php?action=rewrite" class="form-control btn btn-login">書き直す</a>
                          </div>
                          <div class="col-xs-6 form-group pull-right">
                            <input type="submit" tabindex="4" class="form-control btn btn-login" value="送信">
                          </div>
                        </div>
                      </div>
                    </form>
                    <!-- form end -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Do you have an account? -->
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
             <div class="panel panel-login">
               <div class="panel-body">
                 <div class="row">
                   <div class="col-lg-12">
                     <div class="transfer">
                       <p>アカウントをお持ちですか？</p>
                       <a href="signin.php">Sign in</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- resister end -->

      </div>
    </div>

    <!---========== Footer ==========--->
    <footer>
      <div class="container">
        <div class="col-md-10 col-md-offset-1 text-center">
          <h6>Copyright© <a href="http://nexseed.net" target="_blank">Nexseed.inc</a> All rights reserved.</h6>
        </div>
      </div>
    </footer>

    <!-- JS start -->
    <script type="text/javascript" src="../assets/js/jquery-1.12.3.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="../assets/js/main.js"></script>
  </body>
</html>
