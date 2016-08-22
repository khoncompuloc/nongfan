<?php 
notview();
//CheckAdmin($admin_user, $admin_pwd);
?>
<link href="psdloc/admin/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery1.3.2.js"></script> 
	<TABLE cellSpacing="0" cellPadding="0" width="950" border="0">
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="940" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/admin/texmenu_stock_start.gif" BORDER="0"><BR>
				<TABLE width="940" align="center" cellSpacing="0" cellPadding="0" border="0" >
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?folder=admin&file=main">หน้าหลักผู้ดูแลระบบ</A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp;เริ่มต้นใช้งานบัญชีวัสดุ</B>
					<BR><BR>
					<A HREF="?folder=admin&file=material"><IMG SRC="images/icon/open.gif"  BORDER="0" align="absmiddle"> รายการบัญชีวัสดุ</A>  &nbsp;&nbsp;&nbsp;
					<A HREF="?folder=admin&file=material_addstart"><IMG SRC="images/icon/book.gif"  BORDER="0" align="absmiddle"> คัดลอกจากการ์ดบัญชีวัสดุทั้งหมด</A>&nbsp;&nbsp;&nbsp;
					<A HREF="?folder=admin&file=material_addend"><IMG SRC="images/icon/userinfo.gif"  BORDER="0" align="absmiddle"> คัดลอกจากการ์ดบัญชีวัสดุี่แถวเดียวสุดท้าย</A>&nbsp;&nbsp;&nbsp;					
					<A HREF="?folder=admin&file=type_material"><IMG SRC="images/icon/folders.gif"  BORDER="0" align="absmiddle"> รายการหมวดหมู่วัสดุ</A> &nbsp;&nbsp;&nbsp;
					<A HREF="?folder=admin&file=type_material&op=type_material_add"><IMG SRC="images/icon/opendir.gif"  BORDER="0" align="absmiddle"> เพิ่มหมวดหมู่วัสดุ</A><BR><BR>

					
<?php  
  if($_GET['op'] == "type_material_add" AND $_GET['action'] == "add" AND !$ProcessOutput){
	
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);	                
					
					$res['type_name'] = $db->select_query("SELECT subtype_name FROM ".TB_STOCK_SUBTYPE." WHERE subtype_name ='".$_POST['subtype_name']."'");
	                $rows['type_name'] = $db->rows($res['type_name']);                     
					if(!$rows['type_name']){
		
	//ทำการเพิ่มข้อมูลลงดาต้าเบส
                     $db->add_db(TB_STOCK_SUBTYPE,array(
				     "subtype_name"=>"".$_POST['subtype_name']."",
				     "type_id"=>"".$_POST['type_id'].""
			         ));	
					 					 				
				    $ProcessOutput = "<br><br><center>ได้ทำการบันทึกข้อมูลประเภทย่อยวัสดุเรียบแล้ว" ;
					$ProcessOutput .= "  OK.</center>" ;
					
                    } else {
					$ProcessOutput ="มีข้อมูลประเภทย่อยวัสดุอยู่แล้ว";
					
					}
					

} else	if($_GET['op'] == "type_material_add" AND !$ProcessOutput){
	
?>
<SCRIPT LANGUAGE="javascript">
function Inint_AJAX() {
   try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
   try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
   try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
   alert("XMLHttpRequest not supported");
   return null;
};

function dochange(src, val) {
     //alert(src) ;
	 //alert(val) ;
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
function  type_stock_open()
   {
//  alert(form.sh_unit.value);
    window.open('psdloc/admin/type_stock_add.php','','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=400,height=200,left=330,top=200');
   }  
</script>

			<form name="stock_type" method=post action="?folder=admin&file=type_material&op=type_material_add&action=add" onSubmit="return check_typestock()" ENCTYPE="multipart/form-data">
			<b>เลือกประเภทวัสดุ :</b><br />
            <select name="type_id" onChange="dochange('stock_subtype', this.value)">
            	<option value="0" selected>-- กรุณาเลือกประเภทวัสดุ --</option>
<?php 
	            $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
				$res['stock_type']=$db->select_query("SELECT * FROM ".TB_STOCK_TYPE." ORDER BY type_id ");
				while($arr['stock_type']=$db->fetch($res['stock_type'])){
				
					echo "<option value=\"".$arr['stock_type']['type_id']."\">".$arr['stock_type']['type_name']."</option>";
				}
?>
            </select>&nbsp;&nbsp;<input  type="button" onClick="type_stock_open()" value="...">&nbsp;&nbsp;
			ประเภทย่อย :<font id="stock_subtype"><select><option value="0">------------------</option></select></font>&nbsp;ที่กำหนดแล้ว
			<br><br>
            <b>เพิ่มประเภทย่อยวัสดุ :</b><br />
			<input type="text" name="subtype_name" size="40">
			<br><br>
			<input type="submit" value=" เพิ่มหมวดหมู่ย่อยสินค้า ">
			</form><br><br>
<?php 
	
?>

<SCRIPT LANGUAGE="javascript">	
function check_typestock() {
if(document.stock_type.type_id.selectedIndex==0) {
alert("กรุณาเลือกประเภทวัสดุด้วยครับ") ;
document.stock_type.type_id.focus() ;
return false ;
}
else if(document.stock_type.subtype_name.value=="") {
alert("กรุณากรอกชื่อประเภทย่อยวัสดุด้วยครับ") ;
document.stock_type.subtype_name.focus() ;
return false ;
}
else 
return true ;
}	

</SCRIPT>

<?php 
}  else {

	echo $ProcessOutput ;
}	

if($_GET['op'] == "" AND !$ProcessOutput) {
$res['stock_type'] = $db->select_query("SELECT * FROM ".TB_STOCK_TYPE." ORDER BY type_id ");
?>
<center>
 <table width="80%" cellspacing="2" cellpadding="1" >
  <tr bgcolor="#99AA00" height=25>
   <td width="120"><font color="#FFFFFF"><b><center>แก้ไข / ลบ</center></b></font></td>
   <td><font color="#FFFFFF"><b>ประเภทวัสดุ</b></font></td>
   <td><font color="#FFFFFF"><b>ประเภทย่อยวัสดุ</b></font></td>
  </tr> 
<?php 
while($arr['stock_type'] = $db->fetch($res['stock_type'])){
$res['stock_subtype'] = $db->select_query("SELECT * FROM ".TB_STOCK_SUBTYPE." WHERE type_id='".$arr['stock_type']['type_id']."'");
$rows['stock_subtype'] = $db->rows($res['stock_subtype']); 
if($rows['stock_subtype']) {
?>
   <tr bgcolor="<?php echo $ColorFill; ?>" onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='<?php echo $ColorFill;?>' " height="18">
   <td align="center">
   <a href="?folder=admin&file=blog&op=article_edit&id=<?php  echo $arr['blog']['id'];?>"></a><img src="images/icon/edit.gif" border="0" alt="แก้ไข" >&nbsp;&nbsp; 
   <a href="javascript:Confirm('?folder=admin&file=blog&op=article_del&id=<?php  echo $arr['blog']['id'];?>&prefix=<?php  echo $arr['blog']['post_date'];?>','คุณมั่นใจในการลบหัวข้อนี้ ?');"></a><img src="images/icon/trash.gif"  border="0" alt="ลบ" >
   </td> 
   <td><?php echo $arr['stock_type']['type_name'];?></td>
   <td>ทั่วไป</td>
   </tr>
<?php 
while($arr['stock_subtype'] = $db->fetch($res['stock_subtype'])) {
?>  
   <tr bgcolor="<?php echo $ColorFill; ?>" onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='<?php echo $ColorFill;?>' " height="18">
   <td align="center">
   <a href="?folder=admin&file=blog&op=article_edit&id=<?php  echo $arr['blog']['id'];?>"></a><img src="images/icon/edit.gif" border="0" alt="แก้ไข" >&nbsp;&nbsp; 
   <a href="javascript:Confirm('?folder=admin&file=blog&op=article_del&id=<?php  echo $arr['blog']['id'];?>&prefix=<?php  echo $arr['blog']['post_date'];?>','คุณมั่นใจในการลบหัวข้อนี้ ?');"></a><img src="images/icon/trash.gif"  border="0" alt="ลบ" >
   </td> 
   <td><?php echo $arr['stock_type']['type_name'];?></td>
   <td><?php echo $arr['stock_subtype']['subtype_name'] ;?></td>
   </tr>
<?php  } } else { ?>  
  <tr bgcolor="<?php echo $ColorFill; ?>" onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='<?php echo $ColorFill;?>' " height="18">
   <td align="center">
   <a href="?folder=admin&file=blog&op=article_edit&id=<?php  echo $arr['blog']['id'];?>"></a><img src="images/icon/edit.gif" border="0" alt="แก้ไข" >&nbsp;&nbsp; 
   <a href="javascript:Confirm('?folder=admin&file=blog&op=article_del&id=<?php  echo $arr['blog']['id'];?>&prefix=<?php  echo $arr['blog']['post_date'];?>','คุณมั่นใจในการลบหัวข้อนี้ ?');"></a><img src="images/icon/trash.gif"  border="0" alt="ลบ" >
   </td> 
   <td><?php echo $arr['stock_type']['type_name'];?></td>
   <td>ทั่วไป</td>
   </tr>
<?php  } } ?>   
  </table>
</center>  
<?php 
} else {

	echo $ProcessOutput ;
}	
?>  

					</TD>
				</TR>
			</TABLE>
		</TD>
	  </TR>
	</TABLE>