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
                
				if($section_id == 0){
				$query = $db->select_query("SELECT sh_name FROM web_stock_head WHERE sh_name LIKE '%$queryString%' AND sh_logic='1' ORDER BY sh_name ASC LIMIT 10 ");
				} else {
				$query = $db->select_query("SELECT sh_name FROM web_stock_head WHERE sh_name LIKE '%$queryString%' AND sh_logic='1' AND section_id='$section_id' ORDER BY sh_name ASC LIMIT 10 ");
				}
				if($query) {
				echo '<ul>';
				    
					while ($result= $db->fetch($query)) {
	         			echo '<li onClick="fill(\''.addslashes($result['sh_name']).'\');">'.$result['sh_name'].'</li>';
                        
	         		}
					   // echo '<li onClick="fill(\''.addslashes($result['sh_name']).'\');">'.$section_id.'</li>';
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