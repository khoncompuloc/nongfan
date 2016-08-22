<html>
<head>
<title>psdloc</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">

<script language="javascript">
	function selData(form)
	{
		var line = frmMain.line.value ;
		self.opener.document.getElementById("disp_diff_name_"+line).innerHTML="<font id=\"disp_diff_name_"+line+"\"><input type=\"text\" name=\"shf_diff_name_"+line+"\" id=\"shf_diff_name_"+line+"\" size=\"20\" value=\"\"></font>" ;

		var sh_diff_focus = self.opener.document.getElementById("shf_diff_name_"+line);
		sh_diff_focus.focus() ;	

		window.close();
	}
	function clear_diff_name(form)
	{
		var sh_diff_name = self.opener.document.getElementById("shf_diff_name_"+line);
		sh_diff_name.value = "";
		window.close();
	}
	function close_diff(form)
	{
	    var line = frmMain.line.value ;
	    //alert(line);
		self.opener.document.getElementById("disp_diff_name_"+line).innerHTML="<font id=\"disp_diff_name_"+line+"\"><input type=\"text\" name=\"shf_diff_name_"+line+"\" id=\"shf_diff_name_"+line+"\" size=\"20\" value=\"\" disabled></font>" ;			
	    window.close();
	}	
</script>
<?
			$line = iconv("TIS-620", "UTF-8", $_GET['line']);			
            $sh_diff_name = iconv("TIS-620", "UTF-8", $_GET['sh_diff_name']);	
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
        if($sh_diff_name == "") {
		echo "ยังไม่ได้กำหนดขนาดหรือลักษณะ<br><br>" ;
		echo "<input  type=\"button\" onClick=\"selData(this.form);\" value=\"คีย์ขนาดหรือลักษณะ\">" ;
		} else {
		echo "ได้กำหนดขนาดหรือลักษณะจากข้างบนแล้ว<br><br>" ;
		echo "<input  type=\"button\" onClick=\"close_diff(this.form);\" value=\" ปิดหน้าต่างนี้ \">" ;
		}

		?>
		</SELECT></center> </div>
		<input name="line" type="hidden" value="<?=$line ;?>" />
    </td>
  </tr>
  <tr><td height="25"></td></tr>
  <tr><td height="30" ><div align="center"><center>
  <input  type="button" onClick="clear_diff_name(this.form);" value="เครียข้อมูล">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </center></div></td></tr>
</form>
</table>
<?
// mysql_close($objConnect);
?>
</body>
</html>