<?php 
empty($_GET['op'])?$op="":$op=$_GET['op'];
empty($_SESSION['admin_user'])?$admin_user="":$admin_user=$_SESSION['admin_user'];	
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD); // Connect DB
$res['page'] = $db->select_query("SELECT * FROM ".TB_PAGE." WHERE name='".$op."' "); // Query page information from database.
$arr['page'] = $db->fetch($res['page']);

$menuname = $arr['page']['menuname'];
$content = $arr['page']['detail'];
$Detail = stripslashes(FixQuotes($content));
$db->closedb (); 
?>
<table cellSpacing="0" cellPadding="0" width="950" border="0">
<tbody>
    <tr>
    <td width="20" vAlign="top"></td>
    <td width="930" vAlign="top">
    &nbsp;&nbsp;<img src="images/home/more.gif" border="0">
				<table width="100%" align="center" cellSpacing="0" cellPadding="0" border="0">
				<tr>
				<td>
                <div class="content-header"><b><font color="#990000" size="2"><?php echo $menuname ;?>&nbsp;&nbsp;</b></font> 
<?php 
if($admin_user){
// Input "menuname" in page header
// Show edit button for admin
echo '<a href="?compu=admin&loc=page&op=page_edit&id='.$arr['page']['id'].'"><img src="images/admin/edit.gif" border="0" alt="แก้ไข"></a>';
}
?>
                </div>
                </td>
                </tr>
                <tr>
                <td>&nbsp;</td>
                </tr>
				<tr>
				<td height="1" class="dotline"></td>
				</tr>
                <tr>
                <td>
                <br>
                <?php  echo $Detail; // Show Page Content ?>
                <br>
                </td>
                </tr>
                </table>
    </td>
    </tr>
</table>

