<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="./css/style.css" rel="stylesheet" type="text/css">
<?php 
   		$code_id = $_GET['id'] ;
		$login_true = $_GET['user'] ;
		
		require_once("../../mainfile.php");
        //require_once("../../includes/array.in.php");
        //require_once("../../includes/function.in.php");
        //require_once("../../setconf.php");
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		
		$res['member'] = $db->select_query("SELECT member_id, prefix, fname, lname, position_id FROM ".TB_MEMBER." WHERE user='".$login_true."' ");
		$arr['member'] = $db->fetch($res['member']);
		$res['permission'] = $db->select_query("SELECT id, UNIX_TIMESTAMP(c_date_applic) AS c_date_applic2, c_id_applic, c_where, c_why, c_sit, UNIX_TIMESTAMP(c_in_date1)
		                      AS c_in_date12, c_in_time1, UNIX_TIMESTAMP(c_in_date2) AS c_in_date22, c_in_time2, c_id_head, c_id_prime, c_status FROM ".TB_CAR_PERMISSION." WHERE id='".$code_id."'");
		$arr['permission'] = $db->fetch($res['permission']);
		$res['position_a'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id='".$arr['member']['position_id']."' ");
		$arr['position_a'] = $db->fetch($res['position_a']);
		$res['head'] = $db->select_query("SELECT prefix, fname, lname, position_id, section_id FROM ".TB_MEMBER." WHERE member_id='".$arr['permission']['c_id_head']."' ");
		$arr['head'] = $db->fetch($res['head']);
		$res['position_h'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id='".$arr['head']['position_id']."' ");
		$arr['position_h'] = $db->fetch($res['position_h']);		
		$res['prime'] = $db->select_query("SELECT prefix, fname, lname, position_id FROM ".TB_MEMBER." WHERE member_id='".$arr['permission']['c_id_prime']."' ");
		$arr['prime'] = $db->fetch($res['prime']);	
		$res['position_p'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id='".$arr['prime']['position_id']."' ");
		$arr['position_p'] = $db->fetch($res['position_p']);		
		
		empty($arr['permission']['c_sit'])?$c_sit="-":$c_sit=$arr['permission']['c_sit'];
		
		  if(WEB_AGEN_MINI == "อบต.") {
		     $agenname = "นายกองค์การบริหารส่วนตำบล".WEB_AGEN_NAME ;
		  } else if(WEB_AGEN_MINI == "ทต.") {
		     $agenname = "นายกเทศมนตรีตำบล".WEB_AGEN_NAME ;
		  }
?>
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

function chkprint(){
    if(confirm(' ตรวจสอบเอกสารพิมพ์เรียบร้อยหรือยัง !!!\n\n ถ้าเรียบร้อยแล้วคลิก OK ')) {
	   //alert('Print_OK');
	   var num = 0;
       for( var i = 0; i < 25000000; i++ )
       {
         num++;
       }
       location.href = "print_ok.php?id=<?php echo $arr['permission']['id'];?>" ;
       window.opener.location.reload();
	   //window.close();
	   return true; // ถ้าตกลง OK โปรแกรมก็จะทำงานต่อไป 
       } else {
	   //alert('Cancel');
	   //window.close();
       return false; // ถ้าตอบ Cancel ก็คือไม่ต้องทำอะไร 
       }
}
//-->
</script>
</head>
<body  lang=EN-US>
<center>
<!--- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<div id="lblPrint" style=" display:none" >
<link href="psdloc/car/css/style.css" rel="stylesheet" type="text/css">
<div  class="Section1" style="position:absolute; left:20pt; top:13pt; width:595.3pt; height:841.9pt; z-index:3;" > 
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext;mso-border-insidev:
 .5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=703 valign=top style='width:550.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><b><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>แบบ&nbsp;</span>
  <span lang=TH style='font-size:18.0pt;font-family:"TH SarabunPSK"'>๓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></b></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:14.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext;mso-border-insidev:
 .5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH
  style='font-size:18.0pt;font-family:"TH SarabunPSK"'>ใบขออนุญาตใช้รถส่วนกลาง</span></b>
  </p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:26.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=343 valign=top style='width:257.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
  <td width=360 valign=top style='width:270.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>วันที่..................
  เดือน................................. <span class=SpellE>พ.ศ</span>...................</span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext;mso-border-insidev:
 .5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>เรียน&nbsp;&nbsp;&nbsp;<?php echo $agenname ;?></span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=367 valign=top style='width:277.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   ข้าพเจ้า..................................................................................</span></p>
  </td>
  <td width=336 valign=top style='width:250.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>ตำแหน่ง..............................................................................</span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</o:p></span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext;mso-border-insidev:
 .5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;
  height:43.6pt'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:43.6pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>ขออนุญาตใช้รถ
  (ไปที่ไหน)...................................................................................................................................................................</span></p>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:1.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>..............................................................................................................................................................................................................</span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=571 valign=top style='width:418.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>เพื่อ................................................................................................................................................................</span></p>
  </td>
  <td width=132 valign=top style='width:105.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>มีคนนั่ง.................คน</span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=427 valign=top style='width:320.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>ในวันที่............................................................................................................</span></p>
  </td>
  <td width=276 valign=top style='width:207.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>เวลา....................................................................</span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=427 valign=top style='width:320.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>ในวันที่............................................................................................................</span></p>
  </td>
  <td width=276 valign=top style='width:207.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>เวลา....................................................................</span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:60.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=463 valign=top style='width:347.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>................................................................</span></p>
  </td>
  <td width=240 valign=top style='width:180.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>ผู้ขออนุญาต</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=463 valign=top style='width:347.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
  <td width=240 valign=top style='width:180.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes'>
  <td width=703 colspan=2 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>(................................................................)</span></p>
  </td>
 </tr> 
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:63.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=463 valign=top style='width:347.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>.................................................................</span></p>
  </td>
  <td width=240 valign=top style='width:180.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>ปลัด  อบต. หรือผู้แทน</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=463 valign=top style='width:347.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
  <td width=240 valign=top style='width:180.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=703 colspan=2 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>(................................................................)</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width=463 valign=top style='width:347.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
  <td width=240 valign=top style='width:180.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4;mso-yfti-lastrow:yes'>
  <td width=703 colspan=2 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:16.0pt;font-family:"TH SarabunPSK"'>............./................................./...............</span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span style='font-size:35.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insidev:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>.......................................................................................................................................................................................................</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>(ลงนามผู้มีอำนาจสั่งใช้รถ).............................................................................................................................................................</span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:75.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>................................................................</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>(....................................................................)</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'><?php echo $arr['position_p']['position_name'] ;?><?php echo WEB_AGEN_FULL ;?><?php echo WEB_AGEN_NAME ;?></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6;mso-yfti-lastrow:yes'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>.............../.............................../.................</span></p>
  </td>
 </tr>
</table>
</div>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div  class="Section2" style="position:absolute; left:20pt; top:10pt; width:595.3pt; height:841.9pt; z-index:3;" > 
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext;mso-border-insidev:
 .5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><b><span lang=TH
  style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b>
  <b><span lang=TH style='font-size:18.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:14.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext;mso-border-insidev:
 .5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=TH style='font-size:18.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b>
  </p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:26.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=343 valign=top style='width:257.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
  <td width=360 valign=top style='width:270.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ThaiTimeConvert($arr['permission']['c_date_applic2'],"4",""); ?></b></span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext;mso-border-insidev:
 .5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=367 valign=top style='width:277.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <b><?php echo $arr['member']['prefix'] ;?><?php echo $arr['member']['fname'] ;?>&nbsp;&nbsp;&nbsp;<?php echo $arr['member']['lname'] ;?></b></span></p>
  </td>
  <td width=336 valign=top style='width:250.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $arr['position_a']['position_name'] ;?></b></span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext;mso-border-insidev:
 .5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;
  height:43.6pt'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:43.6pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <b><?php echo $arr['permission']['c_where'] ;?></b></span></p>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH
  style='font-size:1.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'></span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=571 valign=top style='width:428.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <b><?php echo $arr['permission']['c_why'] ;?></b></span></p>
  </td>
  <td width=132 valign=top style='width:99.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <b><?php echo $c_sit ;?></b></span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=427 valign=top style='width:320.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <b><?php  if($arr['permission']['c_in_date12'] != 0){echo ThaiTimeConvert($arr['permission']['c_in_date12'],"3","");} ?>&nbsp;</b></span></p>
  </td>
  <td width=276 valign=top style='width:207.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <b><?php  if($arr['permission']['c_in_time1'] != 0){ echo $arr['permission']['c_in_time1']."&nbsp;&nbsp;น." ;} ?>&nbsp;</b></span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=427 valign=top style='width:320.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <b><?php  if($arr['permission']['c_in_date22'] != 0){echo ThaiTimeConvert($arr['permission']['c_in_date22'],"3","");} ?>&nbsp;</b></span></p>
  </td>
  <td width=276 valign=top style='width:207.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <b><?php  if($arr['permission']['c_in_time2'] != 0){ echo $arr['permission']['c_in_time2']."&nbsp;&nbsp;น." ;} ?>&nbsp;</b></span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:60.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=463 valign=top style='width:347.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
  <td width=240 valign=top style='width:180.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=463 valign=top style='width:347.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
  <td width=240 valign=top style='width:180.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes'>
  <td width=703 colspan=2 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'><b><?php echo $arr['member']['prefix'] ;?><?php echo $arr['member']['fname'] ;?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $arr['member']['lname'] ;?></b></span></p>
  </td>
 </tr>  
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:63.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=463 valign=top style='width:347.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
  <td width=240 valign=top style='width:180.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=463 valign=top style='width:347.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
  <td width=240 valign=top style='width:180.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=703 colspan=2 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'><b><?php echo $arr['head']['prefix'] ;?><?php echo $arr['head']['fname'] ;?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $arr['head']['lname'] ;?></b></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width=463 valign=top style='width:347.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
  <td width=240 valign=top style='width:180.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4;mso-yfti-lastrow:yes'>
  <td width=703 colspan=2 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span style='font-size:35.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insidev:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:75.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=703
 style='width:560.0pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'><b><?php echo $arr['prime']['prefix'] ;?><?php echo $arr['prime']['fname'] ;?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $arr['prime']['lname'] ;?></b></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span style='font-size:3.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6;mso-yfti-lastrow:yes'>
  <td width=703 valign=top style='width:560.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
 </tr>
</table>
</div>
</div>
</body>
</html>
<script language="javascript" type="text/javascript">
printContentDiv('lblPrint');
chkprint() ;
// var num = 0;
// for( var i = 0; i < 250000000; i++ )
// {
// num++;
// }
// window.close();
</script>