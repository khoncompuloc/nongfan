<?php
require_once("includes/config.in.php");
require_once("includes/function.in.php");
require_once("includes/class.mysql.php");
require_once("includes/array.in.php");
require_once("setconf.php");
//require_once("includes/dThumbMaker.inc.php");
//$db = new DB();



//ตรวจสอบว่ามีโมดูลหรือไม่ (โมดูล User)
function GETMODULE($name,$file){
    global $MODPATH, $MODPATHFILE ;
    if(!$name){$name = "index";}
    if(!$file){$file = "index";}
    $modpathfile = "modules/".$name."/".$file.".php";
    if(file_exists($modpathfile)){
	$MODPATHFILE = $modpathfile;
	$MODPATH = "modules/".$name."/";
    }else{
	echo "ไม่พบไฟล์ที่ต้องการ";
        exit;
    }
}

// Get Real ipaddress
//$IPADDRESS = get_real_ip();

//$home = WEB_URL; // url เว็บไซด์ของคุณ เวลาที่ต้องการเรียก
$admin_email = WEB_EMAIL; // อีเมล์ของคุณ
//define("WEB_TITLE","ระบบงาน อบต.หนองหัวฟาน") ;


/***
require_once("includes/config.in.php");
require_once("includes/class.mysql.php");
//require_once("includes/class.cookie.php");
require_once("includes/array.in.php");
require_once("includes/function.in.php");
require_once("setconf.php");

$db = New DB();


//ตรวจสอบว่ามีโมดูลหรือไม่ (โมดูล User)
function GETMODULE($folder,$file){
	global $MODPATH, $MODPATHFILE ;
	if(!$folder){$folder= "index";}
	if(!$file){$file = "index";}
$modpathfile="naivoi/".$folder."/".$file.".php";
if (file_exists($modpathfile)) {
	$MODPATHFILE = $modpathfile;
	$MODPATH = "naivoi/".$folder."/";
	}else{
	die ("เสียใจด้วยครับ ไม่มีหน้าที่ท่านต้องการเข้าชม...");
	}
}
define("WEB_TEMPLATES","".$templates."") ;
define("_local_mini","".$agen_mini.$agen_name."") ;
define("_local_full","".$agen_full.$agen_name."") ;

//ผู้ดูแลระบบไม่ผ่านสิทธิการใช้งาน
$PermissionFalse = "<BR><BR>";
$PermissionFalse .= "<CENTER><A HREF=\"?folder=admin&file=main\"><IMG SRC=\"images/notview.gif\" BORDER=\"0\"></A><BR><BR>";
$PermissionFalse .= "<FONT COLOR=\"#336600\"><B>ท่านไม่ได้รับอนุญาตให้ใช้งานส่วนนี้ได้</B></FONT><BR><BR>";
$PermissionFalse .= "<A HREF=\"?folder=admin&file=main\"><B>หน้าหลักผู้ดูแลระบบ</B></A>";
$PermissionFalse .= "</CENTER>";
$PermissionFalse .= "<BR><BR>";
***/
?>