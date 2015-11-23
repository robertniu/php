<?php
session_start();
include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );


/*
$mysql = new SaeMysql();
$sql = "SELECT * FROM `users` LIMIT 10";

$data = $mysql->getData( $sql );
if( $mysql->errno() != 0 )
{
    die( "Error:" . $mysql->errmsg() );
}
foreach ($data as $v1) {
    echo '<p/>';
    echo 'pynames: ' . $v1['pynames'] . '<br/>';
   
  }
$mysql->closeDb();
*/

//$targetid = 1400796250;
$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
//$ms  = $c->home_timeline(); // done
$uid_get = $c->get_uid();
$uid = $uid_get['uid'];
$user_message = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息
DBinsert($user_message['id'],$user_message['screen_name']);
//$f_byname = $c->friends_by_name($user_message['screen_name']);
//$f_byid = $c->friends_by_id($uid);
//$gc_bysid = $c->get_comments_by_sid(3507572843537041); //根据微博ID返回某条微博的评论列表
$countsex=0;
$arrid = array();
$arrname=array();
$arrimg=array();
$arrdes=array();
$arrloc=array();

$totalbill=$user_message['bi_followers_count'];
if($user_message['gender']=="m")
{$idgender="f";
$idgenderimg="<em class=\"W_ico12 female\" title=\"女\"></em>";
}
if($user_message['gender']=="f")
{$idgender="m";
$idgenderimg="<em class=\"W_ico12 male\" title=\"男\"></em>";
}
if($totalbill<200){$page_a=1;}
if($totalbill%200){$page_a=(int)($totalbill/200)+1;}
else{$page_a=$totalbill/200;}
for($page_b=1;$page_b<=$page_a;$page_b++)
{
$f_byid = $c->bilateral($uid,$page_b,200); //根据ID获取用户的互粉列表

if( is_array( $f_byid['users'] ) )
{
   foreach( $f_byid['users'] as $item_u )   //读取关注列表
   {      
     if($item_u['gender']==$idgender){
	 $arrid[$countsex]=$item_u['id'];
	 $arrname[$countsex]=$item_u['screen_name'];
	 $arrimg[$countsex]=$item_u['profile_image_url'];
	 $arrdes[$countsex]=$item_u['description'];
	 $arrloc[$countsex]=$item_u['location'];
	 $countsex++;
     }
    }
 }
}

function SelectTag($tag)
{
foreach ($tag as $v5) 
{
echo 'SelectTag='.$v5.'<br/>';
$user_message_sel = $c->show_user_by_id($v5);
echo 'SelectTagName='.$user_message_sel['screen_name'].'<br/>';
}
}


function DBinsert($userid,$username)
{
$mysql = new SaeMysql();
$sql_1 = "SELECT * FROM `users` WHERE `weiboid` =".$userid;
//$sql_1 = "SELECT * FROM `users` LIMIT 10";
$data = $mysql->getData( $sql_1 );
if( $mysql->errno() != 0 )
{
    die( "Error_1:" . $mysql->errmsg() );
}
if ( count($data)==0)
{
$sql_2 = "INSERT  INTO `users` ( `weiboid` , `weiboname` ) VALUES ('" .$userid ."','" .$username ."') ";
$mysql->runSql( $sql_2 );

}
else
{
foreach ($data as $v1) 
  {
    echo '<p/>';
    echo 'weiboname: ' . $v1['weiboname'] . '<br/>';
   
  }
}

$sql_3 = "SELECT `pynames` FROM `users` WHERE `weiboid` =".$userid;
$data = $mysql->getData( $sql_3 );
if( $mysql->errno() != 0 )
{
   die( "Error_3:" . $mysql->errmsg() );
  
}
if ( checkArray($data))
{
echo 'pyname is null <br/>';
}



else
{
//echo "length of data=".count($data).'<br/>';
foreach ($data as $v1) 
  {
    //echo '<p/>';
    //echo 'pynames: ' . $v1['pynames'] . '<br/>';
	$ps = explode(",", $v1['pynames']);
	//echo "length of ps=".count($ps).'<br/>';
	foreach ($ps as $v2) 
	{
	//echo '<p/>';
    //echo 'pynames: ' . $v2 . '<br/>';
	$sql_4 = "SELECT `pynames` FROM `users` WHERE `weiboid` =".$v2;
    $data_4 = $mysql->getData( $sql_4 );
	if( $mysql->errno() != 0 ){    die( "Error_4:" . $mysql->errmsg() );}
    if ( count($data_4)==0)
	{
	echo '<p/>';
    echo 'pynames: ' . $v2 . ' 还没有使用本服务<br/>';
	}
	else{
	echo 'pynames: ' . $v2 . ' 选中的有：';
	foreach ($data_4 as $v3) 
	{
	//echo '<p/>';
    echo $v3['pynames'] .'<br/>' ;
    if(strpos($v3['pynames'], (string)$userid ,0)===false)
	{
        //echo '没有找到';
    }else{
        echo '用户'.$v2.'也选择了您！';
    }
	
	}
	}
	
	}
	//SelectTag($ps); 
   
  }
 
}
$mysql->closeDb();
}


function checkArray($array){
foreach ($array as $value){
if(is_array($value)){
if(count($value)){
if(!checkArray($value)){
return false;
}
}
}else{
$value=trim($value);
if(!empty($value)){
return false;
}
}
$i++;
}
return true;
}
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" charset="utf-8" async="" src="http://js.t.sinajs.cn/t5/home/js/common/extra/exposure.js?version=559f4bc1f6266504"></script>
<script type="text/javascript" charset="utf-8" async="" src="http://js.t.sinajs.cn/t4/apps/publicity/static/wbad.js?version=559f4bc1f6266504"></script>
<script type="text/javascript" charset="utf-8" async="" src="http://js.t.sinajs.cn/open/analytics/js/suda.js?version=559f4bc1f6266504"></script>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"></meta><script type="text/javascript"></script>
<script type="text/javascript"></script>
<link charset="utf-8" rel="stylesheet" type="text/css" href="http://img.t.sinajs.cn/t5/style/css/module/base/frame.css?version=a22d7953fe291b0a"></link>
<link charset="utf-8" rel="stylesheet" type="text/css" href="http://img.t.sinajs.cn/t5/style/css/module/list/activities_list.css?version=a22d7953fe291b0a"></link>
<link charset="utf-8" rel="stylesheet" type="text/css" href="http://img.t.sinajs.cn/t5/style/css/module/tab/group_read.css?version=a22d7953fe291b0a"></link>
<link charset="utf-8" rel="stylesheet" type="text/css" href="http://img.t.sinajs.cn/t5/style/css/module/list/myfollow_list.css?version=a22d7953fe291b0a"></link>
<link charset="utf-8" rel="stylesheet" type="text/css" href="http://img1.t.sinajs.cn/t5/style/css/module/list/connect_userlist.css?version=a22d7953fe291b0a"></link>
<link charset="utf-8" rel="stylesheet" type="text/css" href="http://img1.t.sinajs.cn/t5/style/css/patch/connect/connect.css?version=a22d7953fe291b0a"></link>
<link charset="utf-8" rel="stylesheet" type="text/css" href="http://img.t.sinajs.cn/t5/skin/default/skin.css?version=a22d7953fe291b0a"></link>
<script type="text/javascript"></script><link id="FM_link_FM_13685202334418" rel="Stylesheet" type="text/css" charset="utf-8" href="http://img.t.sinajs.cn/t5//style/css/module/layer/fixed_bar.css?version=a22d7953fe291b0a"></link>
<div style="position: absolute; top: -9999px; left: -9999px;"></div><link rel="Stylesheet" type="text/css" charset="utf-8" href="http://img.t.sinajs.cn/t4/appstyle/V5_webim/css/pages/wbim.css?version=a8cb81abd955877f"></link>
<script language="javascript"> 
 var maxnum=3;
 var currentnum=0;
 function inputcheck(ids)
{
var mark=document.getElementById(ids);
if(mark.checked=='')
{
  if(currentnum>=maxnum)
   {
   alert("您最多可以选择5位深入交往对象!");
   return false;
   }
mark.checked='checked';
currentnum++;
}
else
{
mark.checked='';
currentnum--;
}
}

 </script>

<title>新浪萝卜 - Powered by Sina App Engine</title>

</head>
<body class="B_myfollow L-zh-cn" style="">
<form name="pyl" action = "result.php" method = "post">	
<div class="W_miniblog">
<div class="W_main">
	<div class="W_main_bg clearfix">
		<div id="plc_main" class="W_main_a">
			<div class="W_follow_bg S_bg4">
                 <div id="pl_relation_myfollow" ucardconf="type=0">




<div class="group_read">
<div class="title" node-type="title_name"><?=$user_message['screen_name'] ?>,您好！    
<span class="num" node-type="title_count">您有互粉好友( <?=$user_message['bi_followers_count'] ?> 个) 其中异性（ <?=$countsex?>个）  ，您可以选择其中5位作为深入交往对象</span>    
<div class="W_tips empty clearfix">       <!-- 全部关注 -->                
<p class="icon"><span class="icon_warnS"></span></p>       
 <p class="txt S_txt2" node-type="title_notice"></p>
               
</div></div></div>
<div class="tab_normal clearfix">    
<div class="S_txt2" node-type="title_describe"><!-- 分组页 -->    </div> </div> 
<div class="myfollow_even clearfix"  node-type="list_container">
<div class="tab_normal clearfix"> <!-- 全部关注页/分组页/密友页 -->           
<div class="fixed_bar page_fixed_bar S_bg2">
<div class="fixed_bar S_bg2 page_fixed_bar" node-type="controlBar" style="">
<div class="inner clearfix">

<div class="bar_left">                                    
<a class="W_btn_c btn_arrow" action-type="set_scope" href="/3096914235/myfollow?ftype">
<span>全部关注<em class="W_arrow"><em class="down" node-type="arrow">◆</em></em></span></a>                                        
<a  class="W_btn_c btn_arrow" action-type="set_order" action-data="by=time" href="/3096914235/myfollow?t=1">
<span>按关注时间排序<em class="W_arrow"><em class="down" node-type="arrow">◆</em></em></span></a>                                                        
<a class="W_btn_c_disable btn_arrow"  action-type="add_to_other_group" node-type="add_to_other_group" href="javascript:void(0);" diss-data="refer_sort=relationManage&location=myfollow&refer_flag=add_all">
<span>添加到<em class="W_arrow"><em class="down" node-type="arrow">◆</em></em></span></a>                                                                        
<a class="W_btn_c_disable"  diss-data="refer_sort=relationManage&location=myfollow&refer_flag=unfollow_all" node-type="cancel_follow" action-type="cancel_follow" href="javascript:void(0);">
<span>取消关注</span></a>
<span style="display:none;" class="chosen"  node-type="selectText">已经选择<span class="S_spetxt" node-type="selectCount">0</span>人</span>
<a style="display:none;" class="normal_link"  href="javascript:void(0);" node-type="cancel_select" action-type="cancel_select">取消选择</a>
</div>

<div class="bar_right" node-type="search">      
<div class="input_search">                    
<div class="inner">                      
<div class="btns">                      <a node-type="search_submit" href="/3096914235/myfollow" class="btn_search W_ico20 iconsearch"></a>                     
</div>                     
<input node-type="search_input" class="noborder" value="输入昵称或备注" />                    
</div>      </div>   </div>

</div></div></div></div><!-- 分组成员列表区 -->

<div class="mylistBox clearfix">   




<?php 

if( is_array( $arrid ) )
{


   for($i=0;$i<$countsex;$i++)
   {      
    

    echo '<div class="myfollow_list S_line2 SW_fun " onclick="inputcheck('.$arrid[$i].')"  action-type="user_item"><div class="selected"></div> ';       
	echo '<div class="face" action-type="ignore_list"><a target="_blank" href="http://weibo.com/'.$arrid[$i].'"> ';
	echo '<img src="'.$arrimg[$i].'" usercard="id='.$arrid[$i].'" alt="'.$arrname[$i].'" /></a></div> ';
	echo '<ul class="info"><li><a target="_blank" action-type="ignore_list" node-type="screen_name" class="S_func1" href="http://weibo.com/'.$arrid[$i].'" title="'.$arrname[$i].'" usercard="id='.$arrid[$i].'">'.$arrname[$i].'</a> </li><li> ';                
	echo '<span class="connlink"><em class="W_ico12 icon_addtwo"></em> '.$idgenderimg.'<span class="W_vline S_line1_c">|</span>'.$arrloc[$i].'&nbsp &nbsp <span class="W_vline S_line1_c">|</span> &nbsp &nbsp<input type="checkbox" name="pyn[]" value = '.$arrid[$i] .' id='.$arrid[$i].'></span></li> '; 
	echo '<li><a class="S_link2" action-data="gid=3510735395564762&nick=萝卜特二&uid=1056211151&sex=m"  diss-data="refer_sort=relationManage&location=myfollow&refer_flag=add" action-type="set_group" node-type="set_group" href="javascript:;" title="未分组">        未分组 ';       
	echo '<span class="W_arrow"><em class="down">◆</em></span></a></li></ul><div class="intro S_txt2">    简介：'.$arrdes[$i].'        </div>   '; 
	echo '<div class="introHover"><a href="javascript:;" action-type="webim.conversation" action-data="uid=1056211151&nick=萝卜特二"> ';
	echo '<i class="W_chat_stat W_chat_stat_offline"></i>私信</a><span class="W_vline S_line1_c">|</span> ';
	echo '<a href="javascript:void(0);" action-type="set_remark">设置备注</a><span class="W_vline S_line1_c">|</span> ';
	echo '<a href="javascript:void(0);" action-type="cancel_follow_single">取消关注</a></div></div>';

     
     
    }
 }

?>



 
</div>      


 
<div class="tab_normal_opp S_line2 clearfix">   <!-- 分页 -->              
<div class="tab_normal_r">    
<input type="submit" value="选择完毕，确定提交">       
      </div>                  </div> </div>

<div node-type="list_container" class="myfollow_even clearfix">	   		
   <div class="tab_normal_opp S_line2 clearfix">
   		<!-- 分页 -->
              <div class="tab_normal_r">
     
			</div>
              
    </div>
</div>

<input type="hidden" node-type="hidden" value="gid=allFollow">
</div>
</div>
</div>
</div>
</div>
</div>
</form></body></html>


       			

				





