<?php
CheckUser_Nopwd($login_true);
if($op == "car_add"){
               
                if($_POST['time_c_1']=="" || $_POST['time_m_1']=="") {
				$c_in_time1="" ;
				} else {
				$c_in_time1 = $_POST['time_c_1'].":".$_POST['time_m_1'] ;
				}
              
			    if($_POST['time_c_2']=="" || $_POST['time_m_2']=="") {
				$c_in_time2="" ;
				} else {
				$c_in_time2 = $_POST['time_c_2'].":".$_POST['time_m_2'] ;
				}
				
				$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
				$db->add_db(TB_CAR_PERMISSION,array(
					"c_date_applic"=>"".$_POST['sh_date_1']."",
					"c_id_applic"=>"".$_POST['c_id_applic']."",
					"c_where"=>"".$_POST['c_where']."",
					"c_why"=>"".$_POST['c_why']."",
					"c_sit"=>"".$_POST['c_sit']."",
					"c_in_date1"=>"".$_POST['sh_date_2']."",
					"c_in_time1"=>"".$c_in_time1."",
					"c_in_date2"=>"".$_POST['sh_date_3']."",
					"c_in_time2"=>"".$c_in_time2."",
					"c_car_type"=>"".$_POST['c_id_type']."",
					"c_id_head"=>"".$_POST['c_id_head']."",
					"c_id_prime"=>"".$_POST['c_id_prime']."",					
					"c_status"=>"np"
				));
				
				$db->update_db(TB_MEMBER,array(
			        "place_buffer"=>""
	            	)," user='".$login_true."'");
					
            $ProcessOutput  = "";
			$ProcessOutput .= "<BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการบันทึกข้อมูล  รายการขออนุญาตใช้รถส่วนกลาง  เรียบร้อยแล้ว</B></FONT>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
			
			echo $ProcessOutput ;
			echo "<script type='text/javascript'>window.location.href = \"index.php?compu=car&loc=list_printcar\";</script>" ;
}
empty($ProcessOutput)?$ProcessOutput="":$ProcessOutput=$ProcessOutput ;	
if(!$ProcessOutput){
$w=$thai_w[date("w")];
$d=date("d");
$n=$SHORT_MONTH[date("n")];
$m=date("n");
$y=date("Y") +543;
$ye=date("Y");

$date_hid=$ye."-".$m."-".$d ;
?>
<link href="modules/car/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript"  src="js/calender.js"></script>
<script language="javascript" type="text/javascript">
function suggest(inputString){
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#place').addClass('load');
			$.post("modules/car/autosuggest.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#place').removeClass('load');
				}
			});
		}
	}

	function fill(thisValue) {
		$('#place').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 300);
	}

 	//Browser Support Code
 	function send_place(op,login_true) {
 	var chk_op=op ;
	var login_true=login_true ;
	var ajaxRequest;
 	try{
  	ajaxRequest = new XMLHttpRequest();
 	} catch (e){
  	try{
 	ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
 	} catch (e) {
 	try{
	ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
 	} catch (e){
 	alert("Your browser broke!");
 	return false;
 	}
 	}
 	}
  	ajaxRequest.onreadystatechange = function(){
 	if(ajaxRequest.readyState == 4)
 	{
    //alert("readyState = 4")
	var area = document.getElementById('c_where');
	area.innerHTML = ajaxRequest.responseText;
    document.form_car.place.value="";
	document.form_car.place.focus() ;
	}
 	}
	 if(document.form_car.place.value=="" && chk_op !="clear") {
        alert("กรุณากรอกชื่อสถานที่ไปด้วยครับ") ;
        document.form_car.place.focus() ;
     return false ;
    }
//	 if(chk_op=="clear"){
//         document.form_car.c_where.value="";
//		 document.form_car.place.value="";
//		 document.form_car.place.focus() ;
//     } 
	var place = document.getElementById('place').value; 
    var random=Math.random();
    //alert("Random="+random) ;
	//alert("chk_op="+chk_op) ;
	//alert("place="+place) ;
	//alert("login_true="+login_true) ;
	ajaxRequest.open("GET", "modules/car/sendplace.php?" + "name="+place+"&op="+chk_op+"&login_true="+login_true+"&random="+random);
	ajaxRequest.send(null);
	}
</script>
<?php
        empty($_SESSION['login_true'])?$login_true="":$login_true=$_SESSION['login_true'];

		//เคลียร์ที่เก็บสถานที่ไป
		$db->update_db(TB_MEMBER,array(
			        "place_buffer"=>""
	            	)," user='".$login_true."'");		
        //ผู้ขอใช้รถ					
		$res['member'] = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE user='".$login_true."' ");
		$arr['member'] = $db->fetch($res['member']);
		$res['position'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id='".$arr['member']['position_id']."' ");
    	$arr['position'] = $db->fetch($res['position']);	
        $res['degree'] = $db->select_query("SELECT degree_name FROM ".TB_MEMBER_DEGREE." WHERE degree_id='".$arr['member']['degree_id']."'");
		$arr['degree'] = $db->fetch($res['degree']);		
        //รถ
		$res['car_type'] = $db->select_query("SELECT * FROM ".TB_CAR_TYPE."");
        //ปลัดหรือผู้แทน
	    $res_p['member'] = $db->select_query("SELECT member_id,prefix,fname,lname FROM ".TB_MEMBER." WHERE parties_id='3' ORDER BY member_id DESC ");
	    $res['admin'] = $db->select_query("SELECT member_id FROM ".TB_ADMIN." WHERE level='4' AND elect='0' ORDER BY id DESC");
	
	//ผู้มีอำนาจสั่งใช้รถ
	    $str_name_y = "นายก" ;
	    $str_name_l = "รองนายก" ;
	    $res_y['position'] = $db->select_query("SELECT position_id FROM ".TB_MEMBER_POSITION." WHERE position_name LIKE '$str_name_y%' AND parties_id='1' ");
	    $arr_y['position'] = $db->fetch($res_y['position']);
	    $res_l['position'] = $db->select_query("SELECT position_id FROM ".TB_MEMBER_POSITION." WHERE position_name LIKE '$str_name_l%' AND parties_id='1' ");
	    $arr_l['position'] = $db->fetch($res_l['position']);	
	    $res_y['member'] = $db->select_query("SELECT member_id, prefix, fname, lname FROM ".TB_MEMBER." WHERE position_id='".$arr_y['position']['position_id']."'");
	    $arr_y['member'] = $db->fetch($res_y['member']);
	    $res_l['member'] = $db->select_query("SELECT member_id, prefix, fname, lname FROM ".TB_MEMBER." WHERE position_id='".$arr_l['position']['position_id']."' ");			
?>
<div id="pCalendar" style="position: absolute; left: 10px; top: 10px; visibility: hidden;"></div> 
<form id="form_car" name="form_car" method="post" action="?compu=car&op=car_add" onSubmit="return check();">
<table width="940" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10" height="50">&nbsp;</td>
    <td width="170" align="right"><img src="images/car/car_title.gif" width="30" height="23" align="baseline" />&nbsp;<img src="images/car/texmenu_title.gif" width="77" height="32" align="baseline" /></td>
    <td colspan="3">&nbsp;&nbsp;<b>
 		   <?php if ($arr['member']['user']<>""){?>
          &nbsp;&nbsp;<span style="font-size:16px;color:#044e6a"><?php echo $arr['member']['prefix'];?><?php echo $arr['member']['fname'];?>&nbsp;<?php echo $arr['member']['lname'];?></span>&nbsp;&nbsp;ตำแหน่ง&nbsp;
		  <span style="font-size:16px;color:#044e6a">
           <?php   if ($arr['member']['parties_id']==1){
				    if(WEB_AGEN_MINI == "อบต.") {
		              $agenname = $arr['position']['position_name']."องค์การบริหารส่วนตำบล".WEB_AGEN_NAME ;
		            } else if(WEB_AGEN_MINI == "ทต.") {
		              $agenname = $arr['position']['position_name']."เทศมนตรีตำบล".WEB_AGEN_NAME ;
		            }   
		   ?>
           <?php echo $agenname ; ?>&nbsp;&nbsp;</span>
           <?php  } else if ($arr['member']['parties_id']==3){ ?>
           <?php echo $arr['position']['position_name'];?><?php echo WEB_AGEN_FULL.WEB_AGEN_NAME ; ?>&nbsp;&nbsp;</span>
           <?php  } else { ?>            
           <?php echo $arr['position']['position_name'].$arr['degree']['degree_name'] ;?>&nbsp;&nbsp;</span>
           <?php  } ?>
           <?php  } ?>	
		   </b></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="1" class="dotline" colspan="6" width="100%"></td>
  </tr>	
    <tr>
    <td height="10" colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td height="45">&nbsp;</td>
    <td align="right" valign="top"><strong>วันที่เขียนขออนุญาต :</strong></td>
    <td width="275" valign="top"><label>&nbsp;&nbsp;
	<input type="text" name="tCalendar_1" id="tCalendar_1" size="16" value="<?php  echo "$d $n $y" ;?>">&nbsp;<IMG SRC="images/dateselect.gif" BORDER="0" ALT="เลือกวันที่" onClick="showCalendar(this,1)" align="absmiddle">
    <input type="hidden" name="sh_date_1" id="sh_date_1" value="<?php echo $date_hid ;?>">
    <input type="hidden" name="c_id_applic" id="c_id_applic" value="<?php echo $arr['member']['member_id'];?>" >	
	</label>
    </td>
    <td width="160" align="right" valign="top"><strong>ไปวันที่ :</strong></td>
    <td width="315" valign="top">&nbsp;&nbsp;<input name="tCalendar_2" type="text" id="tCalendar_2" size="16" value="<?php  echo "$d $n $y" ;?>">&nbsp;<IMG SRC="images/dateselect.gif" BORDER="0" ALT="เลือกวันที่" onClick="showCalendar(this,2)" align="absmiddle">
    &nbsp;&nbsp;&nbsp;<b>เวลา :</b>
	<select name="time_c_1" id="time_c_1">
      <option value="" selected> </option>
      <option value="06">06</option>
      <option value="07">07</option>
      <option value="08">08</option>
      <option value="09">09</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
      <option value="13">13</option>
      <option value="14">14</option>
      <option value="15">15</option>
      <option value="16">16</option>
      <option value="17">17</option>
      <option value="18">18</option>
      <option value="19">19</option>
      <option value="20">20</option>
      <option value="21">21</option>
      <option value="22">22</option>
      <option value="23">23</option>
      <option value="00">00</option>      
      <option value="01">01</option>
      <option value="02">02</option>
      <option value="03">03</option>
      <option value="04">04</option>
      <option value="05">05</option>	  
      </select>&nbsp;<b>:</b>&nbsp;<select name="time_m_1" id="time_m_1">
      <option value="" selected> </option>
      <option value="00">00</option>
      <option value="10">10</option>
      <option value="20">20</option>
      <option value="30">30</option>
      <option value="40">40</option>
      <option value="50">50</option>
      </select>&nbsp;<b>น.</b>
	  <input type="hidden" name="sh_date_2" id="sh_date_2" value="<?php echo $date_hid ;?>">
	</td>  
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="45">&nbsp;</td>
    <td align="right" valign="top"><strong>มีคนนั่งไป :</strong></td>
    <td valign="top">&nbsp;&nbsp;<label>
    <select  name="c_sit"  id="c_sit" >
                                <option value="" selected>&nbsp;&nbsp;-ไม่มี-&nbsp;&nbsp;</option>
                                <option value="1">&nbsp;&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;คน</option>
                                <option value="2">&nbsp;&nbsp;&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;คน</option>
	                            <option value="3">&nbsp;&nbsp;&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;คน</option>
	                            <option value="4">&nbsp;&nbsp;&nbsp;&nbsp;4&nbsp;&nbsp;&nbsp;คน</option>
	                            <option value="5">&nbsp;&nbsp;&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;คน</option>
	                            <option value="6">&nbsp;&nbsp;&nbsp;&nbsp;6&nbsp;&nbsp;&nbsp;คน</option>
	                            <option value="7">&nbsp;&nbsp;&nbsp;&nbsp;7&nbsp;&nbsp;&nbsp;คน</option>
	                            <option value="8">&nbsp;&nbsp;&nbsp;&nbsp;8&nbsp;&nbsp;&nbsp;คน</option>
	                            <option value="9">&nbsp;&nbsp;&nbsp;&nbsp;9&nbsp;&nbsp;&nbsp;คน</option>
	                            <option value="10">&nbsp;&nbsp;&nbsp;10&nbsp;&nbsp;คน</option>
	                            <option value="11">&nbsp;&nbsp;&nbsp;11&nbsp;&nbsp;คน</option>
	                            <option value="12">&nbsp;&nbsp;&nbsp;12&nbsp;&nbsp;คน</option>
	                            <option value="13">&nbsp;&nbsp;&nbsp;13&nbsp;&nbsp;คน</option>
	                            <option value="14">&nbsp;&nbsp;&nbsp;14&nbsp;&nbsp;คน</option>
	                            <option value="15">&nbsp;&nbsp;&nbsp;15&nbsp;&nbsp;คน</option>
    </select> *( ไม่รวมพนักงานขับรถ )
      </label></td>
    <td align="right" valign="top"><strong>กลับวันที่ :</strong></td>
    <td valign="top">&nbsp;&nbsp;<input name="tCalendar_3" type="text" id="tCalendar_3" size="16" value="">&nbsp;<IMG SRC="images/dateselect.gif" BORDER="0" ALT="เลือกวันที่" onClick="showCalendar(this,3)" align="absmiddle">
	&nbsp;&nbsp;&nbsp;<b>เวลา :</b>
	<select name="time_c_2" id="time_c_2">
      <option value="" selected> </option>
      <option value="06">06</option>
      <option value="07">07</option>
      <option value="08">08</option>
      <option value="09">09</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
      <option value="13">13</option>
      <option value="14">14</option>
      <option value="15">15</option>
      <option value="16">16</option>
      <option value="17">17</option>
      <option value="18">18</option>
      <option value="19">19</option>
      <option value="20">20</option>
      <option value="21">21</option>
      <option value="22">22</option>
      <option value="23">23</option>
      <option value="00">00</option>      
      <option value="01">01</option>
      <option value="02">02</option>
      <option value="03">03</option>
      <option value="04">04</option>
      <option value="05">05</option>	  
      </select>&nbsp;<b>:</b>&nbsp;<select name="time_m_2" id="time_m_2">
      <option value="" selected> </option>
      <option value="00">00</option>
      <option value="15">10</option>
      <option value="30">20</option>
      <option value="45">30</option>
      <option value="00">40</option>
      <option value="15">50</option>
      </select>&nbsp;<b>น.</b>
	  <input type="hidden" name="sh_date_3" id="sh_date_3" value="">
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="45">&nbsp;</td>
    <td align="right" valign="top"><strong>คีย์หรือเลือกสถานที่ไป :</strong></td>
    <td valign="top">&nbsp;&nbsp;<label>
     <input type="text" size="32" value="" name="place" id="place" onkeyup="suggest(this.value);" class="" />
     <div class="suggestionsBox_car" id="suggestions" style="display: none;">
     <div class="suggestionList_car" id="suggestionsList"></div>
     </div><IMG SRC="images/car/arrow_place.png" BORDER="0" ALT="ส่งลงล่าง" onclick="send_place('addplace','<?php echo $login_true?>');" align="absmiddle">
	 </label></td>
    <td align="right" valign="top"><strong>ไปเพื่อ :</strong></td>
    <td valign="top">&nbsp;&nbsp;<textarea name="c_why" id="c_why" cols="53" rows="2"></textarea></td>
    <td>&nbsp;</td>
  </tr>  
  <tr>
    <td rowspan="3">&nbsp;</td>
    <td rowspan="3" align="right" valign="top"><br><strong>สถานที่ไป :</strong></td>
    <td rowspan="3" valign="top">&nbsp;&nbsp;<label>
    <textarea name="c_where" id="c_where" cols="45" rows="7" readonly></textarea>
    <br>&nbsp;&nbsp;&nbsp;<IMG SRC="images/car/clear.png" BORDER="0" ALT="เครีย" onclick="send_place('clear','<?php echo $login_true?>');" align="absmiddle">
	</label></td>
    <td height="45" align="right" valign="middle"><strong>รถ :</strong></td>
    <td valign="middle"><label>&nbsp;&nbsp;
		   <select name="c_id_type" id="c_id_type">
           <option value="" selected>---เลือกรถ------</option>
           <?php 
	       while($arr['car_type'] = $db->fetch($res['car_type'])) {
			   empty($arr['car_type']['car_diff'])?$car_diff="":$car_diff=" ".$arr['car_type']['car_diff']."" ;
           ?>
           <option value="<?php echo $arr['car_type']['id'] ;?>">
           <?php echo $arr['car_type']['car_name'].$car_diff ;?>
	       </option>
           <?php  } ?>
           </select>
      </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="45" align="right" valign="middle"><strong>ปลัดหรือผู้แทน :</strong></td>
    <td valign="middle"><label>&nbsp;&nbsp;<select name="c_id_head" id="c_id_head" >
	  <?php 
	  while($arr_p['member'] = $db->fetch($res_p['member'])){	
	  ?> 
      <option value="<?php echo $arr_p['member']['member_id'];?>" selected>
	  <?php echo $arr_p['member']['prefix'];?><?php echo $arr_p['member']['fname'];?>&nbsp;&nbsp;&nbsp;<?php echo $arr_p['member']['lname'];?>
	  </option>
      <?php 
	  }
	  while($arr['admin'] = $db->fetch($res['admin'])){
	  $res_h['member'] = $db->select_query("SELECT member_id,prefix,fname,lname FROM ".TB_MEMBER." WHERE member_id=".$arr['admin']['member_id']." ");
 	  $arr_h['member'] = $db->fetch($res_h['member']);
      ?>
      <option value="<?php echo $arr_h['member']['member_id'];?>">
	  <?php echo $arr_h['member']['prefix'];?><?php echo $arr_h['member']['fname'];?>&nbsp;&nbsp;&nbsp;<?php echo $arr_h['member']['lname'];?>
	  </option>
      <?php  } ?> 	  
      </select>
      </label></td>
    <td>&nbsp;</td>
  </tr>  
  <tr>
    <td height="45" align="right" valign="middle"><strong>ผู้มีอำนาจสั่งใช้รถ :</strong></td>
    <td valign="middle">&nbsp;&nbsp;<select name="c_id_prime" id="c_id_prime">
      <option value="<?php echo $arr_y['member']['member_id'];?>" selected>
      <?php echo $arr_y['member']['prefix'];?><?php echo $arr_y['member']['fname'];?>&nbsp;&nbsp;&nbsp;<?php echo $arr_y['member']['lname'];?>
	  </option>
      <?php 
	  while($arr_l['member'] = $db->fetch($res_l['member'])){
      ?>
      <option value="<?php echo $arr_l['member']['member_id'];?>">
        <?php echo $arr_l['member']['prefix'];?><?php echo $arr_l['member']['fname'];?>&nbsp;&nbsp;&nbsp;<?php echo $arr_l['member']['lname'];?>
	  </option>
      <?php  } ?>
    </select></td>
	<td>&nbsp;</td>
  </tr> 
  <tr>
    <td height="70">&nbsp;</td>
    <td colspan="4" align="center"><label>
    <input type="submit" value=" บันทึกรายการใช้รถ " name="submit">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value=" เคลียร์ " onclick="location.href='index.php?compu=car'">
    </label></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<script language="JavaScript">
dtNow = new Date();
makeCalendar(dtNow.getMonth(), dtNow.getFullYear());

function check() {
if(document.form_car.tCalendar_2.value!="" && document.form_car.time_c_1.value=="" ){
alert("กรุณากำหนด เวลาชั่วโมง  ด้วยครับ") ;
document.form_car.time_c_1.focus() ;
return false ;
}
if(document.form_car.time_c_1.value!="" && document.form_car.time_m_1.value=="" ){
alert("กรุณากำหนด เวลานาที  ด้วยครับ") ;
document.form_car.time_m_1.focus() ;
return false ;
}
if(document.form_car.tCalendar_3.value!="" && document.form_car.time_c_2.value=="" ){
alert("กรุณากำหนด เวลาชั่วโมง  ด้วยครับ") ;
document.form_car.time_c_2.focus() ;
return false ;
}
if(document.form_car.time_c_2.value!="" && document.form_car.time_m_2.value=="" ){
alert("กรุณากำหนด เวลานาที  ด้วยครับ") ;
document.form_car.time_m_2.focus() ;
return false ;
}
if(document.form_car.c_where.value==""){
alert("กรุณากำหนด สถานที่ไป  ด้วยครับ") ;
document.form_car.place.focus() ;
return false ;
}
if(document.form_car.c_why.value==""){
alert("กรุณากำหนด ไปเพื่อ  ด้วยครับ") ;
document.form_car.c_why.focus() ;
return false ;
}
if(document.form_car.c_id_type.value==""){
alert("กรุณาเลือก รถที่ไป  ด้วยครับ") ;
document.form_car.c_id_type.focus() ;
return false ;
}
else 
return true ;
}	
</script>
<?php 
} else {
	echo $ProcessOutput ;
}
$db->closedb ();
?>