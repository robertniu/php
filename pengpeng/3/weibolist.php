<?php

session_start();
include_once( 'config.php' );
include_once( 'weibooauth.php' );


$c = new WeiboClient( WB_AKEY , WB_SKEY , $_SESSION['last_key']['oauth_token'] , $_SESSION['last_key']['oauth_token_secret']  );
echo "weibolist-bp-1<br>";
$ms  = $c->public_timeline(5,0); // done
echo "weibolist-bp-2<br>";
$me = $c->verify_credentials();
echo "weibolist-bp-3<br>";

?>
<h2><?=$me['name']?> 你好~ 要换头像么?</h2>
<form action="weibolist.php" >
<input type="text" name="avatar" style="width:300px" value="头像url" />
&nbsp;<input type="submit" />
</form>
<h2>发送新微博</h2>
<form action="weibolist.php" >
<input type="text" name="text" style="width:300px" />
&nbsp;<input type="submit" />
</form>

<h2>发送图片微博</h2>
<form action="weibolist.php" >
<input type="text" name="text" style="width:300px" value="文字内容" />
<input type="text" name="pic" style="width:300px" value="图片url" />
&nbsp;<input type="submit" />
</form>
<?php

if( isset($_REQUEST['text']) || isset($_REQUEST['avatar']) )
{

if( isset($_REQUEST['pic']) )
	$rr = $c ->upload( $_REQUEST['text'] , $_REQUEST['pic'] );
elseif( isset($_REQUEST['avatar']  ) )
	$rr = $c->update_avatar( $_REQUEST['avatar'] );
else
	$rr = $c->update( $_REQUEST['text'] );	

	echo "<p>发送完成</p>" ; 

}

?>

<?php if( is_array( $ms ) ): ?>
<?php foreach( $ms as $item ): ?>
<div style="padding:10px;margin:5px;border:1px solid #ccc">
<?=$item['text'];?>
<?php if( isset($_REQUEST['text']) ): ?>
<?$c->repost($item['id'],$_REQUEST['text'],1 ) ?>
<?php endif; ?>


</div>
<?php endforeach; ?>
<?php endif; ?>

<form action="weibolist.php">
<input type="text" name="text" style="width:300px" />
<input type="submit" value="回复并转发" />
</form>



