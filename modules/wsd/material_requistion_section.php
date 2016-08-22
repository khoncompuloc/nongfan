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
  if(!$ProcessOutput AND $op == "material_requistion_section_add" AND $action == "add" AND $data == "voi_add"){
	
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);	                
					
					 $boss_id = 1 ;
					 //$section_no = $_POST['section_id'] ;
					 
					 $res['stock_requistion'] = $db->select_query("SELECT MAX(UNIX_TIMESTAMP(srs_date)) AS thaidate ,MAX(srs_date) AS srsdate FROM ".TB_STOCK_REQUISTION_SECTION." WHERE section_id='".$_POST['section_id']."'");
	                 $arr['stock_requistion'] = $db->fetch($res['stock_requistion']);                     
                     
					 $date_new = ThaiTimeConvert($_POST['date_timestamp'],"","") ;
					 $date_old = ThaiTimeConvert($arr['stock_requistion']['thaidate'],"","") ;
					 
					 if($_POST['ss_date'] < $arr['stock_requistion']['srsdate']) {
		                echo "<script language='javascript'>" ;
		                echo "alert('ต้องขออภัย วันที่ใบเบิกใหม่ ".$date_new."  น้อยกว่า วันที่  ".$date_old."  ใบเบิกล่าสุด')" ;
		                echo "</script>" ;
		                //echo "<script language='javascript'>javascript:history.go(-2)</script>";
						echo "<script type='text/javascript'>window.location.href = \"index.php?compu=wsd&loc=material_requistion_section\";</script>" ;
						exit();
					 } else {					 

                     $db->add_db(TB_STOCK_REQUISTION_SECTION,array(
				     "srs_number"=>"".$_POST['srs_number']."",
					 "srs_date"=>"".$_POST['ss_date']."",
					 "type_id"=>"".$_POST['type_id']."",
				     "section_id"=>"".$_POST['section_id']."",
					 "member_id"=>"".$_POST['member_id']."",
					 "boss_id"=>"".$boss_id.""
					 ));	
					 $count	= $_POST['count_no'] ;
                     for($number=1;$number<$count;$number++)
                     {

					  	$db->update_db(TB_STOCK_SECTION,array(
			            "srs_number"=>"".$_POST['srs_number'].""
	            	    )," ss_id='".$_POST['ss_id_'.$number]."'");
						
						//echo "sc_id_".$number."=".$_POST['sc_id_'.$number]."<br>";
					 }
                        $db->update_db(TB_STOCK_DATA,array(
			            "requistion_number"=>"".$_POST['srs_number'].""
	            	    )," section_id='".$_POST['section_id']."'");                    					 
					 
				    $ProcessOutput = "<br><br><center>ได้ทำการบันทึกข้อมูลประเภทย่อยวัสดุเรียบแล้ว" ;
					$ProcessOutput .= "  OK.</center>" ;
					echo "srs_number=".$_POST['srs_number']."<br>";
					echo "ss_date=".$_POST['ss_date']."<br>";
					echo "section_id=".$_POST['section_id']."<br>";
					echo "member_id=".$_POST['member_id']."<br>";
					echo "count=".$count."<br>";
					echo $ProcessOutput ;
					
					echo "<script type='text/javascript'>window.location.href = \"index.php?compu=wsd&loc=material_requistion_section_print\";</script>" ;
					exit();
					
					 }

} else	if(!$ProcessOutput AND $op == "material_requistion_section_start" AND $action == "old" AND $data == "voi") {
	                $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

					$res['stock_section'] = $db->select_query("SELECT ss_id ,shs_id ,UNIX_TIMESTAMP(ss_date) AS ssdate ,member_id ,ss_price ,ss_amount ,ss_note FROM ".TB_STOCK_SECTION." WHERE ss_date='".$_POST['ss_date']."' AND member_id='".$_POST['member_id']."' AND ss_logic='0' AND ss_requistion='0' AND section_id='".$_SESSION['section_id']."' AND srs_number='0' ORDER BY ss_id");
										
					$res['mame_section'] = $db->select_query("SELECT section_name FROM ".TB_MEMBER_SECTION." WHERE section_id='".$_SESSION['section_id']."'") ;
					$arr['mame_section'] = $db->fetch($res['mame_section']) ;
					
					$res['mame_member'] = $db->select_query("SELECT member_id ,prefix ,fname ,lname FROM ".TB_MEMBER." WHERE member_id='".$_POST['member_id']."'") ;
					$arr['mame_member'] = $db->fetch($res['mame_member']) ;
?>
<link href="modules/wsd/css/style.css" rel="stylesheet" type="text/css">
<form name="frmMain<?php echo $count ;?>" id="frmMain<?php echo $count ;?>" method="post" action="?compu=wsd&loc=material_requistion_section&op=material_requistion_section_add&action=add&data=voi_add" enctype="multipart/form-data">   
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="5%" height="30"></td>
    <td width="20%" align="right">ใบเบิกที่ :</td>
    <td width="75%" align="left">&nbsp;&nbsp;<input type="text" value="<?php echo $_POST['srs_number'] ;?>" size="5" disabled><b> /25<?php echo WEB_BUDGET ;?></b>
	 <input type="hidden" name="srs_number" id="srs_number" value="<?php echo $_POST['srs_number'] ;?>">
     <input type="hidden" name="member_id" id="member_id" value="<?php echo $_POST['member_id'] ;?>">
	 <input type="hidden" name="type_id" id="type_id" value="<?php echo $_POST['type_id'] ;?>">
	 <input type="hidden" name="section_id" id="section_id" value="<?php echo $_POST['section_id'] ;?>">
	</td>	    
</tr>
<tr>
    <td width="5%" height="30"></td>
    <td width="20%" align="right">วัน เดือน ปี :</td>
    <td width="75%" align="left">&nbsp;&nbsp;<input type="text" size="11" value="<?php echo ThaiTimeConvert($_POST['ss_date_timestemp'],"5","") ;?>" disabled>
	<input type="hidden" name="ss_date" id="ss_date" value="<?php echo $_POST['ss_date'] ;?>">
	<input type="hidden" name="date_timestamp" id="date_timestamp" size="12" value="<?php echo $_POST['ss_date_timestemp'] ;?>">
	</td>	    
</tr>
<tr>
    <td width="5%" height="30"></td>
    <td width="20%" align="right">ส่วนงาน/กอง :</td>
    <td width="75%" align="left">&nbsp;&nbsp;<input type="text" value="<?php echo $arr['mame_section']['section_name'] ;?>" size="20" disabled>
	<?php //echo $arr['stock_section']['ss_date'] ;?>
	</td>
</tr>
<tr>
    <td width="5%" height="30"></td>
    <td width="20%" align="right">ชื่อผู้เบิก :</td>
    <td width="75%" align="left">&nbsp;&nbsp;<input type="text" value="<?php echo $arr['mame_member']['prefix'].$arr['mame_member']['fname']."  ".$arr['mame_member']['lname'];?>" size="20" disabled>
	</td>
</tr>
<?php
                              $res['stock_head_type'] = $db->select_query("SELECT type_name FROM ".TB_STOCK_TYPE." WHERE type_id='".$_POST['type_id']."'") ;
                              $arr['stock_head_type'] = $db->fetch($res['stock_head_type']) ;
?>
<tr>
    <td width="5%" height="30"></td>
    <td width="20%" align="right">ประเภทวัสดุ :</td>
    <td width="75%" align="left">&nbsp;&nbsp;<input type="text" value="<?php echo $arr['stock_head_type']['type_name'] ;?>" size="20" disabled>
	</td>
</tr>
</table><br>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=10%  valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  รายการที่</span></p>
  </td>
  <td width=12% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  วัน เดือน ปี</span></p>
  </td>
  <td width=40%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  รายการ</span></p>
  </td>
  <td width=15%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ราคาต่อหน่วย<br>
  ( บาท )</span></p>
  </td>
  <td width=10% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  จำนวน (ขอเบิก)</span></p>
  </td>
  <td width=13% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  หมายเหตุ (บ/ช)</span></p>
  </td>
</tr>
 <?php
                       $count_no = 1 ;
					   while($arr['stock_section'] = $db->fetch($res['stock_section'])){
					   $res['stock_head_section'] = $db->select_query("SELECT shs_id ,sh_id FROM ".TB_STOCK_HEAD_SECTION." WHERE shs_id='".$arr['stock_section']['shs_id']."'");
					   $arr['stock_head_section'] = $db->fetch($res['stock_head_section']);
					   $res['stock_head'] = $db->select_query("SELECT sh_name FROM ".TB_STOCK_HEAD." WHERE sh_id='".$arr['stock_head_section']['sh_id']."' AND type_id='".$_POST['type_id']."'");
					   $row['stock_head'] = $db->rows($res['stock_head']);
                            if($row['stock_head']) {					   
					   $arr['stock_head'] = $db->fetch($res['stock_head']);
					   echo "<script language=\"javascript\" type=\"text/javascript\">" ;
                       echo "function  print_acc_section_open(data) { " ;
                       echo "window.open(\"modules/wsd/print_acc_section.php?shs_id=\"+data+\"\",\"\",\"toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=999,height=830,left=5,top=5\");" ; 
                       echo "}" ;
                       echo "</script>" ;
 ?>
 <tr style='mso-yfti-irow:2;height:17.35pt'>
  <td valign=top style='border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $count_no ; ?></span></p>
  <input type="hidden" name="ss_id_<?php echo $count_no; ?>" id="ss_id_<?php echo $count_no; ?>" value="<?php echo $arr['stock_section']['ss_id'];?>">
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal style='text-align:right'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo ThaiTimeConvert($arr['stock_section']['ssdate'],"3","") ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_head']['sh_name'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_section']['ss_price'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_section']['ss_amount'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_section']['ss_note'] ;?><input type="button" onClick="print_acc_section_open(<?php echo $arr['stock_head_section']['shs_id'] ;?>)" value=" ... ">&nbsp;
  <img src="./images/icon/edit.gif" alt="แก้ไข" align="middle" border="0"/>&nbsp;
  <img src="./images/icon/trash.gif" alt="ลบ" align="middle" border="0"/>
  </span></p>
  </td>
</tr>
 <?php 
$count_no ++ ;
  }
}
 ?>
 <tr>
    <td height="20" colspan="6"></td>
</tr>
<tr>
    <td height="30" colspan="6" align="center">
    <input type="submit" name="submit" id="submit" value="บันทึกใบเบิกวัสดุ<?php echo " ".$arr['mame_section']['section_name'];?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="button" name="back" id="back" value="กลับก่อนหน้านี้" onClick="requistion_back();">
	<input type="hidden" name="count_no" id="count_no" value="<?php echo $count_no ; ?>" >
    </td >
</tr>
<tr><td width="100%" height="30" colspan="6"></td></tr>
</table>
</form>
<?php
$db->closedb ();
} else	if(!$ProcessOutput AND $op == "") {
	                $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					$res['stockcenter'] = $db->select_query("SELECT requistion_number FROM ".TB_STOCK_DATA." WHERE section_id='".$_SESSION['section_id']."'");
	                $row['stockcenter'] = $db->rows($res['stockcenter']);
					if($row['stockcenter']) {
						$arr['stockcenter'] = $db->fetch($res['stockcenter']);
						$number_no = $arr['stockcenter']['requistion_number'] + 1 ;
					} 
					
					$res['stock_section'] = $db->select_query("SELECT ss_id ,ss_date ,COUNT(ss_date) AS num_date ,MIN(UNIX_TIMESTAMP(ss_date)) AS ssdate FROM ".TB_STOCK_SECTION." WHERE ss_logic='0' AND ss_requistion='0' AND section_id='".$_SESSION['section_id']."' AND srs_number='0' GROUP BY ss_date");
					$row['stock_section'] = $db->rows($res['stock_section']);
					empty($row['stock_section'])?$stock_section="":$stock_section="123" ;
					//echo "rows= ".$row['stock_section'] ;
					if($stock_section != "") {
					$arr['stock_section'] = $db->fetch($res['stock_section']);
?>
<link href="modules/wsd/css/style.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="5%" height="30"></td>
    <td width="20%" align="right">ใบเบิกที่ :</td>
    <td width="75%" align="left">&nbsp;&nbsp;<input type="text" style="font-weight:bold" value="<?php echo $number_no ;?>" size="5" disabled> /25<?php echo WEB_BUDGET ;?></td>	    
</tr>
<tr>
    <td width="5%" height="30"></td>
    <td width="20%" align="right">วัน เดือน ปี :</td>
    <td width="75%" align="left">&nbsp;&nbsp;<input type="text" size="11" style="color:#ff0000;font-weight:bold" value="<?php echo ThaiTimeConvert($arr['stock_section']['ssdate'],"5","") ;?>" disabled>(<?php echo "มีอยู่  ".$arr['stock_section']['num_date']." รายการ" ;?>)
	</td>	    
</tr>
<?php
						$res['mame_section'] = $db->select_query("SELECT section_id ,section_name FROM ".TB_MEMBER_SECTION." WHERE section_id='".$_SESSION['section_id']."'") ;
						$arr['mame_section'] = $db->fetch($res['mame_section']) ;
?>
<tr>
    <td width="5%" height="30"></td>
    <td width="20%" align="right">ส่วนงาน/กอง :</td>
    <td width="75%" align="left">&nbsp;&nbsp;<input type="text" value="<?php echo $arr['mame_section']['section_name'] ;?>" size="35" disabled>
	</td>
</tr>
</table><br>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=5%  valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  ที่</span></p>
  </td>
  <td width=15% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  วัน เดือน ปี</span></p>
  </td>
  <td width=35%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  ชื่อ-สกุล</span></p>
  </td>
  <td width=25% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  ประเภทวัสดุ</span></p>
  </td>
  <td width=20% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK"'>
  เลือก</span></p>
  </td>
</tr>
<?php
                        $count = 1 ;
                        $res['stock_section_meber'] = $db->select_query("SELECT ss_id ,shs_id ,member_id FROM ".TB_STOCK_SECTION." WHERE ss_date='".$arr['stock_section']['ss_date']."' AND ss_logic='0' AND ss_requistion='0' AND section_id='".$_SESSION['section_id']."' AND srs_number='0' GROUP BY member_id ORDER BY ss_id");
					    while($arr['stock_section_meber'] = $db->fetch($res['stock_section_meber'])) {
								$res['mame_member'] = $db->select_query("SELECT member_id ,prefix ,fname ,lname FROM ".TB_MEMBER." WHERE member_id='".$arr['stock_section_meber']['member_id']."'") ;
						        $arr['mame_member'] = $db->fetch($res['mame_member']) ;
								
								$res['stock_head_id'] = $db->select_query("SELECT sh_id FROM ".TB_STOCK_HEAD_SECTION." WHERE shs_id='".$arr['stock_section_meber']['shs_id']."'") ;
                                $arr['stock_head_id'] = $db->fetch($res['stock_head_id']);	
                                $res['stock_head'] = $db->select_query("SELECT type_id FROM ".TB_STOCK_HEAD." WHERE sh_id='".$arr['stock_head_id']['sh_id']."'") ;
							    $arr['stock_head'] = $db->fetch($res['stock_head']) ;

                                $res['stock_head_type'] = $db->select_query("SELECT type_id ,type_name FROM ".TB_STOCK_TYPE." WHERE type_id='".$arr['stock_head']['type_id']."'") ;
                                $arr['stock_head_type'] = $db->fetch($res['stock_head_type']) ;	
  							   // $type_name = "<select name="type_id" id="type_id">";
                               // $type_name .= "<option value=\"".$arr['stock_head_type']['type_id']."\">".$arr['stock_head_type']['type_name']."</option>";								
							   // $type_name .= "</select>" ;
				  
?>
<form name="frmMain<?php echo $count ;?>" id="frmMain<?php echo $count ;?>" method="post" action="?compu=wsd&loc=material_requistion_section&op=material_requistion_section_start&action=old&data=voi" enctype="multipart/form-data">   
 <tr style='mso-yfti-irow:2;height:17.35pt'>
  <td valign=top style='border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $count ;?></span></p>
  <input type="hidden" name="srs_number" id="srs_number" value="<?php echo $number_no ;?>">
  <input type="hidden" name="ss_date" id="ss_date" value="<?php echo $arr['stock_section']['ss_date'] ;?>">
  <input type="hidden" name="ss_date_timestemp" id="ss_date_timestemp" value="<?php echo $arr['stock_section']['ssdate'] ;?>">
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal style='text-align:right'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo ThaiTimeConvert($arr['stock_section']['ssdate'],"3","") ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['mame_member']['prefix'].$arr['mame_member']['fname']."  ".$arr['mame_member']['lname'];?></span></p>
  <input type="hidden" name="member_id" id="member_id" value="<?php echo $arr['mame_member']['member_id'] ;?>">
  <input type="hidden" name="section_id" id="section_id" value="<?php echo $arr['mame_section']['section_id'] ;?>">
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
   <?php  echo $arr['stock_head_type']['type_name'] ; ?>
  </span></p>
  <input type="hidden" name="type_id" id="type_id" value="<?php echo $arr['stock_head_type']['type_id'] ;?>">
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <input type="submit" name="submit<?php echo $count ;?>" id="submit<?php echo $count ;?>" value="เลือกรายการที่  <?php echo " ".$count ;?>"></span></p>
  </td>
</tr>
</form>
<?php 
$count++ ;
} ;
 ?>	
<tr><td width="100%" height="30" colspan="5"></td></tr>
</table>
</form>
<?php
} else {
echo "ไม่มีรายการเบิก" ;
}
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