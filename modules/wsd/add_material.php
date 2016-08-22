<?php
notview();
Check_passadu($admin_user,$admin_level);
empty($ProcessOutput)?$ProcessOutput="":$ProcessOutput=$ProcessOutput ;
empty($_SESSION['section_id'])?$_SESSION['section_id']="":$_SESSION['section_id']=$_SESSION['section_id'] ;
?>
<link href="modules/wsd/css/style.css" rel="stylesheet" type="text/css">
<!--
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/template_css.css" rel="stylesheet" type="text/css">
<link href="templates/<?php// echo WEB_TEMPLATES;?>/css/style.css" rel="stylesheet" type="text/css">
<link href="modules/wsd/css/style.css" rel="stylesheet" type="text/css">
 <script type="text/javascript" src="js/jquery1.3.2.js"></script>
-->
<TABLE width="100%" align="center" cellSpacing="0" cellPadding="0" border="0"> 
    <tr>
    <td width="100%" align="left"><img src="images/wsd/texmenu_stock_new.gif" width="170" height="32" align="baseline"></td>
    </tr>
    <tr>
    <td height="1" class="dotline" width="100%"></td>
    </tr>		
	<tr>
	<td><br>
<?php

if($op == "old_material" and $action == "add"){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

		$line = $_POST['hdnMaxLine'] ;
       	for($i=1;$i<=$line;$i++) {  

			     if($_POST['sh_date_'.$i] == "" or $_POST['sd_name_'.$i] == "" or $_POST['sd_price_'.$i] == "" or $_POST['sd_amount_'.$i] == "" ) { 	
			       $check_psd = false ;
			       $ProcessOutput .= "<BR><BR>";
			       $ProcessOutput .= "<CENTER><IMG SRC=\"images/notview.gif\" BORDER=\"0\"><BR><BR>";
			       $ProcessOutput .= "<FONT COLOR=\"#336600\"><B>กรุณากำหนดรายละเอียดของ : ".$_POST['sh_name']." ให้ครบถ้วนด้วยครับ</B></FONT><BR><BR>";
			       $ProcessOutput .= "<A HREF=\"javascript:history.go(-1);\"><B>กลับไปทำรายการใหม่อีกครั้ง</B></A>";
			       $ProcessOutput .= "</CENTER>";
			       $ProcessOutput .= "<BR><BR>";	
			      echo $ProcessOutput ;
				  exit ;
			     } else {
			       $check_psd = true ;
				 }
		
		}	
		
  		 if($check_psd) {    	//ทำการเพิ่มข้อมูลลงดาต้าเบส

         $res['stock_head_from'] = $db->select_query("SELECT sh_id, sum(shf_amountcost) as amount, sum(shf_price*shf_amountcost) as price  FROM ".TB_STOCK_HEAD_PRICE." WHERE sh_id='".$_POST['sh_id']."' GROUP BY sh_id ");
         $arr['stock_head_from'] = $db->fetch($res['stock_head_from']) ;
		 $arr['stock_head_rows'] = $db->rows($res['stock_head_from']) ;
         
		 if($arr['stock_head_rows']) {	
         $amountcost =  $arr['stock_head_from']['amount'] ;	 
		 $pricecost =  $arr['stock_head_from']['price'] ;
		 } else {
		 $amountcost =  0 ;	 
		 $pricecost  =  0 ;
		 }
		
        for($i=1;$i<=$line;$i++) {
		    $amountcost = $amountcost + $_POST['sd_amount_'.$i] ;
			$pricecost = $pricecost + ($_POST['sd_price_'.$i]*$_POST['sd_amount_'.$i]);

                if( $_POST['sd_name_'.$i] <> "" ) {
	                $res['shop'] = $db->select_query("SELECT shop_name FROM ".TB_SHOP." WHERE shop_name ='".$_POST['sd_name_'.$i]."'");
	                $rows['shop'] = $db->rows($res['shop']);                     
					if(!$rows['shop']){
					    $db->add_db(TB_SHOP,array(
				        "shop_name"=>"".$_POST['sd_name_'.$i].""
			            ));	
                    }					
                }						

				if($_POST['shf_diff_id_'.$i] == "new_diff" or $_POST['shf_price_id_'.$i] == "new_price"){
					echo "add ".$line."<br>" ;
                    $db->add_db(TB_STOCK_HEAD_PRICE,array(
				    "shf_amountcost"=>"".$_POST['sd_amount_'.$i]."",
				    "shf_price"=>"".$_POST['sd_price_'.$i]."",
					"shf_diff_name"=>"".$_POST['shf_diff_name_'.$i]."",
				    "sh_id"=>"".$_POST['sh_id'].""
			        ));	
				
			    $check_shf_id=mysql_query("select shf_id  from ".TB_STOCK_HEAD_PRICE." ORDER BY shf_id  DESC");
		        list($shf_id)=mysql_fetch_row($check_shf_id);
			    empty($shf_id)?$shf_id="":$shf_id=$shf_id ;				
	
				} else {
				    $res['head_from1'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD_PRICE." WHERE shf_id='".$_POST['shf_price_id_'.$i]."'" );
                    $arr['head_rows'] = $db->rows($res['head_from1']) ;
                        if($arr['head_rows']) {						
                        $arr['head_from1'] = $db->fetch($res['head_from1']) ;					
						$amount_cost =  $arr['head_from1']['shf_amountcost'] + $_POST['sd_amount_'.$i] ;
						echo "update<br>" ;
				        $db->update_db(TB_STOCK_HEAD_PRICE,array(
			            "shf_amountcost"=>"".$amount_cost.""
	            	    )," shf_id='".$_POST['shf_price_id_'.$i]."'");	
                        }	
                empty($_POST['shf_price_id_'.$i])?$shf_id="":$shf_id=$_POST['shf_price_id_'.$i] ;
//				echo "shf_diff_id= ".$_POST['shf_diff_id_'.$i] ;				
//				echo "<br>shf_price_id= ".$_POST['shf_price_id_'.$i] ;				
				
				} 
				
//				echo "<br>SHF_ID=".$shf_id ;
                $db->add_db(TB_STOCK_SECTION.$budget,array(
			    	"sh_id"=>"".$_POST['sh_id']."",
				    "sd_date"=>"".$_POST['sh_date_'.$i]."",
				    "sd_name"=>"".$_POST['sd_name_'.$i]."",
				    "sd_ref"=>"".$_POST['sd_ref_'.$i]."",
				    "sd_price"=>"".$_POST['sd_price_'.$i]."",
				    "sd_amount"=>"".$_POST['sd_amount_'.$i]."",
				    "sd_amountcost"=>"".$amountcost."",
				    "sd_pricecost"=>"".$pricecost."",
				    "sd_note"=>"".$_POST['sd_note_'.$i]."",				
				    "sd_logic"=>"".$_POST['sd_logic']."",								
				    "sd_print"=>"".$_POST['sd_print']."",												
    				"shf_id"=>"".$shf_id.""				
			));					
				
		} 
		
		$ProcessOutput .= "<br><br>";
		$ProcessOutput .= "<center><img src=\"images/login-welcome.gif\" border=\"0\"><br><br>";
		$ProcessOutput .= "<font color=\"#336600\"><b>ได้ทำการเพิ่มวัสดุ รายการเดิม   เข้าสู่ระบบเรียบร้อยแล้ว</b></font><br><br>";
		$ProcessOutput .= "<b>กลับหน้า  ระบบงานวัสดุ</b>";
		$ProcessOutput .= "<br><br>";
		$ProcessOutput .= "<input type=\"button\" onClick=\"print_acc_Open(".$_POST['sh_id'].")\" value=\"ดูบัญชีวัสดุ  ".$_POST['sh_name']."\">";
		$ProcessOutput .= "</center>";
		$ProcessOutput .= "<br><br>";
	    }
		

}  else if($op == "old_material") {

echo "<script type=\"text/javascript\"  src=\"js/calender.js\"></script>" ;

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE sh_id='".$_GET['sh_id']."' ");
		$arr['stock_head'] = $db->fetch($res['stock_head']);
		$res['type'] = $db->select_query("SELECT type_name FROM ".TB_STOCK_TYPE." WHERE type_id='".$arr['stock_head']['type_id']."' ");
		$arr['type'] = $db->fetch($res['type']);
		$res['sub_type'] = $db->select_query("SELECT subtype_name FROM ".TB_STOCK_SUBTYPE." WHERE subtype_id='".$arr['stock_head']['subtype_id']."' ");
		$arr['sub_type'] = $db->fetch($res['sub_type']);

	if($arr['stock_head']['section_id']==0){
		$section_name = WEB_AGEN_MINI.WEB_AGEN_NAME ;
 	} else {
	  $res['section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." WHERE section_id='".$arr['stock_head']['section_id']."' ");
	  $arr['section'] = $db->fetch($res['section']);
	  $section_name = $arr['section']['section_name'] ;
    }		  

?>
<script language="javascript" type="text/javascript">

	function CreateNewRow()
	{
		var intLine = parseInt(document.frmMain.hdnMaxLine.value);
		intLine++;
			
		var theTable = document.getElementById("tbExp");
		var newRow = theTable.insertRow(theTable.rows.length)
		newRow.id = newRow.uniqueID

		var newCell
		
		//*** Column 1 ***//
		newCell = newRow.insertCell(0);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><input name=\"tCalendar_"+intLine+"\" type=\"text\" id=\"tCalendar_"+intLine+"\" size=\"11\">&nbsp;<IMG SRC=\"images/dateselect.gif\" BORDER=\"0\" ALT=\"เลือกวันที่\" onClick=\"showCalendar(this,"+intLine+")\" align=\"absmiddle\"><br><input type=\"hidden\" name=\"sh_date_"+intLine+"\" id=\"sh_date_"+intLine+"\" size=\"12\" value=\"\"></center>";
		//กำหนด intline เป็นอินพุตแบบ hiden

		//*** Column 2 ***//
		newCell = newRow.insertCell(1);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><input type=\"text\" name=\"sd_name_"+intLine+"\" id=\"sd_name_"+intLine+"\" size=\"25\" value=\"\"><input  type=\"button\" onClick=\"shop_open("+intLine+")\" value=\"...\"></center>";
//		CreateSelectOption("sd_unit_se_"+intLine)
		
<?php if($arr['stock_head']['sh_diff_name'] == "") { ?>
		//*** Column 3 ***//
		newCell = newRow.insertCell(2);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "&nbsp;&nbsp;เอกสารเลขที่ :<input type=\"text\" name=\"sd_ref_"+intLine+"\" id=\"sd_ref_"+intLine+"\" size=\"20\" value=\"\"><br>ขนาด/ลักษณะ :<font id=\"disp_diff_name_"+intLine+"\"><input type=\"text\"  size=\"20\" value=\"คลิกขนาด/ลักษณะ->\" disabled ><input type=\"hidden\" name=\"shf_diff_id_"+intLine+"\" value=\"\"><input type=\"hidden\" name=\"shf_diff_name_"+intLine+"\" id=\"shf_diff_name_"+intLine+"\" value=\"\"></font><input  type=\"button\" onClick=\"diff_name_open("+intLine+")\" value=\"...\">";
<?php } else {	?>
		//*** Column 3 ***//
		newCell = newRow.insertCell(2);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center>&nbsp;&nbsp;เอกสารเลขที่ :<input type=\"text\" name=\"sd_ref_"+intLine+"\" id=\"sd_ref_"+intLine+"\" size=\"20\" value=\"\"><br>ขนาด/ลักษณะ :<input type=\"text\"  size=\"20\" value=\"<?php echo $arr['stock_head']['sh_diff_name'] ;?>\" disabled ><input type=\"hidden\" name=\"shf_diff_id_"+intLine+"\" value=\"old_diff\"></center><input type=\"hidden\" name=\"shf_diff_name_"+intLine+"\" id=\"shf_diff_name_"+intLine+"\" value=\"\">";
<?php } ?>		
		//*** Column 4 ***//
		newCell = newRow.insertCell(3);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><FONT COLOR=\"#FF0000\">ราคา</FONT>/หน่วย&nbsp;:<font id=\"disp_price_"+intLine+"\"><input type=\"text\" name=\"sd_price_"+intLine+"\" id=\"sd_price_"+intLine+"\" size=\"8\" value=\"คลิกราคา->\"  disabled ></font><input  type=\"button\" onClick=\"price_open("+intLine+")\" value=\"...\"><br>จำนวน&nbsp;:<input type=\"text\" name=\"sd_amount_"+intLine+"\" id=\"sd_amount_"+intLine+"\" size=\"8\" style=\"text-align:center;\" value=\"\"></center>";
//		newCell.innerHTML = "<center>จำนวน&nbsp;:<input type=\"text\" name=\"sd_amount_"+intLine+"\" id=\"sd_amount_"+intLine+"\" size=\"8\" value=\"\"><br><FONT COLOR=\"#FF0000\">ราคา</FONT>/หน่วย&nbsp;:<font id=\"disp_price_"+intLine+"\"><input type=\"text\" name=\"sd_price_"+intLine+"\" id=\"sd_price_"+intLine+"\" size=\"8\" value=\"คลิกราคา->\" disabled></font><input  type=\"button\" onClick=\"price_open("+intLine+")\" value=\"...\"></center>";

		//*** Column 5 ***//
		newCell = newRow.insertCell(4);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><textarea name=\"sd_note_"+intLine+"\" cols=\"20\" rows=\"3\"></textarea><input type=\"hidden\" name=\"shf_price_id_"+intLine+"\" value=\"\"></center>";		
		
        document.frmMain.hdnMaxLine.value = intLine;
	}

	function RemoveRow()
	{
		intLine = parseInt(document.frmMain.hdnMaxLine.value);
		if(parseInt(intLine) > 1)
		{
				theTable = document.getElementById("tbExp");				
				theTableBody = theTable.tBodies[0];
				theTableBody.deleteRow(intLine);
				intLine--;
				document.frmMain.hdnMaxLine.value = intLine;
		}	
	}	
function  shop_open(line)
   {
//  alert(form.sh_unit.value);
//   var sd_logic = document.getElementById('sd_logic').value ;  
     var random=Math.random() ;
     window.open('modules/wsd/shop_add.php?line='+line+'&random='+random+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=400,height=200,left=330,top=200');
   }  
function  diff_name_open(line)
   {
	 var sh_id = document.frmMain.sh_id.value ; 
      //alert(sh_id);	 
     window.open('modules/wsd/diff_name_add.php?line='+line+'&sh_id='+sh_id+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=400,height=200,left=330,top=200');
   }  
function  price_open(line)
   {
	 var sh_id = document.frmMain.sh_id.value ; 
	 var shf_diff_id = document.getElementById("shf_diff_id_"+line).value ;	
     alert(shf_diff_id);	 
     window.open('modules/wsd/price_add.php?line='+line+'&sh_id='+sh_id+'&shf_diff_id='+shf_diff_id+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=400,height=200,left=330,top=200');
   }    
//window.onLoad=CreateSelectOption('sd_unit_se_1');	

function  print_acc_Open(sh_id) {
window.open("?compu=wsd&loc=print_acc_see&sh_id="+sh_id+"","","toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=950,height=680,left=5,top=5"); 
} 

function chkNum(ele)
{
var num = parseFloat(ele.value);
ele.value = num.toFixed(2);
}

</script>

<div id="pCalendar" style="position: absolute; left: 10px; top: 10px; visibility: hidden;"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
<form NAME="frmMain" METHOD="post" ACTION="?compu=wsd&loc=add_material&op=old_material&action=add" ENCTYPE="multipart/form-data">
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;รหัส :&nbsp;&nbsp;<?php echo $arr['stock_head']['sh_code_id'] ;?></td>
  </tr>
  <tr><td colspan="4" height="9"></td></tr>  
  <tr>
    <td height="30" align="center">ประเภท :<br><font color="#336600"><b>
	<input type="text" value="<?php echo $arr['type']['type_name'] ;?>" disabled></b></font>
	</td>	
    <td align="center">ประเภทย่อย :<br><font color="#336600"><b>
	<input type="text" value="<?php echo $arr['sub_type']['subtype_name'] ;?>" disabled></b></font></td>	
    <td align="center">หน่วยงาน :<br><font color="#336600"><b>
	<input type="text"  size="25" value="<?php echo $section_name ;?>" disabled></b></font>
	</td> 
    <td align="center">ที่เก็บ :<br><input type="text"  size="23" value="<?php echo $arr['stock_head']['sh_keep'] ;?>" disabled></td>	
  </tr>
  <tr><td colspan="4" height="9"></td></tr>
  <tr>
	<td  height="30" align="center" >ชื่อหรือชนิดวัสดุ :<br><input type="text"  size="30" maxlength="50" value="<?php echo $arr['stock_head']['sh_name'] ;?>" disabled></td>
	<input type="hidden"  name="sh_name" id="sh_name" size="23" value="<?php echo $arr['stock_head']['sh_name'] ;?>">
    <td align="center"><FONT COLOR="#FF0000"><B>*</B></FONT>ขนาดหรือลักษณะ : <br><input type="text" size="27" value="<?php echo $arr['stock_head']['sh_diff_name'] ;?>" disabled /></td>  
    <td align="center" >หน่วยนับ :<br><input type="text" size="15" value="<?php echo $arr['stock_head']['sh_unit'] ;?>" disabled />
    </td>
    <td height="30" align="center">จำนวนอย่าง :<br>สูง <input type="text" size="6" maxlength="6" style="text-align:center;" value="<?php echo $arr['stock_head']['sh_high'] ;?>" disabled />&nbsp;&nbsp;ต่ำ 
    <input type="text" size="6" maxlength="6" style="text-align:center;" value="<?php echo $arr['stock_head']['sh_low'] ;?>" disabled /></td>	
  </tr>
  <tr><td colspan="4" height="9"></td></tr>  
</table>
<table id="tbExp" width="100%" border="0" cellspacing="2" cellpadding="1" align="center">
  <tr bgcolor="#AAAAAA" height="25">
    <td ><div align="center">วัน เดือน ปี</div></td>
	<td><div align="center">รับจาก</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>	
	<td><div align="center">หมายเหตุ</div></td>
  </tr>

  <tr>
    <td align="center" ><input name="tCalendar_1" type="text" id="tCalendar_1" size="11">&nbsp;<IMG SRC="images/dateselect.gif" BORDER="0" ALT="เลือกวันที่" onClick="showCalendar(this,1)" align="absmiddle">
	<br><input type="hidden" name="sh_date_1" id="sh_date_1" size="12" value="">
	</td>
	<td align="center">
	 <input type="text" name="sd_name_1" id="sd_name_1" size="25" value="">
	 <input  type="button" onClick="shop_open(1)" value="...">
	</td>
<?php if($arr['stock_head']['sh_diff_name'] == "") { ?>	
    <td>
	&nbsp;&nbsp;เอกสารเลขที่ :<input type="text" name="sd_ref_1" id="sd_ref_1" size="20" value=""><br>
	ขนาด/ลักษณะ :<font id="disp_diff_name_1"><input type="text"  size="20" value="คลิกขนาด/ลักษณะ->" disabled>
	<input type="hidden" name="shf_diff_name_1" id="shf_diff_name_1" value="">
	</font><input  type="button" onClick="diff_name_open(1)" value="...">
	<input type="hidden" name="shf_diff_id_1" value="">
	</td>
<?php } else {	?>
    <td align="center">
	&nbsp;&nbsp;เอกสารเลขที่ :<input type="text" name="sd_ref_1" id="sd_ref_1" size="20" value=""><br>
	ขนาด/ลักษณะ :<input type="text"  size="20" value="<?php echo $arr['stock_head']['sh_diff_name'] ;?>" disabled>
	<input type="hidden" name="shf_diff_id_1" value="">
	<input type="hidden" name="shf_diff_name_1" id="shf_diff_name_1" value="">
	</td>
<?php } ?>
    <td align="center">
<FONT COLOR="#FF0000">ราคา</FONT>/หน่วย&nbsp;:<font id="disp_price_1"><input type="text" name="sd_price_1" id="sd_price_1" size="8" value="คลิกราคา->"  disabled ></font><input  type="button" onClick="price_open(1)" value="..."><br>
	จำนวน&nbsp;:<input type="text" name="sd_amount_1" id="sd_amount_1" size="8" style="text-align:center;" value="">
	</td>
	<td align="center">
	<textarea name="sd_note_1" cols="20" rows="3"></textarea>
	<input type="hidden" name="shf_price_id_1" value="">
	</td>
  </tr> 
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="10"><div align="center">&nbsp;</div></td>
    <td>
	<input name="btnAdd" type="button" id="btnAdd" value=" +เพิ่มแถว " onClick="CreateNewRow();"> 
    <input name="btnDel" type="button" id="btnDel" value=" -ลดแถว  " onClick="RemoveRow();"> 
	</td>
  </tr>
</table>  
<input type="hidden" name="hdnMaxLine" value="1">
<input type="hidden" name="sd_print" value="1">
<input type="hidden" name="sd_logic" value="1">
<input type="hidden" name="sh_id" value="<?php echo $arr['stock_head']['sh_id'] ;?>">
<input type="hidden" name="section_id" value="<?php echo $arr['stock_head']['section_id'] ;?>">
<center><input type="submit" value=" บันทึกเพิ่มรายการวัสดุตัวเดิม " name="submit"></center>
<br>&nbsp;<input type="button" onClick="print_acc_Open(<?php echo $arr['stock_head']['sh_id'];?>)" value="ดูบัญชีวัสดุ <?php echo $arr['stock_head']['sh_name'];?>">
</td>
</form>
</tr>
</table>

<SCRIPT LANGUAGE="javascript">	
dtNow = new Date();
makeCalendar(dtNow.getMonth(), dtNow.getFullYear());
</SCRIPT>

<?php
		$ProcessOutput = "<br>เพิ่มเติมวัสดุเดิมที่มีอยู่" ;

}  else if($op == "new_material" and $action == "add") {	


    empty($_POST['sh_unit'])?$sh_unit=$_POST['sh_unit_new']:$sh_unit=$_POST['sh_unit'];			
	$res['stock_head'] = $db->select_query("SELECT sh_id FROM ".TB_STOCK_HEAD." WHERE sh_name='".$_POST['sh_name']."' AND sh_unit='".$sh_unit."' AND type_id='".$_POST['type_id']."' AND sh_diff_name='".$_POST['sh_diff_name']."'");
	$rows['stock_head'] = $db->rows($res['stock_head']); 
	$db->closedb ();
		if($rows['stock_head']){
			$ProcessOutput .= "<BR><BR>";
			$ProcessOutput .= "<CENTER><IMG SRC=\"images/notview.gif\" BORDER=\"0\"><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ชื่อหรือชนิดวัสดุ : ".$_POST['sh_name']." มีในระบบแล้วไม่สามารถเพิ่มได้</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"javascript:history.go(-1);\"><B>กลับไปเพิ่มชื่อหรือชนิดวัสดุใหม่</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
		} else {	

		$line = $_POST['hdnMaxLine'] ;
       	for($i=1;$i<=$line;$i++) {
			     if($_POST['sh_date_'.$i] == "" or $_POST['sd_name_'.$i] == "" or $_POST['sd_price_'.$i] == "" or $_POST['sd_amount_'.$i] == "" ) { 	
			       $check_psd = false ;
			       $ProcessOutput .= "<BR><BR>";
			       $ProcessOutput .= "<CENTER><IMG SRC=\"images/notview.gif\" BORDER=\"0\"><BR><BR>";
			       $ProcessOutput .= "<FONT COLOR=\"#336600\"><B>กรุณากำหนดรายละเอียดของ : ".$_POST['sh_name']." ให้ครบถ้วนด้วยครับ</B></FONT><BR><BR>";
			       $ProcessOutput .= "<A HREF=\"javascript:history.go(-1);\"><B>กลับไปทำรายการใหม่อีกครั้ง</B></A>";
			       $ProcessOutput .= "</CENTER>";
			       $ProcessOutput .= "<BR><BR>";	
			      echo $ProcessOutput ;
				  exit ;
			     } else {
			       $check_psd = true ;
				 }
		}
		
	//ทำการเพิ่มข้อมูลลงดาต้าเบส

  		 if($check_psd) {	
	
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		
            empty($_POST['sh_unit'])?$sh_unit=$_POST['sh_unit_new']:$sh_unit=$_POST['sh_unit'];	
            $db->add_db(TB_STOCK_HEAD,array(
				"sh_code_id"=>"".$_POST['sh_code_id']."",
				"type_id"=>"".$_POST['type_id']."",
				"subtype_id"=>"".$_POST['subtype_id']."",
				"sh_name"=>"".$_POST['sh_name']."",
				"sh_diff_name"=>"".$_POST['sh_diff_name']."",
				"sh_unit"=>"".$sh_unit."",
				"sh_keep"=>"".$_POST['sh_keep']."",
				"sh_high"=>"".$_POST['sh_high']."",
				"sh_low"=>"".$_POST['sh_low']."",
				"section_id"=>"".$_POST['section_id'].""
//				"sh_picture"=>"".$pername.""				
			));

			$check=mysql_query("select sh_id  from ".TB_STOCK_HEAD." ORDER BY sh_id  DESC");
		    list($sh_id)=mysql_fetch_row($check);
			empty($sh_id)?$sh_id="":$sh_id=$sh_id ;
						

         $amountcost =  0 ;	 
		 $pricecost =  0 ;
		
        for($i=1;$i<=$line;$i++) {
		    $amountcost = $amountcost + $_POST['sd_amount_'.$i] ;
			$pricecost = $pricecost + ($_POST['sd_price_'.$i]*$_POST['sd_amount_'.$i]);
			
                if( $_POST['sd_name_'.$i] <> "" ) {
	                $res['shop'] = $db->select_query("SELECT shop_name FROM ".TB_SHOP." WHERE shop_name ='".$_POST['sd_name_'.$i]."'");
	                $rows['shop'] = $db->rows($res['shop']);                     
					if(!$rows['shop']){
					    $db->add_db(TB_SHOP,array(
				        "shop_name"=>"".$_POST['sd_name_'.$i].""
			            ));	
                    }					
                }				

			empty($_POST['sh_diff_name'])?$shf_diff_name=$_POST['shf_diff_name_'.$i]:$shf_diff_name="" ;
            $db->add_db(TB_STOCK_HEAD_PRICE,array(
			    "shf_amountcost"=>"".$_POST['sd_amount_'.$i]."",
			    "shf_price"=>"".$_POST['sd_price_'.$i]."",
				"shf_diff_name"=>"".$shf_diff_name."",
			    "sh_id"=>"".$sh_id.""
			));	
			
			$check_shf_id=mysql_query("select shf_id  from ".TB_STOCK_HEAD_PRICE." ORDER BY shf_id  DESC");
		    list($shf_id)=mysql_fetch_row($check_shf_id);
			empty($shf_id)?$shf_id="":$shf_id=$shf_id ;
//            echo "SHF_ID=".$shf_id ;		

            $db->add_db(TB_STOCK_SECTION.$budget,array(
				"sh_id"=>"".$sh_id."",
				"sd_date"=>"".$_POST['sh_date_'.$i]."",
				"sd_name"=>"".$_POST['sd_name_'.$i]."",
				"sd_ref"=>"".$_POST['sd_ref_'.$i]."",
				"sd_price"=>"".$_POST['sd_price_'.$i]."",
				"sd_amount"=>"".$_POST['sd_amount_'.$i]."",
				"sd_amountcost"=>"".$amountcost."",
				"sd_pricecost"=>"".$pricecost."",
				"sd_note"=>"".$_POST['sd_note_'.$i]."",				
				"sd_logic"=>"".$_POST['sd_logic']."",								
				"sd_print"=>"".$_POST['sd_print']."",												
				"shf_id"=>"".$shf_id.""				
			));	
			
		} 
		
//		$db->closedb ();

		$ProcessOutput .= "<br><br>";
		$ProcessOutput .= "<center><img src=\"images/login-welcome.gif\" border=\"0\"><br><br>";
		$ProcessOutput .= "<font color=\"#336600\"><b>ได้ทำการเพิ่มวัสดุ รายการใหม่   เข้าสู่ระบบเรียบร้อยแล้ว</b></font><br><br>";
		$ProcessOutput .= "<b>กลับหน้า  ระบบงานวัสดุ</b>";
		$ProcessOutput .= "<br><br>";
		$ProcessOutput .= "<input type=\"button\" onClick=\"print_acc_Open(".$sh_id.")\" value=\"ดูบัญชีวัสดุ  ".$_POST['sh_name']."\">";
		$ProcessOutput .= "</center>";		
		$ProcessOutput .= "<br><br>";		
		}
}
//////////////////////////////////////////	เพิ่มรายการวัสดุตัวใหม่ NEW    ////////////////////////////////////////////////////////	
		
} else if($op == "new_material") {

	require_once("modules/wsd/function.php");
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		
		$check=mysql_query("select sh_code_id  from ".TB_STOCK_HEAD." ORDER BY sh_id  DESC");
		list($code_id)=mysql_fetch_row($check);
		
		$code=checkProductCode($code_id);	
        $strSQL = "SELECT * FROM web_stock_unit ORDER BY unit_name ";
        $objQuery = mysql_query($strSQL);

/***		
		$res['agen_mini'] = $db->select_query("SELECT * FROM ".TB_CONFIG." WHERE posit='agen_mini' ");
		$arr['agen_mini'] = $db->fetch($res['agen_mini']);
		$res['agen_name'] = $db->select_query("SELECT * FROM ".TB_CONFIG." WHERE posit='agen_name' ");
		$arr['agen_name'] = $db->fetch($res['agen_name']);		
***/
?>
<link href="modules/wsd/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript"  src="js/calender.js"></script>
<script language="javascript" type="text/javascript">

function Inint_AJAX() {
   try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
   try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
   try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
   alert("XMLHttpRequest not supported");
   return null;
};

function dochange(src, val) {
     //alert("s0");
     var req = Inint_AJAX();
     req.onreadystatechange = function () { 
          if (req.readyState==4) {
		           
               if (req.status==200) {
			        
                    document.getElementById(src).innerHTML=req.responseText; //รับค่ากลับมา
               } 
          }
     };
	 var random=Math.random()
     req.open("GET", "modules/admin/stocktype.php?data="+src+"&val="+val+"&random="+random , true); //สร้าง connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
     req.send(null); //ส่งค่า
}

window.onLoad=dochange('stock_type', -1);
 
    
	function dochange_unit() {
	    if (document.frmMain.sh_unit.value == "") {
        document.getElementById("unit").innerHTML="<input type=\"text\" name=\"sh_unit_new\" id=\"sh_unit_new\" size=\"18\" value=\"\" >" ;		
		} else {
        document.getElementById("unit").innerHTML="<input type=\"text\" size=\"18\" disabled=\"disabled\" >" ;
		}
    }
/***
    function CreateSelectOption(ele)
	{
		var objSelect = document.getElementById(ele);
		var Item = new Option("", ""); 
		objSelect.options[objSelect.length] = Item;
		<?php
		//while($objResult = mysql_fetch_array($objQuery))
		//{
		?>
		var Item = new Option("<?php// echo $objResult["unit_name"];?>", "<?php// echo $objResult["unit_name"];?>"); 
		objSelect.options[objSelect.length] = Item;
		<?php
		//}
		?>
	}
***/
	function CreateNewRow()
	{
		var intLine = parseInt(document.frmMain.hdnMaxLine.value);
		intLine++;
			
		var theTable = document.getElementById("tbExp");
		var newRow = theTable.insertRow(theTable.rows.length)
		newRow.id = newRow.uniqueID

		var newCell
		
		//*** Column 1 ***//
		newCell = newRow.insertCell(0);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><input name=\"tCalendar_"+intLine+"\" type=\"text\" id=\"tCalendar_"+intLine+"\" size=\"11\">&nbsp;<IMG SRC=\"images/dateselect.gif\" BORDER=\"0\" ALT=\"เลือกวันที่\" onClick=\"showCalendar(this,"+intLine+")\" align=\"absmiddle\"><br><input type=\"hidden\" name=\"sh_date_"+intLine+"\" id=\"sh_date_"+intLine+"\" size=\"12\"></center>";
		//กำหนด intline เป็นอินพุตแบบ hiden

		//*** Column 2 ***//
		newCell = newRow.insertCell(1);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><input type=\"text\" name=\"sd_name_"+intLine+"\" id=\"sd_name_"+intLine+"\" size=\"25\" value=\"\"><input  type=\"button\" onClick=\"shop_open("+intLine+")\" value=\"...\"></center>";
//		CreateSelectOption("sd_unit_se_"+intLine)
		
		//*** Column 3 ***//
		newCell = newRow.insertCell(2);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "&nbsp;&nbsp;เอกสารเลขที่ :<input type=\"text\" name=\"sd_ref_"+intLine+"\" id=\"sd_ref_"+intLine+"\" size=\"20\"><br>ขนาด/ลักษณะ :<font id=\"disp_diff_name_"+intLine+"\"><input type=\"text\" name=\"shf_diff_name_"+intLine+"\" id=\"shf_diff_name_"+intLine+"\" size=\"20\" value=\"\" disabled ></font><input  type=\"button\" onClick=\"diff_name_open("+intLine+")\" value=\"...\">";

		//*** Column 4 ***//
		newCell = newRow.insertCell(3);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><FONT COLOR=\"#FF0000\">ราคา</FONT>/หน่วย&nbsp;:<input type=\"text\" name=\"sd_price_"+intLine+"\" id=\"sd_price_"+intLine+"\" size=\"7\" style=\"text-align:center;\" value=\"\" OnChange=\"JavaScript:chkNum(this)\" ><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวน&nbsp;:<input type=\"text\" name=\"sd_amount_"+intLine+"\" id=\"sd_amount_"+intLine+"\" size=\"7\" style=\"text-align:center;\" value=\"\"></center>";
//		newCell.innerHTML = "<center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวน&nbsp;:<input type=\"text\" name=\"sd_amount_"+intLine+"\" id=\"sd_amount_"+intLine+"\" size=\"7\"><br><FONT COLOR=\"#FF0000\">ราคา</FONT>/หน่วย&nbsp;:<input type=\"text\" name=\"sd_price_"+intLine+"\" id=\"sd_price_"+intLine+"\" size=\"7\"></center>";

		//*** Column 5 ***//
		newCell = newRow.insertCell(4);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><textarea name=\"sd_note_"+intLine+"\" cols=\"20\" rows=\"3\"></textarea><input type=\"hidden\" name=\"shf_id_"+intLine+"\" value=\"\"></center>";		
		
        document.frmMain.hdnMaxLine.value = intLine;
	}

	function RemoveRow()
	{
		intLine = parseInt(document.frmMain.hdnMaxLine.value);
		if(parseInt(intLine) > 1)
		{
				theTable = document.getElementById("tbExp");				
				theTableBody = theTable.tBodies[0];
				theTableBody.deleteRow(intLine);
				intLine--;
				document.frmMain.hdnMaxLine.value = intLine;
		}	
	}	
function  shop_open(line)
   {
//  alert(form.sh_unit.value);
//   var sd_logic = document.getElementById('sd_logic').value ;  
     var random=Math.random() ;
     window.open('modules/wsd/shop_add.php?line='+line+'&random='+random+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=400,height=200,left=330,top=200');
   }  
function  diff_name_open(line)
   {
	 var sh_diff_name = document.frmMain.sh_diff_name.value ; 
      //alert(sh_id);	 
     window.open('modules/wsd/shf_diff_name_add.php?line='+line+'&sh_diff_name='+sh_diff_name+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=450,height=200,left=330,top=200');
   }   

function chkNum(ele)
 {
	var num = parseFloat(ele.value);
	ele.value = num.toFixed(2);
 }   
		
</script>
<div id="pCalendar" style="position: absolute; left: 10px; top: 10px; visibility: hidden;"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
<form NAME="frmMain" METHOD="post" ACTION="?compu=wsd&loc=add_material&op=new_material&action=add"  onSubmit="return check()" ENCTYPE="multipart/form-data">
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4" height="10">&nbsp;&nbsp;&nbsp;&nbsp;รหัส :&nbsp;&nbsp;<input type="text" name="sh_code_id" id="sh_code_id" value="<?php echo $code ;?>" size="10">
    </td>
  </tr>
  <tr><td colspan="4" height="8"></td></tr>  
  <tr>
    <td height="30" align="center">ประเภท :<br><font id="stock_type"><select><option value="0">-------------------</option></select></font></td>	
    <td align="center">ประเภทย่อย :<br><font id="stock_subtype"><select><option value="0">-------------------</option></select></font></td>	
    <td align="center">หน่วยงาน :<br>
<?php
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

	if($_SESSION['section_id'] == 0 OR $_SESSION['admin_level'] == 2){
	
	 if(WEB_WSD_CARD == 0){
	 echo "<input type='text' value='".WEB_AGEN_MINI.WEB_AGEN_NAME."' readonly >" ;
	 echo "<input type='hidden' name='section_id' id='section_id' value='0' >" ;
	 } else if(WEB_WSD_CARD == 1){
	 $res['section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION."");
	 echo "<select name='section_id' id='section_id'>\n";
	 echo "<option value=''>---เลือกหน่วยงาน---</option>\n";
	 while($arr['section'] = $db->fetch($res['section'])){
	 echo "<option value=".$arr['section']['section_id'].">".$arr['section']['section_name']."</option>\n";
	 }
	 echo "</select>" ;
	} 
	} else {
	  $res['section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." WHERE section_id='".$_SESSION['section_id']."'");
	  $arr['section'] = $db->fetch($res['section']);
	  echo "<input type='text' value='".$arr['section']['section_name']."' readonly>" ;
	  echo "<input type='hidden' name='section_id' id='section_id' value='".$arr['section']['section_id']."' >" ;
    }	
?>
    <input type="hidden" name="sh_section_id" id="sh_section_id" value="0">	
	</td> 
    <td align="center">ที่เก็บ :<br><input type="text" name="sh_keep" id="sh_keep" size="23"></td>	
  </tr>
  <tr><td colspan="4" height="8"></td></tr>
  <tr>
	<td  height="30" align="center" >ชื่อหรือชนิดวัสดุ :<br><input type="text" name="sh_name" id="sh_name" size="30" maxlength="50"></td>
    <td align="center"><FONT COLOR="#FF0000"><B>*</B></FONT>ขนาดหรือลักษณะ : <br><input type="text" size="27" name="sh_diff_name" id="sh_diff_name" value="" /></td>  
    <td align="center">หน่วยนับ :<br>
	<?php
	echo "<select name='sh_unit' onChange=\"dochange_unit()\"> \n";
          echo "<option value=''>--เลือก--</option>\n";
		  $result = mysql_query("select * from ".TB_STOCK_UNIT." order by unit_name") or die ("Err Can not to result") ;
          while($row = mysql_fetch_array($result)){
               echo "<option value=\"$row[unit_name]\" >$row[unit_name]</option> \n" ;
          }	
	echo "</select>" ;	  
	?>	
	<font id="unit"><input type="text" name="sh_unit_new" id="sh_unit_new" size="18" value=""></font>
    </td>
    <td height="30" align="center">จำนวนอย่าง :<br>สูง <input type="text" name="sh_high" id="sh_high" size="6" maxlength="6" style="text-align:center;" value="" />&nbsp;&nbsp;ต่ำ 
    <input type="text" name="sh_low" id="sh_low" size="6" maxlength="6" style="text-align:center;" value="" /></td>	
  </tr>
</table><br>
<table id="tbExp" width="100%" border="0" cellspacing="2" cellpadding="1" align="center">
  <tr bgcolor="#AAAAAA" height="25">
    <td ><div align="center">วัน เดือน ปี</div></td>
	<td><div align="center">รับจาก</div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>	
	<td><div align="center">หมายเหตุ</div></td>
  </tr>

  <tr>
    <td align="center" ><input name="tCalendar_1" type="text" id="tCalendar_1" size="11">&nbsp;<IMG SRC="images/dateselect.gif" BORDER="0" ALT="เลือกวันที่" onClick="showCalendar(this,1)" align="absmiddle">
	<br><input type="hidden" name="sh_date_1" id="sh_date_1" size="12"></td>
	<td align="center">
	 <input type="text" name="sd_name_1" id="sd_name_1" size="25" value="">
	 <input  type="button" onClick="shop_open(1)" value="...">
	</td>
    <td>
	&nbsp;&nbsp;เอกสารเลขที่ :<input type="text" name="sd_ref_1" id="sd_ref_1" size="20"><br>
	ขนาด/ลักษณะ :<font id="disp_diff_name_1"><input type="text" name="shf_diff_name_1" id="shf_diff_name_1" size="20" value="" disabled></font><input  type="button" onClick="diff_name_open(1)" value="...">
	</td>
    <td align="center">
	<FONT COLOR="#FF0000">ราคา</FONT>/หน่วย&nbsp;:<input type="text" name="sd_price_1" id="sd_price_1" size="7" style="text-align:center;" value="" OnChange="JavaScript:chkNum(this)" ><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวน&nbsp;:<input type="text" name="sd_amount_1" id="sd_amount_1" size="7" style="text-align:center;" value="">
	
	</td>
	<td align="center">
	<textarea name="sd_note_1" cols="20" rows="3"></textarea>
	<input type="hidden" name="shf_id_1" value="">
	</td>
  </tr> 
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="20"><div align="center">&nbsp;</div></td>
    <td>
	<input name="btnAdd" type="button" id="btnAdd" value=" +เพิ่มแถว " onClick="CreateNewRow();"> 
    <input name="btnDel" type="button" id="btnDel" value=" -ลดแถว  " onClick="RemoveRow();"> 
	</td>
  </tr>
</table> 
<input type="hidden" name="hdnMaxLine" value="1">
<input type="hidden" name="sd_print" value="1">
<input type="hidden" name="sd_logic" value="1">
<center><input type="submit" value="บันทึกรายการบัญชีวัสดุ" name="submit"><br>&nbsp;
</td>
</form>
</tr></table>
<FONT COLOR="#FF0000" ALIGN="left"><B>*&nbsp;กรณีต้องการมีหลายขนาดหรือหลายลักษณะ&nbsp;ให้กำหนดที่แถว</B></FONT>&nbsp;ขนาด/ลักษณะ :
<script language="JavaScript">
dtNow = new Date();
makeCalendar(dtNow.getMonth(), dtNow.getFullYear());
</script>
<SCRIPT LANGUAGE="javascript">	
	
function check() {
if(document.frmMain.type_id.value==0) {
alert("กรุณาเลือก  ประเภทวัสดุ  ด้วยครับ") ;
document.frmMain.type_id.focus() ;
return false ;
}
if(document.frmMain.section_name.value=="") {
alert("กรุณาเลือก  หน่วยงาน  ด้วยครับ") ;
document.frmMain.section_name.focus() ;
return false ;
}
if(document.frmMain.sh_name.value=="") {
alert("กรุณากรอก  ชื่อหรือชนิดวัสดุ  ด้วยครับ") ;
document.frmMain.sh_name.focus() ;
return false ;
}
else if(document.frmMain.sh_unit.value=="" && document.frmMain.sh_unit_new.value=="" )   {
alert("กรุณากำหนด หน่วยนับวัสดุ  ด้วยครับ") ;
document.frmMain.sh_unit.focus() ;
return false ;
}
else 
return true ;
}		

</SCRIPT>
<?php
		$ProcessOutput = "<br>เพิ่มวัสดุเข้าไปใหม่" ;
} 
	
if(!$ProcessOutput or $op == "search_name" or $op == "search_type") {

?>
<!-- <script type="text/javascript" src="js/jquery1.3.2.js"></script> -->
<script language="javascript" type="text/javascript">
function suggest(inputString){
        var section_id = document.search_name.section_id.value ;
		//alert(section_id) ;
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#sh_name').addClass('load');
			$.post("modules/wsd/suggest_st_search.php", {queryString: ""+inputString+"" ,section_id: ""+section_id+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#sh_name').removeClass('load');
				}
			});
		}
	}
	
function fill(thisValue) {
		$('#sh_name').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 300);
	}

function Inint_AJAX() {
   try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
   try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
   try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
   alert("XMLHttpRequest not supported");
   return null;
};

function dochange(src, val) {
     //alert("s0");
     var req = Inint_AJAX();
     req.onreadystatechange = function () { 
          if (req.readyState==4) {
		           
               if (req.status==200) {
			        
                    document.getElementById(src).innerHTML=req.responseText; //รับค่ากลับมา
               } 
          }
     };
	 var random=Math.random()
     req.open("GET", "modules/wsd/stocktype.php?data="+src+"&val="+val+"&random="+random , true); //สร้าง connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
     req.send(null); //ส่งค่า
}

window.onLoad=dochange('stock_type', -1);
 
</script>


<table width="100%" border="0" cellspacing="1" cellpadding="2">
    <tr>
      <td width="40%">
       <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#DDDDDD">
  <tr>
<form NAME="search_name" METHOD="post" ACTION="?compu=wsd&loc=add_material&op=search_name" onSubmit="return check_name()" ENCTYPE="multipart/form-data" >
    <td align="center" valign="middle"><br>
    ชื่อหรือชนิดวัสดุ :&nbsp;
	 <input type="text" size="28" value="" name="sh_name" id="sh_name" onkeyup="suggest(this.value);" onblur="fill();" class="" />
     <div class="suggestionsBox_search" id="suggestions" style="display: none;"><img src="images/wsd/arrow.png" style="position: relative; top: -12px; left: 40px;" alt="upArrow" />
     <div class="suggestionList_search" id="suggestionsList"></div>
     </div><br><br>   
	 <?php
	 if($_SESSION['section_id'] == 0 OR $_SESSION['admin_level'] == 2) {
	      $Vsection_id = 0 ;
	 } else {
	      $Vsection_id = $_SESSION['section_id'] ;
	 }
	 
	 ?>
    <input type="hidden" value="<?php echo $Vsection_id ;?>" name="section_id" id="section_id" />  	 	 
	<input type="submit" name="submit" id="submit" value="ค้นหาตามชื่อ" />
	
    </td>
</form>   
  </tr>
</table>

      </td>
      <td width="60%">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#999999">
        <tr>
<form NAME="search_type" METHOD="post" ACTION="?compu=wsd&loc=add_material&op=search_type" onSubmit="return check_type()" ENCTYPE="multipart/form-data" >
          <td align="center" height="35" valign="middle"><br>
          ประเภทวัสดุ :<font id="stock_type"><select><option value="0">-------------------</option></select></font>&nbsp;
          ย่อย :<font id="stock_subtype"><select><option value="0">-------------------</option></select></font><br><br>    
          <input type="submit" name="submit" id="submit" value="ค้นหาตามประเภท" />      
          </td>
</form>		  
        </tr>
      </table>
   
      </td>
    </tr>
</table>

<SCRIPT LANGUAGE="javascript">	
	
function check_name() {
if(document.search_name.sh_name.value=="") {
alert("กรุณากรอกชื่อวัสดุด้วยครับ") ;
document.search_name.sh_name.focus() ;
return false ;
}
else 
return true ;
}	

function check_type() {
if(document.search_type.type_id.selectedIndex==0) {
alert("กรุณาเลือกประเภทวัสดุด้วยครับ") ;
document.search_type.type_id.focus() ;
return false ;
}
else 
return true ;
}		
</SCRIPT>

<?php
    echo "<br><a href=\"?compu=wsd&loc=add_material&op=new_material\" ><img src=\"images/wsd/add_new_material.png\" alt=\"เพิ่มวัสดุตัวใหม่\" align=\"middle\" border=\"0\" width=\"176\" height=\"23\" /></a><br><br>" ; 


 if($op == "search_name" or $op == "search_type"){

	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//	$limit = 20 ;
//	$SUMPAGE = $db->num_rows(TB_STOCK_HEAD,"sh_id","");

//	if (empty($page)){
//		$page=1;
//	}
//	$rt = $SUMPAGE%$limit ;
//	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
//	$goto = ($page-1)*$limit ;
//	echo "type_id =".$_POST['type_id'] ;
//	echo "<br>subtype_id =".$_POST['subtype_id'] ;
?>
 
 <table width="100%" cellspacing="2" cellpadding="1" >
  <tr bgcolor="#0066FF" height="20">
   <td width="33%"><CENTER><font color="#FFFFFF"><B>ชื่อหรือชนิดวัสดุ (ขนาดหรือลักษณะ)</B></font></CENTER></td>
   <td width="18%"><CENTER><font color="#FFFFFF"><B>ประเภท</B></font></CENTER></td>
   <td width="18%"><CENTER><font color="#FFFFFF"><B>ย่อย</B></font></CENTER></td>
   <td width="10%"><CENTER><font color="#FFFFFF"><B>จำนวนเหลือ</B></font></CENTER></td>  
   <td width="10%"><CENTER><font color="#FFFFFF"><B>หน่วยนับ</B></font></CENTER></td>     
   <td width="11%"><CENTER><font color="#FFFFFF"><B>หน่วยงาน</B></font></CENTER></td>
  </tr>  
<?php
if($op == "search_name") {

if($_SESSION['section_id']==0 OR $_SESSION['admin_level'] == 2) {
$res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE sh_name='".$_POST['sh_name']."' ORDER BY sh_id DESC "); //LIMIT $goto, $limit 
} else {
$res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE sh_name='".$_POST['sh_name']."' AND section_id=".$_SESSION['section_id']." ORDER BY sh_id DESC "); //LIMIT $goto, $limit 
}
}
if($op == "search_type") { 

if($_SESSION['section_id']==0 OR $_SESSION['admin_level'] == 2) {
   if($_POST['subtype_id']=='') {
       $res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE type_id=".$_POST['type_id']." ORDER BY sh_id DESC "); //LIMIT $goto, $limit   
   } else {
       $res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE type_id=".$_POST['type_id']." AND subtype_id=".$_POST['subtype_id']." ORDER BY sh_id DESC "); //LIMIT $goto, $limit 
   }
} else {
   if($_POST['subtype_id']=='') {
       $res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE type_id=".$_POST['type_id']." AND section_id=".$_SESSION['section_id']." ORDER BY sh_id DESC "); //LIMIT $goto, $limit   
   } else {
       $res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE type_id=".$_POST['type_id']." AND subtype_id=".$_POST['subtype_id']." AND section_id=".$_SESSION['section_id']." ORDER BY sh_id DESC "); //LIMIT $goto, $limit 
   }
}   
}
$count=0;
while($arr['stock_head'] = $db->fetch($res['stock_head'])){

    empty($arr['stock_head']['sh_diff_name'])?$sh_diff_name="":$sh_diff_name=" ( ".$arr['stock_head']['sh_diff_name']." )" ;
	$res['stock_type'] = $db->select_query("SELECT * FROM ".TB_STOCK_TYPE." WHERE type_id='".$arr['stock_head']['type_id']."' ");
	$arr['stock_type'] = $db->fetch($res['stock_type']);
	$res['stock_subtype'] = $db->select_query("SELECT * FROM ".TB_STOCK_SUBTYPE." WHERE subtype_id='".$arr['stock_head']['subtype_id']."' ");
	$arr['stock_subtype'] = $db->fetch($res['stock_subtype']);
	if($arr['stock_head']['section_id']==0){
	  $section_name = WEB_AGEN_MINI.WEB_AGEN_NAME ;
	} else {
	$res['section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." WHERE section_id='".$arr['stock_head']['section_id']."' ");
	$arr['section'] = $db->fetch($res['section']);
	  $section_name = $arr['section']['section_name'] ;
    }	
	empty($arr['stock_subtype']['subtype_name'])?$subtype_name="ทั่วไป":$subtype_name="".$arr['stock_subtype']['subtype_name']."" ;
    $res['head_from_amountcost'] = $db->select_query("SELECT SUM(shf_amountcost) AS amountcost  FROM ".TB_STOCK_HEAD_PRICE." WHERE sh_id=".$arr['stock_head']['sh_id']."");
	$arr['head_from_amountcost'] = $db->fetch($res['head_from_amountcost']);
	
	
    if($count%2==0) { //ส่วนของการ สลับสี 
      $ColorFill = "#FDEAFB";
    } else {
      $ColorFill = "#F0F0F0";
    }

?>
    <tr bgcolor="<?php echo $ColorFill; ?>" onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='<?php echo $ColorFill;?>' " height="18">

     <td><A HREF="?compu=wsd&loc=add_material&op=old_material&sh_id=<?php echo $arr['stock_head']['sh_id'];?>">
	 <?php echo $arr['stock_head']['sh_name'];?><?php echo $sh_diff_name; ?></A><?php echo $CommentIcon;?></td>
     <td align="center"><?php echo $arr['stock_type']['type_name'] ;?></td>
	 <td align="center"><?php echo $subtype_name ;?></td>
     <td align="center"><font color="#FF0000"><b><?php echo $arr['head_from_amountcost']['amountcost'] ;?></b></font></td>
     <td align="center"><?php echo $arr['stock_head']['sh_unit'] ;?></td>
	 <td align="center"><?php echo $section_name ;?></td>
    </tr>
	<TR>
		<TD colspan="6" height="1" class="dotline"></TD>
	</TR>
<?php
	$count++;
 } 
?>
 </table>
<BR>
<?php
//	SplitPage($page,$totalpage,"?compu=admin&loc=stock");
//	echo $ShowSumPages ;
//	echo "<BR>";
//	echo $ShowPages ;
    echo "<br><br><a href=\"?compu=wsd&loc=add_material&op=new_material\" ><img src=\"images/wsd/add_new_material.png\" alt=\"เพิ่มวัสดุตัวใหม่\" align=\"middle\" border=\"0\" width=\"176\" height=\"23\" /></a>" ; 
}


}  else {
?>
<script language="javascript" type="text/javascript">
function  print_acc_Open(sh_id) {
window.open("?compu=wsd&loc=print_acc_see&sh_id="+sh_id+"","","toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=950,height=680,left=5,top=5"); 
} 
</script>
<?php
	echo $ProcessOutput ;
}
$db->closedb ();
?>
	</td>
	</tr>
</table>