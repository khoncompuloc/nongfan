<html>
<head>
<title>psdloc</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">

<script language="javascript">
	function selData(form)
	{
		var line = frmMain.line.value ;
		self.opener.document.getElementById("disp_diff_name_"+line).innerHTML="<font id=\"disp_diff_name_"+line+"\"><input type=\"text\" name=\"shf_diff_name_"+line+"\" id=\"shf_diff_name_"+line+"\" size=\"20\" value=\"\"></font>" ;

		var str = frmMain.head_from.value;
		if(str == "") {
		var id = "new_diff" ;		
		
		var shf_id = self.opener.document.getElementById("shf_diff_id_"+line);
		shf_id.value = id ;	

		var sh_diff_focus = self.opener.document.getElementById("shf_diff_name_"+line);
		sh_diff_focus.focus() ;	
 //       return false ;		

		} else {
		
		var fields = str.split(/-/);
		var name = fields[0];
		var id = fields[1];

		var sh_diff_name = self.opener.document.getElementById("shf_diff_name_"+line);
		sh_diff_name.value = name ;

		var shf_id = self.opener.document.getElementById("shf_diff_id_"+line);
		shf_id.value = id ;
		}

		window.close();
	}
	function clear_diff_name()
	{
		var diff_name = self.opener.document.getElementById("shf_diff_name_"+line);
		diff_name.value = "";
		window.close();
	}
	function close_unit()
	{
	    window.close();
	}	
</script>
<?
			$line = iconv("TIS-620", "UTF-8", $_GET['line']);			
            $sh_id = iconv("TIS-620", "UTF-8", $_GET['sh_id']);	
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
    <td height="30" ><div align="center"><center>
		<?
        $result = mysql_query("select * from ".TB_STOCK_HEAD_PRICE." where sh_id='".$sh_id."' and shf_diff_name <> '' ") or die ("Err Can not to result") ;
		echo "<SELECT NAME=\"head_from\" ID=\"head_from\" onChange=\"selData(this.form);\">" ;
		echo "<OPTION VALUE=\"\">----เลือก----</OPTION>" ;
		while($row = mysql_fetch_array($result)){
               echo "<option value=\"$row[shf_diff_name]-$row[shf_id]\" >$row[shf_diff_name]</option> \n" ;
          }    
		       echo "<option value=\"\" >คีย์ขนาดหรือลักษณะใหม่</option> \n" ;
		?>
		</SELECT></center> </div>
		<input name="line" type="hidden" value="<?=$line ;?>" />
    </td>
  </tr>
  <tr><td height="25"></td></tr>
  <tr><td height="30" ><div align="center"><center>
  <input  type="button" onClick="clear_diff_name();" value="เครียข้อมูล">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input  type="button" onClick="close_unit();" value="ปิดหน้าต่างนี้">
  </center></div></td></tr>
</form>
</table>
<?
mysql_close($objConnect);
?>
</body>
</html>