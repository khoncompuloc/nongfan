<?
  notview();
                     $file=$_GET["file"] ;
                       if(isset($file) and $file=="print_send_kuru"){ $name="พิมพ์รายงานส่ง สตง." ; }                    
                                                 
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body>
<table width="670" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td><h4><br>&nbsp;&nbsp;ระบบงาน  (<font color="#FF0033"><? echo $name  ?></font>) </h4></td>
</tr>
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<TR>
<TD height="1" class="dotline"></TD>
</TR>
<tr>
<td> </td>
</tr>
<tr>
<td><div align="center">
<p>&nbsp;</p>
<p><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><b>ขออภัยครับ</b></font> </p>
<p><img src="images/notview.gif" width="50" height="82"></p>
</div>
<p align="center"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><b>ในส่วนระบบ<font color="#FF0033"><? echo $name  ?></font>รอก่อนกำลังพัฒนาระบบอื่นอยู่ </font>
<p align="center"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><b>โปรดรอคอยต่อไป.......</font>
<p align="center">

<p align="center"></td>
</tr>
</table></td>
</tr>
</table>
</body>
</html>