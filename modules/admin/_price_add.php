<html>
<head>
<title>psdloc</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<script language="javascript">
	function selData(form)
	{
		var line = frmMain.line.value ;
		self.opener.document.getElementById("disp_price_"+line).innerHTML="<font id='disp_price_"+line+"'><input type='text' name='sd_price_"+line+"' id='sd_price_"+line+"' size='8' style='text-align:center;' value='' OnChange='JavaScript:chkNum(this)' ></font>" ;

		var str = frmMain.head_from.value;
		//alert("str="+str) ;
		if(str == "") {
		var id = "new_price" ;		
		
		var shf_id = self.opener.document.getElementById("shf_price_id_"+line);
		shf_id.value = id ;	
        
		//alert("id ="+id);
		var sh_diff_focus = self.opener.document.getElementById("sd_price_"+line);
		sh_diff_focus.focus() ;	
 //       return false ;		

		} else {
		
		var fields = str.split(/-/);
		var price = fields[0];
		var id = fields[1];
         num = parseFloat(price);
         price = num.toFixed(2);
		 //alert("line ="+line);
		 //alert("price ="+price);
		 //alert("id ="+id);
		var sh_price = self.opener.document.getElementById("sd_price_"+line);
		sh_price.value = price ;

		var shf_id = self.opener.document.getElementById("shf_price_id_"+line);
		shf_id.value = id ;
		}

		window.close();
	}
	function clear_price()
	{
		var sh_price = self.opener.document.getElementById("sd_price_"+line);
		sh_price.value = "";
		window.close();
	}
	function close_price()
	{
	    window.close();
	}	
</script>
<?php
			$line = $_GET['line'] ;			
            $shb_id = $_GET['shb_id'] ;
			empty($_GET['shf_diff_id'])?$shf_diff_id="":$shf_diff_id=$_GET['shf_diff_id'] ;
			require_once("../../includes/config.in.php");
	  		$objConnect = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD) or die(mysql_error());
			$objDB = mysql_select_db(DB_NAME) or die ( "ไม่สามารถเชื่อมต่อฐานข้อมูลได้" );
			mysql_query( "SET NAMES utf8" , $objConnect );
            $result_hf = mysql_query("select shf_diff_name from ".TB_STOCK_HEAD_PRICE." where shf_id='".$shb_id."'") or die ("Err Can not to result") ;
			$row_hf = mysql_fetch_array($result_hf) ;
			//echo $shb_id ;
?>
</head>
<body>
<form NAME="frmMain" METHOD="post">
<table width="350" border="0" align="center">
  <tr>
    <td height="30" ><div align="center"><center> 
<?php 
		
		echo $row_hf['shf_diff_name']." - ".$shf_diff_id."<br>" ;
        $result = mysql_query("select * from ".TB_STOCK_HEAD_PRICE." where shb_id='".$shb_id."' and shf_diff_name='".$row_hf['shf_diff_name']."'") or die ("Err Can not to result") ;
		echo "<select name='head_from' id='head_from' onChange='selData(this.form);'>" ;
		echo "<option value=''>--ราคา--</option>" ;
		while($row = mysql_fetch_array($result)){
               echo "<option value='".$row['shf_price']."-".$row['shf_id']."' >".$row['shf_price']." บาท (".$row['shf_diff_name']." )</option> \n" ;
          }    
		       echo "<option value='' >คีย์ราคาใหม่</option> \n" ;
?>
		</select></center> </div>
		<input name="line" type="hidden" value="<?php echo $line ;?>" />
    </td>
  </tr>
  <tr><td height="25"></td></tr>
  <tr><td height="30" ><div align="center"><center>
  <input  type="button" onClick="clear_price();" value="เครียข้อมูล">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input  type="button" onClick="close_price();" value="ปิดหน้าต่างนี้">
  </center></div></td></tr>
</table>
</form>
<?php
mysql_close($objConnect);
?>
</body>
</html>