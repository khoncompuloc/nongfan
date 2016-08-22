<?php 		
    		$data = $_GET['data']; //iconv("TIS-620", "UTF-8", 
			$val  = $_GET['val'];

			require_once("../../includes/config.in.php");
	  		$objConnect = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD) or die(mysql_error());
			$objDB = mysql_select_db(DB_NAME) or die ( "ไม่สามารถเชื่อมต่อฐานข้อมูลได้" );
			mysql_query( "SET NAMES utf8" , $objConnect );
			
			if($val == 0) {
			
		    $result = mysql_query("SELECT * FROM ".TB_STOCK_HEAD_PRICE." WHERE shb_id = '$data' AND shf_amountcost <> 0 ") or die ("Err Can not to result") ;
            echo "จำนวนเหลือ (ราคา) ขนาดหรือลักษณะ : ";			
            echo "<select name='shf_id' id='shf_id' >\n";
			echo "<option value=''>---เลือก---</option>\n";
			while($row = mysql_fetch_array($result)) {
            echo "<option value=".$row['shf_id']."><b>".$row['shf_amountcost']."</b>&nbsp;(".$row['shf_price']." บาท) ".$row['shf_diff_name']."</option>\n";
            }
            echo "</select>\n";
            echo "<br><br>"; 
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จ่ายจำนวน  : ";
			echo "<input type='text' size='10' value='' name='sd_amount' id='sd_amount' style='text-align:center;' class='requist_form' />";
			
			} else if($val == 1) {
			
		    $result = mysql_query("SELECT shb_id ,sh_diff_name ,section_id FROM ".TB_STOCK_HEAD_SECTION." WHERE shb_id = '$data' ") or die ("Err Can not to result") ;			
			$row = mysql_fetch_array($result) ;
                   if($row['sh_diff_name'] == "") { 	
				   echo "ขนาด/ลักษณะ :&nbsp;<font id='disp_diff_name_1'><input type='text'  size='20' value='คลิกขนาด/ลักษณะ->' disabled>" ;
	               echo "<input type='hidden' name='shf_diff_name_1' id='shf_diff_name_1' value=''>" ;
	               echo "</font>&nbsp;&nbsp;&nbsp;<input type='button' onClick='diff_name_open(1);' value='...'><br><br>" ;
	               echo "เอกสารเลขที่ :&nbsp;<input type='text' name='sd_ref_1' id='sd_ref_1' size='20' value=''>" ;
				   echo "<input type='hidden' name='shf_diff_id_1' id='shf_diff_id_1' value=''>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br>" ;
	               } else  {	
                   echo "ขนาด/ลักษณะ :2ไม่ว่าง<input type='text'  size='20' value='".$row['sh_diff_name']." disabled>" ;
	               echo "<input type='hidden' name='shf_diff_id_1' id='shf_diff_id_1' value=''>" ;
	               echo "<input type='hidden' name='shf_diff_name_1' id='shf_diff_name_1' value=''>" ;
				   echo	"&nbsp;&nbsp;เอกสารเลขที่ :<input type='text' name='sd_ref_1' id='sd_ref_1' size='20' value=''><br><br>" ;
                   } 
                   echo "<FONT COLOR='#FF0000'>ราคา</FONT>/หน่วย&nbsp;:&nbsp;<font id='disp_price_1'><input type='text' name='sd_price_1' id='sd_price_1' size='8' value='คลิกราคา->'  disabled ></font>&nbsp;&nbsp;&nbsp;<input  type='button' onClick='price_open(1);' value='...'>" ;
	               echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวน&nbsp;:<input type='text' name='sd_amount_1' id='sd_amount_1' size='8' style='text-align:center;' value=''>" ;
				   echo "<input type='hidden' name='shf_price_id_1' id='shf_price_id_1' size='3' value=''>" ;
				   echo "<input type='hidden' name='section_id' id='section_id' size='5' value='".$row['section_id']."'>" ;
				   echo "<input type='hidden' name='shb_id' id='shb_id' size='5' value='".$row['shb_id']."'>" ;
			}
            mysql_close($objConnect); 
?>