<?
 		
//			$data = iconv("TIS-620", "UTF-8", $_GET['data']);
			$val = iconv("TIS-620", "UTF-8", $_GET['val']);


			require_once("../../includes/config.in.php");
	  		$objConnect = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD) or die(mysql_error());
			$objDB = mysql_select_db(DB_NAME) or die ( "ไม่สามารถเชื่อมต่อฐานข้อมูลได้" );
			mysql_query( "SET NAMES utf8" , $objConnect );

		    $result = mysql_query("select position_id, position_name from ".TB_MEMBER_POSITION." WHERE position_id = '$val' ") or die ("Err Can not to result") ;
            $row = mysql_fetch_array($result) ;
			       if($row) {
				    $position_str_h = $row['position_name'] ;
					$find_position_h = "หัวหน้า";
					$pos_h = strpos($position_str_h,$find_position_h);
				    $position_str_p = $row['position_name'] ;
					$find_position_p = "ผู้อำนวยการ";
					$pos_p = strpos($position_str_p,$find_position_p);					
					   if($pos_h!==FALSE or $pos_p!==FALSE){
					   echo "<SELECT NAME=\"elect\" disabled=\"disabled\">" ;
                       echo "<OPTION selected VALUE=\"0\">-------------------</OPTION>" ;
 	                   echo "</SELECT>&nbsp;" ;
					   echo "<select disabled=\"disabled\"><option value=\"0\">-------------------</</option></select>" ;
                       echo "<input type=\"hidden\" name=\"elect\" value=\"1\" />" ;					   
                       echo "<input type=\"hidden\" name=\"position_id_elect\" value=\"".$row['position_id']."\" />" ;					      

                       } else {
				       echo "<SELECT NAME=\"elect\" onChange=\"dochange_elect()\">" ;
                       echo "<OPTION selected VALUE=\"0\">-------------------</OPTION>" ;
                       echo "<OPTION VALUE=\"1\">หัวหน้าส่วน/กอง</OPTION>" ;
                       echo "<OPTION VALUE=\"2\">รักษาการ</OPTION>" ;
                       echo "<OPTION VALUE=\"3\">ปฏิบัติหน้าที่</OPTION>" ;
 	                   echo "</SELECT>&nbsp;" ;
					   echo "<font id=\"position_elect\">" ;
					   echo "<select><option value=\"0\">-------------------</</option>" ;
					   echo "</select></font>" ;
	   
					   }
				   } else {
				   echo "ไม่พบข้อมูลตำแหน่ง" ;
				   }

mysql_close($objConnect); 
?>