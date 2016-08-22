<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- <link href="./css/style.css" rel="stylesheet" type="text/css"> -->
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:"Cordia New";
	panose-1:2 11 3 4 2 2 2 2 2 4;}
@font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;}
@font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;}
@font-face
	{font-family:"TH SarabunPSK";
	panose-1:2 11 5 0 4 2 0 2 0 3;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:10.0pt;
	margin-left:0cm;
	line-height:115%;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
.MsoPapDefault
	{margin-bottom:10.0pt;
	line-height:115%;}
@page Section1
	{size:595.3pt 841.9pt;
	margin:14.2pt 21.2pt 7.1pt 1.0cm;}
div.Section1
	{page:Section1;}
-->
</style>
<?php 
   		$code_id = $_GET['id'] ;
		$login_true = $_GET['user'] ;
		
		require_once("../../mainfile.php");

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		
		$res['member'] = $db->select_query("SELECT member_id, prefix, fname, lname, position_id ,parties_id ,degree_id ,user FROM ".TB_MEMBER." WHERE user='".$login_true."' ");
		$arr['member'] = $db->fetch($res['member']);
		$res['permission'] = $db->select_query("SELECT id, UNIX_TIMESTAMP(c_date_applic) AS c_date_applic2, c_id_applic, c_where, c_why, c_sit, UNIX_TIMESTAMP(c_in_date1)
		                      AS c_in_date12, c_in_time1, UNIX_TIMESTAMP(c_in_date2) AS c_in_date22, c_in_time2, c_car_type, c_id_head, c_id_prime, c_status FROM ".TB_CAR_PERMISSION." WHERE id='".$code_id."'");
		$arr['permission'] = $db->fetch($res['permission']);
		$res['position_a'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id='".$arr['member']['position_id']."'");
		$arr['position_a'] = $db->fetch($res['position_a']);
        $res['degree'] = $db->select_query("SELECT degree_name FROM ".TB_MEMBER_DEGREE." WHERE degree_id='".$arr['member']['degree_id']."'");
		$arr['degree'] = $db->fetch($res['degree']);		

		$res['head'] = $db->select_query("SELECT prefix, fname, lname, position_id, section_id FROM ".TB_MEMBER." WHERE member_id='".$arr['permission']['c_id_head']."' ");
		$arr['head'] = $db->fetch($res['head']);
		$res['position_h'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id='".$arr['head']['position_id']."' ");
		$arr['position_h'] = $db->fetch($res['position_h']);		

		$res['prime'] = $db->select_query("SELECT prefix, fname, lname, position_id ,parties_id FROM ".TB_MEMBER." WHERE member_id='".$arr['permission']['c_id_prime']."' ");
		$arr['prime'] = $db->fetch($res['prime']);	
		$res['position_p'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id='".$arr['prime']['position_id']."' ");
		$arr['position_p'] = $db->fetch($res['position_p']);
		$res["car"] = $db->select_query("SELECT * FROM ".TB_CAR_TYPE." WHERE id='".$arr["permission"]["c_car_type"]."' ");
		$arr["car"] = $db->fetch($res["car"]);
		//$res['position'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id='".$arr['prime']['position_id']."' ");
    	//$arr['position'] = $db->fetch($res['position']);		
		
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
	   window.close();
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
<link href="../../modules/car/css/style.css" rel="stylesheet" type="text/css">
<div  class="Section1" style="position:absolute; left:20pt; top:13pt; width:595.3pt; height:860.9pt; z-index:3;" > 
<p class=MsoNormal align=right style='text-align:right;line-height:normal'><b><span
lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'>แบบ ๓&nbsp;&nbsp;</span></b></p>
<p class=MsoNormal align=center style='text-align:center;line-height:normal'><b><span
lang=TH style='font-size:17.0pt;font-family:"TH SarabunPSK","sans-serif"'>ใบขออนุญาตใช้รถส่วนกลาง</span></b></p>
<p class=MsoNormal align=center style='text-align:center;line-height:normal'><span
style='font-size:3.0pt;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=366 valign=top style='width:274.75pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  115%'><span lang=TH style='font-size:16.0pt;line-height:150%;font-family:
  "TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
  <td width=375 valign=top style='width:281.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  115%'><span lang=TH style='font-size:16.0pt;line-height:150%;font-family:
  "TH SarabunPSK","sans-serif"'>วันที่.................... เดือน.................................... พ.ศ.....................</span></p>
  </td>
 </tr>
 <tr>
  <td width=741 colspan=2 valign=top style='width:555.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  115%'><span lang=TH style='font-size:16.0pt;line-height:150%;font-family:
  "TH SarabunPSK","sans-serif"'>เรียน&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $agenname ;?></span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center;line-height:normal'><b><span
style='font-size:8.0pt;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></b></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=45 valign=top style='width:33.75pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span style='font-size:16.0pt;line-height:200%;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
  <td width=350 valign=top style='width:262.25pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span lang=TH style='font-size:16.0pt;line-height:200%;font-family:
  "TH SarabunPSK","sans-serif"'>ข้าพเจ้า....................................................................................</span></p>
  </td>
  <td width=347 colspan=2 valign=top style='width:260.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span lang=TH style='font-size:16.0pt;line-height:200%;font-family:
  "TH SarabunPSK","sans-serif"'>ตำแหน่ง..................................................................................</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 colspan=4 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  150%'><span lang=TH style='font-size:16.0pt;line-height:150%;font-family:
  "TH SarabunPSK","sans-serif"'>ขออนุญาตใช้รถ (ไปที่หน).................................................................................................................................................................................</span></p>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  150%'><span lang=TH style='font-size:16.0pt;line-height:150%;font-family:
  "TH SarabunPSK","sans-serif"'>.........................................................................................................................................................................................................................</span></p>
  </td>
 </tr>
 <tr>
  <td width=621 colspan=3 valign=top style='width:466.1pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span lang=TH style='font-size:16.0pt;line-height:200%;font-family:
  "TH SarabunPSK","sans-serif"'>เพื่อ.........................................................................................................................................................................</span></p>
  </td>
  <td width=121 valign=top style='width:90.45pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span lang=TH style='font-size:16.0pt;line-height:200%;font-family:
  "TH SarabunPSK","sans-serif"'>มีคนนั่ง.............คน</span></p>
  </td>
 </tr>
 <tr>
  <td width=395 colspan=2 valign=top style='width:296.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span lang=TH style='font-size:16.0pt;line-height:200%;font-family:
  "TH SarabunPSK","sans-serif"'>ไปวันที่..................................................................................................</span></p>
  </td>
  <td width=347 colspan=2 valign=top style='width:260.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span lang=TH style='font-size:16.0pt;line-height:200%;font-family:
  "TH SarabunPSK","sans-serif"'>เวลา........................................................................................</span></p>
  </td>
 </tr>
 <tr>
  <td width=395 colspan=2 valign=top style='width:296.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span lang=TH style='font-size:16.0pt;line-height:200%;font-family:
  "TH SarabunPSK","sans-serif"'>กลับวันที่..................................................................................................</span></p>
  </td>
  <td width=347 colspan=2 valign=top style='width:260.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span lang=TH style='font-size:16.0pt;line-height:200%;font-family:
  "TH SarabunPSK","sans-serif"'>เวลา........................................................................................</span></p>
  </td>
 </tr>
 <tr height=0>
  <td width=45 style='border:none'></td>
  <td width=350 style='border:none'></td>
  <td width=227 style='border:none'></td>
  <td width=121 style='border:none'></td>
 </tr>
</table>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span lang=TH style='font-size:16.0pt;line-height:200%;font-family:
  "TH SarabunPSK","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  ได้ตรวจสอบแล้ว มีรถว่างอยู่&nbsp;&nbsp;จึงเห็นสมควรอนุญาตใช้รถ.........................................................................................................</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span lang=TH style='font-size:16.0pt;line-height:200%;font-family:
  "TH SarabunPSK","sans-serif"'>รถหมายเลขทะเบียน...........................................................................</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:200%'><span style='font-size:16.0pt;line-height:
  200%;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:200%'><span lang=TH style='font-size:16.0pt;
  line-height:200%;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  .........................................................................&nbsp;&nbsp;
  ผู้ขออนุญาต</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:200%'><span lang=TH style='font-size:16.0pt;
  line-height:200%;font-family:"TH SarabunPSK","sans-serif"'>(.........................................................................)</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:150%'><span style='font-size:16.0pt;line-height:
  150%;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:100%'><span style='font-size:16.0pt;line-height:
  100%;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:200%'><span lang=TH style='font-size:16.0pt;
  line-height:200%;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  .........................................................................&nbsp;&nbsp;
  ปลัด หรือผู้แทน</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:200%'><span lang=TH style='font-size:16.0pt;
  line-height:200%;font-family:"TH SarabunPSK","sans-serif"'>(.........................................................................)</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:200%'><span lang=TH style='font-size:16.0pt;
  line-height:200%;font-family:"TH SarabunPSK","sans-serif"'>............./........................................./.................</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  50%'><span style='font-size:16.0pt;line-height:50%;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  150%'><span lang=TH style='font-size:16.0pt;line-height:150%;font-family:
  "TH SarabunPSK","sans-serif"'>..................................................................................................................................................................................................................</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span lang=TH style='font-size:16.0pt;line-height:200%;font-family:
  "TH SarabunPSK","sans-serif"'>(ลงนามผู้มีอำนาจสั่งใช้รถ)........................................................................................................................................................................</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  250%'><span style='font-size:16.0pt;line-height:250%;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-align:center;line-height:
  200%'><span style='font-size:16.0pt;line-height:200%;font-family:"TH SarabunPSK","sans-serif"'>.........................................................................</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:200%'><span lang=TH style='font-size:16.0pt;
  line-height:200%;font-family:"TH SarabunPSK","sans-serif"'>(.........................................................................)</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:200%'><span lang=TH style='font-size:16.0pt;
  line-height:200%;font-family:"TH SarabunPSK","sans-serif"'><b>
           <?php   if ($arr['prime']['parties_id']==1){
				    if(WEB_AGEN_MINI == "อบต.") {
		              $agenname = $arr['position_p']['position_name']."องค์การบริหารส่วนตำบล".WEB_AGEN_NAME ;
		            } else if(WEB_AGEN_MINI == "ทต.") {
		              $agenname = $arr['position_p']['position_name']."เทศมนตรีตำบล".WEB_AGEN_NAME ;
		            }   
		   ?>
           <?php echo $agenname ; ?>
           <?php  } ?>
  </b></span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:200%'><span lang=TH style='font-size:16.0pt;
  line-height:200%;font-family:"TH SarabunPSK","sans-serif"'>............./........................................./.................</span></p>
  </td>
 </tr>
</table>
</div>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div  class="Section2" style="position:absolute; left:20pt; top:10pt; width:595.3pt; height:860.9pt; z-index:3;" > 
<p class=MsoNormal align=right style='text-align:right;line-height:normal'><b><span
lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></b></p>
<p class=MsoNormal align=center style='text-align:center;line-height:normal'><b><span
lang=TH style='font-size:17.0pt;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></b></p>
<p class=MsoNormal align=center style='text-align:center;line-height:normal'><span
style='font-size:3.0pt;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=366 valign=top style='width:274.75pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  115%'><span lang=TH style='font-size:16.0pt;line-height:150%;font-family:
  "TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
  <td width=375 valign=top style='width:281.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  115%'><span lang=TH style='font-size:16.0pt;line-height:150%;font-family:
  "TH SarabunPSK","sans-serif"'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ThaiTimeConvert($arr['permission']['c_date_applic2'],"4",""); ?></b></span></p>
  </td>
 </tr>
 <tr>
  <td width=741 colspan=2 valign=top style='width:555.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  115%'><span lang=TH style='font-size:16.0pt;line-height:150%;font-family:
  "TH SarabunPSK","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
  </td>
 </tr>
</table>
<p class=MsoNormal align=center style='text-align:center;line-height:normal'><b><span
style='font-size:8.0pt;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></b></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=45 valign=top style='width:33.75pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span style='font-size:16.0pt;line-height:200%;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
  <td width=350 valign=top style='width:262.25pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span lang=TH style='font-size:16.0pt;line-height:200%;font-family:
  "TH SarabunPSK","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <b><?php echo $arr['member']['prefix'] ;?><?php echo $arr['member']['fname'] ;?>&nbsp;&nbsp;&nbsp;<?php echo $arr['member']['lname'] ;?></b></span></p>
  </td>
  <td width=347 colspan=2 valign=top style='width:260.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span lang=TH style='font-size:16.0pt;line-height:200%;font-family:
  "TH SarabunPSK","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>
           <?php   if ($arr['member']['parties_id']==1){
				    if(WEB_AGEN_MINI == "อบต.") {
		              $agenname = $arr['position_a']['position_name']."องค์การบริหารส่วนตำบล".WEB_AGEN_NAME ;
		            } else if(WEB_AGEN_MINI == "ทต.") {
		              $agenname = $arr['position_a']['position_name']."เทศมนตรีตำบล".WEB_AGEN_NAME ;
		            }   
		   ?>
           <?php echo $agenname ; ?>
           <?php  } else if ($arr['member']['parties_id']==3){ ?>
           <?php echo $arr['position_a']['position_name'];?><?php echo WEB_AGEN_FULL.WEB_AGEN_NAME ; ?>
           <?php  } else { ?>            
           <?php echo $arr['position_a']['position_name'].$arr['degree']['degree_name'] ;?>&nbsp;&nbsp;</span>
           <?php  } ?>
  </b></span></p>
  </td>
 </tr>
 <tr height="64">
  <td width=742 colspan=4 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  150%'><span lang=TH style='font-size:16.0pt;line-height:150%;font-family:
  "TH SarabunPSK","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <b><?php echo $arr['permission']['c_where'] ;?></b>
  </td>
 </tr>
 <tr>
  <td width=621 colspan=3 valign=top style='width:466.1pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span lang=TH style='font-size:16.0pt;line-height:200%;font-family:
  "TH SarabunPSK","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <b><?php echo $arr['permission']['c_why'] ;?></b></span></p>
  </td>
  <td width=121 valign=top style='width:90.45pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span lang=TH style='font-size:16.0pt;line-height:200%;font-family:
  "TH SarabunPSK","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <b><?php echo $c_sit ;?></b></span></p>
  </td>
 </tr>
 <tr>
  <td width=395 colspan=2 valign=top style='width:296.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span lang=TH style='font-size:16.0pt;line-height:200%;font-family:
  "TH SarabunPSK","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <b><?php  if($arr['permission']['c_in_date12'] != 0){echo ThaiTimeConvert($arr['permission']['c_in_date12'],"3","");} ?>&nbsp;</b></span></p>
  </td>
  <td width=347 colspan=2 valign=top style='width:260.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span lang=TH style='font-size:16.0pt;line-height:200%;font-family:
  "TH SarabunPSK","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <b><?php  if($arr['permission']['c_in_time1'] != 0){ echo $arr['permission']['c_in_time1']."&nbsp;&nbsp;น." ;} ?>&nbsp;</b></span></p>
  </td>
 </tr>
 <tr>
  <td width=395 colspan=2 valign=top style='width:296.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span lang=TH style='font-size:16.0pt;line-height:200%;font-family:
  "TH SarabunPSK","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <b><?php  if($arr['permission']['c_in_date22'] != 0){echo ThaiTimeConvert($arr['permission']['c_in_date22'],"3","");} ?>&nbsp;</b></span></p>
  </td>
  <td width=347 colspan=2 valign=top style='width:260.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span lang=TH style='font-size:16.0pt;line-height:200%;font-family:
  "TH SarabunPSK","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <b><?php  if($arr['permission']['c_in_time2'] != 0){ echo $arr['permission']['c_in_time2']."&nbsp;&nbsp;น." ;} ?>&nbsp;</b></span></p>
  </td>
 </tr>
 <tr height=0>
  <td width=45 style='border:none'></td>
  <td width=350 style='border:none'></td>
  <td width=227 style='border:none'></td>
  <td width=121 style='border:none'></td>
 </tr>
</table>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span lang=TH style='font-size:16.0pt;line-height:200%;font-family:
  "TH SarabunPSK","sans-serif"'>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $arr["car"]["car_name"] ;?></b></span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span lang=TH style='font-size:16.0pt;line-height:200%;font-family:
  "TH SarabunPSK","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $arr["car"]["car_register"]."&nbsp;&nbsp;".$arr["car"]["car_province"] ;?></b></span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:200%'><span style='font-size:16.0pt;line-height:
  200%;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:200%'><span lang=TH style='font-size:16.0pt;
  line-height:200%;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:200%'><span lang=TH style='font-size:16.0pt;
  line-height:200%;font-family:"TH SarabunPSK","sans-serif"'><b><?php echo $arr['member']['prefix'] ;?><?php echo $arr['member']['fname'] ;?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $arr['member']['lname'] ;?></b></span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:150%'><span style='font-size:16.0pt;line-height:
  150%;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:100%'><span style='font-size:16.0pt;line-height:
  100%;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:200%'><span lang=TH style='font-size:16.0pt;
  line-height:200%;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:200%'><span lang=TH style='font-size:16.0pt;
  line-height:200%;font-family:"TH SarabunPSK","sans-serif"'><b><?php echo $arr['head']['prefix'] ;?><?php echo $arr['head']['fname'] ;?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $arr['head']['lname'] ;?></b></span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:200%'><span lang=TH style='font-size:16.0pt;
  line-height:200%;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  50%'><span style='font-size:16.0pt;line-height:50%;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  150%'><span lang=TH style='font-size:16.0pt;line-height:150%;font-family:
  "TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  200%'><span lang=TH style='font-size:16.0pt;line-height:200%;font-family:
  "TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  250%'><span style='font-size:16.0pt;line-height:250%;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-align:center;line-height:
  200%'><span style='font-size:16.0pt;line-height:200%;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:200%'><span lang=TH style='font-size:16.0pt;
  line-height:200%;font-family:"TH SarabunPSK","sans-serif"'><b><?php echo $arr['prime']['prefix'] ;?><?php echo $arr['prime']['fname'] ;?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $arr['prime']['lname'] ;?></b></span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:200%'><span lang=TH style='font-size:16.0pt;
  line-height:200%;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=742 valign=top style='width:556.55pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:200%'><span lang=TH style='font-size:16.0pt;
  line-height:200%;font-family:"TH SarabunPSK","sans-serif"'>&nbsp;</span></p>
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