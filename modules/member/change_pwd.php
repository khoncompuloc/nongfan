<?php

if(!$login_true){
echo "<meta http-equiv='refresh' content='0; url =?name=member&file=index'>" ;
exit() ;
}
$ok=$_POST['ok'];
if(isset($ok) and session_is_registered("status")){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

//ระบบสมาชิกเสริม maxsite 1.10 พัฒนาโดย www.narongrit.net
$old_pwd=$_POST['old_pwd'];
$new_pwd1=$_POST['new_pwd1'];
$new_pwd2=$_POST['new_pwd2'];

$sql = "select * from ".TB_MEMBER." where user='$login_true' and password='$old_pwd'" ;
$result = mysql_query($sql) ;
$row = mysql_num_rows($result) ;
if($row<=0){
$status = "<center><font face='MS Sans Serif' size='3' color='red'><b>รหัสผ่านไม่ถูกต้องครับ</b></font></center>" ;
echo "<meta http-equiv='refresh' content='2'>" ;
session_unregister("status") ;

}
else {
if($new_pwd1==$new_pwd2){
$sql = "update ".TB_MEMBER." set  password='$new_pwd1' where user = '$login_true'" ;
$result = mysql_query($sql) or die("ERR PROGRAME") ;
if($result){
$status = "<center><font face='MS Sans Serif' size='3' color='red'><b>เปลี่ยนรหัสผ่านเรียบร้อยแล้วครับ</b></font></center>";
echo "<meta http-equiv='refresh' content='2; url =?name=member&file=member_detail'>" ;
}
}
else{
$status = "<center><font face='MS Sans Serif' size='3' color='red'><b>กรุณายืนยันรหัสผ่านใหม่ให้ถูกต้องด้วยครับ</b></font></center>";
echo "<meta http-equiv='refresh' content='2'>" ;

}
}
}
else {
$status = NULL ;
session_register("status") ;
}
?>

<HTML>
<HEAD>
<TITLE>เปลี่ยนรหัสผ่าน</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-874">
</HEAD>

<BODY LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
<TABLE WIDTH="660" BORDER="0" ALIGN="center" CELLPADDING="0" CELLSPACING="0">
  <TR>
            <TD width="10" vAlign=top></TD>
          <TD width="660" vAlign=top >

      &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_member.gif" BORDER="0">
				<TABLE width="640" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline" colspan="4"></TD>
				</TR>
								<tr><td  colspan="4">&nbsp;&nbsp;<?php include "member_header.php" ; ?>
    </p>
      <P ALIGN="center"><FONT SIZE="4" FACE="MS Sans Serif, Tahoma, sans-serif"><STRONG><u><BR>
        ระบบเปลี่ยนรหัสผ่าน</u></STRONG></FONT></P>
      <P ALIGN="center"><?php echo $status ; ?></P>
        <FORM ACTION="" METHOD="post" NAME="checkForm" onSubmit="return check()">
          <TABLE WIDTH="100%" BORDER="0" ALIGN="center" CELLPADDING="2" CELLSPACING="1">
            <TR>
              <TD ALIGN="right"><STRONG><FONT COLOR="#000000" SIZE="2">รหัสผ่านเดิม</FONT></STRONG></TD>
              <TD>
                <INPUT TYPE="password" NAME="old_pwd">
              </TD>
            </TR>
            <TR>
              <TD ALIGN="right"><STRONG><FONT COLOR="#000000" SIZE="2">รหัสผ่านใหม่</FONT></STRONG></TD>
              <TD>
                <INPUT TYPE="password" NAME="new_pwd1">
              </TD>
            </TR>
            <TR>
              <TD ALIGN="right"><STRONG><FONT COLOR="#000000" SIZE="2">ยืนยันรหัสผ่านใหม่</FONT></STRONG></TD>
              <TD>
                <INPUT TYPE="password" NAME="new_pwd2">
              </TD>
            </TR>
            <TR>
              <TD ALIGN="right">&nbsp;</TD>
              <TD>
                <INPUT TYPE="submit" NAME="Submit" VALUE=" ยืนยัน ">
&nbsp;
              <INPUT TYPE="reset" NAME="Submit2" VALUE=" ยกเลิก ">
              <INPUT NAME="ok" TYPE="hidden" ID="ok" VALUE="ok">
              </TD>
            </TR>
            <TR>
              <TD COLSPAN="2">&nbsp; </TD>
            </TR>
          </TABLE>
          <SCRIPT language = "javascript">
function check(){
var v1 = document.checkForm.old_pwd.value;
var v2 = document.checkForm.new_pwd1.value;
var v3 = document.checkForm.new_pwd2.value;

if(v1.length==0){
alert("กรุณากรอกรหัสผ่านเก่าอีกครั้งด้วยครับ");
document.checkForm.old_pwd.focus();
return false ;
}
else if(v2.length==0){
alert("กรุณากรอกรหัสผ่านใหม่ด้วยครับ");
document.checkForm.new_pwd1.focus();
return false ;
}
else if(v3.length==0){
alert("กรุณายืนยันรหัสผ่านใหม่ด้วยครับ");
document.checkForm.new_pwd2.focus();
return false ;
}

else 
return true ;
}
  </SCRIPT>
      </FORM></TD>
  </TR>
  <TR>
    <TD><BR><BR><BR></TD>
  </TR>
  <TR>
    <TD CLASS="dotline"></TD>
    <TD HEIGHT="1" CLASS="dotline"></TD>
  </TR>
</TABLE>

    <TD >
  </TR>
</TABLE>

<P>&nbsp;</P>
</BODY>
</HTML>
