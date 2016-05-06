<?php
    session_start();
    require('../dbconnect.php');
    require('../functions.php');

    $member = isSignin($db);

    $error = array();

    if(isset($_POST) && !empty($_POST)) {

        if ($_POST['nick_name'] == '') {
            $error['nick_name'] = 'blank';
        }

        if ($_POST['introduction'] == '') {
            $error['introduction'] = 'blank';
        }
            
        
        if(isset($_FILES['image'])) {

            if (!empty($_FILES['image']['name'])) {

                $fileName = $_FILES['image']['name'];
                   
                if (!empty($fileName)) {
                    $ext = substr($fileName, -3);
                    
                    if ($ext != 'jpg' && $ext != 'png') {
                        $error['image'] = 'type';
                    }
                }
            }              
        }

        if (empty($error)) {

            if (!empty($_FILES['image']['name'])) {
            
                $image = date('YmdHis') . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],'member_picture/' . $image);
                $sql = sprintf('UPDATE `members` SET `nick_name`="%s", `introduction`="%s", `picture_path`="%s" WHERE `id`=%d',
                            $_POST['nick_name'],
                            $_POST['introduction'],
                            $image,
                            $_SESSION['id']
                        );
            } else { 
                $sql = sprintf('UPDATE `members` SET `nick_name`="%s", `introduction`="%s" WHERE `id`=%d',
                            $_POST['nick_name'],
                            $_POST['introduction'],
                            $_SESSION['id']
                        );
            }
            mysqli_query($db, $sql) or die(mysqli_error($db)); 

            header('Location: view.php?id='.$member['id']);
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
  <link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.css">
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
      <legend>My Profile Setting</legend>
      <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="col-xs-4 col-xs-offset-2">
          <img src="member_picture/<?php echo $member['picture_path']; ?>" alt="" class="imgView" width="100px" height="100px"><br>
          <input type="file" name="image"><br>
          <?php if(!empty($error['image'])): ?>
            <?php if($error['image'] == 'type'): ?>
              <p class="error">* 写真は「jpg」または「png」形式で指定してください。</p>
            <?php endif; ?>
          <?php endif; ?> 
        </div>

        <div class="col-xs-4">
          <div class="form-group">
            <label class="control-label" for="textinput">Nickname</label>  
            <input id="textinput" name="nick_name" type="text" placeholder="New Nickname " class="form-control input-md" value="<?php echo $member['nick_name']; ?>">
            <?php if(!empty($error['nick_name'])): ?>
                <?php if($error['nick_name'] == 'blank'): ?>
                    <p class="error">ニックネームを入力してください。</p>
                <?php endif; ?>
            <?php endif; ?>  
          </div>
        

          <!-- Select Multiple -->
          <div class="form-group">
            <label class="control-label" for="selectmultiple">About Me</label>
            <textarea name="introduction" class="form-control" multiple="multiple" placeholder="About Me"><?php echo $member['introduction']; ?></textarea>
            <?php if(!empty($error['introduction'])): ?>
                <?php if($error['introduction'] == 'blank'): ?>
                    <p class="error">自己紹介を入力してください。</p>
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
          <p class="muted pull-right">© 2016 <a href="http://nexseed.net">Nexseed.inc</a> All rights reserved</p>
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
