<?php
    session_start();

    // 外部ファイルの読み込み
    require('../dbconnect.php');
    require('../functions.php');

    // 仮のログインユーザーデータ
    $_SESSION['id'] = 1;
    $_SESSION['time'] = time();

    // ログイン判定
    if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time() ) {
        $_SESSION['time'] = time();

        $sql = sprintf('SELECT * FROM members WHERE id=%d',
            m($db, $_SESSION['id'])
        );
        $record = mysqli_query($db, $sql) or die(mysqli_error($db));

        // ログインしているのユーザーのデータ
        $member = mysqli_fetch_assoc($record);
    } else {
        header('Location: signin.php');
        exit();
    }

?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Photovote</title>
  <!-- bootstrapの方が先 -->
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css"> 
  <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/sample.css">
  <link rel="stylesheet" href="http://black-flag.net/data/css/reset.css">
  <link rel="stylesheet" href="css/common.css">

</head>
<body>
    <!-- 
        =======================================================
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
        <a href="/" class="navbar-brand">Photovite</a>
      </div>
      <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="new.html">新規投稿</a></li>
            <li><a href="users/index.html">会員一覧</a></li>
             <!-- <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">DropDown
                <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Link 2</a></li>
                </ul>
             </li>   -->            
          </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-user"></span> 
                <strong>nick_name</strong>
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
                        <a href="#" class="btn btn-danger btn-block">ログアウト</a>
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
    </div>


<div id="container">
  <div class="imgInput">
      <img src="member_picture/<?php echo $member['picture_path']; ?>" alt="" class="imgView" width="100px" height="100px"><br>
  </div><!--/.imgInput-->
</div>



 <!-- /container -->

  

    <!-- 
        =======================================================
        コンテンツ
    -->
        <div class="container">
    <form class="form-horizontal">
    <fieldset>

    <!-- Form Name -->
    <legend>My Profile Setting</legend>
<form action="" method="post">
      <div class="form-group">
      <label class="col-md-4 control-label" for="textinput">email</label>  
      <div class="col-md-4">
      <input id="textinput" name="email" type="text" placeholder="your new email" class="form-control input-md" value="<?php echo $member['email']; ?>">  
      </div>
    </div>
   

    <!-- Select Multiple -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectmultiple">pass</label>
  <div class="col-md-4">
    <input id="textinput" name="password" type="password" placeholder="your new pass" class="form-control input-md" value="<?php echo $member['password']; ?>">
    </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="selectmultiple">again</label>
  <div class="col-md-4">
    <input id="textinput" name="password" type="password" placeholder="your new pass" class="form-control input-md" value="<?php echo $member['password']; ?>">
    </div>
</div>


 <!-- Button -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="singlebutton"></label>
      <div class="col-md-4">
        <a href="user_index.php" name="singlebutton" class="btn btn-info pull-right" >save</a>
      </div>
    </div>
</form>

    <!-- Button -->
   <!--  <div class="form-group">
      <label class="col-md-4 control-label" for="singlebutton">Remove my account</label>
      <div class="col-md-4">
        <button id="singlebutton" name="singlebutton" class="btn btn-danger">remove</button>
      </div>
    </div> -->
    <!-- 
        =======================================================
        フッター
    -->
    <div class="container">
      <div class="row">
      <hr>
        <div class="col-lg-12">
          <div class="col-md-8">
            <a href="#">Terms of Service</a> | <a href="#">Privacy</a>    
          </div>
          <div class="col-md-4">
            <p class="muted pull-right">© 2013 Company Name. All rights reserved</p>
          </div>
        </div>
      </div>
    </div>



<script type="text/javascript" src="../assets/js/jquery.js"></script>
<script type="text/javascript" src="../assets/js/jquery.upload_thumbs.js"></script>
<!-- JSファイルの読み込みはbodyの一番下がデファクトスタンダード -->
<script type="text/javascript" src="../assets/js/jquery-1.12.3.min.js"></script>
<!-- jQueryファイルが一番最初 -->
<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
<!-- jQueryファイルの次にbootstrapのJSファイル -->
<script type="text/javascript" src="../assets/js/main.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(function(){
    var setFileInput = $('.imgInput'),
    setFileImg = $('.imgView');

    setFileInput.each(function(){
        var selfFile = $(this),
        selfInput = $(this).find('input[type=file]'),
        prevElm = selfFile.find(setFileImg),
        orgPass = prevElm.attr('src');

        selfInput.change(function(){
            var file = $(this).prop('files')[0],
            fileRdr = new FileReader();

            if (!this.files.length){
                prevElm.attr('src', orgPass);
                return;
            } else {
                if (!file.type.match('image.*')){
                    prevElm.attr('src', orgPass);
                    return;
                } else {
                    fileRdr.onload = function() {
                        prevElm.attr('src', fileRdr.result);
                    }
                    fileRdr.readAsDataURL(file);
                }
            }
        });
    });
});
</script>
</body>
</html>