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
                    <form id="register-form" method="" role="form" style="display: block;">
                      <div class="thanks-title">
                        <h2>Photovoteへようこそ！</h2>
                      </div>

                      <!---========== status bar ==========--->
                      <section>
                        <div class="wizard">
                          <div class="wizard-inner">
                            <div class="connecting-line">
                            </div>
                              <ul class="nav nav-tabs" role="tablist">

                                <li role="presentation" class="disabled">
                                  <a href="" data-toggle="tab" aria-controls="step1" role="tab">
                                    <span class="round-tab">
                                      <i class="fa fa-pencil"></i>
                                    </span>
                                  </a>
                                </li>

                                <li role="presentation" class="disabled">
                                  <a href="" data-toggle="tab" aria-controls="step2" role="tab">
                                    <span class="round-tab">
                                      <i class="fa fa-check"></i>
                                    </span>
                                  </a>
                                </li>

                                <li role="presentation" class="active">
                                  <a href="" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
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

                      <div class="thanks-message">
                        <p>おめでとうございます！<br>ついにあなたのアカウントが作成されました！<br>あなたの「スキ！」をvoteして伝えましょう。<br>それでは、楽しいPhotovoteライフを！<p>
                      </div>
                      <!-- rewrite and submit button -->
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-6 col-sm-offset-3">
                            <a href="../signin.php" id="register-submit" tabindex="4" class="form-control btn btn-register">Topページへ</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- resister end -->
      </div>
    </div>
    <!-- content end -->

    <!---========== Footer ==========--->
    <footer>
      <div class="container">
        <div class="col-md-10 col-md-offset-1 text-center">
          <h6>Copyright© <a href="http://nexseed.net" target="_blank">Nexseed.inc</a> All rights reserved.</h6>
        </div>
      </div>
    </footer>

    <!-- JS -->
    <script type="text/javascript" src="../assets/js/jquery-1.12.3.min.js"></script>
  </body>
</html>
