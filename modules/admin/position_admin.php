<?php
 			$data = iconv("TIS-620", "UTF-8", $_GET['data']);
			$val = iconv("TIS-620", "UTF-8", $_GET['val']);
			require_once("../../includes/config.in.php");
	  		$objConnect = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD) or die(mysql_error());
			$objDB = mysql_select_db(DB_NAME) or die ( "ไม่สามารถเชื่อมต่อฐานข้อมูลได้" );
			mysql_query( "SET NAMES utf8" , $objConnect );
      if ($data=='parties') { 
          echo "<select name='parties_id' onChange=\"dochange2('section', this.value)\">\n";
          echo "<option value='0'>----เลือกฝ่าย----</option>\n";
		  echo "<option value='1'>บริหาร</option>\n";
		  echo "<option value='3'>หัวหน้าสำนักงาน</option>\n";
		  echo "<option value='4'>พนักงานราชการหรือลูกจ้าง</option>\n";
//		  $result = mysql_query("SELECT * FROM ".TB_MEMBER_PARTIES." ORDER BY parties_id") or die ("Err Can not to result") ;

//          while($row = mysql_fetch_array($result)){
//               echo "<option value=\"$row[parties_id]\" >$row[parties_name]</option> \n" ;
//         }
 	 }  else if ($data=='section') {
	             if ($val==4) {
          echo "<select name='section_id' onChange=\"dochange2('position', this.value)\">\n";
          echo "<option value='0'>----เลือกส่วนงาน----</option>\n";                             
		  $result = mysql_query("SELECT * FROM ".TB_MEMBER_SECTION." WHERE parties_id= '$val' ORDER BY section_id") or die ("Err Can not to result") ;
          while($row = mysql_fetch_array($result)){
               echo "<option value=\"$row[section_id]\" >$row[section_name]</option> \n" ;
          }
		  echo "</select>\n";
		  echo "<input type=\"button\" onClick=\"section_Open()\" value=\" ... \">";
		} else  {
 		  echo "<select name='position_id'>\n";
          echo "<option value='0'>----เลือกตำแหน่ง----</option>\n"; 
		  	  $result = mysql_query("SELECT * FROM ".TB_MEMBER_POSITION." WHERE parties_id= '$val' ORDER BY position_id") or die ("Err Can not to result") ;
          while($row = mysql_fetch_array($result)){
               echo "<option value=\"$row[position_id]\" >$row[position_name]</option> \n" ;
          } 
		  echo "</select>\n";
		  echo "<input type=\"button\" onClick=\"position_Open(form)\" value=\" ... \">";
		}
     } else if ($data=='position') {
          echo "<select name='position_id' onChange=\"dochange_position(this.value)\">\n";
          echo "<option value='0'>----เลือกตำแหน่ง----</option>\n";
		  $result = mysql_query("SELECT * FROM ".TB_MEMBER_POSITION." WHERE section_id= '$val' OR parties_id= '3' ORDER BY position_id") or die ("Err Can not to result") ;
          while($row = mysql_fetch_array($result)){
               echo "<option value=\"$row[position_id]\" >$row[position_name]</option> \n" ;
          }
		  echo "</select>\n";
		  echo "<input type=\"button\" onClick=\"position_Open(form)\" value=\" ... \">";
          }
mysql_close($objConnect); 
?>