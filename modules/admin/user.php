<?php
CheckAdmin($admin_user,$admin_level);
?>
	<TABLE cellSpacing="0" cellPadding="0" width="950" border="0">
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="940" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/admin/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="940" align="center" cellSpacing="0" cellPadding="0" border="0">
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD><br>
<?
if($op == ""){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
/***
$limit = 20 ;
$SUMPAGE = $db->num_rows(TB_ADMIN,"id","");

if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;
**/
	//////////////////////////////////////////// กรณีเพิ่ม User Admin Form

$res['member'] = $db->select_query("SELECT member_id, fname, lname FROM ".TB_MEMBER." WHERE parties_id = '4' ORDER BY section_id, member_id ");		
?>
<script language="javascript" type="text/javascript">
function Inint_AJAX() {
   try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
   try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
   try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
   alert("XMLHttpRequest not supported");
   return null;
};

function dochange_user(src, val) {
     //alert(src);
	 //alert(val);
     var req = Inint_AJAX();
     req.onreadystatechange = function () { 
          if (req.readyState==4) {
		           
               if (req.status==200) {
			        
                    document.getElementById(src).innerHTML=req.responseText; //รับค่ากลับมา
               } 
          }
     };
	 var random=Math.random()
     req.open("GET", "naivoi/admin/ajax_user.php?data="+src+"&val="+val+"&random="+random , true); //สร้าง connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
     req.send(null); //ส่งค่า
}
</script>
<FORM NAME="adduserForm" METHOD=POST ACTION="?folder=admin&file=user&op=admin_add&action=add" onSubmit="return check()" enctype="multipart/form-data" >
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>กำหนดระดับหน้าที่ :</B><BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="level" id="level" class="requist_form" onChange="dochange_user('section',this.value);">
<?

if($admin_user == "admin") {
$res['groups'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." WHERE name<>'Webmaster' ORDER BY id ");
} else {
$res['groups'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." ORDER BY id ");
}
   echo "<option value=\"\" select>---เลือก---</option>" ;
   while ($arr['groups'] = $db->fetch($res['groups'])){
   
		echo "<option value=\"".$arr['groups']['id']."\">".$arr['groups']['description']."</option>";
   }
?>
</select>
<BR><BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>ส่วน/กอง</B><BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font id="section"><select><option value="0">-------------------</</option></select></font><BR><BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>ชื่อ - นามสกุล :</B><BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font id="name_mem"><select><option value="0">-------------------</</option></select></font>
<font id="position_name"></font><BR><BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>User Name :</B><BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE="user" NAME="user" size="40"><BR><BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>รหัสผ่าน :</B><BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE="password" NAME="password" size="40"><BR><BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>รหัสผ่านอีกครั้ง :</B><BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE="password" NAME="password_again" size="40">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!--
<B>รูปภาพ :</B><BR>
<INPUT TYPE="file" name="FILE" onpropertychange="view01.src=FILE.value;" size="40"><BR><BR>
-->
<INPUT TYPE="submit" value=" เพิ่มผู้ใช้ระบบงาน ">
</FORM><BR>
<SCRIPT LANGUAGE="javascript">			
function check() {
if(document.adduserForm.member_id.selectedIndex=="") {
alert("กรุณาเลือกชื่อ  ด้วยครับ") ;
document.adduserForm.member_id.focus() ;
return false ;
} 
else if(document.adduserForm.section_id.value=="") {
alert("กรุณาเลือกหน่วยงาน  ด้วยครับ") ;
document.adduserForm.section_id.focus() ;
return false ;
}
else if(document.adduserForm.password.value=="") {
alert("กรุณากรอกรหัสผ่านที่ต้องการด้วยครับ") ;
document.adduserForm.password.focus() ;
return false ;
}
else if(document.adduserForm.password_again.value=="") {
alert("กรุณายืนยันรหัสผ่านอีกครั้ง") ;
document.adduserForm.password_again.focus() ;
return false ;
}
else if(document.adduserForm.password.value != document.adduserForm.password_again.value) {
alert("รหัสผ่านทั้งสองไม่ตรงกัน กรุณายืนยันรหัสผ่านให้ถูกต้องด้วยครับ") ;
document.adduserForm.password_again.focus() ;
return false ;
}
if(document.adduserForm.level.selectedIndex=="") {
alert("กรุณาเลือก ระดับ ด้วยครับ") ;
document.adduserForm.level.focus() ;
return false ;
} 
else 
return true ;
}	
</SCRIPT>
<form action="?folder=admin&file=user&op=admin_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="2" cellpadding="1" >
  <tr bgcolor="#0066FF" height=25>
   <td><font color="#FFFFFF"><B><CENTER>Option</CENTER></B></font></td>
   <td><font color="#FFFFFF"><B>ชื่อผู้ใช้</B></font></td>
   <td><font color="#FFFFFF"><B>ชื่อ - นามสกุล</B></font></td>
   <td><font color="#FFFFFF"><B>หน่วยงาน</B></font></td>
   <td><font color="#FFFFFF"><B>Level</B></font></td>
  </tr>  
<?
//$res['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." ORDER BY id DESC LIMIT $goto, $limit ");
$res['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." ORDER BY id DESC ");
$count=0;
while($arr['user'] = $db->fetch($res['user'])){
	$res['groups'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." WHERE id='".$arr['user']['level']."' ");
	$arr['groups'] = $db->fetch($res['groups']);
	$res['section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." WHERE section_id='".$arr['user']['section_id']."' ");
	$arr['section'] = $db->fetch($res['section']);
    if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = "#FDEAFB";
} else {
$ColorFill = "#F0F0F0";
}

?>
    <tr bgcolor="<?=$ColorFill; ?>" onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='<?=$ColorFill;?>' ">
     <td width="44">
      <a href="?folder=admin&file=user&op=admin_edit&id=<? echo $arr['user']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="แก้ไข" ></a> 
      <a href="?folder=admin&file=user&op=admin_del&id=<? echo $arr['user']['id'];?>" onClick="return chkdel();" ><img src="images/admin/trash.gif"  border="0" alt="ลบ" ></a>
	 </td> 
     <td><?echo $arr['user']['username'];?></td>
     <td ><? echo $arr['user']['name'];?></td>
     <td ><? echo $arr['section']['section_name'];?></td>
     <td ><? echo $arr['groups']['name'];?></td>
    </tr>
	<TR>
		<TD colspan="5" height="1" class="dotline"></TD>
	</TR>
<?
	$count++;
 } 
?>
 </table>
 </form><BR><BR>
<?
/***
	SplitPage($page,$totalpage,"?folder=admin&file=user");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
	echo "<BR><BR>";
***/
$res['groupstext'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." ORDER BY id ");
while ($arr['groupstext'] = $db->fetch($res['groupstext']))
   {
		echo "<LI><B>".$arr['groupstext']['name']." : </B>".$arr['groupstext']['description']."</LI>";
   }
$db->closedb ();

echo "<SCRIPT LANGUAGE=\"javascript\">";		
echo "function chkdel(){";
echo " if(confirm('  กรุณายืนยันการลบอีกครั้ง !!!  ')){";
echo " return true;";
echo " }else{";
echo "	return false;";
echo " } }";		
echo "</SCRIPT>";
} else if($op == "admin_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม User Admin Database
	if(CheckLevel($admin_user,$op)){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	//ตรวจสอบมี user นี้หรือยัง
	$res['admin'] = $db->select_query("SELECT id FROM ".TB_ADMIN." WHERE username='".$_POST['USERNAME']."' ");
	$rows['admin'] = $db->rows($res['admin']); 
	$db->closedb ();
		if($rows['admin']){
			$ProcessOutput .= "<BR><BR>";
			$ProcessOutput .= "<CENTER><IMG SRC=\"images/notview.gif\" BORDER=\"0\"><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ชื่อผู้ดูแลระบบ : ".$_POST['USERNAME']." มีในระบบแล้วไม่สามารถเพิ่มได้</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"javascript:history.go(-1);\"><B>กลับไปแก้ไข</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
		}else{
//		    $arr_date = explode("-",$_POST['name']) ;
			//ทำการเพิ่มข้อมูลลงดาต้าเบส
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	
			$res['member'] = $db->select_query("SELECT prefix, fname, lname FROM ".TB_MEMBER." where member_id = ".$_POST['member_id']."");
			$arr['member'] = $db->fetch($res['member']) ;
			$name = $arr['member']['prefix'].$arr['member']['fname']."  ".$arr['member']['lname'] ;
			
			$db->add_db(TB_ADMIN,array(
				"username"=>"".$_POST['user']."",
				"password"=>"".md5($_POST['password'])."",
				"name"=>"".$name."",
				"member_id"=>"".$_POST['member_id']."",
				"section_id"=>"".$_POST['section_id']."",
				"level"=>"".$_POST['level']."",
				"elect"=>"".$_POST['elect_id']."",
				"position_id_elect"=>"".$_POST['elect_position_id'].""				
			));
			$db->closedb ();
			$ProcessOutput = "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?folder=admin&file=main\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการเพิ่มชื่อผู้ดูแลระบบ : ".$_POST['USERNAME']." เข้าสู่ระบบเรียบร้อยแล้ว</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"?folder=admin&file=user\"><B>กลับหน้า จัดการผู้ดูแลระบบ</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
		}
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}  else if($op == "admin_edit" AND $action == "edit"){
	//////////////////////////////////////////// กรณีแก้ไข User Admin Database Edit
	if(CheckLevel($admin_user,$op)){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	//ตรวจสอบมี user นี้หรือยัง
	$res['admin'] = $db->select_query("SELECT id FROM ".TB_ADMIN." WHERE username='".$_POST['USERNAME']."' ");
	$rows['admin'] = $db->rows($res['admin']); 
	$db->closedb ();
		if($rows['admin'] AND ($_POST['USERNAME'] != $_POST['USERNAME_OLD'])){
			$ProcessOutput = "<BR><BR>";
			$ProcessOutput .= "<CENTER><IMG SRC=\"images/notview.gif\" BORDER=\"0\"><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ชื่อผู้ดูแลระบบ : ".$_POST['USERNAME']." มีในระบบแล้วไม่สามารถเพิ่มได้</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"javascript:history.go(-1);\"><B>กลับไปแก้ไข</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
		}else{
			if($_POST['PASSWORD']){
				$NewPass = md5($_POST['PASSWORD']);
			}else{
				$NewPass = $_POST['oldpass'];
			}

		if ($_FILES['FILE']['tmp_name'] !="") {
		require("includes/class.resizepic.php");
		$FILE = $_FILES['FILE'];
		$namepic=$_FILES['FILE']['tmp_name'];
		$namepic_name=$_FILES['FILE']['name'];
		$namepic_size=$_FILES['FILE']['size'];
		$namepic_type=$_FILES['FILE']['type'];

		if (($FILE['type']!="image/jpg") AND ($FILE['type']!="image/jpeg") AND ($FILE['type']!="image/pjpeg")){
			echo "<script language='javascript'>" ;
			echo "alert('กรุณาใช้ไฟล์นามสกุล jpg เท่านั้น')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.go(-1)</script>";
		//	echo "$namepic_name<br>";
			exit();
		}else{
			$filepic=$FILE['tmp_name'];
			@copy ($FILE['tmp_name'] , "icon/admin_".TIMESTAMP."_".$namepic_name."");
			$original_image = "icon/admin_".TIMESTAMP."_".$namepic_name."" ;
			$desired_width = _Iadmin_W ;
			$desired_height = _Iadmin_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/admin_".TIMESTAMP."_".$namepic_name."", "JPG");
		}	
			//ทำการเพิ่มข้อมูลลงดาต้าเบส
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->update_db(TB_ADMIN,array(
				"username"=>"".$_POST['USERNAME']."",
				"password"=>"".$NewPass."",
				"name"=>"".$_POST['NAME']."",
				"email"=>"".$_POST['EMAIL']."",
				"level"=>"".$_POST['LEVEL']."",
				"picture"=>"admin_".TIMESTAMP."_".$namepic_name.""
			)," id='".$_GET['id']."' ");

		} else {
			//ทำการเพิ่มข้อมูลลงดาต้าเบส
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->update_db(TB_ADMIN,array(
				"username"=>"".$_POST['USERNAME']."",
				"password"=>"".$NewPass."",
				"name"=>"".$_POST['NAME']."",
				"email"=>"".$_POST['EMAIL']."",
				"level"=>"".$_POST['LEVEL'].""
			)," id='".$_GET['id']."' ");
		}
			$db->closedb ();
			$ProcessOutput = "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?folder=admin&file=main\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการแก้ไขผู้ระบบเรียบร้อยแล้ว</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"?folder=admin&file=logout\"><B>ถ้าท่านเปลี่ยนรหัสผ่านท่านเอง กรุณาเข้าระบบใหม่</B></A><br><br>";
			$ProcessOutput .= "<A HREF=\"?folder=admin&file=main\"><B>ถ้าท่านเปลี่ยนรหัสผ่านบุคคลอื่น กลับไปหน้าผู้ดูแลระบบ</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";

		}


	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
} else if($op == "admin_edit"){
	//////////////////////////////////////////// กรณีแก้ไข User Admin Edit Form
	if(CheckLevel($admin_user,$op)){
		//ดึงค่าของผู้ดูแลระบบออกมา
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['admin'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE id='".$_GET['id']."' ");
		$arr['admin'] = $db->fetch($res['admin']);
		$db->closedb ();
		//ไม่ให้อัพเดทตัวเอง
		if($admin_user == $arr['admin']['username']){
			$Readonly = " readonly ";
		}
?>
<FORM METHOD=POST ACTION="?folder=admin&file=user&op=admin_edit&action=edit&id=<?=$_GET['id'];?>" enctype="multipart/form-data" name="edit">
<B>ชื่อผู้ใช้ :</B><BR>
<INPUT TYPE="text" NAME="USERNAME" size="40" VALUE="<?=$arr['admin']['username'];?>"><BR><INPUT TYPE="hidden" NAME="USERNAME_OLD" VALUE="<?=$arr['admin']['username'];?>">
<B>รหัสผ่าน :</B><BR>
<INPUT TYPE="text" NAME="PASSWORD" size="40" VALUE="<?=$arr['admin']['password'];//$Readonly;?>"><BR>
<B>ชื่อ - นามสกุล :</B><BR>
<INPUT TYPE="text" NAME="NAME" size="40" VALUE="<?=$arr['admin']['name'];?>"><BR>
<B>Email :</B><BR>
<INPUT TYPE="text" NAME="EMAIL" size="40" VALUE="<?=$arr['admin']['email'];?>"><BR>
<B>Level :</B><BR>
<SELECT NAME="LEVEL">
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['groups'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." ORDER BY id ");
   while ($arr['groups'] = $db->fetch($res['groups']))
   {
		echo "<option value=\"".$arr['groups']['id']."\" ";
		if($arr['groups']['id'] == $arr['admin']['level']){echo " Selected";};
		echo ">".$arr['groups']['name']."</option>";
   }
$db->closedb ();
?>
</SELECT>
<BR><BR>
<B>รูปภาพ :</B><BR>
<INPUT TYPE="file" name="FILE" onpropertychange="view01.src=FILE.value;" size="40"><BR>
<INPUT TYPE="submit" value=" แก้ไขผู้ดูแลระบบ "><INPUT TYPE="hidden" NAME="oldpass" value="<?=$arr['admin']['password'];?>">
</FORM>
<?
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
} else if($op == "admin_del" AND $action == "multidel"){
	//////////////////////////////////////////// กรณีลบ User Admin Multi
	if(CheckLevel($admin_user,$op)){
		while(list($key, $value) = each ($_POST['list'])){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->del(TB_ADMIN," id='".$value."' "); 
			$db->closedb ();
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?folder=admin&file=main\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการลบรายการผู้ระบบเรียบร้อยแล้ว</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?folder=admin&file=user\"><B>กลับหน้า จัดการผู้ดูแลระบบ</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
} else if($op == "admin_del"){
	//////////////////////////////////////////// กรณีลบ User Admin Form
	if(CheckLevel($admin_user,$op)){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		
		//$res['admin'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE id='".$_GET['id']."' ");
		//$arr['admin'] = $db->fetch($res['admin']);
		//$picture=$arr['admin']['picture'];
		//if (empty($picture)){
		//unlink("images/stupic/".$picture."");
		//} else {
		//unlink("icon/".$picture."");
		//}

		$db->del(TB_ADMIN," id='".$_GET['id']."' "); 

		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?folder=admin&file=main\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการลบผู้ระบบเรียบร้อยแล้ว</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?folder=admin&file=user\"><B>กลับหน้า จัดการผู้ดูแลระบบ</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
} else if($op == "minepass_edit" AND $action == "edit"){
	//////////////////////////////////////////// กรณีแก้ไขข้อมูลส่วนตัว
	if(CheckLevel($admin_user,$op)){
			if(!$_POST['USERNAME'] OR !$_POST['NAME'] OR !$_POST['EMAIL']){
				$ProcessOutput = "<BR><BR>";
				$ProcessOutput .= "<CENTER><IMG SRC=\"images/notview.gif\" BORDER=\"0\"><BR><BR>";
				$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>กรุณากรอกข้อมูลต่างๆให้ครบถ้วน</B></FONT><BR><BR>";
				$ProcessOutput .= "<A HREF=\"javascript:history.go(-1);\"><B>กลับไปแก้ไข</B></A>";
				$ProcessOutput .= "</CENTER>";
				$ProcessOutput .= "<BR><BR>";
			}else{

				if($_POST['PASSWORD']){
					$NewPass = md5($_POST['PASSWORD']);
					$URLre = "?folder=admin&logout";
					session_unset();
					session_destroy();
				}else{
					$NewPass = $_POST['oldpass'];
					$URLre = "?folder=admin&file=main";
				}
		if ($_FILES['FILE']['tmp_name'] !="") {
		require("includes/class.resizepic.php");
		$FILE = $_FILES['FILE'];
		$namepic=$_FILES['FILE']['tmp_name'];
		$namepic_name=$_FILES['FILE']['name'];
		$namepic_size=$_FILES['FILE']['size'];
		$namepic_type=$_FILES['FILE']['type'];

		if (($FILE['type']!="image/jpg") AND ($FILE['type']!="image/jpeg") AND ($FILE['type']!="image/pjpeg")){
			echo "<script language='javascript'>" ;
			echo "alert('กรุณาใช้ไฟล์นามสกุล jpg เท่านั้น')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.go(-1)</script>";
		//	echo "$namepic_name<br>";
			exit();
		}else{
			$filepic=$FILE['tmp_name'];
			@copy ($FILE['tmp_name'] , "icon/admin_".TIMESTAMP."_".$namepic_name."");
			$original_image = "icon/admin_".TIMESTAMP."_".$namepic_name."" ;
			$desired_width = _Iadmin_W ;
			$desired_height = _Iadmin_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/admin_".TIMESTAMP."_".$namepic_name."", "JPG");
		}	
			//ทำการเพิ่มข้อมูลลงดาต้าเบส
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->update_db(TB_ADMIN,array(
				"username"=>"".$_POST['USERNAME']."",
				"password"=>"".$NewPass."",
				"name"=>"".$_POST['NAME']."",
				"email"=>"".$_POST['EMAIL']."",
				"picture"=>"admin_".TIMESTAMP."_".$namepic_name.""
			)," id='".$_GET['id']."' ");

		} else {
			//ทำการเพิ่มข้อมูลลงดาต้าเบส
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->update_db(TB_ADMIN,array(
				"username"=>"".$_POST['USERNAME']."",
				"password"=>"".$NewPass."",
				"name"=>"".$_POST['NAME']."",
				"email"=>"".$_POST['EMAIL'].""
			)," id='".$_GET['id']."' ");
		}
			$db->closedb ();
			$ProcessOutput = "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?folder=admin&file=main\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการแก้ไขผู้ระบบเรียบร้อยแล้ว</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"".$URLre."\"><B>ถ้าท่านเปลี่ยนรหัสผ่านท่านเอง กรุณาเข้าระบบใหม่</B></A><br><br>";
			$ProcessOutput .= "<A HREF=\"".$URLre."\"><B>ถ้าท่านเปลี่ยนรหัสผ่านบุคคลอื่น กลับไปหน้าผู้ดูแลระบบ</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";

		}
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
} else if($op == "minepass_edit"){
	//////////////////////////////////////////// กรณีแก้ไขข้อมูลส่วนตัว
	if(CheckLevel($admin_user,$op)){
		//ดึงค่าของผู้ดูแลระบบออกมา
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['admin'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$admin_user."' ");
		$arr['admin'] = $db->fetch($res['admin']);
		$id=$arr['admin']['id'];
		$db->closedb ();
?>
<FORM METHOD=POST ACTION="?folder=admin&file=user&op=minepass_edit&action=edit&id=<?=$id;?> " enctype="multipart/form-data" id="edit">
<B>ชื่อผู้ใช้ :</B><BR>
<INPUT TYPE="text" NAME="USERNAME" size="40" VALUE="<?=$arr['admin']['username'];?>" readonly style="color=#FF0000;"><BR>
<B>รหัสผ่าน :</B><BR>
<INPUT TYPE="password" NAME="PASSWORD" size="40" VALUE=""><BR>
<B>ชื่อ - นามสกุล :</B><BR>
<INPUT TYPE="text" NAME="NAME" size="40" VALUE="<?=$arr['admin']['name'];?>"><BR>
<B>Email :</B><BR>
<INPUT TYPE="text" NAME="EMAIL" size="40" VALUE="<?=$arr['admin']['email'];?>"><BR>
<B>รูปภาพ :</B><BR>
<INPUT TYPE="file" name="FILE" onpropertychange="view01.src=FILE.value;" size="40"><BR>

<INPUT TYPE="submit" value=" แก้ไขข้อมูลส่วนตัว "><INPUT TYPE="hidden" NAME="oldpass" value="<?=$arr['admin']['password'];?>">
</FORM>
<?
	}else{
		//กรณีไม่ผ่าน
		echo $PermissionFalse ;
	}
}
?>
						<BR><BR>
					</TD>
				</TR>
			</TABLE>
				</TD>
				</TR>
			</TABLE>
