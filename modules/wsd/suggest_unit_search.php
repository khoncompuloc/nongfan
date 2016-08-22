<?php
empty($_SESSION['section_id'])?$section_id="":$section_id=$_SESSION['section_id'] ;
require_once("../../includes/config.in.php");
require_once("../../includes/class.mysql.php");
   $db = New DB(); 

	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	if(!$db) {
		echo 'Could not connect to the database.';
	} else {
	    	
		if(isset($_POST['queryString'])) {
			   $queryString=$_POST['queryString'];

			if(strlen($queryString) >0) {
                
				$query = $db->select_query("SELECT unit_name FROM web_stock_unit WHERE unit_name LIKE '%$queryString%' ORDER BY unit_name ASC LIMIT 10 ");

				if($query) {
				echo '<ul>';
				    
					while ($result= $db->fetch($query)) {
	         			echo '<li onClick="fill(\''.addslashes($result['unit_name']).'\');">'.$result['unit_name'].'</li>';
                        
	         		}
				echo '</ul>';
				} else {
					echo 'ไม่พบวัสดุที่ค้นหา';
				}
			} else {
				// do nothing
				echo 'ไม่พบ'; 
			}
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>