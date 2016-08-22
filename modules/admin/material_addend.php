<?php 
notview();
//CheckAdmin($admin_user, $admin_pwd);
//$budget_year = $_SESSION['budget_year'] ;
?>
<link href="psdloc/admin/css/style.css" rel="stylesheet" type="text/css">
	<TABLE cellSpacing="0" cellPadding="0" width="950" border="0">
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="940" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/admin/texmenu_stock_start.gif" BORDER="0"><BR>
				<TABLE width="940" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?folder=admin&file=main">หน้าหลักผู้ดูแลระบบ</A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp;เริ่มต้นใช้งานบัญชีวัสดุ</B>
					&nbsp;(<font color="#ff0000">คัดลอกจากการ์ดบัญชีวัสดุแถวสุดท้ายมาคีย์ใส่</font>)
					<BR><BR>
					<A HREF="?folder=admin&file=material"><IMG SRC="images/icon/open.gif"  BORDER="0" align="absmiddle"> รายการบัญชีวัสดุ</A>  &nbsp;&nbsp;&nbsp;
					<A HREF="?folder=admin&file=material_addstart"><IMG SRC="images/icon/book.gif"  BORDER="0" align="absmiddle"> คัดลอกจากการ์ดบัญชีวัสดุทั้งหมด</A>&nbsp;&nbsp;&nbsp;
					<A HREF="?folder=admin&file=material_addend"><IMG SRC="images/icon/userinfo.gif"  BORDER="0" align="absmiddle"> คัดลอกจากการ์ัดญชีวัสดุี่แถวเดียวสุดท้าย</A>&nbsp;&nbsp;&nbsp;					
					<A HREF="?folder=admin&file=type_material"><IMG SRC="images/icon/folders.gif"  BORDER="0" align="absmiddle"> รายการหมวดหมู่วัสดุ</A> &nbsp;&nbsp;&nbsp;
					<A HREF="?folder=admin&file=type_material&op=type_material_add"><IMG SRC="images/icon/opendir.gif"  BORDER="0" align="absmiddle"> เพิ่มหมวดหมู่วัสดุ</A><BR><BR>
<?php 
//////////////////////////////////////////// เพิ่มวัสดุเข้าใหม่  //////////////////////////////////////////////////////////////

if($op == "material_addstart") {
	
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	//ตรวจสอบมี user นี้หรือยัง
    empty($_POST['sh_unit'])?$sh_unit=$_POST['sh_unit_new']:$sh_unit=$_POST['sh_unit'];		
	$res['stock_head'] = $db->select_query("SELECT sh_id FROM ".TB_STOCK_HEAD." WHERE sh_name='".$_POST['sh_name']."' AND sh_unit='".$sh_unit."' AND type_id='".$_POST['type_id']."' AND sh_diff_name='".$_POST['sh_diff_name']."' AND section_id='".$_POST['section_id']."'");
	$rows['stock_head'] = $db->rows($res['stock_head']); 
	$db->closedb ();
		if($rows['stock_head']){
			$ProcessOutput .= "<BR><BR>";
			$ProcessOutput .= "<CENTER><IMG SRC=\"images/notview.gif\" BORDER=\"0\"><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ชื่อหรือชนิดวัสดุ : ".$_POST['sh_name']." มีในระบบแล้วไม่สามารถเพิ่มได้</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"javascript:history.go(-1);\"><B>กลับไปเพิ่มชื่อหรือชนิดวัสดุใหม่</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
			$check_psd = true ;
		}else {
			 
   
			     if(($_POST['sd_pricecost_1']/$_POST['sd_amountcost_1']) == $_POST['sd_price_1'] ) { //เช็ค ราคาคงเหลือ (หาร) จำนวนคงเหลือ   เท่ากับ  ราคาต่อหน่อยหรือป่าว	
			       $check_psd = true ;
			       } else {
			       $check_psd = false ;
			       }

  		 if($check_psd) {	
   
            $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
            
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
			$sd_print = 1 ;			
	
                 
                if( $_POST['sd_logic_1'] == '1' ) {
	                $res['shop'] = $db->select_query("SELECT shop_name FROM ".TB_SHOP." WHERE shop_name ='".$_POST['sd_name_1']."'");
	                $rows['shop'] = $db->rows($res['shop']);                     
					if(!$rows['shop']){
					    $db->add_db(TB_SHOP,array(
				        "shop_name"=>"".$_POST['sd_name_1'].""
			            ));	
                    }					
                }				
	            	
                $db->add_db(TB_STOCK_HEAD_PRICE,array(
				"shf_amountcost"=>"".$_POST['sd_amountcost_1']."",
				"shf_price"=>"".$_POST['sd_price_1']."",
				"shf_diff_name"=>"".$_POST['shf_diff_name_1']."",
				"sh_id"=>"".$sh_id.""				
	            ));	
					
			    $check_shf_id=mysql_query("select shf_id  from ".TB_STOCK_HEAD_PRICE." ORDER BY shf_id  DESC");
		        list($shf_id)=mysql_fetch_row($check_shf_id);
			    empty($shf_id)?$shf_id="":$shf_id=$shf_id ;
			
            $db->add_db(TB_STOCK_SECTION.$budget,array(
				"sh_id"=>"".$sh_id."",
				"sd_date"=>"".$_POST['sh_date_1']."",
				"sd_name"=>"".$_POST['sd_name_1']."",
				"sd_ref"=>"".$_POST['sd_ref_1']."",
				"sd_price"=>"".$_POST['sd_price_1']."",
				"sd_amount"=>"".$_POST['sd_amount_1']."",
				"sd_amountcost"=>"".$_POST['sd_amountcost_1']."",
				"sd_pricecost"=>"".$_POST['sd_pricecost_1']."",
				"sd_note"=>"".$_POST['sd_note_1']."",				
				"sd_logic"=>"".$_POST['sd_logic_1']."",								
				"sd_print"=>"".$sd_print."",												
				"section_id"=>"".$_POST['sd_section_id_1']."",
                "shf_id"=>"".$shf_id.""								
			));				
			
			$db->closedb ();
			$ProcessOutput  = "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?folder=admin&file=main\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการบันทึก  ชื่อวัสดุ : ".$_POST['sh_name']." เป็นที่เรียบร้อย</B></FONT><BR><BR>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";

		    } else {
            $ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ยังมีรายการยังไม่ลงตัว</B></FONT><BR><BR>";
             	echo $amount." และ  ".$price	;	
			}			
		}
	
} else if($op == "material_addend") {


		$line = $_POST['hdnMaxLine_shf'] ;
		$price_sum = 0 ;
       	for($i=1;$i<=$line;$i++) {
		if ($_POST['shf_price_'.$i] == "" OR $_POST['shf_amount_'.$i] == "" OR $_POST['sum_price_'.$i] == "" ){
            $check_psd = false ;
			echo "มีบางตัวเป็นค่าว่าง" ;
			break;
		} else if(($_POST['shf_price_'.$i]*$_POST['shf_amount_'.$i]) == $_POST['sum_price_'.$i]) { 
		    $price_sum = $price_sum + ($_POST['shf_price_'.$i]*$_POST['shf_amount_'.$i]) ;
		    $check_psd = true ;
		} else {
		    $check_psd = false ;
			echo "คำนวนไม่ลงตัว" ;
			break;
		} 
        }
		if($price_sum <> $_POST['sd_pricecost_1']) {
		   $check_psd = false ;
		}
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
			$sd_print = 1 ;			

                 
                if( $_POST['sd_logic_1'] == '1' ) {
	                $res['shop'] = $db->select_query("SELECT shop_name FROM ".TB_SHOP." WHERE shop_name ='".$_POST['sd_name_1']."'");
	                $rows['shop'] = $db->rows($res['shop']);                     
					if(!$rows['shop']){
					    $db->add_db(TB_SHOP,array(
				        "shop_name"=>"".$_POST['sd_name_1'].""
			            ));	
                    }					
                }				

            for($i=1;$i<=$line;$i++) {
			    $db->add_db(TB_STOCK_HEAD_PRICE,array(
				"shf_amountcost"=>"".$_POST['shf_amount_'.$i]."",
				"shf_price"=>"".$_POST['shf_price_'.$i]."",
				"shf_diff_name"=>"".$_POST['shf_diff_name_'.$i]."",
				"sh_id"=>"".$sh_id.""				
	            ));	
            }
			    $check_shf_id=mysql_query("select shf_id  from ".TB_STOCK_HEAD_PRICE." where sh_id=".$sh_id." order by shf_id ");
		        list($shf_id)=mysql_fetch_row($check_shf_id);
			    empty($shf_id)?$shf_id="":$shf_id=$shf_id ;			
			
            $db->add_db(TB_STOCK_SECTION.$budget,array(
				"sh_id"=>"".$sh_id."",
				"sd_date"=>"".$_POST['sh_date_1']."",
				"sd_name"=>"".$_POST['sd_name_1']."",
				"sd_ref"=>"".$_POST['sd_ref_1']."",
				"sd_price"=>"".$_POST['sd_price_1']."",
				"sd_amount"=>"".$_POST['sd_amount_1']."",
				"sd_amountcost"=>"".$_POST['sd_amountcost_1']."",
				"sd_pricecost"=>"".$price_sum."",
				"sd_note"=>"".$_POST['sd_note_1']."",				
				"sd_logic"=>"".$_POST['sd_logic_1']."",								
				"sd_print"=>"".$sd_print."",												
				"section_id"=>"".$_POST['sd_section_id_1']."",
                "shf_id"=>"".$shf_id.""								
			));		
			
			$db->closedb ();
			$ProcessOutput  = "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?folder=admin&file=main\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการบันทึก  ชื่อวัสดุ : ".$_POST['sh_name']." เป็นที่เรียบร้อย</B></FONT><BR><BR>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";

		    } else {
            $ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ยังมีรายการไม่ลงตัว555</B></FONT><BR><BR>";
             	echo $amount." และ  ".$price	;	
				
			}			



}

if($op == "" and !$ProcessOutput){                 
	require_once("psdloc/material/function.php");
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		
		$check=mysql_query("select sh_code_id  from ".TB_STOCK_HEAD." ORDER BY sh_id  DESC");
		list($code_id)=mysql_fetch_row($check);
		
		$code=checkProductCode($code_id);	
        $strSQL = "SELECT * FROM web_stock_unit ORDER BY unit_name ";
        $objQuery = mysql_query($strSQL);


?>
<link href="psdloc/material/css/style.css" rel="stylesheet" type="text/css">
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
     req.open("GET", "psdloc/admin/stocktype.php?data="+src+"&val="+val+"&random="+random , true); //สร้าง connection
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
		var Item = new Option("<?php //=$objResult["unit_name"];?>", "<?php //=$objResult["unit_name"];?>"); 
		objSelect.options[objSelect.length] = Item;
		<?php 
		//}
		?>
	}
***/
function  been_paid_open(line)
   {
//  alert(form.sh_unit.value);
     var sd_logic = document.getElementById('sd_logic_'+line).value ;  
     var section_id = document.getElementById('section_id').value ;  
     window.open('psdloc/admin/been_paid_add.php?line='+line+'&sd_logic='+sd_logic+'&section_id='+section_id+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=400,height=200,left=330,top=200');
   }   	   
function  diff_name_open(line)
   {
	 var sh_diff_name = document.frmMain.sh_diff_name.value ; 
      //alert(sh_id);	 
     window.open('psdloc/admin/shf_diff_name_add.php?line='+line+'&sh_diff_name='+sh_diff_name+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=450,height=200,left=330,top=200');
   } 

function chkNum(ele)
{
var num = parseFloat(ele.value);
ele.value = num.toFixed(2);
}   
   
</script>
<div id="pCalendar" style="position: absolute; left: 10px; top: 10px; visibility: hidden;"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
<form NAME="frmMain" METHOD="post" ACTION="?folder=admin&file=material_addend&op=material_addstart" onSubmit="return check()" ENCTYPE="multipart/form-data">
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">รหัส :<br>&nbsp;&nbsp;<input type="text" name="sh_code_id" id="sh_code_id" value="<?php echo $code ;?>" size="10"></td>
    <td height="30" align="center">ประเภท :<br><font id="stock_type"><select><option value="0">-------------------</option></select></font></td>	
    <td align="center">ประเภทย่อย :<br><font id="stock_subtype"><select><option value="0">-------------------</option></select></font></td>	
    <td width="120" align="center">หน่วยงาน :
<?php 
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

	if($_SESSION['section_id'] == 0 OR $_SESSION['admin_level'] == 2){
	
	 if($wsd_card == 0){
	 echo "<input type='text' value='".$agen_mini.$agen_name."' readonly >" ;
	 echo "<input type='hidden' name='section_id' id='section_id' value='0' >" ;
	 } else if($wsd_card == 1){
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
	</td> 
    <td align="center">ที่เก็บ :<br><input type="text" name="sh_keep" id="sh_keep" size="23"></td>	
  </tr>
  <tr><td colspan="5" height="10"></td></tr>
  <tr>
	<td  height="30" align="center" >ชื่อหรือชนิดวัสดุ :<br><input type="text" name="sh_name" id="sh_name" size="30" maxlength="50"></td>
    <td align="center"><FONT COLOR="#FF0000"><B>*</B></FONT>ขนาดหรือลักษณะ : <br><input type="text" size="27" value="" name="sh_diff_name" id="sh_diff_name" /></td>  
    <td align="center" colspan="2">หน่วยนับ :<br>
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
    <td height="30" align="center">จำนวนอย่าง :<br>สูง <input type="text" name="sh_high" id="sh_high" size="6" maxlength="6" style="text-align:center;" />&nbsp;&nbsp;ต่ำ 
    <input type="text" name="sh_low" id="sh_low" size="6" maxlength="6" style="text-align:center;" ></td>	
  </tr>
</table><br>
<table id="tbExp" width="100%" border="0" cellspacing="2" cellpadding="1" align="center">
  <tr bgcolor="#AAAAAA" height="25">
    <td ><div align="center">วัน เดือน ปี</div></td>
    <td width="60"><div align="center">รับ/จ่าย</div></td>
	<td><div align="center">รายการ</div></td>
    <td><div align="center">ขนาด/ลักษณะ</div></td>
    <td><div align="center">ราคาต่อหน่วย/จำนวน</div></td>	
    <td><div align="center">คงเหลือ</div></td>
	<td><div align="center">หมายเหตุ</div></td>
  </tr>

  <tr>
    <td align="center" ><input name="tCalendar_1" type="text" id="tCalendar_1" size="11">&nbsp;<IMG SRC="images/dateselect.gif" BORDER="0" ALT="เลือกวันที่" onClick="showCalendar(this,1)" align="absmiddle">
	<br><input type="hidden" name="sh_date_1" id="sh_date_1" size="12"></td>
    <td align="left">
	<select name="sd_logic_1" id="sd_logic_1" >
	<option value="0" >จ่ายให้</option>
	<option value="1" >รับจาก</option>
	</select>
	<input type="hidden" name="sd_section_id_1" id="sd_section_id_1"  value="">
    </td>
	<td align="center">
	 <input type="text" name="sd_name_1" id="sd_name_1" size="25" value="">
	 <input  type="button" onClick="been_paid_open(1)" value="...">
	</td>
    <td align="center">
	<font id="disp_diff_name_1"><input type="text" name="shf_diff_name_1" id="shf_diff_name_1" size="24" disabled></font>
	<input  type="button" onClick="diff_name_open(1)" value="..."><br>
	 เลขที่เอกสาร :<input type="text" name="sd_ref_1" id="sd_ref_1" size="15" value="">
	</td>
    <td align="center">
	<FONT COLOR="#FF0000">ราคา</FONT>/หน่วย&nbsp;:<input type="text" name="sd_price_1" id="sd_price_1" size="9" style="text-align:center;" value="" OnChange="JavaScript:chkNum(this)" ><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวน&nbsp;:<input type="text" name="sd_amount_1" id="sd_amount_1" size="9" style="text-align:center;" value="">
	</td>
    <td align="center">
	&nbsp;&nbsp;&nbsp;<FONT COLOR="#FF0000">ราคา</FONT>เหลือ&nbsp;:<input type="text" name="sd_pricecost_1" id="sd_pricecost_1" size="9" style="text-align:center;" value="" OnChange="JavaScript:chkNum(this)" ><br>
	จำนวนเหลือ&nbsp;:<input type="text" name="sd_amountcost_1" id="sd_amountcost_1" size="9" style="text-align:center;" value="">
	</td>	
	<td align="center">
	 <input type="hidden" name="hdnMaxLine_shf" value="1">
	<textarea name="sd_note_1" cols="20" rows="3"></textarea>
	</td>
  </tr> 
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="60"><div align="center">&nbsp;</div></td>
    <td colspan="4">
	<input name="btnAdd" type="button" id="btnAdd" value=" +เพิ่มแถว " onClick="CreateNewRow();" disabled="disabled"> 
    <input name="btnDel" type="button" id="btnDel" value=" -ลดแถว  " onClick="RemoveRow();" disabled="disabled"> 
	</td>
  </tr>
</table>  
<center><input type="submit" value="บันทึกรายการบัญชีวัสดุ" name="submit">
<br>&nbsp;
</td>
</form>
</tr></table>
<FONT COLOR="#FF0000" ALIGN="left"><B>*&nbsp;กรณีต้องการมีหลายขนาดหรือหลายลักษณะ&nbsp;ให้กำหนดที่แถวด้านล่าง</B></FONT>

<SCRIPT LANGUAGE="javascript">	
function check() {
if(document.frmMain.type_id.value==0) {
alert("กรุณาเลือก  ประเภทวัสดุ  ด้วยครับ") ;
document.frmMain.type_id.focus() ;
return false ;
}
if(document.frmMain.section_id.value=="") {
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

dtNow = new Date();
makeCalendar(dtNow.getMonth(), dtNow.getFullYear());

</SCRIPT>

<?php 
} else {

	echo $ProcessOutput ;
	
if(!$check_psd) {

    echo "<script language=\"javascript\" type=\"text/javascript\">" ;
    echo "function  unit_open(form)" ;
    echo "{" ;
    echo "window.open('psdloc/admin/unit_add.php?shf_unit='+frm_form.shf_unit.value+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=400,height=200,left=330,top=200')" ;
    echo "}" ;  
    echo "</script>" ;
    
?>
<script language="javascript" type="text/javascript">

	function CreateNewRow_shf()
	{
		var intLine = parseInt(document.frm_stock_from.hdnMaxLine_shf.value);
		intLine++;
			
		var theTable = document.getElementById("table_shf");
		var newRow = theTable.insertRow(theTable.rows.length)
		newRow.id = newRow.uniqueID

		var newCell
		
		//*** Column 1 ***//
		newCell = newRow.insertCell(0);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><font color=\"#548962\">แถวที่  "+intLine+"</font></center>";

		//*** Column 2 ***//
		newCell = newRow.insertCell(1);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><input type=\"text\" size=\"10\" name=\"shf_price_"+intLine+"\" id=\"shf_price_"+intLine+"\" style=\"text-align:center;\" value=\"\" OnChange=\"JavaScript:chkNum(this)\"></center>";

		//*** Column 3 ***//
		newCell = newRow.insertCell(2);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center>x&nbsp;<input type=\"text\" size=\"8\" name=\"shf_amount_"+intLine+"\" id=\"shf_amount_"+intLine+"\" style=\"text-align:center;\" value=\"\"></center>";
		
		//*** Column 4 ***//
		newCell = newRow.insertCell(3);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><font color=\"#548962\"><b><?php echo $sh_unit ;?></b></font></center>";

		//*** Column 5 ***//
		newCell = newRow.insertCell(4);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center>=&nbsp;<input type=\"text\" size=\"10\" name=\"sum_price_"+intLine+"\" id=\"sum_price_"+intLine+"\" style=\"text-align:center;\" value=\"\"></center>";

		//*** Column 6 ***//
		newCell = newRow.insertCell(5);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		
		if (document.frm_stock_from.sh_diff_name.value == "") {
		newCell.innerHTML = "<center><font id=\"disp_diff_name_"+intLine+"\"><input type=\"text\" size=\"25\" name=\"shf_diff_name_"+intLine+"\" id=\"shf_diff_name_"+intLine+"\" value=\"\" disabled></font>&nbsp;<input type=\"button\" onClick=\"diff_name_open("+intLine+")\" value=\"...\"></center>";
		} else {
		newCell.innerHTML = "<center><input type=\"text\" size=\"25\" name=\"shf_diff_name_"+intLine+"\" id=\"shf_diff_name_"+intLine+"\" value=\"<?php echo $_POST['sh_diff_name']; ?>\" disabled=\"disabled\"></center>";		
		}
		
        document.frm_stock_from.hdnMaxLine_shf.value = intLine;
	}

	function RemoveRow_shf()
	{
		intLine = parseInt(document.frm_stock_from.hdnMaxLine_shf.value);
		if(parseInt(intLine) > 1)
		{
				theTable = document.getElementById("table_shf");				
				theTableBody = theTable.tBodies[0];
				theTableBody.deleteRow(intLine);
				intLine--;
				document.frm_stock_from.hdnMaxLine_shf.value = intLine;
		}	
	}
function  diff_name_open(line)
   {
	 var sh_diff_name = document.frm_stock_from.sh_diff_name.value ; 
      //alert(sh_id);	 
     window.open('psdloc/admin/shf_diff_name_add.php?line='+line+'&sh_diff_name='+sh_diff_name+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=450,height=200,left=330,top=200');
   } 
 
function chkNum(ele)
{
var num = parseFloat(ele.value);
ele.value = num.toFixed(2);
}    
   
</script>	
 <?php  
    empty($_POST['sh_unit'])?$sh_unit=$_POST['sh_unit_new']:$sh_unit=$_POST['sh_unit'];	
    empty($_POST['sh_diff_name'])?$sh_diff_name="":$sh_diff_name=$_POST['sh_diff_name']; 
    empty($_POST['shf_diff_name_1'])?$shf_diff_name_1="":$shf_diff_name_1=$_POST['shf_diff_name_1']; 
?> 
<table id="table" width="100%" border="0" cellspacing="2" cellpadding="1" align="center">
 <tr bgcolor="#CCCCCC" height="25"><td>&nbsp;<br><div align="center"><font color="#548962">
   เลขที่วัสดุ : <?php echo $_POST['sh_code_id'] ;?> ชื่อหรือชนิด :  <?php echo $_POST['sh_name'] ;?> ขนาดหรือลักษณะ :  <?php echo $_POST['sh_diff_name'] ;?><br><br>
   จำนวนคงเหลือ : <?php echo $_POST['sd_amountcost_1'] ;?><?php echo $sh_unit ;?> ราคาคงเหลือ :  <?php echo $_POST['sd_pricecost_1'] ;?>  บาท
  </font></div><br>&nbsp;</td></tr>
</table>
<form NAME="frm_stock_from" METHOD="post" ACTION="?folder=admin&file=material_addend&op=material_addend" onSubmit="return check()" ENCTYPE="multipart/form-data">
<table id="table_shf" width="700" border="0" cellspacing="2" cellpadding="1" align="center">
   <tr bgcolor="#CCCCCC" height="25">
    <td width="120"><div align="center"></div></td>
	<td width="100"><div align="center">ราคาต่อหน่วย</div></td>
	<td width="100"><div align="center">จำนวน</div></td>
	<td width="100"><div align="center">หน่วยนัับ</div></td>
	<td width="100"><div align="center">เป็นเงิน</div></td>
	<td width="180"><div align="center">ขนาดหรือลักษณะ :</div></td>
   </tr>
   <tr height="35">
    <td align="center">
	<font color="#548962">แถวที่ 1</font>
	</td>
    <td align="center">
	<input type="text" size="10" name="shf_price_1" id="shf_price_1" style="text-align:center;" value="<?php echo $_POST['sd_price_1'] ;?>" OnChange="JavaScript:chkNum(this)" > <!-- disabled="disabled" -->
	</td>
    <td align="center">x&nbsp;
	<input type="text" size="8" name="shf_amount_1" id="shf_amount_1" style="text-align:center;" value="<?php echo $_POST['sd_amount_1'] ;?>" > 
	</td>
	<td align="center">
	<font color="#548962"><b><?php echo $sh_unit ;?></b></font>
	</td>
	<td align="center">=&nbsp;
	<input type="text" size="10" name="sum_price_1" id="sum_price_1" style="text-align:center;" value="<?php echo $_POST['sd_price_1']*$_POST['sd_amount_1'] ;?>"> 
	</td>
	<td align="center">
	<?php  if($sh_diff_name == "" and $shf_diff_name_1 == "" ) { ?>
	<font id="disp_diff_name_1"><input type="text" size="25" name="shf_diff_name_1" id="shf_diff_name_1" value="" disabled></font>
    <input type="button" onClick="diff_name_open(1)" value="...">
	<?php  } else if($shf_diff_name_1 <> "" ) { ?>
	<input type="text" size="28" name="shf_diff_name_1" id="shf_diff_name_1" value="<?php echo $_POST['shf_diff_name_1']; ?>" readonly>
    <?php  } else { ?>	
	<input type="text" size="25" name="shf_diff_name_1" id="shf_diff_name_1" value="<?php echo $_POST['sh_diff_name']; ?>" disabled>
	<?php  } ?>
	</td>
	</tr>
 <input type="hidden" name="sh_code_id" value="<?php echo $_POST['sh_code_id'] ;?>">  
 <input type="hidden" name="type_id" value="<?php echo $_POST['type_id'] ;?>">
 <input type="hidden" name="subtype_id" value="<?php echo $_POST['subtype_id'] ;?>">
 <input type="hidden" name="sh_name" value="<?php echo $_POST['sh_name'] ;?>">
 <input type="hidden" name="sh_diff_name" value="<?php echo $sh_diff_name ;?>">
 <input type="hidden" name="sh_unit" value="<?php echo $sh_unit ;?>">
 <input type="hidden" name="sh_keep" value="<?php echo $_POST['sh_keep'] ;?>">
 <input type="hidden" name="sh_high" value="<?php echo $_POST['sh_high'] ;?>">
 <input type="hidden" name="sh_low" value="<?php echo $_POST['sh_low'] ;?>">
 <input type="hidden" name="section_id" value="<?php echo $_POST['section_id'] ;?>">
 <input type="hidden" name="sh_id" value="<?php echo $sh_id ;?>">
 <input type="hidden" name="sh_date_1" value="<?php echo $_POST['sh_date_1'] ;?>">
 <input type="hidden" name="sd_name_1" value="<?php echo $_POST['sd_name_1'] ;?>"> 
 <input type="hidden" name="sd_ref_1" value="<?php echo $_POST['sd_ref_1'] ;?>"> 
 <input type="hidden" name="sd_price_1" value="<?php echo $_POST['sd_price_1'] ;?>"> 
 <input type="hidden" name="sd_amount_1" value="<?php echo $_POST['sd_amount_1'] ;?>"> 
 <input type="hidden" name="sd_amountcost_1" value="<?php echo $_POST['sd_amountcost_1'] ;?>">
 <input type="hidden" name="sd_note_1" value="<?php echo $_POST['sd_note_1'] ;?>">
 <input type="hidden" name="sd_logic_1" value="<?php echo $_POST['sd_logic_1'] ;?>">
 <input type="hidden" name="sd_print" value="<?php echo $sd_print ;?>">
 <input type="hidden" name="sd_section_id_1" value="<?php echo $_POST['sd_section_id_1'] ;?>">  
 <input type="hidden" name="sh_unit_new" value="<?php echo $_POST['sh_unit_new'] ;?>">
 <input type="hidden" name="hdnMaxLine_shf" value="1">
</table>
<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="120"><div align="center">&nbsp;</div></td>
    <td width="200"colspan="2" align="right">รวม&nbsp;&nbsp;=&nbsp;<font color="#FF0000" ><?php echo $_POST['sd_amountcost_1'] ;?></font>&nbsp;<?php echo $sh_unit ;?>&nbsp;&nbsp;</td>
    <td width="200"colspan="2" align="right">รวมเป็นเงิน&nbsp;=&nbsp;<font color="#FF0000" ><input type="text" name="sd_pricecost_1" id="sd_pricecost_1" style="text-align:center;" value="<?php echo $_POST['sd_pricecost_1'] ;?>" OnChange="JavaScript:chkNum(this)" ></font>&nbsp;บาท&nbsp;&nbsp;</td>
    <td width="180"><div align="center">&nbsp;</div></td>
  </tr>
</table> <br>
<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><div align="left">
	<input name="btnAdd" type="button" id="btnAdd" value=" +เพิ่มแถว " onClick="CreateNewRow_shf();">
    <input name="btnDel" type="button" id="btnDel" value=" -ลดแถว  " onClick="RemoveRow_shf();">
    </div>
	<input type="hidden" name="add_diff" value="0">
	</td>
  </tr>
</table> 
  <tr height="40">
  <td colspan="6" align="center"><br><center>
  <input type="submit" value="บันทึกบัญชีวัสดุอีกครั้ง" name="submit">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value=" เคลีย  " name="reset">
  </center></td>
  </tr>
 </form>
<?php 	
}
}
?>
						<BR><BR>
					</TD>
				</TR>
			</TABLE>
		</TD>
	  </TR>
	</TABLE>