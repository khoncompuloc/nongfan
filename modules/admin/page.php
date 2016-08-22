<?
Check_passadu($admin_user,$admin_level);
?>

	<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="810" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="800" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?folder=admin&file=main">หน้าหลักผู้ดูแลระบบ</A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; เมนู </B>
					<BR><BR>
					<A HREF="?folder=admin&file=page"><IMG SRC="images/icon/open.gif"  BORDER="0" align="absmiddle"> รายการเมนู</A> &nbsp;&nbsp;&nbsp;<A HREF="?folder=admin&file=page&op=page_add"><IMG SRC="images/icon/book.gif"  BORDER="0" align="absmiddle"> เพิ่มรายการเมนู</A> &nbsp;&nbsp;&nbsp;
<?
//////////////////////////////////////////// แสดงรายการข่าวสาร / ประชาสัมพันธ์ 
if($op == ""){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 20 ;
	$SUMPAGE = $db->num_rows(TB_PAGE,"id","");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
 <form action="?folder=admin&file=page&op=page_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="2" cellpadding="1" >
  <tr bgcolor="#0066FF" height=25>
   <td width="44"><CENTER><font color="#FFFFFF"><B>Option</B></font></CENTER></td>
   <td><font color="#FFFFFF"><B>ชื่อ</B></font></td>
   <td width="100"><CENTER><font color="#FFFFFF"><B>กลุ่มเมนู</B></font></CENTER></td>
     <td width="40"><CENTER><font color="#FFFFFF"><B>ประเภท</B></font></CENTER></td>
     <td width="40"><CENTER><font color="#FFFFFF"><B>สถานะ</B></font></CENTER></td>
    <td width="40"><CENTER><font color="#FFFFFF"><B>ลำดับ</B></font></CENTER></td>
   <td width="40"><CENTER><font color="#FFFFFF"><B>Check</B></font></CENTER></td>

  </tr>  
<?
$res['page'] = $db->select_query("SELECT * FROM ".TB_PAGE." ORDER BY sort  LIMIT $goto, $limit ");
$rows['page'] = $db->rows($res['page']);
$CATCOUNT = 0 ;
$count=0;
while ($arr['page'] = mysql_fetch_array($res['page'])){
	$rows['pages'] = $db->num_rows(TB_PAGE,"id","");
    $CATCOUNT ++ ;
   //กำหนดการเปลี่ยนลำดับขึ้น
   $SETSORT_UP = $arr['page']['sort']-1;
   if($CATCOUNT == "1"){
	   $SETSORT_UP = "1" ;
   }
	//กำหนดการเปลี่ยนลำดับลง
   $SETSORT_DOWN = $arr['page']['sort']+1;
   if($CATCOUNT == $rows['pages']){
	   $SETSORT_DOWN = $arr['page']['sort'] ;
   }
    if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = "#FDEAFB";
} else {
$ColorFill = "#F0F0F0";
}

?>
    <tr bgcolor="<?=$ColorFill; ?>" onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='<?=$ColorFill;?>' ">
     <td width="44">
      <a href="?folder=admin&file=page&op=page_edit&id=<? echo $arr['page']['id'];?>"><img src="images/icon/edit.gif" border="0" alt="แก้ไข" ></a> 
      <a href="javascript:Confirm('?folder=admin&file=page&op=page_del&id=<? echo $arr['page']['id'];?>&prefix=<? echo $arr['page']['post_date'];?>','คุณมั่นใจในการลบหัวข้อนี้ ?');"><img src="images/icon/trash.gif"  border="0" alt="ลบ" ></a>
     </td>
<?	 echo '<td>';
//echo $arr['page']['links'];
if($arr['page']['links']){ echo '<a href='.$arr['page']['proto'].''.$arr['page']['links'].' target='.$arr['page']['target'].' >'.$arr['page']['menuname'].'</a>';
} else { echo '<a href="?folder=page&file=page&op='.$arr['page']['name'].'"> '.$arr['page']['menuname'].'</a>';}
echo '';
?></td>
     <td ><CENTER><? echo $arr['page']['menugr'];?></CENTER></td>
	  <td ><CENTER><? if ($arr['page']['links'] !=''){ echo "<font color=#00CC00><b>LINK</font></b>"; } else { echo "<font color=#CC0000><b>PAGE</font></b>"; } ?></CENTER></td>

	  <td ><CENTER><? if ($arr['page']['status']=='1'){ echo "<a HREF=?folder=admin&file=page&op=page_update&action=update&id=".$arr['page']['id']."&status=0><img src=images/tick.png></a>"; } else if ($arr['page']['status']=='0'){ echo "<a HREF=?folder=admin&file=page&op=page_update&action=update&id=".$arr['page']['id']."&status=1><img src=images/publish_x.png></a>"; }?></CENTER></td>

     <td align="center" width="50"><A HREF="?folder=admin&file=page&op=page_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['page']['id'];?>"><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="เลื่อนขึ้น"></A>&nbsp;&nbsp;&nbsp;<A HREF="?folder=admin&file=page&op=page_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['page']['id'];?>"><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="เลื่อนลง"></A></td>
     <td valign="top" align="center" width="40"><input type="checkbox" name="list[']" value="<? echo $arr['page']['id'];?>"></td>
    </tr>
	<TR>
		<TD colspan="6" height="1" class="dotline"></TD>
	</TR>
<?
		 $count++;
 } 
?>
 </table>
 <div align="right">
 <input type="button" name="CheckAll" value="Check All" onclick="checkAll(document.myform)" >
 <input type="button" name="UnCheckAll" value="Uncheck All" onclick="uncheckAll(document.myform)" >
 <input type="hidden" name="ACTION" value="page_del">
 <input type="submit" value="Delete" onclick="return delConfirm(document.myform)">
 </div>
 </form><BR><BR>
<?
	SplitPage($page,$totalpage,"?folder=admin&file=page");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
}
else if($op == "page_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม Database
	if(CheckLevel($admin_user,$op)){
	//	require("includes/class.resizepic.php");

		//ทำการเพิ่มข้อมูลลงดาต้าเบส
$REF = TIMESTAMP ; 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD); 
$res['maxsort'] = $db->select_query("SELECT max(sort) as maxs FROM ".TB_PAGE." ORDER BY sort DESC "); 
$arr['maxsort'] = mysql_fetch_array($res['maxsort']); 
$SORT = $arr['maxsort']['maxs']+1 ; 
// ?????????????????
if($_POST['LINKS']){
if($_POST['MENUGRX']){
$db->add_db(TB_PAGE,array(
"name"=> $_POST['NAME'],
"menuname"=> $_POST['MENUNAME'],
"menugr"=> "".$_POST['MENUGRX']."",
"status"=> "1",
"sort"=> "".$SORT."",
"proto"=> "".$_POST['PROTO']."",
"links"=> "".$_POST['LINKS']."",
"target"=> "".$_POST['TARGET'].""
));
$db->closedb ();
} else {
$db->add_db(TB_PAGE,array(
"name"=> $_POST['NAME'],
"menuname"=> $_POST['MENUNAME'],
"menugr"=> "".$_POST['MENUGR']."",
"status"=> "1",
"sort"=> "".$SORT."",
"proto"=> "".$_POST['PROTO']."",
"links"=> "".$_POST['LINKS']."",
"target"=> "".$_POST['TARGET'].""
));
$db->closedb ();
}

} else {
if($_POST['MENUGRX']){
$db->add_db(TB_PAGE,array(
"name"=> $_POST['NAME'],
"menuname"=> $_POST['MENUNAME'],
"detail"=> $_POST['DETAIL'],
"menugr"=> "".$_POST['MENUGRX']."",
"status"=> "1",
"sort"=> "".$SORT.""
));
$db->closedb ();
} else {
$db->add_db(TB_PAGE,array(
"name"=> $_POST['NAME'],
"menuname"=> $_POST['MENUNAME'],
"detail"=> $_POST['DETAIL'],
"menugr"=> "".$_POST['MENUGR']."",
"status"=> "1",
"sort"=> "".$SORT.""
));
$db->closedb ();
}

}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?folder=admin&file=main\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการเพิ่มเมนู   เข้าสู่ระบบเรียบร้อยแล้ว</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?folder=admin&file=page\"><B>กลับหน้า จัดการเมนู</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "page_add"){
	//////////////////////////////////////////// กรณีเพิ่ม Form
	if(CheckLevel($admin_user,$op)){
?>
<FORM NAME="myform" METHOD=POST ACTION="?folder=admin&file=page&op=page_add&action=add" enctype="multipart/form-data">
<B>ชื่อเมนู (ภาษาอังกฤษ) :</B><BR>
<INPUT TYPE="text" NAME="NAME" size="50">
<BR><BR>
<B>รายการเมนู :</B><BR>
<INPUT TYPE="text" NAME="MENUNAME" size="50">
<BR><BR>
<B>เลือกกลุ่มเมนู :</B><BR>
                          <select name="MENUGR" >
                            <option value="">-- เลือกกลุ่มเมนู--</option>
                            <?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_PAGE." group by menugr ORDER BY sort  ");
while($arr['category'] = $db->fetch($res['category'])){
	echo "<option value=".$arr['category']['menugr']."";
	if($category == $arr['category']['menugr']){
		echo " Selected";
	}
	echo ">".$arr['category']['menugr']."</option>\n";
}
$db->closedb ();
// ระบบค้นหาบทความของ maxsite 1.10 พัฒนาโดย www.narongrit.net
?>
</select>
&nbsp;หรือกำหนดกลุ่มใหม่&nbsp;<INPUT TYPE="text" NAME="MENUGRX" size="30">
<BR><BR>
<B>1. สร้างเป็น page เนื้อหา :</B><BR>
<textarea cols="100" id="DETAIL" rows="50" class="ckeditor"  name="DETAIL" ></textarea>
<BR><BR>
<B>2. สร้างเป็น link : ( copy link ที่ต้องการวางในนี้ )</B><BR>
<B>Protocal : </B>
                          <select name="PROTO" >
                            <option value="http://">http://</option>
							<option value="https://">https://</option>
							<option value="ftp://">ftp://</option>
							<option value="">--orther--</option>
</select><B> Url : </B><INPUT TYPE="text" NAME="LINKS" size="50">
<B>taget : </B>
                          <select name="TARGET" >
                            <option value="">-- noset--</option>
							<option value="_blank">New Window</option>
							<option value="_top">Topmost Window</option>
							<option value="_seft">Same Window</option>
							<option value="_parent">Parent Window</option>
</select>
<BR><br>
<input type="submit" value=" เพิ่มรายการเมนู " name="submit"> <input type="reset" value=" เคลีย " name="reset">
</FORM>
<BR><BR>
<?
	}else{
		//กรณีไม่ผ่าน
		echo  $PermissionFalse ;
	}
}
else if($op == "page_edit" AND $action == "edit" ){
	//////////////////////////////////////////// กรณีแก้ไข Database Edit
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['page'] = $db->select_query("SELECT max(sort) as maxs FROM ".TB_PAGE." WHERE id='".$_GET['id']."' ");
		$arr['page'] = $db->fetch($res['page']);
		$SORT = $arr['page']['maxs']+1 ; 
		$db->closedb ();

if($_POST['LINKS']){

if($_POST['MENUGRX']){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$db->update_db(TB_PAGE,array(
"name"=> $_POST['NAME'],
"menuname"=> $_POST['MENUNAME'],
"menugr"=> "".$_POST['MENUGRX']."",
"status"=> "1",
"proto"=> "".$_POST['PROTO']."",
"links"=> "".$_POST['LINKS']."",
"target"=> "".$_POST['TARGET'].""
)," id='".$_GET['id']."' ");
$db->closedb ();
} else {
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$db->update_db(TB_PAGE,array(
"name"=> $_POST['NAME'],
"menuname"=> $_POST['MENUNAME'],
"menugr"=> "".$_POST['MENUGR']."",
"status"=> "1",
"proto"=> "".$_POST['PROTO']."",
"links"=> "".$_POST['LINKS']."",
"target"=> "".$_POST['TARGET'].""
)," id='".$_GET['id']."' ");
$db->closedb ();
}

} else {
if($_POST['MENUGRX']){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$db->update_db(TB_PAGE,array(
"name"=> $_POST['NAME'],
"menuname"=> $_POST['MENUNAME'],
"detail"=> $_POST['DETAIL'],
"menugr"=> "".$_POST['MENUGRX']."",
"status"=> "1",
"proto"=> "",
"links"=> "",
"target"=> ""
)," id='".$_GET['id']."' ");
$db->closedb ();
} else {
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$db->update_db(TB_PAGE,array(
"name"=> $_POST['NAME'],
"menuname"=> $_POST['MENUNAME'],
"detail"=> $_POST['DETAIL'],
"menugr"=> "".$_POST['MENUGR']."",
"status"=> "1",
"proto"=> "",
"links"=> "",
"target"=> ""
)," id='".$_GET['id']."' ");
$db->closedb ();
}

}



		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?folder=admin&file=main\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการแก้ไขเมนูสร้างเอง เข้าสู่ระบบเรียบร้อยแล้ว</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?folder=admin&file=page\"><B>กลับหน้า จัดการเมนูสร้างเอง</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}

else if($op == "page_edit" AND $action == "sort"){
	//////////////////////////////////////////// กรณีแก้ไข Form
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['page'] = $db->select_query("SELECT * FROM ".TB_PAGE." WHERE id='".$_GET['id']."' ");
		$arr['page'] = $db->fetch($res['page']);
		$db->closedb ();

		//กรณีเลื่อนขึ้น
		if($_GET['move'] == "up"){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETD'] = "UPDATE ".TB_PAGE." SET sort = sort+1 WHERE sort = '".$_GET['setsort']."' ";
			$sql['SETD'] = mysql_query ( $q['SETD'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETU'] = "UPDATE ".TB_PAGE." SET sort = '".$_GET['setsort']."' WHERE id = '".$_GET['id']."' ";
			$sql['SETU'] = mysql_query ( $q['SETU'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();
		}
		if($_GET['move'] == "down"){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETD'] = "UPDATE ".TB_PAGE." SET sort = sort-1 WHERE sort = '".$_GET['setsort']."' ";
			$sql['SETD'] = mysql_query ( $q['SETD'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETU'] = "UPDATE ".TB_PAGE." SET sort = '".$_GET['setsort']."' WHERE id = '".$_GET['id']."' ";
			$sql['SETU'] = mysql_query ( $q['SETU'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?folder=admin&file=main\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการแก้ไขเมนูสร้างเอง เข้าสู่ระบบเรียบร้อยแล้ว</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?folder=admin&file=page\"><B>กลับหน้า จัดการเมนูสร้างเอง</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "page_edit" ){
	//////////////////////////////////////////// กรณีแก้ไข Form
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['page'] = $db->select_query("SELECT * FROM ".TB_PAGE." WHERE id='".$_GET['id']."' ");
		$arr['page'] = $db->fetch($res['page']);

		$TextContent = $arr['page']['detail'];
		$TextContent = stripslashes($TextContent);
		$db->closedb ();
?>
<FORM NAME="myform" METHOD=POST ACTION="?folder=admin&file=page&op=page_edit&action=edit&id=<?=$_GET['id'];?>" enctype="multipart/form-data">
<B>ชื่อเมนู (ภาษาอังกฤษ) :</B><BR>
<INPUT TYPE="text" NAME="NAME" size="50" value="<?=$arr['page']['name'];?>">
<BR><BR>
<B>รายการเมนู :</B><BR>
<INPUT TYPE="text" NAME="MENUNAME" size="50" value="<?=$arr['page']['menuname'];?>">
<BR><BR>
<B>เลือกกลุ่มเมนู :</B><BR>
                          <select name="MENUGR" >
                            <option value="">-- เลือกกลุ่มเมนู--</option>
                            <?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_PAGE." group by menugr ORDER BY sort  ");
while($arr['category'] = $db->fetch($res['category'])){
	echo "<option value=".$arr['category']['menugr']."";
	if($arr['page']['menugr'] == $arr['category']['menugr']){
		echo " Selected";
	}
	echo ">".$arr['category']['menugr']."</option>\n";
}
$db->closedb ();
// ระบบค้นหาบทความของ maxsite 1.10 พัฒนาโดย www.narongrit.net
?>
</select>
&nbsp;หรือกำหนดกลุ่มใหม่&nbsp;<INPUT TYPE="text" NAME="MENUGRX" size="30">
<BR><BR>
<B>1. สร้างเป็น page เนื้อหา :</B><BR>
<!-- <textarea cols="100" id="DETAIL" rows="50" class="ckeditor"  name="DETAIL" ><?//=$TextContent;?></textarea> -->
<?
include("FCKeditor/fckeditor.php") ;
$oFCKeditor = new FCKeditor('DETAIL') ;
$oFCKeditor->BasePath	= 'FCKeditor/' ;
$oFCKeditor->Width	= '100%' ;
$oFCKeditor->Height	= '500' ;
$oFCKeditor->Value		= $TextContent ;
$oFCKeditor->Create() ;
?>
<BR><BR>
<B>2. สร้างเป็น link : ( copy link ที่ต้องการวางในนี้ )</B><BR>
<B>Protocal : </B>
                          <select name="PROTO" >
                            <option value="http://" <?if ($arr['page']['proto']=='http://') { echo " Selected" ; } ?>>http://</option>
							<option value="https://" <?if ($arr['page']['proto']=='https://') { echo " Selected" ; } ?>>https://</option>
							<option value="ftp://" <?if ($arr['page']['proto']=='ftp://') { echo " Selected" ; } ?>>ftp://</option>
							<option value="" <?if ($arr['page']['proto']=='') { echo " Selected" ; } ?>>--orther--</option>
</select><B> Url : </B><INPUT TYPE="text" NAME="LINKS" size="50" value="<?=$arr['page']['links'];?>">
<B>taget : </B>
                          <select name="TARGET" >
                            <option value="" <?if ($arr['page']['target']=='') { echo " Selected" ; } ?>>-- noset--</option>
							<option value="_blank" <?if ($arr['page']['target']=='_blank') { echo " Selected" ; } ?>>New Window</option>
							<option value="_top" <?if ($arr['page']['target']=='_top') { echo " Selected" ; } ?>>Topmost Window</option>
							<option value="_seft" <?if ($arr['page']['target']=='_seft') { echo " Selected" ; } ?>>Same Window</option>
							<option value="_parent" <?if ($arr['page']['target']=='_parent') { echo " Selected" ; } ?>>Parent Window</option>
</select>
<BR><br>
<input type="submit" value=" แก้ไขเมนูสร้างเอง" name="submit"> <input type="reset" value=" เคลีย " name="reset">
</FORM>
<BR><BR>
<?
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}

}
else if($op == "page_del" AND $action == "multidel"){
	//////////////////////////////////////////// กรณีลบ Multi
	if(CheckLevel($admin_user,$op)){
		while(list($key, $value) = each ($_POST['list'])){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['page'] = $db->select_query("SELECT * FROM ".TB_PAGE." WHERE id='".$value."' ");
			$arr['page'] = $db->fetch($res['page']);
			$db->del(TB_PAGE," id='".$value."' "); 
			$db->closedb ();

		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?folder=admin&file=main\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการลบเมนูสร้างเองเรียบร้อยแล้ว</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?folder=admin&file=page\"><B>กลับหน้า จัดการเมนูสร้างเอง</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "page_del"){
	//////////////////////////////////////////// กรณีลบ Form
	if(CheckLevel($admin_user,$op)){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->del(TB_PAGE," id='".$_GET['id']."' "); 
		$db->closedb ();

		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?folder=admin&file=main\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการลบเมนูสร้างเองเรียบร้อยแล้ว</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?folder=admin&file=page\"><B>กลับหน้า จัดการเมนูสร้างเอง</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "page_update" AND $action == "update"){

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_PAGE,array(
			"status"=>"".$_GET['status'].""
		)," id='".$_GET['id']."'");
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?folder=admin&file=main\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการ update เมนูเรียบร้อยแล้ว</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?folder=admin&file=page\"><B>กลับหน้า จัดการเมนู</B></A>";
		$ProcessOutput .= "<meta http-equiv='refresh' content='1; url=?folder=admin&file=page'>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

	echo $ProcessOutput ;
}

?>
						<BR><BR>
					</TD>
				</TR>
			</TABLE>
							</TD>
				</TR>
			</TABLE>
