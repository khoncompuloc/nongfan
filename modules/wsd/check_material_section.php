<?php
Check_boss($admin_user,$admin_level);
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
	{font-family:"Cordia New";
	panose-1:2 11 3 4 2 2 2 2 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-2130706429 0 0 0 65537 0;}
@font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-536870145 1073786111 1 0 415 0;}
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
	font-family:"Calibri","sans-serif";
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
@page WordSection1
	{size:595.3pt 841.9pt;
	margin:14.2pt 7.0pt 14.2pt 21.3pt;
	mso-header-margin:35.4pt;
	mso-footer-margin:35.4pt;
	mso-paper-source:0;}
div.WordSection1
	{page:WordSection1;}
-->
</style>
<!--[if gte mso 10]>
<style>
 /* Style Definitions */
 table.MsoNormalTable
	{mso-style-name:"Table Normal";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-priority:99;
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
	mso-hansi-theme-font:minor-latin;}
table.MsoTableGrid
	{mso-style-name:"Table Grid";
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
	mso-hansi-theme-font:minor-latin;}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="1026"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="1"/>
 </o:shapelayout></xml><![endif]-->
 <script language="javascript" type="text/javascript">
function  print_open(section_id)
   {
     window.open('modules/wsd/check_material_section_print.php?section_id='+section_id+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=10,height=20,left=200,top=50');
   }  
</script>
 <TABLE cellSpacing="0" cellPadding="0" width="100%" border="0">
    <TR>
        <TD width="10" vAlign="top"><IMG src="images/fader.gif" border=0></TD>
        <TD width="830" vAlign="top"><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin 
		  &nbsp;&nbsp;<IMG SRC="images/wsd/texmenu_stock_new.gif" BORDER="0"><span style="font-size:16px;color:#900"> 
		  --> 
<?php
//empty($ProcessOutput)?$ProcessOutput="":$ProcessOutput=$ProcessOutput ;
if(!$data) {  
              
			        $date_timestamp = strtotime(date("Y-m-d"));
					//echo "date_timestamp = ".$date_timestamp ;

	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					$res['member_section'] = $db->select_query("SELECT section_name FROM ".TB_MEMBER_SECTION." WHERE section_id='".$_SESSION['section_id']."'");
					$arr['member_section'] = $db->fetch($res['member_section']);	
	//$limit = 15 ;
	//$SUMPAGE = $db->num_rows(TB_STOCK_HEAD,"sh_id","");

	//if (empty($page)){
	//	$page=1;
	//}
	//$rt = $SUMPAGE%$limit ;
	//$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	//$goto = ($page-1)*$limit ;
//	echo "type_id =".$_POST['type_id'] ;
//	echo "<br>subtype_id =".$_POST['subtype_id'] ;
?>
 <div class=WordSection1>
 <table width="100%" cellspacing="2" cellpadding="1" >
 
<p class=MsoNormal align=center style='text-align:center'><b>
<span lang=TH style='font-size:18.0pt;line-height:115%;font-family:"TH SarabunPSK","sans-serif"'>
สรุปวัสดุคงเหลือ</span></b></p>
<p class=MsoNormal align=center style='text-align:center;line-height:normal'>
<span lang=TH style='font-size:15.0pt;font-family:"TH SarabunPSK","sans-serif"'>
หน่วยงาน<b>&nbsp;&nbsp;<?php echo $arr['member_section']['section_name'];?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
<span lang=TH style='font-size:15.0pt;font-family:"TH SarabunPSK","sans-serif"'>
ณ วันที่&nbsp;&nbsp;<b><?php echo ThaiTimeConvert($date_timestamp,"3","");?></b></span></p>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0  align=center
 style='border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=26 valign=top style='border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>ที่</span></p>
  </td>
  <td width=35 valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>วัสดุที่</span></p>
  </td>
  <td width=260 valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>ชื่อวัสดุ (</span><span lang=TH
  style='font-size:14.0pt;font-family:"TH SarabunPSK","sans-serif"'>ขนาดหรือลักษณะ</span><span
  lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'>)</span></p>
  </td>
  <td width=142 valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>ราคา </span></p>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>(</span><span lang=TH
  style='font-size:14.0pt;font-family:"TH SarabunPSK","sans-serif"'>ขนาดหรือลักษณะย่อย</span><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'>)</span></p>
  </td>
  <td width=94 valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>จำนวน</span></p>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>(</span><span lang=TH style='font-size:
  14.0pt;font-family:"TH SarabunPSK","sans-serif"'>หน่วยนับ</span><span
  lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'>)</span></p>
  </td>
  <td width=76 valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>ยอดเช็ค</span></p>
  </td>
  <td width=121 valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>หมายเหตุ</span></p>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>(</span><span lang=TH style='font-size:
  14.0pt;font-family:"TH SarabunPSK","sans-serif"'>วันที่ล่าสุด</span><span
  lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'>)</span></p>  
  </td>
 </tr>
<?php  
$res['stock_type'] = $db->select_query("SELECT * FROM ".TB_STOCK_TYPE."");
while($arr['stock_type'] = $db->fetch($res['stock_type'])){ 
$res['stock_subtype'] = $db->select_query("SELECT * FROM ".TB_STOCK_SUBTYPE." WHERE type_id='".$arr['stock_type']['type_id']."'");
$count=0;
?>
 <tr style='mso-yfti-irow:1;height:21.9pt'>
  <td width=754 colspan=7 valign=top style='border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:21.9pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:normal'><b>
  <span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'><?php echo $arr['stock_type']['type_name'] ;?></span></b></p>
  </td>
 </tr>
<?php
while($arr['stock_subtype'] = $db->fetch($res['stock_subtype'])){  
//$res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." ORDER BY sh_id LIMIT $goto, $limit ");
$res['stock_head_section'] = $db->select_query("SELECT shs_id ,sh_id ,acc_number FROM ".TB_STOCK_HEAD_SECTION." WHERE section_id=".$_SESSION['section_id']."");
while($arr['stock_head_section'] = $db->fetch($res['stock_head_section'])){
    
    $res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE sh_id=".$arr['stock_head_section']['sh_id']." AND type_id=".$arr['stock_type']['type_id']." AND subtype_id=".$arr['stock_subtype']['subtype_id']."");
	$arr['stock_head'] = $db->fetch($res['stock_head']);
	$rows['stock_head'] = $db->rows($res['stock_head']);
	if($rows['stock_head']){
	empty($arr['stock_head']['sh_diff_name'])?$sh_diff_name="":$sh_diff_name=" ( ".$arr['stock_head']['sh_diff_name']." )" ;

	$array_amountcost = array() ;
	$array_price_diff_name = array() ;
    $res['stock_head_price'] = $db->select_query("SELECT shp_amountcost ,shp_price ,shp_diff_name FROM ".TB_STOCK_HEAD_PRICE." WHERE shs_id=".$arr['stock_head_section']['shs_id']."");
	while($arr['stock_head_price'] = $db->fetch($res['stock_head_price'])) {
		
        empty($arr['stock_head_price']['shp_diff_name'])?$shp_diff_name="":$shp_diff_name=" ( ".$arr['stock_head_price']['shp_diff_name']." )" ;
		$array_amountcost[] = $arr['stock_head_price']['shp_amountcost'] ;
		$array_price_diff_name[] = $arr['stock_head_price']['shp_price'].$shp_diff_name.""  ;
	}
	$check_shs_id=mysql_query("SELECT UNIX_TIMESTAMP(ss_date) AS ssdate, ss_date FROM ".TB_STOCK_SECTION." WHERE shs_id=".$arr['stock_head_section']['shs_id']." ORDER BY ss_date  DESC");
	list($ssdate)=mysql_fetch_row($check_shs_id);
?>
<tr style='mso-yfti-irow:2;height:21.9pt'>
  <td valign=top style='border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:21.9pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'><?php echo $count+1 ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.9pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'><?php echo $arr['stock_head_section']['acc_number'];?></span></b></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.9pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'><?php echo $arr['stock_head']['sh_name'];?></span></b>
  <span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK","sans-serif"'><?php echo $sh_diff_name; ?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.9pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>
  <span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'>
  <?php 
  foreach($array_price_diff_name as $price_diff) {
  echo  $price_diff."<br>" ;
  }
  ?>
  </span></p>
  </td>  
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.9pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>
  <span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'>
  <?php 
  foreach($array_amountcost as $amountcost) {
  echo  "<b>".$amountcost."</b>  ".$arr['stock_head']['sh_unit']."<br>" ;
  }
  ?>
  </span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.9pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.9pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:left;line-height:normal'><span style='font-size:16.0pt;
  font-family:"TH SarabunPSK","sans-serif"'><b><span style='font-size:12.0pt;
  font-family:"TH SarabunPSK","sans-serif"'><?php echo ThaiTimeConvert($ssdate,"5",""); ?></span><b><br><br><br><br></span></p>
  </td>
 </tr>
<?php
    $count++;
	}
 } 
}
}
?>
<tr>
 <td width="100%" height="60" align="center" colspan="7">
<input  type="button" onClick="print_open(<?php echo $_SESSION['section_id'] ;?>)" value="   พิมพ์สรุปวัสดุคงเหลือ   ">
 </td>
</tr>
 </table>
<BR>
</div>

<?php
}  else {
	echo $ProcessOutput ;
}
$db->closedb();
?>
		</TD>
    </TR>
</TABLE>