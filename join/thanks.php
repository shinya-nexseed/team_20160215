<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Photo vote</title>
    <!-- <link rel="stylesheet" href="../assets/css/bootstrap.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="../assets/css/main01.css"> -->
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

        <!---========== resistration form ==========--->
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
              <div class="panel-body">
                <div class="row">
                  <div class="col-lg-12">
                    <form id="register-form" action="../signin.php" method="" role="form" style="display: block;">
                      <div class="thanks-title">
                        <h2>Photovoteへようこそ！</h2>
                      </div>
                      <!---========== status bar ==========--->
                      <!-- <section>
                        <div class="wizard">
                          <div class="wizard-inner">
                            <div class="connecting-line">
                            </div>
                              <ul class="nav nav-tabs" role="tablist">

                                <li role="presentation" class="disabled">
                                  <a href="signup.html" data-toggle="tab" aria-controls="step1" role="tab">
                                    <span class="round-tab">
                                      <i class="fa fa-pencil"></i>
                                    </span>
                                  </a>
                                </li>

                                <li role="presentation" class="disabled">
                                  <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab">
                                    <span class="round-tab">
                                      <i class="fa fa-check"></i>
                                    </span>
                                  </a>
                                </li>

                                <li role="presentation" class="active">
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

                      <div class="thanks-message">
                        <p>おめでとうございます！<br>ついにあなたのアカウントが作成されました！<br>あなたの「スキ！」をvoteして伝えましょう。<br>それでは、楽しいPhotovoteライフを！<p>
                      </div>
                      <!-- rewrite and submit button -->
                      <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                              <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Topページへ">
                            </div>
                        </div>

                          <!-- <div class="col-xs-6 form-group pull-left">
                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="書き直す">
                          </div>
                          <div class="col-xs-6 form-group pull-right">
                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="送信">
                          </div> -->
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Do you have an account? -->
        <!-- <div class="row">
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
        </div> -->
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
