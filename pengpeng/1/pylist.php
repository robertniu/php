<?php
session_start();

include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );



$mysql = new SaeMysql();
$sql = "SELECT * FROM `users` LIMIT 10";
$data = $mysql->getData( $sql );
if( $mysql->errno() != 0 )
{
    die( "Error:" . $mysql->errmsg() );
}
foreach ($data as $v1) {
    echo '<p/>';
    echo 'pynames: ' . $v1['pynames'] . '<br/>';
   
  }
$mysql->closeDb();


$targetid = 1400796250;
$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
$ms  = $c->home_timeline(); // done
$uid_get = $c->get_uid();
$uid = $uid_get['uid'];
$user_message = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息
//$f_byname = $c->friends_by_name($user_message['screen_name']);
//$f_byid = $c->friends_by_id($uid);
 

//$gc_bysid = $c->get_comments_by_sid(3507572843537041); //根据微博ID返回某条微博的评论列表

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新浪萝卜  -- Powered by Sina App Engine</title>
</head>

<body><?=$user_message['screen_name'] ?> ,您好！
<form name="pyl" action = "result.php" method = "post">	





<?php 
$f_byid = $c->bilateral($uid,0,200); //根据ID获取用户的互粉列表
$sortsid=array();
$i=0;
$countsex=0;
$countcity=0;
if( is_array( $f_byid['users'] ) )
{


   foreach( $f_byid['users'] as $item_u )   //读取关注列表
   {      
    
     
     if($item_u['gender']=="f"){
     echo '<div style="padding:10px;margin:5px;border:1px solid #ccc">';
       //echo '####################################<br>';
     $countsex++;
     echo  $item_u['id'].'<br>';
     echo  $item_u['screen_name'].':<br>';
     
     ?><img src= <?=$item_u['profile_image_url']?> >
     
     <input type="checkbox" name="pyn[]" value = <?=$item_u['id']?> ><br>
     <?php
     
       //echo  $item_u['gender'].':<br>';
     echo '</div>';
     }
     
     
    }
 }
?>




  <p>您有<?=sizeof($f_byid['users'])?>位互粉好友 </p>
  <p>其中异性<?=$countsex?> 位</p>
  <input type="submit" value="选择完毕，确定提交">
  







  </form>
</body>
</html>
