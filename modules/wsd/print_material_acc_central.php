<?php 
notview();
//Check_passadu($admin_user,$admin_level);
empty($ProcessOutput)?$ProcessOutput="":$ProcessOutput=$ProcessOutput ;
empty($check_psd)?$check_psd="":$check_psd=$check_psd ;
//empty($check_psd)?$check_psd="":$check_psd=$check_psd ;
//$budget_year = $_SESSION['budget_year'] ;
?>
<link href="modules/admin/css/style.css" rel="stylesheet" type="text/css">
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
					<TD><IMG SRC="images/admin/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">
<?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  					
//////////////////////////////////////////// เพิ่มวัสดุเข้าใหม่  //////////////////////////////////////////////////////////////

if((!$ProcessOutput or $op == "search_name" or $op == "search_type") and $data == "") {
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
?>
<!-- <script type="text/javascript" src="js/jquery1.3.2.js"></script>
<script language="JavaScript" type="text/javascript" src="js/jquery-1.7.min.js"></script>  -->
<script language="javascript" type="text/javascript">
function suggest(inputString){
        var section_id = 0 ;
		//var section_id = document.search_name.section_id.value ;
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
					//document.querySelector(#src).innerHTML=req.responseText; //รับค่ากลับมา
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
<form NAME="search_name" METHOD="post" ACTION="?compu=wsd&loc=material_central&op=search_name" onSubmit="return check_name()" ENCTYPE="multipart/form-data" >
	  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#DDDDDD">
        <tr>
        <td align="center" valign="middle"><br>
           ชื่อหรือชนิดวัสดุ :&nbsp;
	 <input type="text" size="28" value="" name="sh_name" id="sh_name" onkeyup="suggest(this.value);" onblur="fill();" class="" />
     <div class="suggestionsBox_search" id="suggestions" style="display: none;"><img src="images/wsd/arrow.png" style="position: relative; top: -12px; left: 40px;" alt="upArrow" />
     <div class="suggestionList_search" id="suggestionsList"></div>
     </div>   
	    </td>
        </tr>
		<tr>
		<td align="center" valign="middle">
<?php
//          $res['section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." WHERE parties_id='4'");
//          echo "<select name='section_id' id='section_id'>";
//          echo "<option value='0'>----เลือกหน่วยงาน----</option>\n";
//          while($arr['section'] = $db->fetch($res['section'])){
//               echo "<option value='".$arr['section']['section_id']."'>".$arr['section']['section_name']."</option>";
//          }
//		  echo "</select>";
?>		
		<br><br>
		<input type="submit" name="submit" id="submit" value="ค้นหาตามชื่อ" /><br>
		</td>
		</tr>
      </table>
</form> 
      </td>
      <td width="60%">
<form NAME="search_type" METHOD="post" ACTION="?compu=wsd&loc=material_central&op=search_type" onSubmit="return check_type()" ENCTYPE="multipart/form-data" >
      <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#999999">
        <tr>
        <td align="center" height="35" valign="middle"><br>
          ประเภทวัสดุ :<span id="stock_type"><select><option value="0">-------------------</option></select></span>&nbsp;
          ย่อย :<span id="stock_subtype"><select><option value="0">-------------------</option></select></span> 
        </td>
        </tr>
		<tr>
		<td align="center" valign="middle">
<?php
//          $res['section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." WHERE parties_id='4'");
//          echo "<select name='section_id' id='section_id'>";
//          echo "<option value='0'>----เลือกหน่วยงาน----</option>\n";
//          while($arr['section'] = $db->fetch($res['section'])){
//               echo "<option value='".$arr['section']['section_id']."'>".$arr['section']['section_name']."</option>";
//          }
//		  echo "</select>";
?>		
		<br><br>
		<input type="submit" name="submit" id="submit" value="ค้นหาตามประเภท" /><br>
		</td>
		</tr>		
      </table>
</form>		  
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
    echo "<br><a href=\"?compu=wsd&loc=material_central&op=new_material&data=voi\" ><img src=\"images/wsd/add_new_material.png\" alt=\"เพิ่มวัสดุตัวใหม่\" align=\"middle\" border=\"0\" width=\"176\" height=\"23\" /></a><br><br>" ; 


 if($op == "search_name" or $op == "search_type"){
	 empty($_POST["type_id"])?$typeid="":$typeid=$_POST["type_id"] ;
     empty($_POST["subtype_id"])?$subtypeid="":$subtypeid=$_POST["subtype_id"] ;

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
<script language="javascript" type="text/javascript">
function  print_acc_section_open(data) {
	window.open("modules/wsd/print_acc_section.php?shs_id="+data+"","","toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=999,height=830,left=5,top=5"); 
}	
</script> 
 <table width="100%" cellspacing="2" cellpadding="1" >
  <tr bgcolor="#0066FF" height="20">
   <td width="7%"><CENTER><font color="#FFFFFF"><B>รหัส</B></font></CENTER></td>
   <td width="34%"><CENTER><font color="#FFFFFF"><B>ชื่อหรือชนิดวัสดุ (ขนาดหรือลักษณะ)</B></font></CENTER></td>
   <td width="14%"><CENTER><font color="#FFFFFF"><B>ประเภท</B></font></CENTER></td>
   <td width="14%"><CENTER><font color="#FFFFFF"><B>ย่อย</B></font></CENTER></td>
   <td width="6%"><CENTER><font color="#FFFFFF"><B>หน่วยนับ</B></font></CENTER></td>     
   <td width="12%"><CENTER><font color="#FFFFFF"><B>บัญชีวัสดุกลาง</B></font></CENTER></td>
   <td width="13%"><CENTER><font color="#FFFFFF"><B>บัญชีวัสดุ ส่วน/กอง</B></font></CENTER></td>
  </tr>  
<?php
if($op == "search_name") {
$res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE sh_name='".$_POST['sh_name']."' ORDER BY sh_id DESC "); //LIMIT $goto, $limit 
}
if($op == "search_type") {
   if($subtypeid == "") {
       $res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE type_id=".$typeid." ORDER BY sh_name "); //LIMIT $goto, $limit   
   } else {
       $res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE type_id=".$typeid." AND subtype_id=".$subtypeid." ORDER BY sh_name "); //LIMIT $goto, $limit 
   }
}

$count=0;
while($arr['stock_head'] = $db->fetch($res['stock_head'])){ 

    empty($arr['stock_head']['shc_diff_name'])?$shc_diff_name="":$shc_diff_name=" ( ".$arr['stock_head']['shc_diff_name']." )" ;
	$res['stock_type'] = $db->select_query("SELECT * FROM ".TB_STOCK_TYPE." WHERE type_id='".$arr['stock_head']['type_id']."' ");
	$arr['stock_type'] = $db->fetch($res['stock_type']);
	$res['stock_subtype'] = $db->select_query("SELECT * FROM ".TB_STOCK_SUBTYPE." WHERE subtype_id='".$arr['stock_head']['subtype_id']."' ");
	$arr['stock_subtype'] = $db->fetch($res['stock_subtype']);
	//empty($arr['stock_subtype']['subtype_name'])?$subtype_name="ทั่วไป":$subtype_name="".$arr['stock_subtype']['subtype_name']."" ;
	
    if($count%2==0) { //ส่วนของการ สลับสี 
      $ColorFill = "#FDEAFB";
    } else {
      $ColorFill = "#F0F0F0";
    }
//    $res['stock_head_section'] = $db->select_query("SELECT shb_id ,section_id FROM ".TB_STOCK_HEAD_SECTION." WHERE sh_id='".$arr['stock_head']['sh_id']."' AND section_id='".$_POST['section_id']."'");
//	$arr['stock_head_section'] = $db->fetch($res['stock_head_section']);
    $res['Check_center'] = $db->select_query("SELECT shc_id FROM ".TB_STOCK_HEAD_CENTER." WHERE sh_id='".$arr['stock_head']['sh_id']."'");
	$rows['Check_center'] = $db->rows($res['Check_center']);
    $arr['Check_center'] = $db->fetch($res['Check_center']);	
    $res['Check_section'] = $db->select_query("SELECT shs_id FROM ".TB_STOCK_HEAD_SECTION." WHERE sh_id='".$arr['stock_head']['sh_id']."'");
	$rows['Check_section'] = $db->rows($res['Check_section']);
    $arr['Check_section'] = $db->fetch($res['Check_section']);	
	//$db->closedb ();	
?>
    <tr bgcolor="<?php echo $ColorFill; ?>" onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='<?php echo $ColorFill;?>' " height="18">
	 <td align="center"><?php echo $arr['stock_head']['sh_code_id'];?></td>
     <td>
<?php
		if($rows['Check_center'] and $rows['Check_section']){
		$Check_center = "<font color='#0000FF'><b>มีแล้ว</b></font>";	
		$Check_section = "<font color='#0000FF'><b>มีแล้ว</b></font>";
?>	 
	 <A HREF="?compu=wsd&loc=material_central&op=addold_material&data=<?php echo $arr['Check_center']['shc_id'];?>">
	 <b><?php echo $arr['stock_head']['sh_name'];?><?php echo $shc_diff_name; ?></b></A>
<?php
        } else if(!$rows['Check_center'] and $rows['Check_section']){
		$Check_center = "<font color='#FF0000'><b>ยังไม่มี</b></font>";		
		$Check_section = "<font color='#0000FF'><b>มีแล้ว</b></font>";  //คลิกเพื่อดูบัญชีวัสดุ
?>
	 <A HREF="?compu=wsd&loc=material_central&op=old_material&data=<?php echo $arr['stock_head']['sh_id'];?>">
	 <b><?php echo $arr['stock_head']['sh_name'];?><?php echo $shc_diff_name; ?></b></A>
<?php
       } else if($rows['Check_center'] and !$rows['Check_section']){
		$Check_center = "<font color='#0000FF'><b>มีแล้ว</b></font>";		
		$Check_section = "<font color='#FF0000'><b>ยังไม่มี</b></font>";
?>
	 <A HREF="?compu=wsd&loc=material_central&op=addold_material&data=<?php echo $arr['Check_center']['shc_id'];?>">
	 <b><?php echo $arr['stock_head']['sh_name'];?><?php echo $shc_diff_name; ?></b></A>
<?php
       } else if(!$rows['Check_center'] and !$rows['Check_section']){
		$Check_center = "<font color='#FF0000'><b>ยังไม่มี</b></font>";		
		$Check_section = "<font color='#FF0000'><b>ยังไม่มี</b></font>";
?>
	 <A HREF="?compu=wsd&loc=material_central&op=old_material&data=<?php echo $arr['stock_head']['sh_id'];?>">
	 <b><?php echo $arr['stock_head']['sh_name'];?><?php echo $shc_diff_name; ?></b></A>
<?php
       }
?>	 
	 </td>
     <td align="center"><?php echo $arr['stock_type']['type_name'] ;?></td>
	 <td align="center"><?php echo $arr['stock_subtype']['subtype_name'] ;?></td>
     <td align="center"><?php echo $arr['stock_head']['sh_unit'] ;?></td>
	 <td align="center"><?php echo $Check_center ;?></td>
	 <td align="center"><?php echo $Check_section  ;?></td>
    </tr>
	<TR>
		<TD colspan="7" height="1" class="dotline"></TD>
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
    echo "<br><br><a href=\"?compu=wsd&loc=material_central&op=new_material&data=voi\" ><img src=\"images/wsd/add_new_material.png\" alt=\"เพิ่มวัสดุตัวใหม่\" align=\"middle\" border=\"0\" width=\"176\" height=\"23\" /></a>" ; 
}
} else if($op == "old_material" and $action == "add" and $data != "") {   //เพิ่มข้อมูล op = old_material
	
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	//ตรวจสอบมี user นี้หรือยัง
    empty($_POST['shc_diff_name'])?$shc_diff_name="":$shc_diff_name=$_POST['shc_diff_name'];	
	empty($_POST['shc_keep'])?$shc_keep="":$shc_keep=$_POST['shc_keep'];	
	empty($_POST['shc_high'])?$shc_high="":$shc_high=$_POST['shc_high'];	
	empty($_POST['shc_low'])?$shc_low="":$shc_low=$_POST['shc_low'];	
	empty($_POST['acc_number'])?$acc_number="":$acc_number=$_POST['acc_number'];	
	empty($_POST['shp_diff_name_1'])?$shp_diff_name_1="":$shp_diff_name_1=$_POST['shp_diff_name_1'];	

	$res['stock_head'] = $db->select_query("SELECT shc_id FROM ".TB_STOCK_HEAD_CENTER." WHERE sh_id='".$_POST['sh_id']."'");
	$rows['stock_head'] = $db->rows($res['stock_head']); 
	//$db->closedb ();
		if($rows['stock_head']){
		    echo "<script language='javascript'>" ;
		    echo "alert('ต้องขออภัยชื่อหรือชนิดวัสดุ :   มีในระบบแล้วไม่สามารถเพิ่มได้' )" ;
		    echo "</script>" ;
		    echo "<script language='javascript'>javascript:history.go(-1)</script>";
		    exit();	
			$check_psd = false ;
		} else {
			$check_psd = true ;
   
			    // if(($_POST['sd_pricecost_1']/$_POST['sc_amountcost_1']) == $_POST['sc_price_1'] ) { //เช็ค ราคาคงเหลือ (หาร) จำนวนคงเหลือ   เท่ากับ  ราคาต่อหน่อยหรือป่าว	
			    //   $check_psd = true ;
			    //   } else {
			    //   $check_psd = false ;
			    //   }
				$sc_amountcost =  $_POST['sc_amount_1'] ;
                //$sd_pricecost  =  $_POST['sc_price_1']*$_POST['sc_amount_1'] ;
  		 if($check_psd) {	
   
            $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

			empty($_POST['sh_id'])?$sh_id="":$sh_id=$_POST['sh_id'] ;	
	
			$db->add_db(TB_STOCK_HEAD_CENTER,array(
			    "sh_id"=>"".$sh_id."",
				"shc_diff_name"=>"".$shc_diff_name."",
				"shc_keep"=>"".$shc_keep."",
				"shc_high"=>"".$shc_high."",
				"shc_low"=>"".$shc_low."",
				"acc_number"=>"".$acc_number.""
			));

			$check_shc_id=mysql_query("select shc_id  from ".TB_STOCK_HEAD_CENTER." ORDER BY shc_id  DESC");
		    list($shc_id)=mysql_fetch_row($check_shc_id);
			empty($shc_id)?$shc_id="":$shc_id=$shc_id ;
			$sc_requistion = 0 ;	
            $sc_deega = "" ;
            $section_id = 0 ;			
			
                 
                if( $_POST['sc_logic_1'] == '1' ) {
	                $res['shop'] = $db->select_query("SELECT shop_name FROM ".TB_SHOP." WHERE shop_name ='".$_POST['sc_name_1']."'");
	                $rows['shop'] = $db->rows($res['shop']);                     
					if(!$rows['shop']){
					    $db->add_db(TB_SHOP,array(
				        "shop_name"=>"".$_POST['sc_name_1'].""
			            ));	
                    }					
                }				
	            	
                //$db->add_db(TB_STOCK_HEAD_PRICE,array(
				//"shf_amountcost"=>"".$_POST['sc_amount_1']."",
				//"shf_price"=>"".$_POST['sc_price_1']."",
				//"shc_diff_name"=>"".$shc_diff_name_1."",
				//"shb_id"=>"".$shb_id.""				
	            //));	
				
			    //$check_shf_id=mysql_query("select shf_id  from ".TB_STOCK_HEAD_PRICE." ORDER BY shf_id  DESC");
		        //list($shf_id)=mysql_fetch_row($check_shf_id);
			    //empty($shf_id)?$shf_id="":$shf_id=$shf_id ;				

                $db->add_db(TB_STOCK_CENTER,array(
				"shc_id"=>"".$shc_id."",
				"sc_date"=>"".$_POST['sh_date_1']."",
				"sc_name"=>"".$_POST['sc_name_1']."",
				"sc_ref"=>"".$_POST['sc_ref_1']."",
				"sc_price"=>"".$_POST['sc_price_1']."",
				"sc_amount"=>"".$_POST['sc_amount_1']."",
				"sc_amountcost"=>"".$sc_amountcost."",
				"sc_deega"=>"".$sc_deega."",
				"sc_note"=>"".$_POST['sc_note_1']."",				
				"sc_logic"=>"".$_POST['sc_logic_1']."",								
				"sc_requistion"=>"".$sc_requistion."",												
				"shp_diff_name"=>"".$shp_diff_name_1.""
			    ));					

			    $db->update_db(TB_STOCK_DATA,array(
				"acc_number"=>"".$_POST['acc_number'].""
				)," section_id='".$section_id."'");
				
			//$db->closedb ();
			$ProcessOutput  = "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?compu=admin&loc=main\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการบันทึก  ชื่อวัสดุ : ".$_POST['sc_name_1']." เป็นที่เรียบร้อย</B></FONT><BR><BR>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
            echo "<script type='text/javascript'>window.location.href = \"index.php?compu=wsd&loc=material_central&op=addold_material&data=".$shc_id."\";</script>" ;
		    } else {
            echo "<FONT COLOR=\"#336600\"><B>ยังมีรายการยังไม่ลงตัว</B></FONT><BR><BR>";
			echo "<A HREF=\"javascript:history.go(-1);\"><B>กลับไปเพิ่มชื่อหรือชนิดวัสดุใหม่</B></A>";
            echo $_POST['sc_amount_1']." และ  ".$_POST['sc_price_1']	;	
			}			
		}
	
} else  if($op == "old_material" and  $data != "") {
	
	//require_once("modules/wsd/function.php");
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		
		$res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE sh_id='$data'");
	    $arr['stock_head'] = $db->fetch($res['stock_head']);

	    $res['stock_data'] = $db->select_query("SELECT acc_number FROM ".TB_STOCK_DATA." WHERE section_id='0'");
		$arr['stock_data'] = $db->fetch($res['stock_data']);
		$acc_number = $arr['stock_data']['acc_number'] + 1 ;		
?>
<link href="modules/wsd/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript"  src="js/calender.js"></script>
<script language="javascript" type="text/javascript">
/***
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

//window.onLoad=dochange('stock_type', -1);
 
    
function dochange_unit() {
	    if (document.frmMain.sh_unit.value == "") {
        document.getElementById("unit").innerHTML="<input type=\"text\" name=\"sh_unit_new\" id=\"sh_unit_new\" size=\"18\" value=\"\" >" ;		
		} else {
        document.getElementById("unit").innerHTML="<input type=\"text\" size=\"18\" disabled=\"disabled\" >" ;
		}
    }
***/
	
function  been_paid_open(line)
   {
//  alert(form.sh_unit.value);
     var sc_logic = document.getElementById('sc_logic_'+line).value ;  
     //var section_id = document.getElementById('section_id').value ;  
     window.open('modules/wsd/been_paid_add_central.php?line='+line+'&sc_logic='+sc_logic+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=400,height=200,left=330,top=200');
   }  
   
function  diff_name_open(line)
   {
	 var shc_diff_name = document.frmMain.shc_diff_name.value ; 
      //alert(sh_id);	 
     window.open('modules/wsd/shc_diff_name_add.php?line='+line+'&shc_diff_name='+shc_diff_name+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=450,height=200,left=330,top=200');
   } 
   
/**function  price_open(line)
   {
	 var shb_id = document.getElementById('shb_id').value ;  
	 //var shb_id = document.frmMain_body.shb_id.value ; 
	 //alert("shb_id="+shb_id);
	 var shf_diff_name = document.getElementById("shf_diff_name_"+line).value ;	
     //alert(shf_diff_name);	 
     window.open('modules/admin/price_add.php?line='+line+'&shb_id='+shb_id+'&shf_diff_name='+shf_diff_name+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=400,height=200,left=330,top=200');
   } 
**/
   
function chkNum(ele)
{
var num = parseFloat(ele.value);
ele.value = num.toFixed(2);
}      
   
</script>
<div id="pCalendar" style="position: absolute; left: 10px; top: 10px; visibility: hidden;"></div>
<form NAME="frmMain" METHOD="post" ACTION="?compu=wsd&loc=material_central&op=old_material&action=add&data=voi" onSubmit="return check();" ENCTYPE="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">วัสดุที่ :<br><input type="text" size="5" style="text-align:center;" value="<?php echo $acc_number ;?>" disabled>
	<input type="hidden" name="acc_number" id="acc_number" size="5" style="text-align:center;" value="<?php echo $acc_number ;?>"></td>    
    <td align="center">รหัส :<br>&nbsp;&nbsp;
	<input type="text" name="sh_code_id" id="sh_code_id" value="<?php echo $arr['stock_head']['sh_code_id'] ;?>" size="10" disabled>
	<input type="hidden" name="sh_id" id="sh_id" value="<?php echo $arr['stock_head']['sh_id'];?>" >
	</td>
    <td height="30" align="center">ประเภท :<?php //echo $arr['stock_head']['type_id']; ?><br>
		<span id="stock_type">
			<SELECT NAME="type_id" ID="type_id" onChange="dochange('stock_subtype',this.value);" disabled>
<?php
				$res['stock_type'] = $db->select_query("SELECT * FROM ".TB_STOCK_TYPE." ORDER BY type_id");
				while($arr['stock_type'] = $db->fetch($res['stock_type'])) {
?>
				<OPTION value="<?php echo $arr['stock_type']['type_id'];?>" <?php if($arr['stock_head']['type_id'] == $arr['stock_type']['type_id']){ echo " selected" ; } ?>><?php echo $arr['stock_type']['type_name'];?></OPTION>
<?php } ?>
            </SELECT>
		</span>
	</td>	
    <td align="center">ประเภทย่อย :<br>
		<span id="stock_subtype">
			<SELECT NAME="subtype_id" ID="subtype_id" disabled>
<?php
				$res['stock_subtype'] = $db->select_query("SELECT * FROM ".TB_STOCK_SUBTYPE." WHERE type_id='".$arr['stock_head']['type_id']."' ORDER BY subtype_id");
				$rows['stock_subtype'] = $db->rows($res['stock_subtype']); 
				if(!$rows['stock_subtype']) {
				echo "<OPTION value='0' selected >ทั่วไป</OPTION>" ;
				} else {
				while($arr['stock_subtype'] = $db->fetch($res['stock_subtype'])) {
?>
			    <OPTION value="<?php echo $arr['stock_subtype']['subtype_id'];?>" <?php if($arr['stock_head']['subtype_id'] == $arr['stock_subtype']['subtype_id']){ echo " selected" ; } ?>><?php echo $arr['stock_subtype']['subtype_name'];?></OPTION>
<?php
						}
                        //if(!$subtype){
                        //echo "<OPTION value='0' selected >ทั่วไป</OPTION>" ;
						//}						
						}
?>
            </SELECT>
		</span>
	</td>	
    <td width="100" align="center">หน่วยงาน :
	   <input type="text" size="23" value="<?php echo WEB_AGEN_MINI.WEB_AGEN_NAME ;?>">
	</td> 
    <td align="center">ที่เก็บ :<br><input type="text" name="shc_keep" id="shc_keep" size="23"></td>	
  </tr>
  <tr><td colspan="6" height="10"></td></tr>
  <tr>
	<td  height="30" align="center" >ชื่อหรือชนิดวัสดุ :<br>
	<input type="text" size="30" maxlength="50" value="<?php echo $arr['stock_head']['sh_name'];?>" disabled>
	<input type="hidden" name="sh_name" id="sh_name" value="<?php echo $arr['stock_head']['sh_name'];?>">
	</td>
    <td align="center" colspan="2"><FONT COLOR="#FF0000"><B>*</B></FONT>ขนาดหรือลักษณะ : <br><input type="text" size="27" name="shc_diff_name" id="shc_diff_name" value=""></td>  
    <td align="center" colspan="2">หน่วยนับ :<br>
			<SELECT NAME="sh_unit" ID="sh_unit" onChange="dochange_unit();" disabled>
			    <OPTION value="">---ใหม่---</OPTION>
<?php
				$res['stock_unit'] = $db->select_query("SELECT * FROM ".TB_STOCK_UNIT." ORDER BY unit_id");
				while($arr['stock_unit'] = $db->fetch($res['stock_unit'])) {
?>
				<OPTION value="<?php echo $arr['stock_unit']['unit_name'];?>" <?php if($arr['stock_head']['sh_unit'] == $arr['stock_unit']['unit_name']){ echo " selected" ; $unitnew = true ;} ?>><?php echo $arr['stock_unit']['unit_name'];?></OPTION>
<?php } ?>
            </SELECT>
	<?php  if($unitnew) { ?>
	<font id="unit"><input type="text" name="sh_unit_new" id="sh_unit_new" size="18" value="" disabled></font>	
	<?php } else {  ?>
	<font id="unit"><input type="text" name="sh_unit_new" id="sh_unit_new" size="18" value="<?php echo $arr['stock_head']['sh_unit'] ;?>"></font>
	<?php } ?>	
    </td>
    <td height="30" align="center">จำนวนอย่าง :<br>สูง <input type="text" name="shc_high" id="shc_high" size="6" maxlength="6" style="text-align:center;" />&nbsp;&nbsp;ต่ำ 
    <input type="text" name="shc_low" id="shc_low" size="6" maxlength="6" style="text-align:center;"></td>	
  </tr>
</table><br>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=10%  valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  วัน เดือน ปี</span></p>
  </td>
  <td width=27% valign=top  style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  รับจาก/จ่ายให้</span></p>
  </td>
  <td width=12%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  เลขที่เอกสาร</span></p>
  </td>
  <td width=10%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ราคาต่อหน่วย</span></p>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ( บาท )</span></p>
  </td>
  <td width=7% valign=top  style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  รับ</span></p>
  </td>
  <td width=7% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  จ่าย</span></p>
  </td>
  <td width=7% valign=top  style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  คงเหลือ</span></p>
  </td>
  <td width=10%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  เลขฎีกา</span></p>
  </td>
  <td width=10%  valign=top  style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  หมายเหตุ</span></p>
  </td>  
 </tr>
 <tr style='mso-yfti-irow:2;height:17.35pt'>
  <td valign=top style='border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td valign=top  style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td valign=top  style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td valign=top  style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td valign=top  style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td valign=top  style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
 </tr>
</table><br>
<table id="tbExp" width="100%" border="0" cellspacing="2" cellpadding="1" align="center">
  <tr bgcolor="#AAAAAA" height="25">
    <td ><div align="center">วัน เดือน ปี</div></td>
    <td width="60"><div align="center">รับ/จ่าย</div></td>
	<td><div align="center">รายการ</div></td>
    <td><div align="center">ขนาด/ลักษณะ</div></td>
    <td><div align="center">ราคาต่อหน่วย</div></td>	
    <td><div align="center">จำนวน</div></td>
	<td><div align="center">หมายเหตุ</div></td>
  </tr>
  <tr>
    <td align="center" ><input name="tCalendar_1" type="text" id="tCalendar_1" size="11" value="" >&nbsp;<IMG SRC="images/dateselect.gif" BORDER="0" ALT="เลือกวันที่" onClick="showCalendar(this,1)" align="absmiddle">
	<br><input type="hidden" name="sh_date_1" id="sh_date_1" size="12" value=""></td>
    <td align="left">
	<select name="sc_logic_1" id="sc_logic_1" >
	<option value="1" selected>รับจาก</option>
	</select>
    </td>
	<td align="center">
	 <input type="text" name="sc_name_1" id="sc_name_1" size="25" value="">
	 <input  type="button" onClick="been_paid_open(1)" value="...">
	</td>
    <td align="center">
	<font id="disp_diff_name_1"><input type="text" size="24" disabled>
	<input type="hidden" name="shp_diff_name_1" id="shp_diff_name_1" value="">
	</font>
	<input  type="button" onClick="diff_name_open(1)" value="..."><br><br>
	 เลขที่เอกสาร :<input type="text" name="sc_ref_1" id="sc_ref_1" size="15" value="" >
    <td align="center">
	<FONT COLOR="#FF0000">ราคา</FONT>/หน่วย&nbsp;:<input type="text" name="sc_price_1" id="sc_price_1" size="9" style="text-align:center;" value="" OnChange="JavaScript:chkNum(this)">
	</td>
    <td align="center">
	จำนวน&nbsp;:<input type="text" name="sc_amount_1" id="sc_amount_1" size="9" style="text-align:center;" value="">
<!--	&nbsp;&nbsp;&nbsp;<FONT COLOR="#FF0000">ราคา</FONT>เหลือ&nbsp;:<input type="text" name="sd_pricecost_1" id="sd_pricecost_1" size="9" style="text-align:center;" value="" OnChange="JavaScript:chkNum(this)"><br><br>
	จำนวนเหลือ&nbsp;:<input type="text" name="sc_amountcost_1" id="sc_amountcost_1" size="9" style="text-align:center;" value="" > -->
	</td>	
	<td align="center">
	 
	<textarea name="sc_note_1" id="sc_note_1" cols="20" rows="3" value=""></textarea>
	</td>
  </tr> 
</table>
<br>
<center><input type="submit" name="submit" id="submit" value="บันทึกข้อมูลลงการ์ดบัญชีวัสดุ">
<br>&nbsp;
</td>
</tr>
</table>
</form>
<FONT COLOR="#FF0000" ALIGN="left"><B>*&nbsp;กรณีต้องการมีหลายขนาดหรือหลายลักษณะ&nbsp;ให้กำหนดที่แถวด้านล่าง</B></FONT>

<SCRIPT LANGUAGE="javascript">	
function check() {
if(document.frmMain.type_id.value==0) {
alert("กรุณาเลือก  ประเภทวัสดุ  ด้วยครับ") ;
document.frmMain.type_id.focus() ;
return false ;
}
if(document.frmMain.subtype_id.value==0) {
alert("กรุณาเลือก  ประเภทย่อยวัสดุ  ด้วยครับ") ;
document.frmMain.subtype_id.focus() ;
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
if(document.frmMain.sc_price_1.value=="") {
alert("กรุณากรอก  ราคาต่อหน่วย  ด้วยครับ") ;
document.frmMain.sc_price_1.focus() ;
return false ;
}
if(document.frmMain.sc_amount_1.value=="") {
alert("กรุณากรอก  จำนวน  ด้วยครับ") ;
document.frmMain.sc_amount_1.focus() ;
return false ;
}
else 
return true ;
}		

dtNow = new Date();
makeCalendar(dtNow.getMonth(), dtNow.getFullYear());

</SCRIPT>	
	
<?php	
} else if($op == "new_material" and $action == "add" and $data != "") { //เพิ่มข้อมูล op = new_material
	
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	//ตรวจสอบมี user นี้หรือยัง
    empty($_POST['sh_unit'])?$sh_unit=$_POST['sh_unit_new']:$sh_unit=$_POST['sh_unit'];
    empty($_POST['subtype_id'])?$subtype_id="":$subtype_id=$_POST['subtype_id'];
    empty($_POST['shc_diff_name'])?$shc_diff_name="":$shc_diff_name=$_POST['shc_diff_name'];	
	empty($_POST['shc_keep'])?$shc_keep="":$shc_keep=$_POST['shc_keep'];	
	empty($_POST['shc_high'])?$shc_high="":$shc_high=$_POST['shc_high'];	
	empty($_POST['shc_low'])?$shc_low="":$shc_low=$_POST['shc_low'];	
	empty($_POST['acc_number'])?$acc_number="":$acc_number=$_POST['acc_number'];	
	empty($_POST['shp_diff_name_1'])?$shp_diff_name_1="":$shp_diff_name_1=$_POST['shp_diff_name_1'];	

	$res['stock_head'] = $db->select_query("SELECT sh_id FROM ".TB_STOCK_HEAD." WHERE sh_name='".$_POST['sh_name']."' AND sh_unit='".$sh_unit."' AND type_id='".$_POST['type_id']."'");
	$rows['stock_head'] = $db->rows($res['stock_head']); 
	//$db->closedb ();
		if($rows['stock_head']){
		    echo "<script language='javascript'>" ;
		    echo "alert('ต้องขออภัยชื่อหรือชนิดวัสดุ :   มีในระบบแล้วไม่สามารถเพิ่มได้' )" ;
		    echo "</script>" ;
		    echo "<script language='javascript'>javascript:history.go(-1)</script>";
		    exit();	
			$check_psd = false ;
		} else {
			$check_psd = true ;
   
			    // if(($_POST['sd_pricecost_1']/$_POST['sc_amountcost_1']) == $_POST['sc_price_1'] ) { //เช็ค ราคาคงเหลือ (หาร) จำนวนคงเหลือ   เท่ากับ  ราคาต่อหน่อยหรือป่าว	
			    //   $check_psd = true ;
			    //   } else {
			    //  $check_psd = false ;
			    //   }
            $sc_amountcost =  $_POST['sc_amount_1'] ;
            //$sd_pricecost  =  $_POST['sc_price_1']*$_POST['sc_amount_1'] ; 
  		 if($check_psd){	
   
            $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
            
            $db->add_db(TB_STOCK_HEAD,array(
				"sh_code_id"=>"".$_POST['sh_code_id']."",
				"type_id"=>"".$_POST['type_id']."",
				"subtype_id"=>"".$subtype_id."",
				"sh_name"=>"".$_POST['sh_name']."",
				"sh_unit"=>"".$sh_unit.""
			));
			
			$check_sh_id=mysql_query("select sh_id  from ".TB_STOCK_HEAD." ORDER BY sh_id  DESC");
		    list($sh_id)=mysql_fetch_row($check_sh_id);
			empty($sh_id)?$sh_id="":$sh_id=$sh_id ;	
	
	//$res['stock_id'] = $db->select_query("SELECT sh_id FROM ".TB_STOCK_HEAD." WHERE sh_code_id='".$_POST['sh_code_id']."' AND type_id='".$_POST['type_id']."' AND subtype_id='".$_POST['subtype_id']."' AND sh_name='".$_POST['sh_name']."' AND sh_unit='".$sh_unit."'");
	//$rows['stock_id'] = $db->rows($res['stock_id']);
    //        if($rows['stock_head']){
    //           $arr['stock_id'] = $db->fetch($res['stock_id']);	
	//		   $sh_id = $arr['stock_id']['sh_id'] ;
	           //echo $sh_id ;

			$db->add_db(TB_STOCK_HEAD_CENTER,array(
			    "sh_id"=>"".$sh_id."",
				"shc_diff_name"=>"".$shc_diff_name."",
				"shc_keep"=>"".$shc_keep."",
				"shc_high"=>"".$shc_high."",
				"shc_low"=>"".$shc_low."",
				"acc_number"=>"".$acc_number.""
			));

			$check_shc_id=mysql_query("select shc_id  from ".TB_STOCK_HEAD_CENTER." ORDER BY shc_id  DESC");
		    list($shc_id)=mysql_fetch_row($check_shc_id);
			empty($shc_id)?$shc_id="":$shc_id=$shc_id ;
			$sc_requistion = 0 ;
            $sc_deega = "" ;			
			$section_id = 0 ;
                 
                if( $_POST['sc_logic_1'] == '1' ) {
	                $res['shop'] = $db->select_query("SELECT shop_name FROM ".TB_SHOP." WHERE shop_name ='".$_POST['sc_name_1']."'");
	                $rows['shop'] = $db->rows($res['shop']);                     
					if(!$rows['shop']){
					    $db->add_db(TB_SHOP,array(
				        "shop_name"=>"".$_POST['sc_name_1'].""
			            ));	
                    }					
                }				
	            	
                //$db->add_db(TB_STOCK_HEAD_PRICE,array(
				//"shf_amountcost"=>"".$_POST['sc_amount_1']."",
				//"shf_price"=>"".$_POST['sc_price_1']."",
				//"shf_diff_name"=>"".$shc_diff_name_1."",
				//"shb_id"=>"".$shb_id.""				
	            //));	
				
			    //$check_shf_id=mysql_query("select shf_id  from ".TB_STOCK_HEAD_PRICE." ORDER BY shf_id  DESC");
		        //list($shf_id)=mysql_fetch_row($check_shf_id);
			    //empty($shf_id)?$shf_id="":$shf_id=$shf_id ;				

                $db->add_db(TB_STOCK_CENTER,array(
				"shc_id"=>"".$shc_id."",
				"sc_date"=>"".$_POST['sh_date_1']."",
				"sc_name"=>"".$_POST['sc_name_1']."",
				"sc_ref"=>"".$_POST['sc_ref_1']."",
				"sc_price"=>"".$_POST['sc_price_1']."",
				"sc_amount"=>"".$_POST['sc_amount_1']."",
				"sc_amountcost"=>"".$sc_amountcost."",
				"sc_deega"=>"".$sc_deega."",
				"sc_note"=>"".$_POST['sc_note_1']."",				
				"sc_logic"=>"".$_POST['sc_logic_1']."",								
				"sc_requistion"=>"".$sc_requistion."",
                "shp_diff_name"=>"".$shp_diff_name_1.""				
			    ));					

			    $db->update_db(TB_STOCK_DATA,array(
				"acc_number"=>"".$_POST['acc_number'].""
				)," section_id='".$section_id."'");

				
			//$db->closedb ();
			$ProcessOutput  = "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?compu=admin&loc=main\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการบันทึก  ชื่อวัสดุ : ".$_POST['sc_name_1']." เป็นที่เรียบร้อย</B></FONT><BR><BR>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
            echo "<script type='text/javascript'>window.location.href = \"index.php?compu=wsd&loc=material_central&op=addold_material&data=".$shc_id."\";</script>" ;
		    } else {
            $ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ยังมีรายการยังไม่ลงตัว</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"javascript:history.go(-1);\"><B>กลับไปเพิ่มชื่อหรือชนิดวัสดุใหม่</B></A>";
             	//echo $amount." และ  ".$price	;	
			}			
		}
	
} else if(!$ProcessOutput and $op == "new_material" and $data == "voi" ) {	
	require_once("modules/wsd/function.php");
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	
	    $res['stock_data'] = $db->select_query("SELECT acc_number FROM ".TB_STOCK_DATA." WHERE section_id='0'");
		$arr['stock_data'] = $db->fetch($res['stock_data']);
		$acc_number = $arr['stock_data']['acc_number'] + 1 ;
		
		$check_code_id=mysql_query("select sh_code_id  from ".TB_STOCK_HEAD." ORDER BY sh_id  DESC");
		list($code_id)=mysql_fetch_row($check_code_id);
		
		$code=checkProductCode($code_id);	
        //$strSQL = "SELECT * FROM web_stock_unit ORDER BY unit_name ";
        //$objQuery = mysql_query($strSQL);


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
     req.open("GET", "modules/wsd/stocktype.php?data="+src+"&val="+val+"&random="+random , true); //สร้าง connection
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

function  been_paid_open(line)
   {
  //alert(form.sh_unit.value);
     var sc_logic = document.getElementById('sc_logic_'+line).value ;  
     //var section_id = document.getElementById('section_id').value ;  
     window.open('modules/wsd/been_paid_add_central.php?line='+line+'&sc_logic='+sc_logic+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=400,height=200,left=330,top=200');
   }  
   
function  diff_name_open(line)
   {
	 var shc_diff_name = document.frmMain.shc_diff_name.value ; 
      //alert(sh_id);	 
     window.open('modules/wsd/shc_diff_name_add.php?line='+line+'&shc_diff_name='+shc_diff_name+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=450,height=200,left=330,top=200');
   } 
function chkNum(ele)
{
var num = parseFloat(ele.value);
ele.value = num.toFixed(2);
}      
</script>
<div id="pCalendar" style="position: absolute; left: 10px; top: 10px; visibility: hidden;"></div>
<form NAME="frmMain" METHOD="post" ACTION="?compu=wsd&loc=material_central&op=new_material&action=add&data=voi" onSubmit="return check();" ENCTYPE="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">วัสดุที่ :<br><input type="text" size="5" style="text-align:center;" value="<?php echo $acc_number ;?>" disabled>
	<input type="hidden" name="acc_number" id="acc_number" value="<?php echo $acc_number ;?>"></td>  
    <td align="center">รหัส :<br>&nbsp;&nbsp;<input type="text" name="sh_code_id" id="sh_code_id" value="<?php echo $code ;?>" size="10" disabled>
	<input type="hidden" name="sh_code_id" id="sh_code_id" value="<?php echo $code ;?>"></td>
    <td height="30" align="center">ประเภท :<br><font id="stock_type"><select><option value="0">-------------------</option></select></font></td>	
    <td align="center">ประเภทย่อย :<br><font id="stock_subtype"><select><option value="0">-------------------</option></select></font></td>	
    <td width="100" align="center">หน่วยงาน :
	<input type="text" size="23" value="<?php echo WEB_AGEN_MINI.WEB_AGEN_NAME ;?>">
	</td> 
    <td align="center">ที่เก็บ :<br><input type="text" name="shc_keep" id="shc_keep" size="23"></td>	
  </tr>
  <tr><td colspan="6" height="10"></td></tr>
  <tr>
	<td  height="30" align="center" colspan="2">ชื่อหรือชนิดวัสดุ :<br><input type="text" name="sh_name" id="sh_name" size="30" maxlength="50"></td>
    <td align="center"><FONT COLOR="#FF0000"><B>*</B></FONT>ขนาดหรือลักษณะ : <br><input type="text" size="27" name="shc_diff_name" id="shc_diff_name" value=""></td>  
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
    <td height="30" align="center">จำนวนอย่าง :<br>สูง <input type="text" name="shc_high" id="shc_high" size="6" maxlength="6" style="text-align:center;" />&nbsp;&nbsp;ต่ำ 
    <input type="text" name="shc_low" id="shc_low" size="6" maxlength="6" style="text-align:center;"></td>	
  </tr>
</table><br>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=10%  valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  วัน เดือน ปี</span></p>
  </td>
  <td width=27% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  รับจาก/จ่ายให้</span></p>
  </td>
  <td width=12%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  เลขที่เอกสาร</span></p>
  </td>
  <td width=10%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ราคาต่อหน่วย</span></p>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ( บาท )</span></p>
  </td>
  <td width=7% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  รับ</span></p>
  </td>
  <td width=7% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  จ่าย</span></p>
  </td>
  <td width=7% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  คงเหลือ</span></p>
  </td>
  <td width=10%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  เลขฎีกา</span></p>
  </td>
  <td width=10%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  หมายเหตุ</span></p>
  </td>  
 </tr>
 <tr style='mso-yfti-irow:2;height:17.35pt'>
  <td valign=top style='border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
 </tr>
</table><br>
<table id="tbExp" width="100%" border="0" cellspacing="2" cellpadding="1" align="center">
  <tr bgcolor="#AAAAAA" height="25">
    <td ><div align="center">วัน เดือน ปี</div></td>
    <td width="60"><div align="center">รับ/จ่าย</div></td>
	<td><div align="center">รายการ</div></td>
    <td><div align="center">ขนาด/ลักษณะ</div></td>
    <td><div align="center">ราคาต่อหน่วย</div></td>	
    <td><div align="center">จำนวน</div></td>
	<td><div align="center">หมายเหตุ</div></td>
  </tr>
  <tr>
    <td align="center" ><input name="tCalendar_1" type="text" id="tCalendar_1" size="11" value="" >&nbsp;<IMG SRC="images/dateselect.gif" BORDER="0" ALT="เลือกวันที่" onClick="showCalendar(this,1)" align="absmiddle">
	<br><input type="hidden" name="sh_date_1" id="sh_date_1" size="12" value=""></td>
    <td align="left">
	<select name="sc_logic_1" id="sc_logic_1" >
<!--	<option value="0" >จ่ายให้</option>  -->
	<option value="1" selected>รับจาก</option>
	</select>
    </td>
	<td align="center">
	 <input type="text" name="sc_name_1" id="sc_name_1" size="25" value="">
	 <input  type="button" onClick="been_paid_open(1)" value="...">
	</td>
    <td align="center">
	<font id="disp_diff_name_1"><input type="text" name="shp_diff_name_1" id="shp_diff_name_1" size="24" value="" disabled></font>
	<input  type="button" onClick="diff_name_open(1)" value="..."><br><br>
	 เลขที่เอกสาร :<input type="text" name="sc_ref_1" id="sc_ref_1" size="15" value="" >
	</td>
    <td align="center">
	<FONT COLOR="#FF0000">ราคา</FONT>/หน่วย&nbsp;:<input type="text" name="sc_price_1" id="sc_price_1" size="9" style="text-align:center;" value="" OnChange="JavaScript:chkNum(this)">
	</td>
    <td align="center">
	จำนวน&nbsp;:<input type="text" name="sc_amount_1" id="sc_amount_1" size="9" style="text-align:center;" value="">
	</td>	
	<td align="center">
	 
	<textarea name="sc_note_1" cols="20" rows="3"></textarea>
	</td>
  </tr> 
</table>
<br>
<center><input type="submit" name="submit" id="submit" value="บันทึกข้อมูลลงการ์ดบัญชีวัสดุ">
<br>&nbsp;
</td>
</tr>
</table>
</form>
<FONT COLOR="#FF0000" ALIGN="left"><B>*&nbsp;กรณีต้องการมีหลายขนาดหรือหลายลักษณะ&nbsp;ให้กำหนดที่แถวด้านล่าง</B></FONT>

<SCRIPT LANGUAGE="javascript">	
function check() {
if(document.frmMain.type_id.value==0) {
alert("กรุณาเลือก  ประเภทวัสดุ  ด้วยครับ") ;
document.frmMain.type_id.focus() ;
return false ;
}
if(document.frmMain.subtype_id.value==0) {
alert("กรุณาเลือก  ประเภทย่อยวัสดุ  ด้วยครับ") ;
document.frmMain.subtype_id.focus() ;
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
if(document.frmMain.sc_price_1.value=="") {
alert("กรุณากรอก  ราคาต่อหน่วย  ด้วยครับ") ;
document.frmMain.sc_price_1.focus() ;
return false ;
}
if(document.frmMain.sc_amount_1.value=="") {
alert("กรุณากรอก  จำนวน  ด้วยครับ") ;
document.frmMain.sc_amount_1.focus() ;
return false ;
}
else 
return true ;
}		

dtNow = new Date();
makeCalendar(dtNow.getMonth(), dtNow.getFullYear());

</SCRIPT>	
<?php	
}  else if($op == "addold_material" and $action == "add" and $data != "" ) { //เพิ่มข้อมูล op = addold_material
            $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
				
			    if($_POST['sc_logic_1'] == "1") {	///// รับจาก /////

                   $sc_requistion = 0 ;
				   $sc_deega = "" ;
				   
                   //$res['stock_head_from'] = $db->select_query("SELECT shb_id, sum(shf_amountcost) as amount, sum(shf_price*shf_amountcost) as price  FROM ".TB_STOCK_HEAD_PRICE." WHERE shb_id='".$_POST['shb_id']."' GROUP BY shb_id ");
                   //$arr['stock_head_from'] = $db->fetch($res['stock_head_from']) ;
		           //$arr['stock_head_rows'] = $db->rows($res['stock_head_from']) ;
         
		            //if($arr['stock_head_rows']) {	
                    //$amountcost =  $arr['stock_head_from']['amount'] ;	 
		            //$pricecost =  $arr['stock_head_from']['price'] ;
		            //} else {
		            //$amountcost =  0 ;	 
		            //$pricecost  =  0 ;
		            //}
		
		    $amountcost = $_POST['sc_amount_1'] ;
			//$pricecost = $pricecost + ($_POST['sc_price_1']*$_POST['sc_amount_1']);

                if( $_POST['sc_name_1'] <> "" ) {
	                $res['shop'] = $db->select_query("SELECT shop_name FROM ".TB_SHOP." WHERE shop_name ='".$_POST['sc_name_1']."'");
	                $rows['shop'] = $db->rows($res['shop']);                     
					if(!$rows['shop']){
					    $db->add_db(TB_SHOP,array(
				        "shop_name"=>"".$_POST['sc_name_1'].""
			            ));	
                    }					
                }						
				
			    $check_sc_id=mysql_query("select sc_amountcost  from ".TB_STOCK_CENTER." ORDER BY sc_id  DESC");
		        list($sc_amountcost)=mysql_fetch_row($check_sc_id);
			    empty($sc_amountcost)?$amountcost="":$amountcost=$sc_amountcost ;
                $Vamountcost = $amountcost + $_POST['sc_amount_1'];			
				
                $db->add_db(TB_STOCK_CENTER,array(
				"shc_id"=>"".$_POST['shc_id']."",
				"sc_date"=>"".$_POST['sh_date_1']."",
				"sc_name"=>"".$_POST['sc_name_1']."",
				"sc_ref"=>"".$_POST['sc_ref_1']."",
				"sc_price"=>"".$_POST['sc_price_1']."",
				"sc_amount"=>"".$_POST['sc_amount_1']."",
				"sc_amountcost"=>"".$Vamountcost."",
				"sc_deega"=>"".$sc_deega."",
				"sc_note"=>"".$_POST['sc_note_1']."",				
				"sc_logic"=>"".$_POST['sc_logic_1']."",
                "sc_requistion"=>"".$sc_requistion."",				
				"shp_diff_name"=>"".$shp_diff_name_1.""
		     	));				
}
			//$db->closedb ();
            echo "<script type='text/javascript'>window.location.href = \"index.php?compu=wsd&loc=material_central&op=addold_material&data=".$_POST['shc_id']."\";</script>" ;
            break;
//***/
} else  if($op == "addold_material" and $data != "") {                 
//	require_once("modules/wsd/function.php");
	
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['stock_head_center'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD_CENTER." WHERE shc_id=".$data."");
		$arr['stock_head_center'] = $db->fetch($res['stock_head_center']);
		$res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE sh_id=".$arr['stock_head_center']['sh_id']."");
		$arr['stock_head'] = $db->fetch($res['stock_head']);

//	if($arr['stock_head_center']['section_id'] == 0 ) {
//	  $section_name = $agen_mini.$agen_name ;
//	  $Vsection_id = $arr['stock_head_center']['section_id'] ;
//	} else {
//	  $res['section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." WHERE section_id=".$arr['stock_head_center']['section_id']."");
//	  $arr['section'] = $db->fetch($res['section']);
//	  $section_name = $arr['section']['section_name'] ;
//	  $Vsection_id = $arr['stock_head_center']['section_id'] ;
//    }
	//echo "['stock_head_center']['section_id'] =".$arr['stock_head_center']['section_id']."<br>" ;
	//echo "Vsection_id =".$Vsection_id ;
?>
<link href="modules/wsd/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript"  src="js/calender.js"></script>
<script language="javascript" type="text/javascript">
/***
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
***/ 
function  been_paid_open(line)
   {
//  alert(form.sh_unit.value);
     var sc_logic = document.getElementById('sc_logic_'+line).value ;  
     //var section_id = document.getElementById('section_id').value ;  
     window.open('modules/wsd/been_paid_add_central.php?line='+line+'&sc_logic='+sc_logic+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=400,height=200,left=330,top=200');
   }   
 
function  diff_name_open(line)
   {
   	 //var shc_id = document.getElementById('shc_id').value ; 
	 var shc_diff_name = document.frmMain_body.shc_diff_name.value ; 
      //alert(sh_id);	 
     window.open('modules/wsd/shc_diff_name_add.php?line='+line+'&shc_diff_name='+shc_diff_name+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=450,height=200,left=330,top=200');
   } 
   
/***
function  price_open(line)
   {
	 var shc_id = document.getElementById('shc_id').value ;  
	 //var shc_id = document.frmMain_body.shc_id.value ; 
	 alert("shc_id="+shc_id);
	 var shf_diff_name = document.getElementById("shf_diff_name_"+line).value ;	
     alert("shf_diff_name="+shf_diff_name);	 
     window.open('modules/admin/price_add.php?line='+line+'&shc_id='+shc_id+'&shf_diff_name='+shf_diff_name+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=400,height=200,left=330,top=200');
   }    
***/   
function chkNum(ele)
{
var num = parseFloat(ele.value);
ele.value = num.toFixed(2);
} 
</script>
<div id="pCalendar" style="position: absolute; left: 10px; top: 10px; visibility: hidden;"></div>
<form name="frmMain_body" id="frmMain_body" method="post" action="?compu=wsd&loc=material_central&op=addold_material&action=add&data=voi" onSubmit="return check_body()" enctype="multipart/form-data">  
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td align="center">วัสดุที่ :<br><input type="text" size="5" style="text-align:center;" value="<?php echo $arr['stock_head_center']['acc_number'] ;?>" disabled></td>
    <td align="center">รหัส :<input type="hidden" name="shc_id" id="shc_id" value="<?php echo $arr['stock_head_center']['shc_id'] ;?>" />
	<br>&nbsp;&nbsp;<input type="text" name="sh_code_id" id="sh_code_id" value="<?php echo $arr['stock_head']['sh_code_id'] ;?>" size="10" disabled></td>
    <td height="30" align="center">ประเภท :<br>
						<span id="stock_type">
						<SELECT NAME="type_id" ID="type_id" disabled>
						<?php
						$res['stock_type'] = $db->select_query("SELECT * FROM ".TB_STOCK_TYPE." ORDER BY type_id");
						while($arr['stock_type'] = $db->fetch($res['stock_type'])) {
						?>
						<OPTION value=<?php echo $arr['stock_type']['type_id'];?><?php if($arr['stock_head']['type_id']=="".$arr['stock_type']['type_id'].""){ echo " selected" ; } ?>><?php echo $arr['stock_type']['type_name'];?></OPTION>
                        <?php } ?>
                        </SELECT>
						</span>
	</td>	    
	<td height="30" align="center">ประเภทย่อย :<br>
						<span id="stock_subtype_edit">
						<SELECT NAME="subtype_id" ID="subtype_id" disabled>
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
	<input type="text" size="23" value="<?php echo WEB_AGEN_MINI.WEB_AGEN_NAME ;?>" disabled>
	</td> 
    <td align="center">ที่เก็บ :<br><input type="text" name="shc_keep" id="shc_keep" size="23" value="<?php echo $arr['stock_head_center']['shc_keep'] ;?>"></td>	
</tr>
<tr><td colspan="6" height="10"></td></tr>
<tr>
	<td  height="30" align="center" colspan="2">ชื่อหรือชนิดวัสดุ :<br><input type="text" size="30" value="<?php echo $arr['stock_head']['sh_name'] ;?>" disabled></td>
    <td align="center">ขนาดหรือลักษณะ : <br><input type="text" name="shc_diff_name" id="shc_diff_name" size="27" value="<?php echo $arr['stock_head_center']['shc_diff_name'] ;?>" /></td>  
    <td align="center" colspan="2">หน่วยนับ :<br>
	
						<SELECT NAME="sh_unit" ID="sh_unit" onChange="dochange_unit();" disabled>
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
    <td height="30" align="center">จำนวนอย่าง :<br>สูง <input type="text" name="shc_high" id="shc_high" size="6" maxlength="6" value="<?php echo $arr['stock_head_center']['shc_high'] ;?>" style="text-align:center;"/>&nbsp;&nbsp;ต่ำ 
    <input type="text" name="shc_low" id="shc_low" size="6" maxlength="6" value="<?php echo $arr['stock_head_center']['shc_low'] ;?>" style="text-align:center;"></td>	
  </tr>
</table>
<br>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=10%  valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  วัน เดือน ปี</span></p>
  </td>
  <td width=27% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  รับจาก/จ่ายให้</span></p>
  </td>
  <td width=12%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  เลขที่เอกสาร</span></p>
  </td>
  <td width=10%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ราคาต่อหน่วย</span></p>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ( บาท )</span></p>
  </td>
  <td width=7% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  รับ</span></p>
  </td>
  <td width=7% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  จ่าย</span></p>
  </td>
  <td width=7% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  คงเหลือ</span></p>
  </td>
  <td width=10%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  เลขฎีกา</span></p>
  </td>
  <td width=10%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  หมายเหตุ</span></p>
  </td>  
 </tr>
 <?php
    $count = 0 ;
    $res['stock_center'] = $db->select_query("SELECT UNIX_TIMESTAMP(sc_date) AS st_date ,sc_date ,sc_name ,sc_ref ,sc_price ,sc_amount ,sc_amountcost ,sc_deega ,sc_note ,sc_logic ,shp_diff_name FROM ".TB_STOCK_CENTER." WHERE shc_id='".$data."' ORDER BY sc_id ");
	
	while($arr['stock_center'] = $db->fetch($res['stock_center'])) { ;
	if($arr['stock_center']['sc_logic'] == "0") {
	$get_amount = "-" ;
	//$get_price = "-" ;
	$put_amount = $arr['stock_center']['sc_amount'] ;
	//$put_price = $arr['stock_center']['sd_price']*$arr['stock_center']['sd_amount'] ;
    } else if($arr['stock_center']['sc_logic'] == "1") {    
	$get_amount = $arr['stock_center']['sc_amount'] ;
	//$get_price = $arr['stock_center']['sd_price']*$arr['stock_center']['sd_amount'] ;
	$put_amount = "-" ;
	//$put_price = "-" ;	
	}
	$count++ ;
 ?>
 <tr style='mso-yfti-irow:2;height:17.35pt'>
  <td valign=top style='border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo ThaiTimeConvert($arr['stock_center']['st_date'],"5",""); ?></span></p>
  <input type="hidden" name="sc_date_<?php echo $count ;?>" id="sc_date_<?php echo $count ;?>" value="<?php echo $arr['stock_center']['sc_date'] ;?>">
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_center']['sc_name'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_center']['sc_ref'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_center']['sc_price'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $get_amount ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $put_amount ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_center']['sc_amountcost'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_center']['sc_deega'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_center']['sc_note'] ;?><?php echo $arr['stock_center']['shp_diff_name'] ;?></span></p>
  </td>
 </tr>
 <?php } ?>
</table><br>


<table id="tbExp" width="100%" border="0" cellspacing="2" cellpadding="1" align="center">  
  <tr bgcolor="#AAAAAA" height="25">
    <td ><div align="center">วัน เดือน ปี</div></td>
    <td width="60"><div align="center">รับ/จ่าย</div></td>
	<td><div align="center">รายการ</div></td>
    <td><div align="center">ขนาด/ลักษณะ</div></td>
    <td><div align="center">ราคาต่อหน่วย</div></td>	
    <td><div align="center">จำนวน</div></td>
	<td><div align="center">หมายเหตุ</div></td>
  </tr>
  <tr>
    <td align="center" ><input name="tCalendar_1" type="text" id="tCalendar_1" size="11" value="" >&nbsp;<IMG SRC="images/dateselect.gif" BORDER="0" ALT="เลือกวันที่" onClick="showCalendar(this,1)" align="absmiddle">
	<br><input type="hidden" name="sh_date_1" id="sh_date_1" size="12" value=""></td>
    <td align="left">
	<select name="sc_logic_1" id="sc_logic_1" >
	<option value="1" selected>รับจาก</option>
	</select>
    </td>
	<td align="center">
	 <input type="text" name="sc_name_1" id="sc_name_1" size="25" value="">
	 <input  type="button" onClick="been_paid_open(1);" value="...">
	</td>
    <td align="center">
	<font id="disp_diff_name_1"><input type="text" size="24" value="" disabled>
	<input type="hidden" name="shp_diff_name_1" id="shp_diff_name_1" value=""></font>
	<input  type="button" onClick="diff_name_open(1)" value="..."><br><br>
	 เลขที่เอกสาร :<input type="text" name="sc_ref_1" id="sc_ref_1" size="15" value="" >
	</td>
    <td align="center">
	<FONT COLOR="#FF0000">ราคา</FONT>/หน่วย&nbsp;:<input type="text" name="sc_price_1" id="sc_price_1" size="9" style="text-align:center;" value="" OnChange="JavaScript:chkNum(this)">
	</td>
    <td align="center">
	จำนวน&nbsp;:<input type="text" name="sc_amount_1" id="sc_amount_1" size="9" style="text-align:center;" value="">
<!--	&nbsp;&nbsp;&nbsp;<FONT COLOR="#FF0000">ราคา</FONT>เหลือ&nbsp;:<input type="text" name="sd_pricecost_1" id="sd_pricecost_1" size="9" style="text-align:center;" value="" OnChange="JavaScript:chkNum(this)"><br><br>
	จำนวนเหลือ&nbsp;:<input type="text" name="sc_amountcost_1" id="sc_amountcost_1" size="9" style="text-align:center;" value="" > -->
	</td>	
	<td align="center">
	 
	<textarea name="sc_note_1" id="sc_note_1" cols="20" rows="3" value=""></textarea>
	</td>
  </tr> 
  <tr><td colspan="7"><br><center><input type="submit" name="submit" value="บันทึกรายการบัญชีวัสดุ" ></td></tr>  
</table>
</td>
</tr>
</table>
</form> 

<SCRIPT LANGUAGE="javascript">	
function check_body() {
	//alert(document.frmMain_body.sh_date_1.value) ;
	//alert(document.frmMain_body.sc_date_<?php echo $count ;?>.value) ;
if(document.frmMain_body.sh_date_1.value=="") {
alert("กรุณา  ลงวันที่  ด้วยครับ") ;
document.frmMain_body.tCalendar_1.focus() ;
return false ;
}	
if(document.frmMain_body.sh_date_1.value < document.frmMain_body.sc_date_<?php echo $count ;?>.value) {
alert("โปรดเลือกวันที่ มากกว่าหรือเท่า วันที่ล่าสุดด้วยครับ") ;
document.frmMain_body.tCalendar_1.focus() ;
return false ;
}	
if(document.frmMain_body.sc_name_1.value=="") {
alert("กรุณาใส่ ชื่อ  ด้วยครับ") ;
document.frmMain_body.sc_name_1.focus() ;
return false ;
}
//if(document.frmMain_body.shf_id.value=="") {
//alert("กรุณาเลือก  ราคาหรือ ขนาดลักษณะ  ด้วยครับ") ;
//document.frmMain_body.shf_id.focus() ;
//return false ;
//}
if(document.frmMain_body.sc_amount_1.value=="") {
alert("กรุณาใส่  จำนวน  ด้วยครับ") ;
document.frmMain_body.sc_amount_1.focus() ;
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

} else {
	echo $ProcessOutput ;
}	
$db->closedb ();
?>
				<BR><BR>
				</TD>
			</TR>
		</TABLE>
	</TD>
  </TR>
</TABLE>