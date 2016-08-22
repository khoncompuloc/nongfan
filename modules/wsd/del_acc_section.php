<html>
<head>
<title></title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<script language="javascript">
	function close_windows()
	{
	    window.close();
	}	
	function close_reload()
	{
	    window.close();
		window.opener.location.reload();
	}		
</script>
<?php
            empty($_GET['op'])?$op="":$op=$_GET['op'] ;
			empty($_GET['action'])?$action="":$action=$_GET['action'] ;
			require_once("../../mainfile.php");			
			
if($op == "del" and $action == "del") {	

 			$ss_id = $_POST['ss_id'];
			
	        $res['stock_section'] = $db->select_query("SELECT ss_id ,ss_amount ,ss_logic ,section_id ,srs_number ,shp_id FROM ".TB_STOCK_SECTION." WHERE ss_id='".$ss_id."'");
	        $arr['stock_section'] = $db->fetch($res['stock_section']);
	        $res['stock_price'] = $db->select_query("SELECT shp_id ,shp_amountcost FROM ".TB_STOCK_HEAD_PRICE." WHERE shp_id='".$arr['stock_section']['shp_id']."'");
	        $arr['stock_price'] = $db->fetch($res['stock_price']);			

			if($arr['stock_section']['ss_logic'] == '0'){
				
				$srs_requistion_logic = 0 ;
				$ss_amount = $arr['stock_price']['shp_amountcost'] + $arr['stock_section']['ss_amount'] ;
				
				echo "ss_amount = ".$ss_amount ;
				
				
				$db->update_db(TB_STOCK_HEAD_PRICE,array(
				"shp_amountcost"=>"".$ss_amount.""
				)," shp_id='".$arr['stock_price']['shp_id']."'");
				
				$db->update_db(TB_STOCK_REQUISTION_SECTION,array(
				"srs_requistion_logic"=>"".$srs_requistion_logic.""
				)," srs_number='".$arr['stock_section']['srs_number']."' and section_id='".$arr['stock_section']['section_id']."'");				
				
				$db->del(TB_STOCK_SECTION," ss_id='".$ss_id."' ");
				
				echo "<script type=\"text/javascript\">" ;
                echo "close_reload();" ;
                echo "</script>" ;				
			
			} else if($arr['stock_section']['ss_logic'] == '1'){
				 
				$ss_amount = $arr['stock_price']['shp_amountcost'] - $arr['stock_section']['ss_amount'] ;

				
				$db->del(TB_STOCK_SECTION," ss_id='".$ss_id."' ");
				
				$db->update_db(TB_STOCK_HEAD_PRICE,array(
				"shp_amountcost"=>"".$ss_amount.""
				)," shp_id='".$arr['stock_price']['shp_id']."'");
				
				echo "<script type=\"text/javascript\">" ;
                echo "close_reload();" ;
                echo "</script>" ;

			}	
} else if($op == "" and $action == "") { 			
			
			$ss_id = $_GET['data'];
			
	        $res['stock_section'] = $db->select_query("SELECT ss_id ,UNIX_TIMESTAMP(ss_date) AS st_date ,ss_name ,ss_ref ,ss_logic FROM ".TB_STOCK_SECTION." WHERE ss_id='".$ss_id."'");
	        $arr['stock_section'] = $db->fetch($res['stock_section']);			
            if($arr['stock_section']['ss_logic'] == '0'){ $sslogic_name='จ่ายให้';} else if($arr['stock_section']['ss_logic'] == '1'){ $sslogic_name='รับจาก';}
?>
</head>
<body>
<form NAME="frmMain" METHOD="post" ACTION="del_acc_section.php?op=del&action=del">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10%" height="35"></td>
    <td width="30%" align="right">วัน เดือน ปี :</td>
	<td width="50%" align="left">&nbsp;&nbsp;&nbsp;<b><?php echo " ".ThaiTimeConvert($arr['stock_section']['st_date'],"5","") ;?></b></td>
	<td width="10%" align="right"></td>
</tr>
<tr>
    <td width="10%" height="35"></td>
    <td width="30%" align="right"><?php echo $sslogic_name ;?> :</td>
    <td width="50%" align="left">&nbsp;&nbsp;&nbsp;<b><?php echo " ".$arr['stock_section']['ss_name'] ;?></b></td>
	</td>
	<td width="10%" align="right"></td>	
</tr>
<tr>
    <td width="10%" height="35"></td>
    <td width="30%" align="right">เลขที่เอกสาร :</td>
	<td width="50%" align="left">&nbsp;&nbsp;&nbsp;<b><?php echo " ".$arr['stock_section']['ss_ref'] ;?></b></td>
	<td width="10%" align="right"></td>
</tr>
<tr>
    <td width="100%" height="20" colspan="4"></td>
</tr>
<tr>
    <td height="35" colspan="4" align="center">
	<input type="submit" name="submit" id="submit" value="  ต้องการลบข้อมูลแถวสุดท้าย  ">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input  type="button" onClick="close_windows();" value=" ปิดหน้าต่างนี้ ">
	<input  type="hidden" name="ss_id" id="ss_id" value="<?php echo $arr['stock_section']['ss_id'] ;?>">
	</td>
</tr>
</table>
</form>
<?php
}
$db->closedb ();
?>
</body>
</html>