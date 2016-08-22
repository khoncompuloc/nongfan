<?php
//			$data = iconv("TIS-620", "UTF-8", $_GET['data']);
			$val = iconv("TIS-620", "UTF-8", $_GET['val']);

			require_once("../../includes/config.in.php");
	  		$objConnect = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD) or die(mysql_error());
			$objDB = mysql_select_db(DB_NAME) or die ( "ไม่สามารถเชื่อมต่อฐานข้อมูลได้" );
			mysql_query( "SET NAMES utf8" , $objConnect );

     if ($val == '1') { 
	      $queryString_h = "หัวหน้า" ; 
		  $queryString_p = "ผู้อำนวยการ" ; 
          echo "<select name='position_id_elect'>\n";
          echo "<option value='0'>-เลือกหัวหน้าส่วน/ผอ.กอง-</option>\n";
		  $result = mysql_query("select * from ".TB_MEMBER_POSITION." WHERE position_name LIKE '$queryString_h%' AND parties_id ='4' order by position_id") or die ("Err Can not to result") ;
          while($row = mysql_fetch_array($result)){
               echo "<option value=\"$row[position_id]\" >$row[position_name]</option> \n" ;
          }
		  $result = mysql_query("select * from ".TB_MEMBER_POSITION." WHERE position_name LIKE '$queryString_p%' AND parties_id ='4' order by position_id") or die ("Err Can not to result") ;
          while($row = mysql_fetch_array($result)){
               echo "<option value=\"$row[position_id]\" >$row[position_name]</option> \n" ;
          }		  
     } else if ($val=='2') {
	      $queryString_h = "หัวหน้า" ; 
		  $queryString_p = "ผู้อำนวยการ" ; 
          echo "<select name='position_id_elect'>\n";
          echo "<option value='0'>---เลือกตำแหน่ง---</option>\n";                             
		  $result = mysql_query("SELECT * FROM ".TB_MEMBER_POSITION." WHERE position_name LIKE '$queryString_h%' AND parties_id ='4' order by position_id") or die ("Err Can not to result") ;
          while($row = mysql_fetch_array($result)){
               echo "<option value=\"$row[position_id]\" >$row[position_name]</option> \n" ;
          }
		  $result = mysql_query("SELECT * FROM ".TB_MEMBER_POSITION." WHERE position_name LIKE '$queryString_p%' AND parties_id ='4' order by position_id") or die ("Err Can not to result") ;
          while($row = mysql_fetch_array($result)){
               echo "<option value=\"$row[position_id]\" >$row[position_name]</option> \n" ;
          }		  
		  $result = mysql_query("SELECT * FROM ".TB_MEMBER_POSITION." WHERE parties_id ='1' OR parties_id ='3' order by position_id") or die ("Err Can not to result") ;
          while($row = mysql_fetch_array($result)){
               echo "<option value=\"$row[position_id]\" >$row[position_name]</option> \n" ;
          }		  
     } else if ($val=='3') {
          echo "<select name='position_id_elect'>\n";
          echo "<option value='0'>---เลือกตำแหน่ง---</option>\n";                             
		  $result = mysql_query("SELECT * FROM ".TB_MEMBER_POSITION." WHERE parties_id ='4'  ORDER BY position_name") or die ("Err Can not to result") ;
          while($row = mysql_fetch_array($result)){
		  $result_sec = mysql_query("SELECT * FROM ".TB_MEMBER_SECTION." WHERE section_id ='$row[section_id]' ") or die ("Err Can not to result") ;		  
		  $row_sec = mysql_fetch_array($result_sec) ;
               echo "<option value=\"$row[position_id]\" >$row[position_name]($row_sec[section_name])</option> \n" ;
          }
     } 
     echo "</select>\n";

mysql_close($objConnect); 

?>