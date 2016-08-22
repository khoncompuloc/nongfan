<?php
Check_passadu($admin_user,$admin_level);
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
					<TD>
<?php  
if(!$ProcessOutput AND $op == "material_acc_deega" AND $action == "add" AND $data != "") {
	                    $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
						
						$res['stock_requistion_center'] = $db->select_query("SELECT src_id ,src_number ,src_date ,section_id FROM ".TB_STOCK_REQUISTION_CENTER." WHERE src_number='".$_POST['src_number']."'");
	                    $arr['stock_requistion_center'] = $db->fetch($res['stock_requistion_center']);
	
						$res['stock_center'] = $db->select_query("SELECT sc_id FROM ".TB_STOCK_CENTER." WHERE sc_date='".$arr['stock_requistion_center']['src_date']."' AND sc_logic='1' AND sc_requistion='1' AND src_number='".$arr['stock_requistion_center']['src_number']."' ORDER BY sc_id");
					    while($arr['stock_center'] = $db->fetch($res['stock_center'])){
							
							$db->update_db(TB_STOCK_CENTER,array(
				            "sc_deega"=>"".$_POST['sc_deega'].""
				            )," sc_id='".$arr['stock_center']['sc_id']."'");
						}	
						
						$res['stock_section'] = $db->select_query("SELECT ss_id FROM ".TB_STOCK_SECTION." WHERE ss_date='".$arr['stock_requistion_center']['src_date']."' AND ss_logic='1' AND section_id='".$arr['stock_requistion_center']['section_id']."' AND src_number='".$arr['stock_requistion_center']['src_number']."' ORDER BY ss_id");
					    while($arr['stock_section'] = $db->fetch($res['stock_section'])){
							
							$db->update_db(TB_STOCK_SECTION,array(
				            "ss_note"=>"".$_POST['sc_deega'].""
				            )," ss_id='".$arr['stock_section']['ss_id']."'");
						}						
                        $src_logic = 3 ;
						$db->update_db(TB_STOCK_REQUISTION_CENTER,array(
				        "src_requistion_logic"=>"".$src_logic.""
				        )," src_id='".$arr['stock_requistion_center']['src_id']."'");
						
						echo "<script type='text/javascript'>window.location.href = \"index.php?compu=wsd&loc=material_requistion_print\";</script>" ;				
  
} else	if(!$ProcessOutput AND $op == "") {
	                
	                $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					$res['stock_requistion_center'] = $db->select_query("SELECT * ,UNIX_TIMESTAMP(src_date) AS srcdate FROM ".TB_STOCK_REQUISTION_CENTER." WHERE src_number=$data");
	                $arr['stock_requistion_center'] = $db->fetch($res['stock_requistion_center']);
					$res['member_section'] = $db->select_query("SELECT section_name FROM ".TB_MEMBER_SECTION." WHERE section_id='".$arr['stock_requistion_center']['section_id']."'");
					$arr['member_section'] = $db->fetch($res['member_section']);
					//$res['member'] = $db->select_query("SELECT prefix ,fname ,lname FROM ".TB_MEMBER." WHERE member_id='".$arr['stock_requistion_center']['member_id']."'");
					//$arr['member'] = $db->fetch($res['member']);						
					//$res['member_section'] = $db->select_query("SELECT section_name FROM ".TB_MEMBER_SECTION." WHERE section_id='".$arr['stock_requistion_center']['section_id']."'");
					//$arr['member_section'] = $db->fetch($res['member_section']);
					
				         $count_str=mb_strlen($arr['member_section']['section_name']);
				         if($count_str > 12){
					        $arr_p['name']= mb_substr($arr['member_section']['section_name'],0,12,"utf-8")."..."; 
				            }else{
					        $arr_p['name']=$arr['member_section']['section_name'];
				            }					
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="100%" align="center" colspan="3"><h2>บันทึกเลขที่ฎีกา<h2></td>
</tr>
<tr>
    <td height="10" colspan="3"></td>
</tr>	
<tr>
    <td width="4%" height="30"></td>
    <td width="10%" align="right">เลขที่เอกสาร :</td>
    <td width="35%" align="left">&nbsp;&nbsp;&nbsp;<input type="text" value="<?php echo $arr['stock_requistion_center']['src_number']." /25".WEB_BUDGET ;?>" size="5"></td>	    
   
</tr>
<tr>
    <td width="4%" height="30"></td>
    <td width="10%" align="right">วัน เดือน ปี :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
	<input  type="text" size="12" value="<?php echo ThaiTimeConvert($arr['stock_requistion_center']['srcdate'],"","");?>"></td>	
</tr>
<tr>
    <td width="4%" height="30"></td>
    <td width="10%" align="right">หน่วยงาน :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
    <input  type="text" value="<?php echo $arr_p['name'] ;?>">
	</td>
</tr>
<tr>
    <td width="4%" height="30"></td>
    <td width="10%" align="right">ประเภทวัสดุ :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
<?php
						$res['stock_type'] = $db->select_query("SELECT type_name FROM ".TB_STOCK_TYPE." WHERE type_id='".$arr['stock_requistion_center']['type_id']."'");
						$arr['stock_type'] = $db->fetch($res['stock_type']) ;
?>
	<input  type="text" value="<?php echo $arr['stock_type']['type_name'] ;?>">
	</td>
</tr>
<tr>
    <td height="12" colspan="3"></td>
</tr>
<form method="post" name="frm" id="frm" action="?compu=wsd&loc=material_acc_deega&op=material_acc_deega&action=add&data=voi"  enctype="multipart/form-data">    
<tr>
    <td width="100%" align="center" colspan="3"><b>เลขที่ฎีกา :</b>&nbsp;<input  type="text" name="sc_deega" id="sc_deega" size="12" value="">&nbsp;&nbsp;
	<input type="submit" name="submit" id="submit" value="บันทึกเลขที่ฎีกาลงบัญชีวัสดุ">&nbsp;&nbsp;<font color="#ff0000">*ทุกรายการข้างล่าง</font>
	<input type="hidden" name="src_number" id="src_number" value="<?php echo $arr['stock_requistion_center']['src_number'] ;?>" size="5">
	</td>
</tr>
</form>
<tr>
</table><br>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=3%  valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>ที่</b></span></p>
  </td>
  <td width=38%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>ชื่อหรือชนิดวัสดุ  (ขนาดหรือลักษณะ)</b></span></p>
  </td>
  <td width=12%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
 <b>จำนวน (รับ-จ่าย)</b></span></p>
  </td>
  <td width=14% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>ราคาต่อหน่วย (บาท)</b></span></p>
  </td>
  <td width=33% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>บันทึกลงบัญชีวัสดุ (ส่วนกลาง : ส่วนงาน/กอง)</b></span></p>
  </td>  
</tr>
<script language="javascript" type="text/javascript">
function  print_acc_center_open(data) {
	window.open("modules/wsd/print_acc_center.php?shc_id="+data+"","","toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=999,height=830,left=5,top=5"); 
}	
function  print_acc_section_open(data) {
	window.open("modules/wsd/print_acc_section.php?shs_id="+data+"","","toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=999,height=830,left=5,top=5"); 
}
</script>
 
 <?php
                       $check_acc_center_ok = array() ;
					   $check_acc_section_ok = array() ;
					   $count_no = 1 ;
					   $res['stock_center'] = $db->select_query("SELECT sc_id ,shc_id ,sc_name ,sc_amount ,sc_price ,sc_acc_logic ,shp_diff_name FROM ".TB_STOCK_CENTER." WHERE sc_logic='1' AND sc_requistion='1' AND src_number='".$data."' ORDER BY sc_date");
					   while($arr['stock_center'] = $db->fetch($res['stock_center'])){
					   $res['stock_head_center'] = $db->select_query("SELECT shc_id ,sh_id FROM ".TB_STOCK_HEAD_CENTER." WHERE shc_id='".$arr['stock_center']['shc_id']."'");
					   $arr['stock_head_center'] = $db->fetch($res['stock_head_center']);
					   $res['stock_head'] = $db->select_query("SELECT sh_name ,sh_unit ,sh_diff_name FROM ".TB_STOCK_HEAD." WHERE sh_id='".$arr['stock_head_center']['sh_id']."'");
					   $arr['stock_head'] = $db->fetch($res['stock_head']);
					   //ส่วนงาน/กอง
                       $res['stock_head_section'] = $db->select_query("SELECT shs_id FROM ".TB_STOCK_HEAD_SECTION." WHERE section_id='".$arr['stock_requistion_center']['section_id']."' AND shc_id='".$arr['stock_head_center']['shc_id']."'");
					   $row['stock_head_section'] = $db->rows($res['stock_head_section']);
					   $arr['stock_head_section'] = $db->fetch($res['stock_head_section']);
                       if($row['stock_head_section']) {
                            //$res['stock_section'] = $db->select_query("SELECT shp_id FROM ".TB_STOCK_SECTION." WHERE shs_id='".$arr['stock_head_section']['shs_id']."' AND ss_acc_logic='1' AND src_number='".$arr['stock_requistion_center']['src_number']."'");
					        //$row['stock_section'] = $db->rows($res['stock_section']);
							//$arr['stock_section'] = $db->fetch($res['stock_section']);
							
							        $res['stock_price'] = $db->select_query("SELECT shp_id FROM ".TB_STOCK_HEAD_PRICE." WHERE shs_id='".$arr['stock_head_section']['shs_id']."' AND shp_price='".$arr['stock_center']['sc_price']."' AND shp_diff_name='".$arr['stock_center']['shp_diff_name']."' AND src_number='".$arr['stock_requistion_center']['src_number']."'");
					                $row['stock_price'] = $db->rows($res['stock_price']);
							
							if($row['stock_price'] or $arr['stock_requistion_center']['src_requistion_logic']=='2') {
								$acc_logic = true ;								
							} else {
								$acc_logic = false ;
							}
						   $shs_logic = true ;
					   } else {
						   $acc_logic = false ; 
						   $shs_logic = false ;
					   }	
					   
					   empty($arr['stock_head']['sh_diff_name'])?$sh_diff_name="":$sh_diff_name=" ".$arr['stock_head']['sh_diff_name']."" ;
					   empty($arr['stock_center']['shp_diff_name'])?$shp_diff_name="":$shp_diff_name=" (".$arr['stock_center']['shp_diff_name'].")" ;					   					   					   					   
?>
<script language="javascript" type="text/javascript">
function center_submit_<?php echo $count_no ; ?>() {
    //alert("<?php echo $count_no ; ?>");
    document.frm_report.method="post";
	document.frm_report.action="?compu=wsd&loc=material_requistion_print&op=material_acc_center_report&data=<?php echo $arr['stock_requistion_center']['src_number'];?>&sc_id=<?php echo $arr['stock_center']['sc_id'];?>";
	document.frm_report.submit();
}
function section_submit_<?php echo $count_no ; ?>() {
    //alert("<?php echo $count_no ; ?>");
    document.frm_report.method="post";
	document.frm_report.action="?compu=wsd&loc=material_requistion_print&op=material_acc_section_report&data=<?php echo $arr['stock_requistion_center']['src_number'];?>&sc_id=<?php echo $arr['stock_center']['sc_id'];?>";
	document.frm_report.submit();
}
</script>
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
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_head']['sh_name'] ;?><?php echo $sh_diff_name ;?><?php echo $shp_diff_name ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:14.05pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_center']['sc_amount']."  ".$arr['stock_head']['sh_unit'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:14.05pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_center']['sc_price'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:14.05pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>

<?php 
  if($arr['stock_center']['sc_acc_logic']==0) {
  echo "<input type=\"button\" value=\"ส่วนกลาง\" onClick=\"center_submit_".$count_no."();\">&nbsp;" ;
       $check_acc_center_ok[$count_no-1] = "NO" ;
  
  } else {
  echo "<input type=\"button\" value=\" เรียบร้อย  \">" ;	  
      $check_acc_center_ok[$count_no-1] = "YES" ;
  }
?> 
  <input type="button" onClick="print_acc_center_open(<?php echo $arr['stock_head_center']['shc_id'];?>)" value="...">&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;
<?php 
  if($acc_logic) {
  echo "<input type=\"button\" value=\" เรียบร้อย  \">&nbsp;" ;	
      $check_acc_section_ok[$count_no-1] = "YES" ;  
  } else {
  echo "<input type=\"button\" value=\"".$arr_p['name']."\" onClick=\"section_submit_".$count_no."();\">&nbsp;" ;
      $check_acc_section_ok[$count_no-1] = "NO" ;  
  }
  if($shs_logic) {
  echo "<input type=\"button\" onClick=\"print_acc_section_open(".$arr['stock_head_section']['shs_id'].")\" value=\"...\">" ;
  } else {
  echo "<input type=\"button\" onClick=\"#\" value=\".N.\">" ;	  
  }
?> 
  <input type="hidden" name="shc_id" id="shc_id" value="<?php echo $arr['stock_head_center']['shc_id'];?>" ></span></p>
  </td>  
</tr>
 <?php 
 $count_no ++ ;
 }
 ?>
<tr><td width="100%" height="30" colspan="5"></td></tr>
</table>
<?php
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