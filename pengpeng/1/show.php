<?php
   session_start();
   include_once( 'config.php' );
   include_once( 'saet.ex.class.php' );
   header('Content-Type:text/html; charset=utf-8');

   $c = new SaeTClient( WB_AKEY , WB_SKEY , $_SESSION['last_key']['oauth_token'] , $_SESSION['last_key']['oauth_token_secret'] );
   

   if( $items = $c->oauth->get('http://api.t.sina.com.cn/statuses/repost_timeline.json' , array('id'=>$_REQUEST['sid'])) ):?>
<div style="border:1px solid red;padding:5px;margin:5px">原始微博 - 
  <?=$items[0]['retweeted_status']['user']['name']?>: <?=$items[0]['retweeted_status']['text']?></div>
   <?foreach( $items as $item ):?>
     <div style="border:1px solid #eee;padding:5px;margin:5px"><?=$item['user']['name']?>: <?=$item['text']?></div>
   <?endforeach;?>
<?php endif; ?>
