<?php
    header("content-type: text/html; charset=utf-8");
    header ("Expires: Wed, 21 Aug 2019 13:13:13 GMT");
    header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");

	
			require_once("../../includes/config.in.php");
	  		$objConnect = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD) or die(mysql_error());
			$objDB = mysql_select_db(DB_NAME) or die ( "ไม่สามารถเชื่อมต่อฐานข้อมูลได้" );
			mysql_query( "SET NAMES utf8" , $objConnect );

	$data = $_GET['data'];
	$val = $_GET['val'];

     if ($data=='stock_type') { 
          echo "<select name='type_id' onChange=\"dochange('stock_subtype', this.value)\">";
          echo "<option value='0'>----เลือกประเภทวัสดุ----</option>\n";
		  $result = mysql_query("select * from ".TB_STOCK_TYPE." order by type_id") or die ("Err Can not to result");
          while($row = mysql_fetch_array($result)){
               echo "<option value='$row[type_id]' >$row[type_name]</option>";
          }
     } else if ($data=='stock_subtype') {
          echo "<select name='subtype_id'>";
          echo "<option value='0'>--เลือกย่อยประเภทวัสดุ--</option>\n";                             
		  $result = mysql_query("SELECT * FROM ".TB_STOCK_SUBTYPE." WHERE type_id= '$val' ORDER BY subtype_id") or die ("Err Can not to result");
          //$result=mysql_db_query($dbname,"SELECT * FROM amphur WHERE PROVINCE_ID= '$val' ORDER BY AMPHUR_NAME");
          while($row = mysql_fetch_array($result)){
               echo "<option value=\"$row[subtype_id]\" >$row[subtype_name]</option>\n";
          }
     } 
     echo "</select>";

mysql_close($objConnect); 
?>