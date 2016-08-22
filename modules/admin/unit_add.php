<html>
<head>
<title>psdloc</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">

<script language="javascript">
	function selData(form)
	{
		var sh_unit = self.opener.document.getElementById("sh_unit");
		sh_unit.value = frmMain.unit.value;
		window.close();
	}
	function clear_unit()
	{
	    var sh_unit = self.opener.document.getElementById("sh_unit");
		sh_unit.value = "";
		window.close();
	}
	function close_unit()
	{
	    window.close();
	}
</script>
<?
			require_once("../../includes/config.in.php");
	  		$objConnect = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD) or die(mysql_error());
			$objDB = mysql_select_db(DB_NAME) or die ( "ไม่สามารถเชื่อมต่อฐานข้อมูลได้" );
			mysql_query( "SET NAMES utf8" , $objConnect );
            $result = mysql_query("select * from ".TB_STOCK_UNIT." order by unit_name") or die ("Err Can not to result") ;
?>
</head>
<body>
<table width="350" border="0" align="center">
<form NAME="frmMain" METHOD="post">
  <tr>
    <td height="30" colspan="2" ><div align="center"><center>
		<SELECT NAME="unit" ID="unit" onChange="selData(this.form);">
		<OPTION VALUE="">---เลือกหน่วยนับ---</OPTION>
		<?
          while($row = mysql_fetch_array($result)){
               echo "<option value=\"$row[unit_name]\" >$row[unit_name]</option> \n" ;
          }
		?>
		</SELECT></center></div>
    </td>
  </tr>
  <tr><td height="25"></td><td></td></tr>
  <tr><td height="30" colspan="2" ><div align="center"><center>
  <input  type="button" onClick="clear_unit();" value="เครียหน่วยนับ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input  type="button" onClick="close_unit();" value="ปิดหน้าต่างนี้">
  </center></div></td></tr>
</form>
</table>
<?
mysql_close($objConnect);
?>
</body>
</html>