<?php
//$time = microtime(TRUE);
//define('TIME_LOADER', $time);
$mem = memory_get_usage();

define('_NAIVOI',1);
//define('WEB_BUDGET',59);
define('BASE_PATH', dirname(__FILE__) );
define( 'DS', DIRECTORY_SEPARATOR );

session_start();

$_SERVER['PHP_SELF'] = "index.php";
$PHP_SELF   = $_SERVER['PHP_SELF'];
$folder     = empty($_GET['compu']) ? "" : $_GET['compu'];
$file       = empty($_GET['loc']) ? "" : $_GET['loc'];
$admin_user = empty($_SESSION['admin_user']) ? "" : $_SESSION['admin_user'];
$admin_level= empty($_SESSION['admin_level']) ? "" : $_SESSION['admin_level'];
$login_true = empty($_SESSION['login_true']) ? "" : $_SESSION['login_true'];
$section_id = empty($_SESSION['section_id']) ? "" : $_SESSION['section_id'];
$op         = empty($_GET['op']) ? "" : $_GET['op'];
$action     = empty($_GET['action']) ? "" : $_GET['action'];
$data       = empty($_GET['data']) ? "" : $_GET['data'];
$page       = empty($_GET['page']) ? "" : $_GET['page'];
$category   = empty($_GET['category']) ? "" : $_GET['category'];

require_once("mainfile.php");

if($login_true or $admin_user) { 
if($admin_level == '4') {
	$result_sec = mysql_query("select section_name from ".TB_MEMBER_SECTION." where section_id='".$section_id."'") ; // and password='$pwd_login'") ;
    $section = mysql_fetch_array($result_sec) ;
	
				 $count_str=mb_strlen($section['section_name']);
				 if($count_str > 12){
					$arr_p['name']= mb_substr($section['section_name'],0,12,"utf-8")."..."; 
				 }else{
					$arr_p['name']=$section['section_name'];
				 }	
	
    $login_name = "<font color=#ff0000>".$arr_p['name']."</font>" ;
} else {
	$login_name = "<font color=#006699>".$_SESSION['fname']."&nbsp;&nbsp;".$_SESSION['lname']."</font>" ; 
}
} else {
	$login_name = "" ;
}

GETMODULE($folder, $file);
require_once("templates/".WEB_TEMPLATES."/index.php");
?>