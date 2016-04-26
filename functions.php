<?php
	// 全体で頻繁に使用する関数

	// htmlspecialcharsのショートカット
	function h($val){
		return htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
	}

	// mysqli_real_escape_stringのショートカット
	function m($db, $val){
		return mysqli_real_escape_string($db, $val);
	}

  // ログイン処理のショートカット
	function isSignin(){
		session_start();
		require('dbconnect.php');
		if($_SESSION['time'] + 3600 > time()){
			if(!empty($_SESSION)){
				//ログインしている場合
				//「現在日時」を取得
				$_SESSION['time'] = time();
				//自分のデータ取得
				$sql = sprintf('SELECT * FROM members WHERE id=%d',
								m($db, $_SESSION['id'])
							);
				$record = mysqli_query($db, $sql) or die(mysqli_error($db));
				$member = mysqli_fetch_assoc($record);
			}
		}else{
			// ログインしていない場合：signinへ強制遷移
			header('Location: signin.php');
			exit();
		}
	}

?>
