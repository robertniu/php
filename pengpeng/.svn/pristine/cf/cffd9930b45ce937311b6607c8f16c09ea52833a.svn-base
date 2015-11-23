<?php
   session_start();
   include_once( 'config.php' );
   include_once( 'saet.ex.class.php' );
   header('Content-Type:text/html; charset=utf-8');

$c = new SaeTClient( WB_AKEY , WB_SKEY , $_SESSION['last_key']['oauth_token'] , $_SESSION['last_key']['oauth_token_secret'] );
if( isset($_REQUEST['comment']) )
{
$pizza = $_REQUEST['sid'];
$pieces = explode(":", $pizza);
if ( is_array( $pieces))
{
for($i=0;$i<sizeof($pieces);$i++)
{
$c->send_comment($pieces[$i],$i.$_REQUEST['comment'],null );
}
}
	echo "<p>回复完成</p>";
}

?>
<a href="http://pengpeng.sinaapp.com/random.php" target="_blank">返回</a>
