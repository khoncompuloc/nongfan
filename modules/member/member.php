<?php
    if(isset($op) and $op=="2"){ $name="ดูรายการฝ่ายสมาชิกสภา" ; }                    
	if(isset($op) and $op=="5"){ $name="ดูรายการฝ่ายกำนันผู้ใหญ่บ้าน" ; }
	if(isset($op) and $op=="6"){ $name="ดูรายการฝ่ายสถานศึกษา" ; }
	if(isset($op) and $op=="7"){ $name="ดูรายการฝ่ายสถานพยาบาล" ; }

    if($op == "4") {
?>	
<script language="javascript" type="text/javascript">
function dochange(form) {
  var data = document.sec_form.section_id.value ;
  var url = "?compu=member&loc=member&op=4&data="+data ;
  //alert(url) ;
  location.href = url ;
}
</script>	
<?php
		$res['member_p'] = $db->select_query("SELECT member_id, prefix, fname, lname, address, district, amphur, province, zipcode, mobile, position_id, member_pic FROM ".TB_MEMBER." WHERE parties_id='3' ORDER BY degree_id DESC ");
		while($arr['member_p'] = $db->fetch($res['member_p'])) { 
		$res['position'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id='".$arr['member_p']['position_id']."'");
		$arr['position'] = $db->fetch($res['position']);		
?>
<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td height="5" colspan="4"></td>
  </tr>
  <tr>
    <td width="250" height="105" rowspan="3" align="center"><img src="images/personnel/thb_<?php echo $arr['member_p']['member_pic']; ?>" height="105" align="baseline" /></td>
    <td width="100" height="35" align="right">ชื่อ-สกุล :</td>
    <td width="540">&nbsp;&nbsp;&nbsp;<?php echo $arr['member_p']['prefix']; ?><?php echo $arr['member_p']['fname']; ?>&nbsp;&nbsp;&nbsp;<?php echo $arr['member_p']['lname']; ?></td>
    <td></td>
  </tr>
  <tr>
    <td height="35" align="right">ตำแหน่ง :</td>
    <td>&nbsp;&nbsp;&nbsp;<?php echo $arr['position']['position_name'].WEB_AGEN_FULL.WEB_AGEN_NAME ; ?></td>
    <td></td>
  </tr>
  <tr>
    <td height="35" align="right">เบอร์ติดต่อ :</td>
    <td>&nbsp;&nbsp;&nbsp;<?php echo $arr['member_p']['mobile']; ?></td>
    <td></td>
  </tr>
  <tr>
    <td height="35" align="center"></td>
    <td align="right">ที่อยู่ :</td>
    <td>&nbsp;&nbsp;&nbsp;<?php echo $arr['member_p']['address']; ?>&nbsp;ต.&nbsp;<?php echo $arr['member_p']['district']; ?>&nbsp;อ.&nbsp;<?php echo $arr['member_p']['amphur']; ?>&nbsp;จ.&nbsp;<?php echo $arr['member_p']['province']; ?>&nbsp;รหัสไปรษณีย์&nbsp;<?php echo $arr['member_p']['zipcode']; ?></td>
    <td></td>
  </tr>
  <tr>
    <td height="5" colspan="4"></td>
  </tr>
	<tr height="1">
		<td height="1" class="dotline" colspan="4">
		</td>
	</tr> 
  <tr>
    <td height="10" colspan="4"></td>
  </tr>	
</table>
<?php 
}
$res['section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." WHERE parties_id='4' ORDER BY section_id ");
?>
<form NAME="sec_form" id="sec_form" METHOD="post">
<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
<tr bgcolor="#eee">
        <td width="350" height="35" align="right"><b>เลือกหน่วบงาน :</b>
		</td>
		<td>&nbsp;&nbsp;&nbsp;
          <select name="section_id" id="section_id" onChange="dochange(this.value);">
		  <option value="" selected>เลือก</option>
		  <?php while($arr['section'] = $db->fetch($res['section'])) {
					if($data==$arr['section']['section_id']){
						$selected="selected";					
					} else {
						$selected="";
					}	
		  ?>
		  <option value="<?php echo $arr['section']['section_id']; ?>"<?php echo " ".$selected ;?> ><?php echo $arr['section']['section_name']; ?></option>
		  <?php } ?>
		  </select>    
        </td>
</tr>	
	<tr height="1">
		<td height="1" class="dotline" colspan="2">
		</td>
	</tr> 	  
</table>
</form>
<br>	
<?php
   if($data <> "") {

		$res['member_p'] = $db->select_query("SELECT member_id, prefix, fname, lname, address, district, amphur, province, zipcode, mobile, position_id, degree_id, member_pic FROM ".TB_MEMBER." WHERE section_id='".$data."' ORDER BY degree_id DESC ");
		while($arr['member_p'] = $db->fetch($res['member_p'])) { 
		$res['position'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id='".$arr['member_p']['position_id']."'");
		$arr['position'] = $db->fetch($res['position']);
        $res['degree'] = $db->select_query("SELECT degree_name FROM ".TB_MEMBER_DEGREE." WHERE degree_id='".$arr['member_p']['degree_id']."'");
		$arr['degree'] = $db->fetch($res['degree']);		
?>
<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td height="5" colspan="4"></td>
  </tr>
  <tr>
    <td width="250" height="105" rowspan="3" align="center">
	<?php if($arr['member_p']['member_pic'] == "") {?>
	<img src="images/personnel/admin.png" height="105" align="baseline" />
	<?php } else {?>
	<img src="images/personnel/thb_<?php echo $arr['member_p']['member_pic']; ?>" height="105" align="baseline" />
	<?php } ?>
	</td>
    <td width="100" height="35" align="right">ชื่อ-สกุล :</td>
    <td width="540">&nbsp;&nbsp;&nbsp;<?php echo $arr['member_p']['prefix']; ?><?php echo $arr['member_p']['fname']; ?>&nbsp;&nbsp;&nbsp;<?php echo $arr['member_p']['lname']; ?></td>
    <td></td>
  </tr>
  <tr>
    <td height="35" align="right">ตำแหน่ง :</td>
    <td>&nbsp;&nbsp;&nbsp;<?php echo $arr['position']['position_name'].$arr['degree']['degree_name'] ; ?></td>
    <td></td>
  </tr>
  <tr>
    <td height="35" align="right">เบอร์ติดต่อ :</td>
    <td>&nbsp;&nbsp;&nbsp;<?php echo $arr['member_p']['mobile']; ?></td>
    <td></td>
  </tr>
  <tr>
    <td height="35" align="center"></td>
    <td align="right">ที่อยู่ :</td>
    <td>&nbsp;&nbsp;&nbsp;<?php echo $arr['member_p']['address']; ?>&nbsp;ต.&nbsp;<?php echo $arr['member_p']['district']; ?>&nbsp;อ.&nbsp;<?php echo $arr['member_p']['amphur']; ?>&nbsp;จ.&nbsp;<?php echo $arr['member_p']['province']; ?>&nbsp;รหัสไปรษณีย์&nbsp;<?php echo $arr['member_p']['zipcode']; ?></td>
    <td></td>
  </tr>
  <tr>
    <td height="5" colspan="4"></td>
  </tr>
	<tr height="1">
		<td height="1" class="dotline" colspan="4">
		</td>
	</tr> 
  <tr>
    <td height="10" colspan="4"></td>
  </tr>	
</table>

   

<?php
}
} 
} else {
?>
<table width="670" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td><h4><br>&nbsp;&nbsp;ระบบงาน  (<font color="#FF0033"><?php echo $name ; ?></font>) </h4></td>
</tr>
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<TR>
<TD height="1" class="dotline"></TD>
</TR>
<tr>
<td> </td>
</tr>
<tr>
<td><div align="center">
<p>&nbsp;</p>
<p><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><b>ขออภัยครับ</b></font> </p>
<p><img src="images/notview.gif" width="50" height="82"></p>
</div>
<p align="center"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><b>ในส่วนระบบ<font color="#FF0033"><?php echo $name  ?></font>รอก่อนกำลังพัฒนาระบบอื่นอยู่ </font>
<p align="center"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><b>โปรดรอคอยต่อไป.......</font>
<p align="center">

<p align="center"></td>
</tr>
</table></td>
</tr>
</table>
<?php } ?>