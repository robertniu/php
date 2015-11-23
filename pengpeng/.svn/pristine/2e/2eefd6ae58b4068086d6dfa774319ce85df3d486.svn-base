<?php
   session_start();
   include_once( 'config.php' );
   include_once( 'saet.ex.class.php' );
   header('Content-Type:text/html; charset=utf-8');

$c = new SaeTClient( WB_AKEY , WB_SKEY , $_SESSION['last_key']['oauth_token'] , $_SESSION['last_key']['oauth_token_secret'] );
if( isset($_REQUEST['repost']) )
{
$c->repost($_REQUEST['sid'],$_REQUEST['repost'],1 );

	echo "<p>转发回复完成</p>";

}

?>
<a href="http://pengpeng.sinaapp.com/weibolist.php" target="_blank">返回</a>
