<?php
Check_boss($admin_user, $admin_level);
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
<form NAME="search_name" METHOD="post" ACTION="?compu=wsd&loc=material_addstart&op=search_name" onSubmit="return check_name()" ENCTYPE="multipart/form-data" >
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
<form NAME="search_type" METHOD="post" ACTION="?compu=wsd&loc=material_addstart&op=search_type" onSubmit="return check_type()" ENCTYPE="multipart/form-data" >
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
</table><br>

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

 if($op == "search_name" or $op == "search_type"){
	 empty($_POST["type_id"])?$typeid="":$typeid=$_POST["type_id"] ;
     empty($_POST["subtype_id"])?$subtypeid="":$subtypeid=$_POST["subtype_id"] ;

	 echo "type_id=".$typeid ;
	 echo "<br>subtype_id=".$subtypeid ;
	 echo "<br>Section_ID=".$section_id ;
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
   <td width="9%"><CENTER><font color="#FFFFFF"><B>หน่วยนับ</B></font></CENTER></td>     
   <td width="18%"><CENTER><font color="#FFFFFF"><B>ประเภท</B></font></CENTER></td>
   <td width="18%"><CENTER><font color="#FFFFFF"><B>ย่อย</B></font></CENTER></td>
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

echo "<script language=\"javascript\" type=\"text/javascript\">" ;
echo "function  print_acc_section_open(data) { " ;
echo "window.open(\"modules/wsd/print_acc_section.php?shs_id=\"+data+\"\",\"\",\"toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=999,height=830,left=5,top=5\");" ; 
echo "}" ;
echo "</script>" ;

while($arr['stock_head'] = $db->fetch($res['stock_head'])){ 

    empty($arr['stock_head']['sh_diff_name'])?$sh_diff_name="":$sh_diff_name="&nbsp;&nbsp;(".$arr['stock_head']['sh_diff_name'].")" ;
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

    $res['stock_head_section'] = $db->select_query("SELECT shs_id FROM ".TB_STOCK_HEAD_SECTION." WHERE sh_id='".$arr['stock_head']['sh_id']."' AND section_id='".$_POST['section_id']."'");
	$rows['stock_head_section'] = $db->rows($res['stock_head_section']); 
		if($rows['stock_head_section']){	
	$arr['stock_head_section'] = $db->fetch($res['stock_head_section']);
	$res['Check_section'] = $db->select_query("SELECT shs_id FROM ".TB_STOCK_SECTION." WHERE shs_id='".$arr['stock_head_section']['shs_id']."'");
	$rows['Check_section'] = $db->rows($res['Check_section']);
	//$db->closedb ();
		$vCheck = "<font color='#0000FF'><b>บัญชีวัสดุ</b></font> <input type=\"button\" onClick=\"print_acc_section_open(".$arr['stock_head_section']['shs_id'].")\" value=\"...\">" ;
?>
    <tr bgcolor="<?php echo $ColorFill; ?>" onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='<?php echo $ColorFill;?>' " height="18">
	 <td align="center"><?php echo $arr['stock_head']['sh_code_id'];?></td>
     <td>
	 <A HREF="?compu=wsd&loc=material_addstart&op=addold_material&data=<?php echo $arr['stock_head_section']['shs_id'];?>">
	 <b><?php echo $arr['stock_head']['sh_name'];?></A><?php echo $sh_diff_name; ?></b>
	 </td>
	 <td align="center"><b><?php echo $arr['stock_head']['sh_unit'] ;?></b></td>
     <td align="center"><?php echo $arr['stock_type']['type_name'] ;?></td>
	 <td align="center"><?php echo $arr['stock_subtype']['subtype_name'] ;?></td>
     <td align="center"><?php echo $vCheck ;?></td>
    </tr>
	<TR>
		<TD colspan="6" height="1" class="dotline"></TD>
	</TR>
<?php
	$count++;
		}
} 
?>
 </table>
<BR>
<?php
 }
//	SplitPage($page,$totalpage,"?compu=wsd&loc=stock");
//	echo $ShowSumPages ;
//	echo "<BR>";
//	echo $ShowPages ;

} else if($op == "addold_material" and $action == "add" and $data != "") {

	        $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			
			if($_POST['ss_logic_1'] == "0" and $_POST['action_loc'] == "add") {   ///// จ่ายให้ /////
            $ss_requistion = 0 ;	
			
			$res['stock_head_price'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD_PRICE." WHERE shp_id=".$_POST['shp_id']."");	
	        $arr['stock_head_price'] = $db->fetch($res['stock_head_price']);
			
            $ss_pricesum = $arr['stock_head_price']['shp_price']*$_POST['ss_amount'] ;
            $shp_amountcost = $arr['stock_head_price']['shp_amountcost'] - $_POST['ss_amount'] ;			
			
            $res['head_from_amountcost'] = $db->select_query("SELECT SUM(shp_amountcost) AS amountcost ,SUM(shp_price*shp_amountcost) AS pricecost  FROM ".TB_STOCK_HEAD_PRICE." WHERE shs_id=".$_POST['shs_id']."");
	        $arr['head_from_amountcost'] = $db->fetch($res['head_from_amountcost']);			
			$ss_amountcost = $arr['head_from_amountcost']['amountcost'] - $_POST['ss_amount'] ;
			$ss_pricecost =  $arr['head_from_amountcost']['pricecost'] - $ss_pricesum ;
			
            $db->add_db(TB_STOCK_SECTION,array(
				"shs_id"=>"".$_POST['shs_id']."",
				"ss_date"=>"".$_POST['sh_date_1']."",
				"ss_name"=>"".$_POST['ss_name_1']."",
				"member_id"=>"".$_POST['member_id_1']."",
				"ss_price"=>"".$arr['stock_head_price']['shp_price']."",
				"ss_amount"=>"".$_POST['ss_amount']."",
				"ss_amountcost"=>"".$ss_amountcost."",
				"ss_pricecost"=>"".$ss_pricecost."",
				"ss_note"=>"".$_POST['ss_note_1']."",				
				"ss_logic"=>"".$_POST['ss_logic_1']."",								
				"ss_requistion"=>"".$ss_requistion."",												
				"section_id"=>"".$_POST['section_id']."",
                "shp_id"=>"".$_POST['shp_id'].""					
			));	

			$db->update_db(TB_STOCK_HEAD_PRICE,array(
				"shp_amountcost"=>"".$shp_amountcost.""
				)," shp_id='".$_POST['shp_id']."' ");			
         	
            } else if($_POST['ss_logic_1'] == "0" and $_POST['action_loc'] == "edit") {  //แก้ไข
			
            $res['stock_section_edit'] = $db->select_query("SELECT ss_amount, shp_id FROM ".TB_STOCK_SECTION." WHERE ss_id='".$_POST['ss_id']."'");
            $arr['stock_section_edit'] = $db->fetch($res['stock_section_edit']);
            //หาราคา 			
			$res['stock_head_price'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD_PRICE." WHERE shp_id=".$_POST['shp_id']."");	
            $arr['stock_head_price'] = $db->fetch($res['stock_head_price']);
            $ss_pricesum = $arr['stock_head_price']['shp_price']*$_POST['ss_amount'] ;	//เป็นราคา	

            $res['head_from_amountcost'] = $db->select_query("SELECT SUM(shp_amountcost) AS amountcost ,SUM(shp_price*shp_amountcost) AS pricecost  FROM ".TB_STOCK_HEAD_PRICE." WHERE shs_id=".$_POST['shs_id']."");
            $arr['head_from_amountcost'] = $db->fetch($res['head_from_amountcost']);				

                if($arr['stock_section_edit']['shp_id'] == $_POST['shp_id']) {  //จำนวนเหลือ(ราคา)ขนาดหรือลักษณะ  shp_id = ตัวเดิม 
                   
                   $shp_amountcost = ($arr['stock_head_price']['shp_amountcost'] + $arr['stock_section_edit']['ss_amount']) - $_POST['ss_amount'] ;			
		
			       $ss_amountcost = ($arr['head_from_amountcost']['amountcost'] + $arr['stock_section_edit']['ss_amount']) - $_POST['ss_amount'] ;
			       $ss_pricecost =  $arr['head_from_amountcost']['pricecost'] - $ss_pricesum ;	
				} else {   //จำนวนเหลือ(ราคา)ขนาดหรือลักษณะ  shp_id = ตัวใหม่
					
                   $shp_amountcost = $arr['stock_head_price']['shp_amountcost'] - $_POST['ss_amount'] ;			
		
			       $ss_amountcost = ($arr['head_from_amountcost']['amountcost'] + $arr['stock_section_edit']['ss_amount']) - $_POST['ss_amount'] ;
			       $ss_pricecost =  $arr['head_from_amountcost']['pricecost'] - $ss_pricesum ;
                   
				   //$sum_amountcost = 
				   
				}	
		 

			$db->update_db(TB_STOCK_SECTION,array(
                "ss_date"=>"".$_POST['sh_date_1']."",
				"ss_name"=>"".$_POST['ss_name_1']."",
				"member_id"=>"".$_POST['member_id_1']."",
                "ss_price"=>"".$arr['stock_head_price']['shp_price']."",
				"ss_amount"=>"".$_POST['ss_amount']."",
				"ss_amountcost"=>"".$ss_amountcost."",
				"ss_pricecost"=>"".$ss_pricecost."",
				"ss_note"=>"".$_POST['ss_note_1']."",							
				)," ss_id='".$_POST['ss_id']."'");
				

			$db->update_db(TB_STOCK_HEAD_PRICE,array(
				"shp_amountcost"=>"".$shp_amountcost.""
				)," shp_id='".$_POST['shp_id']."' ");					
			}
			
            echo "<script type='text/javascript'>window.location.href = \"index.php?compu=wsd&loc=material_addstart&op=addold_material&data=".$_POST['shs_id']."\";</script>" ;
            break;

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
	//echo "['stock_head_section']['section_id'] =".$arr['stock_head_section']['section_id']."<br>" ;
	//echo "Vsection_id =".$Vsection_id ;
?>
<link href="modules/wsd/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript"  src="js/calender.js"></script>
<script language="javascript" type="text/javascript">

function  been_paid_open(line)
{
//  alert(form.sh_unit.value);
     var ss_logic = document.getElementById('ss_logic_'+line).value ;  
     var section_id = document.getElementById('section_id').value ;  
     window.open('modules/wsd/been_paid_add_section.php?line='+line+'&ss_logic='+ss_logic+'&section_id='+section_id+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=400,height=200,left=330,top=200');
}  
   
function chkNum(ele)
{
var num = parseFloat(ele.value);
ele.value = num.toFixed(2);
}  

function  edit_open(data,ss_id)
{
     //alert(data);
	 //alert(ss_id);
     window.location.href = 'index.php?compu=wsd&loc=material_addstart&op=addold_material&page=edit&data='+data+'&ss_id='+ss_id ;
}

function  del_open(data)
{
//  alert(form.sh_unit.value);
     window.open('modules/wsd/del_acc_section.php?data='+data+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=550,height=200,left=200,top=100');
}
</script>
<div id="pCalendar" style="position: absolute; left: 10px; top: 10px; visibility: hidden;"></div>
<form name="frmMain_body" id="frmMain_body" method="post" action="?compu=wsd&loc=material_addstart&op=addold_material&action=add&data=voi" onSubmit="return check_body()" enctype="multipart/form-data">  
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
	 if($page == "edit") {
      $res['stock_section'] = $db->select_query("SELECT ss_id ,UNIX_TIMESTAMP(ss_date) AS st_date ,ss_date ,ss_name ,ss_ref ,ss_price ,ss_amount ,ss_amountcost ,ss_pricecost ,ss_note ,ss_logic ,ss_requistion ,srs_number ,shp_id FROM ".TB_STOCK_SECTION." WHERE shs_id='".$data."' AND ss_id<>".$_GET['ss_id']."  ORDER BY ss_id ");
	 } else {
      $res['stock_section'] = $db->select_query("SELECT ss_id ,UNIX_TIMESTAMP(ss_date) AS st_date ,ss_date ,ss_name ,ss_ref ,ss_price ,ss_amount ,ss_amountcost ,ss_pricecost ,ss_note ,ss_logic ,ss_requistion ,srs_number ,shp_id FROM ".TB_STOCK_SECTION." WHERE shs_id='".$data."' ORDER BY ss_id ");		 
	 }	 
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
 $ss_logic =  $arr['stock_section']['ss_logic'] ;
 }
 ?>
</table>
<table id="tbExp" width="100%" border="0" cellspacing="2" cellpadding="1" align="center">  
<?php if($ss_logic == 0) {  ?>
  <tr bgcolor="#ffffff" height="35">
    <td width="100%" colspan="5" align="right">
	
	<input  type="button" onClick="edit_open(<?php echo $data ;?>,<?php echo $ss_id ;?>)" value="แก้ไขแถวสุดท้าย">&nbsp;&nbsp;
	<input  type="button" onClick="del_open(<?php echo $ss_id ;?>)" value="ลบแถวสุดท้าย">&nbsp;&nbsp;<?php echo " ss_id= ".$ss_id ;?>
	</td>
  </tr>
<?php } else {?>  
  <tr bgcolor="#ffffff" height="15">
    <td width="100%" colspan="5">&nbsp;</td>
  </tr>
<?php } ?>  
  <tr bgcolor="#cccccc" height="25">
    <td width="120"><div align="center">วัน เดือน ปี</div></td>
    <td width="60"><div align="center">เลือก</div></td>
	<td width="200"><div align="center">รับจาก/จ่ายให้</div></td>
    <td><div align="center"></div></td>
	<td width="110"><div align="center">หมายเหตุ</div></td>
  </tr>
<?php if($page == "edit") {  //แก้ไข
      $res['stock_section_edit'] = $db->select_query("SELECT ss_id ,UNIX_TIMESTAMP(ss_date) AS st_date ,ss_date ,ss_name ,member_id ,ss_ref ,ss_amount ,ss_note ,ss_logic ,shp_id FROM ".TB_STOCK_SECTION." WHERE ss_id='".$_GET['ss_id']."'");
      $arr['stock_section_edit'] = $db->fetch($res['stock_section_edit']);
?>  
  <tr>
    <td align="center" ><input name="tCalendar_1" type="text" id="tCalendar_1" size="11" value="<?php  echo ThaiTimeConvert($arr['stock_section_edit']['st_date'],"5","") ;?>" disabled>&nbsp;
	<IMG SRC="images/dateselect.gif" BORDER="0" ALT="เลือกวันที่" onClick="showCalendar(this,1)" align="absmiddle">
	<br><input type="hidden" name="sh_date_1" id="sh_date_1" size="12" value="<?php echo $arr['stock_section_edit']['ss_date'] ;?>"></td>
    <td align="left">
	<select name="ss_logic_1" id="ss_logic_1">
	<option value="0" selected>จ่ายให้</option>
	</select>
    </td>
	<td align="center">
	 <span id="ss_name_area"><input type="text" name="ss_name_1" id="ss_name_1" size="30" value="<?php echo $arr['stock_section_edit']['ss_name'] ;?>" disabled></span>
	 <input type="hidden" name="member_id_1" id="member_id_1" size="30" value="<?php echo $arr['stock_section_edit']['member_id'] ;?>">
	 <input  type="button" onClick="been_paid_open(1)" value="...">
	</td>
	<td align="center">
<?php
	        $result = mysql_query("SELECT * FROM ".TB_STOCK_HEAD_PRICE." WHERE shs_id = '$data' AND shp_amountcost <> 0 ") or die ("Err Can not to result") ;
	
            echo "จำนวนเหลือ (ราคา) ขนาดหรือลักษณะ : ";			
            echo "<select name='shp_id' id='shp_id' >\n";
			echo "<option value=''>---เลือก---</option>\n";
			while($row = mysql_fetch_array($result)) {
            echo "<option value=".$row['shp_id']."";
  			     if($arr['stock_section_edit']['shp_id'] == $row['shp_id']){ echo ' selected' ;}
			echo "><b>".($row['shp_amountcost']+$arr['stock_section_edit']['ss_amount'])."</b>&nbsp;(".$row['shp_price']." บาท) ".$row['shp_diff_name']."</option>\n";
            }
            echo "</select>\n";
            echo "<br><br>"; 
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จ่ายจำนวน  : ";
			echo "<input type='text' size='10' name='ss_amount' id='ss_amount' value='".$arr['stock_section_edit']['ss_amount']."' style='text-align:center;' class='requist_form'/>";
?>
	&nbsp;<?php echo $arr['stock_head']['sh_unit'];?>
	</td>
 	<td align="center">
	<textarea name="ss_note_1" cols="20" rows="3" value="<?php echo $arr['stock_section_edit']['ss_note'] ;?>"></textarea>
	<input type="hidden" name="action_loc" id="action_loc" value="edit">
	<input type="hidden" name="ss_id" id="ss_id" value="<?php echo $arr['stock_section_edit']['ss_id'];?>">
	</td>	
  </tr> 
<?php } else {?>    
  <tr>
    <td align="center" ><input name="tCalendar_1" type="text" id="tCalendar_1" size="11" disabled>&nbsp;
	<IMG SRC="images/dateselect.gif" BORDER="0" ALT="เลือกวันที่" onClick="showCalendar(this,1)" align="absmiddle">
	<br><input type="hidden" name="sh_date_1" id="sh_date_1" size="12" value=""></td>
    <td align="left">
	<select name="ss_logic_1" id="ss_logic_1">
	<option value="0" selected>จ่ายให้</option>
	</select>
    </td>
	<td align="center">
	 <span id="ss_name_area"><input type="text" name="ss_name_1" id="ss_name_1" size="30" value="" disabled></span>
	 <input type="hidden" name="member_id_1" id="member_id_1" size="30" value="">
	 <input  type="button" onClick="been_paid_open(1)" value="...">
	</td>
	<td align="center">
<?php
	        $result = mysql_query("SELECT * FROM ".TB_STOCK_HEAD_PRICE." WHERE shs_id = '$data' AND shp_amountcost <> 0 ") or die ("Err Can not to result") ;
	
            echo "จำนวนเหลือ (ราคา) ขนาดหรือลักษณะ : ";			
            echo "<select name='shp_id' id='shp_id' >\n";
			echo "<option value=''>---เลือก---</option>\n";
			while($row = mysql_fetch_array($result)) {
            echo "<option value=".$row['shp_id']."><b>".$row['shp_amountcost']."</b>&nbsp;(".$row['shp_price']." บาท) ".$row['shp_diff_name']."</option>\n";
            }
            echo "</select>\n";
            echo "<br><br>"; 
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จ่ายจำนวน  : ";
			echo "<input type='text' size='10' value='' name='ss_amount' id='ss_amount' style='text-align:center;' class='requist_form' />";
?>
	&nbsp;<?php echo $arr['stock_head']['sh_unit'];?>
	</td>
 	<td align="center">
	<textarea name="ss_note_1" cols="20" rows="3"></textarea>
	<input type="hidden" name="action_loc" id="action_loc" value="add">
	</td>	
  </tr> 
<?php } ?>   
  <tr><td colspan="7"><br><center><input type="submit" name="submit" value="บันทึกรายการบัญชีวัสดุ" ></td></tr>  
</table>
</td>
</tr>
</table>
</form> 
<SCRIPT LANGUAGE="javascript">	
function check_body() {
	//alert(document.frmMain_body.sh_date_1.value) ;
	//alert(document.frmMain_body.ss_date_<?php echo $count ;?>.value) ;
if(document.frmMain_body.sh_date_1.value=="") {
alert("กรุณา  ลงวันที่  ด้วยครับ") ;
document.frmMain_body.tCalendar_1.focus() ;
return false ;
}	
if(document.frmMain_body.sh_date_1.value < document.frmMain_body.ss_date_<?php echo $count ;?>.value) {
alert("โปรดเลือกวันที่ มากกว่าหรือเท่า วันที่ล่าสุดด้วยครับ") ;
document.frmMain_body.tCalendar_1.focus() ;
return false ;
}	
if(document.frmMain_body.ss_name_1.value=="") {
alert("กรุณาใส่ ชื่อ  ด้วยครับ") ;
document.frmMain_body.ss_name_1.focus() ;
return false ;
}
if(document.frmMain_body.shp_id.value=="") {
alert("กรุณาเลือก  ราคาหรือ ขนาดลักษณะ  ด้วยครับ") ;
document.frmMain_body.shp_id.focus() ;
return false ;
}
if(document.frmMain_body.ss_amount.value=="") {
alert("กรุณาใส่  จำนวน  ด้วยครับ") ;
document.frmMain_body.ss_amount.focus() ;
return false ;
}
if(document.getElementById('shp_price_id_1').value=="") {
alert("กรุณาใส่   ราคา  ด้วยครับ") ;
document.frmMain_body.shp_price_id_1.focus() ;
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