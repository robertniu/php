<?php
session_start();

include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );

$targetid = 1852648573;
$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
$ms  = $c->home_timeline(); // done
$uid_get = $c->get_uid();
$uid = $uid_get['uid'];
$user_message = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息
//$f_byname = $c->friends_by_name($user_message['screen_name']);
//$f_byid = $c->friends_by_id($uid);
 

//$gc_bysid = $c->get_comments_by_sid(3507572843537041); //根据微博ID返回某条微博的评论列表

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新浪微博V2接口演示程序-Powered by Sina App Engine</title>
</head>

<body>
	<?=$user_message['screen_name']?>,您好！
	<h2 align="left">发送新微博</h2>
	<form action="" >
		<input type="text" name="text" style="width:300px" />
		<input type="submit" />
	</form>
<?php
if( isset($_REQUEST['text']) ) {
	$ret = $c->update( $_REQUEST['text'] );	//发送微博
	if ( isset($ret['error_code']) && $ret['error_code'] > 0 ) {
		echo "<p>发送失败，错误：{$ret['error_code']}:{$ret['error']}</p>";
	} else {
		echo "<p>发送成功</p>";
	}
}
?>




<?php 

/*
$f_byid = $c->friends_by_id($targetid,0,10); //根据ID获取用户的关注列表
if( is_array( $f_byid['users'] ) )
$s='';
{
    foreach( $f_byid['users'] as $item_u )   //读取关注列表
    {      
     $s .= $item_u['id'].',';
      
    }

$tlb_byid = $c->timeline_batch_by_id($s);//批量获取指定的一批用户的timeline，测试不成功：第三方应用访问api接口权限受限制 
	if( is_array( $tlb_byid['statuses'] ) )
	{
  		 foreach( $tlb_byid['statuses'] as $item_u )   
   		{      
    		 echo '<div style="padding:10px;margin:5px;border:1px solid #ccc">';
     		 echo '####################################<br>';
     		 echo  $item_u['text'].':<br>';  
                 echo  $item_u['created_at'].'<br>';
                 echo  '</div>';
                }
         }
} 
*/



$f_byid = $c->friends_by_id($targetid,0,20); //根据ID获取用户的关注列表
$sortsid=array();
$i=0;
if( is_array( $f_byid['users'] ) )
{
   foreach( $f_byid['users'] as $item_u )   //读取关注列表
   {      
     echo '<div style="padding:10px;margin:5px;border:1px solid #ccc">';
     echo '####################################<br>';
     echo  $item_u['id'].'<br>';
     echo  $item_u['screen_name'].':<br>';  

     $ut_byid = $c->user_timeline_by_id($item_u['id'],1,1);
     	if( is_array( $ut_byid['statuses'] ) )
	{

   		foreach( $ut_byid['statuses'] as $item_c )  //读取每个用户的微博
   		{      
                echo '############<br>';
               // echo 'i='.$i.'<br>';
                echo $item_c['text'].'<br>';
                echo $item_c['created_at'].'<br>';
                echo 'SID:'.$item_c['id'].'<br>';
                $sortsid[$i]=$item_c['id'];
               // echo $sortsid[$i];
                $i++;
                
                
                
                /*
                     $gc_bysid = $c->get_comments_by_sid($item_c['id']);
     			if( is_array( $gc_bysid['comments'] ) )
			{
   				foreach( $gc_bysid['comments'] as $item_a )  //读取每条微博的评论
   				{      
                		echo $item_a['user']['screen_name'].':';
     				echo $item_a['text'];
     				echo '<br>';
     
    				}
			} 
                 */
                 
     		
    		}

	}   
     //echo 'sizeof:'.sizeof($sortsid).'<br>';
     echo '</div>';
     
      
    }
} 
rsort($sortsid);

print_r($sortsid);

                     $gc_bysid = $c->get_comments_by_sid($sortsid[0]);
     			if( is_array( $gc_bysid['comments'] ) )
			{
   				foreach( $gc_bysid['comments'] as $item_a )  //读取每条微博的评论
   				{      
                		echo $item_a['user']['screen_name'].':';
     				echo $item_a['text'];
     				echo '<br>';
     
    				}
			} 




/* 获取用户的所有微博和评论
$ut_byid = $c->user_timeline_by_id($targetid,1,10); //返回用户发布的最近n条信息，读评论时发现只能取50条，时间间隔有限制应该
if( is_array( $ut_byid['statuses'] ) )
{
   foreach( $ut_byid['statuses'] as $item_u ) 
   {      
     echo '<div style="padding:10px;margin:5px;border:1px solid #ccc">';
     echo '############<br>';
     echo  $item_u['text'].'<br>';
     echo  $item_u['created_at'].'<br>';  
     
     $gc_bysid = $c->get_comments_by_sid($item_u['id']);
     	if( is_array( $gc_bysid['comments'] ) )
	{
   		foreach( $gc_bysid['comments'] as $item_c ) 
   		{      
                echo $item_c['user']['screen_name'].':';
     		echo $item_c['text'];
                
     		echo '<br>';
     
      
    		}
	}   
     echo '</div>';
      
    }
} 
*/

/*
$f_byid = $c->friends_by_id($targetid,0,200); //根据ID获取用户的关注列表
$sortsid=array();
$i=0;
if( is_array( $f_byid['users'] ) )
{
   foreach( $f_byid['users'] as $item_u )   //读取关注列表
   {      
     echo '<div style="padding:10px;margin:5px;border:1px solid #ccc">';
     echo '####################################<br>';
     echo  $item_u['id'].'<br>';
     echo  $item_u['screen_name'].':<br>';  
     echo '</div>';
    }
 }
*/


?>





</body>
</html>
