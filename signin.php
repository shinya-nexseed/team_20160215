<?php
  require('dbconnect.php');
  require('functions.php');

  session_start();

  //COOKIEの設定
  if(isset($_COOKIE['email'])){
    if($_COOKIE['email']!=''){
      $_POST['email']=$_COOKIE['email'];
      $_POST['password']=$_COOKIE['password'];
      $_POST['save']='on';
    }
  }

  //ログイン処理
  if(!empty($_POST)){

    //ログインしている
    if($_POST['email']!='' && $_POST['password']!=''){
      echo "hoge2";
      echo "<br>";
      $sql = sprintf('SELECT * FROM members WHERE email="%s" AND password="%s"',
              mysqli_real_escape_string($db, $_POST['email']),
              mysqli_real_escape_string($db, sha1($_POST['password']))
      );
      $record = mysqli_query($db, $sql) or die(mysqli_error($db));

      if($table = mysqli_fetch_assoc($record)){

        //ログイン成功
        $_SESSION['id'] = $table['user_id'];
        $_SESSION['time'] = time();
        // //ログインを記録
        if($_POST['remember']=='on'){
          setcookie('email', $_POST['email'], time()+60*60*24*14);
          setcookie('password', $_POST['password'], time()+60*60*24*14);
        }

        header('Location: index.php');
        exit();
      }else{
        //ログイン失敗
        $error['login'] = 'failed';
      }
    }else{
      //未入力
      $error['login'] = 'blank';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Photo vote</title>
    <!-- <link rel="stylesheet" href="../assets/css/bootstrap.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="../assets/css/main.css"> -->
  </head>
  <body>
    <!---========== Navbar ==========--->
    <!-- <div class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a target="_blank" href="#" class="navbar-brand"><i class="fa fa-camera"></i>Photovote</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="#">Inicio</a></li>
            <li class="active"><a href="http://bootsnipp.com/snippets/featured/nav-account-manager" target="_blank">Inspirado en este ejemplo</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">DropDown
                <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">Link 2</a></li>
                </ul>
              </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-user"></span> 
                <strong>Username</strong>
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
                        <p class="text-left"><strong>Nombre Apellido</strong></p>
                        <p class="text-left small">correoElectronico@email.com</p>
                        <p class="text-left">
                          <a href="#" class="btn btn-primary btn-block btn-sm">Show your profile</a>
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
                          <a href="#" class="btn btn-danger btn-block">Sign in</a>
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
    </div> -->

    <!---========== Content ==========--->
    <div class="container-fluid">
      <h1><i class="fa fa-camera-retro"></i> Photovote</h1>
      <div class="container">
        <!-- login form -->
         <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
              <div class="panel-body">
                <div class="row">
                  <div class="col-lg-12">
                    <form id="login-form" action="" method="post" role="form" style="display: block;">
                      <h2>SIGN IN</h2>

                      <!-- error alert -->
                      <?php if(!empty($error['login'])): ?>
                        <?php if($error['login']=='blank'): ?>
                          <p>メールアドレスとパスワードを入力してください</p>
                        <?php endif; ?>
                        <?php if($error['login']=='failed'): ?>
                          <p>メールアドレスまたはパスワードが違います</p>
                        <?php endif; ?>
                      <?php endif; ?>

                        <div class="form-group">
                          <?php if(!empty($_POST['email'])): ?>
                            <input type="text" name="email" id="username" tabindex="1" class="form-control" placeholder="Email" value="<?php echo htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8'); ?>">
                          <?php else: ?>
                            <input type="text" name="email" id="username" tabindex="1" class="form-control" placeholder="Email" value="">
                          <?php endif; ?>
                        </div>
                        <div class="form-group">
                          <?php if(!empty($_POST['password'])): ?>
                            <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8'); ?>">
                          <?php else: ?>
                            <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" value="">
                          <?php endif; ?>
                        </div>
                        <div class="col-xs-6 form-group pull-left checkbox">
                          <input id="checkbox1" type="checkbox" name="remember" value="on">
                          <label for="checkbox1">Remember Me</label>
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                              <input type="submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Sign in">
                            </div>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- don't you have an Account? -->
        <div class="row">
         <div class="col-md-6 col-md-offset-3">
           <div class="panel panel-login">
             <div class="panel-body">
               <div class="row">
                 <div class="col-lg-12">
                   <div class="transfer">
                     <p>アカウントをお持ちではないですか？</p>
                     <a href="join/signup.php">Sign up</a>
                  </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
       <!-- login end -->
      </div>

    <!---========== Footer ==========--->
    <footer>
      <div class="container">
        <div class="col-md-10 col-md-offset-1 text-center">
          <!-- <h6 style="font-size:14px;font-weight:100;color: #fff;">Copyright© <a href="http://nexseed.net" style="color: #fff;" target="_blank">Nexseed.inc</a> All rights reserved.</h6> -->
        </div>
      </div>
    </footer>
    <!-- JS start -->
    <!-- <script type="text/javascript" src="../assets/js/jquery-1.12.3.min.js"></script> -->
    <!-- <script type="text/javascript" src="../assets/js/bootstrap.js"></script> -->
    <!-- <script type="text/javascript" src="../assets/js/main.js"></script> -->
  </body>
</html>
