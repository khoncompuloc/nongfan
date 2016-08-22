<?php
 CheckUser_Nopwd($login_true);
 empty($_SESSION['section_id'])?$section_id="":$section_id=$_SESSION['section_id'];	
 empty($_SESSION['admin_level'])?$admin_level="":$admin_level=$_SESSION['admin_level'];	 
 empty($ProcessOutput)?$ProcessOutput="":$ProcessOutput=$ProcessOutput ;
?>
<link href="modules/wsd/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript"  src="js/calender.js"></script>
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
					//document.querySelector(#src).innerHTML=req.responseText; //รับค่ากลับมา
               } 
          }
     };
	 var random=Math.random();
     req.open("GET", "modules/wsd/stocktype.php?data="+src+"&val="+val+"&random="+random , true); //สร้าง connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
     req.send(null); //ส่งค่า
}
 
function  print_acc_section_open(data) {
window.open("modules/wsd/print_acc_section.php?shs_id="+data ,"","toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=999,height=830,left=5,top=5"); 
}  
 
function  see_section_other(data) {
window.location = "?compu=wsd&loc=index&shs_id="+data " ; 
}  


window.onLoad=dochange('stock_type', -1); 
</script>

<table width="100%" border="0" cellspacing="1" cellpadding="2" >
    <tr>
    <td width="100%" align="left" colspan="2"><img src="images/wsd/texmenu_stock_requis.gif" width="170" height="32" align="baseline"></td>
    </tr>
    <tr>
    <td height="1" class="dotline" colspan="2" width="100%"><br></td>
    </tr>		
    <tr>
    <td width="40%">
    <form NAME="search_name" METHOD="post" ACTION="?compu=wsd&loc=index&op=search_name" onSubmit="return check_name()" ENCTYPE="multipart/form-data" >
	<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#DDDDDD">
       <tr>
       <td align="center" valign="middle"><br>
               ชื่อหรือชนิดวัสดุ :&nbsp;
	   <input type="text" size="28" value="" name="sh_name" id="sh_name" onkeyup="suggest(this.value);" onblur="fill();" class="" />
       <div class="suggestionsBox_search" id="suggestions" style="display: none;"><img src="images/car/arrow.png" style="position: relative; top: -12px; left: 40px;" alt="upArrow" />
       <div class="suggestionList_search" id="suggestionsList"></div>
       </div><br><br> 
	 <?php 
	 if($section_id == 0 OR $admin_level == 2) {
	      $Vsection_id = 0 ;
	 } else {
	      $Vsection_id = $_SESSION['section_id'] ;
	 }
	 
	 ?>
      <input type="hidden" value="<?php echo $Vsection_id ;?>" name="section_id" id="section_id" /> 	 
	  <input type="submit" name="submit" id="submit" value="ค้นหาตามชื่อ" />
	
       </td>

       </tr>
       </table>
       </form>   
    </td>
    <td width="60%">
       <form NAME="search_type" METHOD="post" ACTION="?compu=wsd&loc=index&op=search_type" onSubmit="return check_type()" ENCTYPE="multipart/form-data" >
       <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#999999">
       <tr>
       <td align="center" height="35" valign="middle"><br>
          ประเภทวัสดุ :<font id="stock_type"><select><option value="0">-------------------</option></select></font>&nbsp;
          ย่อย :<font id="stock_subtype"><select><option value="0">-------------------</option></select></font><br><br>    
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
if($op == "requist_form" AND $action == "add") {

	        $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
            
			$ss_logic_1 = 0 ;
			$ss_requistion = 0 ;	
			
			$res['stock_head_price'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD_PRICE." WHERE shp_id=".$_POST['shp_id'].""); //ok	
	        $arr['stock_head_price'] = $db->fetch($res['stock_head_price']);
			
            $ss_pricesum = $arr['stock_head_price']['shp_price']*$_POST['ss_amount'] ; //ok
            $shp_amountcost = $arr['stock_head_price']['shp_amountcost'] - $_POST['ss_amount'] ; //ok			
			
            $res['head_from_amountcost'] = $db->select_query("SELECT SUM(shp_amountcost) AS amountcost ,SUM(shp_price*shp_amountcost) AS pricecost  FROM ".TB_STOCK_HEAD_PRICE." WHERE shs_id=".$_POST['shs_id'].""); //ok
	        $arr['head_from_amountcost'] = $db->fetch($res['head_from_amountcost']);			
			$ss_amountcost = $arr['head_from_amountcost']['amountcost'] - $_POST['ss_amount'] ; //ok
			$ss_pricecost =  $arr['head_from_amountcost']['pricecost'] - $ss_pricesum ; //ok
			
            $db->add_db(TB_STOCK_SECTION,array(
				"shs_id"=>"".$_POST['shs_id']."",  //ok
				"ss_date"=>"".$_POST['sh_date_1']."", //ok
				"ss_name"=>"".$_POST['ss_name_1']."", //ok
				"member_id"=>"".$_POST['member_id_1']."", //ok
				"ss_price"=>"".$arr['stock_head_price']['shp_price']."", //ok
				"ss_amount"=>"".$_POST['ss_amount']."", //ok
				"ss_amountcost"=>"".$ss_amountcost."", //ok
				"ss_pricecost"=>"".$ss_pricecost."", //ok
				"ss_note"=>"".$_POST['ss_note_1']."", //ok				
				"ss_logic"=>"".$ss_logic_1."",	//ok  0 -> จ่ายให้							
				"ss_requistion"=>"".$ss_requistion."",	//ok  0 -> ยังไม่เบิก											
				"section_id"=>"".$_POST['section_id']."", //ok
                "shp_id"=>"".$_POST['shp_id']."" //ok					
			));	

			$db->update_db(TB_STOCK_HEAD_PRICE,array(
				"shp_amountcost"=>"".$shp_amountcost.""
				)," shp_id='".$_POST['shp_id']."' ");  //ok			

            echo "<script type='text/javascript'>window.location.href ='index.php?compu=wsd';</script>" ;
            break;

} else if($op == "requist_form") {

$w=$thai_w[date("w")];
$d=date("d");
$n=$SHORT_MONTH[date("n")];
$m=date("n");
$y=date("Y") +543;
$ye=date("Y");

$date_hid=$ye."-".$m."-".$d ;
    
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
    $res['stock_head_section'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD_SECTION." WHERE sh_id=".$_GET['sh_id']." AND section_id='".$section_id."'");
    $arr['stock_head_section'] = $db->fetch($res['stock_head_section']) ;	
    $res['stock_head'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD." WHERE sh_id=".$arr['stock_head_section']['sh_id']."");
    $arr['stock_head'] = $db->fetch($res['stock_head']) ;	
    $res['stock_head_price'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD_PRICE." WHERE shs_id=".$arr['stock_head_section']['shs_id']."");	
    $res['head_price_amountcost'] = $db->select_query("SELECT SUM(shp_amountcost) AS amountcost  FROM ".TB_STOCK_HEAD_PRICE." WHERE shs_id=".$arr['stock_head_section']['shs_id']."");
	$arr['head_price_amountcost'] = $db->fetch($res['head_price_amountcost']);	
?>
<script type="text/javascript"  src="js/calender.js"></script>
<div id="pCalendar" style="position: absolute; left: 10px; top: 10px; visibility: hidden;"></div>     
<form NAME="myform" METHOD="post" ACTION="?compu=wsd&loc=requistion&op=requist_form&action=add" onSubmit="return check_requis()" enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="2" cellspacing="3" >
  <tr>
    <td width="15" height="20" ></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
<?php 
        if(empty($admin_user) and isset($login_true)) {
		$res['member'] = $db->select_query("SELECT member_id, prefix, fname, lname FROM ".TB_MEMBER." WHERE user='".$login_true."' ");
		$arr['member'] = $db->fetch($res['member']);
?>  
  <tr height="30">
    <td></td>
    <td rowspan="3" align="center" valign="top" ><img src="images/wsd/stock/watsadu.png" width="100" height="75" border="0" /></td>
    <td align="right" class="requist_form_title">ชื่อผู้เบิก :</td>
    <td class="requist_form"><?php echo $arr['member']['prefix'];?><?php echo $arr['member']['fname'];?>&nbsp;<?php echo $arr['member']['lname'];?></td>
    <input type="hidden" name="ss_name_1" id="ss_name_1" value="<?php echo $arr['member']['prefix'].$arr['member']['fname']."&nbsp;".$arr['member']['lname'] ;?>">
	<input type="hidden" name="member_id_1" id="member_id_1" value="<?php echo $arr['member']['member_id'] ;?>">
  </tr>
<?php 
        }
	if($arr['stock_head_section']['section_id'] == 0){
	  $section_name = $agen_mini.$agen_name ;
	} else {
	  $res['section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." WHERE section_id='".$arr['stock_head_section']['section_id']."' ");
	  $arr['section'] = $db->fetch($res['section']);
	  $section_name = $arr['section']['section_name'] ;
    }		
	$check_shs_id=mysql_query("SELECT UNIX_TIMESTAMP(ss_date) AS ssdate, ss_date FROM ".TB_STOCK_SECTION." WHERE shs_id=".$arr['stock_head_section']['shs_id']." ORDER BY ss_date  DESC");
	list($ssdate)=mysql_fetch_row($check_shs_id);		
?>
  <tr height="30">
    <td></td>
    <td align="right" class="requist_form_title">หน่วยงาน :</td>
    <td><b><?php echo $section_name ;?></b></td>
  </tr>
  <tr height="30">
    <td></td>
    <td align="right" class="requist_form_title">วันที่ :</td>
    <td><IMG SRC="images/dateselect.gif" BORDER="0" ALT="เลือกวันที่" onClick="showCalendar(this,1)" align="absmiddle">&nbsp;
	<input name="tCalendar_1" type="text" id="tCalendar_1" size="14" value="<?php echo "$d $n $y" ;?>" class="requist_form" ><?php // echo "$d $n $y" ;?>
	<br><input type="hidden" name="sh_date_1" id="sh_date_1" value="<?php echo $date_hid ;?>">
	</td>
  </tr>
  <tr height="30">
    <td colspan="2"></td>
    <td align="right" class="requist_form_title">จำนวนเหลือ (ราคา) ขนาดหรือลักษณะ :</td>
    <td>
        <select name="shp_id" id="shp_id" class="requist_form">
		         <option value="">--เลือก--</option>
		<?php while($arr['stock_head_price'] = $db->fetch($res['stock_head_price'])){ 
		   if($arr['stock_head_price']['shp_amountcost']<>'0') {
             echo "<option value=".$arr['stock_head_price']['shp_id']." > ".$arr['stock_head_price']['shp_amountcost']."&nbsp;".$arr['stock_head']['sh_unit']."&nbsp;(".$arr['stock_head_price']['shp_price']."&nbsp;บาท) ".$arr['stock_head_price']['shp_diff_name']."</option>" ;
           } else {
			 echo "<option value=\"\" selected>-หมด-</option>" ;   
		   }
		}?>
		</select><b><?php //echo "&nbsp;".$arr['stock_head']['sh_unit'] ;?></b>
   </td>
  </tr>
  <tr height="30">
    <td></td>
    <td align="center"><font color="#999999" size="2"><b><?php echo $arr['head_price_amountcost']['amountcost'] ;?>&nbsp;&nbsp;<?php echo $arr['stock_head']['sh_unit'] ;?></b></font>
	<br><font color="#FF0000" size="3"><b><?php echo $arr['stock_head']['sh_name'] ;?></b></font><br>
	<?php echo $arr['stock_head']['sh_diff_name'] ;?>
	</td>
    <td align="right" class="requist_form_title">เบิกจำนวน :</td>
    <td><input type="text" size="10" value="" name="ss_amount" id="ss_amount" style="text-align:center;" class="requist_form" />
	 <b><?php echo "&nbsp;".$arr['stock_head']['sh_unit'] ;?></b>
	</td>
  </tr>  
  <tr height="40">
    <td colspan="4"><input type="hidden" name="sh_id" id="sh_id" value="<?php echo $arr['stock_head']['sh_id'] ;?>">
    <input type="hidden" name="section_id" id="section_id" value="<?php echo $arr['stock_head_section']['section_id'] ;?>">
	<input type="hidden" name="ss_note_1" id="ss_note_1" value="">
	<input type="hidden" name="shs_id" id="shs_id" value="<?php echo $arr['stock_head_section']['shs_id'] ;?>">
	</td>
  </tr>
  <tr>
    <td colspan="4" align="center" valign="top"><center>
         <input type="submit" name="button" id="button" value=" &nbsp;&nbsp;&nbsp;ตกลง&nbsp;&nbsp;&nbsp; " /> 
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <input type="reset" name="button2" id="button2" value=" &nbsp;&nbsp;&nbsp;เครีย&nbsp;&nbsp;&nbsp; " />
    </center></td>
  </tr>
  <tr>
    <td colspan="4" height="35" ></td>
  </tr>    
  <tr>
    <td height="1" class="dotline" colspan="4" width="100%"><br></td>
  </tr>	  
  <tr>
    <td width="15" height="30" ></td>
    <td><br>
	<input type="button" onClick="print_acc_section_open(<?php echo $arr['stock_head_section']['shs_id'];?>)" value="ดูบัญชีวัสดุ <?php echo $arr['stock_head']['sh_name'];?>">
	&nbsp;&nbsp;&nbsp;
	<?php echo " ( วันที่ล่าสุด ".ThaiTimeConvert($ssdate,"5","")." )"; ?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php if($arr['head_price_amountcost']['amountcost']==0) { ?>
	<input type="button" onClick="see_section_other(<?php echo $arr['stock_head_section']['shs_id'];?>)" value="เช็คจากกองอื่น  <?php echo $arr['stock_head']['sh_name'];?>">
	<?php } ?>
	</td>
    <td></td>
    <td></td>
  </tr> 
  <tr>
    <td colspan="4" height="25" ></td>
  </tr>  
</table>
</form>
<SCRIPT LANGUAGE="javascript">	
function check_requis() {

if(document.myform.shp_id.value=="") {
alert("กรุณา  จำนวนเหลือ  ด้วยครับ") ;
document.myform.shp_id.focus() ;
return false ;
}	
if(document.myform.ss_amount.value=="") {
alert("กรุณาใส่ จำนวนเบิก  ด้วยครับ") ;
document.myform.ss_amount.focus() ;
return false ;
}
else 
return true ;
}	

dtNow = new Date();
makeCalendar(dtNow.getMonth(), dtNow.getFullYear());
</SCRIPT>
<?php
} 
?>