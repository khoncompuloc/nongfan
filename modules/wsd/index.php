<?php 
 CheckUser_Nopwd($login_true);
 empty($_SESSION['section_id'])?$section_id="":$section_id=$_SESSION['section_id'];	
 empty($_SESSION['admin_level'])?$admin_level="":$admin_level=$_SESSION['admin_level'];	 
 empty($ProcessOutput)?$ProcessOutput="":$ProcessOutput=$ProcessOutput ;	
?>
<link href="modules/wsd/css/style.css" rel="stylesheet" type="text/css">
<!--
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/template_css.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery1.3.2.js"></script>
-->
					
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
	 var random=Math.random()
     req.open("GET", "modules/wsd/stocktype.php?data="+src+"&val="+val+"&random="+random , true); //สร้าง connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
     req.send(null); //ส่งค่า
}
 
function  print_acc_Open(sh_id) {
window.open("?folder=wsd&file=print_acc_see&sh_id="+sh_id+"","","toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=950,height=680,left=5,top=5"); 
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
if($op == "search_name" or $op == "search_type"){
	 empty($_POST["type_id"])?$typeid="":$typeid=$_POST["type_id"] ;
     empty($_POST["subtype_id"])?$subtypeid="":$subtypeid=$_POST["subtype_id"] ;
	 	
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
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
	empty($arr['stock_subtype']['subtype_name'])?$subtype_name="":$subtype_name=$arr['stock_subtype']['subtype_name'] ;	

    if($count%2==0) { //ส่วนของการ สลับสี 
      $ColorFill = "#FDEAFB";
    } else {
      $ColorFill = "#F0F0F0";
    }

    $res['stock_head_section'] = $db->select_query("SELECT shs_id ,section_id FROM ".TB_STOCK_HEAD_SECTION." WHERE sh_id='".$arr['stock_head']['sh_id']."' AND section_id='".$section_id."'");
	$rows['stock_head_section'] = $db->rows($res['stock_head_section']); 
		if($rows['stock_head_section']){	
    $arr['stock_head_section'] = $db->fetch($res['stock_head_section']);	
    $res['stock_head_price'] = $db->select_query("SELECT SUM(shp_amountcost) AS amountcost  FROM ".TB_STOCK_HEAD_PRICE." WHERE shs_id=".$arr['stock_head_section']['shs_id']."");
	$arr['stock_head_price'] = $db->fetch($res['stock_head_price']);
	$res['member_section'] = $db->select_query("SELECT section_name  FROM ".TB_MEMBER_SECTION." WHERE section_id=".$arr['stock_head_section']['section_id']."");
	$arr['member_section'] = $db->fetch($res['member_section']);

?>
    <tr bgcolor="<?php echo $ColorFill; ?>" onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='<?php echo $ColorFill;?>' " height="18">

     <td><A HREF="?compu=wsd&loc=requistion&op=requist_form&sh_id=<?php echo $arr['stock_head']['sh_id'];?>">
	 <?php echo $arr['stock_head']['sh_name'];?><?php echo $sh_diff_name ;?></A><?php //echo $CommentIcon;?></td>
     <td align="center"><?php echo $arr['stock_type']['type_name'] ;?></td>
	 <td align="center"><?php echo $subtype_name ;?></td>
     <td align="center"><?php echo $arr['stock_head_price']['amountcost'] ;?></td>
     <td align="center"><?php echo $arr['stock_head']['sh_unit'] ;?></td>
	 <td align="center"><?php echo $arr['member_section']['section_name'] ;?></td>
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
//	SplitPage($page,$totalpage,"?folder=admin&file=stock");
//	echo $ShowSumPages ;
//	echo "<BR>";
//	echo $ShowPages ;

$db->closedb ();

} 
    echo "<br><br>" ;
?>