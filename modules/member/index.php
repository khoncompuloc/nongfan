<?php
		$res['member'] = $db->select_query("SELECT member_id, prefix, fname, lname, address, district, amphur, province, zipcode, mobile, position_id, member_pic FROM ".TB_MEMBER." WHERE parties_id='1' ORDER BY degree_id DESC ");
		while($arr['member'] = $db->fetch($res['member'])) { 
		$res['position'] = $db->select_query("SELECT position_name FROM ".TB_MEMBER_POSITION." WHERE position_id='".$arr['member']['position_id']."'");
		$arr['position'] = $db->fetch($res['position']);
		            
					if(WEB_AGEN_MINI == "อบต.") {
		              $agenname = "องค์การบริหารส่วนตำบล" ;
		            } else if(WEB_AGEN_MINI == "ทต.") {
		              $agenname = "เทศมนตรีตำบล" ;
		            }		
?>
<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td height="5" colspan="4"></td>
  </tr>
  <tr>
    <td width="250" height="105" rowspan="3" align="center"><img src="images/personnel/thb_<?php echo $arr['member']['member_pic']; ?>" height="105" align="baseline" /></td>
    <td width="100" height="35" align="right">ชื่อ-สกุล :</td>
    <td width="540">&nbsp;&nbsp;&nbsp;<?php echo $arr['member']['prefix']; ?><?php echo $arr['member']['fname']; ?>&nbsp;&nbsp;&nbsp;<?php echo $arr['member']['lname']; ?></td>
    <td></td>
  </tr>
  <tr>
    <td height="35" align="right">ตำแหน่ง :</td>
    <td>&nbsp;&nbsp;&nbsp;<?php echo $arr['position']['position_name'].$agenname.WEB_AGEN_NAME ; ?></td>
<!--<td>&nbsp;&nbsp;&nbsp;<?php //echo $arr['position']['position_name'].WEB_AGEN_FULL.WEB_AGEN_NAME ; ?></td> -->
    <td></td>
  </tr>
  <tr>
    <td height="35" align="right">เบอร์ติดต่อ :</td>
    <td>&nbsp;&nbsp;&nbsp;<?php echo $arr['member']['mobile']; ?></td>
    <td></td>
  </tr>
  <tr>
    <td height="35" align="center"></td>
    <td align="right">ที่อยู่ :</td>
    <td>&nbsp;&nbsp;&nbsp;<?php echo $arr['member']['address']; ?>&nbsp;ต.&nbsp;<?php echo $arr['member']['district']; ?>&nbsp;อ.&nbsp;<?php echo $arr['member']['amphur']; ?>&nbsp;จ.&nbsp;<?php echo $arr['member']['province']; ?>&nbsp;รหัสไปรษณีย์&nbsp;<?php echo $arr['member']['zipcode']; ?></td>
    <td></td>
  </tr>
  <tr>
    <td height="5" colspan="4"></td>
  </tr>
	<tr height="1">
		<td height="1" class="dotline" colspan="4">
		</td>
	</tr> 
  <tr>
    <td height="10" colspan="4"></td>
  </tr>	
</table>
<?php } ?>