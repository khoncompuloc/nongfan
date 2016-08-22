<?php 
Check_boss($admin_user,$admin_level);
empty($ProcessOutput)?$ProcessOutput="":$ProcessOutput=$ProcessOutput ;
?>
<link href="modules/admin/css/style.css" rel="stylesheet" type="text/css">
<TABLE cellSpacing="0" cellPadding="0" width="950" border="0">
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="940" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/admin/texmenu_stock_start.gif" BORDER="0"><BR>
				<TABLE width="940" align="center" cellSpacing="0" cellPadding="0" border="0" >
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD><br>
<?php  
 
if(!$ProcessOutput AND $op == "stock_requistion_section_save" AND $data != "") {
	
	                $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

					$srs_logic = 2 ;
					
					$db->update_db(TB_STOCK_REQUISTION_SECTION,array(
					"srs_requistion_logic"=>"".$srs_logic.""
				    )," section_id='".$section_id."' and srs_number='".$data."'");

					echo "<script type='text/javascript'>window.location.href=\"index.php?compu=wsd&loc=material_requistion_section_print\";</script>" ;				
					
} else if(!$ProcessOutput AND $op == "stock_section_save" AND $data != "") {
	
	                $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
				
					$ss_logic = 1 ;
					$db->update_db(TB_STOCK_SECTION,array(
				    "ss_ref"=>"".$_POST['ss_ref']."",
					"ss_requistion"=>"".$ss_logic."",
					"ss_acc_logic"=>"".$ss_logic.""
				    )," ss_id='".$_POST['ss_id']."'");

					echo "<script type='text/javascript'>window.location.href=\"index.php?compu=wsd&loc=material_requistion_section_print&op=material_acc_report&data=".$data."\";</script>" ;				
					
} else	if(!$ProcessOutput AND $op == "material_acc_report" AND $data != ""){
	                //echo "section_id = ".$section_id ;
					//echo "<br>srs_number = ".$data ;
	                $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					$res['stock_requistion_section'] = $db->select_query("SELECT * ,UNIX_TIMESTAMP(srs_date) AS srsdate FROM ".TB_STOCK_REQUISTION_SECTION." WHERE section_id='".$section_id."' AND srs_number='".$data."'");
	                $arr['stock_requistion_section'] = $db->fetch($res['stock_requistion_section']);
					$res['member_section'] = $db->select_query("SELECT section_name FROM ".TB_MEMBER_SECTION." WHERE section_id='".$arr['stock_requistion_section']['section_id']."'");
					$arr['member_section'] = $db->fetch($res['member_section']);
					$res['member'] = $db->select_query("SELECT prefix ,fname ,lname FROM ".TB_MEMBER." WHERE member_id='".$arr['stock_requistion_section']['member_id']."'");
					$arr['member'] = $db->fetch($res['member']);						
					$res['member_section'] = $db->select_query("SELECT section_name FROM ".TB_MEMBER_SECTION." WHERE section_id='".$arr['stock_requistion_section']['section_id']."'");
					$arr['member_section'] = $db->fetch($res['member_section']);
					
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
 	<td width="11%" align="right" colspan="2">บัญชีวัสดุ  :</td>
	<td width="40%" align="left">&nbsp;&nbsp;&nbsp;<b><?php echo " ".$arr['member_section']['section_name'] ;?></b></td>
</tr>
<tr>
    <td height="10" colspan="3"></td>
</tr>	
<tr>
    <td width="1%" height="30"></td>
    <td width="10%" align="right">เลขที่เอกสาร :</td>
    <td width="40%" align="left">&nbsp;&nbsp;&nbsp;<input type="text" value="<?php echo $arr['stock_requistion_section']['srs_number']." /25".WEB_BUDGET ;?>" size="5"></td>	    
</tr>
<tr>
    <td width="1%" height="30"></td>
    <td width="10%" align="right">วัน เดือน ปี :</td>
    <td width="40%" align="left">&nbsp;&nbsp;
	<input name="tCalendar_1" type="text" id="tCalendar_1" size="12" value="<?php echo ThaiTimeConvert($arr['stock_requistion_section']['srsdate'],"","");?>">
	</td>    
</tr>
<tr>
    <td width="1%" height="30"></td>
    <td width="10%" align="right">หน่วยงาน :</td>
    <td width="40%" align="left">&nbsp;&nbsp;
    <input  type="text" value="<?php echo $arr['member_section']['section_name'] ;?>">
	</td>	
</tr>
<tr>
    <td width="1%" height="30"></td>
    <td width="10%" align="right">จ่ายให้ :</td>
    <td width="40%" align="left">&nbsp;&nbsp;
    <input  type="text" value="<?php echo $arr['member']['prefix'].$arr['member']['fname']." ".$arr['member']['lname'] ;?>">
	</td>	
</tr>
<?php
						$res['stock_type'] = $db->select_query("SELECT type_name FROM ".TB_STOCK_TYPE." WHERE type_id='".$arr['stock_requistion_section']['type_id']."'");
						$arr['stock_type'] = $db->fetch($res['stock_type']) ;
?>
<tr>
    <td width="1%" height="30"></td>
    <td width="10%" align="right">ประเภทวัสดุ :</td>
    <td width="40%" align="left">&nbsp;&nbsp;
	<input  type="text" value="<?php echo $arr['stock_type']['type_name'] ;?>">
	</td>	
</tr>
<tr>
    <td height="10" colspan="6"></td>
</tr>
</table><br>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=3%  valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ที่</span></p>
  </td>
  <td width=40%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>
  <span lang=TH  style='font-size:11.0pt;font-family:"TH SarabunPSK","sans-serif"'>(ss)</span>
  <span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>ชื่อหรือชนิดวัสดุ  (ขนาดหรือลักษณะ)</span></p>
  </td>
  <td width=12%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
 จำนวน (รับ-จ่าย)</span></p>
  </td>
  <td width=14% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ราคาต่อหน่วย (บาท)</span></p>
  </td>
  <td width=31% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  นำเข้าบัญชีวัสดุ (ส่วนงาน/กอง)</span></p>
  </td>  
</tr>
<script language="javascript" type="text/javascript">
function  print_acc_section_open(data) {
	window.open("modules/wsd/print_acc_section.php?shs_id="+data+"","","toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=999,height=830,left=5,top=5"); 
}
</script>
 <?php
 					   $check_requistion_section_ok = array() ;                      
					   $count_no = 1 ;
					   $res['stock_section'] = $db->select_query("SELECT ss_id ,shs_id ,ss_name ,ss_amount ,ss_price ,ss_requistion FROM ".TB_STOCK_SECTION." WHERE section_id='".$section_id."' AND srs_number='".$data."' ORDER BY ss_date");
					   while($arr['stock_section'] = $db->fetch($res['stock_section'])){
					   $res['stock_head_section'] = $db->select_query("SELECT shs_id ,sh_id FROM ".TB_STOCK_HEAD_SECTION." WHERE shs_id='".$arr['stock_section']['shs_id']."'");
					   $arr['stock_head_section'] = $db->fetch($res['stock_head_section']);
					   $res['stock_head'] = $db->select_query("SELECT sh_name ,sh_unit FROM ".TB_STOCK_HEAD." WHERE sh_id='".$arr['stock_head_section']['sh_id']."'");
					   $arr['stock_head'] = $db->fetch($res['stock_head']);
 ?>
  <tr style='mso-yfti-irow:2;height:14.05pt'>
  <td valign=top style='border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:14.05pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $count_no ; ?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:14.05pt'>
  <p class=MsoNormal>
  <span lang=TH style='font-size:10.0pt;font-family:"TH SarabunPSK"'><?php echo "(".$arr['stock_section']['ss_id'].") " ;?></span>
  <span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'><?php echo $arr['stock_head']['sh_name'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:14.05pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_section']['ss_amount']."  ".$arr['stock_head']['sh_unit'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:14.05pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_section']['ss_price'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:14.05pt'>
  <form name="frm_report_<?php echo $count_no ; ?>" id="frm_report_<?php echo $count_no ; ?>" method="post" action="?compu=wsd&loc=material_requistion_section_print&op=stock_section_save&data=<?php echo $arr['stock_requistion_section']['srs_number'] ;?>"  enctype="multipart/form-data">
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
<?php 
  if($arr['stock_section']['ss_requistion']==0) {
  echo "<input type=\"submit\" name=\"submit\" id=\"submit\" value=\"บันทึกบัญชีเบิก\">&nbsp;&nbsp;" ;
    $check_requistion_section_ok[$count_no-1] = "NO" ;
  } else {
  echo "<input type=\"button\" value=\" เรียบร้อย  \">&nbsp;&nbsp;" ;
    $check_requistion_section_ok[$count_no-1] = "YES" ;  
  }
?>  
  <input type="button" onClick="print_acc_section_open(<?php echo $arr['stock_head_section']['shs_id'];?>)" value="..."></span></p>
  <input type="hidden" name="ss_id" id="ss_id" value="<?php echo $arr['stock_section']['ss_id']; ?>">
  <input type="hidden" name="ss_ref" id="ss_ref" value="<?php echo $arr['stock_requistion_section']['srs_number']." /25".WEB_BUDGET ;?>">
  </form> 
  </td>  
</tr>
 <?php 
 $count_no ++ ;
 }
 ?>
 <tr>
    <td height="20" colspan="5"></td>
</tr>
<?php if(!($arr['stock_requistion_section']['srs_requistion_logic']=='2') and !in_array("NO",$check_requistion_section_ok)) {
        echo "<tr><td width=\"100%\" height=\"45\" colspan=\"5\" align=\"center\"><input type=\"button\" onclick=\"window.location.href='?compu=wsd&loc=material_requistion_section_print&op=stock_requistion_section_save&data=".$arr['stock_requistion_section']['srs_number']."'\" value=\"บันทึกลงบัญชีวัสดุเรียบร้อยทั้งหมด\"></td></tr>" ;
        }
?>
<tr><td width="100%" height="30" colspan="5"></td></tr>
</table>
<?php					
} else	if(!$ProcessOutput AND $op == "") {
	                $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					$res['stock_requistion_section'] = $db->select_query("SELECT * ,UNIX_TIMESTAMP(srs_date) AS srsdate FROM ".TB_STOCK_REQUISTION_SECTION." WHERE section_id='".$section_id."' ORDER BY srs_number");
?>
<SCRIPT LANGUAGE="javascript">

</SCRIPT>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes' bgcolor='#eeeeee'>
  <td width=10%  valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
 ใบเบิกที่</span></p>
  </td>
  <td width=12% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  วัน เดือน ปี</span></p>
  </td>
  <td width=20%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ประเภทวัสดุ</span></p>
  </td>
  <td width=24%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ส่วนงาน/กอง</span></p>
  </td>
  <td width=20% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ผู้เบิก</span></p>
  </td>
<!--  
  <td width=18% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ผู้อนุมัติ</span></p>
  </td>
-->  
  <td width=15% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  เลือก</span></p>
  </td>
</tr>
 <?php
                       $count_no = 1 ;
 					   while($arr['stock_requistion_section'] = $db->fetch($res['stock_requistion_section'])){
					   $res['stock_type'] = $db->select_query("SELECT type_name FROM ".TB_STOCK_TYPE." WHERE type_id='".$arr['stock_requistion_section']['type_id']."'");
					   $arr['stock_type'] = $db->fetch($res['stock_type']);
					   $res['member_section'] = $db->select_query("SELECT section_name FROM ".TB_MEMBER_SECTION." WHERE section_id='".$arr['stock_requistion_section']['section_id']."'");
					   $arr['member_section'] = $db->fetch($res['member_section']);
					   $res['member'] = $db->select_query("SELECT prefix ,fname ,lname FROM ".TB_MEMBER." WHERE member_id='".$arr['stock_requistion_section']['member_id']."'");
					   $arr['member'] = $db->fetch($res['member']);
					   //$res['boss'] = $db->select_query("SELECT prefix ,fname ,lname FROM ".TB_MEMBER." WHERE member_id='".$arr['stock_requistion_section']['boss_id']."'");
					   //$arr['boss'] = $db->fetch($res['boss']);
					   $res['requistion'] = $db->select_query("SELECT COUNT(ss_id) AS number FROM ".TB_STOCK_SECTION." WHERE section_id=$section_id AND srs_number='".$arr['stock_requistion_section']['srs_number']."'");
					   $arr['requistion'] = $db->fetch($res['requistion']);
 ?>
 <tr style='mso-yfti-irow:2;height:17.35pt' onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#FFFFFF' ">
  <td valign=top style='border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo "<b>".$arr['stock_requistion_section']['srs_number']."</b> /<b>25".WEB_BUDGET."</b>" ; ?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo ThaiTimeConvert($arr['stock_requistion_section']['srsdate'],"","") ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_type']['type_name']." (<b>".$arr['requistion']['number']."</b>)" ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['member_section']['section_name'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['member']['prefix'].$arr['member']['fname']." ".$arr['member']['lname'] ;?></span></p>
  </td>
<!--  
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php //echo $arr['boss']['prefix'].$arr['boss']['fname']." ".$arr['boss']['lname'] ;?></span></p>
  </td>
-->  
<?php
if($arr['stock_requistion_section']['srs_requistion_logic']=='0'){
?>  
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <form name="frm_report" id="frm_report" method="post" action="?compu=wsd&loc=requistion_section_print&data=<?php echo $arr['stock_requistion_section']['srs_number'];?>"  enctype="multipart/form-data">
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <input type="submit" name="submit" id="submit" value=" พิมพ์ใบเบิก "></span></p>
  </form>
<!--  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <input type="button" name="button" id="button" value="ลงบัญชีวัสดุ" disabled></span></p>  -->
  </td>
<?php
} else if($arr['stock_requistion_section']['srs_requistion_logic']=='1'){
?>  
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
<!--  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <input type="button" name="button" id="button" value="พิมพ์เรียบร้อย" disabled></span></p>  -->
  <form name="frm_report" id="frm_report" method="post" action="?compu=wsd&loc=material_requistion_section_print&op=material_acc_report&data=<?php echo $arr['stock_requistion_section']['srs_number'];?>"  enctype="multipart/form-data">
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <input type="submit" name="submit" id="submit" value=" ลงบัญชีวัสดุ "></span></p>
  </form>  
  </td> 
<?php
} else if($arr['stock_requistion_section']['srs_requistion_logic']=='2'){
?>
<form name="frm_<?php echo $count_no ;?>" id="frm_<?php echo $count_no ;?>">
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=left style='text-align:left'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <input type="button" name="button" id="button" onclick="window.location.href='?compu=wsd&loc=requistion_section_print&data=<?php echo $arr['stock_requistion_section']['srs_number'];?>'" value="ใบเบิก">&nbsp;
  <input type="button" name="button" id="button" onclick="window.location.href='?compu=wsd&loc=material_requistion_section_print&op=material_acc_report&data=<?php echo $arr['stock_requistion_section']['srs_number'];?>'" value="บัญชีเบิก">
  </span></p>
  </td> 
</form>
<?php
}
?>  
</tr>
 <?php 
 $count_no ++ ;
 }
 ?>
<tr><td width="100%" height="30" colspan="7"></td></tr>
</table>
<?php
$db->closedb ();
} else if($ProcessOutput) {
	echo $ProcessOutput ;
}	
?>  
					</TD>
				</TR>
			</TABLE>
		</TD>
	  </TR>
</TABLE>