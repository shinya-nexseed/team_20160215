<?php
/////////HTML内のコメントアウトはphp実装後に解除

    ////connect to DB
    //require('../dbconnect.php');

    session_start();

    ////validation:データが何もない場合はアラート表示
    //エラーの一時的な格納用
    $error = array();

    if(!empty($_POST)){
        if($_POST['nick_name']==''){
            $error['nick_name']='blank';
        }

        if($_POST['email']==''){
            $error['email']='blank';
        }
        //PW文字数超過または不足
        if(strlen($_POST['password'])<4){
            $error['password']='length';
        }
        if(strlen($_POST['password'])>16){
            $error['password']='length';
        }
        //PW未入力
        if($_POST['password']==''){
            $error['password']='blank';
        }
        if($_POST['confirm-password']==''){
            $error['confirm-password']='blank';
        }
        //不一致の場合
        if($_POST['password'] != $_POST['confirm-password']){
            $error['confirm-password']='incorrect';
        }

        //画像UPのエラー
        $filename = $_FILES['image']['name'];
        if(!empty($filename)){
          $ext = substr($filename, -3);
          if($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg'){
            $error['image'] = 'type';
          }
        }

        if(empty($error)){
          //画像のアップロード
          $image = date('YmdHis').$_FILES['image']['name'];
          move_uploaded_file($_FILES['image']['tmp_name'], '../member_picture/' . $image);
        }

        //エラーがなかった
        var_dump($error);

        if(empty($error)){
          $_SESSION['join'] = $_POST;
          $_SESSION['join']['image'] = $image;
          header('Location: check.php');
          exit();
        }
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Photo vote</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/main01.css">
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
          <a target="_blank" href="#" class="navbar-brand"><i class="fa fa-camera-retro"></i>Photovote</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="#">Vote as you like!</a></li>
            <li><a href="#">新規投稿</a></li>
              <li class="dropdown">
                <a href="#">投稿一覧
                </a>
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
                        <p class="text-left"><strong>nick_name</strong></p>
                        <p class="text-left small">email</p>
                        <p class="text-left">
                          <a href="#" class="btn btn-primary btn-block btn-sm">マイプロフィール</a>
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
                          <a href="#" class="btn btn-danger btn-block">ログイン</a>
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


      <!---========== resistration form ==========--->

        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
              <div class="panel-body">
                <div class="row">
                  <div class="col-lg-12">
                    <form id="register-form" action="" method="post" role="form" style="display: block;">
                      <h2>SIGN UP</h2>
                      <p class="message">
                        Photovoteであなたのアカウントを作成しましょう。<br>
                        まず以下の項目に必要事項を入力してください。</p>
                      <!---========== status bar ==========--->
                      <!-- <section>
                        <div class="wizard">
                          <div class="wizard-inner">
                            <div class="connecting-line">
                            </div>
                              <ul class="nav nav-tabs" role="tablist">

                                <li role="presentation" class="active">
                                  <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                                    <span class="round-tab">
                                      <i class="fa fa-pencil"></i>
                                    </span>
                                  </a>
                                </li>

                                <li role="presentation" class="disabled">
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
                      </section> -->
                      <!-- status bar end -->

                      <div class="form-group">
                        <?php if(!empty($_POST['nick_name'])): ?>
                            <input type="text" name="nick_name" id="username" tabindex="1" class="form-control" placeholder="Nickname" value="<?php echo htmlspecialchars($_POST['nick_name'], ENT_QUOTES, 'UTF-8');?>">
                        <?php else: ?>
                            <input type="text" name="nick_name" id="username" tabindex="1" class="form-control" placeholder="Nickname" value="">
                        <?php endif; ?>
                        <!-- error -->
                        <?php if(!empty($error['nick_name'])): ?>
                            <?php if($error['nick_name']=='blank'): ?>
                              <p><i class="fa fa-exclamation-circle"></i>ニックネームを入力してください</p>
                            <?php endif; ?>
                        <?php endif; ?>
                      </div>

                      <div class="form-group">
                        <?php if(!empty($_POST['email'])): ?>
                            <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="<?php echo htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');?>">
                        <?php else: ?>
                            <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
                        <?php endif; ?>
                        <!-- error -->
                        <?php if(!empty($error['email'])): ?>
                            <?php if($error['email']=='blank'): ?>
                              <p><i class="fa fa-exclamation-circle"></i>メールアドレスを入力してください</p>
                            <?php endif; ?>
                        <?php endif; ?>
                      </div>

                      <div class="form-group">
                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                        <!-- error -->
                        <?php if(!empty($error['password'])): ?>
                            <?php if($error['password']=='blank'): ?>
                              <p><i class="fa fa-exclamation-circle"></i>パスワードを入力してください</p>
                            <?php endif; ?>
                            <!-- 4文字以下あるいは16文字以上の場合のエラー -->
                            <?php if($error['password']=='length'): ?>
                              <p><i class="fa fa-exclamation-circle"></i>パスワードは4文字以上16文字以下で入力してください</p>
                            <?php endif; ?>
                        <?php endif; ?>
                      </div>

                      <div class="form-group">
                        <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                        <!-- error -->
                        <?php if(!empty($error['confirm-password'])): ?>
                            <?php if($error['confirm-password']=='blank'): ?>
                              <p><i class="fa fa-exclamation-circle"></i>確認用のパスワードを入力してください</p>
                            <?php endif; ?>
                            <!-- 4文字以下あるいは16文字以上の場合のエラー -->
                            <?php if($error['confirm-password']=='incorrect'): ?>
                              <p><i class="fa fa-exclamation-circle"></i>パスワードが一致しません</p>
                            <?php endif; ?>
                        <?php endif; ?>
                      </div>

                      <div class="form-group">
                          <p class="upimg">Upload your image</p>
                          <input type="file" name="image" size="35">
                          <!-- error -->
                          <?php if(!empty($error['image'])): ?>
                              <?php if($error['image']=='type'): ?>
                                <p><i class="fa fa-exclamation-circle"></i>ファイルは.jpg、.jpegまたは.pngで登録してください</p>
                              <?php endif; ?>
                          <?php endif; ?>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-6 col-sm-offset-3">
                            <input type="submit" tabindex="4" class="form-control btn btn-register" value="入力内容を確認する">
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
        <!-- Do you have an account? -->
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
              <div class="panel-body">
                <div class="row">
                  <div class="col-lg-12">
                   <div class="transfer">
                      <p>アカウントをお持ちですか？</p>
                      <a href="signin.html">Sign in</a>
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
