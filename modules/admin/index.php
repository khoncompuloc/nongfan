<link href="modules/admin/css/style.css" rel="stylesheet" type="text/css">
<?php
//require_once("mainfile.php");
		$classtext = array("", "");
		$classbox = array("noborder2", "noborder2");
		$username = "";
		$password = "";
if($admin_user){
	echo "<meta http-equiv='refresh' content='1; url=?compu=admin&loc=main'>" ;
}
?>
<center>
<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
<TBODY>
<tr>
<td vAlign=top align=center>
<div id="maincontent">
	<div id="loginform">
		<h2><span>ผู้ดูแลระบบ ! login</span></h2>
		<form name="login" id="login" method="post" action="?compu=admin&loc=login">
			<p>ชื่อผู้ใช้ :<input type="text" name="username" id="username" class="<?php echo $classbox[0]; ?>"  value="<?php echo $username; ?>"  onclick="this.value=''" /><br />
				รหัสผ่าน :<input type="password" name="password" id="password" class="<?php echo $classbox[1]; ?>"  value="<?php echo $password; ?>"  onclick="this.value=''" /><br />
		    	<br>
				<input type="hidden" name="action" id="action" value="login"> 
                <input name="button" type="submit" class="button" id="button" value="เข้าระบบ"   />
                <input name="button2" type="button" class="button" id="button2" value="ยกเลิก" onClick="window.location='?compu=admin'"><br />
			</p>
		</form>
		<div style="line-height: 18px">
             <br /><br>&nbsp;<br>&nbsp;
		</div>
	</div>
</div><br><br>
</td>
</tr>
</TABLE>