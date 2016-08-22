<?php
   notview();
 //CheckUser_Admin($login_true,$admin_user,$admin_pwd);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/template_css.css" rel="stylesheet" type="text/css">
<link href="psdloc/material/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery1.3.2.js"></script> 
     
	<TABLE cellSpacing="0" cellPadding="0" width="750" border="0" >
      <TBODY>
        <TR>
          <TD width="10" vAlign="top"><IMG src="images/fader.gif" border="0"></TD>
          <TD width="740" vAlign="top"><IMG src="images/topfader.gif" border="0"><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/material/texmenu_stock_requis.gif" BORDER="0"><span style="font-size:16px;color:#900">

			<TABLE width="100%" align="center" cellSpacing="0" cellPadding="0" border="0">
				<TR>
					<TD align="center">
					
<script language="javascript" type="text/javascript">
function suggest(inputString){
        var section_id = document.search_name.section_id.value ;
		//alert(section_id) ;
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#sh_name').addClass('load');
			$.post("psdloc/material/suggest_st_search.php", {queryString: ""+inputString+"" ,section_id: ""+section_id+""}, function(data){
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
     req.open("GET", "psdloc/material/stocktype.php?data="+src+"&val="+val+"&random="+random , true); //สร้าง connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
     req.send(null); //ส่งค่า
}

window.onLoad=dochange('stock_type', -1);
 
</script>


<table width="100%" border="1" cellspacing="1" cellpadding="2" >
    <tr>
      <td width="40%">
       <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#DDDDDD">
  <tr>
<form NAME="search_name" METHOD="post" ACTION="?folder=material&file=acc_material&op=search_name" onSubmit="return check_name()" ENCTYPE="multipart/form-data" >
    <td align="center" valign="middle"><br>
    ชื่อหรือชนิดวัสดุ :&nbsp;
	 <input type="text" size="28" value="" name="sh_name" id="sh_name" onkeyup="suggest(this.value);" onblur="fill();" class="" />
     <div class="suggestionsBox_search" id="suggestions" style="display: none;"><img src="images/car/arrow.png" style="position: relative; top: -12px; left: 40px;" alt="upArrow" />
     <div class="suggestionList_search" id="suggestionsList"></div>
     </div><br><br>   
	 <?
	 if($_SESSION['section_id'] == 0 OR $_SESSION['admin_level'] == 2) {
	      $Vsection_id = 0 ;
	 } else {
	      $Vsection_id = $_SESSION['section_id'] ;
	 }
	 
	 ?>
    <input type="hidden" value="<?=$Vsection_id ;?>" name="section_id" id="section_id" />  	 
	<input type="submit" name="submit" id="submit" value="ค้นหาตามชื่อ" />
	
    </td>
</form>   
  </tr>
</table>

      </td>
      <td width="60%">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#999999">
        <tr>
<form NAME="search_type" METHOD="post" ACTION="?folder=material&file=acc_material&op=search_type" onSubmit="return check_type()" ENCTYPE="multipart/form-data" >
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

<?

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
   <td width="16%"><CENTER><font color="#FFFFFF"><B>ย่อย</B></font></CENTER></td>
   <td width="10%"><CENTER><font color="#FFFFFF"><B>จำนวนเหลือ</B></font></CENTER></td>  
   <td width="10%"><CENTER><font color="#FFFFFF"><B>หน่วยนับ</B></font></CENTER></td>     
   <td width="13%"><CENTER><font color="#FFFFFF"><B>หน่วยงาน</B></font></CENTER></td>
  </tr>  
<?
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
	  $section_name = $agen_mini.$agen_name ;
	} else {
	$res['section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." WHERE section_id='".$arr['stock_head']['section_id']."' ");
	$arr['section'] = $db->fetch($res['section']);
	  $section_name = $arr['section']['section_name'] ;
    }	
	empty($arr['stock_subtype']['subtype_name'])?$subtype_name="ทั่วไป":$subtype_name="".$arr['stock_subtype']['subtype_name']."" ;
	//Comment Icon
//	if($arr['stock_subtype']['subtype_id']){
//		$stock_subtype = $arr['stock_subtype']['subtype_name'] ;
//	}else{
//		$stock_subtype = "-";
//	}
    $res['head_from_amountcost'] = $db->select_query("SELECT SUM(shf_amountcost) AS amountcost  FROM ".TB_STOCK_HEAD_PRICE." WHERE sh_id=".$arr['stock_head']['sh_id']."");
	$arr['head_from_amountcost'] = $db->fetch($res['head_from_amountcost']);
	
	
    if($count%2==0) { //ส่วนของการ สลับสี 
      $ColorFill = "#FDEAFB";
    } else {
      $ColorFill = "#F0F0F0";
    }
// $num = $num + 1 ;
echo "<script language=\"javascript\" type=\"text/javascript\">" ;
echo "function  print_acc_Open(data) { " ;
echo "window.open(\"?folder=material&file=print_acc&sh_id=\"+data+\"\",\"\",\"toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=960,height=680,left=5,top=5\"); ";
echo "}" ;
echo "</script>" ; 
?>
    <tr bgcolor="<?=$ColorFill; ?>" onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='<?=$ColorFill;?>' " height="18">
     <td>
	 <input type="button" onClick="print_acc_Open(<?=$arr['stock_head']['sh_id'];?>)" value="<?=$arr['stock_head']['sh_code_id'];?>">
	 <?echo $arr['stock_head']['sh_name'];?><?echo $sh_diff_name ;?><?=$CommentIcon;?>
	 </td>
     <td align="center"><?=$arr['stock_type']['type_name'] ;?></td>
	 <td align="center"><?=$subtype_name ;?></td>
     <td align="center"><?=$arr['head_from_amountcost']['amountcost'] ;?></td>
     <td align="center"><?=$arr['stock_head']['sh_unit'] ;?></td>
	 <td align="center"><?=$section_name ;?></td>
    </tr>
	<TR>
		<TD colspan="6" height="1" class="dotline"></TD>
	</TR>
<?
	$count++;
 } 
?>
 </table>
<BR>
<?
	SplitPage($page,$totalpage,"?folder=admin&file=stock");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;

$db->closedb ();

}

?>
					</TD>
				</TR>
			</TABLE>
				</TD>
				</TR>
			</TABLE>