<?php 
        CheckUser_Nopwd($login_true);
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
        //ผู้ขอใช้รถ					
		$res["member"] = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE user='".$login_true."' ");
		$arr["member"] = $db->fetch($res["member"]);
		$res["position"] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id='".$arr["member"]["position_id"]."' ");
		$arr["position"] = $db->fetch($res["position"]);
        $res['degree'] = $db->select_query("SELECT degree_name FROM ".TB_MEMBER_DEGREE." WHERE degree_id='".$arr['member']['degree_id']."'");
		$arr['degree'] = $db->fetch($res['degree']);		
		//รายละเอียดขอใช้รถ
		$res["permission"] = $db->select_query("SELECT id, UNIX_TIMESTAMP(c_date_applic) AS date_applic, c_id_applic, c_where, c_why, c_sit, UNIX_TIMESTAMP(c_in_date1)
		                      AS in_date1, c_in_time1, UNIX_TIMESTAMP(c_in_date2) AS in_date2, c_in_time2, c_car_type, c_id_head, c_id_prime, c_status FROM ".TB_CAR_PERMISSION." WHERE c_id_applic='".$arr["member"]["member_id"]."' ORDER BY id DESC");
        $num = 1 ;							  
?>
<table width="940" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30" height="50"></td>
    <td width="170" align="right"><img src="images/car/car_title.gif" width="30" height="23" align="baseline" />&nbsp;<img src="images/car/texmenu_title.gif" width="77" height="32" align="baseline" /></td>
    <td align="left">&nbsp;&nbsp;<b>
 		   <?php  if ($arr["member"]["user"]<>""){?>
          &nbsp;&nbsp;<span style="font-size:16px;color:#044e6a"><?php echo $arr["member"]["prefix"];?><?php echo $arr["member"]["fname"];?>&nbsp;<?php echo $arr["member"]["lname"];?></span>&nbsp;&nbsp;ตำแหน่ง&nbsp;
		  <span style="font-size:16px;color:#044e6a">
           <?php   if ($arr['member']['parties_id']==1){
				    if(WEB_AGEN_MINI == "อบต.") {
		              $agenname = $arr['position']['position_name']."องค์การบริหารส่วนตำบล".WEB_AGEN_NAME ;
		            } else if(WEB_AGEN_MINI == "ทต.") {
		              $agenname = $arr['position']['position_name']."เทศมนตรีตำบล".WEB_AGEN_NAME ;
		            }   
		   ?>
           <?php echo $agenname ; ?>&nbsp;&nbsp;</span>
           <?php  } else if ($arr["member"]["parties_id"]==3){ ?>
           <?php echo $arr["position"]["position_name"];?><?php echo WEB_AGEN_FULL.WEB_AGEN_NAME ; ?>&nbsp;&nbsp;</span>
           <?php  } else { ?>            
           <?php echo $arr["position"]["position_name"].$arr['degree']['degree_name'] ;?>&nbsp;&nbsp;</span>
           <?php  } ?>
           <?php  } ?>	
	</b></td>
    <td></td>
  </tr>
  <tr>
    <td height="50"></td>
	<td colspan="2">
	<table width="920" border="1" cellspacing="0" cellpadding="0">
	<tr>
    <td width="32" height="50" align="center"><b>ที่</b></td>
    <td width="115" align="center"><b>วันที่เขียนขอใช้รถ<br>[รถ]</b></td>
    <td width="100" align="center"><b>ไปวันที่<br>[เวลา]</b></td>
    <td width="100" align="center"><b>กลับวันที่<br>[เวลา]</b></td>
    <td width="293" align="center"><b>สถานที่ไป<br>[ไปเพื่อ]</b></td>
    <td width="200" align="center"><b>ปลัดหรือผู้แทน<br>[ผู้มีอำนาจสั่งใช้รถ]</b></td>
	<td width="80" align="center"><b>สถานะ</b></td>
	</tr>
<?php 	    if($db->rows($res["permission"])) {
        while($arr["permission"] = $db->fetch($res["permission"])) {
		$res["head"] = $db->select_query("SELECT prefix, fname, lname FROM ".TB_MEMBER." WHERE member_id='".$arr["permission"]["c_id_head"]."' ");
		$arr["head"] = $db->fetch($res["head"]);
		$res["prime"] = $db->select_query("SELECT prefix, fname, lname FROM ".TB_MEMBER." WHERE member_id='".$arr["permission"]["c_id_prime"]."' ");
		$arr["prime"] = $db->fetch($res["prime"]);
		$res["car"] = $db->select_query("SELECT car_name FROM ".TB_CAR_TYPE." WHERE id='".$arr["permission"]["c_car_type"]."' ");
		$arr["car"] = $db->fetch($res["car"]);		
		
        if($arr["permission"]["c_status"] == "np"){
			$status = "<b><font color=#ff0000>กำลังพิมพ์</font></b>" ;	
        } else {
			$status = "<b><font color=#aaaaaa>เรียบร้อย..</font></b>" ;
		}		
?>
    <tr>
    <td height="60" align="center"><?php echo $num ;?></td>
    <td align="center"><?php  if($arr["permission"]["date_applic"] != 0){echo ThaiTimeConvert($arr["permission"]["date_applic"],"5","");} else {echo "-";} ?><br><br>
	<?php  if($arr["permission"]["c_car_type"] != 0){ echo "[".$arr["car"]["car_name"]."]" ;} else {echo " ";} ?>
	</td>
    <td align="center"><?php  if($arr["permission"]["in_date1"] != 0){echo ThaiTimeConvert($arr["permission"]["in_date1"],"5","");} else {echo "-";} ?><br><br>
	<?php  if($arr["permission"]["c_in_time1"] != 0){ echo "[".$arr["permission"]["c_in_time1"]."&nbsp;&nbsp;น.]" ;} else {echo " ";} ?>
	</td>
    <td align="center"><?php  if($arr["permission"]["in_date2"] != 0){echo ThaiTimeConvert($arr["permission"]["in_date2"],"5","");} else {echo "-";} ?><br><br>
	<?php  if($arr["permission"]["c_in_time2"] != 0){ echo "[".$arr["permission"]["c_in_time2"]."&nbsp;&nbsp;น.]" ;} else {echo " ";} ?>
	</td>
    <td align="center"><?php  if($arr["permission"]["c_where"] != ""){ echo $arr["permission"]["c_where"] ;} else {echo "-";}?><br><br>
	<?php  if($arr["permission"]["c_why"] != ""){ echo "[".$arr["permission"]["c_why"]."]" ;} else {echo " ";} ?>
	</td>
    <td align="center"><?php echo $arr["head"]["prefix"] ;?><?php echo $arr["head"]["fname"] ;?>&nbsp;&nbsp;&nbsp<?php echo $arr["head"]["lname"] ;?> <br><br>
	[<?php echo $arr["prime"]["prefix"] ;?><?php echo $arr["prime"]["fname"] ;?>&nbsp;&nbsp;&nbsp;<?php echo $arr["prime"]["lname"] ;?>]
	</td>
    <td height="60" align="center"><?php echo $status ;?></td>	
    </tr>
<?php   $num++ ; } } else {?>
	<tr>
    <td height="50" align="center" colspan="8"><b>ไม่มีรายการขออนุญาตใช้รถ</b></td>
	</tr>
<?php  } ?>	
	</table>
    </td>
    <td></td>
  </tr>
  <tr>
    <td height="50"></td>
	<td colspan="2"></td>
    <td></td>
  </tr>	
</table>