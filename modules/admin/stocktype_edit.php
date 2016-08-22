<?
 		
			$data = iconv("TIS-620", "UTF-8", $_GET['data']);
			$val = iconv("TIS-620", "UTF-8", $_GET['val']);


			require_once("../../includes/config.in.php");
	  		$objConnect = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD) or die(mysql_error());
			$objDB = mysql_select_db(DB_NAME) or die ( "ไม่สามารถเชื่อมต่อฐานข้อมูลได้" );
			mysql_query( "SET NAMES utf8" , $objConnect );

     if ($data=='stock_subtype_edit') {
          echo "<select name='subtype_id'>\n";
          echo "<option value='0'>ทั่วไป</option>\n";                             
		  $result = mysql_query("SELECT * FROM ".TB_STOCK_SUBTYPE." WHERE type_id= '$val' ORDER BY subtype_id") or die ("Err Can not to result") ;
          //$result=mysql_db_query($dbname,"SELECT * FROM amphur WHERE PROVINCE_ID= '$val' ORDER BY AMPHUR_NAME");
          while($row = mysql_fetch_array($result)){
               echo "<option value=\"$row[subtype_id]\" >$row[subtype_name]</option> \n" ;
          }
     } 
     echo "</select>\n";

mysql_close($objConnect); 

?>