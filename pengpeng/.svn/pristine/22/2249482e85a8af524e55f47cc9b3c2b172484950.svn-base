<?php
session_start();
include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );
$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
$uid_get = $c->get_uid();
$uid = $uid_get['uid'];
//$user_message = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息
$mysql = new SaeMysql();
//$name = strip_tags( $_REQUEST['pyn'] );
//$name = strip_tags( $_POST['pyn'] );
$textall ="";
$name = $_REQUEST['pyn']; 

foreach ($name  as $k=>$v )
{
    if ($k==0) $textall.=$v;
    else $textall.=",".$v;  
}


echo "You have selected:=".$textall;
//$age = intval( $_REQUEST['age'] );
//$sql = "INSERT  INTO `users` ( `weiboid` , `weiboname`,`pynames` ) VALUES ( '','','"  . $mysql->escape( $textall ) . "'  ) ";
$sql="UPDATE `users` SET `pynames` = '".$mysql->escape( $textall )."' WHERE `users`.`weiboid` = '".$uid."' ";
$mysql->runSql( $sql );
if( $mysql->errno() != 0 )
{
    die( "Error:" . $mysql->errmsg() );
}
 
$mysql->closeDb();


$url = "css8.php";
echo "<script language='javascript' type='text/javascript'>";
echo "window.location.href='$url'";
echo "</script>";

?>
