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
					<TD>
<?php
if(!$ProcessOutput AND $op == "requistion_print_add" AND $data != ""){
            $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD); 
			    $requistion = 1 ;
			    
				$db->update_db(TB_STOCK_REQUISTION_CENTER,array(
				"src_requistion_logic"=>"".$requistion.""
				)," src_number='".$data."'");
				
				$db->update_db(TB_STOCK_CENTER,array(
				"sc_requistion"=>"".$requistion.""
				)," src_number='".$data."' and sc_requistion='0' and sc_logic='1'");
				
			//$db->closedb ();
			$ProcessOutput  = "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"#\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการบันทึก  ใบเบิกที่ : ".$data." เป็นที่เรียบร้อย</B></FONT><BR><BR>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
			echo $ProcessOutput ;
            echo "<script type='text/javascript'>window.location.href = \"index.php?compu=wsd&loc=material_requistion_print\";</script>" ;	

?>	
<?php					
} else	if(!$ProcessOutput AND $op == "" AND $data != "") {
	                $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					$res['stock_requistion_center'] = $db->select_query("SELECT * ,UNIX_TIMESTAMP(src_date) AS srcdate FROM ".TB_STOCK_REQUISTION_CENTER." WHERE  src_number=$data ");
					$arr['stock_requistion_center'] = $db->fetch($res['stock_requistion_center']);
					$res['member'] = $db->select_query("SELECT prefix ,fname ,lname ,position_id ,degree_id FROM ".TB_MEMBER." WHERE member_id='".$arr['stock_requistion_center']['member_id']."'");
					$arr['member'] = $db->fetch($res['member']);
					$res['member_boss'] = $db->select_query("SELECT prefix ,fname ,lname ,position_id FROM ".TB_MEMBER." WHERE member_id='1' ");
					$arr['member_boss'] = $db->fetch($res['member_boss']);
                    $res['member_position'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id='".$arr['member']['position_id']."'");
					$arr['member_position'] = $db->fetch($res['member_position']);
                    $res['degree'] = $db->select_query("SELECT degree_name FROM ".TB_MEMBER_DEGREE." WHERE degree_id='".$arr['member']['degree_id']."'");
		            $arr['degree'] = $db->fetch($res['degree']);					
                    $res['stock_type'] = $db->select_query("SELECT type_name FROM ".TB_STOCK_TYPE." WHERE type_id='".$arr['stock_requistion_center']['type_id']."'");
					$arr['stock_type'] = $db->fetch($res['stock_type']) ;
                    $res['stock_center_count'] = $db->select_query("SELECT COUNT(sc_id) AS number FROM ".TB_STOCK_CENTER." WHERE src_number='".$arr['stock_requistion_center']['src_number']."' AND sc_logic='1'");
					$arr['stock_center_count'] = $db->fetch($res['stock_center_count']);
                    $res['admin_passadu'] = $db->select_query("SELECT member_id FROM ".TB_ADMIN." WHERE level='3' ");
					$arr['admin_passadu'] = $db->fetch($res['admin_passadu']);
                    $res['passadu'] = $db->select_query("SELECT prefix ,fname ,lname ,position_id FROM ".TB_MEMBER." WHERE member_id='".$arr['admin_passadu']['member_id']."' ");
					$arr['passadu'] = $db->fetch($res['passadu']);	
                    $res['admin_head'] = $db->select_query("SELECT elect ,position_id_elect FROM ".TB_ADMIN." WHERE section_id=".$arr['stock_requistion_center']['section_id']."");
					$arr['admin_head'] = $db->fetch($res['admin_head']);					
					
		            if(WEB_AGEN_MINI == "อบต.") {
		              $agenname = "นายกองค์การบริหารส่วนตำบล".WEB_AGEN_NAME ;
		            } else if(WEB_AGEN_MINI == "ทต.") {
		              $agenname = "นายกเทศมนตรีตำบล".WEB_AGEN_NAME ;
		            }

					if($arr['admin_head']['elect'] == '1') {
                            $res['head_position'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id='".$arr['admin_head']['position_id_elect']."'");
					        $arr['head_position'] = $db->fetch($res['head_position']);						
							$elect_name = "ปฏิบัติหน้าที่&nbsp;<b>".$arr['head_position']['position_name']."</b>" ;
					} else if($arr['admin_head']['elect'] == '2') {
                             $res['head_position'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id='".$arr['admin_head']['position_id_elect']."'");
					        $arr['head_position'] = $db->fetch($res['head_position']);						
							$elect_name = "รักษาราชการแทน&nbsp;<b>".$arr['head_position']['position_name']."</b>" ;					
					} else {
					        $elect_name = "" ;
					}
					
					if($arr['stock_requistion_center']['src_requistion_logic']==1 or $arr['stock_requistion_center']['src_requistion_logic']==2){
						$check_requistion = false ;
					} else {
                        $check_requistion = true ;
					}
?>                      
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:"Cordia New";
	panose-1:2 11 3 4 2 2 2 2 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-2130706429 0 0 0 65537 0;}
@font-face
	{font-family:"Cambria Math";
	panose-1:0 0 0 0 0 0 0 0 0 0;
	mso-font-charset:1;
	mso-generic-font-family:roman;
	mso-font-format:other;
	mso-font-pitch:variable;
	mso-font-signature:0 0 0 0 0 0;}
@font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-520092929 1073786111 9 0 415 0;}
@font-face
	{font-family:"TH SarabunPSK";
	panose-1:2 11 5 0 4 2 0 2 0 3;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-1593835409 1342185562 0 0 65923 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:10.0pt;
	margin-left:0cm;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Calibri","sans-serif";
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-fareast-font-family:Calibri;
	mso-fareast-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Cordia New";
	mso-bidi-theme-font:minor-bidi;}
.MsoChpDefault
	{mso-style-type:export-only;
	mso-default-props:yes;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-fareast-font-family:Calibri;
	mso-fareast-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Cordia New";
	mso-bidi-theme-font:minor-bidi;}
.MsoPapDefault
	{mso-style-type:export-only;
	margin-bottom:10.0pt;
	line-height:115%;}
@page Section1
	{size:595.3pt 841.9pt;
	margin:21.3pt 14.1pt 7.1pt 35.45pt;
	mso-header-margin:35.4pt;
	mso-footer-margin:35.4pt;
	mso-paper-source:0;}
div.Section1
	{page:Section1;}
-->
</style>
<!--[if gte mso 10]>
<style>
 /* Style Definitions */
 table.MsoNormalTable
	{mso-style-name:ตารางปกติ;
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-qformat:yes;
	mso-style-parent:"";
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-para-margin-top:0cm;
	mso-para-margin-right:0cm;
	mso-para-margin-bottom:10.0pt;
	mso-para-margin-left:0cm;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Calibri","sans-serif";
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Cordia New";
	mso-bidi-theme-font:minor-bidi;}
table.MsoTableGrid
	{mso-style-name:เส้นตาราง;
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-priority:59;
	mso-style-unhide:no;
	border:solid windowtext 1.0pt;
	mso-border-alt:solid windowtext .5pt;
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-border-insideh:.5pt solid windowtext;
	mso-border-insidev:.5pt solid windowtext;
	mso-para-margin:0cm;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Calibri","sans-serif";
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Cordia New";
	mso-bidi-theme-font:minor-bidi;}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="1026"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="1"/>
 </o:shapelayout></xml><![endif]-->
<script language="javascript" type="text/javascript">
function  print_open(src_number)
   {
     window.open('modules/wsd/check_requistion_center_print.php?src_number='+src_number+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=10,height=20,left=200,top=50');
   }  
</script>
<div class=Section1 align="center">
<p>
<input type="button" name="submit1" id="submit1" onClick="print_open(<?php echo $arr['stock_requistion_center']['src_number'] ;?>)" value=" พิมพ์ใบเบิก ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php if($check_requistion) { ?>
<input type="button" name="submit2" id="submit2" value=" พิมพ์ใบเบิกเรียบร้อยแล้ว " onclick="window.location.href='?compu=wsd&loc=requistion_center_print&op=requistion_print_add&data=<?php echo $arr['stock_requistion_center']['src_number']; ?>'">
<?php } ?>
</p>
<TABLE width="940" align="center" cellSpacing="0" cellPadding="0" border="0" >
<TR>
<TD height="1" class="dotline"></TD>
</TR></TABLE>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-yfti-tbllook:1184;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:none;mso-border-insidev:none'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=733 colspan=2 valign=top style='width:549.45pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span lang=TH style='font-size:20.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>ใบเบิกจ่ายวัสดุ</span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:17.4pt'>
  <td width=442 valign=top style='width:331.45pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:17.4pt'>
  <p class=MsoNormal  style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'>ที่&nbsp;
  <b><?php echo $arr['stock_requistion_center']['src_number']." ";?></b>/<b>25<?php echo WEB_BUDGET ;?></b></span></p>
  </td>
  <td width=291 valign=top style='width:218.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:17.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><b><span lang=TH  style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'><?php echo WEB_AGEN_FULL.WEB_AGEN_NAME ; ?></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=442 valign=top style='width:331.45pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal  style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'></p>
  </td>
  <td width=291 valign=top style='width:218.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=right   style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>อำเภอ <b><?php echo WEB_AMPHUR ; ?>&nbsp;&nbsp;</b>จังหวัด <b><?php echo WEB_PROVINCE ; ?></b></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3;mso-yfti-lastrow:yes'>
  <td width=442 valign=top style='width:331.45pt;padding:0cm 5.4pt 0cm 5.4pt'><a
  name="_GoBack"></a>
  <p class=MsoNormal  style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'></span></b></p>
  </td>
  <td width=291 valign=top style='width:218.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>หน่วยงาน&nbsp;&nbsp;<b><?php echo WEB_AGEN_MINI.WEB_AGEN_NAME ; ?></b></span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center  style='text-align:center'><span
style='font-size:1.0pt;line-height:115%;font-family:"TH SarabunPSK","sans-serif"'></span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-yfti-tbllook:1184;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:none;mso-border-insidev:none'>
<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
<td width=366 valign=top  style='width:274.75pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'></span></p>
</td>
  <td width=369 valign=top style='width:276.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal  style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:normal'>
  <span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'>วันที่ <b><?php echo "&nbsp;&nbsp;&nbsp;".ThaiTimeConvert($arr['stock_requistion_center']['srcdate'],"3","") ;?></b></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:1.0pt;line-height:100%;font-family:"TH SarabunPSK","sans-serif"'></span></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-yfti-tbllook:1184;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:none;mso-border-insidev:none'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=800 valign=top style='padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'>เรียน<span
  style='mso-spacerun:yes'>&nbsp;&nbsp; </span><b><?php echo $agenname ; ?></b></span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:1.0pt;line-height:100%;font-family:"TH SarabunPSK","sans-serif"'></span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-yfti-tbllook:1184;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:none;mso-border-insidev:none'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=130 colspan=3 valign=top style='width:97.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>ด้วยข้าพเจ้า</span><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=236 colspan=3 valign=top style='width:177.2pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal  style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:normal'>
  <span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'>
  <b><?php echo $arr['member']['prefix'].$arr['member']['fname']."&nbsp;&nbsp;&nbsp;".$arr['member']['lname'] ;?></b></span></p>
  </td>
  <td width=66 valign=top style='width:49.6pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=right  style='margin-bottom:0cm;margin-bottom:.0001pt;text-align:right;line-height:normal'>
  <span lang=TH  style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'>ตำแหน่ง</span></p>
  </td>
  <td width=302 colspan=2 valign=top style='width:8.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal   style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'>
  <b><?php echo $arr['member_position']['position_name'].$arr['degree']['degree_name'] ;?></b></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=347 colspan=5 valign=top style='width:260.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal  style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'>สังกัด&nbsp;&nbsp;&nbsp;
  <b><?php echo WEB_AGEN_FULL.WEB_AGEN_NAME ; ?></b></span></p>
  </td>
  <td width=183 colspan=3 valign=top style='width:136.95pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal  style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'>มีความประสงค์จะขอเบิก</span></p>
  </td>
  <td width=205 valign=top style='width:153.65pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:normal'>
  <span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'>
  <b><?php echo $arr['stock_type']['type_name'] ;?></b></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes'>
  <td width=54 valign=top style='width:40.85pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'>จำนวน</span></p>
  </td>
  <td width=47 valign=top style='width:35.45pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center  style='margin-bottom:0cm;margin-bottom:.0001pt;text-align:center;line-height:normal'>
  <span style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'><b><?php echo $arr['stock_center_count']['number'] ;?></b></span></p>
  </td>
  <td width=94 colspan=2 valign=top style='width:70.85pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'>รายการ</span></p>
  </td>
  <td width=539 colspan=5 valign=top style='width:404.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'>เพื่อดำเนินการใช้ในการปฏิบัติงาน&nbsp;ดังนี้</span></p>
  </td>
 </tr>
 <![if !supportMisalignedColumns]>
 <tr height=0>
  <td width=54 style='border:none'></td>
  <td width=47 style='border:none'></td>
  <td width=28 style='border:none'></td>
  <td width=66 style='border:none'></td>
  <td width=151 style='border:none'></td>
  <td width=19 style='border:none'></td>
  <td width=66 style='border:none'></td>
  <td width=98 style='border:none'></td>
  <td width=205 style='border:none'></td>
 </tr>
 <![endif]>
</table>
<p class=MsoNormal align=center  style='text-align:center'>
<span style='font-size:1.0pt;line-height:115%;font-family:"TH SarabunPSK","sans-serif"'></span></p>
<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=64 rowspan=2 valign=top style='width:47.95pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center  style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:5.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH  style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>ลำดับที่</span></p>
  </td>
  <td width=378 rowspan=2 valign=top  style='width:10.0cm;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center  style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:5.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH  style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>รายการ</span></p>
  </td>
  <td width=151 colspan=2 valign=top style='width:4.0cm;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center  style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH  style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>จำนวน</span></p>
  </td>
  <td width=149 rowspan=2 valign=top  style='width:111.7pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center  style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:5.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH  style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>หมายเหตุ</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=76 valign=top style='width:2.0cm;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center  style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH  style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>ขอเบิก</span></p>
  </td>
  <td width=76 valign=top  style='width:2.0cm;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center  style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH  style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>เบิกได้</span></p>
  </td>
 </tr>
<?php
                       $count_no = 1 ;
					   $res['stock_center'] = $db->select_query("SELECT shc_id ,sc_name ,sc_amount ,sc_price ,sc_requistion ,shp_diff_name FROM ".TB_STOCK_CENTER." WHERE src_number='".$arr['stock_requistion_center']['src_number']."' AND sc_logic='1' ORDER BY shc_id");
					   while($arr['stock_center'] = $db->fetch($res['stock_center'])){
					   $res['stock_head_center'] = $db->select_query("SELECT shc_id ,sh_id FROM ".TB_STOCK_HEAD_CENTER." WHERE shc_id='".$arr['stock_center']['shc_id']."'");
					   $arr['stock_head_center'] = $db->fetch($res['stock_head_center']);
					   $res['stock_head'] = $db->select_query("SELECT sh_name ,sh_unit ,sh_diff_name FROM ".TB_STOCK_HEAD." WHERE sh_id='".$arr['stock_head_center']['sh_id']."'");
					   $arr['stock_head'] = $db->fetch($res['stock_head']);
					   
					   empty($arr['stock_head']['sh_diff_name'])?$sh_diff_name="":$sh_diff_name=" ".$arr['stock_head']['sh_diff_name']."" ;
					   empty($arr['stock_center']['shp_diff_name'])?$shp_diff_name="":$shp_diff_name=" (".$arr['stock_center']['shp_diff_name'].")" ;					   					   
?>
 <tr style='mso-yfti-irow:2'>
  <td width=64 valign=top style='width:47.95pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center  style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span lang=TH  style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'><?php echo $count_no ; ?></span></b><b></b></p>
  </td>
  <td width=378 valign=top style='width:10.0cm;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'><?php echo $arr['stock_head']['sh_name'] ;?><?php echo $sh_diff_name ;?><?php echo $shp_diff_name ;?></span></b></p>
  </td>
  <td width=76 valign=top  style='width:2.0cm;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>
  <?php echo $arr['stock_center']['sc_amount'] ;?></span></b></p>
  </td>
  <td width=76 valign=top  style='width:2.0cm;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center  style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></b></p>
  </td>
  <td width=149 valign=baseline  style='width:111.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span lang=TH style='font-size:10.0pt;font-family:"TH SarabunPSK","sans-serif"'><?php echo " ".$arr['stock_head']['sh_unit'];?></span></p>
  </td>
 </tr>
 <?php $count_no++ ; } ?>
 <tr style='mso-yfti-irow:6'>
  <td width=64 valign=top style='width:47.95pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH  style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
  <td width=378 valign=top  style='width:10.0cm;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal  style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'></span></b></p>
  </td>
  <td width=76 valign=top style='width:2.0cm;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=76 valign=top style='width:2.0cm;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=149 valign=top  style='width:111.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:1.0pt;line-height:115%;font-family:"TH SarabunPSK","sans-serif"'></span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-yfti-tbllook:1184;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:none;mso-border-insidev:none'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=64 valign=top style='width:47.95pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal  style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=678 valign=top style='width:508.6pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'>จึงเรียนมาเพื่อโปรดทราบและพิจารณาอนุมัติ</span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:2.0pt;line-height:115%;font-family:"TH SarabunPSK","sans-serif"'></span></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-yfti-tbllook:1184;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:none;mso-border-insidev:none'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=17 valign=top style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=340 valign=top style='width:9.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=57 valign=top style='width:42.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=302 valign=top style='width:8.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>ลงชื่อ..............................................................ผู้เบิก</span></p>
  </td>
  <td width=26 valign=top style='width:19.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=17 valign=top style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=340 valign=top style='width:9.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=57 valign=top style='width:42.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=302 valign=top style='width:8.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>
  <?php echo "(&nbsp;&nbsp;<b>".$arr['member']['prefix'].$arr['member']['fname']."&nbsp;&nbsp;&nbsp;".$arr['member']['lname']."</b>&nbsp;&nbsp;)" ;?></span></p>
  </td>
  <td width=26 valign=top style='width:19.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=17 valign=top style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=340 valign=top style='width:9.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center  style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>อนุญาตให้เบิกจ่ายได้</span></p>
  </td>
  <td width=57 valign=top style='width:42.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center  style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=302 valign=top style='width:8.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal  style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'>
  &nbsp;&nbsp;&nbsp;&nbsp;ตำแหน่ง&nbsp;&nbsp;&nbsp;<b><?php echo $arr['member_position']['position_name'].$arr['degree']['degree_name']  ;?></b>
  </span></p>
  </td>
  <td width=26 valign=top style='width:19.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3;height:12.15pt'>
  <td width=17 valign=top style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=340 valign=top style='width:9.0cm;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=57 valign=top style='width:42.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=302 valign=top style='width:8.0cm;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.15pt'>
  <p class=MsoNormal align=left style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:left;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $elect_name ; ?></span></p> <!--  รักษาราชการแทน  -->
  </td>
  <td width=26 valign=top style='width:19.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4;height:19.25pt'>
  <td width=17 valign=top style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:19.25pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=340 valign=top style='width:9.0cm;padding:0cm 5.4pt 0cm 5.4pt;
  height:19.25pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=57 valign=top style='width:42.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:19.25pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=302 valign=top style='width:8.0cm;padding:0cm 5.4pt 0cm 5.4pt;
  height:19.25pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=26 valign=top style='width:19.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:19.25pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5'>
  <td width=17 valign=top style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=340 valign=top style='width:9.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center  style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>ลงชื่อ..............................................................ผู้อนุมิติ</span></p>
  </td>
  <td width=57 valign=top style='width:42.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=302 valign=top style='width:8.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=26 valign=top style='width:19.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6'>
  <td width=17 valign=top style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=340 valign=top style='width:9.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center  style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>
  <?php echo "(&nbsp;&nbsp;<b>".$arr['member_boss']['prefix'].$arr['member_boss']['fname']."&nbsp;&nbsp;&nbsp;".$arr['member_boss']['lname']."</b>&nbsp;&nbsp;)" ;?></span></p>
  </td>
  <td width=57 valign=top style='width:42.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=302 valign=top style='width:8.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=26 valign=top style='width:19.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7'>
  <td width=17 valign=top style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=340 valign=top style='width:9.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH  style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'><b><?php echo $agenname ; ?></b></span></p>
  </td>
  <td width=57 valign=top style='width:42.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=302 valign=top style='width:8.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=26 valign=top style='width:19.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8'>
  <td width=17 valign=top style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=340 valign=top style='width:9.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=57 valign=top style='width:42.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=302 valign=top style='width:8.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=26 valign=top style='width:19.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9'>
  <td width=17 valign=top style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
  <td width=340 valign=top style='width:9.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
  <td width=57 valign=top style='width:42.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
  <td width=302 valign=top style='width:8.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
  <td width=26 valign=top style='width:19.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10'>
  <td width=17 valign=top style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=340 valign=top style='width:9.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>ได้ตรวจ, หัก<span
  style='mso-spacerun:yes'>&nbsp; </span>จำนวนแล้ว</span></p>
  </td>
  <td width=57 valign=top style='width:42.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=302 valign=top style='width:8.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>ได้รับของถูกต้องแล้ว</span></p>
  </td>
  <td width=26 valign=top style='width:19.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11;height:30.55pt'>
  <td width=17 valign=top style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:30.55pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=340 valign=top style='width:9.0cm;padding:0cm 5.4pt 0cm 5.4pt;
  height:30.55pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=57 valign=top style='width:42.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:30.55pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=302 valign=top style='width:8.0cm;padding:0cm 5.4pt 0cm 5.4pt;
  height:30.55pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=26 valign=top style='width:19.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:30.55pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12'>
  <td width=17 valign=top style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=340 valign=top style='width:9.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=57 valign=top style='width:42.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=302 valign=top style='width:8.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=26 valign=top style='width:19.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:13'>
  <td width=17 valign=top style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=340 valign=top style='width:9.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>ลงชื่อ........................................................เจ้าหน้าที่พัสดุ</span><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'><o:p></o:p></span></p>
  </td>
  <td width=57 valign=top style='width:42.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=302 valign=top style='width:8.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>ลงชื่อ.........................................................ผู้รับมอบ</span></p>
  </td>
  <td width=26 valign=top style='width:19.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:14'>
  <td width=17 valign=top style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=340 valign=top style='width:9.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>
  <?php echo "(&nbsp;&nbsp;<b>".$arr['passadu']['prefix'].$arr['passadu']['fname']."&nbsp;&nbsp;&nbsp;".$arr['passadu']['lname']."</b>&nbsp;&nbsp;)" ;?></span></p>
  </td>
  <td width=57 valign=top style='width:42.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=302 valign=top style='width:8.0cm;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>
  <?php echo "(&nbsp;&nbsp;<b>".$arr['member']['prefix'].$arr['member']['fname']."&nbsp;&nbsp;&nbsp;".$arr['member']['lname']."</b>&nbsp;&nbsp;)" ;?></span></p>
  </td>
  <td width=26 valign=top style='width:19.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:15;mso-yfti-lastrow:yes;height:11pt'>
  <td width=17 valign=top style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=340 valign=top style='width:9.0cm;padding:0cm 5.4pt 0cm 5.4pt;
  height:11pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>......../................/..........</span></b></p>
  </td>
  <td width=57 valign=top style='width:42.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
  <td width=302 valign=top style='width:8.0cm;padding:0cm 5.4pt 0cm 5.4pt;
  height:11pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>......../................/..........</span></b></p>
  </td>
  <td width=26 valign=top style='width:19.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'></span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal><span  lang=TH style='font-size:1.0pt;line-height:200%;
font-family:"TH SarabunPSK","sans-serif"'></span></p>
				<TABLE width="940" align="center" cellSpacing="0" cellPadding="0" border="0" >
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR></TABLE>
<p>
<input type="button" name="submit1" id="submit1" onClick="print_open(<?php echo $arr['stock_requistion_center']['src_number'] ;?>)" value=" พิมพ์ใบเบิก ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php if($check_requistion) { ?>
<input type="button" name="submit2" id="submit2" value=" พิมพ์ใบเบิกเรียบร้อยแล้ว " onclick="window.location.href='?compu=wsd&loc=requistion_center_print&op=requistion_print_add&data=<?php echo $arr['stock_requistion_center']['src_number']; ?>'">
<?php } ?>
</p>
</div>
<?php
$db->closedb ();
}	
?>  
					</TD>
				</TR>
			</TABLE>
		</TD>
	  </TR>
</TABLE>