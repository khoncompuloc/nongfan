<?php
  notview();
//CheckAdmin($admin_user, $admin_pwd);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="psdloc/material/css/style.css" rel="stylesheet" type="text/css">
<?

if($op == "" and !$ProcessOutput){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

/***	
	$limit = 20 ;
	$SUMPAGE = $db->num_rows(TB_STOCK_SECTION55,"sd_id","sd_logic=0 and sd_print = 0 group by sd_date, section_id") ;
	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
***/	
?>

<TABLE cellSpacing="0" cellPadding="0" width="750" border="0" >
   <TBODY>
    <TR>
     <TD width="10" vAlign="top"><IMG src="images/fader.gif" border="0"></TD>
     <TD width="740" vAlign="top"><IMG src="images/topfader.gif" border="0"><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/material/texmenu_stock_requis.gif" BORDER="0"><span style="font-size:16px;color:#900">
 <table width="100%" cellspacing="2" cellpadding="1" >
 <form name="myform" method="post"> 
 <tr bgcolor="#0066FF" height=25>
   <td width="15%"><CENTER><font color="#FFFFFF"><B>ลำดับที่</B></font></CENTER></td>
   <td width="40%"><CENTER><font color="#FFFFFF"><B>ส่วน/กอง งาน</B></font></CENTER></td>
   <td width="25%"><CENTER><font color="#FFFFFF"><B>วัน เดือน ปี</B></font></CENTER></td>
   <td width="20%"><CENTER><font color="#FFFFFF"><B>รายละเอียด<?//=$SUMPAGE ;?></B></font></CENTER></td>
  </tr>  
<?
$count=0;
$num=0;
//$res['stock_details'] = $db->select_query("SELECT sd_date, section_id FROM ".TB_STOCK_SECTION.$_SESSION['budget_year']." WHERE sd_logic=0 and sd_print = 0 GROUP BY sd_date, section_id ORDER BY sd_date DESC LIMIT $goto, $limit ");

if($_SESSION['section_id']==0 OR $_SESSION['admin_level'] == 2){
$res['stock_details'] = $db->select_query("SELECT sd_date, UNIX_TIMESTAMP(sd_date) AS thaidate, section_id FROM ".TB_STOCK_SECTION.$budget." WHERE sd_logic='0' AND sd_print='0' GROUP BY sd_date, section_id ORDER BY thaidate");
} else {
$res['stock_details'] = $db->select_query("SELECT sd_date, UNIX_TIMESTAMP(sd_date) AS thaidate, section_id FROM ".TB_STOCK_SECTION.$budget." WHERE sd_logic='0' AND sd_print='0' AND section_id= ".$_SESSION['section_id']." GROUP BY sd_date, section_id ORDER BY thaidate");
}

while($arr['stock_details'] = $db->fetch($res['stock_details'])) {
	$res['member_section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." WHERE section_id=".$arr['stock_details']['section_id']."");
	$arr['member_section'] = $db->fetch($res['member_section']);
	
if($wsd_card == 0) {
$res['order_requis'] = $db->select_query("SELECT order_requistion, section_id FROM ".TB_STOCK_DATA." WHERE section_id=0 ");
} else if($wsd_card == 1) {
$res['order_requis'] = $db->select_query("SELECT order_requistion, section_id FROM ".TB_STOCK_DATA." WHERE section_id=".$arr['stock_details']['section_id']."");
}
$arr['order_requis'] = $db->fetch($res['order_requis']) ;
$order_requistion = $arr['order_requis']['order_requistion']+1 ;	

if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = "#FDEAFB";
} else {
$ColorFill = "#F0F0F0";
}
$num = $num + 1 ;
echo "<script language=\"javascript\" type=\"text/javascript\">" ;
echo "function  requistion_Open".$num."(form) { " ;
echo "window.open(\"?folder=material&file=printit&sd_date=\"+form.sd_date".$num.".value+\"&section_id=\"+form.section_id".$num.".value+\"&wsd_card=\"+form.wsd_card".$num.".value+\"\",\"\",\"toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=880,height=750,left=10,top=10\"); ";
echo "}" ;
echo "</script>" ;  
?>

    <tr bgcolor="<?=$ColorFill; ?>" onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='<?=$ColorFill;?>' ">
     <td align="center"><CENTER><?=$num ;?>(<?=$arr['order_requis']['section_id'];?>)<?=$_SESSION['section_id'];?></CENTER></td>
     <td align="center"><CENTER><?=$arr['member_section']['section_name'] ;?></CENTER></td>
     <td align="center"><CENTER><?=ThaiTimeConvert($arr['stock_details']['thaidate'],"3","");?></CENTER></td>
     <td align="center"><CENTER><?//=$SUMPAGE ;?><input type="button" onClick="requistion_Open<?=$num ;?>(this.form)" value="พิมพ์ใบเบิกลำดับที่ี :<?=$order_requistion ;?>"></CENTER></td>
    </tr>
	<tr>
		<TD colspan="4" height="1" class="dotline">
		<input type="hidden" name="sd_date<?=$num ;?>" id="sd_date<?=$num ;?>" value="<?=$arr['stock_details']['sd_date'] ; //วันที่ ?>"> 
        <input type="hidden" name="wsd_card<?=$num ;?>" id="wsd_card<?=$num ;?>" value="<?=$wsd_card ; //รวมหรือแยกหน่วยงาน ?>"> 		
		<input type="hidden" name="section_id<?=$num ;?>" id="section_id<?=$num ;?>" value="<?=$arr['member_section']['section_id'] ; //รหัสหน่วยงาน ?>"> 
		</TD>
    </tr>
	
	
<?
	$count++;
	$order_requistion = $order_requistion + 1 ;
 } 
?>
 </form>
 </table>
 <BR><BR>
<?

/***
	SplitPage($page,$totalpage,"?folder=admin&file=blog");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
***/	
	
}
?>
    	</TD>
	</TR>
</TABLE>