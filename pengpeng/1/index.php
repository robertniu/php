<?php
session_start();
include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );
$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新浪萝卜 - Powered by Sina App Engine</title>

<style type="text/css">
<!--
#Layer0 {
 position:absolute;
 background-color:#bee1f5;
 margin-left: auto;
 margin-right: auto;

 z-index:1;
}
#Layer1 {
 position:absolute;
 background-color:#bee1f5;
 left:400px;
 top:26px;
 width:452px;
 height:580px;
 z-index:2;
}
#Layer2 {
 position:absolute;
 background-color:#bee1f5;
 top:250px;
 left:520px;
 width:239px;
 height:48px;
 z-index:3;
 
}
-->
</style>
</head>

<body bgcolor="#bee1f5">
	
	


	<div >
		<div id="Layer1">
	
		</div>
		<div id="Layer2">
					<!-- 授权按钮 -->
					<p><a href="<?=$code_url?>"><img src="http://www.sinaimg.cn/blog/developer/wiki/48.png" title="点击进入授权页面" alt="点击进入授权页面" border="0" /></a></p>
		</div>
		</div>
</body>
</html>
