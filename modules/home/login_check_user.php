<table WIDTH="530"  border="0" ALIGN="center" CELLPADDING="0" CELLSPACING="0">
  <tr>
          <td width="10" vAlign="top"></td>
          <td width="520" vAlign=top colspan="2">

      &nbsp;&nbsp;<IMG SRC="images/home/textmenu_memberlogin.gif" BORDER="0">
				<TABLE width="520" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline" ></TD>
				</TR>
      <TR><td>
<?php
empty($_POST['sug_username'])?$user_login="":$user_login=$_POST['sug_username'];
$array = explode(' ', $user_login);
$fname = trim($array[0]) ;
$lname = trim($array[1]) ;

if(isset($user_login)) {  
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//$result_config = mysql_query("select name from ".TB_CONFIG." where posit='budget'") ;
//$dbarr_config = mysql_fetch_array($result_config) ;
$result = mysql_query("select member_id, fname, lname, section_id, user, member_pic from ".TB_MEMBER." where fname='".$fname."' and lname='".$lname."'") ; // and password='$pwd_login'") ;
$num = mysql_num_rows($result) ;
//echo mysql_error();
if($num<=0) {
	$showmsg="โปรดตรวจสอบ user=".$user_login." อีกครั้ง <br><br> รอสักครู่ ระบบจะนำกลับไปหน้าแรก ใหม่.."; //และ passwork=".$pwd_login." 
	showerror($showmsg);
	echo"<meta http-equiv=\"refresh\" content=\"5;URL=?folder=#\" />";
}
else {
$dbarr = mysql_fetch_array($result) ;
if($fname!=$dbarr['fname'] and $lname!=$dbarr['lname']) { //and $pwd_login!=$dbarr['password']
	$showmsg="username".$user_login." ผิด  โปรดตรวจสอบอีกครั้ง <br><br> รอสักครู่ ระบบจะนำกลับไปหน้าแรก ใหม่.."; //หรือ รหัสผ่าน".$pwd_login." 
	showerror($showmsg);
	echo"<meta http-equiv=\"refresh\" content=\"3;URL=?folder=#\" />";
} else {

    $user_login=$dbarr['user'] ;
//	mysql_query("UPDATE ".TB_MEMBER." SET lastlog=dtnow WHERE user='$user_login'");
//	mysql_query("UPDATE ".TB_MEMBER." SET dtnow='$now' WHERE user='$user_login'");


ob_start();

$_SESSION['login_true']=$user_login;
$_SESSION['section_id']=$dbarr['section_id'];
$_SESSION['fname']=$dbarr['fname'] ;
$_SESSION['lname']=$dbarr['lname'];
$_SESSION['member_pic']=$dbarr['member_pic'];
$_SESSION['naivoi']="voi";
setcookie("username_log",$user_login,time()+3600*24*356);
//cookies::write("cookie_user_login",$user_login,time()+3600);

    $showmsg="  ".$_SESSION['fname']."  ".$_SESSION['lname']."<br><br>" ;
	$showmsg=$showmsg."User=".$user_login."<br><br>กำลังเข้าระบบ <br> รอสักครู่ระบบจะนำท่านไปยังหน้าแรก...<br><br>" ;
	$showmsg=$showmsg."ประจำปีงบประมาณ ".$WEB_BUDGET."<br><br>";
	showerror($showmsg);
	
session_write_close();
ob_end_flush();

			$timeoutseconds=30*60;
			$_SESSION['timestamp2']=time();
			$timeout=$_SESSION['timestamp2'] - $timeoutseconds;
			
//echo "<meta http-equiv=refresh content='2;URL=index.php'>" ;
header("location:index.php");

				}
				}
				}
?>
</td></tr>
</table>
</td>
</tr>
</table>