<html>
<head>
<title>psdloc</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<script language="javascript">

	function close_typename()
	{
       window.opener.location.reload();
       setTimeout("self.close()",(2 * 1000));	   
	   window.close();
	}	
	function close_win()
	{
 	   window.close();
	}		
	function check_typename() {
     if(document.frmMain.type_name.value == "") {
     alert("กรุณากรอบประเภทวัสดุด้วยครับ") ;
     document.frmMain.type_name.focus() ;
      return false ;
    }
     else 
     return true ;
    }

</script>
</head>
<?
if($_GET['action'] == "add") {
			require_once("../../includes/config.in.php");
	  		$objConnect = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD) or die(mysql_error());
			$objDB = mysql_select_db(DB_NAME) or die ( "ไม่สามารถเชื่อมต่อฐานข้อมูลได้" );
			mysql_query( "SET NAMES utf8" , $objConnect );
			
 
			$sql = "INSERT INTO ".TB_STOCK_TYPE." (type_name) VALUES ('".$_POST['type_name']."')" ;
			$result = mysql_query($sql) or die ("Err Can not to result") ;
			
						
			mysql_close($objConnect);
			
			$ProcessOutput .= "<br><br><center>";
			$ProcessOutput .= "ได้เพิ่มชื่อประเภทวัสดุใหม่เรียบร้อยแล้ว";
			$ProcessOutput .= "<br><br><input  type=\"button\" onClick=\"close_typename();\" value=\"ปิดหน้าต่างนี้\"></center>";

}
if(!$ProcessOutput) {		
?>
<body><br><br>
<table width="350" border="0" align="center">
<form NAME="frmMain" METHOD="post"ACTION="type_stock_add.php?action=add" onSubmit="return check_typename()">
  <tr>
    <td height="30" colspan="2" >
	<div align="center"><center>
        เพิ่มประเภทวัสดุ 	:<input  type="text" name="type_name" id="type_name" value="" size="20">
    </div>
    </td>
  </tr>
  <tr><td height="25"></td><td></td></tr>
  <tr><td height="30" colspan="2" ><div align="center"><center>
  <input  type="reset" name="reset" id="reset" value="เครียข้อมูล">&nbsp;&nbsp;&nbsp;
  <input  type="submit" name="submit" id="submit" value="บันทึกประเภทวัสดุ" >&nbsp;&nbsp;&nbsp;
  <input  type="button" onClick="close_win();" value="ปิดหน้าต่างนี้">
  </center></div></td></tr>
</form>
</table>
</body>
<? } else echo $ProcessOutput ?>
</html>