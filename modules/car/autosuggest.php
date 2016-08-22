<?php

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
 
   			   //$queryString = iconv("UTF-8", "TIS-620", $queryString);
				$query = $db->select_query("SELECT place FROM web_car_place WHERE place LIKE '%$queryString%' ORDER BY place ASC LIMIT 10 ");
				if($query) {
				echo '<ul>';
				    
					while ($result= $db->fetch($query)) {
	         			echo '<li onClick="fill(\''.addslashes($result['place']).'\');">'.$result['place'].'</li>';

	         		}
				echo '</ul>';
					
				} else {
					echo 'OOPS we had a problem :(';
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