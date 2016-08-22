<?php
session_unset();
$_SESSION['naivoi']="voi";
?>
<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
<TBODY>
  <TR>
  <TD width="820" vAlign=top align=left><BR>
  <!-- Admin -->
&nbsp;&nbsp;<IMG SRC="images/home/textmenu_memberlogin.gif" BORDER="0"><BR>
   <TABLE width="800" align=center cellSpacing=0 cellPadding=0 border=0>
   <TR>
   <TD height="1" class="dotline"></TD>
   </TR>
   <TR>
   <TD vAlign="top" align="center" class="login" align="center"><FONT COLOR="#009900" size="3"><b>ได้ทำการออกจากระบบเรียบร้อยแล้ว</b></font>
<?php
empty($admin_user)?$admin_user="":$admin_user=$admin_user ;
empty($login_true)?$login_true="":$login_true=$login_true ;
     if($admin_user == "" and $login_true != "") {
     echo "<meta http-equiv='refresh' content='2; url=index.php'>" ; 
	 } else {
	 echo "<meta http-equiv='refresh' content='2; url=index.php?compu=admin'>" ; 
	 }
 ?>
   </td>
</tr>
</TABLE>
</TD>
</TR>
</TABLE>