<?php
#### สคริ๊ปนี้ใช้ในการเช็ค ว่าล็อกอินหรือยัง ให้นำสคริ๊ปนี้ไปไว้ที่หน้าที่คุณต้องการให้เช็ค ####
//ระบบสมาชิกเสริม maxsite 1.10 พัฒนาโดย www.narongrit.net
//require_once("mainfile.php");
empty($_SESSION['login_true'])?$login_true="":$login_true=$_SESSION['login_true'];
//session_start() ;
if(!$login_true) {
//  url=index.php คำสั่งนี้จะให้ไปหน้าที่จะต้องกรอก user,pwd ถ้าอยู่โฟล์เดอร์อื่นให้เรียกให้ถูกนะครับ
	echo "<center><font size='3'>คุณยังไม่ได้เป็นสมาชิก</font></font>";
	echo "<meta http-equiv='refresh' content='1;url=?name=member'>" ; 
} else {

?>

<HTML>
<HEAD>

<!-- จาวา แถบสี -->
<SCRIPT LANGUAGE="javascript"> 
function mOvr(src,clrOver){ 
if (!src.contains(event.fromElement)){ 
src.style.cursor = 'hand'; 
src.bgColor = clrOver; 
} 
} 
function mOut(src,clrIn){ 
if (!src.contains(event.toElement)){ 
src.style.cursor = 'default'; 
src.bgColor = clrIn; 
} 
} 
</SCRIPT> 

<TITLE>สวัสดีครับสมาชิกใหม่ และ สมาชิกเก่าทุกๆท่าน</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-874">
</HEAD>

<BODY LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
<?php
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

$result = mysql_query("select * from ".TB_MEMBER." where user='$login_true'") or die ("Err Can not to result") ;
$dbarr = mysql_fetch_array($result) ;

?>
<TABLE WIDTH="660"  border="0" ALIGN="center" CELLPADDING="0" CELLSPACING="0">
  <TR>
            <TD width="10" vAlign=top></TD>
          <TD width="640" vAlign=top >

      &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_member.gif" BORDER="0">
				<TABLE width="640" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline" colspan="4"></TD>
				</TR>
				<tr><td  colspan="4">
      <? include "member_header.php" ?>
    </TD>
  </TR>
  <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
  <TR>
        <TD COLSPAN="4"><STRONG><FONT SIZE="4"><IMG SRC="images/human.gif" > <FONT COLOR="#FF3300"><u><FONT COLOR="#0000FF">รายละเอียดของสมาชิก คุณ <?php echo $dbarr['user'] ; ?>
        </FONT></u></FONT></FONT></STRONG></TD>
      <TR>
        <TD WIDTH="24%" ALIGN="right"><STRONG>หมายเลขสมาชิก : </FONT></STRONG></TD>
        <TD WIDTH="25%">
          <DIV ALIGN="left">&nbsp;&nbsp;<?php echo $dbarr['member_id'] ; ?></FONT></DIV></TD>
        <TD WIDTH="14%" ALIGN="right"><STRONG>รูปสมาชิก : </FONT></STRONG></TD>
        <TD WIDTH="37%" ROWSPAN="5" VALIGN="top">
          <DIV ALIGN="left">
		  <?
					//Show Picture
					if($dbarr['member_pic']){
						$postpicupload = @getimagesize ("icon/".$dbarr['member_pic']."");
						if ( $postpicupload[0] > _MEMBER_LIMIT_PICWIDTH ) {
							$PicUpload = "&nbsp;&nbsp;<img src='icon/".$dbarr['member_pic']."' width='"._MEMBER_LIMIT_PICWIDTH."' border=\"1\" ALIGN='absmiddle' class='membericon' >
							<br><br>ไฟล์รูปปัจจุบัน $dbarr[member_pic]"  ;
							}else{
							$PicUpload = "&nbsp;&nbsp;<img src='icon/".$dbarr['member_pic']."' border=\"1\" ALIGN='absbottom' class='membericon'>
							<br><br>ไฟล์รูปปัจจุบัน $dbarr[member_pic]  ";
							}
						echo $PicUpload ;
					}else{ echo "&nbsp;&nbsp;<img src='icon/member_nrr.gif' border='1' ALIGN='absbottom' class='membericon'><br><br>&nbsp;&nbsp;ยังไม่มีรูปสมาชิก"; };
					?>		  
		  </DIV>
          <DIV ALIGN="left"></DIV></TD>
      </TR>
      <TR>
        <TD WIDTH="24%" ALIGN="right"><STRONG>ชื่อ-นามสกุล : </FONT></STRONG></TD>
        <TD>
          <DIV ALIGN="left">&nbsp;&nbsp;<?php echo $dbarr['name'] ; ?></FONT></DIV></TD>
        <TD WIDTH="14%" ALIGN="right">&nbsp;</TD>
        </TR>
      <TR>
        <TD WIDTH="24%" ALIGN="right"><STRONG>วัน/เดือน/ปีเกิด : </FONT></STRONG></TD>
        <TD>&nbsp;&nbsp;<?php echo $dbarr['date']."/".$dbarr['month']."/".$dbarr['year']  ; ?></FONT></TD>
        <TD WIDTH="14%" ALIGN="right">&nbsp;</TD>
        </TR>
      <TR>
        <TD WIDTH="24%" ALIGN="right"><STRONG>เพศ : </FONT></STRONG></TD>
        <TD>&nbsp;&nbsp;<?php echo $dbarr['sex'] ; ?></FONT></TD>
        <TD WIDTH="14%" ALIGN="right">&nbsp;</TD>
        <TR>
        <TD WIDTH="24%" ALIGN="right"><STRONG>การศึกษา : </FONT></STRONG></TD>
        <TD>&nbsp;&nbsp;<?php echo $dbarr['education'] ; ?></FONT></TD>
        <TD WIDTH="14%" ALIGN="right">&nbsp;</TD>
        <TR>
        <TD WIDTH="24%" ALIGN="right"><STRONG>บ้านเลขที่ : </FONT></STRONG></TD>
        <TD>&nbsp;&nbsp;<?php echo $dbarr['address'] ; ?></FONT></TD>
        <TD WIDTH="14%" ALIGN="right"><STRONG>email : </FONT></STRONG></TD>
        <TD>&nbsp;&nbsp;<?php echo $dbarr['email'] ;?></FONT></TD>
      <TR>
        <TD WIDTH="24%" ALIGN="right"><STRONG>อำเภอ : </FONT></STRONG></TD>
        <TD>&nbsp;&nbsp;<?php echo $dbarr['amper'] ; ?></FONT></TD>
        <TD WIDTH="14%" ALIGN="right"> <STRONG>อาชีพ : </STRONG></FONT></TD>
        <TD>&nbsp;&nbsp;<?php echo $dbarr['work'] ; ?></FONT></TD>
      <TR>
        <TD WIDTH="24%" ALIGN="right"><STRONG>จังหวัด : </FONT></STRONG></TD>
        <TD>&nbsp;&nbsp;<?php echo $dbarr['province'] ; ?></FONT></TD>
        <TD WIDTH="14%" ALIGN="right"><STRONG>สมัครเมื่อ : </STRONG></FONT></TD>
        <TD>&nbsp;&nbsp;<?php echo $dbarr['signup'] ; ?></FONT></TD>
      <TR>
        <TD WIDTH="24%" ALIGN="right"> <STRONG>รหัสไปรษณีย์ : </FONT></STRONG></TD>
        <TD>&nbsp;&nbsp;<?php echo $dbarr['zipcode'] ; ?></FONT></TD>
        <TD WIDTH="14%" ALIGN="right"><STRONG>เข้ามาล่าสุดเมื่อ : </FONT></STRONG></TD>
        <TD>&nbsp;&nbsp;<?php echo $dbarr['lastlog'] ; ?></TD>
      <TR>
        <TD WIDTH="24%" ALIGN="right"><STRONG>เบอร์โทรศัพท์ : </FONT></STRONG></TD>
        <TD>&nbsp;&nbsp;<?php echo $dbarr['phone'] ;?></FONT></TD>
        <TD WIDTH="14%" ALIGN="right">&nbsp;</TD>
        <TD>&nbsp;</TD>
      <TR>
        <TD WIDTH="14%" ALIGN="right"><STRONG>อายุ : </FONT></STRONG></TD>
        <TD>&nbsp;&nbsp;<?php echo $dbarr['age'] ; ?> ปี </FONT></TD>
        <TD WIDTH="14%" ALIGN="right">&nbsp;</TD>
        <TD>&nbsp;</TD>
    </TABLE>
    <P>&nbsp;</P></TD>
  </TR>
</TABLE>

</BODY>
</HTML>
<? } ?>