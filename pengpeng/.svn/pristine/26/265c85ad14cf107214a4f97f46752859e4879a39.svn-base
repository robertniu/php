<?php
   session_start();
   include_once( 'config.php' );
   include_once( 'saet.ex.class.php' );
   header('Content-Type:text/html; charset=utf-8');

$c = new SaeTClient( WB_AKEY , WB_SKEY , $_SESSION['last_key']['oauth_token'] , $_SESSION['last_key']['oauth_token_secret'] );
if( isset($_REQUEST['comment']) )
{
$c->send_comment($_REQUEST['sid'],$_REQUEST['comment'],null );


	echo "<p>回复完成</p>";

}

?>
<a href="http://pengpeng.sinaapp.com/random.php" target="_blank">返回</a>
