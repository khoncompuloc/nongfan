<?php
Check_passadu($admin_user,$admin_level);
?>
<link href="modules/wsd/css/style.css" rel="stylesheet" type="text/css">
<!-- <script type="text/javascript" src="js/jquery1.3.2.js"></script> -->
<TABLE cellSpacing="0" cellPadding="0" width="100%" border="0">
    <TR>
        <TD width="10" vAlign="top"><IMG src="images/fader.gif" border=0></TD>
        <TD width="830" vAlign="top"><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin 
		  &nbsp;&nbsp;<IMG SRC="images/wsd/texmenu_stock_new.gif" BORDER="0"><span style="font-size:16px;color:#900"> 
		  --> 
<?php
//empty($ProcessOutput)?$ProcessOutput="":$ProcessOutput=$ProcessOutput ;
if(!$data) {
?>
<center>
<?php 
echo "<table cellpadding=0 cellspacing=0 bordercolor=#0A7CC0 border=0  width=650>";
echo "<tr>";
echo "</tr><tr><td>&nbsp;&nbsp;</td></tr>";
echo "<tr><td align=center >";
?>
    <div id="body">
            <div id="cpanel">
                <div style="float:left;">
                    <div class="icon">
                        <a href="?compu=wsd&loc=check_material&data=1">
                        <img src="images/admin/config.png" alt="สำนักปลัด" align="middle" border="0" />
                        <span>สำนักปลัด</span>
                        </a>
                     </div>
                </div>
                <div style="float:left;">
                    <div class="icon">
                        <a href="?compu=wsd&loc=check_material&data=2">
                        <img src="images/admin/user.png" alt="ส่วนการคลัง" align="middle" border="0" />
                        <span>ส่วนการคลัง</span>
                        </a>
                    </div>
                </div>
                <div style="float:left;">
                    <div class="icon">
                        <a href="?compu=wsd&loc=check_material&data=3">
						<img src="images/admin/member_add.png" alt="ส่วนโยธา" align="middle" border="0" />
						<span>ส่วนโยธา</span>
                        </a>
                     </div>
                </div>
                <div style="float:left;">
                    <div class="icon">
                        <a href="?compu=wsd&loc=check_material&data=4">
                        <img src="images/admin/material.png" alt="ส่วนการศึกษาฯ" align="middle" border="0" />
                        <span>ส่วนการศึกษาฯ</span>
                        </a>
                    </div>
                </div>
            </div>
    </div>
</td>
</tr>
<tr><td>&nbsp;&nbsp;</td></tr>
</table>
</center>
<?php
} else if($data){

	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	//$limit = 15 ;
	//$SUMPAGE = $db->num_rows(TB_STOCK_HEAD,"sh_id","");

	//if (empty($page)){
	//	$page=1;
	//}
	//$rt = $SUMPAGE%$limit ;
	//$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	//$goto = ($page-1)*$limit ;
//	echo "type_id =".$_POST['type_id'] ;
//	echo "<br>subtype_id =".$_POST['subtype_id'] ;
?>
 
 <table width="100%" cellspacing="2" cellpadding="1" >
  <tr bgcolor="#0066FF" height="20">
   <td width="25"><CENTER><font color="#FFFFFF"><B>ที่</B></font></CENTER></td>
   <td width="70"><CENTER><font color="#FFFFFF"><B>รหัส</B></font></CENTER></td>
   <td><CENTER><font color="#FFFFFF"><B>ชื่อหรือชนิดวัสดุ (ขนาด/ลักษณะ)</B></font></CENTER></td>
   <td width="250"><CENTER><font color="#FFFFFF"><B>ประเภทย่อย</B></font></CENTER></td>
   <td width="70"><CENTER><font color="#FFFFFF"><B>จำนวนเหลือ</B></font></CENTER></td>  
   <td width="70"><CENTER><font color="#FFFFFF"><B>หน่วยนับ</B></font></CENTER></td>     
  </tr> 
<?php  
$res['stock_type'] = $db->select_query("SELECT * FROM ".TB_STOCK_TYPE."");
while($arr['stock_type'] = $db->fetch($res['stock_type'])){ 
$res['stock_subtype'] = $db->select_query("SELECT * FROM ".TB_STOCK_SUBTYPE." WHERE type_id='".$arr['stock_type']['type_id']."'");
$count=0;
?>
    <tr>
	<td colspan="6" bgcolor="#FFF" align="left"><b><?php echo $arr['stock_type']['type_name'] ;?></b></td>
	</tr>
<?php
while($arr['stock_subtype'] = $db->fetch($res['stock_subtype'])){  
//$res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." ORDER BY sh_id LIMIT $goto, $limit ");
$res['stock_head_budget'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD_SECTION." WHERE section_id=".$data."");
while($arr['stock_head_budget'] = $db->fetch($res['stock_head_budget'])){
    
    $res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE sh_id=".$arr['stock_head_budget']['sh_id']." AND type_id=".$arr['stock_type']['type_id']." AND subtype_id=".$arr['stock_subtype']['subtype_id']."");
	$arr['stock_head'] = $db->fetch($res['stock_head']);
	$rows['stock_head'] = $db->rows($res['stock_head']);
	if($rows['stock_head']){
	empty($arr['stock_head']['sh_diff_name'])?$sh_diff_name="":$sh_diff_name=" ( ".$arr['stock_head']['sh_diff_name']." )" ;
	//$res['stock_type'] = $db->select_query("SELECT * FROM ".TB_STOCK_TYPE." WHERE type_id='".$arr['stock_head']['type_id']."' ");
	//$arr['stock_type'] = $db->fetch($res['stock_type']);
	//$res['stock_subtype'] = $db->select_query("SELECT * FROM ".TB_STOCK_SUBTYPE." WHERE subtype_id='".$arr['stock_head']['subtype_id']."' ");
	//$arr['stock_subtype'] = $db->fetch($res['stock_subtype']);	
	
	//Comment Icon
	if($arr['stock_subtype']['subtype_id']){
		$stock_subtype = $arr['stock_subtype']['subtype_name'] ;
	}else{
		$stock_subtype = "-";
	}
    $res['head_from_amountcost'] = $db->select_query("SELECT SUM(shf_amountcost) AS amountcost  FROM ".TB_STOCK_HEAD_PRICE." WHERE shb_id=".$arr['stock_head_budget']['shb_id']."");
	$arr['head_from_amountcost'] = $db->fetch($res['head_from_amountcost']);
	
	
    if($count%2==0) { //ส่วนของการ สลับสี 
      $ColorFill = "#FDEAFB";
    } else {
      $ColorFill = "#F0F0F0";
    }

?>
    <tr bgcolor="<?php echo $ColorFill; ?>" onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='<?php echo $ColorFill;?>' " height="20">
     <td align="center"><?php echo $count+1 ;?></td>
	 <td align="center"><?php echo $arr['stock_head']['sh_code_id'];?></td>	 
     <td align="left"><?php echo $arr['stock_head']['sh_name'];?><?php echo $sh_diff_name; ?><?php //echo $CommentIcon;?></td>
     <td align="left"><?php echo $stock_subtype ;?></td>
     <td align="center"><font color="#FF0000"><b><?php echo $arr['head_from_amountcost']['amountcost'] ;?></b></font></td>
     <td align="center"><?php echo $arr['stock_head']['sh_unit'] ;?></td>
    </tr>
<?php
    $count++;
	}
 } 
}
}
//  if($count == 0){
//    echo "<tr>";
//	  echo "<td colspan=\"6\" bgcolor=\"#FFF\" align=\"left\"><b>ไม่มีรายการวัสดุ</b></td>";
//	  echo "</tr>";		
//	}
?>
 </table>
<BR><center>
<?php
	//SplitPage($page,$totalpage,"?compu=material&loc=check_material");
	//echo $ShowSumPages ;
	//echo " aaaa ";
	//echo $ShowPages ;
    echo "<br><br><a href=\"?compu=material&loc=check_material_word\" >พิมพ์สรุปวัสดุคงเหลือ</a></center>" ; //<img src=\"images/material/add_new_material.png\" alt=\"เพิ่มวัสดุตัวใหม่\" align=\"middle\" border=\"0\" width=\"176\" height=\"23\" />

}  else {
	echo $ProcessOutput ;
}
$db->closedb();
?>
		</TD>
    </TR>
</TABLE>