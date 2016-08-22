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
					<TD>
<?php
	$paths="".WEB_PATH."/templates/".WEB_TEMPLATES."/images/config/";
//////////////////////////////////////////// แสดงรายการข่าวสาร / ประชาสัมพันธ์ 
if($op == ""){
?>
<script language="javascript" type="text/javascript">
 	function dochange_agenmini() {
		var str = document.getElementById('select_agen_mini').value ;
		var fields = str.split(/-/);
		var agen_mini = fields[0];
		var agen_full = fields[1];
        document.getElementById("agen_mini").value= agen_mini ;		
        document.getElementById("agen_full").value= agen_full ;		

    }
</script>  
<?php

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['configs'] = $db->select_query("SELECT * FROM ".TB_CONFIG."  ORDER BY id ");
$sd=1;
while($arr['configs'] = $db->fetch($res['configs'])){
if ($arr['configs']['posit']=='logo'){ $psd_logo=$arr['configs']['name'];}
if ($arr['configs']['posit']=='agen_mini'){ $psd_agen_mini=$arr['configs']['name'];}
if ($arr['configs']['posit']=='agen_full'){ $psd_agen_full=$arr['configs']['name'];}
if ($arr['configs']['posit']=='agen_name'){ $psd_agen_name=$arr['configs']['name'];}
if ($arr['configs']['posit']=='district'){ $psd_district=$arr['configs']['name'];}
if ($arr['configs']['posit']=='amphur'){ $psd_amphur=$arr['configs']['name'];}
if ($arr['configs']['posit']=='province'){ $psd_province=$arr['configs']['name'];}
if ($arr['configs']['posit']=='budget'){ $psd_budget=$arr['configs']['name'];}
if ($arr['configs']['posit']=='templates'){ $psd_templates=$arr['configs']['name'];}
if ($arr['configs']['posit']=='wsd_card'){ $psd_wsd_card=$arr['configs']['name'];}
$sd++;
}
?>
 <table width="100%" cellspacing="2" cellpadding="1" border="0">
 <form method="post" name="config" id="config" action="?naivoi=admin&voi=config&op=config_add&action=add" enctype="multipart/form-data">
  <tr>
  <td align="center">
  <img src="templates/<?php echo WEB_TEMPLATES;?>/images/<?php echo $psd_logo ;?>"  width="180" height="60" border="0">
  <br>
 <table  width="100%" cellspacing="2" cellpadding="2" bgcolor="#F4F4F4">
  <tr>
  <td align="right"  width="120">LOGO :</td><td><input type="input" name="psd_logo" id="psd_logo" size="20" value="<?php echo $psd_logo;?>" disabled> </td></tr>
  <td align="right"  width="120">ชื่อย่อหน่วยงาน :</td>
  <td>
  <SELECT NAME="select_agen_mini" ID="select_agen_mini" onChange="dochange_agenmini()">
<?php
            $agen_mini = "อบต.-ทต.-ทม." ;
			$agen_full = "องค์การบริหารส่วนตำบล-เทศบาลตำบล-เทศบาลเมือง" ;
			$arr_agen_mini=explode("-",$agen_mini);
			$arr_agen_full=explode("-",$agen_full);			
            for($i=0;$i<=2;$i++){
				if($psd_agen_mini == $arr_agen_mini[$i]){
					$selected="selected=\"selected\"";
					$var_agen_full = $arr_agen_full[$i] ;
					$var_agen_mini = $arr_agen_mini[$i] ;
				} else {
					$selected="";
				}
            	echo "<option value=\"".$arr_agen_mini[$i]."-".$arr_agen_full[$i]."\"". $selected.">".$arr_agen_mini[$i]."</option>";
            }
?>	
   </SELECT><input type="hidden" name="agen_mini" id="agen_mini"  value="<?php echo $var_agen_mini ;?>">
  </td>
  </tr>
  <td align="right"  width="120">ชื่อเต็มหน่วยงาน :</td><td><input type="input" name="agen_full" id="agen_full" size="30" value="<?php echo $var_agen_full ;?>" readonly></td></tr>
  <td align="right"  width="120">ชื่อหน่วยงาน :</td><td><input type="input" name="agen_name" id="agen_name" size="45" value="<?php echo $psd_agen_name;?>"></td></tr>
  <td align="right"  width="120">ตำบล :</td><td><input type="input" name="district" id="district" size="35" value="<?php echo $psd_district;?>"></td></tr>
  <td align="right"  width="120">อำเภอ :</td><td><input type="input" name="amphur" id="amphur" size="30" value="<?php echo $psd_amphur;?>"></td></tr>
  <td align="right"  width="120">จังหวัด :</td><td><input type="input" name="province" id="province" size="25" value="<?php echo $psd_province;?>"></td></tr>
<!-- 
  <td align="right"  width="120">ประจำปีงบประมาณ :</td><td>25<input type="input" name="budget" id="budget" size="2" value="<?php//=$psd_budget;?>"></td></tr>  
  <td align="right"  width="120" valign=top>ลักษณะบัญชีวัสดุ :</td>
  <td>
  <INPUT name="wsd_card" type="radio" value="0" <?php// if($psd_wsd_card == "0"){ echo " checked" ;} ?>>รวมเป็นหน่วยงานเดียว&nbsp;&nbsp;&nbsp;
  <INPUT name="wsd_card" type="radio" value="1" <?php// if($psd_wsd_card == "1"){ echo " checked" ;} ?>>แยกหน่วยงาน(ส่วน/กอง)
  </td></tr>
-->
  <td align="right"  width="120" valign=top>Templates :</td>
  <td valign=top>
  <select name="picture"  id="picture" onChange="showimage()" />
<?php
  if ($handle = opendir("templates")) {
    while (false !== ($item = readdir($handle))) {
      if ($item != "." && $item != ".." && $item != "Thumbs.db") {
	echo "<option value=".$item." value2=templates/".$item."/thumbnail.png  ";
	if($psd_templates==$item){ echo "selected";}
	echo ">$item</option>";
      }
    }
    closedir($handle);
  }
?>
  </select>
<script language="javascript">

function showimage()
{
if (!document.images)
return
document.images.pictures.src=
document.form.picture.options[document.form.picture.selectedIndex].value2
}
//-->
</script>

<br><a href="javascript:linkrotate(document.form.picture.selectedIndex)" onMouseover="window.status='';return true"><img src="templates/<?php echo $psd_templates;?>/thumbnail.png" name="pictures" border=0></a>
	
</td></tr>
</td>
</tr>
</table>
</td>

</tr>
  <tr>
  <td colspan="2" align="center"><input type="submit" name="Submit" value="แก้ไขข้อมูล" class="orenge">
  <input type="hidden" name="province" id="province" size="25" value="<?php echo $psd_province;?>">
  </td>
  </tr>
</form>  
</table>

<?php
}
else if($op == "config_add" AND $action == "add"){

  		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
 		$db->update_db(TB_CONFIG,array(
			"name"=>"".addslashes(htmlspecialchars($_POST['agen_mini'])).""
		)," posit='agen_mini' ");
 		$db->update_db(TB_CONFIG,array(
			"name"=>"".addslashes(htmlspecialchars($_POST['agen_full'])).""
		)," posit='agen_full' ");
 		$db->update_db(TB_CONFIG,array(
			"name"=>"".addslashes(htmlspecialchars($_POST['agen_name'])).""
		)," posit='agen_name' ");
 		$db->update_db(TB_CONFIG,array(
			"name"=>"".addslashes(htmlspecialchars($_POST['district'])).""
		)," posit='district' ");
 		$db->update_db(TB_CONFIG,array(
			"name"=>"".addslashes(htmlspecialchars($_POST['amphur'])).""
		)," posit='amphur' ");
 		$db->update_db(TB_CONFIG,array(
			"name"=>"".addslashes(htmlspecialchars($_POST['province'])).""
		)," posit='province' ");
 		$db->update_db(TB_CONFIG,array(
			"name"=>"".addslashes(htmlspecialchars($_POST['email'])).""
		)," posit='email' ");		
// 		$db->update_db(TB_CONFIG,array(
//			"name"=>"".addslashes(htmlspecialchars($_POST['budget'])).""
//		)," posit='budget' ");	
// 		$db->update_db(TB_CONFIG,array(
//		    "name"=>"".addslashes(htmlspecialchars($_POST['wsd_card'])).""
//		)," posit='wsd_card' ");		
		$db->closedb ();

		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?naivoi=admin&voi=config\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการเปลี่ยนแปลงเรียบร้อยแล้วครับ</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?naivoi=admin&voi=config\"><B>กลับหน้า จัดการ config</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
		
    	echo $ProcessOutput ;
}

?>
						<BR><BR>
					</TD>
				</TR>
			</TABLE>
				</TD>
				</TR>
			</TABLE>
