<?
//////////////////////		 เพิ่ม  สมาชิกออนไลน์   ////////////////////////////
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->del(TB_useronline," useronline='".$login_true."' "); 
			$db->closedb ();
//////////////////////		 เพิ่ม  สมาชิกออนไลน์   ////////////////////////////	
//ระบบสมาชิกเสริม maxsite 1.10 พัฒนาโดย www.narongrit.net
session_destroy() ;

echo "<meta http-equiv=refresh content=3;URL=index.php>" ; 

?>


<table width="520"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
            <TD width="10" vAlign=top></TD>
          <TD width="510" vAlign=top >

      &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_member.gif" BORDER="0">
				<TABLE width="510" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline" colspan="4"></TD>
				</TR>
      <tr>
        <td> </td>
      </tr>
      <tr>
        <td width="100%"><div align="center">
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><b>ออกจากระบบเรียบร้อยแล้วครับ</b></font> </p>
          </div>
            <p align="center"></p>
            <p align="center"><font size="3" face="MS Sans Serif, Tahoma, sans-serif">กรุณารอสักครู่ เพื่อกลับสู่หน้าหลัก</font>
            <br><br></td>
      </tr>
    </table></td>
  </tr>
</table>
