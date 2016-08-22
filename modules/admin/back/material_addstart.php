<?php
CheckAdmin($admin_user, $admin_level);
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

?>
<!-- <script type="text/javascript" src="js/jquery1.3.2.js"></script>
<script language="JavaScript" type="text/javascript" src="js/jquery-1.7.min.js"></script>  -->
<script language="javascript" type="text/javascript">
function suggest(inputString){
        var section_id = document.search_name.section_id.value ;
		//alert(section_id) ;
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#sh_name').addClass('load');
			$.post("modules/admin/suggest_st_search.php", {queryString: ""+inputString+"" ,section_id: ""+section_id+""}, function(data){
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
     req.open("GET", "modules/admin/stocktype.php?data="+src+"&val="+val+"&random="+random , true); //สร้าง connection
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
<form NAME="search_name" METHOD="post" ACTION="?nongfan=admin&fan=material_addstart&op=search_name" onSubmit="return check_name()" ENCTYPE="multipart/form-data" >
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
<form NAME="search_type" METHOD="post" ACTION="?nongfan=admin&fan=material_addstart&op=search_type" onSubmit="return check_type()" ENCTYPE="multipart/form-data" >
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
    echo "<br><a href=\"?nongfan=admin&fan=material_addstart&op=new_material&data=voi\" ><img src=\"images/wsd/add_new_material.png\" alt=\"เพิ่มวัสดุตัวใหม่\" align=\"middle\" border=\"0\" width=\"176\" height=\"23\" /></a><br><br>" ; 


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
 
 <table width="100%" cellspacing="2" cellpadding="1" >
  <tr bgcolor="#0066FF" height="20">
   <td width="11%"><CENTER><font color="#FFFFFF"><B>รหัส</B></font></CENTER></td>
   <td width="34%"><CENTER><font color="#FFFFFF"><B>ชื่อหรือชนิดวัสดุ (ขนาดหรือลักษณะ)</B></font></CENTER></td>
   <td width="18%"><CENTER><font color="#FFFFFF"><B>ประเภท</B></font></CENTER></td>
   <td width="18%"><CENTER><font color="#FFFFFF"><B>ย่อย</B></font></CENTER></td>
   <td width="9%"><CENTER><font color="#FFFFFF"><B>หน่วยนับ</B></font></CENTER></td>     
   <td width="10%"><CENTER><font color="#FFFFFF"><B>ตรวจเช็ค</B></font></CENTER></td>
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

    empty($arr['stock_head']['sh_diff_name'])?$sh_diff_name="":$sh_diff_name=" ( ".$arr['stock_head']['sh_diff_name']." )" ;
	$res['stock_type'] = $db->select_query("SELECT * FROM ".TB_STOCK_TYPE." WHERE type_id='".$arr['stock_head']['type_id']."' ");
	$arr['stock_type'] = $db->fetch($res['stock_type']);
	$res['stock_subtype'] = $db->select_query("SELECT * FROM ".TB_STOCK_SUBTYPE." WHERE subtype_id='".$arr['stock_head']['subtype_id']."' ");
	$arr['stock_subtype'] = $db->fetch($res['stock_subtype']);
	empty($arr['stock_subtype']['subtype_name'])?$subtype_name="ทั่วไป":$subtype_name="".$arr['stock_subtype']['subtype_name']."" ;
	
    if($count%2==0) { //ส่วนของการ สลับสี 
      $ColorFill = "#FDEAFB";
    } else {
      $ColorFill = "#F0F0F0";
    }
?>
    <tr bgcolor="<?php echo $ColorFill; ?>" onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='<?php echo $ColorFill;?>' " height="18">
	 <td align="center"><?php echo $arr['stock_head']['sh_code_id'];?></td>
     <td>
<?php
    $res['stock_head_budget'] = $db->select_query("SELECT shb_id FROM ".TB_STOCK_HEAD.WEB_BUDGET." WHERE sh_id='".$arr['stock_head']['sh_id']."' AND section_id='".$_POST['section_id']."'");
	$rows['stock_head_budget'] = $db->rows($res['stock_head_budget']); 
	$arr['stock_head_budget'] = $db->fetch($res['stock_head_budget']);
	//$db->closedb ();
		if($rows['stock_head_budget']){
		$vCheck = "<font color='#0000FF'><b>มีแล้ว</b></font>"	
?>	 
	 <A HREF="?nongfan=admin&fan=material_addstart&op=material_addold&data=<?php echo $arr['stock_head_budget']['shb_id'];?>">
	 <b><?php echo $arr['stock_head']['sh_name'];?><?php echo $sh_diff_name; ?></b></A>
<?php
        } else {
		$vCheck = "<font color='#FF0000'><b>ยังไม่มี</b></font>"		
?>
	 <A HREF="?nongfan=admin&fan=material_addstart&op=old_material&data=<?php echo $arr['stock_head']['sh_id'];?>">
	 <b><?php echo $arr['stock_head']['sh_name'];?><?php echo $sh_diff_name; ?></b></A>
<?php
       }
?>	 
	 </td>
     <td align="center"><?php echo $arr['stock_type']['type_name'] ;?></td>
	 <td align="center"><?php echo $subtype_name ;?></td>
     <td align="center"><?php echo $arr['stock_head']['sh_unit'] ;?></td>
	 <td align="center"><?php echo $vCheck ;?></td>
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
//	SplitPage($page,$totalpage,"?nongfan=admin&fan=stock");
//	echo $ShowSumPages ;
//	echo "<BR>";
//	echo $ShowPages ;
    echo "<br><br><a href=\"?nongfan=admin&fan=material_addstart&op=new_material&data=voi\" ><img src=\"images/wsd/add_new_material.png\" alt=\"เพิ่มวัสดุตัวใหม่\" align=\"middle\" border=\"0\" width=\"176\" height=\"23\" /></a>" ; 
}
} else if($op == "material_addstart" and $page == "page_two" and $data == "naivoi1") {
	
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	//ตรวจสอบมี user นี้หรือยัง
    empty($_POST['sh_diff_name'])?$sh_diff_name="":$sh_diff_name=$_POST['sh_diff_name'];	
	empty($_POST['sh_keep'])?$sh_keep="":$sh_keep=$_POST['sh_keep'];	
	empty($_POST['sh_high'])?$sh_high="":$sh_high=$_POST['sh_high'];	
	empty($_POST['sh_low'])?$sh_low="":$sh_low=$_POST['sh_low'];	
	empty($_POST['shf_diff_name_1'])?$shf_diff_name_1="":$shf_diff_name_1=$_POST['shf_diff_name_1'];	

	$res['stock_head'] = $db->select_query("SELECT shb_id FROM ".TB_STOCK_HEAD.WEB_BUDGET." WHERE sh_id='".$_POST['sh_id']."' AND section_id='".$_POST['section_id']."'");
	$rows['stock_head'] = $db->rows($res['stock_head']); 
	//$db->closedb ();
		if($rows['stock_head']){
			$ProcessOutput .= "<BR><BR>";
			$ProcessOutput .= "<CENTER><IMG SRC=\"images/notview.gif\" BORDER=\"0\"><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ชื่อหรือชนิดวัสดุ : ".$_POST['sh_name']." มีในระบบแล้วไม่สามารถเพิ่มได้</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"javascript:history.go(-1);\"><B>กลับไปเพิ่มชื่อหรือชนิดวัสดุใหม่</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
			$check_psd = false ;
		} else {
			$check_psd = true ;
   
			    // if(($_POST['sd_pricecost_1']/$_POST['sd_amountcost_1']) == $_POST['sd_price_1'] ) { //เช็ค ราคาคงเหลือ (หาร) จำนวนคงเหลือ   เท่ากับ  ราคาต่อหน่อยหรือป่าว	
			    //   $check_psd = true ;
			    //   } else {
			    //   $check_psd = false ;
			    //   }
				$sd_amountcost =  $_POST['sd_amount_1'] ;
                $sd_pricecost  =  $_POST['sd_price_1']*$_POST['sd_amount_1'] ;
  		 if($check_psd) {	
   
            $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

			empty($_POST['sh_id'])?$sh_id="":$sh_id=$_POST['sh_id'] ;	
	
			$db->add_db(TB_STOCK_HEAD.WEB_BUDGET,array(
			    "sh_id"=>"".$sh_id."",
				"sh_diff_name"=>"".$sh_diff_name."",
				"sh_keep"=>"".$sh_keep."",
				"sh_high"=>"".$sh_high."",
				"sh_low"=>"".$sh_low."",
				"section_id"=>"".$_POST['section_id'].""			
			));

			$check_shb_id=mysql_query("select shb_id  from ".TB_STOCK_HEAD.WEB_BUDGET." WHERE section_id='".$_POST['section_id']."' ORDER BY shb_id  DESC");
		    list($shb_id)=mysql_fetch_row($check_shb_id);
			empty($shb_id)?$shb_id="":$shb_id=$shb_id ;
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
	            	
                $db->add_db(TB_STOCK_HEAD_FROM,array(
				"shf_amountcost"=>"".$_POST['sd_amount_1']."",
				"shf_price"=>"".$_POST['sd_price_1']."",
				"shf_diff_name"=>"".$shf_diff_name_1."",
				"shb_id"=>"".$shb_id.""				
	            ));	
				
			    $check_shf_id=mysql_query("select shf_id  from ".TB_STOCK_HEAD_FROM." ORDER BY shf_id  DESC");
		        list($shf_id)=mysql_fetch_row($check_shf_id);
			    empty($shf_id)?$shf_id="":$shf_id=$shf_id ;				

                $db->add_db(TB_STOCK_SECTION.WEB_BUDGET,array(
				"shb_id"=>"".$shb_id."",
				"sd_date"=>"".$_POST['sh_date_1']."",
				"sd_name"=>"".$_POST['sd_name_1']."",
				"sd_ref"=>"".$_POST['sd_ref_1']."",
				"sd_price"=>"".$_POST['sd_price_1']."",
				"sd_amount"=>"".$_POST['sd_amount_1']."",
				"sd_amountcost"=>"".$sd_amountcost."",
				"sd_pricecost"=>"".$sd_pricecost."",
				"sd_note"=>"".$_POST['sd_note_1']."",				
				"sd_logic"=>"".$_POST['sd_logic_1']."",								
				"sd_print"=>"".$sd_print."",												
				"section_id"=>"".$_POST['section_id']."",
				"shf_id"=>"".$shf_id.""				
			    ));					
			
			//$db->closedb ();
			$ProcessOutput  = "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?nongfan=admin&fan=main\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการบันทึก  ชื่อวัสดุ : ".$_POST['sh_name']." เป็นที่เรียบร้อย</B></FONT><BR><BR>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
            echo "<script type='text/javascript'>window.location.href = \"index.php?nongfan=admin&fan=material_addstart&op=material_addold&data=".$shb_id."\";</script>" ;
		    } else {
            echo "<FONT COLOR=\"#336600\"><B>ยังมีรายการยังไม่ลงตัว</B></FONT><BR><BR>";
			echo "<A HREF=\"javascript:history.go(-1);\"><B>กลับไปเพิ่มชื่อหรือชนิดวัสดุใหม่</B></A>";
            echo $_POST['sd_amount_1']." และ  ".$_POST['sd_price_1']	;	
			}			
		}
	
} else  if($op == "old_material" and  $data != "") {
	
	//require_once("modules/wsd/function.php");
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		
		$res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE sh_id='$data'");
	    $rows['stock_head'] = $db->fetch($res['stock_head']);		
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

//window.onLoad=dochange('stock_type', -1);
 
    
function dochange_unit() {
	    if (document.frmMain.sh_unit.value == "") {
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
	 var sh_diff_name = document.frmMain.sh_diff_name.value ; 
      //alert(sh_id);	 
     window.open('modules/admin/shf_diff_name_add.php?line='+line+'&sh_diff_name='+sh_diff_name+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=450,height=200,left=330,top=200');
   } 
function chkNum(ele)
{
var num = parseFloat(ele.value);
ele.value = num.toFixed(2);
}      
   
</script>
<div id="pCalendar" style="position: absolute; left: 10px; top: 10px; visibility: hidden;"></div>
<form NAME="frmMain" METHOD="post" ACTION="?nongfan=admin&fan=material_addstart&op=material_addstart&page=page_two&data=naivoi1" onSubmit="return check();" ENCTYPE="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">รหัส :<br>&nbsp;&nbsp;
	<input type="text" name="sh_code_id" id="sh_code_id" value="<?php echo $rows['stock_head']['sh_code_id'] ;?>" size="10" disabled>
	<input type="hidden" name="sh_id" id="sh_id" value="<?php echo $rows['stock_head']['sh_id'];?>" >
	</td>
    <td height="30" align="center">ประเภท :<?php //echo $rows['stock_head']['type_id']; ?><br>
		<span id="stock_type">
			<SELECT NAME="type_id" ID="type_id" onChange="dochange('stock_subtype',this.value);" disabled>
<?php
				$res['stock_type'] = $db->select_query("SELECT * FROM ".TB_STOCK_TYPE." ORDER BY type_id");
				while($arr['stock_type'] = $db->fetch($res['stock_type'])) {
?>
				<OPTION value="<?php echo $arr['stock_type']['type_id'];?>" <?php if($rows['stock_head']['type_id'] == $arr['stock_type']['type_id']){ echo " selected" ; } ?>><?php echo $arr['stock_type']['type_name'];?></OPTION>
<?php } ?>
            </SELECT>
		</span>
	</td>	
    <td align="center">ประเภทย่อย :<br>
		<span id="stock_subtype">
			<SELECT NAME="subtype_id" ID="subtype_id" disabled>
<?php
				$res['stock_subtype'] = $db->select_query("SELECT * FROM ".TB_STOCK_SUBTYPE." WHERE type_id='".$rows['stock_head']['type_id']."' ORDER BY subtype_id");
				$rows['stock_subtype'] = $db->rows($res['stock_subtype']); 
				if(!$rows['stock_subtype']) {
				echo "<OPTION value='0' selected >ทั่วไป</OPTION>" ;
				} else {
				while($arr['stock_subtype'] = $db->fetch($res['stock_subtype'])) {
?>
			    <OPTION value="<?php echo $arr['stock_subtype']['subtype_id'];?>" <?php if($rows['stock_head']['subtype_id'] == $arr['stock_subtype']['subtype_id']){ echo " selected" ; } ?>><?php echo $arr['stock_subtype']['subtype_name'];?></OPTION>
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
	  echo "<input type='text' value='".$arr['section']['section_name']."' disabled>" ;
	  echo "<input type='hidden' name='section_id' id='section_id' value='".$arr['section']['section_id']."' >" ;
    }	
?>
	</td> 
    <td align="center">ที่เก็บ :<br><input type="text" name="sh_keep" id="sh_keep" size="23"></td>	
  </tr>
  <tr><td colspan="5" height="10"></td></tr>
  <tr>
	<td  height="30" align="center" >ชื่อหรือชนิดวัสดุ :<br>
	<input type="text" size="30" maxlength="50" value="<?php echo $rows['stock_head']['sh_name'];?>" disabled>
	<input type="hidden" name="sh_name" id="sh_name" value="<?php echo $rows['stock_head']['sh_name'];?>">
	</td>
    <td align="center"><FONT COLOR="#FF0000"><B>*</B></FONT>ขนาดหรือลักษณะ : <br><input type="text" size="27" name="sh_diff_name" id="sh_diff_name" value=""></td>  
    <td align="center" colspan="2">หน่วยนับ :<br>
			<SELECT NAME="sh_unit" ID="sh_unit" onChange="dochange_unit();" disabled>
			    <OPTION value="">---ใหม่---</OPTION>
<?php
				$res['stock_unit'] = $db->select_query("SELECT * FROM ".TB_STOCK_UNIT." ORDER BY unit_id");
				while($arr['stock_unit'] = $db->fetch($res['stock_unit'])) {
?>
				<OPTION value="<?php echo $arr['stock_unit']['unit_name'];?>" <?php if($rows['stock_head']['sh_unit'] == $arr['stock_unit']['unit_name']){ echo " selected" ; $unitnew = true ;} ?>><?php echo $arr['stock_unit']['unit_name'];?></OPTION>
<?php } ?>
            </SELECT>
	<?php  if($unitnew) { ?>
	<font id="unit"><input type="text" name="sh_unit_new" id="sh_unit_new" size="18" value="" disabled></font>	
	<?php } else {  ?>
	<font id="unit"><input type="text" name="sh_unit_new" id="sh_unit_new" size="18" value="<?php echo $arr['stock_head']['sh_unit'] ;?>"></font>
	<?php } ?>	
    </td>
    <td height="30" align="center">จำนวนอย่าง :<br>สูง <input type="text" name="sh_high" id="sh_high" size="6" maxlength="6" style="text-align:center;" />&nbsp;&nbsp;ต่ำ 
    <input type="text" name="sh_low" id="sh_low" size="6" maxlength="6" style="text-align:center;"></td>	
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
    <td><div align="center">ขนาด/ลักษณะ</div></td>
    <td><div align="center">ราคาต่อหน่วย</div></td>	
    <td><div align="center">จำนวน</div></td>
	<td><div align="center">หมายเหตุ</div></td>
  </tr>
  <tr>
    <td align="center" ><input name="tCalendar_1" type="text" id="tCalendar_1" size="11" value="1 ต.ค. 25<?php echo WEB_BUDGET - 1 ;?>" >&nbsp;<IMG SRC="images/dateselect.gif" BORDER="0" ALT="เลือกวันที่" onClick="showCalendar(this,1)" align="absmiddle">
	<br><input type="hidden" name="sh_date_1" id="sh_date_1" size="12" value="20<?php echo WEB_BUDGET - 44 ;?>-10-1"></td>
    <td align="left">
	<select name="sd_logic_1" id="sd_logic_1" >
	<option value="0" >จ่ายให้</option>
	<option value="1" selected>รับจาก</option>
	</select>
    </td>
	<td align="center">
	 <input type="text" name="sd_name_1" id="sd_name_1" size="25" value="ยอดยกมา">
	 <input  type="button" onClick="been_paid_open(1)" value="...">
	</td>
    <td align="center">
	<font id="disp_diff_name_1"><input type="text" name="shf_diff_name_1" id="shf_diff_name_1" size="24" value="" disabled></font>
	<input  type="button" onClick="diff_name_open(1)" value="..."><br><br>
	 เลขที่เอกสาร :<input type="text" name="sd_ref_1" id="sd_ref_1" size="15" value="" >
	</td>
    <td align="center">
	<FONT COLOR="#FF0000">ราคา</FONT>/หน่วย&nbsp;:<input type="text" name="sd_price_1" id="sd_price_1" size="9" style="text-align:center;" value="" OnChange="JavaScript:chkNum(this)">
	</td>
    <td align="center">
	จำนวน&nbsp;:<input type="text" name="sd_amount_1" id="sd_amount_1" size="9" style="text-align:center;" value="">
<!--	&nbsp;&nbsp;&nbsp;<FONT COLOR="#FF0000">ราคา</FONT>เหลือ&nbsp;:<input type="text" name="sd_pricecost_1" id="sd_pricecost_1" size="9" style="text-align:center;" value="" OnChange="JavaScript:chkNum(this)"><br><br>
	จำนวนเหลือ&nbsp;:<input type="text" name="sd_amountcost_1" id="sd_amountcost_1" size="9" style="text-align:center;" value="" > -->
	</td>	
	<td align="center">
	 
	<textarea name="sd_note_1" cols="20" rows="3" value=""></textarea>
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
if(document.frmMain.sd_price_1.value=="") {
alert("กรุณากรอก  ราคาต่อหน่วย  ด้วยครับ") ;
document.frmMain.sd_price_1.focus() ;
return false ;
}
if(document.frmMain.sd_amount_1.value=="") {
alert("กรุณากรอก  จำนวน  ด้วยครับ") ;
document.frmMain.sd_amount_1.focus() ;
return false ;
}
else 
return true ;
}		

dtNow = new Date();
makeCalendar(dtNow.getMonth(), dtNow.getFullYear());

</SCRIPT>	
	
<?php	
} else if($op == "material_addstart" and $page == "page_one" and $data == "naivoi") {
	
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	//ตรวจสอบมี user นี้หรือยัง
    empty($_POST['sh_unit'])?$sh_unit=$_POST['sh_unit_new']:$sh_unit=$_POST['sh_unit'];
    empty($_POST['subtype_id'])?$subtype_id="":$subtype_id=$_POST['subtype_id'];
    empty($_POST['sh_diff_name'])?$sh_diff_name="":$sh_diff_name=$_POST['sh_diff_name'];	
	empty($_POST['sh_keep'])?$sh_keep="":$sh_keep=$_POST['sh_keep'];	
	empty($_POST['sh_high'])?$sh_high="":$sh_high=$_POST['sh_high'];	
	empty($_POST['sh_low'])?$sh_low="":$sh_low=$_POST['sh_low'];	
	empty($_POST['shf_diff_name_1'])?$shf_diff_name_1="":$shf_diff_name_1=$_POST['shf_diff_name_1'];	

	$res['stock_head'] = $db->select_query("SELECT sh_id FROM ".TB_STOCK_HEAD." WHERE sh_name='".$_POST['sh_name']."' AND sh_unit='".$sh_unit."' AND type_id='".$_POST['type_id']."'");
	$rows['stock_head'] = $db->rows($res['stock_head']); 
	//$db->closedb ();
		if($rows['stock_head']){
			$ProcessOutput .= "<BR><BR>";
			$ProcessOutput .= "<CENTER><IMG SRC=\"images/notview.gif\" BORDER=\"0\"><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ชื่อหรือชนิดวัสดุ : ".$_POST['sh_name']." มีในระบบแล้วไม่สามารถเพิ่มได้</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"javascript:history.go(-1);\"><B>กลับไปเพิ่มชื่อหรือชนิดวัสดุใหม่</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
			$check_psd = false ;
		} else {
			$check_psd = true ;
   
			    // if(($_POST['sd_pricecost_1']/$_POST['sd_amountcost_1']) == $_POST['sd_price_1'] ) { //เช็ค ราคาคงเหลือ (หาร) จำนวนคงเหลือ   เท่ากับ  ราคาต่อหน่อยหรือป่าว	
			    //   $check_psd = true ;
			    //   } else {
			    //  $check_psd = false ;
			    //   }
            $sd_amountcost =  $_POST['sd_amount_1'] ;
            $sd_pricecost  =  $_POST['sd_price_1']*$_POST['sd_amount_1'] ; 
  		 if($check_psd) {	
   
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

			$db->add_db(TB_STOCK_HEAD.WEB_BUDGET,array(
			    "sh_id"=>"".$sh_id."",
				"sh_diff_name"=>"".$sh_diff_name."",
				"sh_keep"=>"".$sh_keep."",
				"sh_high"=>"".$sh_high."",
				"sh_low"=>"".$sh_low."",
				"section_id"=>"".$_POST['section_id'].""			
			));

			$check_shb_id=mysql_query("select shb_id  from ".TB_STOCK_HEAD.WEB_BUDGET." WHERE section_id='".$_POST['section_id']."' ORDER BY shb_id  DESC");
		    list($shb_id)=mysql_fetch_row($check_shb_id);
			empty($shb_id)?$shb_id="":$shb_id=$shb_id ;
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
	            	
                $db->add_db(TB_STOCK_HEAD_FROM,array(
				"shf_amountcost"=>"".$_POST['sd_amount_1']."",
				"shf_price"=>"".$_POST['sd_price_1']."",
				"shf_diff_name"=>"".$shf_diff_name_1."",
				"shb_id"=>"".$shb_id.""				
	            ));	
				
			    $check_shf_id=mysql_query("select shf_id  from ".TB_STOCK_HEAD_FROM." ORDER BY shf_id  DESC");
		        list($shf_id)=mysql_fetch_row($check_shf_id);
			    empty($shf_id)?$shf_id="":$shf_id=$shf_id ;				

                $db->add_db(TB_STOCK_SECTION.WEB_BUDGET,array(
				"shb_id"=>"".$shb_id."",
				"sd_date"=>"".$_POST['sh_date_1']."",
				"sd_name"=>"".$_POST['sd_name_1']."",
				"sd_ref"=>"".$_POST['sd_ref_1']."",
				"sd_price"=>"".$_POST['sd_price_1']."",
				"sd_amount"=>"".$_POST['sd_amount_1']."",
				"sd_amountcost"=>"".$sd_amountcost."",
				"sd_pricecost"=>"".$sd_pricecost."",
				"sd_note"=>"".$_POST['sd_note_1']."",				
				"sd_logic"=>"".$_POST['sd_logic_1']."",								
				"sd_print"=>"".$sd_print."",												
				"section_id"=>"".$_POST['section_id']."",
				"shf_id"=>"".$shf_id.""				
			    ));					
			
			//$db->closedb ();
			$ProcessOutput  = "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?nongfan=admin&fan=main\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการบันทึก  ชื่อวัสดุ : ".$_POST['sh_name']." เป็นที่เรียบร้อย</B></FONT><BR><BR>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
            echo "<script type='text/javascript'>window.location.href = \"index.php?nongfan=admin&fan=material_addstart&op=material_addold&data=".$shb_id."\";</script>" ;
		    } else {
            $ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ยังมีรายการยังไม่ลงตัว</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"javascript:history.go(-1);\"><B>กลับไปเพิ่มชื่อหรือชนิดวัสดุใหม่</B></A>";
             	echo $amount." และ  ".$price	;	
			}			
		}
	
} else if(!$ProcessOutput and $op == "new_material" and $data == "voi" ) {	
	require_once("modules/wsd/function.php");
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		
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

function  been_paid_open(line)
   {
//  alert(form.sh_unit.value);
     var sd_logic = document.getElementById('sd_logic_'+line).value ;  
     var section_id = document.getElementById('section_id').value ;  
     window.open('modules/admin/been_paid_add.php?line='+line+'&sd_logic='+sd_logic+'&section_id='+section_id+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=400,height=200,left=330,top=200');
   }  
   
function  diff_name_open(line)
   {
	 var sh_diff_name = document.frmMain.sh_diff_name.value ; 
      //alert(sh_id);	 
     window.open('modules/admin/shf_diff_name_add.php?line='+line+'&sh_diff_name='+sh_diff_name+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=450,height=200,left=330,top=200');
   } 
function chkNum(ele)
{
var num = parseFloat(ele.value);
ele.value = num.toFixed(2);
}      
   
</script>
<div id="pCalendar" style="position: absolute; left: 10px; top: 10px; visibility: hidden;"></div>
<form NAME="frmMain" METHOD="post" ACTION="?nongfan=admin&fan=material_addstart&op=material_addstart&page=page_one&data=naivoi" onSubmit="return check();" ENCTYPE="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">รหัส :<br>&nbsp;&nbsp;<input type="text" name="sh_code_id" id="sh_code_id" value="<?php echo $code ;?>" size="10"></td>
    <td height="30" align="center">ประเภท :<br><font id="stock_type"><select><option value="0">-------------------</option></select></font></td>	
    <td align="center">ประเภทย่อย :<br><font id="stock_subtype"><select><option value="0">-------------------</option></select></font></td>	
    <td width="100" align="center">หน่วยงาน :
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
	</td> 
    <td align="center">ที่เก็บ :<br><input type="text" name="sh_keep" id="sh_keep" size="23"></td>	
  </tr>
  <tr><td colspan="5" height="10"></td></tr>
  <tr>
	<td  height="30" align="center" >ชื่อหรือชนิดวัสดุ :<br><input type="text" name="sh_name" id="sh_name" size="30" maxlength="50"></td>
    <td align="center"><FONT COLOR="#FF0000"><B>*</B></FONT>ขนาดหรือลักษณะ : <br><input type="text" size="27" name="sh_diff_name" id="sh_diff_name" value=""></td>  
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
    <input type="text" name="sh_low" id="sh_low" size="6" maxlength="6" style="text-align:center;"></td>	
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
    <td><div align="center">ขนาด/ลักษณะ</div></td>
    <td><div align="center">ราคาต่อหน่วย</div></td>	
    <td><div align="center">จำนวน</div></td>
	<td><div align="center">หมายเหตุ</div></td>
  </tr>
  <tr>
    <td align="center" ><input name="tCalendar_1" type="text" id="tCalendar_1" size="11" value="1 ต.ค. 25<?php echo WEB_BUDGET - 1 ;?>" >&nbsp;<IMG SRC="images/dateselect.gif" BORDER="0" ALT="เลือกวันที่" onClick="showCalendar(this,1)" align="absmiddle">
	<br><input type="hidden" name="sh_date_1" id="sh_date_1" size="12" value="20<?php echo WEB_BUDGET - 44 ;?>-10-1"></td>
    <td align="left">
	<select name="sd_logic_1" id="sd_logic_1" >
	<option value="0" >จ่ายให้</option>
	<option value="1" selected>รับจาก</option>
	</select>
    </td>
	<td align="center">
	 <input type="text" name="sd_name_1" id="sd_name_1" size="25" value="ยอดยกมา">
	 <input  type="button" onClick="been_paid_open(1)" value="...">
	</td>
    <td align="center">
	<font id="disp_diff_name_1"><input type="text" name="shf_diff_name_1" id="shf_diff_name_1" size="24" value="" disabled></font>
	<input  type="button" onClick="diff_name_open(1)" value="..."><br><br>
	 เลขที่เอกสาร :<input type="text" name="sd_ref_1" id="sd_ref_1" size="15" value="" >
	</td>
    <td align="center">
	<FONT COLOR="#FF0000">ราคา</FONT>/หน่วย&nbsp;:<input type="text" name="sd_price_1" id="sd_price_1" size="9" style="text-align:center;" value="" OnChange="JavaScript:chkNum(this)">
	</td>
    <td align="center">
	จำนวน&nbsp;:<input type="text" name="sd_amount_1" id="sd_amount_1" size="9" style="text-align:center;" value="">
	</td>	
	<td align="center">
	 
	<textarea name="sd_note_1" cols="20" rows="3"></textarea>
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
if(document.frmMain.sd_price_1.value=="") {
alert("กรุณากรอก  ราคาต่อหน่วย  ด้วยครับ") ;
document.frmMain.sd_price_1.focus() ;
return false ;
}
if(document.frmMain.sd_amount_1.value=="") {
alert("กรุณากรอก  จำนวน  ด้วยครับ") ;
document.frmMain.sd_amount_1.focus() ;
return false ;
}
if(document.frmMain.sd_pricecost_1.value=="") {
alert("กรุณากรอก  ราคาเหลือ  ด้วยครับ") ;
document.frmMain.sd_pricecost_1.focus() ;
return false ;
}
if(document.frmMain.sd_amountcost_1.value=="") {
alert("กรุณากรอก  จำนวนเหลือ  ด้วยครับ") ;
document.frmMain.sd_amountcost_1.focus() ;
return false ;
}
else 
return true ;
}		

dtNow = new Date();
makeCalendar(dtNow.getMonth(), dtNow.getFullYear());

</SCRIPT>	
<?php	
} else if($op == "material_addhead" and $action == "add") {
	
$shb_id = $_POST['shb_id'] ;
echo "<script type='text/javascript'>window.location.href = \"index.php?nongfan=admin&fan=material_addstart&op=material_addold&data=".$shb_id."\";</script>" ;

} else if($op == "material_addbody" and $action == "add" and $data != "" ) {
/*** 
            echo "<br>sd_logic_1 = ".$_POST['sd_logic_1']."<br>" ;
			echo "shb_id = ".$_POST['shb_id']."<br>" ;
			echo "sd_amount_1 = ".$_POST['sd_amount_1']."<br>" ;
			echo "sd_price_1 = ".$_POST['sd_price_1']."<br>" ;
			echo "sd_name_1 = ".$_POST['sd_name_1']."<br>" ;
			echo "shf_diff_id_1 = ".$_POST['shf_diff_id_1']."<br>" ;
			echo "shf_price_id_1 = ".$_POST['shf_price_id_1']."<br>" ;  //รับจาก  คือ  shf_id
			echo "sd_section_id_1 = ".$_POST['sd_section_id_1']."<br>" ;
			echo "section_id = ".$_POST['section_id']."<br>" ; //ใช้กับ รับจาก
			echo "shb_id = ".$_POST['shb_id']."<br>" ;
***/
	        $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			
			if($_POST['sd_logic_1'] == "0") {   ///// จ่ายให้ /////
            $sd_print = 0 ;	
			
			$res['stock_head_form'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD_FROM." WHERE shf_id=".$_POST['shf_id']."");	
	        $arr['stock_head_form'] = $db->fetch($res['stock_head_form']);
			
            $sd_pricesum = $arr['stock_head_form']['shf_price']*$_POST['sd_amount'] ;
            $shf_amountcost = $arr['stock_head_form']['shf_amountcost'] - $_POST['sd_amount'] ;			
			
            $res['head_from_amountcost'] = $db->select_query("SELECT SUM(shf_amountcost) AS amountcost ,SUM(shf_price*shf_amountcost) AS pricecost  FROM ".TB_STOCK_HEAD_FROM." WHERE shb_id=".$_POST['shb_id']."");
	        $arr['head_from_amountcost'] = $db->fetch($res['head_from_amountcost']);			
			$sd_amountcost = $arr['head_from_amountcost']['amountcost'] - $_POST['sd_amount'] ;
			$sd_pricecost =  $arr['head_from_amountcost']['pricecost'] - $sd_pricesum ;
			
            $db->add_db(TB_STOCK_SECTION.WEB_BUDGET,array(
				"shb_id"=>"".$_POST['shb_id']."",
				"sd_date"=>"".$_POST['sh_date_1']."",
				"sd_name"=>"".$_POST['sd_name_1']."",
				"sd_price"=>"".$arr['stock_head_form']['shf_price']."",
				"sd_amount"=>"".$_POST['sd_amount']."",
				"sd_amountcost"=>"".$sd_amountcost."",
				"sd_pricecost"=>"".$sd_pricecost."",
				"sd_note"=>"".$_POST['sd_note_1']."",				
				"sd_logic"=>"".$_POST['sd_logic_1']."",								
				"sd_print"=>"".$sd_print."",												
				"section_id"=>"".$_POST['sd_section_id_1']."",
                "shf_id"=>"".$_POST['shf_id'].""					
			));	
			
			$db->update_db(TB_STOCK_HEAD_FROM,array(
				"shf_amountcost"=>"".$shf_amountcost.""
				)," shf_id='".$_POST['shf_id']."' ");
         	
            } else 	if($_POST['sd_logic_1'] == "1") {	///// รับจาก /////

		           $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
                    
                   $sd_print = 0 ;
				   
                   $res['stock_head_from'] = $db->select_query("SELECT shb_id, sum(shf_amountcost) as amount, sum(shf_price*shf_amountcost) as price  FROM ".TB_STOCK_HEAD_FROM." WHERE shb_id='".$_POST['shb_id']."' GROUP BY shb_id ");
                   $arr['stock_head_from'] = $db->fetch($res['stock_head_from']) ;
		           $arr['stock_head_rows'] = $db->rows($res['stock_head_from']) ;
         
		            if($arr['stock_head_rows']) {	
                    $amountcost =  $arr['stock_head_from']['amount'] ;	 
		            $pricecost =  $arr['stock_head_from']['price'] ;
		            } else {
		            $amountcost =  0 ;	 
		            $pricecost  =  0 ;
		            }
		
		    $amountcost = $amountcost + $_POST['sd_amount_1'] ;
			$pricecost = $pricecost + ($_POST['sd_price_1']*$_POST['sd_amount_1']);

                if( $_POST['sd_name_1'] <> "" ) {
	                $res['shop'] = $db->select_query("SELECT shop_name FROM ".TB_SHOP." WHERE shop_name ='".$_POST['sd_name_1']."'");
	                $rows['shop'] = $db->rows($res['shop']);                     
					if(!$rows['shop']){
					    $db->add_db(TB_SHOP,array(
				        "shop_name"=>"".$_POST['sd_name_1'].""
			            ));	
                    }					
                }						

				//echo $_POST['shf_diff_id_1']."12345<br>" ;
				//echo $_POST['shf_price_id_1'] ;
				if($_POST['shf_diff_id_1'] == "new_diff" or $_POST['shf_price_id_1'] == "new_price"){
					echo "ADD<br>" ;
                    $db->add_db(TB_STOCK_HEAD_FROM,array(
				    "shf_amountcost"=>"".$_POST['sd_amount_1']."",
				    "shf_price"=>"".$_POST['sd_price_1']."",
					"shf_diff_name"=>"".$_POST['shf_diff_name_1']."",
				    "shb_id"=>"".$_POST['shb_id'].""
			        ));	
					
			    $check_shf_id=mysql_query("select shf_id  from ".TB_STOCK_HEAD_FROM." ORDER BY shf_id  DESC");
		        list($shf_id)=mysql_fetch_row($check_shf_id);
			    empty($shf_id)?$shf_id="":$shf_id=$shf_id ;						
					
				} else {
				    $res['head_from1'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD_FROM." WHERE shf_id='".$_POST['shf_price_id_1']."'" );
                    $arr['head_rows'] = $db->rows($res['head_from1']) ;
                        if($arr['head_rows']) {						
                        $arr['head_from1'] = $db->fetch($res['head_from1']) ;					
						$amount_cost =  $arr['head_from1']['shf_amountcost'] + $_POST['sd_amount_1'] ;
						echo "UPDATE<br>" ;
				        $db->update_db(TB_STOCK_HEAD_FROM,array(
			            "shf_amountcost"=>"".$amount_cost.""
	            	    )," shf_id='".$_POST['shf_price_id_1']."'");	
                        }	
                empty($_POST['shf_price_id_1'])?$shf_id="":$shf_id=$_POST['shf_price_id_1'] ;
						
				} 
				
                $db->add_db(TB_STOCK_SECTION.WEB_BUDGET,array(
				"shb_id"=>"".$_POST['shb_id']."",
				"sd_date"=>"".$_POST['sh_date_1']."",
				"sd_name"=>"".$_POST['sd_name_1']."",
				"sd_ref"=>"".$_POST['sd_ref_1']."",
				"sd_price"=>"".$_POST['sd_price_1']."",
				"sd_amount"=>"".$_POST['sd_amount_1']."",
				"sd_amountcost"=>"".$amountcost."",
				"sd_pricecost"=>"".$pricecost."",
				"sd_note"=>"".$_POST['sd_note_1']."",				
				"sd_logic"=>"".$_POST['sd_logic_1']."",								
				"sd_print"=>"".$sd_print."",
				"section_id"=>"".$_POST['section_id']."",
                "shf_id"=>"".$shf_id.""				
		     	));				
				
				
}
				
			//$db->closedb ();
            echo "<script type='text/javascript'>window.location.href = \"index.php?nongfan=admin&fan=material_addstart&op=material_addold&data=".$_POST['shb_id']."\";</script>" ;
            break;
//***/
} else  if($op == "material_addold" and $data != "") {                 
//	require_once("modules/wsd/function.php");
	
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['stock_head_budget'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD.WEB_BUDGET." WHERE shb_id=".$data."");
		$arr['stock_head_budget'] = $db->fetch($res['stock_head_budget']);
		$res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE sh_id=".$arr['stock_head_budget']['sh_id']."");
		$arr['stock_head'] = $db->fetch($res['stock_head']);

	if($arr['stock_head_budget']['section_id'] == 0 ) {
	  $section_name = $agen_mini.$agen_name ;
	  $Vsection_id = $arr['stock_head_budget']['section_id'] ;
	} else {
	  $res['section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." WHERE section_id=".$arr['stock_head_budget']['section_id']."");
	  $arr['section'] = $db->fetch($res['section']);
	  $section_name = $arr['section']['section_name'] ;
	  $Vsection_id = $arr['stock_head_budget']['section_id'] ;
    }
	//echo "['stock_head_budget']['section_id'] =".$arr['stock_head_budget']['section_id']."<br>" ;
	//echo "Vsection_id =".$Vsection_id ;
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
	 var shb_id = document.getElementById('shb_id').value ;  
	 //var shb_id = document.frmMain_body.shb_id.value ; 
     alert("shb_id="+shb_id);	 
     window.open('modules/admin/diff_name_add.php?line='+line+'&shb_id='+shb_id+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=400,height=200,left=330,top=200');
   }  
function  price_open(line)
   {
	 var shb_id = document.getElementById('shb_id').value ;  
	 //var shb_id = document.frmMain_body.shb_id.value ; 
	 alert("shb_id="+shb_id);
	 var shf_diff_name = document.getElementById("shf_diff_name_"+line).value ;	
     //alert(shf_diff_name);	 
     window.open('modules/admin/price_add.php?line='+line+'&shb_id='+shb_id+'&shf_diff_name='+shf_diff_name+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=400,height=200,left=330,top=200');
   }    
   
function chkNum(ele)
{
var num = parseFloat(ele.value);
ele.value = num.toFixed(2);
} 

function dochange_logic_area(data, val) {
     //alert(data);
	 //alert(val);
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
<form name="frmMain_body" id="frmMain_body" method="post" action="?nongfan=admin&fan=material_addstart&op=material_addbody&action=add&data=voi" onSubmit="return check_body()" enctype="multipart/form-data">  
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td align="center">รหัส :<input type="text" name="shb_id" id="shb_id" value="<?php echo $arr['stock_head_budget']['shb_id'] ;?>" />
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
    <td align="center">ที่เก็บ :<br><input type="text" name="sh_keep" id="sh_keep" size="23" value="<?php echo $arr['stock_head_budget']['sh_keep'] ;?>"></td>	
</tr>
<tr><td colspan="5" height="10"></td></tr>
<tr>
	<td  height="30" align="center" >ชื่อหรือชนิดวัสดุ :<br><input type="text" name="sh_name" id="sh_name" size="30" maxlength="50" value="<?php echo $arr['stock_head']['sh_name'] ;?>" disabled></td>
    <td align="center">ขนาดหรือลักษณะ : <br><input type="text" name="sh_diff_name" id="sh_diff_name" size="27" value="<?php echo $arr['stock_head_budget']['sh_diff_name'] ;?>" /></td>  
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
    <td height="30" align="center">จำนวนอย่าง :<br>สูง <input type="text" name="sh_high" id="sh_high" size="6" maxlength="6" value="<?php echo $arr['stock_head_budget']['sh_high'] ;?>" style="text-align:center;"/>&nbsp;&nbsp;ต่ำ 
    <input type="text" name="sh_low" id="sh_low" size="6" maxlength="6" value="<?php echo $arr['stock_head_budget']['sh_low'] ;?>" style="text-align:center;"></td>	
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
$res['stock_details'] = $db->select_query("SELECT UNIX_TIMESTAMP(sd_date) AS st_date ,sd_name ,sd_ref ,sd_price ,sd_amount ,sd_amountcost ,sd_pricecost ,sd_note ,sd_logic  FROM ".TB_STOCK_SECTION.WEB_BUDGET." WHERE shb_id='".$data."' ORDER BY sd_id ");
	
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
	<input type="hidden" name="sd_section_id_1" id="sd_section_id_1"  value="<?php echo $Vsection_id ;?>">
	<!-- <input type="text" name="shb_id" id="shb_id" value="<?php //echo $arr['stock_head_budget']['shb_id'] ;?>" /> -->
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
	<textarea name="sd_note_1" cols="20" rows="3"></textarea>
<!--	<input type="hidden" name="shf_price_id_1" id="shf_price_id_1" value=""> -->
	</td>	
  </tr> 
  <tr><td colspan="7"><br><center><input type="submit" name="submit" value="บันทึกรายการบัญชีวัสดุ" ></td></tr>  
</table>
</td>
</tr>
</table>
</form> 

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