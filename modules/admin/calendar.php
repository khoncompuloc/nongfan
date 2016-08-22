<?
CheckAdmin($admin_user, $admin_pwd);
?>
<style type="text/css">
<!--
.calendar { 
    width:220;
    background-color: #FFFFFF;
}
-->
</style>

	<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="810" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="800" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?folder=admin&file=main">หน้าหลักผู้ดูแลระบบ</A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; ปฏิทินกิจกรรม &nbsp;&nbsp;<IMG SRC="images/icon/calendar.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <A href="shadow.php?folder=admin&file=addevent" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 700, objectHeight: 800} )" class="highslide">เพิ่มรายการใหม่ </A></B>
					<BR><BR>
						<CENTER>
								<table>
		<tr>
		<td>
						<?
						if(empty($_GET['year'])){
							$_GET['year'] = date("Y");
						}
						$cal = new MyCalendar;
						echo $cal->getYearView($_GET['year']);
						?>
						</CENTER>
						<BR><BR>
									<!-- End News -->
		</td>
		</tr>
		</table>
						<table>
		<tr><td colspan=5 align=center ><font color=#990099><h4><b>กิจกรรมประจำเดือนนี้</b></font></td></tr>

		<tr>
		<td bgcolor="#0099CC" width="20" align="center"><h5><font color="#FFFFFF">ที่</td><td bgcolor="#0099CC" width="100" align="center"><h5><font color="#FFFFFF">วัน เดือน ปี</td><td bgcolor="#0099CC" width="150" align="center"><h5><font color="#FFFFFF">กิจกรรม</td><td bgcolor="#0099CC" width="300" align="center"><h5><font color="#FFFFFF">รายละเอียด</td><td bgcolor="#0099CC" width="60" align="center"><h5><font color="#FFFFFF">เวลา</td></tr>

	<?
	$mt=date('m');
	$my=date('Y');
$res['calendar'] = $db->select_query("SELECT * FROM ".TB_CALENDAR." where date_event between  '$my-$mt-01' and '$my-$mt-31' ORDER BY date_event  ");
$count=0;
$rank=1;
$resa['calendar'] = $db->select_query("SELECT * FROM ".TB_CALENDAR." where date_event between  '$my-$mt-01' and '$my-$mt-31' ORDER BY date_event  ");
$arrs['calendar'] = $db->fetch($resa['calendar']);
$id=$arrs['calendar']['id'];
if ($id !='') {
$count=0;
while($arr['calendar'] = $db->fetch($res['calendar'])){

	$year=substr($arr['calendar']['date_event'],0,4);
    $month=substr($arr['calendar']['date_event'],6,2)-1;
	$day=substr($arr['calendar']['date_event'],8,2);
//echo "$day-$month-$year";
//	$link = $this->getDateLink($day, $month, $year);
            $link['link'] = "popup.php?folder=calendar&file=view&id=".$arr['calendar']['id']."&dates=".$arr['calendar']['date_event']."";
			$arr['calendar']['subject'] = eregi_replace("\'", "&#039;", $arr['calendar']['subject']);
			$arr['calendar']['subject'] = htmlspecialchars($arr['calendar']['subject']);
			$link['title'] = "".stripslashes($arr['calendar']['subject'])."";

    if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = "#FDEAFB";
} else {
$ColorFill = "#F0F0F0";
}

?>
    <tr bgcolor="<?=$ColorFill; ?>" onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='<?=$ColorFill;?>' ">
			<TD  align="center"><?=$rank;?></td><TD   valign=top align="center">[' <? echo $arr['calendar']['date_event']; ?>']</td><TD ><img src="images/a.gif" border="0"><? echo "<a href=\"".$link['link']."\" onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 700, objectHeight: 500} )\" )\">"; ?><font color="<?=$textfill; ?>"><b><? echo $arr['calendar']['subject']; ?></a></td><TD >	<? echo $arr['calendar']['detail']; ?></td><TD  align="center"><? echo $arr['calendar']['timeout']; ?></td>
												</tr>
												<tr>
            <td height="1" align="left" class="dotline" colspan="5"></td>
			</tr>
<?
	$count++;
				$rank++;
}

}	
else {
echo "<tr><td colspan=5 align=center bgcolor=#FDEAFB><font color=#990000><b><< ไม่มีกิจกรรมในเดือนนี้ >></b></font></td></tr>";
}
$db->closedb ();
?>


		</table>
					</TD>
				</TR>
			</TABLE>
				</TD>
				</TR>
			</TABLE>
