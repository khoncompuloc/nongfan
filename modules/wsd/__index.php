<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
 //CheckUser_Nopwd($_SESSION['login_true']) ; //, $_SESSION['pwd_login']);
?>
<link href="css/template_css.css" rel="stylesheet" type="text/css" />

	<TABLE cellSpacing=0 cellPadding=0 width=530 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="520" vAlign=top align=left><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/material/textmenu_material.png" BORDER="0"><BR>
<center><table cellpadding="0" cellspacing="0" bgcolor="#ffffff" bordercolor="#CCCCCC" border="0" >
<tr><td align="center" >
<center>
<?
    if($_SESSION['admin_user']=="" and $_SESSION['login_true']=="") {
   	$_logout="<a>";
    } else {	
	$_logout="<a href=\"index.php?folder=member&file=logout\">";
    }
echo "<table cellpadding=0 cellspacing=0 bordercolor=#0A7CC0 border=0  width=520>";
echo "<tr>";
echo "</tr><tr><td>&nbsp;&nbsp;</td></tr>";
echo "<tr><td align=center >";
?>
    <div id="body">
            <div id="cpanel" >
               <div style="float:left;">
                    <div class="icon">
                        <a href="">
                        <img src="images/home.png" alt="หน้าแรก" align="middle" border="0" />
                        <span>หน้าแรก</span>
                        </a>
                    </div>
                </div> 
                <div style="float:left;">
                    <div class="icon">
                        <a href="shadow.php?folder=material&file=requistion" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 785, objectHeight: 600} )" class="highslide">
						<img src="images/material/material1.png" alt="เบิกวัสดุ" align="middle" border="0" />
						<span>เบิกวัสดุ</span>
                        </a>
                     </div>
                </div>
                <div style="float:left;">
                    <div class="icon">
                        <a href="shadow.php?folder=material&file=print_requistion" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 750, objectHeight: 600} )" class="highslide">
                        <img src="images/material/material2.png" alt="พิมพ์ใบเบิกวัสดุ" align="middle" border="0" />
                        <span>พิมพ์ใบเบิกวัสดุ</span>
                        </a>
                    </div>
                </div>
                <div style="float:left;">
                    <div class="icon">
                        <a href="shadow.php?folder=material&file=add_material" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 850, objectHeight: 600} )" class="highslide">
						<img src="images/material/material1.png" alt="บันทึกขออนุญาต" align="middle" border="0" />
						<span>นำเข้ารายการวัสดุ</span>
                        </a>
                     </div>				
                </div>
             </div>
     </div>
	 
	 
	 
</td>
</tr>
<tr>
<td>
    <div id="body">
            <div id="cpanel" >
               <div style="float:left;">
                    <div class="icon">
                        <a href="shadow.php?folder=material&file=acc_material" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 750, objectHeight: 600} )" class="highslide">
                        <img src="images/material/material1.png" alt="รายการขออนุญาติ" align="middle" border="0" />
                        <span>บัญชีวัสดุ</span>
                        </a>
                    </div>			   
                </div> 
                <div style="float:left;">
                    <div class="icon">
                        <a href="shadow.php?folder=material&file=check_material" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 750, objectHeight: 600} )" class="highslide">
                        <img src="images/material/material1.png" alt="สรุปวัสดุคงเหลือ" align="middle" border="0" />
                        <span>สรุปวัสดุคงเหลือ</span>
                        </a>
                    </div>
                </div>	
                <div style="float:left;">
                    <div class="icon">
                        <a href="shadow.php?folder=material&file=want_material" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 750, objectHeight: 600} )" class="highslide">
						<img src="images/wait.png" alt="บันทึกขออนุญาต" align="middle" border="0" />
						<span>ต้องการสั่งวัสดุ</span>
                        </a>
                     </div>
                </div>
                <div style="float:left;">
                    <div class="icon">
                        <? echo $_logout ; ?>
                        <img src="images/logout.png" alt="ออกจากระบบ" align="middle" border="0" />
                        <span>ออกจากระบบ</span>
                        </a>
                    </div>
                </div>	
             </div>
     </div>
</td>
</tr>

<tr><td><br>
<div align="center" >
                    
                        <a href="index.php?folder=material">
                        <img src="images/Refresh.png" alt="รีเฟรช" align="middle" border="0" />
                        </a><br>รีเฟรช
                    
</div>	
</td></tr>
</table>
<br>
</td>
</tr>
</table>
     </TD>
    	</TR>
			</TABLE>