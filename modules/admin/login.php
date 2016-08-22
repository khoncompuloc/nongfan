<TABLE cellSpacing="0" cellPadding="0" width="940" border="0">
<TBODY>
<?php 
//require_once("mainfile.php");
		$classtext = array("", "");
		$classbox = array("noborder2", "noborder2");
		$username = "";
		$password = "";

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//$res['config'] = $db->select_query("select name from ".TB_CONFIG." where posit='budget'") ;
//$arr['config_budget'] = $db->fetch($res['config']);
$res['admin'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$_POST['username']."' AND password='".md5($_POST['password'])."'  "); 
$rows['admin'] = $db->rows($res['admin']); 
if($rows['admin']){
	$arr['admin'] = $db->fetch($res['admin']);
}
$db->closedb ();

//Can Login
if($arr['admin']['id']){
session_unset($login_true);
	//Login ผ่าน
	ob_start();
	$_SESSION['admin_user'] = $_POST['username'] ;
	$_SESSION['section_id'] = $arr['admin']['section_id'] ;
	$_SESSION['admin_level'] = $arr['admin']['level'] ;
	$_SESSION['fname'] = $arr['admin']['username'] ;
	$_SESSION['lname']= "";
    //$_SESSION['member_pic'] = $arr['admin']['picture'];	
	$_SESSION['naivoi'] = "voi";
	
	session_write_close();
	ob_end_flush();
			$timeoutseconds=30*60;
			$_SESSION['timestamp2']=time();
			$timeout=$_SESSION['timestamp2'] - $timeoutseconds;

?>
        <TR>
          <TD width="720" vAlign=top align=left><br>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/admin/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="700" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
<BR><BR>
<CENTER><A HREF="?folder=admin&file=main"><IMG SRC="images/login-welcome.gif" BORDER="0"></A><BR><BR>
<FONT COLOR="#336600"><B>ได้ทำการเข้าระบบเรียบร้อยแล้ว</B>id<?php echo $_SESSION['section_id'] ;?></FONT><BR><BR>
<A HREF="?folder=admin&file=main"><B>เข้าสู่หน้าแรก</B></A>
</CENTER>
<?php 
       echo "<meta http-equiv='refresh' content='2; url=index.php?compu=admin&loc=main'>" ; 
       echo "<BR><BR>";
}else{
	//Login ไม่ผ่าน
       echo "<meta http-equiv='refresh' content='2; url=index.php?compu=admin'>" ; 
}
?>

<!--
        <TR>
          <TD width="720" vAlign=top align=left><BR>
				<TABLE width="700" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD>
	<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
      <TBODY>
        <TR>
          <TD vAlign=top align=center class="login" align="center"><FONT COLOR="#990000" size="3"><b>ชื่อผู้ใช้ หรือ รหัสผ่าน ไม่ถูกต้อง กรุณาตรวจสอบ</b></font>
		  </td>
		</tr>
        <TR>
          <TD vAlign=top align=center><BR>
<div id="maincontent">
	<div id="loginform">
		<h2><span class="gray">ผู้ดูแลระบบ ! login</span></h2>
		<form name="login" id="login" method="post" action="?compu=admin&loc=login">
			<p>
				ชื่อผู้ใช้ :
				<input type="text" name="username" id="username" class="<?php //echo $classbox[0]; ?>"  value="<?php //echo $username; ?>"  onclick="this.value=''" /><br />
				รหัสผ่าน : 
				<input type="password" name="password" id="password" class="<?php //echo $classbox[1]; ?>"  value="<?php //echo $password; ?>"  onclick="this.value=''" /><br />
		    	<br>
				<input type="hidden" name="action" id="action" value="login"> 
                <input name="button" type="submit" class="button" id="button" value="เข้าระบบ"   />
                <input name="button2" type="button" class="button" id="button2" value="ยกเลิก" onClick="window.location='index.php'" /><br />
			</p>
		</form>
		<div style="line-height: 18px">
             <br /><br>&nbsp;<br>&nbsp;
		</div>
	</div>
</div>
</td>
</tr>
</TABLE>
<?php 
//}
?>
					</TD>
				</TR>
			</TABLE>
-->			
				</TD>
				</TR>
			</TABLE>
