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
  if(!$ProcessOutput AND $op == "material_requistion_add" AND $action == "add" AND $data == "voi_add"){
	
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);	                
					
					 $res['stock_requistion'] = $db->select_query("SELECT MAX(UNIX_TIMESTAMP(src_date)) AS thaidate ,MAX(src_date) AS srcdate FROM ".TB_STOCK_REQUISTION_CENTER."");
	                 $arr['stock_requistion'] = $db->fetch($res['stock_requistion']);                     
                     
					 $date_new = ThaiTimeConvert($_POST['date_timestamp'],"","") ;
					 $date_old = ThaiTimeConvert($arr['stock_requistion']['thaidate'],"","") ;
					 
					 if($_POST['sh_date_1'] < $arr['stock_requistion']['srcdate']) {
		                echo "<script language='javascript'>" ;
		                echo "alert('ต้องขออภัย วันที่ใบเบิกใหม่ ".$date_new."  น้อยกว่า วันที่  ".$date_old."  ใบเบิกล่าสุด')" ;
		                echo "</script>" ;
		                //echo "<script language='javascript'>javascript:history.go(-2)</script>";
						echo "<script type='text/javascript'>window.location.href = \"index.php?compu=wsd&loc=material_requistion\";</script>" ;
						exit();
					 }
					 $count	= $_POST['count_no'] ;
					 $section_no = 0 ;
					 $count_num = 0 ;

                     for($number=1;$number<$count;$number++)
					 {
						 empty($_POST['sc_id_'.$number])?$sc_id="":$sc_id=" ".$_POST['sc_id_'.$number]."" ; 						  
						 echo  "sc_id=".$sc_id."<br>" ;
						 if($sc_id){
							 $count_num++ ;
						 }
					 }
					 echo $count_num ;
					     if($count_num > 10){
		                    echo "<script language='javascript'>" ;
		                    echo "alert('ต้องขออภัย เลือกรายการ มากกว่า 10 รายการ')" ;
		                    echo "</script>" ;
		                    //echo "<script language='javascript'>javascript:history.go(-1)</script>";
						    echo "<script type='text/javascript'>window.location.href = \"index.php?compu=wsd&loc=material_requistion\";</script>" ;
						    exit();							 
					     }
				 
                     $db->add_db(TB_STOCK_REQUISTION_CENTER,array(
				     "src_number"=>"".$_POST['src_number']."",
					 "src_date"=>"".$_POST['sh_date_1']."",
					 "type_id"=>"".$_POST['type_id']."",
				     "section_id"=>"".$_POST['section_id']."",
					 "member_id"=>"".$_POST['member_id']."",
					 "boss_id"=>"".$_POST['boss_id'].""
					 ));	
					 $count	= $_POST['count_no'] ;
                     for($number=1;$number<$count;$number++)
                     {
						empty($_POST['sc_id_'.$number])?$sc_id="":$sc_id=" ".$_POST['sc_id_'.$number]."" ;
						if($sc_id)
						{ 
					  	$db->update_db(TB_STOCK_CENTER,array(
			            "src_number"=>"".$_POST['src_number'].""
	            	    )," sc_id='".$sc_id."'");
						}  
					 }
						//echo "sc_id_".$number."=".$_POST['sc_id_'.$number]."<br>";

                        $db->update_db(TB_STOCK_DATA,array(
			            "requistion_number"=>"".$_POST['src_number'].""
	            	    )," section_id='".$section_no."'");                    					 
					 
				    $ProcessOutput = "<br><br><center>ได้ทำการบันทึกข้อมูลประเภทย่อยวัสดุเรียบแล้ว" ;
					$ProcessOutput .= "  OK.</center>" ;
					echo "src_number=".$_POST['src_number']."<br>";
					echo "sh_date_1=".$_POST['sh_date_1']."<br>";
					echo "section_id=".$_POST['section_id']."<br>";
					echo "member_id=".$_POST['member_id']."<br>";
					echo "count=".$count."<br>";
					echo $ProcessOutput ;
					
                    echo "<script type='text/javascript'>window.location.href = \"index.php?compu=wsd&loc=material_requistion_print\";</script>" ;
                    break;
					

} else	if(!$ProcessOutput AND $op == "material_requistion_start" AND $action == "old" AND $data == "voi") {
	                $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					$res['stockcenter'] = $db->select_query("SELECT requistion_number FROM ".TB_STOCK_DATA." WHERE section_id='0'");
	                $row['stockcenter'] = $db->rows($res['stockcenter']);
					if($row['stockcenter']) {
						$arr['stockcenter'] = $db->fetch($res['stockcenter']);
						$number_no = $arr['stockcenter']['requistion_number'] + 1 ;
					} 
					//echo "test =".$arr['stock_center']['count_id']."  =".TB_STOCK_REQUISTION_CENTER ;
?>
<link href="modules/wsd/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript"  src="js/calender.js"></script>
<SCRIPT LANGUAGE="javascript">
function requistion_new() {
   window.location="index.php?compu=wsd&loc=material_requistion";
}

$(function(){        
	  
    $(".css_data_item").click(function(){  // เมื่อคลิก checkbox  ใดๆ  
        if($(this).prop("checked")==true){ // ตรวจสอบ property  การ ของ   
            var indexObj=$(this).index(".css_data_item"); //   
            $(".css_data_item").not(":eq("+indexObj+")").prop( "checked", false ); // ยกเลิกการคลิก รายการอื่น  
        }  
    });  

    $("#frm_voi").submit(function(){ // เมื่อมีการส่งข้อมูลฟอร์ม  
        if($(".css_data_item:checked").length==0){ // ถ้าไม่มีการเลือก checkbox ใดๆ เลย  
            alert("กรุณาติกเลือกรายการ วัสดุ  อย่างน้อย 1 รายการ แต่ไม่เกิน 10 รายการ");  
            return false;     
        }  
    });  	
		  
});  

/***
function check(frm) {
   var inputs = frm.getElementsByTagName('input');
   for(var i = 1 ; i < inputs.length ; i++){
     input = inputs;
     if(input.type == 'checkbox'){
          if (input.checked){
               return true;
          };
     };
   };
   alert('กรุณาเลือกอย่างน้อย 1 รายการ');
   return false;
}
onSubmit="return check(this)"

function countCheck(frm) {
     ch = 0;
     var form = document.getElementById(frm);
     var inps = form.getElementsByTagName("input");
	 alert(inps.length) ;
     //for(var i = 0 ; i < inps.length ; i++) {
          var inp = inps;
          if (inp.type=="checkbox"&&inp.checked) {
               ch++;
          };
     //};
     document.getElementById('count').innerHTML = ch;
}
***/
</SCRIPT>
<form name="frm_voi" id="frm_voi" method="post" action="?compu=wsd&loc=material_requistion&op=material_requistion_add&action=add&data=voi_add"  enctype="multipart/form-data">  
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="5%" height="30"></td>
    <td width="20%" align="right">ใบเบิกที่ :<input type="hidden" name="src_number" id="src_number" value="<?php echo $number_no ;?>"></td>
    <td width="75%" align="left">&nbsp;&nbsp;<input type="text" value="<?php echo $number_no ;?>" size="5" disabled><b> /25<?php echo WEB_BUDGET ;?></b></td>	    
</tr>
<tr>
    <td width="5%" height="30"></td>
    <td width="20%" align="right">วัน เดือน ปี :</td>
    <td width="75%" align="left">&nbsp;&nbsp;
	<input name="tCalendar_1" type="text" id="tCalendar_1" size="17" value="<?php echo ThaiTimeConvert($_POST['date_timestamp']) ;?>"><!--  &nbsp;<IMG SRC="images/dateselect.gif" BORDER="0" ALT="เลือกวันที่" onClick="showCalendar(this,1)" align="absmiddle"> -->
	<br><input type="hidden" name="sh_date_1" id="sh_date_1" size="12" value="<?php echo $_POST['sh_date_1'] ;?>">
	<input type="hidden" name="date_timestamp" id="date_timestamp" size="12" value="<?php echo $_POST['date_timestamp'] ;?>">
    </td>
</tr>
<tr>
    <td width="5%" height="30"></td>
    <td width="20%" align="right">ส่วนงาน/กอง :</td>
    <td width="75%" align="left">&nbsp;&nbsp;
	<select disabled>
						<?php
						$res['member_section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." ORDER BY section_id");
						echo "<option value=''>---เลือกส่วนงาน/กอง---</option>";
						while($arr['member_section'] = $db->fetch($res['member_section'])) {
						?>
						<OPTION value=<?php echo $arr['member_section']['section_id'];?><?php if($_POST['member_section']=="".$arr['member_section']['section_id'].""){ echo " selected" ; } ?>><?php echo $arr['member_section']['section_name'];?></OPTION>
                        <?php } ?>						
	</select>
	<input type="hidden" name="section_id" id="section_id" value="<?php echo $_POST['member_section']; ?>">
</tr>
<tr>
    <td width="5%" height="30"></td>
    <td width="20%" align="right">ผู้เบิก :</td>
    <td width="75%" align="left">&nbsp;&nbsp;
<?php
					$res['admin'] = $db->select_query("SELECT member_id FROM ".TB_ADMIN." WHERE section_id=".$_POST['member_section']."");
	                $arr['admin'] = $db->fetch($res['admin']);
					$res['member'] = $db->select_query("SELECT member_id ,prefix ,fname ,lname FROM ".TB_MEMBER." WHERE member_id=".$arr['admin']['member_id']."");
	                $arr['member'] = $db->fetch($res['member']);
?>	
    <input type="text" size="20" value="<?php echo $arr['member']['prefix'].$arr['member']['fname']."  ".$arr['member']['lname'];?>" disabled>&nbsp;
	<input type="hidden" name="member_id" id="member_id" size="12" value="<?php echo $arr['admin']['member_id'];?>">
	</td>	    
</tr>
<tr>
    <td width="5%" height="30"></td>
    <td width="20%" align="right">ผู้อนุมัติ :</td>
    <td width="75%" align="left">&nbsp;&nbsp;<input type="text" size="20" value="นายก<?php echo WEB_AGEN_MINI.WEB_AGEN_NAME ; ?>" disabled>&nbsp;
	<br><input type="hidden" name="boss_id" id="boss_id" value="1"></td>	    
</tr>
<tr>
    <td width="5%" height="30"></td>
    <td width="20%" align="right">ประเภทวัสดุ :</td>
    <td width="75%" align="left">&nbsp;&nbsp;
	<select disabled>
						<?php
						$res['stock_type'] = $db->select_query("SELECT * FROM ".TB_STOCK_TYPE." ORDER BY type_id");
						//echo "<option value=''>---เลือกประเภทวัสดุ---</option>";
						while($arr['stock_type'] = $db->fetch($res['stock_type'])) {
						?>
						<OPTION value=<?php echo $arr['stock_type']['type_id'];?><?php if($_POST['type_id']=="".$arr['stock_type']['type_id'].""){ echo " selected" ; } ?>><?php echo $arr['stock_type']['type_name'];?></OPTION>
                        <?php } ?>						
	</select>
	<input type="hidden" name="type_id" id="type_id" value="<?php echo $_POST['type_id'];?>">
	</td>	    
</tr>
<tr>
    <td height="10" colspan="3"></td>
</tr>
<tr>
    <td height="30" colspan="3" align="center">
    <input type="submit" name="submit" id="submit" value="บันทึกใบเบิกวัสดุส่วนกลาง">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="button" name="new" id="new" value="ลงข้อมูลใหม่" onClick="requistion_new();">
    </td >
</tr>
</table><br>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=5%  valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ที่</span></p>
  </td>
  <td width=12% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  วัน เดือน ปี</span></p>
  </td>
  <td width=33%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  รายการ</span></p>
  </td>
  <td width=12%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ราคาต่อหน่วย<br>
  ( บาท )</span></p>
  </td>
  <td width=12% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  จำนวน</span></p>
  </td>
  <td width=18% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  รับจาก</span></p>
  </td>
  <td width=8% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  เลือก</span></p>
  </td>
</tr>
 <?php
                       $count_no = 1 ;
					   $res['stock_center'] = $db->select_query("SELECT sc_id ,shc_id ,UNIX_TIMESTAMP(sc_date) AS scdate ,sc_name ,sc_price ,sc_amount ,sc_logic ,shp_diff_name FROM ".TB_STOCK_CENTER." WHERE sc_logic='1' AND sc_requistion='0' AND src_number='0' AND sc_date='".$_POST['sh_date_1']."' ORDER BY sc_id");
					   while($arr['stock_center'] = $db->fetch($res['stock_center'])){
					   $res['stock_head_center'] = $db->select_query("SELECT sh_id FROM ".TB_STOCK_HEAD_CENTER." WHERE shc_id='".$arr['stock_center']['shc_id']."'");
					   $arr['stock_head_center'] = $db->fetch($res['stock_head_center']);
					   $res['stock_head'] = $db->select_query("SELECT sh_id ,sh_name ,sh_diff_name FROM ".TB_STOCK_HEAD." WHERE sh_id='".$arr['stock_head_center']['sh_id']."' AND type_id='".$_POST['type_id']."'");
					   $rows['stock_head'] = $db->rows($res['stock_head']);
					   if($rows['stock_head']) {
					   $arr['stock_head'] = $db->fetch($res['stock_head']);
					   
					   empty($arr['stock_head']['sh_diff_name'])?$sh_diff_name="":$sh_diff_name=" ".$arr['stock_head']['sh_diff_name']."" ;
					   empty($arr['stock_center']['shp_diff_name'])?$shp_diff_name="":$shp_diff_name=" (".$arr['stock_center']['shp_diff_name'].")" ;					   
 ?>
 <tr style='mso-yfti-irow:2;height:17.35pt'>
  <td valign=top style='border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $count_no ; ?></span></p>
  <!-- <input type="hidden" name="sc_id_<?php //echo $count_no; ?>" id="sc_id_<?php //echo $count_no; ?>" value="<?php //echo $arr['stock_center']['sc_id'];?>"> -->
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal style='text-align:right'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo ThaiTimeConvert($arr['stock_center']['scdate'],"3","") ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_head']['sh_name'] ;?><?php echo $sh_diff_name ;?><?php echo $shp_diff_name ;?></span></p>
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
  <?php echo $arr['stock_center']['sc_amount'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_center']['sc_name'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <input type="checkbox" name="sc_id_<?php echo $count_no; ?>" id="sc_id_<?php echo $count_no; ?>" class="css_data_item" value="<?php echo $arr['stock_center']['sc_id'] ;?>" ></span></p> <!-- onclick="countCheck('frm_voi');" -->
  </td>
</tr>
 <?php 
 $count_no ++ ;
 }
 }
 ?>
 <tr>
    <td height="8" colspan="7"></td>
</tr>
<tr>
    <td height="25" colspan="7" align="right"><span id="count">&nbsp;</span></td>
</tr>
<tr>
    <td height="10" colspan="7"></td>
</tr>
<tr>
    <td height="30" colspan="7" align="center">
    <input type="submit" name="submit" id="submit" value="บันทึกใบเบิกวัสดุส่วนกลาง">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="button" name="new" id="new" value="ลงข้อมูลใหม่" onClick="requistion_new();">
	<input type="hidden" name="count_no" id="count_no" value="<?php echo $count_no ; ?>" >
    </td >
</tr>
<tr><td width="100%" height="30" colspan="7"></td></tr>
</table>
</form>
<?php
$db->closedb ();
} else	if(!$ProcessOutput AND $op == "") {
	                $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					$res['stockcenter'] = $db->select_query("SELECT requistion_number FROM ".TB_STOCK_DATA." WHERE section_id='0'");
	                $row['stockcenter'] = $db->rows($res['stockcenter']);
					if($row['stockcenter']) {
						$arr['stockcenter'] = $db->fetch($res['stockcenter']);
						$number_no = $arr['stockcenter']['requistion_number'] + 1 ;
					} 
					
					$res['stock_min_date'] = $db->select_query("SELECT sc_date ,MIN(UNIX_TIMESTAMP(sc_date)) AS min_date FROM ".TB_STOCK_CENTER." WHERE sc_logic='1' AND sc_requistion='0' AND src_number='0' GROUP BY sc_date");					
					$row['stock_min_date'] = $db->rows($res['stock_min_date']);
					if($row['stock_min_date']) {
					$arr['stock_min_date'] = $db->fetch($res['stock_min_date']);
?>
<link href="modules/wsd/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript"  src="js/calender.js"></script>
<SCRIPT LANGUAGE="javascript">
function sendForm() {
   if(document.frmMain.member_section.value=="") {
   alert("กรุณาเลือก กองหรือส่วนงาน   ด้วยครับ") ;
   window.location="index.php?compu=wsd&loc=material_requistion";
   //document.frmMain.member_section.focus() ;
   return false ;
} else {
   document.frmMain.submit() ;
 //document.getElementByID("frmMain").submit() ;
}
}
</SCRIPT>
<form name="frmMain" id="frmMain" method="post" action="?compu=wsd&loc=material_requistion&op=material_requistion_start&action=old&data=voi" enctype="multipart/form-data">  
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="5%" height="30"></td>
    <td width="20%" align="right">ใบเบิกที่ :<input type="hidden" name="src_number" id="src_number" value="<?php echo $number_no ;?>"></td>
    <td width="75%" align="left">&nbsp;&nbsp;<input type="text" value="<?php echo $number_no ;?>" size="5" disabled><b> /25<?php echo WEB_BUDGET ;?></b></td>	    
</tr>
<tr>
    <td width="5%" height="30"></td>
    <td width="20%" align="right">วัน เดือน ปี :</td>
    <td width="75%" align="left">&nbsp;&nbsp;<input type="text" size="17" value="<?php echo ThaiTimeConvert($arr['stock_min_date']['min_date'],"3","") ;?>" >
	<input type="hidden" name="sh_date_1" id="sh_date_1" value="<?php echo $arr['stock_min_date']['sc_date'] ; ?>">
	<input type="hidden" name="date_timestamp" id="date_timestamp" value="<?php echo $arr['stock_min_date']['min_date'] ; ?>">
	</td>	    
</tr>
<tr>
    <td width="5%" height="30"></td>
    <td width="20%" align="right">ส่วนงาน/กอง :</td>
    <td width="75%" align="left">&nbsp;&nbsp;
	<select name="member_section" id="member_section">
						<?php
						$res['member_section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." ORDER BY section_id");
						echo "<option value=''>---เลือกส่วนงาน/กอง---</option>";
						while($arr['member_section'] = $db->fetch($res['member_section'])) {
						?>
						<option value=<?php echo $arr['member_section']['section_id'];?>><?php echo $arr['member_section']['section_name'];?></option>
                        <?php } ?>						
	</select>&nbsp;<font color="#ff0000"><b>*</b></font>
	</td>
</tr>
<tr>
    <td width="5%" height="30"></td>
    <td width="20%" align="right">ผู้เบิก :</td>
    <td width="75%" align="left">&nbsp;&nbsp;<input size="20" value="" disabled>
	</td>	    
</tr>
<tr>
    <td width="5%" height="30"></td>
    <td width="20%" align="right">ผู้อนุมัติ :</td>
    <td width="75%" align="left">&nbsp;&nbsp;<input type="text" size="20" value="" disabled>
	</td>	    
</tr>
<tr>
    <td width="5%" height="30"></td>
    <td width="20%" align="right">ประเภทวัสดุ :</td>
    <td width="75%" align="left">&nbsp;&nbsp;
	<select name="type_id" id="type_id" onChange="sendForm()">
						<?php
						$res['stock_type'] = $db->select_query("SELECT * FROM ".TB_STOCK_TYPE." ORDER BY type_id");
						echo "<option value=''>---เลือกประเภทวัสดุ---</option>";
						while($arr['stock_type'] = $db->fetch($res['stock_type'])) {
						?>
						<option value=<?php echo $arr['stock_type']['type_id'];?>><?php echo $arr['stock_type']['type_name'];?></option>
                        <?php } ?>						
	</select>&nbsp;<font color="#ff0000"><b>*</b></font>
	</td>	    
</tr>
</table><br>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=5%  valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ที่</span></p>
  </td>
  <td width=12% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  วัน เดือน ปี</span></p>
  </td>
  <td width=33%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  รายการ</span></p>
  </td>
  <td width=12%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ราคาต่อหน่วย<br>
  ( บาท )</span></p>
  </td>
  <td width=12% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  จำนวน</span></p>
  </td>
  <td width=18% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  รับจาก</span></p>
  </td>
  <td width=8% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  เลือก</span></p>
  </td>
</tr>
 <?php
                       $count_no = 1 ;
					   $res['stock_center'] = $db->select_query("SELECT shc_id ,UNIX_TIMESTAMP(sc_date) AS scdate ,sc_name ,sc_price ,sc_amount ,sc_logic ,shp_diff_name FROM ".TB_STOCK_CENTER." WHERE sc_logic='1' AND sc_requistion='0' AND src_number='0' ORDER BY sc_date");
					   while($arr['stock_center'] = $db->fetch($res['stock_center'])){
					   $res['stock_head_center'] = $db->select_query("SELECT sh_id FROM ".TB_STOCK_HEAD_CENTER." WHERE shc_id='".$arr['stock_center']['shc_id']."'");
					   $arr['stock_head_center'] = $db->fetch($res['stock_head_center']);
					   $res['stock_head'] = $db->select_query("SELECT sh_name ,sh_diff_name FROM ".TB_STOCK_HEAD." WHERE sh_id='".$arr['stock_head_center']['sh_id']."'");
					   $arr['stock_head'] = $db->fetch($res['stock_head']);
					   
					   empty($arr['stock_head']['sh_diff_name'])?$sh_diff_name="":$sh_diff_name=" ".$arr['stock_head']['sh_diff_name']."" ;
					   empty($arr['stock_center']['shp_diff_name'])?$shp_diff_name="":$shp_diff_name=" (".$arr['stock_center']['shp_diff_name'].")" ;
 ?>
 <tr style='mso-yfti-irow:2;height:17.35pt'>
  <td valign=top style='border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $count_no ; ?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal style='text-align:right'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo ThaiTimeConvert($arr['stock_center']['scdate'],"3","") ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <a href="index.php?compu=wsd&loc=material_central&op=addold_material&data=<?php echo $arr['stock_center']['shc_id'] ;?>"><u><?php echo $arr['stock_head']['sh_name'] ;?></u></a>
  <?php echo $sh_diff_name ;?><?php echo $shp_diff_name ;?></span></p>
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
  <?php echo $arr['stock_center']['sc_amount'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_center']['sc_name'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <a href="" onClick="#"><img src="./images/icon/trash.gif" alt="ลบ" align="middle" border="0" /></a></span></p>
  </td>
</tr>
 <?php 
 $count_no ++ ;
 }
 ?>
<tr><td width="100%" height="30" colspan="7"></td></tr>
</table>
</form>
<?php
} else {
   echo "<h2>ยังไม่มีรายการเบิกจ่าย</h2>" ;	
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