<html>
<head>
<title>psdloc</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">

<script language="javascript">
	function selData(form)
	{
		var sh_unit = self.opener.document.getElementById("sd_name_"+frmMain.line.value);
		sh_unit.value = frmMain.been_paid.value;

		window.close();
	}
	function clear_unit(form)
	{
		var sh_unit = self.opener.document.getElementById("sd_name_"+frmMain.line.value);
		sh_unit.value = "";
		window.close();
	}
	function close_unit()
	{
	    window.close();
	}	
</script>
<?
			$line = iconv("TIS-620", "UTF-8", $_GET['line']);			
			require_once("../../includes/config.in.php");
	  		$objConnect = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD) or die(mysql_error());
			$objDB = mysql_select_db(DB_NAME) or die ( "ไม่สามารถเชื่อมต่อฐานข้อมูลได้" );
			mysql_query( "SET NAMES utf8" , $objConnect );
?>
</head>
<body>
<table width="350" border="0" align="center">
<form NAME="frmMain" METHOD="post">
  <tr>
    <td height="30" colspan="2" ><div align="center"><center>
		<?
		$data_value = "รับจาก" ;
        $result = mysql_query("select shop_name from ".TB_SHOP." order by shop_name") or die ("Err Can not to result") ;
		echo $data_value." : " ;
		echo "<SELECT NAME=\"been_paid\" ID=\"been_paid\" onChange=\"selData(this.form);\">" ;
		echo "<OPTION VALUE=\"\">----เลือก----</OPTION>" ;
		while($row = mysql_fetch_array($result)){
               echo "<option value=\"$row[shop_name]\" >$row[shop_name]</option> \n" ;
          }    

		?>
		</SELECT></center> </div>
		<input name="line" type="hidden" value="<?=$line ;?>" />
    </td>
  </tr>
  <tr><td height="25"></td><td></td></tr>
  <tr><td height="30" colspan="2" ><div align="center"><center>
  <input  type="button" onClick="clear_unit(this.form);" value="เครียข้อมูล<?=$data_value ;?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input  type="button" onClick="close_unit();" value="ปิดหน้าต่างนี้">
  </center></div></td></tr>
</form>
</table>
<?
mysql_close($objConnect);
?>
</body>
</html>