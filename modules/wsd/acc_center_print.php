<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="./css/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript">
<!--
function printContentDiv(content){
var printReady = document.getElementById(content);
var txt= "";

if (document.getElementsByTagName != null){
var txtheadTags = document.getElementsByTagName("head");
if (txtheadTags.length > 0){
var str=txtheadTags[0].innerHTML;
txt += str; // str.replace(/funChkLoad();/ig, ” “);
}
}
txt += "";
if (printReady != null){
txt += printReady.innerHTML;
}
txt += "";
var printWin = window.open('','','width=1000,height=800,toolbar=no,location=no,status=no,menubar=yes,scrollbars=no,resizable=yes,,left=40%,top=30%');
printWin.document.open();
printWin.document.write(txt);
printWin.document.close();
printWin.print();
printWin.close();
}

//-->
</script>
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:"Angsana New";
	panose-1:2 2 6 3 5 4 5 2 3 4;
	mso-font-charset:0;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:16777219 0 0 0 65537 0;}
@font-face
	{font-family:"TH SarabunPSK";
	panose-1:2 11 5 0 4 2 0 2 0 3;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-1593835409 1342185562 0 0 65923 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{mso-style-parent:"";
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Times New Roman";
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:"Angsana New";}
 /* Page Definitions */
 @page
	{mso-gutter-position:top;}
@page Section1
	{size:841.9pt 595.3pt;
	mso-page-orientation:landscape;
	margin:18.0pt 42.55pt 18.0pt 2.0cm;
	mso-header-margin:25.45pt;
	mso-footer-margin:25.45pt;
	mso-paper-source:0;}
div.Section1
	{page:Section1;}
-->
</style>
<!--[if gte mso 10]>
<style>
 /* Style Definitions */
 table.MsoNormalTable
	{mso-style-name:\0E15\0E32\0E23\0E32\0E07\0E1B\0E01\0E15\0E34;
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-parent:"";
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-para-margin:0cm;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Times New Roman";
	mso-ansi-language:#0400;
	mso-fareast-language:#0400;
	mso-bidi-language:#0400;}
table.MsoTableGrid
	{mso-style-name:\0E40\0E2A\0E49\0E19\0E15\0E32\0E23\0E32\0E07;
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	border:solid windowtext 1.0pt;
	mso-border-alt:solid windowtext .5pt;
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-border-insideh:.5pt solid windowtext;
	mso-border-insidev:.5pt solid windowtext;
	mso-para-margin:0cm;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Times New Roman";
	mso-ansi-language:#0400;
	mso-fareast-language:#0400;
	mso-bidi-language:#0400;}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="1026"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="1"/>
 </o:shapelayout></xml><![endif]-->
<?php
require_once("../../includes/config.in.php");
require_once("../../includes/function.in.php");
require_once("../../includes/class.mysql.php");
require_once("../../includes/array.in.php");
require_once("../../setconf.php");
$shc_id = $_GET['shc_id'] ;
//echo $sh_id ;
$i = 1 ; //แผ่นที่
$count = 16 ; //จำนวนแถว
	$res['stock_head_center'] = $db->select_query("SELECT shc_id ,sh_id ,shc_keep ,shc_high ,shc_low ,acc_number FROM ".TB_STOCK_HEAD_CENTER." WHERE shc_id='".$shc_id."'");
	$arr['stock_head_center'] = $db->fetch($res['stock_head_center']);
	$res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE sh_id='".$arr['stock_head_center']['sh_id']."'");
	$arr['stock_head'] = $db->fetch($res['stock_head']);
	$res['stock_type'] = $db->select_query("SELECT * FROM ".TB_STOCK_TYPE." WHERE type_id='".$arr['stock_head']['type_id']."'");
	$arr['stock_type'] = $db->fetch($res['stock_type']);
	$res['stock_center'] = $db->select_query("SELECT UNIX_TIMESTAMP(sc_date) AS sc_date ,sc_name ,sc_ref ,sc_price ,sc_amount ,sc_amountcost ,sc_deega ,sc_note ,sc_logic ,src_number ,shp_diff_name FROM ".TB_STOCK_CENTER." WHERE shc_id='".$arr['stock_head_center']['shc_id']."' ORDER BY sc_id ");
	
    if($arr['stock_head']['section_id'] == "0" )	{
	$section_name = WEB_AGEN_MINI.WEB_AGEN_NAME ;
	} else {
	$res['member_section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." WHERE section_id='".$arr['stock_head']['section_id']."'");
	$arr['member_section'] = $db->fetch($res['member_section']);	
	$section_name = $arr['member_section']['section_name'] ;	
	}
?>
</head>
<body  lang=EN-US style='tab-interval:36.0pt'>
<div id="lblPrint" >
<div class=Section1>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
 mso-border-insideh:.5pt solid windowtext;mso-border-insidev:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=502 valign=top style='width:376.7pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"TH SarabunPSK"'>50-10-07</span></p>
  </td>
  <td width=502 valign=top style='width:376.75pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><span lang=TH
  style='font-size:14.0pt;font-family:"TH SarabunPSK"'>พ.ด. ๔</span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal><span style='font-size:1.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
 mso-border-insidev:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=1005 valign=top style='width:753.45pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH
  style='font-size:18.0pt;font-family:"TH SarabunPSK"'>บัญชีวัสดุ</span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;mso-yfti-lastrow:yes'>
  <td width=1005 valign=top style='width:753.45pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><b><span lang=TH
  style='font-size:14.0pt;font-family:"TH SarabunPSK"'><?php echo WEB_AGEN_FULL.WEB_AGEN_NAME ;?></span></b></p>
  </td>
 </tr>
</table>
<p class=MsoNormal><span style='font-size:1.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
 mso-border-insideh:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=502 valign=top style='width:376.7pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  แผ่นที่&nbsp;&nbsp;<b><?php echo $i ;?></b>&nbsp;&nbsp;(&nbsp;<?php echo $arr['stock_head']['sh_code_id'] ;?>&nbsp;)&nbsp;วัสดุที่<?php echo " ".$arr['stock_head_center']['acc_number'] ;?></span></p>
  </td>
  <td width=502 valign=top style='width:376.75pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
   ต.&nbsp;<b><?php echo WEB_DISTRICT ;?></b>&nbsp;&nbsp;อ.&nbsp;<b><?php echo WEB_AMPHUR ;?></b>&nbsp;&nbsp;จ.&nbsp;<b><?php echo WEB_PROVINCE ;?></b></span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:1.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
 mso-border-insideh:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=335 valign=top style='width:251.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ประเภท&nbsp;&nbsp;<b><?php echo $arr['stock_type']['type_name'] ;?></b></span></p>
  </td>
  <td width=335 valign=top style='width:251.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"TH SarabunPSK"'> 
  ชื่อหรือชนิดวัสดุ&nbsp;&nbsp;<b><?php echo $arr['stock_head']['sh_name'] ;?></b></span></p>
  </td>
  <td width=335 valign=top style='width:251.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  หน่วยงาน&nbsp;&nbsp;<b><?php echo $section_name ;?></b></span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:1.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=1003
 style='width:752.4pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=475 valign=top style='width:356.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ขนาดหรือลักษณะ&nbsp;&nbsp;<b><?php echo $arr['stock_head']['sh_diff_name'] ;?></b></span></p>
  </td>
  <td width=528 valign=top style='width:396.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  จำนวนอย่างสูง&nbsp;&nbsp;<b><?php echo $arr['stock_head_center']['shc_high'] ;?></b></span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:1.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=1003
 style='width:752.4pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=211 valign=top style='width:158.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;mso-ansi-font-size:12.0pt;font-family:"TH SarabunPSK"'>
  หน่วยนับ&nbsp;&nbsp;<b><?php echo $arr['stock_head']['sh_unit'] ;?></b></span></p>
  </td>
  <td width=264 valign=top style='width:198.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;mso-ansi-font-size:12.0pt;font-family:"TH SarabunPSK"'>
  ที่เก็บ&nbsp;&nbsp;<b><?php echo $arr['stock_head_center']['shc_keep'] ;?></b></span></p>
  </td>
  <td width=528 valign=top style='width:396.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;mso-ansi-font-size:12.0pt;font-family:"TH SarabunPSK"'>
   จำนวนอย่างตำ&nbsp;&nbsp;<b><?php echo $arr['stock_head_center']['shc_low'] ;?></b></span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:20.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<p class=MsoNormal align=center style='text-align:center'>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=10%  valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  วัน เดือน ปี</span></p>
  </td>
  <td width=27% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  รับจาก/จ่ายให้</span></p>
  </td>
  <td width=12%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  เลขที่เอกสาร</span></p>
  </td>
  <td width=10%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ราคาต่อหน่วย</span></p>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ( บาท )</span></p>
  </td>
  <td width=7% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  รับ</span></p>
  </td>
  <td width=7% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  จ่าย</span></p>
  </td>
  <td width=7% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  คงเหลือ</span></p>
  </td>
  <td width=10%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  เลขฎีกา</span></p>
  </td>
  <td width=10%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  หมายเหตุ</span></p>
  </td>  
 </tr>
 <?php
 while($arr['stock_center'] = $db->fetch($res['stock_center'])) {
 	if($arr['stock_center']['sc_logic'] == "0") {
	$get_amount = "-" ;
	$get_price = "-" ;
	$put_amount = $arr['stock_center']['sc_amount'] ;
	$put_price = $arr['stock_center']['sc_price']*$arr['stock_center']['sc_amount'] ;
    } else if($arr['stock_center']['sc_logic'] == "1") {    
	$get_amount = $arr['stock_center']['sc_amount'] ;
	$get_price = $arr['stock_center']['sc_price']*$arr['stock_center']['sc_amount'] ;
	$put_amount = "-" ;
	$put_price = "-" ;	
	}
	
	//empty($arr['stock_center']['shp_diff_name'])?$shp_diff_name="":$shp_diff_name="".$arr['stock_center']['shp_diff_name']."" ;
    //$res['stock_head_from'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD_PRICE." WHERE shf_id=".$arr['stock_center']['shf_id']."");	
	//$arr['stock_head_from'] = $db->fetch($res['stock_head_from'])	
 ?>
  <tr style='mso-yfti-irow:2;height:17.35pt'>
  <td valign=top style='border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo ThaiTimeConvert($arr['stock_center']['sc_date'],"5",""); ?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_center']['sc_name'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_center']['sc_ref'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_center']['sc_price'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $get_amount ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $put_amount ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_center']['sc_amountcost'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_center']['sc_deega'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:11.0pt;font-family:"TH SarabunPSK"'>
  <?php if(isset($arr['stock_center']['shp_diff_name'])) { echo $arr['stock_center']['shp_diff_name'] ;}?><?php echo " ".$arr['stock_center']['sc_note'] ;?></span></p>
  </td>
 </tr>
 <?php
 $count-- ;
 }
  for($i=1;$i<=$count;$i++) {
 ?>
   <tr style='mso-yfti-irow:2;height:17.35pt'>
  <td valign=top style='border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo "" ; ?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo "" ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo "" ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo "" ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo "" ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo "" ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo "" ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo "" ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo "" ;?></span></p>
  </td>
 </tr>
 <?php
 }
 ?>
</table>
</p>
</div>
</div>
</body>
</html>
<script language="javascript" type="text/javascript">
printContentDiv('lblPrint');
window.close();
</script>