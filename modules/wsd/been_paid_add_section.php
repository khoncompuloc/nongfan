<html>
<head>
<title>psdloc</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">

<script language="javascript">
	function selData(form)
	{
        var ss_logic = frmMain.ss_logic_hidden.value ;
/***		
		if (ss_logic==1) {
        self.opener.document.getElementById("ss_name_area").innerHTML="<input type=\"text\" name=\"ss_name_1\" id=\"ss_name_1\" size=\"30\" value=\"\">";				
		var ss_name = self.opener.document.getElementById("ss_name_"+frmMain.been_paid_hidden.value);
		ss_name.value = frmMain.been_paid.value;
		var sh_unit = self.opener.document.getElementById("tCalendar_"+frmMain.been_paid_hidden.value);
		sh_unit.value = frmMain.tCalendar.value;
		var ssh_date = self.opener.document.getElementById("sh_date_"+frmMain.been_paid_hidden.value);
		ssh_date.value = frmMain.ss_date.value;		
		self.opener.document.getElementById("Calendar").innerHTML="<IMG SRC=\"images/dateselect.gif\" BORDER=\"0\" ALT=\"เลือกวันที่\"   align=\"absmiddle\" disabled>";	
		//var sd_section_id = self.opener.document.getElementById("sd_section_id_"+frmMain.been_paid_hidden.value);
		//sd_section_id.value = 0 ;		
        } else {
***/			
		if (ss_logic==0) {
		var str = frmMain.been_paid.value;
		var fields = str.split(/-/);
		var name = fields[0];
		var member_id = fields[1];
	    //alert(name);
		//alert(member_id);	
        self.opener.document.getElementById("ss_name_area").innerHTML="<input type=\"text\" name=\"ss_name_1\" id=\"ss_name_1\" size=\"30\" value=\"\">";	
		var ss_name = self.opener.document.getElementById("ss_name_"+frmMain.been_paid_hidden.value);
		ss_name.value = name;		
		var ss_member_id = self.opener.document.getElementById("member_id_"+frmMain.been_paid_hidden.value);
		ss_member_id.value = member_id;				
		}
		window.close();
	}
	function clear_unit(form)
	{
		var sh_unit = self.opener.document.getElementById("ss_name_"+frmMain.been_paid_hidden.value);
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
            $ss_logic = $_GET['ss_logic'];	
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
/***
		if($ss_logic==1) {
		$data_value = "รับจาก" ;
        //$result = mysql_query("select shop_name from ".TB_SHOP." order by shop_name") or die ("Err Can not to result") ;
		echo $data_value." : " ;
		echo "<SELECT NAME=\"been_paid\" ID=\"been_paid\" onChange=\"selData(this.form);\">" ;
		echo "<OPTION VALUE=\"\">----เลือก----</OPTION>" ;
		//while($row = mysql_fetch_array($result)){
               echo "<option value=\"ยอดยกมา\" >ยอดยกมา</option> \n" ;
        //  }    
		    //   echo "<option value=\"ยอดยกมา\" >ยอดยกมา</option> \n" ;
		} else
***/
		if($ss_logic==0) {
		$data_value = "จ่ายให้" ;
		$configs = mysql_query("select posit ,name from ".TB_CONFIG." order by id") or die ("Err Can not to result") ;
		while($arr = mysql_fetch_array($configs)){
		if ($arr['posit']=='wsd_card'){ define("WEB_WSD_CARD",$arr['name']);}
		}
		if(WEB_WSD_CARD == 1) {
        $result = mysql_query("select prefix ,fname, lname, member_id from ".TB_MEMBER." where  parties_id='4' order by fname") or die ("Err Can not to result") ;
		} else if(WEB_WSD_CARD == 2) {
		$result = mysql_query("select prefix ,fname, lname, member_id from ".TB_MEMBER." where  parties_id='4' and section_id=".$section_id." order by fname") or die ("Err Can not to result") ;
		}
		$result_p = mysql_query("select prefix ,fname, lname, member_id from ".TB_MEMBER." where  parties_id='3' order by member_id") or die ("Err Can not to result") ;
		echo $data_value." : " ;
		echo "<SELECT NAME=\"been_paid\" ID=\"been_paid\" onChange=\"selData(this.form);\">" ;
		echo "<OPTION VALUE=\"\">----เลือก----</OPTION>" ;
		while($row_p = mysql_fetch_array($result_p)){
		?>
               <option value="<?php echo $row_p['prefix'].$row_p['fname']."  ".$row_p['lname']."-".$row_p['member_id'] ; ?>"><?php echo "&nbsp;&nbsp;".$row_p['fname']."   ".$row_p['lname'] ;?></option>
        <?php  
		  }			
		while($row = mysql_fetch_array($result)){
		?>
               <option value="<?php echo $row['prefix'].$row['fname']."  ".$row['lname']."-".$row['member_id'] ; ?>"><?php echo "&nbsp;&nbsp;".$row['fname']."   ".$row['lname'] ;?></option>
        <?php  
		  }		 
		 }
		?>
		</SELECT></center> </div>
		<input name="been_paid_hidden" type="hidden" value="<?php echo $line ;?>" />
		<input name="ss_logic_hidden" type="hidden" value="<?php echo $ss_logic ;?>" />
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