<html>
<head>
<title>psdloc</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">

<script language="javascript">
	function selData(form)
	{
        var sd_logic = frmMain.sd_logic_hidden.value ;
		
		if (sd_logic==1) {
		var sh_unit = self.opener.document.getElementById("sd_name_"+frmMain.been_paid_hidden.value);
		sh_unit.value = frmMain.been_paid.value;
		var sd_section_id = self.opener.document.getElementById("sd_section_id_"+frmMain.been_paid_hidden.value);
		sd_section_id.value = 0 ;		
        } else {
		var str = frmMain.been_paid.value;
		var fields = str.split(/-/);
		var name = fields[0];
		var section_id = fields[1];
//		alert(name);
//		alert(section_id);		
		var sd_name = self.opener.document.getElementById("sd_name_"+frmMain.been_paid_hidden.value);
		sd_name.value = name;		
		var sd_section_id = self.opener.document.getElementById("sd_section_id_"+frmMain.been_paid_hidden.value);
		sd_section_id.value = section_id;				
		}
		window.close();
	}
	function clear_unit(form)
	{
		var sh_unit = self.opener.document.getElementById("sd_name_"+frmMain.been_paid_hidden.value);
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
            $sd_logic = $_GET['sd_logic'];	
			$section_id = $_GET['section_id'];
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
		if($sd_logic==1) {
		$data_value = "รับจาก" ;
        //$result = mysql_query("select shop_name from ".TB_SHOP." order by shop_name") or die ("Err Can not to result") ;
		echo $data_value." : " ;
		echo "<SELECT NAME=\"been_paid\" ID=\"been_paid\" onChange=\"selData(this.form);\">" ;
		echo "<OPTION VALUE=\"\">----เลือก----</OPTION>" ;
		//while($row = mysql_fetch_array($result)){
               echo "<option value=\"ยอดยกมา\" >ยอดยกมา</option> \n" ;
        //  }    
		    //   echo "<option value=\"ยอดยกมา\" >ยอดยกมา</option> \n" ;
		} else if($sd_logic==0) {
		$data_value = "จ่ายให้" ;
		if($section_id==0) {
        $result = mysql_query("select fname, lname, section_id from ".TB_MEMBER." where  parties_id='4' order by fname") or die ("Err Can not to result") ;
		} else {
		$result = mysql_query("select fname, lname, section_id from ".TB_MEMBER." where  parties_id='4' and section_id=".$section_id." order by fname") or die ("Err Can not to result") ;
		}
		echo $data_value." : " ;
		echo "<SELECT NAME=\"been_paid\" ID=\"been_paid\" onChange=\"selData(this.form);\">" ;
		echo "<OPTION VALUE=\"\">----เลือก----</OPTION>" ;
		while($row = mysql_fetch_array($result)){
		?>
               <option value="<?php echo $row['fname']."-".$row['section_id'] ; ?>"><?php echo "&nbsp;&nbsp;".$row['fname']."   ".$row['lname'] ;?></option>
        <?php  
		  }		 
		 }
		?>
		</SELECT></center> </div>
		<input name="been_paid_hidden" type="hidden" value="<?php echo $line ;?>" />
		<input name="sd_logic_hidden" type="hidden" value="<?php echo $sd_logic ;?>" />
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