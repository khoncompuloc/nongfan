<?php
//empty($_SESSION['admin_user'])?$admin_user="":$admin_user=$_SESSION['admin_user'];
//empty($_SESSION['login_true'])?$login_true="":$login_true=$_SESSION['login_true'];
if ($admin_user){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['admin'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$admin_user."' ");
		$arr['admin'] = $db->fetch($res['admin']);
?>
            <table border="0" cellpadding="0" cellspacing="0" width="200">
			<?php if ($arr['admin']['picture']<>""){?>
			<tr><td align="center"><img src="images/personnel/thb_<?php echo $arr['admin']['picture'];?>" name="view01" border="0" id="view01" width="80" ></td></tr>
			<?php } else {
			?>
			<tr><td align="center"><img src="images/personnel/admin.png" name="view01" border="0" id="view01" width="80" ></td></tr>
			<?php } ?>
			<tr>
			<td align="center">Hello <?php echo $admin_user; ?></td>
			</tr>
			<tr>
			<td align="center"><a href='index.php?compu=admin&file=logout'>[ ออกจากระบบ ]</a></td>
			</tr>
			</table>
<?php
} else if ($login_true){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['user'] = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE user='".$login_true."'");
		$arr['user'] = $db->fetch($res['user']);
?>
			<table cellspacing="0" cellpadding="0" width="400" border="0">
<?php	if($arr['user']['member_pic'] == ""){ 
	echo "<tr><td align=center><br><IMG SRC=\"images/personnel/member_nrr.gif\" WIDTH=\"120\" BORDER=\"0\" ALIGN=\"center\" class=\"membericon\"></td></tr>";
	}else{  
	echo "<tr><td align=center><br><IMG SRC=\"images/personnel/thb_".$arr['user']['member_pic']."\" WIDTH=\"120\" BORDER=\"0\" ALIGN=\"center\"></td></tr>";
	}
?>
			<tr>
			<td align="center"><FONT COLOR="#FF0000" SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif"><br><?php echo $arr['user']['fname']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $arr['user']['lname']; ?></FONT></td>
			</tr>
			<tr>
			<td align="center"><br><a href='index.php?compu=home&loc=logout'>[ ออกจากระบบ ]</a><br><br></td>
			</tr>
			</table>
<?php
} else if($login_true == '' and  $admin_user == '') { 
?>
<link href="modules/home/css/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript">
<!--
function suggest(inputString){
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#sug_username').addClass('load');
			$.post("modules/home/autosuggest.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#sug_username').removeClass('load');
				}
			});
		}
	}
	
function fill(thisValue) {
		$('#sug_username').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 300);
	}	
	
function check_Form_login() {
	if(document.checkForm2.sug_username.value=='') {
	alert('กรุณากรอกชื่อของท่านในการ login ด้วยครับ') ;
	document.checkForm2.sug_username.focus() ;
	return false ;
	} else {
		return true ;
		}
	}
		
//-->	
</script>	
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td colspan="2" align="center"><br>
			<img src="images/block/graduatelogin.gif" width="150" height="30" /><br><br><br>
			<FORM ACTION='?compu=home&loc=login_check_user'  name='checkForm2' id='checkForm2' method='post' onsubmit='return check_Form_login()' ENCTYPE="multipart/form-data">
				<TABLE width="100%">
				<TR>
				    <TD width='42%' align='right' valign='top'><b>ชื่อ-สกุล :</b></TD>
				    <TD width='58%'align='left'>
                    <input type="text" name="sug_username" id="sug_username" value="" onkeyup="suggest(this.value);"  class="" style="background-color: #fff; border: 1px solid #999; width: 150px; height:20px; padding: 2px" />
                    <div class="suggestionsBox_loginuser" id="suggestions" style="display: none;">
                    <div class="suggestionList_loginuser" id="suggestionsList"></div>
                    </div>					
                   </TD>
				</TR>
				<TR align='right' valign='top'>
					<TD colspan='2' align='center' valign='middle'><br><br><input name='submit' type='submit' value='เข้าระบบ'><br><br><br></TD>
				</TR>
				</TABLE>
			</FORM>
			</td>
			</tr>
			</table>
<?php } ?>