<?php

session_start();
include_once( 'config.php' );
include_once( 'weibooauth.php' );



$o = new WeiboOAuth( WB_AKEY , WB_SKEY , $_SESSION['keys']['oauth_token'] , $_SESSION['keys']['oauth_token_secret']  );
echo "callback-bp-1<br>";
$last_key = $o->getAccessToken(  $_REQUEST['oauth_verifier'] ) ;
echo "callback-bp-2<br>";
$_SESSION['last_key'] = $last_key;


?>
授权完成,<a href="weibolist.php">进入你的微博列表页面</a>
