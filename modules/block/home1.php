<?
require_once("mainfile.php");
$_SERVER['PHP_SELF'] = "index.php";

?>
<table align="center" cellspacing="0" cellpadding="0" width="1000" >
<tbody>
<tr>
<td width="1000" colspan="3">
<? if($folder=="" or $folder=="page") { ?>
<div id="header" height="40">
<ul>
  <li id="current"><a href="/">ล็อกอินผู้ใช้</a></li>
  <li id=""><a href="?naivoi=page&voi=page&op=prawat">เกี่ยวกับเรา</a></li>
  <li id=""><a href="?naivoi=page&voi=page&op=vision">นโยบายเว็บไซต์</a></li>
  <li id=""><a href="?naivoi=page&voi=page&op=personnel">ข้อตกลง</a></li>
</ul>
</div>
<? }?>
</td>
</tr>
<tr>
<td background="images/main/r.gif" border="0" height="100%" width="7"></td>
<td width="986">
<? if($folder=="" and $file=="") {
$name = "member" ;
$file = "loginuser" ;
 ?>
			    <table cellspacing="0" cellpadding="0" width="100%" >
			    <tr valign="top">
			    <td width="100%" align="center" id="leftcol">
			    <? include ("naivoi/".$name."/".$file.".php"); ?>
				</td>
				</tr>
			    </table><br>
<? } else { ?>
			    <table cellspacing="0" cellpadding="0" width="100%" >
			    <tr valign="top">
			    <td width="100%" align="center" id="leftcol">
			    <? include ("".$MODPATHFILE.""); 
				// include ("naivoi/".$name."/".$file.".php");
				?>
				</td>
				</tr>
			    </table><br>
<? } ?>	
</td>
<td background="images/main/l.gif" border="0" height="100%" width="7"></td>
</tr>
<tr>
<td background="images/main/b.gif" border="0" height="7" width="1000" colspan="3"></td>
</tr>		  
</table>