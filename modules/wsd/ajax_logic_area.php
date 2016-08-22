<?php 		
    		$data = $_GET['data']; //iconv("TIS-620", "UTF-8", 
			$val  = $_GET['val'];

			require_once("../../includes/config.in.php");
	  		$objConnect = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD) or die(mysql_error());
			$objDB = mysql_select_db(DB_NAME) or die ( "ไม่สามารถเชื่อมต่อฐานข้อมูลได้" );
			mysql_query( "SET NAMES utf8" , $objConnect );
			
			if($val == 0) {
			
		    $result = mysql_query("SELECT * FROM ".TB_STOCK_HEAD_PRICE." WHERE shs_id = '$data' AND shp_amountcost <> 0 ") or die ("Err Can not to result") ;
            echo "จำนวนเหลือ (ราคา) ขนาดหรือลักษณะ : ";			
            echo "<select name='shp_id' id='shp_id' >\n";
			echo "<option value=''>---เลือก---</option>\n";
			while($row = mysql_fetch_array($result)) {
            echo "<option value=".$row['shp_id']."><b>".$row['shp_amountcost']."</b>&nbsp;(".$row['shp_price']." บาท) ".$row['shp_diff_name']."</option>\n";
            }
            echo "</select>\n";
            echo "<br><br>"; 
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จ่ายจำนวน  : ";
			echo "<input type='text' size='10' value='' name='ss_amount' id='ss_amount' style='text-align:center;' class='requist_form' />";
			
			} else if($val == 1) {
			
		    $result = mysql_query("SELECT shs_id ,section_id FROM ".TB_STOCK_HEAD_SECTION." WHERE shs_id = '$data' ") or die ("Err Can not to result") ;			
			$row = mysql_fetch_array($result) ;
            //       if($row['shs_diff_name'] == "") { 	
				   echo "กำหนดหลาย ขนาด/ลักษณะ :&nbsp;<font id='disp_diff_name_1'>" ;
	               echo "<input type='text' name='shp_diff_name_1' id='shp_diff_name_1' value=''>" ;
	               echo "</font>&nbsp;<input type='button' onClick='#' value='...'><br><br>" ;
	               echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;
				   echo "เอกสารเลขที่ :&nbsp;<input type='text' name='ss_ref_1' id='ss_ref_1' size='20' value=''>" ;
				   echo "<input type='hidden' name='shp_diff_id_1' id='shp_diff_id_1' value=''><br><br>" ;
	        //       } else  {	
            //       echo "ขนาด/ลักษณะ :2ไม่ว่าง<input type='text'  size='20' value='".$row['shs_diff_name']." disabled>" ;
	        //       echo "<input type='hidden' name='shp_diff_id_1' id='shp_diff_id_1' value=''>" ;
	        //       echo "<input type='hidden' name='shp_diff_name_1' id='shp_diff_name_1' value=''>" ;
			//	   echo	"&nbsp;&nbsp;เอกสารเลขที่ :<input type='text' name='ss_ref_1' id='ss_ref_1' size='20' value=''><br><br>" ;
            //       } 
				   
				   //กำหนดราคา
                   echo "<FONT COLOR='#FF0000'>ราคา</FONT>/หน่วย&nbsp;:&nbsp;" ;
				   echo "<font id='disp_price_1'>" ;
				   echo "<input type='text' size='8' value='คลิกราคา->'  disabled >" ;
				   //echo "<input type='hidden' name='ss_price_1' id='ss_price_1'  value=''>" ;
				   echo "</font>&nbsp;&nbsp;&nbsp;<input  type='button' onClick='price_open(1);' value='...'>" ;
				   
				   //กำหนดจำนวน
	               echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวน&nbsp;:<input type='text' name='ss_amount_1' id='ss_amount_1' size='8' style='text-align:center;' value=''>" ;
				   echo "<input type='hidden' name='shp_price_id_1' id='shp_price_id_1' size='3' value=''>" ;
				   echo "<input type='hidden' name='section_id' id='section_id' size='5' value='".$row['section_id']."'>" ;
				   echo "<input type='hidden' name='shs_id' id='shs_id' size='5' value='".$row['shs_id']."'>" ;


				   echo "<input type='hidden' name='shp_id' id='shp_id' size='5' value='123'>" ;
				   echo "<input type='hidden' name='ss_amount' id='ss_amount' size='5' value='321'>" ;
			}
            mysql_close($objConnect); 
?>