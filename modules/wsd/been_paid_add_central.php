<html>
<head>
<title>psdloc</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">

<script language="javascript">
	function selData(form)
	{
        var sc_logic = frmMain.sc_logic_hidden.value ;
		//alert(sc_logic);
		if (sc_logic==1) {
		var sc_name = self.opener.document.getElementById("sc_name_"+frmMain.been_paid_hidden.value);
		sc_name.value = frmMain.been_paid.value;
        } 
		window.close();		
	}
	function clear_unit(form)
	{
		var sh_unit = self.opener.document.getElementById("sc_name_"+frmMain.been_paid_hidden.value);
		sh_unit.value = "";
		window.close();
	}
	function close_unit()
	{
	    window.close();
	}	
</script>
<?php
//			$sh_unit=$_GET["$sh_unit"];
			$line = $_GET['line'];//iconv("TIS-620", "UTF-8", 			
            $sc_logic = $_GET['sc_logic'];	
            //empty($section_id)?$section_id="":$section_id=$section_id."," ;
			require_once("../../includes/config.in.php");
	  		$objConnect = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD) or die(mysql_error());
			$objDB = mysql_select_db(DB_NAME) or die ( "ไม่สามารถเชื่อมต่อฐานข้อมูลได้" );
			mysql_query( "SET NAMES utf8" , $objConnect );
            
?>
</head>
<body>
<form NAME="frmMain" METHOD="post">
<table width="350" border="0" align="center">
  <tr>
    <td height="30" colspan="2" ><div align="center"><center>
	     

		<?php
		if($sc_logic==1) {
		$data_value = "รับจาก" ;
        $result = mysql_query("select shop_name from ".TB_SHOP." order by shop_name") or die ("Err Can not to result") ;
		echo $data_value." : " ;
		echo "<select name=\"been_paid\" id=\"been_paid\" onChange=\"selData(this.form);\">" ;
		echo "<OPTION VALUE=\"\">----เลือก----</OPTION>" ;
		while($row = mysql_fetch_array($result)){
               echo "<option value=\"$row[shop_name]\" >$row[shop_name]</option> \n" ;
          }    
		} 
		?>
		</select></center> </div>
		<input name="been_paid_hidden" type="hidden" value="<?php echo $line ;?>" />
		<input name="sc_logic_hidden" type="hidden" value="<?php echo $sc_logic ;?>" />
    </td>
  </tr>
  <tr><td height="25"></td><td></td></tr>
  <tr><td height="30" colspan="2" ><div align="center"><center>
  <input  type="button" onClick="clear_unit(this.form);" value="เครียข้อมูล<?php echo $data_value ;?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input  type="button" onClick="close_unit();" value="ปิดหน้าต่างนี้">
  </center></div></td></tr>
</table>
</form>
<?php
mysql_close($objConnect);
?>
</body>
</html>