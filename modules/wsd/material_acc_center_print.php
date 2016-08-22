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
					<TD><br>
<?php  
 
if(!$ProcessOutput AND $op == "stock_requistion_center_save" AND $data != "") {
	
	                //$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

					//$srs_logic = 2 ;
					
					//$db->update_db(TB_STOCK_REQUISTION_SECTION,array(
					//"srs_requistion_logic"=>"".$srs_logic.""
				    //)," srs_number='".$data."'");

				   //	echo "<script type='text/javascript'>window.location.href=\"index.php?compu=wsd&loc=material_requistion_section_print\";</script>" ;				

					
} else	if(!$ProcessOutput AND $op == "") {
	    $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$count=0;
		
		$res['stock_head_center'] = $db->select_query("SELECT shc_id ,sh_id ,acc_number FROM ".TB_STOCK_HEAD_CENTER." ORDER BY acc_number ");
?>
<SCRIPT LANGUAGE="javascript">
function  print_acc_section_open(data) {
	window.open("modules/wsd/print_acc_center.php?shc_id="+data+"","","toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=999,height=830,left=5,top=5"); 
}
function  print_open(data)
   {
     window.open('modules/wsd/acc_center_print.php?shc_id='+data+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=10,height=20,left=200,top=50');
   }  
</SCRIPT>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=7%  valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
 วัสดุที่</span></p>
  </td>
  <td width=10% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  รหัสวัสดุ</span></p>
  </td>  
  <td width=37%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ชื่อหรือชนิดวัสดุ (ขนาดหรือลักษณะ)</span></p>
  </td>
  <td width=10%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  หน่วยนับ</span></p>
  </td>
  <td width=17% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ประเภทวัสดุ</span></p>
  </td>
  <td width=19% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  เลือก</span></p>
  </td>
</tr>
<?php
	    while($arr['stock_head_center'] = $db->fetch($res['stock_head_center'])) {

	    $res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE sh_id='".$arr['stock_head_center']['sh_id']."'"); 
		$arr['stock_head'] = $db->fetch($res['stock_head']);
		$res['stock_type'] = $db->select_query("SELECT * FROM ".TB_STOCK_TYPE." WHERE type_id='".$arr['stock_head']['type_id']."'");
	    $arr['stock_type'] = $db->fetch($res['stock_type']);

		empty($arr['stock_head']['sh_diff_name'])?$shp_diff_name="":$shp_diff_name=" (".$arr['stock_head']['sh_diff_name'].")";	
		
		if($count%2==0) { //ส่วนของการ สลับสี 
           $ColorFill = "#F5F5F5";
        } else {
          $ColorFill = "#F0F0F0";
        }
?>		
<tr bgcolor="<?php echo $ColorFill; ?>" onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='<?php echo $ColorFill;?>'" style='mso-yfti-irow:2;height:17.35pt'>
  <td valign=top style='border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo "<b>".$arr['stock_head_center']['acc_number']."</b>" ; ?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_head']['sh_code_id'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'><b>
  <?php echo $arr['stock_head']['sh_name'].$shp_diff_name ;?></b></span></p>
  </td>
  <td valign=center style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_head']['sh_unit'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_type']['type_name'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <form name="frm_report" id="frm_report" method="post" action="?compu=wsd&loc=requistion_section_print&data=<?php //echo $arr['stock_requistion_section']['srs_number'];?>"  enctype="multipart/form-data">
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <input type="button" onClick="print_open(<?php echo $arr['stock_head_center']['shc_id'] ;?>)" value="พิมพ์บัญชีวัสดุกลาง">&nbsp;
  <input type="button" onClick="print_acc_section_open(<?php echo $arr['stock_head_center']['shc_id'];?>)" value="...">
  </span></p>
  </form>
  </td>
</tr>
 <?php 
 $count++ ;
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