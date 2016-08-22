<?
require_once("mainfile.php");
		$classtext = array("", "");
		$classbox = array("noborder2", "noborder2");
		$username = "";
		$password = "";
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->del(TB_useronline," useronline='".$_SESSION['admin_user']."' "); 
			$db->closedb ();
session_unset();
//session_destroy();
?>

	<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
      <TBODY>
        <TR>
          <TD width="820" vAlign=top align=left><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="800" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>

        <TR>
          <TD vAlign="top" align="center" class="login" align="center"><FONT COLOR="#009900" size="3"><b>ได้ทำการออกจากระบบเรียบร้อยแล้ว</b></font>
		  <? echo "<meta http-equiv='refresh' content='2; url=index.php'>" ; ?>
		  </td>
		</tr>

			</TABLE>
				</TD>
				</TR>
			</TABLE>
