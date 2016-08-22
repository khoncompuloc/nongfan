<?
header("Content-Type: application/ms-word");
header('Content-Disposition: attachment; filename="filename.doc"');
?> 
<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 11">
<meta name=Originator content="Microsoft Word 11">
<link rel=File-List href="&#3610;&#3633;&#3597;&#3594;&#3637;&#3623;&#3633;&#3626;&#3604;&#3640;.files/filelist.xml">
<title></title>
<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>winxps</o:Author>
  <o:LastAuthor>winxps</o:LastAuthor>
  <o:Revision>2</o:Revision>
  <o:TotalTime>310</o:TotalTime>
  <o:LastPrinted>2012-08-08T07:35:00Z</o:LastPrinted>
  <o:Created>2012-08-08T07:46:00Z</o:Created>
  <o:LastSaved>2012-08-08T07:46:00Z</o:LastSaved>
  <o:Pages>1</o:Pages>
  <o:Words>127</o:Words>
  <o:Characters>726</o:Characters>
  <o:Lines>6</o:Lines>
  <o:Paragraphs>1</o:Paragraphs>
  <o:CharactersWithSpaces>852</o:CharactersWithSpaces>
  <o:Version>11.6568</o:Version>
 </o:DocumentProperties>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:View>Print</w:View>
  <w:PunctuationKerning/>
  <w:ValidateAgainstSchemas/>
  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>
  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>
  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>
  <w:Compatibility>
   <w:BreakWrappedTables/>
   <w:SnapToGridInCell/>
   <w:ApplyBreakingRules/>
   <w:WrapTextWithPunct/>
   <w:UseAsianBreakRules/>
   <w:DontGrowAutofit/>
  </w:Compatibility>
  <w:BrowserLevel>MicrosoftInternetExplorer4</w:BrowserLevel>
 </w:WordDocument>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:LatentStyles DefLockedState="false" LatentStyleCount="156">
 </w:LatentStyles>
</xml><![endif]-->
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
	mso-header-margin:35.45pt;
	mso-footer-margin:35.45pt;
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
<?
require_once("../../setconf.php");
    $sh_id = $_GET['sh_id'] ;
    $limit = 19 ;
	
	$res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE sh_id='".$sh_id."'");
	$arr['stock_head'] = $db->fetch($res['stock_head']);
	$res['stock_type'] = $db->select_query("SELECT * FROM ".TB_STOCK_TYPE." WHERE type_id='".$arr['stock_head']['type_id']."'");
	$arr['stock_type'] = $db->fetch($res['stock_type']);
	$res['count_page'] = $db->select_query("SELECT COUNT(sd_id) AS num_page FROM ".TB_STOCK_SECTION.$budget." WHERE sh_id='".$sh_id."'");	
	$arr['count_page'] = $db->fetch($res['count_page']);
	
	$page = ceil($arr['count_page']['num_page']/$limit) ;
	
    if($arr['stock_head']['section_id'] == "0" )	{
	$section_name = $agen_mini.$agen_name ;
	} else {
	$res['member_section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." WHERE section_id='".$arr['stock_head']['section_id']."'");
	$arr['member_section'] = $db->fetch($res['member_section']);	
	$section_name = $arr['member_section']['section_name'] ;	
	}
?>
</head>
<body>
<?
for($i=1;$i<=$page;$i++) { 
    $count = 19 ;
    $limit_start = ($i-1)*$limit ;
	$res['stock_details'] = $db->select_query("SELECT UNIX_TIMESTAMP(sd_date) AS st_date ,sd_name ,sd_ref ,sd_price ,sd_amount ,sd_amountcost ,sd_pricecost ,sd_note ,sd_logic ,shf_id FROM ".TB_STOCK_SECTION.$budget." WHERE sh_id='".$sh_id."' ORDER BY sd_id  LIMIT $limit_start, $limit ");   
?> 
<div class=Section1>
<p class=MsoNormal><span style='font-size:8.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
 mso-border-insideh:.5pt solid windowtext;mso-border-insidev:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=502 valign=top style='width:376.7pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
  font-family:"TH SarabunPSK"'>50-10-07</span><?//=$arr['count_page']['num_page'];?><?//=$page;?></p>
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
  style='font-size:20.0pt;font-family:"TH SarabunPSK"'>บัญชีวัสดุ</span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;mso-yfti-lastrow:yes'>
  <td width=1005 valign=top style='width:753.45pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><b><span lang=TH
  style='font-size:15.0pt;font-family:"TH SarabunPSK"'><?=$agen_full.$agen_name ;?></span></b></p>
  </td>
 </tr>
</table>
<p class=MsoNormal><span style='font-size:1.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
 mso-border-insideh:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=502 valign=top style='width:376.7pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"TH SarabunPSK"'>
  แผ่นที่&nbsp;&nbsp;<b><?=$i ;?></b>&nbsp;&nbsp;(<?=$arr['stock_head']['sh_code_id'] ;?>)</span></p>
  </td>
  <td width=502 valign=top style='width:376.75pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><span lang=TH style='font-size:15.0pt;font-family:"TH SarabunPSK"'>
   ต.<b><?=$district ;?></b>&nbsp;&nbsp;อ.<b><?=$amphur ;?></b>&nbsp;&nbsp;จ.<b><?=$province ;?></b></span></p>
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
  <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"TH SarabunPSK"'>
  ประเภท&nbsp;&nbsp;<b><?=$arr['stock_type']['type_name'] ;?></b></span></p>
  </td>
  <td width=335 valign=top style='width:251.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"TH SarabunPSK"'>
  ชื่อหรือชนิดวัสดุ&nbsp;&nbsp;<b><?=$arr['stock_head']['sh_name'] ;?></b></span></p>
  </td>
  <td width=335 valign=top style='width:251.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><span lang=TH style='font-size:15.0pt;font-family:"TH SarabunPSK"'>
  หน่วยงาน&nbsp;&nbsp;<b><?=$section_name ;?></b></span></p>
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
  <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"TH SarabunPSK"'>
  ขนาดหรือลักษณะ&nbsp;&nbsp;<b><?=$arr['stock_head']['sh_diff_name'] ;?></b></span></p>
  </td>
  <td width=528 valign=top style='width:396.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:15.0pt;font-family:"TH SarabunPSK"'>
  จำนวนอย่างสูง&nbsp;&nbsp;<b><?=$arr['stock_head']['sh_high'] ;?></b></span></p>
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
  <p class=MsoNormal><span lang=TH style='font-size:15.0pt;mso-ansi-font-size:12.0pt;font-family:"TH SarabunPSK"'>
  หน่วยนับ&nbsp;&nbsp;<b><?=$arr['stock_head']['sh_unit'] ;?></b></span></p>
  </td>
  <td width=264 valign=top style='width:198.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:15.0pt;mso-ansi-font-size:12.0pt;font-family:"TH SarabunPSK"'>
  ที่เก็บ&nbsp;&nbsp;<b><?=$arr['stock_head']['sh_keep'] ;?></b></span></p>
  </td>
  <td width=528 valign=top style='width:396.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:15.0pt;mso-ansi-font-size:12.0pt;font-family:"TH SarabunPSK"'>
   จำนวนอย่างตำ&nbsp;&nbsp;<b><?=$arr['stock_head']['sh_low'] ;?></b></span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=90 rowspan=2 valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  วัน เดือน ปี</span></p>
  </td>
  <td width=204 rowspan=2 valign=top style='width:153.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  รับจาก/จ่ายให้</span></p>
  </td>
  <td width=96 rowspan=2 valign=top style='width:72.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  เลขที่เอกสาร</span></p>
  </td>
  <td width=96 rowspan=2 valign=top style='width:72.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ราคาต่อหน่วย</span></p>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ( บาท )</span></p>
  </td>
  <td width=144 colspan=2 valign=top style='width:107.85pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  รับ</span></p>
  </td>
  <td width=144 colspan=2 valign=top style='width:108.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  จ่าย</span></p>
  </td>
  <td width=142 colspan=2 valign=top style='width:106.15pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  คงเหลือ</span></p>
  </td>
  <td width=99 rowspan=2 valign=top style='width:74.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  หมายเหตุ</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=72 valign=top style='width:54.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  จำนวน</span></p>
  </td>
  <td width=72 valign=top style='width:53.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ราคา</span></p>
  </td>
  <td width=72 valign=top style='width:54.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  จำนวน</span></p>
  </td>
  <td width=72 valign=top style='width:53.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ราคา</span></p>
  </td>
  <td width=72 valign=top style='width:54.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  จำนวน</span></p>
  </td>
  <td width=69 valign=top style='width:52.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ราคา</span></p>
  </td>
 </tr>
 <?
 while($arr['stock_details'] = $db->fetch($res['stock_details'])) {
 	if($arr['stock_details']['sd_logic'] == "0") {
	$get_amount = "-" ;
	$get_price = "-" ;
	$put_amount = $arr['stock_details']['sd_amount'] ;
	$put_price = $arr['stock_details']['sd_price']*$arr['stock_details']['sd_amount'] ;
    } else if($arr['stock_details']['sd_logic'] == "1") {    
	$get_amount = $arr['stock_details']['sd_amount'] ;
	$get_price = $arr['stock_details']['sd_price']*$arr['stock_details']['sd_amount'] ;
	$put_amount = "-" ;
	$put_price = "-" ;	
	}
    $res['stock_head_from'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD_PRICE." WHERE shf_id=".$arr['stock_details']['shf_id']."");	
	$arr['stock_head_from'] = $db->fetch($res['stock_head_from'])	
 ?>
 <tr style='mso-yfti-irow:2;height:17.35pt'>
  <td width=90 valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b><?=ThaiTimeConvert($arr['stock_details']['st_date'],"5",""); ?></b></span></p>
  </td>
  <td width=204 valign=top style='width:153.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b><?=$arr['stock_details']['sd_name'] ;?></b></span></p>
  </td>
  <td width=96 valign=top style='width:72.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b><?=$arr['stock_details']['sd_ref'] ;?></b></span></p>
  </td>
  <td width=96 valign=top style='width:72.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b><?=$arr['stock_details']['sd_price'] ;?></b></span></p>
  </td>
  <td width=72 valign=top style='width:54.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b><?=$get_amount ;?></b></span></p>
  </td>
  <td width=72 valign=top style='width:53.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b><?=$get_price ;?></b></span></p>
  </td>
  <td width=72 valign=top style='width:54.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b><?=$put_amount ;?></b></span></p>
  </td>
  <td width=72 valign=top style='width:53.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b><?=$put_price ;?></b></span></p>
  </td>
  <td width=72 valign=top style='width:54.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b><?=$arr['stock_details']['sd_amountcost'] ;?></b></span></p>
  </td>
  <td width=69 valign=top style='width:52.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b><?=$arr['stock_details']['sd_pricecost'] ;?></b></span></p>
  </td>
  <td width=99 valign=top style='width:74.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:11.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['stock_head_from']['shf_diff_name'] ;?><br><?=$arr['stock_details']['sd_note'] ;?></span></p>
  </td>
 </tr>
 <?
 $count-- ;
 }
  for($j=1;$j<=$count;$j++) {
 ?>
 <tr style='mso-yfti-irow:3;height:17.15pt'>
  <td width=90 valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:17.15pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>&nbsp;</b></span></p>
  </td>
  <td width=204 valign=top style='width:153.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.15pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>&nbsp;</b></span></p>
  </td>
  <td width=96 valign=top style='width:72.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.15pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>&nbsp;</b></span></p>
  </td>
  <td width=96 valign=top style='width:72.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.15pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>&nbsp;</b></span></p>
  </td>
  <td width=72 valign=top style='width:54.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.15pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>&nbsp;</b></span></p>
  </td>
  <td width=72 valign=top style='width:53.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.15pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>&nbsp;</b></span></p>
  </td>
  <td width=72 valign=top style='width:54.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.15pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>&nbsp;</b></span></p>
  </td>
  <td width=72 valign=top style='width:53.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.15pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>&nbsp;</b></span></p>
  </td>
  <td width=72 valign=top style='width:54.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.15pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>&nbsp;</b></span></p>
  </td>
  <td width=69 valign=top style='width:52.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.15pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>&nbsp;</b></span></p>
  </td>
  <td width=99 valign=top style='width:74.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.15pt'>
  <p class=MsoNormal align=center style='text-align:center'><span style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>&nbsp;</b></span></p>
  </td>
 </tr>
 <?
 }
 ?>
</table>
<p class=MsoNormal align=center style='text-align:center'>
<span style='font-size:14.0pt'>&nbsp;</span></p>
</div>
<? 
}
?>
</body>
</html>
