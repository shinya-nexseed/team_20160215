<?php
require('../dbconnect.php');
require('../functions.php');
// 仮のログインユーザーデータ
session_start();
$_SESSION['id'] = 1;
$_SESSION['time'] = time();
// ログイン判定
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time() ) {
    $_SESSION['time'] = time();
    $sql = sprintf('SELECT * FROM members WHERE id=%d',
        mysqli_real_escape_string($db, $_SESSION['id'])
    );
    $record = mysqli_query($db, $sql) or die(mysqli_error($db));
    // ログインしているのユーザーのデータ
    $member = mysqli_fetch_assoc($record);
} else {
    header('Location: signin.php');
    exit();
}

    $error = array();

        if (isset($_POST) && !empty($_POST)){

           if ($_POST['nick_name'] == '') {
            // もし$_POST内のnick_name部分が空だったら処理
            $error['nick_name'] = 'blank';
            // $error配列のnick_nameキーにblankという値を代入
        }

         if ($_POST['introduction'] == '') {
            // もし$_POST内のnick_name部分が空だったら処理
            $error['introduction'] = 'blank';
            // $error配列のnick_nameキーにblankという値を代入
        }
      


          if(isset($_FILES)){

                  $fileName = $_FILES['image']['name'];
                  // $_FILESはinputタグのtypeがfileの時に生成される
                  // スーパーグローバル変数です
                  // echo $fileName;
                  if (!empty($fileName)) {
                      $ext = substr($fileName, -3);
                      // substr()関数は指定した文字列から指定した数分だけ文字を
                      // 取得する
                      // 今回は-3と指定することで文字列の最後から3つ分取得
                      // echo $ext;

                      // 画像ファイルの拡張子がjpgもしくはpngでなければ
                      // typeというエラーを出す
                      if ($ext != 'jpg' && $ext != 'png') {
                          $error['image'] = 'type';
                      }
                  }
                }

                  if (empty($error)) {
                  // 画像をサーバーへアップロードする処理
                  // 単に登録する画像の名前の文字列を他と絶対にかぶらない形で
                  // 変数に代入する
                  $image = date('YmdHis') . $_FILES['image']['name'];
                  // date()関数とは、指定したフォーマットで現在の日時を返す
                  // echo $image;

                  move_uploaded_file($_FILES['image']['tmp_name'],
                                     'member_picture/' . $image
                                    );
              
                  $sql = sprintf('UPDATE `members` SET `nick_name`="%s", `introduction`="%s", `picture_path`="%s" WHERE `id`=%d',
                              $_POST['nick_name'],
                              $_POST['introduction'],
                              $image,
                              $_SESSION['id']
                          );

                  mysqli_query($db,$sql) or die(mysqli_error($db));

                  // check.phpに遷移して処理を終了する
                   //header('Location: index.php');
                   //exit();
                 }
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
  <link rel="stylesheet" href="../assets/css/common.css">

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

<form action="" method="post" enctype="multipart/form-data">
<div id="container">
  <div class="imgInput">
      <img src="member_picture/<?php echo $member['picture_path']; ?>" alt="" class="imgView" width="100px" height="100px"><br>
          <input type="file" name="image"><br>
          <?php if(!empty($error['image'])): ?>
        <?php if($error['image'] = 'type'): ?>
            <p class="error">拡張子が違います。</p>
        <?php endif; ?>
    <?php endif; ?>

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
      <div class="form-group">
      <label class="col-md-4 control-label" for="textinput">Name</label>  
      <div class="col-md-4">
      <input id="textinput" name="nick_name" type="text" placeholder="your new name " class="form-control input-md" value="<?php echo $member['nick_name']; ?>">
      <?php if(!empty($error['nick_name'])): ?>
          <?php if($error['nick_name'] == 'blank'): ?>
              <p class="error">ニックネームを入力してください</p>
          <?php endif; ?>
      <?php endif; ?>

      </div>
    </div>
    <br>
    <br>
   

    <!-- Select Multiple -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectmultiple">About Me</label>
  <div class="col-md-4">
    <textarea name="introduction" class="form-control" multiple="multiple" placeholder="About me"><?php echo $member['introduction']; ?>
    </textarea>
    <?php if(!empty($error['introduction'])): ?>
        <?php if($error['introduction'] == 'blank'): ?>
            <p class="error">自己紹介を入力してください。</p>
        <?php endif; ?>
    <?php endif; ?>
  </div>
</div>

 <!-- Button -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="singlebutton"></label>
      <div class="col-md-4">
        <input type="submit" value="Save" name="singlebutton" class="btn btn-info pull-right" >
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