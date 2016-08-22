<?php
define("WEB_BUDGET","59");
empty($PHP_SELF)?$PHP_SELF="":$PHP_SELF=$PHP_SELF;
//หากมีการเรียกไฟล์นี้โดยตรง
if (preg_match("/config.in.php/i", $PHP_SELF)) {
    header("Location: ../index.php");
    die();
}

//MySQL Connect
define("DB_HOST","localhost");
define("DB_NAME","naivoicom_nm".WEB_BUDGET);
define("DB_USERNAME","naivoicom_nm59");
define("DB_PASSWORD","psd@shop");	

//webconfig
define("TB_CONFIG","web_config");
//define("TB_CONFIG_CAT","web_config_category");

//MySQL table
define("TB_ADMIN","web_admin");
define("TB_ADMIN_GROUP","web_groups");
//define("TB_VENDERS","web_venders");
define("TB_SHOP","web_shop");

//เมนูสร้างเอง
define("TB_PAGE","web_page");
define("_IPAGE_W","48"); //ไอคอนข่าวสารกว้าง
define("_IPAGE_H","48"); //ไอคอนข่าวสารสูง
define("_PAGE","เมนูสร้างเอง");

//member
define("TB_MEMBER","web_member");
define("TB_MEMBER_PARTIES","web_member_parties");
define("TB_MEMBER_POSITION","web_member_position");
define("TB_MEMBER_SECTION","web_member_section");

//car
define("TB_CAR","web_car");
define("TB_CAR_PLACE","web_car_place");
define("TB_CAR_PERMISSION","web_car_permission");

//stock
define("TB_STOCK_HEAD","web_stock_head");
define("TB_STOCK_CENTER","web_stock_center");
define("TB_STOCK_HEAD_CENTER","web_stock_head_center");
define("TB_STOCK_HEAD_SECTION","web_stock_head_section");
define("TB_STOCK_SECTION","web_stock_section");
define("TB_STOCK_TYPE","web_stock_type");
define("TB_STOCK_SUBTYPE","web_stock_subtype");
define("TB_STOCK_UNIT","web_stock_unit");
define("TB_STOCK_HEAD_PRICE","web_stock_head_price");
define("TB_STOCK_DATA","web_stock_data");
define("TB_STOCK_REQUISTION_CENTER","web_stock_requistion_center");
define("TB_STOCK_REQUISTION_SECTION","web_stock_requistion_section");
?>