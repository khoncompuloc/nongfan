<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="psdloc/material/css/style.css" rel="stylesheet" type="text/css">
<script language = "javascript" >

<!--

function printContentDiv(content) {
var printReady = document.getElementById(content);
var txt= "";

if (document.getElementsByTagName != null){
var txtheadTags = document.getElementsByTagName('head');
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
var printWin = window.open('','','width=200,height=200,toolbar=no,location=no,status=no,menubar=yes,scrollbars=no,resizable=yes,,left=40%,top=30%');
printWin.document.open();
printWin.document.write(txt);
printWin.document.close();
printWin.print();
printWin.close();

}
//-->

</script>

</head>
<body>
<?
if($op == "printok"){
     
	if($_SESSION['login_true'] <> "" OR $_SESSION['admin_user'] <> "") {
               

			    $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
                $res['stock_details'] = $db->select_query("SELECT sd_id FROM ".TB_STOCK_SECTION.$budget." WHERE sd_date='".$_GET['sd_date']."' AND sd_logic='0' AND sd_print='0' AND section_id=".$_GET["section_id"]."");
                while($arr['stock_details'] = $db->fetch($res['stock_details']))  {				
//				echo  $arr['stock_details']['sd_id']."<br>" ;
				
			    $db->update_db(TB_STOCK_SECTION.$budget,array(
				    "sd_print"=>"1"
				    )," sd_id='".$arr['stock_details']['sd_id']."'");	
			    }		

				if($_GET['wsd_card'] == 0) {
				$db->update_db(TB_STOCK_DATA,array(
			        "order_requistion"=>"".$_GET['order_requistion'].""
	            	)," section_id='0' ");				
				} else if($_GET['wsd_card'] == 1) {
				$db->update_db(TB_STOCK_DATA,array(
			        "order_requistion"=>"".$_GET['order_requistion'].""
	            	)," section_id='".$_GET['section_id']."'");
				}
				
				

			$ProcessOutput .= "<BR><BR>";
			$ProcessOutput .= "<CENTER><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"><BR>บันทึกการพิมพ์เรียบร้อยแล้ว<BR><BR><BR>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
			echo "<script language=\"JavaScript\">";
            echo "window.opener.location.reload();";
            echo "setTimeout(\"self.close()\",2000);";
//          echo "window.onLoad=reload_view();";
            echo "</script>";

	}else{
	    $PermissionFalse = "ไม่สามารถดเนินการได้" ;
		$ProcessOutput = $PermissionFalse ;
	}
}

//        $db = New DB();
		
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		
        $res['section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." WHERE section_id=".$_GET["section_id"]."");
        $arr['section'] = $db->fetch($res['section']) ;		

		if($wsd_card == 0) {
        $res['order_requis'] = $db->select_query("SELECT order_requistion FROM ".TB_STOCK_DATA." WHERE section_id='0' ");
        $arr['order_requis'] = $db->fetch($res['order_requis']) ;
		$order_requistion = $arr['order_requis']['order_requistion']+1 ;
		} else if($wsd_card == 1) {
        $res['order_requis'] = $db->select_query("SELECT order_requistion FROM ".TB_STOCK_DATA." WHERE section_id=".$_GET["section_id"]."");
        $arr['order_requis'] = $db->fetch($res['order_requis']) ;
		$order_requistion = $arr['order_requis']['order_requistion']+1 ;		
        }
		
		$res['config'] = $db->select_query("SELECT * FROM ".TB_CONFIG."");
           if($agen_mini=="อบต.") {  //แยกคำนำหน้าระหว่าง นายก อบต. กับ นายกเทศมนตรี
              $prefix_nayot="นายก".$agen_full ;
           } else if($agen_mini=="ทต.") {	
              $prefix_nayot="นายกเทศมนตรีตำบล" ;
           } else if($agen_mini=="ทม.") {	
              $prefix_nayot="นายกเทศมนตรี" ;
           }	
   
        $res['sd_date'] = $db->select_query("SELECT sd_date, UNIX_TIMESTAMP(sd_date) AS thaidate FROM ".TB_STOCK_SECTION.$budget." WHERE sd_date='".$_GET["sd_date"]."' GROUP BY sd_date ");
        $arr['sd_date'] = $db->fetch($res['sd_date']) ;
		$res['admin'] = $db->select_query("SELECT member_id ,elect ,position_id_elect FROM ".TB_ADMIN." WHERE level='4' AND section_id =".$_GET["section_id"]."");
        $arr['admin'] = $db->fetch($res['admin']) ;
        $res['member'] = $db->select_query("SELECT prefix, fname, lname, position_id, section_id  FROM ".TB_MEMBER." WHERE member_id=".$arr['admin']['member_id']."");
        $arr['member'] = $db->fetch($res['member']) ;	
        $res['position'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id=".$arr['member']['position_id']."");
        $arr['position'] = $db->fetch($res['position']) ; 

        //ต้องแต่งตั้งเป็นเจ้าหน้าที่พัสดุก่อน ใน admin

        $res['psd_admin_section'] = $db->select_query("SELECT member_id, section_id, elect, position_id_elect FROM ".TB_ADMIN." WHERE level='3' AND section_id =".$_GET["section_id"]."");		
   		$arr['psd_admin_section'] = $db->fetch($res['psd_admin_section']) ;
		$arr['psd_admin_rows'] = $db->rows($res['psd_admin_section']) ;

        if($arr['psd_admin_rows']){
		$Vmember_id = $arr['psd_admin_section']['member_id'] ;
		$Velect = $arr['psd_admin_section']['elect'] ;
		$Vposition_id_elect = $arr['psd_admin_section']['position_id_elect'] ;
		} else {
        $res['psd_admin'] = $db->select_query("SELECT member_id, section_id, elect, position_id_elect FROM ".TB_ADMIN." WHERE level='3' AND section_id='0' ");		
        $arr['psd_admin'] = $db->fetch($res['psd_admin']) ;
        $Vmember_id = $arr['psd_admin']['member_id'] ;	
		$Velect = $arr['psd_admin']['elect'] ;
		$Vposition_id_elect = $arr['psd_admin']['position_id_elect'] ;		
		}
    		
        $res['member_psd'] = $db->select_query("SELECT prefix, fname, lname, position_id, section_id FROM ".TB_MEMBER." WHERE member_id=".$Vmember_id." ");
        $arr['member_psd'] = $db->fetch($res['member_psd']) ; 	
        $res['position_psd'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id=".$arr['member_psd']['position_id']."");
        $arr['position_psd'] = $db->fetch($res['position_psd']) ;		


if(!$ProcessOutput){
?>
<center>
<a href="" onClick="javascript:self.close();"><b>ปิดหน้านี้</b><img src="images/close.png" alt="ปิดหน้านี้" align="middle" border="0" /></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:printContentDiv('lblPrint');"><img src="images/printer.png" alt="พิมพ์" align="middle" border="0" /><b>พิมพ์หน้านี้</b></a>&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="?folder=material&file=printit&op=printok&sd_date=<?=$_GET["sd_date"];?>&section_id=<?=$_GET["section_id"];?>&order_requistion=<?=$order_requistion ;?>&wsd_card=<?=$_GET["wsd_card"];?>"><b>พิมพ์เรียบร้อยแล้ว</b> <img src="images/ok.png" alt="พิมพ์" align="middle" border="0" /></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="" onClick="javascript:self.close();"><b>ปิดหน้านี้</b><img src="images/close.png" alt="ปิดหน้านี้" align="middle" border="0" /></a>
</center>
<p class="MsoNormal" align="center" style="text-align:center"><b>
<span lang="TH" style='font-size:14.0pt;font-family:"TH SarabunPSK"'>ใบเบิกจ่ายพัสดุ<?=$Velect ;?></span></b>
</p>

<p class="MsoNormal" align=center style='text-align:center'><b><span
style='font-size:8.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=233 valign=top style='width:174.6pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>ที่&nbsp; </span>
  <span style='font-size:12.0pt;font-family:"TH SarabunPSK"'><?=$order_requistion ;?>&nbsp;/&nbsp;25<?=$budget ;?></span></p>
  </td>
  <td width=146 valign=top style='width:109.8pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><b><span style='font-size:12.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=319 valign=top style='width:239.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
   <?=$agen_full ;?><?=$agen_name ;?></span>
  </p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;mso-yfti-lastrow:yes'>
  <td width=233 valign=top style='width:174.6pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><b><span style='font-size:12.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=146 valign=top style='width:109.8pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><b><span style='font-size:12.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=319 valign=top style='width:239.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  ต.<?=$district ;?>&nbsp;อ.<?=$amphur ;?>&nbsp;จ.<?=$province ;?></span></p>
  </td>
 </tr>
</table>

<p class="MsoNormal" align=center style='text-align:center'><b><span
style='font-size:8.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
 mso-border-insideh:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><b><span
  style='font-size:12.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  <?=ThaiTimeConvert($arr['sd_date']['thaidate'],"2",""); //วัน เดือน ปี ?></span></p>
  </td>
 </tr>
</table>

<p class="MsoNormal" align=center style='text-align:center'><b><span
style='font-size:8.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
 mso-border-insideh:.5pt solid windowtext;mso-border-insidev:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=698 valign=top style='width:523.8pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
     เรียน&nbsp;&nbsp;&nbsp;<?=$prefix_nayot ;?><?=$agen_name ;?>
  </span></p>
  </td>
 </tr>
</table>

<p class="MsoNormal" align=center style='text-align:center'><b><span
style='font-size:8.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=79 valign=top style='width:59.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><span
  style='font-size:12.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
  <td width=619 valign=top style='width:464.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
    ด้วยข้าพเจ้า&nbsp;&nbsp;<?=$arr['member']['prefix'];?><?=$arr['member']['fname'];?>
  &nbsp;&nbsp;<?=$arr['member']['lname'];?>&nbsp;&nbsp;ตำแหน่ง&nbsp;&nbsp;
  <?
  if($arr['admin']['elect'] == 0) {
    echo $arr['position']['position_name'];
  } else if($arr['admin']['elect']==1) {
    $res['position_elect'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id=".$arr['admin']['position_id_elect']."");
    $arr['position_elect'] = $db->fetch($res['position_elect']) ; 
     echo $arr['position']['position_name']."&nbsp;&nbsp;ปฏิบัติหน้าที่&nbsp;&nbsp;".$arr['position_elect']['position_name']."";
  } else if($arr['admin']['elect']==2) {
    $res['position_elect'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id=".$arr['admin']['position_id_elect']."");
    $arr['position_elect'] = $db->fetch($res['position_elect']) ; 
     echo $arr['position']['position_name']."&nbsp;&nbsp;รักษาราชการแทน&nbsp;&nbsp;".$arr['position_elect']['position_name']."";
  }
  
  ?>
  &nbsp;&nbsp;สังกัด&nbsp;&nbsp;<?=$arr['section']['section_name'] ;?>
  </span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;mso-yfti-lastrow:yes'>
  <td width=698 colspan=2 valign=top style='width:523.8pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
   มีความประสงค์จะขอเบิก&nbsp;พัสดุ&nbsp;เพื่อดำเนินการใช้ในงานสำนักงาน&nbsp;ดังนี้
  </span></p>
  </td>
 </tr>
</table>

<p class="MsoNormal" align=center style='text-align:center'><b><span
style='font-size:8.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='margin-left:-3.6pt;border-collapse:collapse;mso-yfti-tbllook:480;
 mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 
<?
    $count = 0 ;
          $res['stock_details'] = $db->select_query("SELECT sh_id, sum(sd_amount) as total  FROM ".TB_STOCK_SECTION.$budget." WHERE sd_date='".$arr['sd_date']['sd_date']."' AND sd_logic='0' AND sd_print='0' AND section_id=".$_GET["section_id"]." GROUP BY sh_id ");
          while($arr['stock_details'] = $db->fetch($res['stock_details']))  {
    $count = $count + 1 ;
          $res['stock_head'] = $db->select_query("SELECT sh_name, sh_diff_name, sh_unit FROM ".TB_STOCK_HEAD." WHERE sh_id=".$arr['stock_details']['sh_id']."");
          $arr['stock_head'] = $db->fetch($res['stock_head']) ; 
		  empty($arr['stock_head']['sh_diff_name'])?$sh_diff_name="":$sh_diff_name="(".$arr['stock_head']['sh_diff_name'].")" ; 
?>

 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=70 valign=top style='width:52.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=right style='text-align:right'><span
  style='font-size:12.0pt;font-family:"TH SarabunPSK"'><?=$count ;?></span></p>
  </td>
  <td width=38 valign=top style='width:28.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><b>
  <span style='font-size:12.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=348 valign=top style='width:261.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['stock_head']['sh_name'] ;?>&nbsp;<?=$sh_diff_name ;?>
  </span></p>
  </td>
  <td width=65 valign=top style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" style='text-align:justify'><span lang="TH" style='font-size:
  10.0pt;font-family:"TH SarabunPSK"'>จำนวน</span></p>
  </td>
  <td width=79 valign=top style='width:59.2pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><span
  style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['stock_details']['total'] ;?></span></p>
  </td>
  <td width=91 valign=top style='width:68.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['stock_head']['sh_unit'] ;?></span></p>
  </td>
 </tr>
<? 
 }
?>
</table>

<p class="MsoNormal" align=center style='text-align:center'><b><span
style='font-size:12.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>


<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=691
 style='width:518.4pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=79 valign=top style='width:59.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><b><span
  style='font-size:12.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=612 valign=top style='width:459.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  จึงเรียนมาเพื่อโปรดทราบและพิจารณา</span></p>
  </td>
 </tr>
</table>

<p class="MsoNormal" align=center style='text-align:center'><b><span
style='font-size:8.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>

<p class="MsoNormal" align=center style='text-align:center'><b><span
style='font-size:8.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><b><span
  style='font-size:12.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p></td>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
   ลงชื่อ......................................................ผู้เบิก</span></p></td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><b><span
  style='font-size:12.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'>
  <span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  (&nbsp;<?=$arr['member']['prefix'];?><?=$arr['member']['fname'];?>&nbsp;&nbsp;<?=$arr['member']['lname'];?>&nbsp;)
  </span></p></td>
 </tr>
 <?
  if($arr['admin']['elect']==0) {
 ?>
 <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes'>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><b><span
  style='font-size:12.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['position']['position_name'];?></span></p></td>
 </tr>
 <?
 } else if($arr['admin']['elect']==1) {
 
 ?>
  <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes'>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><b><span
  style='font-size:12.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['position']['position_name'];?>&nbsp;ปฏิบัติหน้าที่</span></p></td>
 </tr>
   <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes'>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><b><span
  style='font-size:12.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['position_elect']['position_name'];?></span></p></td>
 </tr>
 <?
 } else if($arr['admin']['elect']==2) {
 
 ?>
  <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes'>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><b><span
  style='font-size:12.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['position']['position_name'];?>&nbsp;รักษาราชการแทน</span></p></td>
 </tr>
   <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes'>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><b><span
  style='font-size:12.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['position_elect']['position_name'];?></span></p></td>
 </tr>
 <?
 }
 ?>
</table>

<p class="MsoNormal" align=center style='text-align:center'><b><span
style='font-size:8.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>

<p class="MsoNormal" align=center style='text-align:center'><b><span
style='font-size:8.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt;mso-border-insideh:
 .5pt solid windowtext;mso-border-insidev:.5pt solid windowtext'>

 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=349 valign=top style='width:261.9pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span style='font-size:12.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  <p class="MsoNormal"><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  &nbsp;ข้าพเจ้า&nbsp;ได้ตรวจสอบใบเบิกแล้ว</span></p>
  <p class="MsoNormal"><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  &nbsp;เห็นว่าถูกต้อง</span></p>
  <p class="MsoNormal"><span style='font-size:12.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  <p class="MsoNormal"><span style='font-size:12.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
    ลงชื่อ..........................................................ผู้จ่ายพัสดุ</span></p>
  <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  (&nbsp;<?=$arr['member_psd']['prefix'];?><?=$arr['member_psd']['fname']; ?>&nbsp;&nbsp;<?=$arr['member_psd']['lname'];?>&nbsp;)</span></p>
 <?
  if($Velect == 0) { //ปกติ
 ?>  
   <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['position_psd']['position_name']; ?></span></p>
  <?
 } else if($Velect == 1) { //ปฏิบัติหน้าที่
        $res['position_elect_psd'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id=".$Vposition_id_elect."");
        $arr['position_elect_psd'] = $db->fetch($res['position_elect_psd']) ;  		 
  ?> 
   <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['position_psd']['position_name']; ?>&nbsp;ปฏิบัติหน้าที่</span></p>  
   <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['position_elect_psd']['position_name']; ?></span></p>
<? 
 
 } else if($Velect == 2) { //รักษาราชการแทน
        $res['position_elect_psd'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id=".$Vposition_id_elect."");
        $arr['position_elect_psd'] = $db->fetch($res['position_elect_psd']) ;  		 
  ?> 
   <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['position_psd']['position_name']; ?>&nbsp;รักษาราชการแทน</span></p>  
   <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['position_elect_psd']['position_name']; ?></span></p>
<? 
} 
?>
  
   </td>
  <td width=349 valign=top style='width:261.9pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" style='margin-left:6.75pt'><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  - พิจารณาแล้ว</span></p>
  <p class="MsoNormal" style='margin-left:6.75pt'><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'><span style='mso-spacerun:yes'>
   (&nbsp;&nbsp;)&nbsp;อนุมัติ</span></p>
  <p class="MsoNormal" style='margin-left:6.75pt'><span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'><span style='mso-spacerun:yes'>
   (&nbsp;&nbsp;)&nbsp;ไม่อนุมัติ</span></p>
  <p class="MsoNormal" style='margin-left:6.75pt'><span style='font-size:12.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  <p class="MsoNormal" style='margin-left:6.75pt'><span style='font-size:12.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  <p class="MsoNormal" align=center style='margin-left:6.75pt;text-align:center'>
  <span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
    ลงชื่อ.........................................................ผู้อนุมัติ</span></p>
<?
        $queryString = "นายก" ;  //ถ้าไม่ใช้นายกให้เลือกเหมือนอนุญาตใช้รถ
        $res['position_nayot_search'] = $db->select_query("SELECT position_id FROM ".TB_MEMBER_POSITION." WHERE position_name LIKE '$queryString%'");
        $arr['position_nayot_search'] = $db->fetch($res['position_nayot_search']) ;  	
		$res['member_nayot'] = $db->select_query("SELECT prefix, fname, lname, position_id, parties_id FROM ".TB_MEMBER." WHERE position_id=".$arr['position_nayot_search']['position_id']." AND parties_id=1 ");
        $arr['member_nayot'] = $db->fetch($res['member_nayot']) ;	
        $res['position_nayot'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id=".$arr['member_nayot']['position_id']."");
        $arr['position_nayot'] = $db->fetch($res['position_nayot']) ;  	
        $arr['member_nayot_row'] = $db->rows($res['member_nayot']) ;		
        
		if($arr['member_nayot_row']) {  //ตรงนี้ไว้เพื่อมีรักษาราชการแทนนายก
?>
  <p class="MsoNormal" align=center style='margin-left:6.75pt;text-align:center'>
  <span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  (&nbsp;<?=$arr['member_nayot']['prefix'];?><?=$arr['member_nayot']['fname']; ?>&nbsp;&nbsp;<?=$arr['member_nayot']['lname'];?>&nbsp;)</span></p>
  <p class="MsoNormal" align=center style='margin-left:6.75pt;text-align:center'>
  <span lang="TH" style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  <?=$prefix_nayot ;?><?=$agen_name ;?></span></p>
  <? } ?>
  </td>
 </tr>
</table>


<br><br>
<center>
<a href="" onClick="javascript:self.close();"><b>ปิดหน้านี้</b><img src="images/close.png" alt="ปิดหน้านี้" align="middle" border="0" /></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:printContentDiv('lblPrint');"><img src="images/printer.png" alt="พิมพ์" align="middle" border="0" /><b>พิมพ์หน้านี้</b></a>&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="?folder=material&file=printit&op=printok&sd_date=<?=$_GET["sd_date"];?>&section_id=<?=$_GET["section_id"];?>&order_requistion=<?=$order_requistion ;?>"><b>พิมพ์เรียบร้อยแล้ว</b> <img src="images/ok.png" alt="พิมพ์" align="middle" border="0" /></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="" onClick="javascript:self.close();"><b>ปิดหน้านี้</b><img src="images/close.png" alt="ปิดหน้านี้" align="middle" border="0" /></a>
</center>


<!---////////////////////////////////////////////////////// ส่วนที่พิมพ์  ///////////////////////////////////////////////////////--->

<div id="lblPrint" style=" display:none" >
<link href="psdloc/material/css/style.css" rel="stylesheet" type="text/css">
<p class="MsoNormal" align="center" style="text-align:center"><b>
<span lang="TH" style='font-size:18.0pt;font-family:"TH SarabunPSK"'>ใบเบิกจ่ายพัสดุ</span></b>
</p>

<p class="MsoNormal" align=center style='text-align:center'><b><span
style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=233 valign=top style='width:174.6pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>ที่&nbsp; </span>
  <span style='font-size:16.0pt;font-family:"TH SarabunPSK"'><?=$order_requistion ;?>&nbsp;/&nbsp;25<?=$budget ;?></span></p>
  </td>
  <td width=146 valign=top style='width:109.8pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><b><span style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=319 valign=top style='width:239.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
   <?=$agen_full ;?><?=$agen_name ;?></span>
  </p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;mso-yfti-lastrow:yes'>
  <td width=233 valign=top style='width:174.6pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><b><span style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=146 valign=top style='width:109.8pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><b><span style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=319 valign=top style='width:239.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
    ต.<?=$district ;?>&nbsp;อ.<?=$amphur ;?>&nbsp;จ.<?=$province ;?></span></p>
  </td>
 </tr>
</table>

<p class="MsoNormal" align=center style='text-align:center'><b><span
style='font-size:8.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
 mso-border-insideh:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><b><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  <?=ThaiTimeConvert($arr['sd_date']['thaidate'],"2",""); //วัน เดือน ปี ?></span></p>
  </td>
 </tr>
</table>

<p class="MsoNormal" align=center style='text-align:center'><b><span
style='font-size:8.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
 mso-border-insideh:.5pt solid windowtext;mso-border-insidev:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=698 valign=top style='width:523.8pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
     เรียน&nbsp;&nbsp;&nbsp;<?=$prefix_nayot ;?><?=$agen_name ;?>
  </span></p>
  </td>
 </tr>
</table>

<p class="MsoNormal" align=center style='text-align:center'><b><span
style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
<!--  <td width=79 valign=top style='width:59.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td> -->
  <td width=698 valign=top style='width:523.8pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ด้วยข้าพเจ้า&nbsp;&nbsp;<?=$arr['member']['prefix'];?><?=$arr['member']['fname'];?>
  &nbsp;&nbsp;<?=$arr['member']['lname'];?>&nbsp;&nbsp;ตำแหน่ง&nbsp;&nbsp;
  <?
  if($arr['admin']['elect'] == 0) {
    echo $arr['position']['position_name'];
  } else if($arr['admin']['elect']==1) {
    $res['position_elect'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id=".$arr['admin']['position_id_elect']."");
    $arr['position_elect'] = $db->fetch($res['position_elect']) ; 
     echo $arr['position']['position_name']."&nbsp;&nbsp;ปฏิบัติหน้าที่&nbsp;&nbsp;".$arr['position_elect']['position_name']."";
  } else if($arr['admin']['elect']==2) {
    $res['position_elect'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id=".$arr['admin']['position_id_elect']."");
    $arr['position_elect'] = $db->fetch($res['position_elect']) ; 
     echo $arr['position']['position_name']."&nbsp;&nbsp;รักษาราชการแทน&nbsp;&nbsp;".$arr['position_elect']['position_name']."";
  }
  
  ?>
  &nbsp;&nbsp;สังกัด&nbsp;&nbsp;<?=$arr['section']['section_name'] ;?>&nbsp;&nbsp;มีความประสงค์จะขอเบิก&nbsp;พัสดุ&nbsp;เพื่อดำเนินการใช้ในงานสำนักงาน&nbsp;ดังนี้
  </span></p>
  </td>
 </tr>
<!-- 
 <tr style='mso-yfti-irow:1;mso-yfti-lastrow:yes'>
  <td width=698 colspan=2 valign=top style='width:523.8pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
   มีความประสงค์จะขอเบิก&nbsp;พัสดุ&nbsp;เพื่อดำเนินการใช้ในงานสำนักงาน&nbsp;ดังนี้
  </span></p>
  </td>
 </tr>
 -->
</table>

<p class="MsoNormal" align=center style='text-align:center'><b><span
style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='margin-left:-3.6pt;border-collapse:collapse;mso-yfti-tbllook:480;
 mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 
<?
    $count = 0 ;
          $res['stock_details'] = $db->select_query("SELECT sh_id, sum(sd_amount) as total  FROM ".TB_STOCK_SECTION.$budget." WHERE sd_date='".$arr['sd_date']['sd_date']."' AND sd_logic='0' AND sd_print='0' AND section_id=".$_GET["section_id"]." GROUP BY sh_id ");
          while($arr['stock_details'] = $db->fetch($res['stock_details']))  {
    $count = $count + 1 ;
          $res['stock_head'] = $db->select_query("SELECT sh_name, sh_diff_name, sh_unit FROM ".TB_STOCK_HEAD." WHERE sh_id=".$arr['stock_details']['sh_id']."");
          $arr['stock_head'] = $db->fetch($res['stock_head']) ; 
		  empty($arr['stock_head']['sh_diff_name'])?$sh_diff_name="":$sh_diff_name="(".$arr['stock_head']['sh_diff_name'].")" ; 		  
?>

 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=70 valign=top style='width:52.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=right style='text-align:right'><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK"'><?=$count ;?></span></p>
  </td>
  <td width=38 valign=top style='width:28.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><b>
  <span style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=348 valign=top style='width:261.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['stock_head']['sh_name'] ;?>&nbsp;<?=$sh_diff_name ;?>
  </span></p>
  </td>
  <td width=65 valign=top style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" style='text-align:justify'><span lang="TH" style='font-size:
  16.0pt;font-family:"TH SarabunPSK"'>จำนวน</span></p>
  </td>
  <td width=79 valign=top style='width:59.2pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['stock_details']['total'] ;?></span></p>
  </td>
  <td width=91 valign=top style='width:68.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['stock_head']['sh_unit'] ;?></span></p>
  </td>
 </tr>
 <? 
 } 
          while($count < 13)  {
	$count = $count + 1 ;  
 ?>
 

 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=70 valign=top style='width:52.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=right style='text-align:right'><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK"'><?//=$count ;?></span></p>
  </td>
  <td width=38 valign=top style='width:28.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><b>
  <span style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=348 valign=top style='width:261.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  &nbsp;</span></p>
  </td>
  <td width=65 valign=top style='width:48.8pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" style='text-align:justify'><span lang="TH" style='font-size:
  16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  </td>
  <td width=79 valign=top style='width:59.2pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  &nbsp;</span></p>
  </td>
  <td width=91 valign=top style='width:68.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  &nbsp;</span></p>
  </td>
 </tr>
<? 
 }
?>
</table>

<p class="MsoNormal" align=center style='text-align:center'><b><span
style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>

<p class="MsoNormal" align=center style='text-align:center'><b><span
style='font-size:8.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=691
 style='width:518.4pt;border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=79 valign=top style='width:59.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><b><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=612 valign=top style='width:459.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  จึงเรียนมาเพื่อโปรดทราบและพิจารณา</span></p>
  </td>
 </tr>
</table>

<p class="MsoNormal" align=center style='text-align:center'><b><span
style='font-size:10.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>

<p class="MsoNormal" align=center style='text-align:center'><b><span
style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><b><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p></td>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
   ลงชื่อ......................................................ผู้เบิก</span></p></td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><b><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'>
  <span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  (&nbsp;<?=$arr['member']['prefix'];?><?=$arr['member']['fname'];?>&nbsp;&nbsp;<?=$arr['member']['lname'];?>&nbsp;)
  </span></p></td>
 </tr>
 <?
  if($arr['admin']['elect']==0) {
 ?>
 <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes'>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><b><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['position']['position_name'];?></span></p></td>
 </tr>
 <?
 } else if($arr['admin']['elect']==1) {
        $res['position_elect'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id=".$arr['admin']['position_id_elect']."");
        $arr['position_elect'] = $db->fetch($res['position_elect']) ;  		 
 
 ?>
  <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes'>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><b><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['position']['position_name'];?>&nbsp;ปฏิบัติหน้าที่</span></p></td>
 </tr>
   <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes'>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><b><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['position_elect']['position_name'];?></span></p></td>
 </tr>
 <?
 } else if($arr['admin']['elect']==2) {
        $res['position_elect'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id=".$arr['admin']['position_id_elect']."");
        $arr['position_elect'] = $db->fetch($res['position_elect']) ;  		 
 
 ?>
  <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes'>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><b><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['position']['position_name'];?>&nbsp;รักษาราชการแทน</span></p></td>
 </tr>
   <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes'>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><b><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>
  </td>
  <td width=349 valign=top style='width:261.9pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['position_elect']['position_name'];?></span></p></td>
 </tr>
 <?
 }
 ?>
</table>

<p class="MsoNormal" align=center style='text-align:center'><b><span
style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>

<p class="MsoNormal" align=center style='text-align:center'><b><span
style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></b></p>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt;mso-border-insideh:
 .5pt solid windowtext;mso-border-insidev:.5pt solid windowtext'>

 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
  <td width=349 valign=top style='width:261.9pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal"><span style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  <p class="MsoNormal"><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  &nbsp;ข้าพเจ้า&nbsp;ได้ตรวจสอบใบเบิกแล้ว</span></p>
  <p class="MsoNormal"><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  &nbsp;เห็นว่าถูกต้อง</span></p>
  <p class="MsoNormal"><span style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  <p class="MsoNormal"><span style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  <p class="MsoNormal"><span style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  <p class="MsoNormal" align=center style='text-align:center'><span lang="TH"
  style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
    ลงชื่อ..........................................................ผู้จ่ายพัสดุ</span></p>
  <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  (&nbsp;<?=$arr['member_psd']['prefix'];?><?=$arr['member_psd']['fname']; ?>&nbsp;&nbsp;<?=$arr['member_psd']['lname'];?>&nbsp;)</span></p>
 <?
  if($Velect==0) { //ปกติ
 ?>  
   <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['position_psd']['position_name']; ?></span></p>
  <?
 } else if($Velect==1) { //ปฏิบัติหน้าที่
        $res['position_elect_psd'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id=".$Vposition_id_elect."");
        $arr['position_elect_psd'] = $db->fetch($res['position_elect_psd']) ;  		 
  ?> 
   <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['position_psd']['position_name']; ?>&nbsp;ปฏิบัติหน้าที่</span></p>  
   <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['position_elect_psd']['position_name']; ?></span></p>
<? 
 
 } else if($Velect==2) { //รักษาราชการแทน
        $res['position_elect_psd'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id=".$Vposition_id_elect."");
        $arr['position_elect_psd'] = $db->fetch($res['position_elect_psd']) ;  		 
  ?> 
   <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['position_psd']['position_name']; ?>&nbsp;รักษาราชการแทน</span></p>  
   <p class="MsoNormal" align=center style='text-align:center'><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  <?=$arr['position_elect_psd']['position_name']; ?></span></p>
<? 
} 
?>
    
   </td>
  <td width=349 valign=top style='width:261.9pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class="MsoNormal" style='margin-left:6.75pt'><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  - พิจารณาแล้ว</span></p>
  <p class="MsoNormal" style='margin-left:6.75pt'><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'><span style='mso-spacerun:yes'>
   (&nbsp;&nbsp;)&nbsp;อนุมัติ</span></p>
  <p class="MsoNormal" style='margin-left:6.75pt'><span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'><span style='mso-spacerun:yes'>
   (&nbsp;&nbsp;)&nbsp;ไม่อนุมัติ</span></p>
  <p class="MsoNormal" style='margin-left:6.75pt'><span style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  <p class="MsoNormal" style='margin-left:6.75pt'><span style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  <p class="MsoNormal" style='margin-left:6.75pt'><span style='font-size:16.0pt;font-family:"TH SarabunPSK"'>&nbsp;</span></p>
  <p class="MsoNormal" align=center style='margin-left:6.75pt;text-align:center'>
  <span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
    ลงชื่อ.........................................................ผู้อนุมัติ</span></p>
<?
        $queryString = "นายก" ;
        $res['position_nayot_search'] = $db->select_query("SELECT position_id FROM ".TB_MEMBER_POSITION." WHERE position_name LIKE '$queryString%'");
        $arr['position_nayot_search'] = $db->fetch($res['position_nayot_search']) ;  	
		$res['member_nayot'] = $db->select_query("SELECT prefix, fname, lname, position_id, parties_id FROM ".TB_MEMBER." WHERE position_id=".$arr['position_nayot_search']['position_id']." AND parties_id=1 ");
        $arr['member_nayot'] = $db->fetch($res['member_nayot']) ;	
        $res['position_nayot'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id=".$arr['member_nayot']['position_id']."");
        $arr['position_nayot'] = $db->fetch($res['position_nayot']) ;  			

?>
  <p class="MsoNormal" align=center style='margin-left:6.75pt;text-align:center'>
  <span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  (&nbsp;<?=$arr['member_nayot']['prefix'];?><?=$arr['member_nayot']['fname']; ?>&nbsp;&nbsp;<?=$arr['member_nayot']['lname'];?>&nbsp;)</span></p>
  <p class="MsoNormal" align=center style='margin-left:6.75pt;text-align:center'>
  <span lang="TH" style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  <?=$prefix_nayot ;?><?=$agen_name ;?></span></p>
  </td>
 </tr>
</table>

</div>
<?

}else{
	echo $ProcessOutput ;
}
?>
</body>
</html>