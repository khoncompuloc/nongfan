<?php
            $name = $_GET['name'];  //iconv("TIS-620", "UTF-8", 
			$op = $_GET['op'];  //iconv("TIS-620", "UTF-8", 
  		    $login_true = $_GET['login_true'];  //iconv("TIS-620", "UTF-8", 
			
			include("../../includes/config.in.php");
		
			$objConnect = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD) or die(mysql_error());
			$objDB = mysql_select_db(DB_NAME) or die ( "ไม่สามารถเชื่อมต่อฐานข้อมูลได้" );
    		mysql_query( "SET NAMES utf8" , $objConnect );
 
			if($op=="addplace"){
			$result = mysql_query("SELECT * FROM ".TB_CAR_PLACE." WHERE place='".$name."'") or die ("Err Can not to result") ;
			$dbarr = mysql_fetch_array($result) ;
			if(mysql_num_rows($result)<1){
 
			$sql = "INSERT INTO ".TB_CAR_PLACE." (place) VALUES ('".$name."')" ;
			$result = mysql_query($sql) or die ("Err Can not to result") ;
			}
			
			$result = mysql_query("SELECT place_buffer FROM ".TB_MEMBER." WHERE user='".$login_true."'") or die ("Err Can not to result") ;
            $dbarr = mysql_fetch_array($result) ;
			if(mysql_num_rows($result)>=1){
			   if(!$dbarr["place_buffer"]){
			$sql = "UPDATE ".TB_MEMBER." SET place_buffer='".$name."' WHERE user='".$login_true."'" ;
            $result = mysql_query($sql) ; 			
            if($result){
			echo $name ;
//			echo $op ;
            } else {
            echo "ไม่ ok 1" ;		
			}
			} else {
			$sql = "UPDATE ".TB_MEMBER." SET place_buffer='".$dbarr["place_buffer"].", ".$name."' WHERE user='".$login_true."'" ;
            $result = mysql_query($sql) ; 			
            if($result){
			echo $dbarr["place_buffer"].", " ;	
            echo $name;	
//			echo $op ;
            } else {
            echo "ไม่ ok 2" ;		
			}
            }
			}
	        } else if($op=="clear"){

			$sql = "UPDATE ".TB_MEMBER." SET place_buffer='' WHERE user='".$login_true."'" ;
            $result = mysql_query($sql) ; 	
//			echo "คีย์หรือเลือกสถานที่ใหม่";
            }			
	        mysql_close($objConnect); 
?>