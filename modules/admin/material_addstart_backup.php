

<form NAME="searchtype" METHOD="post" ACTION="?compu=admin&loc=material_addstart&op=search_type" onSubmit="return check_type()" ENCTYPE="multipart/form-data" >
          <td align="center" height="35" valign="middle"><br>
          ประเภทวัสดุ :<span id="stock_type"><select><option value="0">-------------------</option></select></span>&nbsp;
          ย่อย :<span id="stock_subtype"><select><option value="0">-------------------</option></select></span><br><br>    
          <input type="submit" name="submit" id="submit" value="ค้นหาตามประเภท" />      
          </td>
</form>	

<form NAME="searchtype" METHOD="post" ACTION="?compu=admin&loc=material_addstart&op=search_type" onSubmit="return check_type()" ENCTYPE="multipart/form-data" >
<?php $result = mysql_query("select * from ".TB_STOCK_TYPE." order by type_id") or die ("Err Can not to result"); ?>        
          <td align="center" height="35" valign="middle"><br>
          ประเภทวัสดุ :
		  <select id="type_id" name="type_id" onChange="list('#stock_subtype',this.value,'type_id');">
		          <option value="">---เลือก---</option>
          <?php
		  while($row = mysql_fetch_array($result)){
               echo "<option value='$row[type_id]'>$row[type_name]</option>";
          }
		  ?>
		  </select>
          ย่อย :<select name="stock_subtype" id="stock_subtype" style="display:none"></select><br><br>    
          <input type="submit" name="submit" id="submit" value="ค้นหาตามประเภท" />      
          </td>
</form>

<?php

	
} else if($op == "material_addend" and $page == "page_one") {


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
			$sd_print = 0 ;			
                 
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


			
                $db->add_db(TB_STOCK_SECTION,array(
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
			
			//$db->closedb ();
			$ProcessOutput  = "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?folder=admin&file=main\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการบันทึก  ชื่อวัสดุ : ".$_POST['sh_name']." เป็นที่เรียบร้อย</B></FONT><BR><BR>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
            echo "<script type='text/javascript'>window.location.href = \"index.php?folder=admin&file=material_addstart&op=material_addold&data=".$sh_id."\";</script>" ;
		    } else {
            $ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ยังมีรายการไม่ลงตัว555</B></FONT><BR><BR>";
             	echo $amount." และ  ".$price	;	
				
			}			
} else if($op == "material_addhead" and $action == "add") {


echo "<script type='text/javascript'>window.location.href = \"index.php?folder=admin&file=material_addstart&op=material_addold&data=".$sh_id."\";</script>" ;


////////////////////////////////////////////////////////// (2) page สอง ////////////////////////////////////////////////////////////////////

else  if($op == "material_addold") {                 
//	require_once("modules/wsd/function.php");
	
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE sh_id=".$data."");
		$arr['stock_head'] = $db->fetch($res['stock_head']);

	if($arr['stock_head']['section_id'] == 0 ) {
	  $section_name = $agen_mini.$agen_name ;
	  $Vsection_id = $arr['stock_head']['section_id'] ;
	} else {
	  $res['section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." WHERE section_id=".$arr['stock_head']['section_id']."");
	  $arr['section'] = $db->fetch($res['section']);
	  $section_name = $arr['section']['section_name'] ;
	  $Vsection_id = $arr['stock_head']['section_id'] ;
    }
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

function dochange_edit(src, val) {
     //alert("s0");
     var req = Inint_AJAX();
     req.onreadystatechange = function () { 
          if (req.readyState==4) {
		           
               if (req.status==200) {
			        
                    document.getElementById(src).innerHTML=req.responseText; //รับค่ากลับมา
               } 
          }
     };
	 var random=Math.random();
     req.open("GET", "modules/admin/stocktype_edit.php?data="+src+"&val="+val+"&random="+random , true); //สร้าง connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
     req.send(null); //ส่งค่า
}
    
function dochange_unit() {
	    if (document.frmMain_head.sh_unit.value == "") {
        document.getElementById("unit").innerHTML="<input type=\"text\" name=\"sh_unit_new\" id=\"sh_unit_new\" size=\"18\" value=\"\" >" ;		
		} else {
        document.getElementById("unit").innerHTML="<input type=\"text\" size=\"18\" disabled=\"disabled\" >" ;
		}
    }

function  been_paid_open(line)
   {
//  alert(form.sh_unit.value);
     var sd_logic = document.getElementById('sd_logic_'+line).value ;  
     var section_id = document.getElementById('section_id').value ;  
     window.open('modules/admin/been_paid_add.php?line='+line+'&sd_logic='+sd_logic+'&section_id='+section_id+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=400,height=200,left=330,top=200');
   }  
   
function  diff_name_open(line)
   {
	 var sh_id = document.frmMain_body.sh_id.value ; 
      //alert(sh_id);	 
     window.open('modules/wsd/diff_name_add.php?line='+line+'&sh_id='+sh_id+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=400,height=200,left=330,top=200');
   }  
function  price_open(line)
   {
	 var sh_id = document.frmMain_body.sh_id.value ; 
	 var shf_diff_name = document.getElementById("shf_diff_name_"+line).value ;	
     //alert(shf_diff_name);	 
     window.open('modules/wsd/price_add.php?line='+line+'&sh_id='+sh_id+'&shf_diff_name='+shf_diff_name+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=400,height=200,left=330,top=200');
   }    
   
function chkNum(ele)
{
var num = parseFloat(ele.value);
ele.value = num.toFixed(2);
} 

function dochange_logic_area(data, val) {
     //alert(data);
     var req = Inint_AJAX();
     req.onreadystatechange = function () { 
          if (req.readyState==4) {
		           
               if (req.status==200) {
			        
                    document.getElementById('logic_area').innerHTML=req.responseText; //รับค่ากลับมา
               } 
          }
     };
	 var random=Math.random()
     req.open("GET", "modules/admin/ajax_logic_area.php?data="+data+"&val="+val+"&random="+random , true); //สร้าง connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
     req.send(null); //ส่งค่า
}
window.onLoad=dochange_logic_area(<?php echo $data ;?>, 0);   
</script>
<div id="pCalendar" style="position: absolute; left: 10px; top: 10px; visibility: hidden;"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form NAME="frmMain_head" METHOD="post" ACTION="?folder=admin&file=material_addstart&op=material_addhead&action=add" onSubmit="return check_head()" ENCTYPE="multipart/form-data">  
<tr>
    <td align="center">รหัส :<input type="hidden" name="sh_id" id="sh_id" value="<?php echo $arr['stock_head']['sh_id'] ;?>" />
	<br>&nbsp;&nbsp;<input type="text" name="sh_code_id" id="sh_code_id" value="<?php echo $arr['stock_head']['sh_code_id'] ;?>" size="10" disabled></td>
    <td height="30" align="center">ประเภท :<br>
						<span id="stock_type">
						<SELECT NAME="type_id" ID="type_id" onChange="dochange_edit('stock_subtype_edit',this.value);" >
						<?php
						$res['stock_type'] = $db->select_query("SELECT * FROM ".TB_STOCK_TYPE." ORDER BY type_id");
						while($arr['stock_type'] = $db->fetch($res['stock_type'])) {
						?>
						<OPTION value=<?php echo $arr['stock_type']['type                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              _id'];?><?php if($arr['stock_head']['type_id']=="".$arr['stock_type']['type_id'].""){ echo " selected" ; } ?>><?php echo $arr['stock_type']['type_name'];?></OPTION>
                        <?php } ?>
                        </SELECT>
						</span>
	</td>	    
	<td height="30" align="center">ประเภทย่อย :<br>
						<span id="stock_subtype_edit">
						<SELECT NAME="subtype_id" ID="subtype_id" >
						<?php
						$res['stock_subtype'] = $db->select_query("SELECT * FROM ".TB_STOCK_SUBTYPE." WHERE type_id='".$arr['stock_head']['type_id']."' ORDER BY subtype_id");
						$rows['stock_subtype'] = $db->rows($res['stock_subtype']); 
						if(!$rows['stock_subtype']) {
						echo "<OPTION value='0' selected >ทั่วไป</OPTION>" ;
						} else {
						while($arr['stock_subtype'] = $db->fetch($res['stock_subtype'])) {
						?>
						<OPTION value=<?php echo $arr['stock_subtype']['subtype_id'];?><?php if($arr['stock_head']['subtype_id']=="".$arr['stock_subtype']['subtype_id'].""){ echo " selected" ; $subtype = true ;} ?>><?php echo $arr['stock_subtype']['subtype_name'];?></OPTION>
						<?php
						}
                        if(!$subtype){
                        echo "<OPTION value='0' selected >ทั่วไป</OPTION>" ;
						}						
						}
						?>
                        </SELECT>
						</span>	
	</td>	
    <td width="100" align="center">หน่วยงาน :
	<input type="text" size="23" value="<?php echo $section_name ;?>" disabled>
	<input type="hidden" name="section_id" id="section_id" value="<?php echo $Vsection_id ;?>" >
	</td> 
    <td align="center">ที่เก็บ :<br><input type="text" name="sh_keep" id="sh_keep" size="23" value="<?php echo $arr['stock_head']['sh_keep'] ;?>"></td>	
</tr>
<tr><td colspan="5" height="10"></td></tr>
<tr>
	<td  height="30" align="center" >ชื่อหรือชนิดวัสดุ :<br><input type="text" name="sh_name" id="sh_name" size="30" maxlength="50" value="<?php echo $arr['stock_head']['sh_name'] ;?>"></td>
    <td align="center">ขนาดหรือลักษณะ : <br><input type="text" size="27" value="<?php echo $arr['stock_head']['sh_diff_name'] ;?>" name="sh_diff_name" id="sh_diff_name" /></td>  
    <td align="center" colspan="2">หน่วยนับ :<br>
	
						<SELECT NAME="sh_unit" ID="sh_unit" onChange="dochange_unit();" >
						<?php
						$res['stock_unit'] = $db->select_query("SELECT * FROM ".TB_STOCK_UNIT." ORDER BY unit_id");
						while($arr['stock_unit'] = $db->fetch($res['stock_unit'])) {
						?>
						<OPTION value=<?php echo $arr['stock_unit']['unit_name'];?><?php if($arr['stock_head']['sh_unit']=="".$arr['stock_unit']['unit_name'].""){ echo " selected" ; $unitnew = true ;} ?>><?php echo $arr['stock_unit']['unit_name'];?></OPTION>
                        <?php } ?>
                        </SELECT>
	<?php  if($unitnew) { ?>
	<font id="unit"><input type="text" name="sh_unit_new" id="sh_unit_new" size="18" value="" disabled></font>	
	<?php } else {  ?>
	<font id="unit"><input type="text" name="sh_unit_new" id="sh_unit_new" size="18" value="<?php echo $arr['stock_head']['sh_unit'] ;?>"></font>
	<?php } ?>	
    </td>
    <td height="30" align="center">จำนวนอย่าง :<br>สูง <input type="text" name="sh_high" id="sh_high" size="6" maxlength="6" value="<?php echo $arr['stock_head']['sh_high'] ;?>" style="text-align:center;"/>&nbsp;&nbsp;ต่ำ 
    <input type="text" name="sh_low" id="sh_low" size="6" maxlength="6" value="<?php echo $arr['stock_head']['sh_low'] ;?>" style="text-align:center;"></td>	
  </tr>
  <tr><td width="100%" height="35" colspan="5"><center><input type="submit" name="submit" value="บันทึกแก้ไขส่วนหัวการ์ดวัสดุ" ></td></tr>
</form>  
</table><br>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=90 rowspan=2 valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>วัน เดือน ปี</b></span></p>
  </td>
  <td width=204 rowspan=2 valign=top style='width:153.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>รับจาก/จ่ายให้</b></span></p>
  </td>
  <td width=96 rowspan=2 valign=top style='width:72.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>เลขที่เอกสาร</b></span></p>
  </td>
  <td width=96 rowspan=2 valign=top style='width:72.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>ราคาต่อหน่วย</b></span></p>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>( บาท )</b></span></p>
  </td>
  <td width=144 colspan=2 valign=top style='width:107.85pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>รับ</b></span></p>
  </td>
  <td width=144 colspan=2 valign=top style='width:108.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>จ่าย</b></span></p>
  </td>
  <td width=142 colspan=2 valign=top style='width:106.15pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>คงเหลือ</b></span></p>
  </td>
  <td width=99 rowspan=2 valign=top style='width:74.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>หมายเหตุ</b></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=72 valign=top style='width:54.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  จำนวน</span></p>
  </td>
  <td width=72 valign=top style='width:53.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ราคา</span></p>
  </td>
  <td width=72 valign=top style='width:54.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  จำนวน</span></p>
  </td>
  <td width=72 valign=top style='width:53.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ราคา</span></p>
  </td>
  <td width=72 valign=top style='width:54.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  จำนวน</span></p>
  </td>
  <td width=69 valign=top style='width:52.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ราคา</span></p>
  </td>
 </tr>
 <?php
$res['stock_details'] = $db->select_query("SELECT UNIX_TIMESTAMP(sd_date) AS st_date ,sd_name ,sd_ref ,sd_price ,sd_amount ,sd_amountcost ,sd_pricecost ,sd_note ,sd_logic  FROM ".TB_STOCK_SECTION." WHERE sh_id='".$data."' ORDER BY sd_id ");
	
	while($arr['stock_details'] = $db->fetch($res['stock_details'])) { ;
	if($arr['stock_details']['sd_logic'] == "0") {
	$get_amount = "-" ;
	$get_price = "-" ;
	$put_amount = $arr['stock_details']['sd_amount'] ;
	$put_price = $arr['stock_details']['sd_price']*$arr['stock_details']['sd_amount'] ;
    } else if($arr['stock_details']['sd_logic'] == "1") {    
	$get_amount = $arr['stock_details']['sd_amount'] ;
	$get_price = $arr['stock_details']['sd_price']*$arr['stock_details']['sd_amount'] ;
	$put_amount = "-" ;
	$put_price = "-" ;	
	}
 ?>
 <tr style='mso-yfti-irow:2;height:17.35pt'>
  <td width=90 valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo ThaiTimeConvert($arr['stock_details']['st_date'],"5",""); ?></span></p>
  </td>
  <td width=204 valign=top style='width:153.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_details']['sd_name'] ;?></span></p>
  </td>
  <td width=96 valign=top style='width:72.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_details']['sd_ref'] ;?></span></p>
  </td>
  <td width=96 valign=top style='width:72.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_details']['sd_price'] ;?></span></p>
  </td>
  <td width=72 valign=top style='width:54.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $get_amount ;?></span></p>
  </td>
  <td width=72 valign=top style='width:53.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $get_price ;?></span></p>
  </td>
  <td width=72 valign=top style='width:54.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $put_amount ;?></span></p>
  </td>
  <td width=72 valign=top style='width:53.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $put_price ;?></span></p>
  </td>
  <td width=72 valign=top style='width:54.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_details']['sd_amountcost'] ;?></span></p>
  </td>
  <td width=69 valign=top style='width:52.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_details']['sd_pricecost'] ;?></span></p>
  </td>
  <td width=99 valign=top style='width:74.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_details']['sd_note'] ;?></span></p>
  </td>
 </tr>
 <?php } ?>
</table><br>
<table id="tbExp" width="100%" border="0" cellspacing="2" cellpadding="1" align="center">
<form NAME="frmMain_body" METHOD="post" ACTION="?folder=admin&file=material_addstart&op=material_addbody&action=add" onSubmit="return check_body()" ENCTYPE="multipart/form-data">  
  <tr bgcolor="#AAAAAA" height="25">
    <td width="120"><div align="center">วัน เดือน ปี</div></td>
    <td width="60"><div align="center">เลือก</div></td>
	<td width="200"><div align="center">รับจาก/จ่ายให้</div></td>
    <td><div align="center"></div></td>
	<td width="110"><div align="center">หมายเหตุ</div></td>
  </tr>
  <tr>
    <td align="center" ><input name="tCalendar_1" type="text" id="tCalendar_1" size="11">&nbsp;<IMG SRC="images/dateselect.gif" BORDER="0" ALT="เลือกวันที่" onClick="showCalendar(this,1)" align="absmiddle">
	<br><input type="hidden" name="sh_date_1" id="sh_date_1" size="12" value=""></td>
    <td align="left">
	<select name="sd_logic_1" id="sd_logic_1" onChange="dochange_logic_area(<?php echo $data ;?>,this.value);">
	<option value="0" >จ่ายให้</option>
	<option value="1" >รับจาก</option>
	</select>
	<input type="hidden" name="sd_section_id_1" id="sd_section_id_1"  value="">
	<input type="hidden" name="sh_id" id="sh_id" value="<?php echo $arr['stock_head']['sh_id'] ;?>" />
    </td>
	<td align="center">
	 <input type="text" name="sd_name_1" id="sd_name_1" size="30" value="">
	 <input  type="button" onClick="been_paid_open(1)" value="...">
	</td>
	<td align="center">
	<span id="logic_area">
	</span>&nbsp;&nbsp;<?php echo $arr['stock_head']['sh_unit']; ?>
	</td>
 	<td align="center">
	<textarea name="sd_note_1" cols="15" rows="3"></textarea>
	<input type="hidden" name="shf_price_id_1" value="">
	</td>	
  </tr> 
  <tr><td colspan="7"><br><center><input type="submit" name="submit" value="บันทึกรายการบัญชีวัสดุ" ></td></tr>  
</form>  
</table>
</td>
</tr>
</table>

<SCRIPT LANGUAGE="javascript">	
function check_head() {
if(document.frmMain_head.type_id.value==0) {
alert("กรุณาเลือก  ประเภทวัสดุ  ด้วยครับ") ;
document.frmMain.type_id.focus() ;
return false ;
}
if(document.frmMain_head.section_id.value=="") {
alert("กรุณาเลือก  หน่วยงาน  ด้วยครับ") ;
document.frmMain.section_name.focus() ;
return false ;
}
if(document.frmMain_head.sh_name.value=="") {
alert("กรุณากรอก  ชื่อหรือชนิดวัสดุ  ด้วยครับ") ;
document.frmMain_head.sh_name.focus() ;
return false ;
}
else if(document.frmMain.sh_unit.value=="" && document.frmMain.sh_unit_new.value=="" )   {
alert("กรุณากำหนด หน่วยนับวัสดุ  ด้วยครับ") ;
document.frmMain_head.sh_unit.focus() ;
return false ;
}
else 
return true ;
}		

function check_body() {
if(document.frmMain_body.sh_date_1.value=="") {
alert("กรุณา  ลงวันที่  ด้วยครับ") ;
document.frmMain_body.tCalendar_1.focus() ;
return false ;
}
if(document.frmMain_body.sd_name_1.value=="") {
alert("กรุณาใส่ ชื่อ  ด้วยครับ") ;
document.frmMain_body.sd_name_1.focus() ;
return false ;
}
if(document.frmMain_body.shf_id.value=="") {
alert("กรุณาเลือก  ราคาหรือ ขนาดลักษณะ  ด้วยครับ") ;
document.frmMain_body.shf_id.focus() ;
return false ;
}
if(document.frmMain_body.sd_amount.value=="") {
alert("กรุณาใส่  จำนวน  ด้วยครับ") ;
document.frmMain_body.sd_amount.focus() ;
return false ;
}

else 
return true ;
}	

dtNow = new Date();
makeCalendar(dtNow.getMonth(), dtNow.getFullYear());

</SCRIPT>
<?php
$check_psd = true ;
}

////////////////////////////////////////////////////////// (1) วัสดุใหม่ ////////////////////////////////////////////////////////////////////
else if($op == "add_new") {                 



} else if(!$check_psd) {
//	echo $ProcessOutput ;
	


    echo "<script language=\"javascript\" type=\"text/javascript\">" ;
    echo "function  unit_open(form)" ;
    echo "{" ;
    echo "window.open('modules/admin/unit_add.php?shf_unit='+frm_form.shf_unit.value+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=400,height=200,left=330,top=200')" ;
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
		newCell.innerHTML = "<center><input type=\"text\" size=\"10\" name=\"shf_price_"+intLine+"\" id=\"shf_price_"+intLine+"\" value=\"\"></center>";

		//*** Column 3 ***//
		newCell = newRow.insertCell(2);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center>x&nbsp;<input type=\"text\" size=\"8\" name=\"shf_amount_"+intLine+"\" id=\"shf_amount_"+intLine+"\" value=\"\"></center>";
		
		//*** Column 4 ***//
		newCell = newRow.insertCell(3);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><font color=\"#548962\"><b><?php echo $sh_unit ;?></b></font></center>";

		//*** Column 5 ***//
		newCell = newRow.insertCell(4);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center>=&nbsp;<input type=\"text\" size=\"10\" name=\"sum_price_"+intLine+"\" id=\"sum_price_"+intLine+"\" value=\"\"></center>";

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
     window.open('modules/admin/shf_diff_name_add.php?line='+line+'&sh_diff_name='+sh_diff_name+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=450,height=200,left=330,top=200');
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
<form NAME="frm_stock_from" METHOD="post" ACTION="?folder=admin&file=material_addstart&op=material_addend&page=page_one" onSubmit="return check()" ENCTYPE="multipart/form-data">
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
	<input type="text" size="10" name="shf_price_1" id="shf_price_1" value="<?php echo $_POST['sd_price_1'] ;?>" > <!-- disabled="disabled" -->
	</td>
    <td align="center">x&nbsp;
	<input type="text" size="8" name="shf_amount_1" id="shf_amount_1" value="<?php echo $_POST['sd_amount_1'] ;?>" > 
	</td>
	<td align="center">
	<font color="#548962"><b><?php echo $sh_unit ;?></b></font>
	</td>
	<td align="center">=&nbsp;
	<input type="text" size="10" name="sum_price_1" id="sum_price_1" value="<?php echo $_POST['sd_price_1']*$_POST['sd_amount_1'] ;?>" > 
	</td>
	<td align="center">
	<?php if($sh_diff_name == "" and $shf_diff_name_1 == "" ) { ?>
	<font id="disp_diff_name_1"><input type="text" size="25" name="shf_diff_name_1" id="shf_diff_name_1" value="" disabled></font>
    <input type="button" onClick="diff_name_open(1)" value="...">
	<?php } else if($shf_diff_name_1 <> "" ) { ?>
	<input type="text" size="28" name="shf_diff_name_1" id="shf_diff_name_1" value="<?php echo $_POST['shf_diff_name_1']; ?>" readonly>
    <?php } else { ?>	
	<input type="text" size="25" name="shf_diff_name_1" id="shf_diff_name_1" value="<?php echo $_POST['sh_diff_name']; ?>" disabled>
	<?php } ?>
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
    <td width="100"><div align="center">&nbsp;</div></td>
    <td width="200"colspan="2" align="right">รวม&nbsp;&nbsp;=&nbsp;<font color="#FF0000" ><?php echo $_POST['sd_amountcost_1'] ;?></font>&nbsp;<?php echo $sh_unit ;?>&nbsp;&nbsp;</td>
    <td width="240"colspan="2" align="right">รวมเป็นเงิน&nbsp;=&nbsp;<font color="#FF0000" ><input type="text" name="sd_pricecost_1" id="sd_pricecost_1" style="text-align:center;" value="<?php echo $_POST['sd_pricecost_1'] ;?>" OnChange="JavaScript:chkNum(this)" ></font>&nbsp;บาท&nbsp;&nbsp;</td>
    <td width="160"><div align="center">&nbsp;</div></td>
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