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

    //ログイン処理（送信した後）
    //送信ボタンを押した後の処理
    if(!empty($_POST)){
        //Email,PWが入力されている
        if($_POST['email']!='' && $_POST['password']!=''){

            $sql = sprintf('SELECT * FROM members WHERE email="%s" AND password="%s"',
                    mysqli_real_escape_string($db, $_POST['email']),
                    mysqli_real_escape_string($db, sha1($_POST['password']))
            );
            $record = mysqli_query($db, $sql) or die(mysqli_error($db));

            if($table = mysqli_fetch_assoc($record)){

                //ログイン成功
                $_SESSION['id'] = $table['id'];
                $_SESSION['time'] = time();//ログインした時間
                //ログインを記録
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

    //「タイムアウトしてきたのか」を判定
    //エラー判定のフラグを立てる
    if(isset($_SESSION['timeout'])){
        //エラー文の表示のためのフラグを立てる
        //タイムアウト時の処理
        $error['timeout'] = 'timeout';
        // 空の配列を$_SESSIONに追加＝SESSION内をからにする
        $_SESSION = array();
        //セッションの初期化
        session_unset();
        //セッションの削除
        session_destroy();
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Photo vote</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
  </head>
  <body>
    <!---========== Alert ==========--->
    <?php if(!empty($error['timeout'])): //ログインエラーに何かある時?>
        <?php if($error['timeout']=='timeout'): //ログインにタイムアウトエラーがある時?>
            <div class="alert-group">
              <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong><i class="fa fa-exclamation-triangle"></i>Notice</strong> セッションがタイムアウトしました。再度ログインしてください。
              </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
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
                              <p><i class="fa fa-exclamation-circle"></i>メールアドレスとパスワードを入力してください</p>
                          <?php endif; ?>
                          <?php if($error['login']=='failed'): ?>
                              <p><i class="fa fa-exclamation-circle"></i>メールアドレスまたはパスワードが違います</p>
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
          <h6>Copyright© <a href="http://nexseed.net" target="_blank">Nexseed.inc</a> All rights reserved.</h6>
        </div>
      </div>
    </footer>
    <!-- JS -->
    <script type="text/javascript" src="assets/js/jquery-1.12.3.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
  </body>
</html>
