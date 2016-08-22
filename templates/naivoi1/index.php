<?php defined( '_NAIVOI' ) or die( 'Restricted access index' );
// Get content of module first
ob_start();
require_once ($MODPATHFILE);
$content = ob_get_contents();
ob_end_clean();
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo WEB_TITLE;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="templates/naivoi1/css/style.css" type="text/css">
<link rel="shortcut icon" href="images/favicon.ico">
<script type="text/javascript" src="js/jquery1.3.2.js"></script> 
<!-- <script type="text/javascript" src="js/jquery-1.7.min.js"></script> -->
<script type="text/javascript" src="js/interface.js"></script>
<script type="text/javascript" src="js/AC_OETags.js"></script>
<script type="text/javascript" src="js/pageear.js"></script>
<!--[if lt IE 7]>
 <style type="text/css">
 div, img { behavior: url(iepngfix.htc) }
 </style>
<![endif]-->
</head>
<body>
<div id="fb-root"></div>
<script>
 (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<?php
empty($_SESSION['login_true'])?$login_true="":$login_true=$_SESSION['login_true'];	
empty($_SESSION['admin_user'])?$admin_user="":$admin_user=$_SESSION['admin_user'];	
//require_once("mainfile.php");
$_SERVER['PHP_SELF'] = "index.php";

if(isset($_COOKIE["username_log"])){
   if(empty($_SESSION['naivoi'])){
$user_login = $_COOKIE["username_log"] ;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$result_config = mysql_query("select name from ".TB_CONFIG." where posit='budget'") ;
$dbarr_config = mysql_fetch_array($result_config) ;
$result = mysql_query("select member_id, fname, lname, section_id, user, member_pic from ".TB_MEMBER." where user='".$user_login."'") ; // and password='$pwd_login'") ;
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

ob_start();
$_SESSION['login_true']=$user_login;
$_SESSION['budget_year']=$dbarr_config['name'];
$_SESSION['fname']=$dbarr['fname'] ;
$_SESSION['lname']=$dbarr['lname'];
$_SESSION['section_id']=$dbarr['section_id'];
$_SESSION['member_pic']=$dbarr['member_pic'];
$_SESSION['naivoi']="voi";
setcookie("username_log",$user_login,time()+3600*24*30);	
session_write_close();
ob_end_flush();
			$timeoutseconds=30*60;
			$_SESSION['timestamp2']=time();
			$timeout=$_SESSION['timestamp2'] - $timeoutseconds;
//echo "<meta http-equiv=refresh content='2;URL=index.php'>" ;
header("location:index.php?compu=car");
		}
	}
} }
?>
<script type="text/javascript">
writeObjects();
</script>
<div style="position:absolute; top:0px; width:100%; text-align:center;">
<table width="100%" border="0" align="center" cellPadding="0" cellSpacing="0" >
<tbody>
	 <tr height="120">
	    <td width="200"><center>
			    <table cellspacing="0" cellpadding="0" width="100%" border="0">
			    <tr valign="top">
			    <td width="100%"  id="leftcol" height="20">
                <img src="templates/<?php echo WEB_TEMPLATES ;?>/images/logo.png" width="180" height="60" /><br><br>&nbsp;&nbsp;
<?php if(!$login_true and !$admin_user) { ?>
			    <img src="templates/<?php echo WEB_TEMPLATES ;?>/images/admins.gif" width="20" height="20" />... 
<?php } else {   ?> 				
                <img src="images/personnel/<?php if(empty($_SESSION['member_pic'])) { echo "member_nrr.gif" ;} else { echo "thb_".$_SESSION['member_pic'] ;} ?>" width="30" height="30" />&nbsp;&nbsp;
			    <b><?php echo $login_name ;?></b>
<?php } 
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
		<td height="1" class="dotline" colspan="3">
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
		</td>
	</tr>		
</table>		

<?php include ("templates/naivoi1/tabmenu.php"); ?>

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
  <a class="dock-item" href="index.php?compu=car"><img src="images/dock/car.png" alt="ระบบงานขอใช้รถ" /><span>ขอใช้รถ</span></a> 
  <a class="dock-item" href="index.php?compu=wsd"><img src="images/dock/material.png" alt="ระบบงานวัสดุ" /><span>วัสดุ</span></a> 
  <a class="dock-item" href="index.php?compu=kuru"><img src="images/dock/durable.png" alt="ระบบงานครุภัณฑ์" /><span>ครุภัณฑ์</span></a>
  <a class="dock-item" href="index.php?compu=member"><img src="images/dock/member.png" alt="บุคลากร" /><span>บุคลากร</span></a> 
  <a class="dock-item" href="#"><img src="images/dock/board.png" alt="แลกเปลี่ยนความคิดเห็น" /><span>บอร์ด</span></a> 
  <?php if(!$login_true and !$admin_user) {?>
  <a class="dock-item" href="index.php?compu=admin"><img src="images/dock/admin.png" alt="ผู้ดูแลระบบ" /><span>Admin</span></a>  
  <?php } else if(!$login_true and $admin_user) { ?> 
  <a class="dock-item" href="index.php?compu=admin"><img src="images/dock/admin.png" alt="ผู้ดูแลระบบ" /><span>Admin</span></a>    
  <a class="dock-item" href="index.php?compu=home&loc=logout"><img src="images/dock/logout.png" alt="ออกจากระบบ" /><span>Logout</span></a>  
  <?php } else { ?>  
  <a class="dock-item" href="index.php?compu=home&loc=logout"><img src="images/dock/logout.png" alt="ออกจากระบบ" /><span>Logout</span></a>    
  <?php } ?>
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