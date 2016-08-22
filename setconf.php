<?php
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['configs'] = $db->select_query("SELECT * FROM ".TB_CONFIG."  ORDER BY id ");
$sd=1;

while($arr['configs'] = $db->fetch($res['configs'])){
if ($arr['configs']['posit']=='logo'){ define("WEB_LOGO",$arr['configs']['name']);}
if ($arr['configs']['posit']=='agen_mini'){ define("WEB_AGEN_MINI",$arr['configs']['name']);}
if ($arr['configs']['posit']=='agen_full'){ define("WEB_AGEN_FULL",$arr['configs']['name']);}
if ($arr['configs']['posit']=='agen_name'){ define("WEB_AGEN_NAME",$arr['configs']['name']);}
if ($arr['configs']['posit']=='district'){ define("WEB_DISTRICT",$arr['configs']['name']);}
if ($arr['configs']['posit']=='amphur'){ define("WEB_AMPHUR",$arr['configs']['name']);}
if ($arr['configs']['posit']=='province'){ define("WEB_PROVINCE",$arr['configs']['name']);}
if ($arr['configs']['posit']=='email'){ define("WEB_EMAIL",$arr['configs']['name']);}
if ($arr['configs']['posit']=='wsd_card'){ define("WEB_WSD_CARD",$arr['configs']['name']);}
if ($arr['configs']['posit']=='title'){ define("WEB_TITLE",$arr['configs']['name']);}
if ($arr['configs']['posit']=='templates'){ define("WEB_TEMPLATES",$arr['configs']['name']);}
$sd++;
}
?>