<?
 CheckUser_Nopwd($login_true);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="templates/<?=WEB_TEMPLATES;?>/css/style.css" rel="stylesheet" type="text/css">
<link href="naivoi/car/css/style.css" rel="stylesheet" type="text/css">
<?
if($op == "car_add"){
	if(CheckLevelUser_NoOp($login_true)){
               
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
					"c_id_head"=>"".$_POST['c_id_head']."",
					"c_id_prime"=>"".$_POST['c_id_prime']."",					
					"c_status"=>"np"
				));
				
				$db->update_db(TB_MEMBER,array(
			        "place_buffer"=>""
	            	)," user='".$login_true."'");

			$ProcessOutput .= "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?folder=car&file=addcar\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"><BR>ขออนุญาตใหม่</A><BR><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการบันทึกข้อมูล  รายการขออนุญาตใช้รถส่วนกลาง  เรียบร้อยแล้ว</B></FONT>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";

	}else{
	    $PermissionFalse = "ไม่สามารถดเนินการได้" ;
		$ProcessOutput = $PermissionFalse ;
	}
}

?>
<script type="text/javascript"  src="js/calender.js"></script>
<script type="text/javascript" src="js/jquery1.3.2.js"></script>
<script language="javascript" type="text/javascript">
<!--
function suggest(inputString){
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#place').addClass('load');
			$.post("naivoi/car/autosuggest.php", {queryString: ""+inputString+""}, function(data){
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

    document.myform.place.value="";
	 
	}
 
	}

	 if(document.myform.place.value=="" && chk_op !="clear") {
        alert("กรุณากรอกชื่อสถานที่ไปด้วยครับ") ;
        document.myform.place.focus() ;
     return false ;
    }
	
	 if(chk_op=="clear"){

         document.myform.c_where.value="";
		 document.myform.place.value="";
     } 
	
	var place = document.getElementById('place').value; 
	
    var random=Math.random();
    alert("Random="+random) ;
	alert("chk_op="+chk_op) ;
	alert("place="+place) ;
	alert("login_true="+login_true) ;
	
//	ajaxRequest.open("GET", "naivoi/car/sendplace.php?" + "name=" +thaiURI(place) , true);
	ajaxRequest.open("GET", "naivoi/car/sendplace.php?" + "name="+place+"&op="+chk_op+"&login_true="+login_true+"&random="+random , true);
	ajaxRequest.send(null);
 
	}
 
	//-->
</script>
<?

        empty($_SESSION['login_true'])?$login_true="":$login_true=$_SESSION['login_true'];
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['member'] = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE user='".$login_true."' ");
		$arr['member'] = $db->fetch($res['member']);
		$res['position'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id='".$arr['member']['position_id']."' ");
		$arr['position'] = $db->fetch($res['position']);		
?>
<div id="pCalendar" style="position: absolute; left: 10px; top: 10px; visibility: hidden;"></div>     
	<TABLE cellSpacing="0" cellPadding="0" width="950" border="0">
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="940" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/car/texmenu_title.gif" BORDER="0"><span style="font-size:16px;color:#900">

 		   <? if ($arr['member']['user']<>""){?>
          &nbsp;&nbsp;<?=$arr['member']['prefix'];?><?=$arr['member']['fname'];?>&nbsp;<?=$arr['member']['lname'];?></span>&nbsp;&nbsp;<b>ตำแหน่ง</b>&nbsp;<span style="font-size:16px;color:#900">
           <? if ($arr['member']['parties_id']==1){?>
           <?=$arr['member']['position'];?>&nbsp;<?=_OFFICE ; ?>&nbsp;&nbsp;</span>
           <? } else if ($arr['member']['parties_id']==3){ ?>
           <?=$arr['member']['position'];?>&nbsp;<?=_OFFICE ; ?>&nbsp;&nbsp;</span>
           <? } else { ?>            
           <?=$arr['position']['position_name'];?>&nbsp;&nbsp;</span>
           <? } ?>
           <? } ?>
				<TABLE width="940" align="center" cellSpacing="0" cellPadding="0" border="0">
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<BR><B>&nbsp;&nbsp;<IMG SRC="images/car/car_title.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; ลงรายการขอใช้รถส่วนกลาง </B>
					<BR>
<?
if(!$ProcessOutput){

$w=$thai_w[date("w")];
$d=date("d");
$n=$SHORT_MONTH[date("n")];
$m=date("n");
$y=date("Y") +543;
$ye=date("Y");

$date_hid=$ye."-".$m."-".$d ;
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form NAME="myform" METHOD="POST" ACTION="?naivoi=car&voi=addcar&op=car_add">
  <tr>
    <!-- colum 1      -->
    <td valign="top" align="left"><BR>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>วันที่เขียนขออนุญาต :</b><BR>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <input name="tCalendar_1" type="text" id="tCalendar_1" size="16" value="<? echo "$d $n $y" ;?>">&nbsp;<IMG SRC="images/dateselect.gif" BORDER="0" ALT="เลือกวันที่" onClick="showCalendar(this,1)" align="absmiddle"><br>
   <input type="hidden" name="sh_date_1" id="sh_date_1" value="<?=$date_hid ;?>">
   <input  type="hidden" name="c_id_applic" id="c_id_applic" value="<?=$arr['member']['member_id'];?>" >
   <BR><BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>มีคนนั่งไป :</b><BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select  name="c_sit"  id="c_sit" >
                                <option value="" selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
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
      
      
      
      <br>
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <BR><BR>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>สถานที่ไป :</b><BR>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea cols="70" id="c_where" rows="4"  name="c_where" readonly ></textarea><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<IMG SRC="images/car/clear.png" BORDER="0" ALT="เครีย" onclick="send_place('clear','<?=$login_true?>');" align="absmiddle"><BR><BR>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ไปเพื่อ :</b><BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea cols="70" id="c_why" rows="5"  name="c_why" ></textarea>

    </td>
    
    <!-- colum 2      -->
    <td valign="top" align="left">
    <BR><b>ในวันที่ :</b><BR>
      <input name="tCalendar_2" type="text" id="tCalendar_2" size="16" value="<? echo "$d $n $y" ;?>">&nbsp;<IMG SRC="images/dateselect.gif" BORDER="0" ALT="เลือกวันที่" onClick="showCalendar(this,2)" align="absmiddle">&nbsp;&nbsp;&nbsp;<b>เวลา :</b>
      <select name="time_c_1" id="time_c_1">
      <option value="" selected> </option>
      <option value="00">00</option>      
      <option value="01">01</option>
      <option value="02">02</option>
      <option value="03">03</option>
      <option value="04">04</option>
      <option value="05">05</option>
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
      </select>&nbsp;<b>:</b>&nbsp;<select name="time_m_1" id="time_m_1">
      <option value="" selected> </option>
      <option value="00">00</option>
      <option value="15">15</option>
      <option value="30">30</option>
      <option value="45">45</option>
      </select>&nbsp;<b>น.</b>
	  <input type="hidden" name="sh_date_2" id="sh_date_2" value="<?=$date_hid ;?>">
	  <BR><BR>
      <b>และในวันที่ :</b><br>
      <input name="tCalendar_3" type="text" id="tCalendar_3" size="16" value="">&nbsp;<IMG SRC="images/dateselect.gif" BORDER="0" ALT="เลือกวันที่" onClick="showCalendar(this,3)" align="absmiddle">&nbsp;&nbsp;&nbsp;<b>เวลา :</b>
      <select name="time_c_2" id="time_c_2">
      <option value="" selected> </option>
      <option value="00">00</option>      
      <option value="01">01</option>
      <option value="02">02</option>
      <option value="03">03</option>
      <option value="04">04</option>
      <option value="05">05</option>
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
      </select>&nbsp;<b>:</b>&nbsp;<select name="time_m_2" id="time_m_2">
      <option value="" selected> </option>
      <option value="00">00</option>
      <option value="15">15</option>
      <option value="30">30</option>
      <option value="45">45</option>
      </select>&nbsp;<b>น.</b>
	  <input type="hidden" name="sh_date_3" id="sh_date_3" value="">
	  <BR><BR><BR><BR>  
     <b>คีย์หรือเลือกสถานที่ไป :</b><BR>
     <input type="text" size="28" value="" name="place" id="place" onkeyup="suggest(this.value);" onblur="fill();" class="" />
     <div class="suggestionsBox_car" id="suggestions" style="display: none;">
     <div class="suggestionList_car" id="suggestionsList"></div>
     </div><IMG SRC="images/car/arrow_place.png" BORDER="0" ALT="ส่งไปซ้าย" onclick="send_place('addplace','<?=$login_true?>');" align="absmiddle">
	 <BR><BR><BR><BR><BR>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ปลัดหรือผู้แทน :</b><BR>
    <?
	$res_p['member'] = $db->select_query("SELECT member_id,prefix,fname,lname FROM ".TB_MEMBER." WHERE parties_id='3' ORDER BY member_id DESC ");
	$res['admin'] = $db->select_query("SELECT member_id FROM ".TB_ADMIN." WHERE level='4' AND elect='0' ORDER BY id DESC");
	?>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="c_id_head" id="c_id_head">
	<?
	 while($arr_p['member'] = $db->fetch($res_p['member'])){	
	?> 
      <option value="<?=$arr_p['member']['member_id'];?>" selected><?=$arr_p['member']['prefix'];?><?=$arr_p['member']['fname'];?>&nbsp;<?=$arr_p['member']['lname'];?></option>
     <?
	 }
	 while($arr['admin'] = $db->fetch($res['admin'])){
	 $res_h['member'] = $db->select_query("SELECT member_id,prefix,fname,lname FROM ".TB_MEMBER." WHERE member_id=".$arr['admin']['member_id']." ");
 	 $arr_h['member'] = $db->fetch($res_h['member']);
     ?>
      <option value="<?=$arr_h['member']['member_id'];?>"><?=$arr_h['member']['prefix'];?><?=$arr_h['member']['fname'];?>&nbsp;<?=$arr_h['member']['lname'];?></option>
     <? } ?>  
      </select>
      <BR><BR>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ผู้มีอำนาจสั่งใช้รถ :</b><BR>
    <?
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
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="c_id_prime" id="c_id_prime">
      <option value="<?=$arr_y['member']['member_id'];?>" selected><?=$arr_y['member']['prefix'];?><?=$arr_y['member']['fname'];?>&nbsp;<?=$arr_y['member']['lname'];?></option>
     <?
	 while($arr_l['member'] = $db->fetch($res_l['member'])){
     ?>
      <option value="<?=$arr_l['member']['member_id'];?>"><?=$arr_l['member']['prefix'];?><?=$arr_l['member']['fname'];?>&nbsp;<?=$arr_l['member']['lname'];?></option>
     <? } ?>  
      </select>
    </td>
  </tr>
  <tr>
  <td colspan="2" valign="center"><br>
  <input type="submit" value="บันทึกรายการใช้รถ" name="submit">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value=" เคลีย " name="reset">
  <br>&nbsp; 
  </td>
  </tr>
 </form>
</table>
<?
}else{
	echo $ProcessOutput ;
}
$db->closedb ();
?>
					</TD>
				</TR>
			</TABLE>
				</TD>
				</TR>
			</TABLE>
<script language="JavaScript">
dtNow = new Date();
makeCalendar(dtNow.getMonth(), dtNow.getFullYear());
</script>			