<?php
	function special_var_dump($val){
		echo'<pre>';
		var_dump($val);
		echo'</pre>';
	}

	function h($val){
		return htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
	}

	function m($db, $val){
		return mysqli_real_escape_string($db, $val);
	}

	function isSignin(){
		session_start();
		require('dbconnect.php');
		//ログイン後の経過時間確認
		if($_SESSION['time'] + 3600 > time()){
				if(!empty($_SESSION)){
						//ログインしている場合
						//「現在日時(=最後にアクティブだった日時)」を取得
						$_SESSION['time'] = time();
						//自分のデータ取得
						$sql = sprintf('SELECT * FROM members WHERE id=%d',
										m($db, $_SESSION['id'])
									);
						$record = mysqli_query($db, $sql) or die(mysqli_error($db));
						$member = mysqli_fetch_assoc($record);
				}
		}else{
				//セッションタイムアウトの場合
				//最終アクションが現時刻より3秒以上前だった場合
				//if文の条件分岐では同じ条件が上で明記されていないかをまず確かめる
				//if(isset($_SESSION['time']) && ($_SESSION['time'] + 3 <= time())){
					$_SESSION['timeout'] = 'timeout';
				// ログインしていない場合：signinへ強制遷移
				header('Location: signin.php');
				exit();
		}
	}

?>
