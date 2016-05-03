
<?php
	session_start();
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
	// URLパラメータにid=数字の機銃つがなければ不正なアクセスとみなし
	// index.phpにリダイレクト（遷移）する
	// 例： 192.168.33.10/seed_sns_view.php?id=1
	// $_SESSIONに必要な値が入っていればログインしているので、
	// if文を処理
	// if (empty($_REQUEST['id']) ) {
	// 	//ログインしてない
	// 	header('Location: view.php');
	// 	exit();
	// }
	// $sql = 'SELECT nick_name, picture_path, introduction FROM members';
	
	// $photos = mysqli_query($db, $sql) or die(mysqli_error($db));
	// $members = mysqli_fetch_assoc($photos);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Photovoteです</title>
    <!-- bootstrapの方が先 -->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css"> 
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">

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

    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    	<div class="container">
      <div class="row">
    		<div class="fb-profile">
    			<img class="fb-image-profile thumbnail" src="member_picture/<?php echo ($member['picture_path']); ?>" alt="Profile image example" width="250px" height="200px" hspace="50px" vspace="50px"/>
    		<div class="fb-profile-text"> 
    			<h1><?php echo ($member['nick_name']); ?></h1>
    				<a href="edit.php" class="btn-sm btn-danger" style="float:right; margin-left:10px;">Edit</a>
    				<a href="index.php" class="btn-sm btn-warning" style="float:right;">Home</a>
    			<h4><?php echo ($member['introduction']); ?></h4> 
				</div>
        </div>
				</div>
			</div> <!-- /container -->

    <!-- 
        =======================================================
        コンテンツ
    -->

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


<!-- JSファイルの読み込みはbodyの一番下がデファクトスタンダード -->
<script type="text/javascript" src="../assets/js/jquery-1.12.3.min.js"></script>
<!-- jQueryファイルが一番最初 -->
<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
<!-- jQueryファイルの次にbootstrapのJSファイル -->
<script type="text/javascript" src="../assets/js/main.js"></script>
</body>
</html>