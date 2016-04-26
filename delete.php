<?php
  session_start();
  require('dbconnect.php');
  require('functions.php');

  $_SESSION['id'] = 1;
  $_SESSION['time'] = time();

      // ログイン判定
      if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time() ) {
          $_SESSION['time'] = time();

          $sql = sprintf('SELECT * FROM members WHERE id=%d',
              m($db, $_SESSION['id'])
          );

          $record = mysqli_query($db, $sql) or die(mysqli_error($db));

          // ログインしている時のユーザーのデータ
          $member = mysqli_fetch_assoc($record);


          $member = array('1' => 'hogehoge','2' => 'fugafu','3' => 'mogo');
          var_dump($member);

          // 投稿があるか確認
          $sql = sprintf('SELECT * FROM photos WHERE id=%d',
            m($db , $_SESSION['id'])
          );

          $record = mysqli_query($db, $sql) or die(mysqli_error($db)
          );

          // 削除したいphotosのデータ一件が格納
          $table = mysqli_fetch_assoc($record);

              // 削除したいphotosデータのmember_idと、ログインしているユーザーのidが一致していれば削除処理実行
              if ($table['member_id'] == $_SESSION['id']){
                  $sql = sprintf('DELETE FROM phptos WHERE id=%d', m($db, $id)
              );

                  mysqli_query($db, $sql) or die(mysqli_error($db));
              }

      } else {
          // ログインしていない
          header('Location: signin.php');
          exit();
        }


  // 削除完了後signin.phpへ遷移
  // header('Location: signin.php');
  // exit();

?>


