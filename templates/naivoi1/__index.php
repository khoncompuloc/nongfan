<?php defined( '_NAIVOI' ) or die( 'Restricted access index' );
// Get content of module first
ob_start();
$_SESSION['login_true']=$user_login;
$_SESSION['budget_year']=$dbarr_config['name'];
$_SESSION['fname']=$dbarr['fname'] ;
$_SESSION['lname']=$dbarr['lname'];
$_SESSION['member_pic']=$dbarr['member_pic'];
$_SESSION['naivoi']="voi";
setcookie("username_log",$user_login,time()+3600*24*356);
require_once ($MODPATHFILE);
$content = ob_get_contents();
ob_end_clean();
?>
<!DOCTYPE html>
<html>
<head>
<title><?=WEB_TITLE;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="templates/naivoi1/css/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="images/favicon.ico">
<script type="text/javascript" src="js/jquery1.3.2.js"></script>
<script type="text/javascript" src="js/interface.js"></script>
<script type="text/javascript" src="js/AC_OETags.js"></script>
<script type="text/javascript" src="js/pageear.js"></script>
<!--[if lt IE 7]>
 <style type="text/css">
 div, img { behavior: url(iepngfix.htc) }
 </style>
<![endif]-->
<script language="JavaScript" type="text/JavaScript">
// create a new Date object then get the current time
var start = new Date();
var startsec = start.getTime();

 // run a loop counting up to 250,000
 var num = 0;
 for( var i = 0; i < 250000; i++ )
 {
 num++;
 }
var stop  = new Date();
var stopsec = stop.getTime();
var loadtime = ( stopsec - startsec ) / 1000;
</script>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?
require_once("mainfile.php");
$_SERVER['PHP_SELF'] = "index.php";
if(isset($_COOKIE["username_log"])){
   if(empty($_SESSION['naivoi'])){
$user_login = $_COOKIE["username_log"] ;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$result_config = mysql_query("select name from ".TB_CONFIG." where posit='budget'") ;
$dbarr_config = mysql_fetch_array($result_config) ;
$result = mysql_query("select member_id, fname, lname, user, member_pic from ".TB_MEMBER." where user='".$user_login."'") ; // and password='$pwd_login'") ;
$num = mysql_num_rows($result) ;
if($num<=0) {
	$showmsg="โปรดตรวจสอบ user=".$user_login." อีกครั้ง <br><br> รอสักครู่ ระบบจะนำกลับไปหน้าแรก ใหม่.."; //และ passwork=".$pwd_login." 
	showerror($showmsg);
	echo"<meta http-equiv=\"refresh\" content=\"5;URL=?folder=#\" />";
}
else {
$dbarr = mysql_fetch_array($result) ;
if($user_login != $dbarr['user']) { //and $pwd_login!=$dbarr['password']
	$showmsg="username".$user_login." ผิด  โปรดตรวจสอบอีกครั้ง <br><br> รอสักครู่ ระบบจะนำกลับไปหน้าแรก ใหม่.."; //หรือ รหัสผ่าน".$pwd_login." 
	showerror($showmsg);
	echo"<meta http-equiv=\"refresh\" content=\"3;URL=?folder=#\" />";
} else {
    $user_login=$dbarr['user'] ;
	
session_write_close();
ob_end_flush();
			$timeoutseconds=30*60;
			$_SESSION['timestamp2']=time();
			$timeout=$_SESSION['timestamp2'] - $timeoutseconds;
//echo "<meta http-equiv=refresh content='2;URL=index.php'>" ;
header("location:index.php?naivoi=car");
		}
	}
} }
?>
<script type="text/javascript">
writeObjects();
</script>
<div style="position:absolute;top:0px;width:100%;text-align:center">
<table width="100%" border="0" align="center" cellPadding="0" cellSpacing="0" >
<tbody>
	 <tr height="120">
	    <td width="200"><center>
			    <table cellspacing="0" cellpadding="0" width="100%" border="0">
			    <tr valign="top">
			    <td width="100%"  id="leftcol" height="20">
                <img src="templates/<?=WEB_TEMPLATES ;?>/images/logo.png" width="180" height="60" /><br><br>&nbsp;&nbsp;
<? if($_SESSION['login_true'] == "" and $_SESSION['admin_user'] == "") {?>
			    <img src="templates/<?=WEB_TEMPLATES ;?>/images/admins.gif" width="20" height="20" />... 
<? } else {   ?> 				
                <img src="images/personnel/<? if(empty($_SESSION['member_pic'])) { echo "member_nrr.gif" ;} else { echo "thb_".$_SESSION['member_pic'] ;} ?>" width="30" height="30" />&nbsp;&nbsp;
			    <b><? echo $_SESSION['fname']."&nbsp;&nbsp;".$_SESSION['lname'] ; ?></b>
<?  } 
//$user_name = $_COOKIE["username_log"]; 
//echo " user =".$user_name ;
?>
				</td>
				</tr>
			    </table><br>
		</td> 
		<td align="center" valign="top">
		</td>
		<td></td>
	</tr>
	<tr height="1">
		<td height="1" class="dotline">
		</td>
	</tr>
	<tr>
		<td colspan="3"><center>
<table align="center" cellspacing="0" cellpadding="0" width="990" border="0">
<tr>
<td width="990" colspan="3" valign="top">
<? if($folder=="" or $folder=="home") { ?>
<div id="header" height="40">
<ul>
  <li id="<? if($op == ""){ echo "current" ; } ?>"><a href="index.php">ล็อกอินผู้ใช้</a></li>
  <li id="<? if($op == "vision"){ echo "current" ; } ?>"><a href="?naivoi=home&voi=page&op=vision">นโยบายเว็บ</a></li>
  <li id="<? if($op == "training"){ echo "current" ; } ?>"><a href="?naivoi=home&voi=page&op=training">วีดีโอสาธิตใช้งาน</a></li>
</ul>
</div>
<? } else if($folder=="car" ) {?>
<div id="header" height="40">
<ul>
  <li id="<? if($file == "" or $file == "edit_car"){ echo "current" ; } ?>"><a href="index.php?naivoi=car">บันทึกขอใช้รถ</a></li>
  <li id="<? if($file == "list_printcar"){ echo "current" ; } ?>"><a href="index.php?naivoi=car&voi=list_printcar">พิมพ์ใบอนุญาตขอใช้รถ</a></li>
  <li id="<? if($file == "listcar"){ echo "current" ; } ?>"><a href="?naivoi=car&voi=listcar">รายการขอใช้รถ</a></li>
</ul>
</div>
<? } else if($folder=="member" ) {?>
<div id="header" height="40">
<ul>
  <li id="<? if($file == ""){ echo "current" ; } ?>"><a href="index.php?naivoi=member">ฝ่ายบริหาร</a></li>
  <li id="<? if($op == "2"){ echo "current" ; } ?>"><a href="index.php?naivoi=member&voi=member&op=2">ฝ่ายสมาชิกสภา</a></li>
  <li id="<? if($op == "4"){ echo "current" ; } ?>"><a href="?naivoi=member&voi=member&op=4">ฝ่ายพนักงานข้าราชการและลูกจ้าง</a></li>
  <li id="<? if($op == "5"){ echo "current" ; } ?>"><a href="?naivoi=member&voi=member&op=5">ฝ่ายกำนันผู้ใหญ่บ้าน</a></li>
  <li id="<? if($op == "6"){ echo "current" ; } ?>"><a href="?naivoi=member&voi=member&op=6">ฝ่ายสถานศึกษา</a></li>  
  <li id="<? if($op == "7"){ echo "current" ; } ?>"><a href="?naivoi=member&voi=member&op=7">ฝ่ายสถานพยาบาล</a></li>  
</ul>
</div>
<? } else if($folder=="admin" ) {?>
<div id="header" height="40">
<ul>
  <li id="<? if($file == "config"){ echo "current" ; } ?>"><a href="index.php?naivoi=admin">ตั้งค่าเว็บ</a></li>
  <li id="<? if($file == "member_add"){ echo "current" ; } ?>"><a href="index.php?naivoi=admin&voi=member_add">คีย์บุคลากร</a></li>
  <li id="<? if($file == "user"){ echo "current" ; } ?>"><a href="?naivoi=admin&voi=user">กำหนดหน้าที่</a></li>
  <li id="<? if($file == "backup"){ echo "current" ; } ?>"><a href="?naivoi=admin&voi=backupindex">แบ็คอัพข้อมูล</a></li>
</ul>
</div>
<? } ?>
</td>
</tr>
<tr>
<td background="images/main/r.gif" border="0" height="100%" width="7"></td>
<td width="976" align="center" valign="top">
<? if($folder=="" and $file=="") { ?>
			    <table cellspacing="0" cellpadding="0" width="100%"  border="0">
			    <tr valign="top">
			    <td width="100%" align="center" id="leftcol">
			    <? include ("naivoi/home/loginuser.php"); ?>
				</td>
				</tr>
			    </table><br>
<? } else { ?>
			    <table cellspacing="0" cellpadding="0" width="100%" border="0">
			    <tr valign="top">
			    <td width="100%" id="leftcol">
			    <? include ("".$MODPATHFILE.""); ?>
				</td>
				</tr>
			    </table>
<? } ?>	
</td>
<td background="images/main/l.gif" border="0" height="100%" width="7"></td>
</tr>
<tr>
<td background="images/main/b.gif" border="0" height="7" width="990" colspan="3"></td>
</tr>		  
</table>		
		</td>
	</tr>		
</table>
<!--
<table width="100%" border="0" align="center" cellPadding="0" cellSpacing="0" >
	<tr height="10">
		<td align="center">
        <center>
          <? //if($folder=="") { 				
            //if (CountBlock('home')) { ?>
			    <table cellspacing="0" cellpadding="0" width="100%" >
			    <tr valign="top">
			    <td width="100%"  id="leftcol">
			    <? //LoadBlock('home'); ?>
				</td>
				</tr>
			    </table><br>
          <?// } } ?>
		</td>
	</tr>	
</table>
-->
<table width="100%" border="0" align="center" cellPadding="0" cellSpacing="0" >
	<tr height="10">
		<td>
		</td>
	</tr>	
	<tr height="1">
		<td height="1" class="dotline">
		</td>
	</tr>
	<tr height="30">
		<td>
		<br><center><div class="fb-like" data-href="http://www.facebook.com/naivoidotcom/" data-width="The pixel width of the plugin" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div></center><br>
        </td>
	</tr>	
</table>
</div>
<div class="dock" id="dock">
  <div class="dock-container">
  <a class="dock-item" href="index.php"><img src="images/dock/home.png" alt="หน้าแรก" /><span>หน้าแรก</span></a> 
  <a class="dock-item" href="index.php?naivoi=car"><img src="images/dock/car.png" alt="ระบบงานขอใช้รถ" /><span>ขอใช้รถ</span></a> 
  <a class="dock-item" href="http://naivoi/psd/" target="_blank "><img src="images/dock/material.png" alt="ระบบงานวัสดุ" /><span>วัสดุ</span></a> 
  <a class="dock-item" href=""><img src="images/dock/durable.png" alt="ระบบงานครุภัณฑ์" /><span>ครุภัณฑ์</span></a>
  <a class="dock-item" href="index.php?naivoi=member"><img src="images/dock/member.png" alt="บุคลากร" /><span>บุคลากร</span></a> 
  <a class="dock-item" href="#"><img src="images/dock/board.png" alt="แลกเปลี่ยนความคิดเห็น" /><span>บอร์ด</span></a> 
  <? if($_SESSION['login_true'] == "" and $_SESSION['admin_user'] == "") {?>
  <a class="dock-item" href="index.php?naivoi=admin"><img src="images/dock/admin.png" alt="ผู้ดูแลระบบ" /><span>Admin</span></a>  
  <? } else if($_SESSION['login_true'] == "" and $_SESSION['admin_user'] <> "") { ?> 
  <a class="dock-item" href="index.php?naivoi=admin"><img src="images/dock/admin.png" alt="ผู้ดูแลระบบ" /><span>Admin</span></a>    
  <a class="dock-item" href="index.php?naivoi=home&voi=logout"><img src="images/dock/logout.png" alt="ออกจากระบบ" /><span>Logout</span></a>  
  <? } else { ?>  
  <a class="dock-item" href="index.php?naivoi=home&voi=logout"><img src="images/dock/logout.png" alt="ออกจากระบบ" /><span>Logout</span></a>    
  <? } ?>
  </div>
</div>	
<script language="JavaScript" type="text/JavaScript">
	$(document).ready(
		function()
		{
			$('#dock').Fisheye(
				{
					maxWidth: 30,
					items: 'a',
					itemsText: 'span',
					container: '.dock-container',
					itemWidth: 60,
					proximity: 30,
					halign : 'center'
				}
			)
		}
	);
</script>
</body>
</html>
