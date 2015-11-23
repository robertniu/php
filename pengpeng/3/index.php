<?php

session_start();
//if( isset($_SESSION['last_key']) ) header("Location: weibolist.php");
include_once( 'config.php' );
include_once( 'weibooauth.php' );



$o = new WeiboOAuth( WB_AKEY , WB_SKEY  );
echo "index-bp-1<br>";
$keys = $o->getRequestToken();
echo "index-bp-2<br>";

$aurl = $o->getAuthorizeURL( $keys['oauth_token'] ,false , 'http://pengpeng.sinaapp.com/callback.php');

echo "index-bp-3<br>";
echo "<a href=".$aurl.">Use Oauth to login</a><br>";
$_SESSION['keys'] = $keys;

?>

<!--
<a href="<?=$aurl?>">Use Oauth to login</a>
-->