
<?php

session_start();
include_once( 'config.php' );
include_once( 'saet.ex.class.php' );
header('Content-Type:text/html; charset=utf-8');

$c = new SaeTClient( WB_AKEY , WB_SKEY , $_SESSION['last_key']['oauth_token'] , $_SESSION['last_key']['oauth_token_secret']  );
$ms = $c->public_timeline(50);
$allid=array();
$i=0;


?>

<?php if( is_array( $ms ) ): ?>
<?php foreach( $ms as $item ): ?>
<div style="padding:10px;margin:5px;border:1px solid #ccc">
<?php //print_r($item); ?>
<?=$item['id']?><br>
<?php 
$allid[$i]=$item['id']; 
$i=$i+1;
?>

<?=$item['user']['name']?>:
<?=$item['text']?><br>
<?=$item['created_at']?>
(<a href="show.php?sid=<?=$item['id']?>" target="_blank">查看转发</a>)评论数：

<?php
$mr = $c->get_comments_by_sid($item['id'],1,200);
if ( is_array( $mr))
{echo sizeof($mr);
}
?><br>

</div>
<?php endforeach; ?>
<?php endif; ?>

<?php
$colon_separated = implode(":", $allid);
?>

<form action="comment2.php">
<input type="text" name="comment" style="width:300px" />
<input type="hidden" name="sid" value="<?=$colon_separated?>" /> 
&nbsp;<input type="submit" value="回复所有" />
</form>




