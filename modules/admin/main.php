<?php 
CheckAdminAll($admin_user,$admin_level);
?>
<link href="css/template_css.css" rel="stylesheet" type="text/css" />

<TABLE cellSpacing="0" cellPadding="0" width="920" border="0">
     <TR>
        <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
        <TD width="810" vAlign=top align=left><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/admin/textmenu_admin.gif" BORDER="0"><BR>
<center>
<?php 
echo "<table cellpadding=0 cellspacing=0 bordercolor=#0A7CC0 border=0  width=650>";
echo "<tr>";
echo "</tr><tr><td>&nbsp;&nbsp;</td></tr>";
echo "<tr><td align=center >";
?>
    <div id="body">
            <div id="cpanel">
                <div style="float:left;">
                    <div class="icon">
                        <a href="?compu=admin&loc=config">
                        <img src="images/admin/config.png" alt="ตั้งค่าเว็บ" align="middle" border="0" />
                        <span>ตั้งค่าระบบ</span>
                        </a>
                     </div>
                </div>
                <div style="float:left;">
                    <div class="icon">
                        <a href="?compu=admin&loc=user">
                        <img src="images/admin/user.png" align="middle" border="0" />
                        <span>ผู้ใช้งานระบบ</span>
                        </a>
                    </div>
                </div>
                <div style="float:left;">
                    <div class="icon">
                        <a href="?compu=admin&loc=member_add">
						<img src="images/admin/member_add.png" align="middle" border="0" />
						<span>คีย์บุคลากร</span>
                        </a>
                     </div>
                </div>
                <div style="float:left;">
                    <div class="icon">
                        <a href="?compu=wsd&loc=material_central">
                        <img src="images/admin/material.png" align="middle" border="0" />
                        <span>บัญชีวัสดุ กลาง</span>
                        </a>
                    </div>
                </div>
                <div style="float:left;">
                    <div class="icon">
                        <a href="?compu=wsd&loc=material_addstart">
                        <img src="images/admin/material.png" align="middle" border="0" />
                        <span>บัญชีวัสดุ ส่วน/กอง</span>
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
            <div id="cpanel">
                <div style="float:left;">
                    <div class="icon">
                        <a href="?compu=admin&loc=manage_material">
                        <img src="images/admin/menu.png" align="middle" border="0" />
                        <span>จัดการวัสดุ</span>
                        </a>
                    </div>
                </div>                
				<div style="float:left;">
                    <div class="icon">
                        <a href="?compu=admin&loc=promise_concrol">
                        <img src="images/admin/cont.png" align="middle" border="0" />
                        <span>คุมประกันสัญญา</span>
                        </a>
                    </div>
                </div>
                <div style="float:left;">
                    <div class="icon">
                        <a href="?compu=admin&loc=block">
                        <img src="images/admin/block.png" align="middle" border="0" />
                        <span>จัดการ block</span>
                        </a>
                    </div>
                </div>
                <div style="float:left;">
                    <div class="icon">
                        <a href="?compu=admin&loc=backupindex">
                        <img src="images/admin/history.png" align="middle" border="0" />
                        <span>แบ็คอัพข้อมูล</span>
                        </a>
                    </div>
                </div>	
                <div style="float:left;">
                    <div class="icon">
                        <a href="?compu=home&loc=logout">
                        <img src="images/admin/logout.png" align="middle" border="0" />
                        <span>ออกจากระบบ</span>
                        </a>
                    </div>
                </div>	
            </div>
    </div>
</td>
</tr>
<tr><td>&nbsp;&nbsp;</td></tr>
</table>
		</TD>
	</TR>
</TABLE>