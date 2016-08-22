<?php
Check_passadu($admin_user, $admin_level);
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
		  &nbsp;&nbsp;<IMG SRC="images/admin/texmenu_stock_start.gif" BORDER="0">->&nbsp;ตัดยอดยกมา ณ ปัจจุบัน  ส่วน/กอง<BR>
				<TABLE width="940" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD><IMG SRC="images/admin/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">
<?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  					
//////////////////////////////////////////// เพิ่มวัสดุเข้าใหม่  //////////////////////////////////////////////////////////////

if((!$ProcessOutput or $op == "search_name" or $op == "search_type") and $data == "") {

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
/***
function list(tagNext, val, txtCon) {  
    $.getJSON('modules/admin/combobox.php',{name:txtCon,value:val},function(data) {
		//alert(tagNext);
		//alert(val);
		//alert(txtCon);
        var select = $(tagNext);
        var options = select.attr('options');
        $('option', select).remove();
           $(select).append('<option value=""> - เลือก - </option>');
        $.each(data, function(index, array) {
                $(select).css("display","inline");
                 $(select).append('<option value="' + array[0] + '">' + array[1] + '</option>');
        });
    });
}
***/
</script>
<table width="100%" border="0" cellspacing="1" cellpadding="2">
    <tr>
      <td width="40%">
<form NAME="search_name" METHOD="post" ACTION="?compu=wsd&loc=present_section&op=search_name" onSubmit="return check_name()" ENCTYPE="multipart/form-data" >
	  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#DDDDDD">
        <tr>
        <td align="center" valign="middle"><br>
    ชื่อหรือชนิดวัสดุ :&nbsp;
	 <input type="text" size="28" value="" name="sh_name" id="sh_name" onkeyup="suggest(this.value);" onblur="fill();" class="" />
     <div class="suggestionsBox_search" id="suggestions" style="display: none;"><img src="images/wsd/arrow.png" style="position: relative; top: -12px; left: 40px;" alt="upArrow" />
     <div class="suggestionList_search" id="suggestionsList"></div>
     </div><br><br>   
<?php
	 if($section_id == 0 OR $admin_level == 2) {
	      $Vsection_id = 0 ;
	 } else {
	      $Vsection_id = $_SESSION['section_id'] ;
	 }
?>
    <input type="hidden" name="section_id" id="section_id" value="<?php echo $Vsection_id ;?>" />  	 	 
	<input type="submit" name="submit" id="submit" value="ค้นหาตามชื่อ" />
        </td>
        </tr>
      </table>
</form> 
      </td>
      <td width="60%">
<form NAME="search_type" METHOD="post" ACTION="?compu=wsd&loc=present_section&op=search_type" onSubmit="return check_type()" ENCTYPE="multipart/form-data" >
      <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#999999">
        <tr>
        <td align="center" height="35" valign="middle"><br>
          ประเภทวัสดุ :<span id="stock_type"><select><option value="0">-------------------</option></select></span>&nbsp;
          ย่อย :<span id="stock_subtype"><select><option value="0">-------------------</option></select></span><br><br> 
        <input type="hidden" name="section_id" id="section_id" value="<?php echo $Vsection_id ;?>" />		  
        <input type="submit" name="submit" id="submit" value="ค้นหาตามประเภท" />      
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
    echo "<br><a href=\"?compu=wsd&loc=present_section&op=new_material&data=voi\" ><img src=\"images/wsd/add_new_material.png\" alt=\"เพิ่มวัสดุตัวใหม่\" align=\"middle\" border=\"0\" width=\"176\" height=\"23\" /></a><br><br>" ; 

 if($op == "search_name" or $op == "search_type"){
	 empty($_POST["type_id"])?$typeid="":$typeid=$_POST["type_id"] ;
     empty($_POST["subtype_id"])?$subtypeid="":$subtypeid=$_POST["subtype_id"] ;

	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
?>
<script language="javascript" type="text/javascript">
function  print_acc_center_open(data) {
	window.open("modules/wsd/print_acc_center.php?shc_id="+data+"","","toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=999,height=830,left=5,top=5"); 
}	
function  print_acc_section_open(data) {
	//alert(data);
	//var shs_id = document.getElementById("section_"+data).value;
	var shs_id = data ;
	window.open("modules/wsd/print_acc_section.php?shs_id="+shs_id+"","","toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=999,height=830,left=5,top=5"); 
}
</script>
 <table width="100%" cellspacing="2" cellpadding="1" >
  <tr bgcolor="#0066FF" height="20">
   <td width="7%"><CENTER><font color="#FFFFFF"><B>รหัส</B></font></CENTER></td>
   <td width="28%"><CENTER><font color="#FFFFFF"><B>ชื่อหรือชนิดวัสดุ (ขนาดหรือลักษณะ)</B></font></CENTER></td>
   <td width="6%"><CENTER><font color="#FFFFFF"><B>หน่วยนับ</B></font></CENTER></td>
   <td width="14%"><CENTER><font color="#FFFFFF"><B>ประเภท</B></font></CENTER></td>
   <td width="14%"><CENTER><font color="#FFFFFF"><B>ย่อย</B></font></CENTER></td>
   <td width="10%"><CENTER><font color="#FFFFFF"><B>บัญชีวัสดุกลาง</B></font></CENTER></td>
   <td width="21%"><CENTER><font color="#FFFFFF"><B>บัญชีวัสดุ ส่วน/กอง</B></font></CENTER></td>
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
$num=1;
$count=0;
while($arr['stock_head'] = $db->fetch($res['stock_head'])){ 

    empty($arr['stock_head']['sh_diff_name'])?$sh_diff_name="":$sh_diff_name=" ( ".$arr['stock_head']['sh_diff_name']." )" ;
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
    $res['Check_center'] = $db->select_query("SELECT shc_id FROM ".TB_STOCK_HEAD_CENTER." WHERE sh_id='".$arr['stock_head']['sh_id']."'");
	$rows['Check_center'] = $db->rows($res['Check_center']);
    $arr['Check_center'] = $db->fetch($res['Check_center']);	
    $res['Check_section'] = $db->select_query("SELECT shs_id ,section_id FROM ".TB_STOCK_HEAD_SECTION." WHERE sh_id='".$arr['stock_head']['sh_id']."' ORDER BY section_id");
	$rows['Check_section'] = $db->rows($res['Check_section']);
?>
    <form name="frmMain" id="frmMain">
    <tr bgcolor="<?php echo $ColorFill; ?>" onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='<?php echo $ColorFill;?>' " height="18">
	 <td align="center"><?php echo $arr['stock_head']['sh_code_id'];?></td>
     <td>
<?php
		if($rows['Check_center'] and $rows['Check_section']){
		$Check_center = "<font color='#0000FF'>บัญชีกลาง</font>&nbsp;<input type='button' onClick='print_acc_center_open(".$arr['Check_center']['shc_id'].");' value='...'>";	
		$Check_section = "";
		while($arr['Check_section'] = $db->fetch($res['Check_section'])) {
		$res['sectionName'] = $db->select_query("SELECT section_id ,section_name FROM ".TB_MEMBER_SECTION." WHERE section_id='".$arr['Check_section']['section_id']."'");
        $arr['sectionName'] = $db->fetch($res['sectionName']);		
				 $count_str=mb_strlen($arr['sectionName']['section_name']);
				 if($count_str > 12){
					$arr_p['name']= mb_substr($arr['sectionName']['section_name'],0,12,"utf-8")."..."; 
				 }else{
					$arr_p['name']=$arr['sectionName']['section_name'];
				 }		
		$Check_section .= "<p>&nbsp;<input type=\"button\" onClick=\"window.location='?compu=wsd&loc=present_section&op=addold_material&data=".$arr['Check_section']['shs_id']."';\" value=\"Add..\">";
		$Check_section .= "&nbsp;<input type='text' value=' ".$arr['sectionName']['section_id'].". ".$arr_p['name']."' size='15'>";
		$Check_section .= "&nbsp;<input type='button' onClick='print_acc_section_open(".$arr['Check_section']['shs_id'].");' value='...'></p>";
		}
?>	 
	 <A HREF="?compu=wsd&loc=present_section&op=old_material&data=<?php echo $arr['stock_head']['sh_id'];?>">
	 <b><?php echo $arr['stock_head']['sh_name'];?></b></A><?php echo $sh_diff_name; ?>
<?php
        } else if(!$rows['Check_center'] and $rows['Check_section']){
		$Check_center = "<b>-</b>";		
		$Check_section = "";
		while($arr['Check_section'] = $db->fetch($res['Check_section'])) {
		$res['sectionName'] = $db->select_query("SELECT section_id ,section_name FROM ".TB_MEMBER_SECTION." WHERE section_id='".$arr['Check_section']['section_id']."'");
        $arr['sectionName'] = $db->fetch($res['sectionName']);		
				 $count_str=mb_strlen($arr['sectionName']['section_name']);
				 if($count_str > 12){
					$arr_p['name']= mb_substr($arr['sectionName']['section_name'],0,12,"utf-8")."..."; 
				 }else{
					$arr_p['name']=$arr['sectionName']['section_name'];
				 }		
		$Check_section .= "<p>&nbsp;<input type=\"button\" onClick=\"window.location='?compu=wsd&loc=present_section&op=addold_material&data=".$arr['Check_section']['shs_id']."';\" value=\"Add..\">";
		$Check_section .= "&nbsp;<input type='text' value=' ".$arr['sectionName']['section_id'].". ".$arr_p['name']."' size='15'>";
		$Check_section .= "&nbsp;<input type='button' onClick='print_acc_section_open(".$arr['Check_section']['shs_id'].");' value='...'></p>";
		}
?>
	 <A HREF="?compu=wsd&loc=present_section&op=old_material&data=<?php echo $arr['stock_head']['sh_id'];?>">
	 <b><?php echo $arr['stock_head']['sh_name'];?><?php echo $sh_diff_name; ?></b></A>
<?php
       } else if($rows['Check_center'] and !$rows['Check_section']){
		$Check_center = "<p><font color='#0000FF'>บัญชีกลาง</font>&nbsp;<input type='button' onClick='print_acc_center_open(".$arr['Check_center']['shc_id'].");' value='...'></p>";		
		$Check_section = "<b>-</b>";
?>
	 <A HREF="?compu=wsd&loc=present_section&op=old_material&data=<?php echo $arr['stock_head']['sh_id'];?>">
	 <b><?php echo $arr['stock_head']['sh_name'];?><?php echo $sh_diff_name; ?></b></A>
<?php
       } else if(!$rows['Check_center'] and !$rows['Check_section']){
		$Check_center = "<b>-</b>";		
		$Check_section = "<b>-</b>";
?>
	 <A HREF="?compu=wsd&loc=present_section&op=old_material&data=<?php echo $arr['stock_head']['sh_id'];?>">
	 <b><?php echo $arr['stock_head']['sh_name'];?><?php echo $sh_diff_name; ?></b></A>
<?php
       }
?>	 
	 </td>
	 <td align="center"><b><?php echo $arr['stock_head']['sh_unit'] ;?></b></td>
     <td align="center"><?php echo $arr['stock_type']['type_name'] ;?></td>
	 <td align="center"><?php echo $arr['stock_subtype']['subtype_name'] ;?></td>
	 <td align="center"><?php echo $Check_center ;?></td>
	 <td align="center"><?php echo $Check_section  ;?></td>
    </tr>
	</form>
	<TR>
		<TD colspan="7" height="1" class="dotline"></TD>
	</TR>
<?php
    $num++;
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
    echo "<br><br><a href=\"?compu=wsd&loc=present_section&op=new_material&data=voi\" ><img src=\"images/wsd/add_new_material.png\" alt=\"เพิ่มวัสดุตัวใหม่\" align=\"middle\" border=\"0\" width=\"176\" height=\"23\" /></a>" ; 
}
} else if($op == "old_material" and $action == "add" and $data != "") {
	
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	//ตรวจสอบมี user นี้หรือยัง
	empty($_POST['shs_keep'])?$shs_keep="":$shs_keep=$_POST['shs_keep'];	
	empty($_POST['shp_diff_name_1'])?$shp_diff_name="":$shp_diff_name=$_POST['shp_diff_name_1'];	

	$res['stock_head'] = $db->select_query("SELECT shs_id FROM ".TB_STOCK_HEAD_SECTION." WHERE sh_id='".$_POST['sh_id']."' AND section_id='".$_POST['section_id']."'");
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
			    
	            $res['stock_data'] = $db->select_query("SELECT acc_number FROM ".TB_STOCK_DATA." WHERE section_id='".$_POST['section_id']."'");
		        $arr['stock_data'] = $db->fetch($res['stock_data']);
		        $acc_number = $arr['stock_data']['acc_number'] + 1 ;

				$ss_amountcost =  $_POST['ss_amount_1'] ;
                $ss_pricecost  =  $_POST['ss_price_1']*$_POST['ss_amount_1'] ;
  		 if($check_psd) {	

			empty($_POST['sh_id'])?$sh_id="":$sh_id=$_POST['sh_id'] ;	
	
			$db->add_db(TB_STOCK_HEAD_SECTION,array(
			    "sh_id"=>"".$sh_id."",
				"shs_keep"=>"".$shs_keep."",
				"section_id"=>"".$_POST['section_id']."",
                "acc_number"=>"".$acc_number.""				
			));

			$check_shs_id=mysql_query("select shs_id  from ".TB_STOCK_HEAD_SECTION." WHERE section_id='".$_POST['section_id']."' ORDER BY shs_id  DESC");
		    list($shs_id)=mysql_fetch_row($check_shs_id);
			empty($shs_id)?$shs_id="":$shs_id=$shs_id ;
			$ss_requistion = 0 ;			
			
	            	
                $db->add_db(TB_STOCK_HEAD_PRICE,array(
				"shp_amountcost"=>"".$_POST['ss_amount_1']."",
				"shp_price"=>"".$_POST['ss_price_1']."",
				"shp_diff_name"=>"".$shp_diff_name."",
				"shs_id"=>"".$shs_id.""				
	            ));	
				
			    $check_shp_id=mysql_query("select shp_id  from ".TB_STOCK_HEAD_PRICE." ORDER BY shp_id  DESC");
		        list($shp_id)=mysql_fetch_row($check_shp_id);
			    empty($shp_id)?$shp_id="":$shp_id=$shp_id ;				

                $db->add_db(TB_STOCK_SECTION,array(
				"shs_id"=>"".$shs_id."",
				"ss_date"=>"".$_POST['ss_date_1']."",
				"ss_name"=>"".$_POST['ss_name_1']."",
				//"ss_ref"=>"".$_POST['ss_ref_1']."",
				"ss_price"=>"".$_POST['ss_price_1']."",
				"ss_amount"=>"".$_POST['ss_amount_1']."",
				"ss_amountcost"=>"".$ss_amountcost."",
				"ss_pricecost"=>"".$ss_pricecost."",
				"ss_note"=>"".$_POST['ss_note_1']."",				
				"ss_logic"=>"".$_POST['ss_logic_1']."",								
				"ss_requistion"=>"".$ss_requistion."",												
				"section_id"=>"".$_POST['section_id']."",
				"shp_id"=>"".$shp_id.""				
			    ));					

			    $db->update_db(TB_STOCK_DATA,array(
				"acc_number"=>"".$acc_number.""
				)," section_id='".$_POST['section_id']."'");
				
			//$db->closedb ();
			$ProcessOutput  = "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?compu=admin&loc=main\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการบันทึก  ชื่อวัสดุ :  เป็นที่เรียบร้อย</B></FONT><BR><BR>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
            echo "<script type='text/javascript'>window.location.href = \"index.php?compu=wsd&loc=present_section&op=addold_material&data=".$shs_id."\";</script>" ;
		    } else {
            echo "<FONT COLOR=\"#336600\"><B>ยังมีรายการยังไม่ลงตัว</B></FONT><BR><BR>";
			echo "<A HREF=\"javascript:history.go(-1);\"><B>กลับไปเพิ่มชื่อหรือชนิดวัสดุใหม่</B></A>";
            echo $_POST['ss_amount_1']." และ  ".$_POST['ss_price_1']	;	
			}			
		}
	
} else  if($op == "old_material" and  $data != "") {
	
	//require_once("modules/wsd/function.php");
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		
		$res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE sh_id='".$data."'");
	    $arr['stock_head'] = $db->fetch($res['stock_head']);
        $res['Check_section'] = $db->select_query("SELECT shs_id ,section_id FROM ".TB_STOCK_HEAD_SECTION." WHERE sh_id='".$arr['stock_head']['sh_id']."'");
	    $rows['Check_section'] = $db->rows($res['Check_section']);		
		
?>
<link href="modules/wsd/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript"  src="js/calender.js"></script>
<script language="javascript" type="text/javascript">
function chkNum(ele)
{
var num = parseFloat(ele.value);
ele.value = num.toFixed(2);
}      
</script>
<form NAME="frmMain" METHOD="post" ACTION="?compu=wsd&loc=present_section&op=old_material&action=add&data=voi" onSubmit="return check();" ENCTYPE="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">วัสดุที่ :<br><input type="text" size="5" style="text-align:center;" value="<?php //echo $acc_number ;?>" disabled>
	<input type="hidden" name="acc_number" id="acc_number" value="<?php echo $acc_number ;?>"></td>  
    <td align="center">รหัส :<br>&nbsp;&nbsp;
	<input type="text" name="sh_code_id" id="sh_code_id" value="<?php echo $arr['stock_head']['sh_code_id'] ;?>" size="10" disabled>
	<input type="hidden" name="sh_id" id="sh_id" value="<?php echo $arr['stock_head']['sh_id'];?>" >
	</td>
    <td height="30" align="center">ประเภท :<?php //echo $arr['stock_head']['type_id']; ?><br>
		<span id="stock_type">
			<SELECT NAME="type_id" ID="type_id" disabled>
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
<?php
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
 if(WEB_WSD_CARD == 0){
	 echo "<input type='text' value='".WEB_AGEN_MINI.WEB_AGEN_NAME."' readonly >" ;
	 echo "<input type='hidden' name='section_id' id='section_id' value='0' >" ;
 } else if(WEB_WSD_CARD == 1 or WEB_WSD_CARD == 2){
          $check_section_name = array() ;
		  $count_no = 0 ;
	      while($arr['Check_section'] = $db->fetch($res['Check_section'])){	
		  
		  $check_section_name[$count_no] = $arr['Check_section']['section_id'] ;	  
		  $count_no++ ;
		  }
	 
	 echo "<select name='section_id' id='section_id'>\n";
	 echo "<option value=''>---เลือกหน่วยงาน---</option>\n";
          $res['section_name'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION."");
	      while($arr['section_name'] = $db->fetch($res['section_name'])){
			 
	         if(!in_array($arr['section_name']['section_id'],$check_section_name)) {
			 echo "<option value=".$arr['section_name']['section_id'].">".$arr['section_name']['section_name']."</option>\n";
	         }
		  }		  
	 echo "</select>" ;	
 }
?>
	</td> 
    <td align="center">ที่เก็บ :<br><input type="text" name="shs_keep" id="shs_keep" size="23"></td>	
  </tr>
  <tr><td colspan="5" height="10"></td></tr>
  <tr>
	<td  height="30" align="center" colspan="2">ชื่อหรือชนิดวัสดุ :<br>
	<input type="text" size="28" maxlength="50" style="color:#ff0000;font-weight:bold" value="<?php echo $arr['stock_head']['sh_name'];?>" disabled>
	</td>
    <td align="center"><FONT COLOR="#FF0000"><B>*</B></FONT>ขนาดหรือลักษณะ : <br><input type="text" size="27" value="<?php echo $arr['stock_head']['sh_diff_name'];?>" disabled></td>  
    <td align="center" colspan="2">หน่วยนับ :<br>
			<SELECT NAME="sh_unit" ID="sh_unit" style="color:#ff0000;font-weight:bold" disabled>
			    <OPTION value="">---ใหม่---</OPTION>
<?php
				$res['stock_unit'] = $db->select_query("SELECT * FROM ".TB_STOCK_UNIT." ORDER BY unit_id");
				while($arr['stock_unit'] = $db->fetch($res['stock_unit'])) {
?>
				<OPTION value="<?php echo $arr['stock_unit']['unit_name'];?>" <?php if($arr['stock_head']['sh_unit'] == $arr['stock_unit']['unit_name']){ echo " selected" ; $unitnew = true ;} ?>><?php echo $arr['stock_unit']['unit_name'];?></OPTION>
<?php } ?>
            </SELECT>
    </td>
    <td height="30" align="center">จำนวนอย่าง :<br>สูง <input type="text" name="shs_high" id="shs_high" size="6" maxlength="6" style="text-align:center;" disabled>&nbsp;&nbsp;ต่ำ 
    <input type="text" name="shs_low" id="shs_low" size="6" maxlength="6" style="text-align:center;" disabled></td>	
  </tr>
</table><br>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=90 rowspan=2 valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  วัน เดือน ปี</span></p>
  </td>
  <td width=204 rowspan=2 valign=top style='width:153.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  รับจาก/จ่ายให้</span></p>
  </td>
  <td width=96 rowspan=2 valign=top style='width:72.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  เลขที่เอกสาร</span></p>
  </td>
  <td width=96 rowspan=2 valign=top style='width:72.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ราคาต่อหน่วย</span></p>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ( บาท )</span></p>
  </td>
  <td width=144 colspan=2 valign=top style='width:107.85pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  รับ</span></p>
  </td>
  <td width=144 colspan=2 valign=top style='width:108.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  จ่าย</span></p>
  </td>
  <td width=142 colspan=2 valign=top style='width:106.15pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  คงเหลือ</span></p>
  </td>
  <td width=99 rowspan=2 valign=top style='width:74.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  หมายเหตุ</span></p>
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

 <tr style='mso-yfti-irow:2;height:17.35pt'>
  <td width=90 valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td width=204 valign=top style='width:153.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td width=96 valign=top style='width:72.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td width=96 valign=top style='width:72.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td width=72 valign=top style='width:54.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td width=72 valign=top style='width:53.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td width=72 valign=top style='width:54.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td width=72 valign=top style='width:53.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td width=72 valign=top style='width:54.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td width=69 valign=top style='width:52.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td width=99 valign=top style='width:74.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
 </tr>
</table><br>
<table id="tbExp" width="100%" border="0" cellspacing="2" cellpadding="1" align="center">
  <tr bgcolor="#AAAAAA" height="25">
    <td ><div align="center">วัน เดือน ปี</div></td>
    <td width="60"><div align="center">รับ/จ่าย</div></td>
	<td><div align="center">รายการ</div></td>
    <td><div align="center">กำหนดหลาย  ขนาด/ลักษณะ</div></td>
    <td><div align="center">ราคาต่อหน่วย</div></td>	
    <td><div align="center">จำนวน</div></td>
	<td><div align="center">หมายเหตุ</div></td>
  </tr>
  <tr>
    <td align="center" ><input name="tCalendar_1" type="text" id="tCalendar_1" size="11" value="1 ต.ค. 25<?php echo WEB_BUDGET - 1 ;?>" disabled>&nbsp;<IMG SRC="images/dateselect.gif" BORDER="0" ALT="เลือกวันที่" onClick="#" align="absmiddle">
	<br><input type="hidden" name="ss_date_1" id="ss_date_1" size="12" value="20<?php echo WEB_BUDGET - 44 ;?>-10-1"></td>
    <td align="left">
	<select name="ss_logic_1" id="ss_logic_1" >
<!--	<option value="0" >จ่ายให้</option> -->
	<option value="1" selected>รับจาก</option>
	</select>
    </td>
	<td align="center">
	 <input type="text" size="25" value="ยอดยกมา" disabled>
	 <input type="hidden" name="ss_name_1" id="ss_name_1" size="25" value="ยอดยกมา">
	 <input  type="button" onClick="#" value="...">
	</td>
    <td align="center">
    <input type="text" name="shp_diff_name_1" id="shp_diff_name_1" size="24" value="" ><br><br>
	 เลขที่เอกสาร :<input type="text"  size="15" value="" disabled>
	</td>
    <td align="center">
	<FONT COLOR="#FF0000">ราคา</FONT>/หน่วย&nbsp;:<input type="text" name="ss_price_1" id="ss_price_1" size="9" style="text-align:center;" value="" OnChange="JavaScript:chkNum(this)">
	</td>
    <td align="center">
	จำนวน&nbsp;:<input type="text" name="ss_amount_1" id="ss_amount_1" size="9" style="text-align:center;" value="">
	</td>	
	<td align="center">
	 
	<textarea name="ss_note_1" cols="20" rows="3" value=""></textarea>
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
if(document.frmMain.section_id.value=="") {
alert("กรุณาเลือก  หน่วยงาน  ด้วยครับ") ;
document.frmMain.section_id.focus() ;
return false ;
}
if(document.frmMain.ss_price_1.value=="") {
alert("กรุณากรอก  ราคาต่อหน่วย  ด้วยครับ") ;
document.frmMain.ss_price_1.focus() ;
return false ;
}
if(document.frmMain.ss_amount_1.value=="") {
alert("กรุณากรอก  จำนวน  ด้วยครับ") ;
document.frmMain.ss_amount_1.focus() ;
return false ;
}
else 
return true ;
}		
</SCRIPT>	
	
<?php	
} else if($op == "new_material" and $action == "add" and $data != "") {
	
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	//ตรวจสอบมี user นี้หรือยัง
    empty($_POST['sh_unit'])?$sh_unit="":$sh_unit=$_POST['sh_unit'];
    empty($_POST['subtype_id'])?$subtype_id="":$subtype_id=$_POST['subtype_id'];
    empty($_POST['sh_diff_name'])?$sh_diff_name="":$sh_diff_name=$_POST['sh_diff_name'];	
	empty($_POST['shs_keep'])?$shs_keep="":$shs_keep=$_POST['shs_keep'];	
	empty($_POST['shs_high'])?$shs_high="":$shs_high=$_POST['shs_high'];	
	empty($_POST['shs_low'])?$shs_low="":$shs_low=$_POST['shs_low'];	
	empty($_POST['shp_diff_name_1'])?$shp_diff_name_1="":$shp_diff_name_1=$_POST['shp_diff_name_1'];	

	$res['stock_head'] = $db->select_query("SELECT sh_id FROM ".TB_STOCK_HEAD." WHERE sh_name='".$_POST['sh_name']."' AND sh_diff_name='".$sh_diff_name."' AND sh_unit='".$sh_unit."' AND type_id='".$_POST['type_id']."'");
	$rows['stock_head'] = $db->rows($res['stock_head']); 
	//$db->closedb ();
		if($rows['stock_head']){
		    echo "<script language='javascript'>" ;
		    echo "alert('ต้องขออภัยชื่อหรือชนิดวัสดุ : ".$_POST['sh_name']." มีในระบบแล้วไม่สามารถเพิ่มได้' )" ;
		    echo "</script>" ;
		    echo "<script language='javascript'>javascript:history.go(-1)</script>";
		    exit();			
			$check_psd = false ;
		} else {
			
			
	        $res['stock_data'] = $db->select_query("SELECT acc_number FROM ".TB_STOCK_DATA." WHERE section_id='".$_POST['section_id']."'");
		    $arr['stock_data'] = $db->fetch($res['stock_data']);
		    $acc_number = $arr['stock_data']['acc_number'] + 1 ;
		
			$check_psd = true ;
            $ss_amountcost =  $_POST['ss_amount_1'] ;
            $ss_pricecost  =  $_POST['ss_price_1']*$_POST['ss_amount_1'] ; 
  		 if($check_psd) {	
   
            $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
            
            $db->add_db(TB_STOCK_HEAD,array(
				"sh_code_id"=>"".$_POST['sh_code_id']."",
				"type_id"=>"".$_POST['type_id']."",
				"subtype_id"=>"".$subtype_id."",
				"sh_name"=>"".$_POST['sh_name']."",
				"sh_diff_name"=>"".$sh_diff_name."",
				"sh_unit"=>"".$sh_unit.""
			));
			
			$check_sh_id=mysql_query("select sh_id  from ".TB_STOCK_HEAD." ORDER BY sh_id  DESC");
		    list($sh_id)=mysql_fetch_row($check_sh_id);
			empty($sh_id)?$sh_id="":$sh_id=$sh_id ;	

			$db->add_db(TB_STOCK_HEAD_SECTION,array(
			    "sh_id"=>"".$sh_id."",
				"shs_keep"=>"".$shs_keep."",
				"shs_high"=>"".$shs_high."",
				"shs_low"=>"".$shs_low."",
				"section_id"=>"".$_POST['section_id']."",			
                "acc_number"=>"".$acc_number.""
				));

			$check_shs_id=mysql_query("select shs_id  from ".TB_STOCK_HEAD_SECTION." WHERE section_id='".$_POST['section_id']."' ORDER BY shs_id  DESC");
		    list($shs_id)=mysql_fetch_row($check_shs_id);
			empty($shs_id)?$shs_id="":$shs_id=$shs_id ;
			$ss_requistion = 0 ;			
	            	
                $db->add_db(TB_STOCK_HEAD_PRICE,array(
				"shp_amountcost"=>"".$_POST['ss_amount_1']."",
				"shp_price"=>"".$_POST['ss_price_1']."",
				"shp_diff_name"=>"".$shp_diff_name_1."",
				"shs_id"=>"".$shs_id.""				
	            ));	
				
			    $check_shp_id=mysql_query("select shp_id  from ".TB_STOCK_HEAD_PRICE." ORDER BY shp_id  DESC");
		        list($shp_id)=mysql_fetch_row($check_shp_id);
			    empty($shp_id)?$shp_id="":$shp_id=$shp_id ;				

                $db->add_db(TB_STOCK_SECTION,array(
				"shs_id"=>"".$shs_id."",
				"ss_date"=>"".$_POST['ss_date_1']."",
				"ss_name"=>"".$_POST['ss_name_1']."",
				//"ss_ref"=>"".$_POST['ss_ref_1']."",
				"ss_price"=>"".$_POST['ss_price_1']."",
				"ss_amount"=>"".$_POST['ss_amount_1']."",
				"ss_amountcost"=>"".$ss_amountcost."",
				"ss_pricecost"=>"".$ss_pricecost."",
				"ss_note"=>"".$_POST['ss_note_1']."",				
				"ss_logic"=>"".$_POST['ss_logic_1']."",								
				"ss_requistion"=>"".$ss_requistion."",												
				"section_id"=>"".$_POST['section_id']."",
				"shp_id"=>"".$shp_id.""				
			    ));					

	            $res['unit'] = $db->select_query("SELECT unit_name FROM ".TB_STOCK_UNIT." WHERE unit_name ='".$sh_unit."'");
	            $rows['unit'] = $db->rows($res['unit']);                     
					if(!$rows['unit']){
					    $db->add_db(TB_STOCK_UNIT,array(
				        "unit_name"=>"".$sh_unit.""
			            ));	
                    }				
				
			    $db->update_db(TB_STOCK_DATA,array(
				"acc_number"=>"".$acc_number.""
				)," section_id='".$_POST['section_id']."'");
				
			$ProcessOutput  = "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?compu=admin&loc=main\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการบันทึก  ชื่อวัสดุ : ".$_POST['sh_name']." เป็นที่เรียบร้อย</B></FONT><BR><BR>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
            echo "<script type='text/javascript'>window.location.href = \"index.php?compu=wsd&loc=present_section&op=addold_material&data=".$shs_id."\";</script>" ;
		    } else {
            $ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ยังมีรายการยังไม่ลงตัว</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"javascript:history.go(-1);\"><B>กลับไปเพิ่มชื่อหรือชนิดวัสดุใหม่</B></A>";
			}			
		}
	
} else if(!$ProcessOutput and $op == "new_material" and $data == "voi" ) {	
	require_once("modules/wsd/function.php");
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		
		$check_code_id=mysql_query("select sh_code_id  from ".TB_STOCK_HEAD." ORDER BY sh_id  DESC");
		list($code_id)=mysql_fetch_row($check_code_id);
		$code=checkProductCode($code_id);	
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

function suggest(inputString){
        var section_id = 0 ;
		//var section_id = document.search_name.section_id.value ;
		//alert(section_id) ;
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#sh_unit').addClass('load');
			$.post("modules/wsd/suggest_unit_search.php", {queryString: ""+inputString+"" ,section_id: ""+section_id+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#sh_unit').removeClass('load');
				}
			});
		}
	}
	
function fill(thisValue) {
		$('#sh_unit').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 300);
	} 
function chkNum(ele)
{
var num = parseFloat(ele.value);
ele.value = num.toFixed(2);
}      
   
</script>
<form NAME="frmMain" METHOD="post" ACTION="?compu=wsd&loc=present_section&op=new_material&action=add&data=voi" onSubmit="return check();" ENCTYPE="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">วัสดุที่ :<br><input type="text" size="5" style="text-align:center;" value="<?php //echo $acc_number ;?>" disabled>
	<input type="hidden" name="acc_number" id="acc_number" value="<?php echo $acc_number ;?>"></td>    
    <td align="center">รหัส :<br>&nbsp;&nbsp;<input type="text" value="<?php echo $code ;?>" size="10" disabled>
	<input type="hidden" name="sh_code_id" id="sh_code_id" value="<?php echo $code ;?>"></td>
    <td height="30" align="center">ประเภท :<br><font id="stock_type"><select><option value="0">-------------------</option></select></font></td>	
    <td align="center">ประเภทย่อย :<br><font id="stock_subtype"><select><option value="0">-------------------</option></select></font></td>	
    <td width="100" align="center">หน่วยงาน :
<?php
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

	 if(WEB_WSD_CARD == 1){
	 echo "<input type='text' value='".WEB_AGEN_MINI.WEB_AGEN_NAME."' readonly >" ;
	 echo "<input type='hidden' name='section_id' id='section_id' value='0' >" ;
	 } else if(WEB_WSD_CARD == 2){
	 $res['section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION."");
	 echo "<select name='section_id' id='section_id'>\n";
	 echo "<option value=''>---เลือกหน่วยงาน---</option>\n";
	 while($arr['section'] = $db->fetch($res['section'])){
	 echo "<option value=".$arr['section']['section_id'].">".$arr['section']['section_name']."</option>\n";
	 }
	 echo "</select>" ;
	} 
?>
	</td> 
    <td align="center">ที่เก็บ :<br><input type="text" name="shs_keep" id="shs_keep" size="23"></td>	
  </tr>
  <tr><td colspan="6" height="10"></td></tr>
  <tr>
	<td  height="30" align="center" colspan="2">ชื่อหรือชนิดวัสดุ :<br><input type="text" name="sh_name" id="sh_name" size="30" maxlength="50"></td>
    <td align="center"><FONT COLOR="#FF0000"><B>*</B></FONT>ขนาดหรือลักษณะ : <br><input type="text" size="27" name="sh_diff_name" id="sh_diff_name" value=""></td>  
    <td align="center" colspan="2">หน่วยนับ :<br>
	 <input type="text" size="20" value="" name="sh_unit" id="sh_unit" onkeyup="suggest(this.value);" onblur="fill();" class="">
     <div class="suggestionsBox_search" id="suggestions" style="display: none;"><img src="images/wsd/arrow.png" style="position: relative; top: -12px; left: 40px;" alt="upArrow" />
     <div class="suggestionList_search" id="suggestionsList"></div>
     </div>  
    </td>
    <td height="30" align="center">จำนวนอย่าง :<br>สูง <input type="text" name="shs_high" id="shs_high" size="6" maxlength="6" style="text-align:center;" >&nbsp;&nbsp;ต่ำ 
    <input type="text" name="shs_low" id="shs_low" size="6" maxlength="6" style="text-align:center;" ></td>	
  </tr>
</table><br>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=90 rowspan=2 valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  วัน เดือน ปี</span></p>
  </td>
  <td width=204 rowspan=2 valign=top style='width:153.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  รับจาก/จ่ายให้</span></p>
  </td>
  <td width=96 rowspan=2 valign=top style='width:72.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  เลขที่เอกสาร</span></p>
  </td>
  <td width=96 rowspan=2 valign=top style='width:72.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ราคาต่อหน่วย</span></p>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ( บาท )</span></p>
  </td>
  <td width=144 colspan=2 valign=top style='width:107.85pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  รับ</span></p>
  </td>
  <td width=144 colspan=2 valign=top style='width:108.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  จ่าย</span></p>
  </td>
  <td width=142 colspan=2 valign=top style='width:106.15pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  คงเหลือ</span></p>
  </td>
  <td width=99 rowspan=2 valign=top style='width:74.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  หมายเหตุ</span></p>
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

 <tr style='mso-yfti-irow:2;height:17.35pt'>
  <td width=90 valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td width=204 valign=top style='width:153.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td width=96 valign=top style='width:72.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td width=96 valign=top style='width:72.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td width=72 valign=top style='width:54.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td width=72 valign=top style='width:53.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td width=72 valign=top style='width:54.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td width=72 valign=top style='width:53.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td width=72 valign=top style='width:54.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td width=69 valign=top style='width:52.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
  <td width=99 valign=top style='width:74.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b></b></span></p>
  </td>
 </tr>
</table><br>
<table id="tbExp" width="100%" border="0" cellspacing="2" cellpadding="1" align="center">
  <tr bgcolor="#AAAAAA" height="25">
    <td ><div align="center">วัน เดือน ปี</div></td>
    <td width="60"><div align="center">รับ/จ่าย</div></td>
	<td><div align="center">รายการ</div></td>
    <td><div align="center"><FONT COLOR="#FF0000" ALIGN="left"><B>*</B></FONT>กำหนดหลาย ขนาด/ลักษณะ</div></td>
    <td><div align="center">ราคาต่อหน่วย</div></td>	
    <td><div align="center">จำนวน</div></td>
	<td><div align="center">หมายเหตุ</div></td>
  </tr>
  <tr>
    <td align="center" ><input name="tCalendar_1" type="text" id="tCalendar_1" size="11" value="1 ต.ค. 25<?php echo WEB_BUDGET - 1 ;?>" disabled>&nbsp;<IMG SRC="images/dateselect.gif" BORDER="0" ALT="เลือกวันที่" onClick="#" align="absmiddle">
	<br><input type="hidden" name="ss_date_1" id="ss_date_1" size="12" value="20<?php echo WEB_BUDGET - 44 ;?>-10-1"></td>
    <td align="left">
	<select name="ss_logic_1" id="ss_logic_1" >
	<option value="1" selected>รับจาก</option>
	</select>
    </td>
	<td align="center">
	 <input type="text" size="25" value="ยอดยกมา" disabled>
	 <input type="hidden" name="ss_name_1" id="ss_name_1" size="2" value="ยอดยกมา">
	 <input  type="button" onClick="#" value=".N." disabled>
	</td>
    <td align="center">
    <input type="text" name="shp_diff_name_1" id="shp_diff_name_1" size="27" value=""><br><br>
	 เลขที่เอกสาร :<input type="text" name="ss_ref_1" id="ss_ref_1" size="15" value="" disabled>
	</td>
    <td align="center">
	<FONT COLOR="#FF0000">ราคา</FONT>/หน่วย&nbsp;:<input type="text" name="ss_price_1" id="ss_price_1" size="9" style="text-align:center;" value="" OnChange="JavaScript:chkNum(this)">
	</td>
    <td align="center">
	จำนวน&nbsp;:<input type="text" name="ss_amount_1" id="ss_amount_1" size="9" style="text-align:center;" value="">
	</td>	
	<td align="center">
	 
	<textarea name="ss_note_1" cols="20" rows="3"></textarea>
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
document.frmMain.section_id.focus() ;
return false ;
}
if(document.frmMain.sh_name.value=="") {
alert("กรุณากรอก  ชื่อหรือชนิดวัสดุ  ด้วยครับ") ;
document.frmMain.sh_name.focus() ;
return false ;
}
else if(document.frmMain.sh_unit.value=="")   {
alert("กรุณากำหนด หน่วยนับวัสดุ  ด้วยครับ") ;
document.frmMain.sh_unit.focus() ;
return false ;
}
if(document.frmMain.ss_price_1.value=="") {
alert("กรุณากรอก  ราคาต่อหน่วย  ด้วยครับ") ;
document.frmMain.ss_price_1.focus() ;
return false ;
}
if(document.frmMain.ss_amount_1.value=="") {
alert("กรุณากรอก  จำนวน  ด้วยครับ") ;
document.frmMain.ss_amount_1.focus() ;
return false ;
}
else 
return true ;
}		
</SCRIPT>	
<?php	
} else if($op == "addold_material" and $action == "add" and $data != "") {
	        $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
                   
				   if($_POST['ss_logic_1'] == "1") {	///// รับจาก /////
                   
                   $ss_requistion = 0 ;
				   
                   $res['stock_head_price'] = $db->select_query("SELECT shs_id, sum(shp_amountcost) as amount, sum(shp_price*shp_amountcost) as price  FROM ".TB_STOCK_HEAD_PRICE." WHERE shs_id='".$_POST['shs_id']."' GROUP BY shs_id ");
                   $arr['stock_head_price'] = $db->fetch($res['stock_head_price']) ;
		           $arr['stock_head_rows'] = $db->rows($res['stock_head_price']) ;
         
		            if($arr['stock_head_rows']) {	
                    $amountcost =  $arr['stock_head_price']['amount'] ;	 
		            $pricecost =  $arr['stock_head_price']['price'] ;
		            } else {
		            $amountcost =  0 ;	 
		            $pricecost  =  0 ;
		            }
		
		    $amountcost = $amountcost + $_POST['ss_amount_1'] ;
			$pricecost = $pricecost + ($_POST['ss_price_1']*$_POST['ss_amount_1']);

                if( $_POST['ss_name_1'] <> "" ) {
	                $res['shop'] = $db->select_query("SELECT shop_name FROM ".TB_SHOP." WHERE shop_name ='".$_POST['ss_name_1']."'");
	                $rows['shop'] = $db->rows($res['shop']);                     
					if(!$rows['shop'] and $_POST['ss_name_1']!="ยอดยกมา"){
					    $db->add_db(TB_SHOP,array(
				        "shop_name"=>"".$_POST['ss_name_1'].""
			            ));	
                    }					
                }						

                   $res['stock_head_price'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD_PRICE." WHERE shs_id='".$_POST['shs_id']."' AND shp_price='".$_POST['ss_price_1']."' AND shp_diff_name='".$_POST['shp_diff_name_1']."'");
                   $row['stock_head_price'] = $db->rows($res['stock_head_price']) ;				
				    
					if($row['stock_head_price']){
				        $arr['stock_head_price'] = $db->fetch($res['stock_head_price']) ;
						$amount_cost =  $arr['stock_head_price']['shp_amountcost'] + $_POST['ss_amount_1'] ;
						
						echo "UPDATE<br>" ;
				        $db->update_db(TB_STOCK_HEAD_PRICE,array(
			            "shp_amountcost"=>"".$amount_cost.""
	            	    )," shp_id='".$arr['stock_head_price']['shp_id']."'");
					    empty($arr['stock_head_price']['shp_id'])?$shp_id="":$shp_id=$arr['stock_head_price']['shp_id'] ;							
					
				   } else {
					    echo "ADD<br>" ;
                        $db->add_db(TB_STOCK_HEAD_PRICE,array(
				        "shp_amountcost"=>"".$_POST['ss_amount_1']."",
				        "shp_price"=>"".$_POST['ss_price_1']."",
					    "shp_diff_name"=>"".$_POST['shp_diff_name_1']."",
				        "shs_id"=>"".$_POST['shs_id'].""
			        ));	
					
			            $check_shp_id=mysql_query("select shp_id  from ".TB_STOCK_HEAD_PRICE." ORDER BY shp_id  DESC");
		                list($shp_id)=mysql_fetch_row($check_shp_id);
			            empty($shp_id)?$shp_id="":$shp_id=$shp_id ;						
					   
					   

				   } 
				
                $db->add_db(TB_STOCK_SECTION,array(
				"shs_id"=>"".$_POST['shs_id']."",
				"ss_date"=>"".$_POST['ss_date_1']."",
				"ss_name"=>"".$_POST['ss_name_1']."",
				//"ss_ref"=>"".$_POST['ss_ref_1']."",
				"ss_price"=>"".$_POST['ss_price_1']."",
				"ss_amount"=>"".$_POST['ss_amount_1']."",
				"ss_amountcost"=>"".$amountcost."",
				"ss_pricecost"=>"".$pricecost."",
				"ss_note"=>"".$_POST['ss_note_1']."",				
				"ss_logic"=>"".$_POST['ss_logic_1']."",								
				"ss_requistion"=>"".$ss_requistion."",
				"section_id"=>"".$_POST['section_id']."",
                "shp_id"=>"".$shp_id.""				
		     	));				
				
				
}
				
			//$db->closedb ();
            echo "<script type='text/javascript'>window.location.href = \"index.php?compu=wsd&loc=present_section&op=addold_material&data=".$_POST['shs_id']."\";</script>" ;
            break;
//***/
} else  if($op == "addold_material" and $data != "") {                 
//	require_once("modules/wsd/function.php");
	
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['stock_head_section'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD_SECTION." WHERE shs_id=".$data."");
		$arr['stock_head_section'] = $db->fetch($res['stock_head_section']);
		$res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE sh_id=".$arr['stock_head_section']['sh_id']."");
		$arr['stock_head'] = $db->fetch($res['stock_head']);

	if($arr['stock_head_section']['section_id'] == 0 ) {
	  $section_name = $agen_mini.$agen_name ;
	  $Vsection_id = $arr['stock_head_section']['section_id'] ;
	} else {
	  $res['section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." WHERE section_id=".$arr['stock_head_section']['section_id']."");
	  $arr['section'] = $db->fetch($res['section']);
	  $section_name = $arr['section']['section_name'] ;
	  $Vsection_id = $arr['stock_head_section']['section_id'] ;
    }
?>
<link href="modules/wsd/css/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript">
function  del_open(data)
   {
//  alert(form.sh_unit.value);
     window.open('modules/wsd/del_acc_section.php?data='+data+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=400,height=200,left=200,top=100');
   }   
</script>
<form name="frmMain_body" id="frmMain_body" method="post" action="?compu=wsd&loc=present_section&op=addold_material&action=add&data=voi" onSubmit="return check_body()" enctype="multipart/form-data">  
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td align="center">วัสดุที่ :<br><input type="text" size="5" style="text-align:center;" value="<?php echo $arr['stock_head_section']['acc_number'] ;?>" disabled>
	<input type="hidden" name="acc_number" id="acc_number" value="<?php echo $acc_number ;?>"></td>
    <td align="center">รหัส :<input type="hidden" name="shs_id" id="shs_id" value="<?php echo $arr['stock_head_section']['shs_id'] ;?>" />
	<br>&nbsp;&nbsp;<input type="text" name="sh_code_id" id="sh_code_id" value="<?php echo $arr['stock_head']['sh_code_id'] ;?>" size="10" disabled></td>
    <td height="30" align="center">ประเภท :<br>
						<span id="stock_type">
						<SELECT NAME="type_id" ID="type_id" onChange="dochange_edit('stock_subtype_edit',this.value);" disabled>
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
	<input type="text" size="23" value="<?php echo $section_name ;?>" disabled>
	<input type="hidden" name="section_id" id="section_id" value="<?php echo $Vsection_id ;?>" >
	</td> 
    <td align="center">ที่เก็บ :<br><input type="text"  size="23" value="<?php echo $arr['stock_head_section']['shs_keep'] ;?>" disabled></td>	
</tr>
<tr><td colspan="5" height="10"></td></tr>
<tr>
	<td  height="30" align="center" colspan="2">ชื่อหรือชนิดวัสดุ :<br><input type="text" name="sh_name" id="sh_name" size="28" maxlength="70" style="color:#ff0000;font-weight:bold" value="<?php echo $arr['stock_head']['sh_name'] ;?>" disabled></td>
    <td align="center">ขนาดหรือลักษณะ : <br><input type="text" size="27" value="<?php echo $arr['stock_head']['sh_diff_name'] ;?>" disabled></td>  
    <td align="center" colspan="2">หน่วยนับ :<br>
	
						<SELECT NAME="sh_unit" ID="sh_unit" style="color:#ff0000;font-weight:bold" disabled>
						<?php
						$res['stock_unit'] = $db->select_query("SELECT * FROM ".TB_STOCK_UNIT." ORDER BY unit_id");
						while($arr['stock_unit'] = $db->fetch($res['stock_unit'])) {
						?>
						<OPTION value=<?php echo $arr['stock_unit']['unit_name'];?><?php if($arr['stock_head']['sh_unit']=="".$arr['stock_unit']['unit_name'].""){ echo " selected" ; $unitnew = true ;} ?>><?php echo $arr['stock_unit']['unit_name'];?></OPTION>
                        <?php } ?>
                        </SELECT>
                    	<input type="text" name="sh_unit_new" id="sh_unit_new" size="18" value="" disabled>	

    </td>
    <td height="30" align="center">จำนวนอย่าง :<br>สูง <input type="text" name="shs_high" id="shs_high" size="6" maxlength="6" value="<?php echo $arr['stock_head_section']['shs_high'] ;?>" style="text-align:center;" disabled>&nbsp;&nbsp;ต่ำ 
    <input type="text" name="shs_low" id="shs_low" size="6" maxlength="6" value="<?php echo $arr['stock_head_section']['shs_low'] ;?>" style="text-align:center;" disabled></td>	
  </tr>
</table>
<br>
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
    $count = 0 ;
    $res['stock_section'] = $db->select_query("SELECT ss_id ,UNIX_TIMESTAMP(ss_date) AS st_date ,ss_date ,ss_name ,ss_ref ,ss_price ,ss_amount ,ss_amountcost ,ss_pricecost ,ss_note ,ss_logic ,ss_requistion ,srs_number ,shp_id FROM ".TB_STOCK_SECTION." WHERE shs_id='".$data."' ORDER BY ss_id ");
	
	while($arr['stock_section'] = $db->fetch($res['stock_section'])) { ;
	if($arr['stock_section']['ss_logic'] == "0") {
	$get_amount = "-" ;
	$get_price = "-" ;
	$put_amount = $arr['stock_section']['ss_amount'] ;
	$put_price = $arr['stock_section']['ss_price']*$arr['stock_section']['ss_amount'] ;
	if($arr['stock_section']['ss_requistion']=='0' or $arr['stock_section']['srs_number']=='0'){
		$comment = "<FONT COLOR='#FF0000'><B>*</B>ยังไม่เบิก</FONT> " ;	
	} else {
		$comment = "" ;			
	}	
    } else if($arr['stock_section']['ss_logic'] == "1") {    
	$get_amount = $arr['stock_section']['ss_amount'] ;
	$get_price = $arr['stock_section']['ss_price']*$arr['stock_section']['ss_amount'] ;
	$put_amount = "-" ;
	$put_price = "-" ;
    $comment = "" ;	
	}
    
	$res['stock_price'] = $db->select_query("SELECT shp_diff_name FROM ".TB_STOCK_HEAD_PRICE." WHERE shp_id=".$arr['stock_section']['shp_id']."");
	$arr['stock_price'] = $db->fetch($res['stock_price']);
    $diff_name = $arr['stock_price']['shp_diff_name'] ;	
    
	$count++ ;
 ?>
 <tr style='mso-yfti-irow:2;height:17.35pt'>
  <td width=90 valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo ThaiTimeConvert($arr['stock_section']['st_date'],"5",""); ?></span></p>
  <input type="hidden" name="ss_date_<?php echo $count ;?>" id="ss_date_<?php echo $count ;?>" value="<?php echo $arr['stock_section']['ss_date'] ;?>">
  </td>
  <td width=204 valign=top style='width:153.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_section']['ss_name'] ;?></span></p>
  </td>
  <td width=96 valign=top style='width:72.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_section']['ss_ref'] ;?></span></p>
  </td>
  <td width=96 valign=top style='width:72.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_section']['ss_price'] ;?></span></p>
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
  <?php echo $arr['stock_section']['ss_amountcost'] ;?></span></p>
  </td>
  <td width=69 valign=top style='width:52.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_section']['ss_pricecost'] ;?></span></p>
  </td>
  <td width=99 valign=top style='width:74.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:12.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_section']['ss_note'].$comment.$diff_name ;?></span></p>
  </td>
 </tr>
 <?php 
 $ss_id =  $arr['stock_section']['ss_id'] ;
 $ss_name = $arr['stock_section']['ss_name'] ;
 }
 ?>
</table>
<table id="tbExp" width="100%" border="0" cellspacing="2" cellpadding="1" align="center">  
  <tr bgcolor="#ffffff" height="35">
    <td width="100%" colspan="7" align="right">
	<input  type="button" onClick="del_open(<?php echo $ss_id ;?>)" value=" ลบแถวสุดท้าย "><img src="./images/icon/trash.gif" alt="ลบ" align="middle" border="0" /><?php echo "ss_id= ".$ss_id ;?>
	</td>
  </tr>
  <tr bgcolor="#AAAAAA" height="25">
    <td ><div align="center">วัน เดือน ปี</div></td>
    <td width="60"><div align="center">รับ/จ่าย</div></td>
	<td><div align="center">รายการ</div></td>
    <td><div align="center"><FONT COLOR="#FF0000" ALIGN="left"><B>*</B></FONT>กำหนดหลาย ขนาด/ลักษณะ</div></td>
    <td><div align="center">ราคาต่อหน่วย</div></td>	
    <td><div align="center">จำนวน</div></td>
	<td><div align="center">หมายเหตุ</div></td>
  </tr>
  <tr>
    <td align="center" ><input name="tCalendar_1" type="text" id="tCalendar_1" size="11" value="1 ต.ค. 25<?php echo WEB_BUDGET - 1 ;?>" disabled>&nbsp;<IMG SRC="images/dateselect.gif" BORDER="0" ALT="เลือกวันที่" onClick="#" align="absmiddle">
	<br><input type="hidden" name="ss_date_1" id="ss_date_1" size="12" value="20<?php echo WEB_BUDGET - 44 ;?>-10-1"></td>
    <td align="left">
	<select name="ss_logic_1" id="ss_logic_1" >
	<option value="1" selected>รับจาก</option>
	</select>
    </td>
	<td align="center">
	 <input type="text" size="25" value="ยอดยกมา" disabled>
	 <input type="hidden" name="ss_name_1" id="ss_name_1" size="2" value="ยอดยกมา">
	 <input type="hidden" name="ss_name" id="ss_name" size="2" value="<?php echo $ss_name ; ?>">
	 <input  type="button" onClick="#" value=".N." disabled>
	</td>
    <td align="center">
    <input type="text" name="shp_diff_name_1" id="shp_diff_name_1" size="27" value=""><br><br>
	 เลขที่เอกสาร :<input type="text" size="15" value="" disabled>
	</td>
    <td align="center">
	<FONT COLOR="#FF0000">ราคา</FONT>/หน่วย&nbsp;:<input type="text" name="ss_price_1" id="ss_price_1" size="9" style="text-align:center;" value="" OnChange="JavaScript:chkNum(this)">
	</td>
    <td align="center">
	จำนวน&nbsp;:<input type="text" name="ss_amount_1" id="ss_amount_1" size="9" style="text-align:center;" value="">
	</td>	
	<td align="center">
	 
	<textarea name="ss_note_1" cols="20" rows="3"></textarea>
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
	
if(document.frmMain_body.ss_name.value!="ยอดยกมา") {
alert("บัญชีวัสดุแถวสุดท้าย ไม่ใช้ยอดยกมา") ;
return false ;
}
if(document.getElementById('ss_price_1').value=="") {
alert("กรุณาใส่   ราคา  ด้วยครับ") ;
document.frmMain_body.ss_price_1.focus() ;
return false ;
}
if(document.getElementById('ss_amount_1').value=="") {
alert("กรุณาใส่   จำนวน  ด้วยครับ") ;
document.frmMain_body.ss_amount_1.focus() ;
return false ;
}
else 
return true ;
}	
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