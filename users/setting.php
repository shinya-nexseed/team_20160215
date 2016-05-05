<?php
    // 外部ファイルの読み込み
    require('../dbconnect.php');
    require('../functions.php');
    
    $member = isSignin($db);

    $error = array();
    if (isset($_POST) && !empty($_POST)){
        if ($_POST['email'] == '') {
            $error['email'] = 'blank';
        }
        if (sha1($_POST['currentpass']) != $member['password']) {
            $error['currentpass'] = 'wrong';
        }
        if ($_POST['currentpass'] == '') {
            $error['currentpass'] = 'blank';
        }
        
        if (strlen($_POST['pass']) < 4) {
            $error['pass'] = 'length';
        }
        if ($_POST['pass'] == '') {
            $error['pass'] = 'blank';
        }
        if (strlen($_POST['password']) < 4) {
            $error['password'] = 'length';
        }
        if ($_POST['password'] == '') {
            $error['password'] = 'blank';
        }
        if ($_POST['pass'] !== $_POST['password']){
            $error['password'] = 'wrong';
        }

        $current_email = $member['email'];
        $new_email = $_POST['email'];

        if ($current_email != $new_email) {
          
            $sql = sprintf(
                'SELECT COUNT(*) AS cnt FROM members WHERE email="%s"',
                $_POST['email']
            );

            $record = mysqli_query($db,$sql) or die(mysqli_error($db));
            $table = mysqli_fetch_assoc($record);

            if ($table['cnt'] > 0) {
                $error['email'] = 'duplicate';
            }
        }
      
        if (!empty($_POST) && empty($error)) {
            $sql = sprintf('UPDATE `members` SET `email`="%s", `password`="%s" WHERE `id`=%d',
              $_POST['email'],
              sha1($_POST['password']),
              $_SESSION['id']
            );

            mysqli_query($db, $sql) or die(mysqli_error($db));
            header('Location:view.php');
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
  <link rel="stylesheet" href="css/common.css">

</head>
<body>
    <!-- 
        =======================================================
        ヘッダー
    -->
    <?php 
        require('../header.php');
     ?>
    <!-- 
        =======================================================
        コンテンツ
    -->
  <div class="container">
    <div class="row">
      <legend>Change Settings</legend>
              <div class="col-xs-4 col-xs-offset-2">
          <img src="member_picture/<?php echo $member['picture_path']; ?>" alt="" class="imgView" width="100px" height="100px"><br>
        </div>
      <form action="" method="post" class="form-horizontal">

        <div class="col-xs-4">
          <div class="form-group">
            <label class="control-label" for="textinput">Email</label>  
            <input id="textinput" name="email" type="email" placeholder="New Email" class="form-control input-md" value="<?php echo $member['email']; ?>">
            <?php if(!empty($error['email'])): ?>
                <?php if($error['email'] == 'blank'): ?>
                    <p class="error">メールアドレスを入力してください。</p>
                <?php endif; ?>
                <?php if($error['email'] == 'duplicate'): ?>
                    <p class="error">指定されたメールアドレスはすでに登録されています。</p>
                <?php endif; ?>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label class="control-label" for="selectmultiple">Current Password</label>  
            <input id="textinput" name="currentpass" type="password" placeholder="Current Password" class="form-control input-md" value="">
            <?php if(!empty($error['currentpass'])): ?>
                <?php if($error['currentpass'] == 'blank'): ?>
                    <p class="error">パスワードを入力してください。</p>
                <?php endif; ?>
                <?php if($error['currentpass'] == 'wrong'): ?>
                    <p class="error">パスワードが間違っています。</p>
                <?php endif; ?>
            <?php endif; ?>
          </div>       

          <!-- Select Multiple -->
          <div class="form-group">
            <label class="control-label" for="selectmultiple">New Password</label>
            <input id="textinput" name="pass" type="password" class="form-control" placeholder="New Password" value="">
            <?php if(!empty($error['pass'])): ?>
                <?php if($error['pass'] == 'blank'): ?>
                    <p class="error">パスワードを入力してください。</p>
                <?php endif; ?>

                <?php if($error['pass'] == 'length'): ?>
                    <p class="error">パスワードを4文字以上で入力してください。</p>
                <?php endif; ?>
            <?php endif; ?>
                  
          </div>
        <div class="form-group">
            <label class="control-label" for="selectmultiple">Confirm Password</label>  
            <input id="textinput" name="password" type="password" placeholder="Confirm Password" class="form-control input-md" value="">
            <?php if(!empty($error['password'])): ?>
        
                <?php if($error['password'] == 'blank'): ?>
                    <p class="error">パスワードを入力してください。</p>
                <?php endif; ?>

                <?php if($error['password'] == 'length'): ?>
                    <p class="error">パスワードを4文字以上で入力してください。</p>
                <?php endif; ?>

                <?php if($_POST['password'] != '' && $error['password'] = 'wrong'): ?>
                    <p class="error">パスワードが一致しません。</p>
                <?php endif; ?>
            <?php endif; ?>     
                  
          </div>
          <div class="form-group">
            <label class="control-label" for="singlebutton"></label>
            <input type="submit" value="Save" name="singlebutton" style="margin-left: 10px;" class="btn btn-info pull-right" >
            <a href="view.php" name="singlebutton" class="btn pull-right btn-warning" value="Back">Back</a>
          </div>
        </div>
      </form>
    </div>
  </div>
    <!-- 
        =======================================================
        フッター
    -->
    <div class="container">
      <div class="row">
      <hr>
        <div class="col-lg-12">
          <div class="col-md-6">
            <a href="#">Terms of Service</a> | <a href="#">Privacy</a>    
          </div>
          <div class="col-md-6">
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
