<?php
//require_once("../../mainfile.php");

require_once("../../includes/config.in.php");
require_once("../../includes/class.mysql.php");

$db = New DB();

	$strUsername = trim($_POST["tUsername"]);

	if(trim($strUsername) == "")
	{
		echo "<img src='images/publish_x.png'>";
		exit();
	}

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD); // เชื่อมต่อฐานข้อมูล 
$db_query = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE user='".$strUsername."' "); // ดึงข้อมูลให้ตรงกันในตารางสมาชิก 
$objResult = $db->fetch($db_query); 

	if($objResult)
	{
		echo "<img src='images/publish_x.png'>";
	}
	else
	{
		echo "<img src='images/tick.png'>";
	}
$db->closedb (); 
?>