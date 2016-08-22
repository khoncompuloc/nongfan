<?php 
CheckAdmin($admin_user,$admin_level);
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
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?folder=admin&file=main">หน้าหลักผู้ดูแลระบบ</A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; การจัดการ block </B>
					<BR><BR>
					<A HREF="?folder=admin&file=block"><IMG SRC="images/icon/open.gif"  BORDER="0" align="absmiddle"> รายการ block</A> &nbsp;&nbsp;&nbsp;<A HREF="?folder=admin&file=block&op=block_add"><IMG SRC="images/icon/book.gif"  BORDER="0" align="absmiddle"> เพิ่มรายการ block</A> &nbsp;&nbsp;&nbsp;
<?php 
//////////////////////////////////////////// แสดงรายการข่าวสาร / ประชาสัมพันธ์ 
if($op == ""){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 30 ;
	$SUMPAGE= $db->num_rows(TB_BLOCK,"id","");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
 <form action="?folder=admin&file=block&op=block_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="2" cellpadding="1" >
  <tr bgcolor="#0066FF" height=25>
   <td width="44"><CENTER><font color="#FFFFFF"><B>Option</B></font></CENTER></td>
      <td width="130"><CENTER><font color="#FFFFFF"><B>ชื่อ</B></font></CENTER></td>
   <td><font color="#FFFFFF"><CENTER><B>รายละเอียด</B></font></td>
   <td width="100"><CENTER><font color="#FFFFFF"><B>สถานะ/ตำแหน่ง</B></font></CENTER></td>
    <td width="40"><CENTER><font color="#FFFFFF"><B>ลำดับ</B></font></CENTER></td>
      <td width="50"><CENTER><font color="#FFFFFF"><B>สถานะ</B></font></CENTER></td>
   <td width="40"><CENTER><font color="#FFFFFF"><B>Check</B></font></CENTER></td>
  </tr>  
<?php 
$res['block'] = $db->select_query("SELECT * FROM ".TB_BLOCK." ORDER BY pblock,sort  LIMIT $goto, $limit ");
$rows['block'] = $db->rows($res['block']);

$res['left'] = $db->select_query("SELECT * FROM ".TB_BLOCK." where pblock='left' ORDER BY sort  ");
$rows['left'] = $db->rows($res['left']);
$res['center'] = $db->select_query("SELECT * FROM ".TB_BLOCK." where pblock='center' ORDER BY sort  ");
$rows['center'] = $db->rows($res['center']);
$res['right'] = $db->select_query("SELECT * FROM ".TB_BLOCK." where pblock='right' ORDER BY sort  ");
$rows['right'] = $db->rows($res['right']);
$res['user1'] = $db->select_query("SELECT * FROM ".TB_BLOCK." where pblock='user1' ORDER BY sort  ");
$rows['user1'] = $db->rows($res['user1']);
$res['user2'] = $db->select_query("SELECT * FROM ".TB_BLOCK." where pblock='user2' ORDER BY sort  ");
$rows['user2'] = $db->rows($res['user2']);
$res['bottom'] = $db->select_query("SELECT * FROM ".TB_BLOCK." where pblock='bottom' ORDER BY sort  ");
$rows['bottom'] = $db->rows($res['bottom']);

$CATCOUNT = 0 ;
$count=0;
while ($arr['block'] = mysql_fetch_array($res['block'])){

    $CATCOUNT ++ ;
   //กำหนดการเปลี่ยนลำดับขึ้น
   $SETSORT_UP = $arr['block']['sort']-1;
   if($CATCOUNT == "1"){
	   $SETSORT_UP = "1" ;
   }
	//กำหนดการเปลี่ยนลำดับลง
   $SETSORT_DOWN = $arr['block']['sort']+1;
   if($CATCOUNT == $rows['block']){
	   $SETSORT_DOWN = $arr['block']['sort'] ;
   }
    if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = "#FDEAFB";
} else {
$ColorFill = "#F0F0F0";
}

?>
    <tr bgcolor="<?php echo $ColorFill; ?>" onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='<?php echo $ColorFill;?>' ">
     <td width="44">
      <a href="?folder=admin&file=block&op=block_edit&id=<?php  echo $arr['block']['id'];?>"><img src="images/icon/edit.gif" border="0" alt="แก้ไข" ></a> 
      <a href="javascript:Confirm('?folder=admin&file=block&op=block_del&id=<?php  echo $arr['block']['id'];?>&prefix=<?php  echo $arr['block']['post_date'];?>','คุณมั่นใจในการลบหัวข้อนี้ ?');"><img src="images/icon/trash.gif"  border="0" alt="ลบ" ></a>
     </td> 
	      <td><A HREF="index2.php?folder=block&file=<?php echo $arr['block']['filename'];?>&op=show" target="_blank"><?php echo $arr['block']['name'];?></A></td>
     <td><A HREF="index2.php?folder=block&file=<?php echo $arr['block']['filename'];?>&op=show" target="_blank"><?php echo $arr['block']['blockname'];?></A></td>
     <td ><CENTER><?php  if ($arr['block']['pblock']=='0'){ echo "<font color=#CC0000><b>ไม่แสดง</font>"; } else if ($arr['block']['pblock']=='center'){ echo "<font color=#CC0000><b>ตรงกลาง</font>"; }  else if ($arr['block']['pblock']=='left'){ echo "<font color=#9900CC><b>ซ้าย</font>"; }  else if ($arr['block']['pblock']=='right'){ echo "<font color=#33FF00><b>ขวา</font>"; }else if ($arr['block']['pblock']=='user1'){ echo "<font color=#33FF00><b>user1</font>"; }else if ($arr['block']['pblock']=='user2'){ echo "<font color=#33FF00><b>user2</font>"; }else if ($arr['block']['pblock']=='bottom'){ echo "<font color=#33FF00><b>bottom</font>"; }?></CENTER></td>

     <td align="center" width="50">
	 
	 <?php
		
		if ($arr['block']['pblock']=='left' ){ 
			 if ($arr['block']['sort']==1){?>
		 <A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_DOWN ;?>&move=down&id=<?php  echo $arr['block']['id'];?>&pblock=<?php echo $arr['block']['pblock'];?>"><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="เลื่อนลง"></A>
		<?php } else if ($arr['block']['sort']==$rows['left'] ){?>
		<A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_UP ;?>&move=up&id=<?php  echo $arr['block']['id'];?>&pblock=<?php echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="เลื่อนขึ้น"></A>
		 <?php }else{?>
		<A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_UP ;?>&move=up&id=<?php  echo $arr['block']['id'];?>&pblock=<?php echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="เลื่อนขึ้น"></A>&nbsp;&nbsp;&nbsp;<A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_DOWN ;?>&move=down&id=<?php  echo $arr['block']['id'];?>&pblock=<?php echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="เลื่อนลง"></A><?php }
		} else	if ($arr['block']['pblock']=='center' ){ 
			 if ($arr['block']['sort']==1){?>
		 <A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_DOWN ;?>&move=down&id=<?php  echo $arr['block']['id'];?>&pblock=<?php echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="เลื่อนลง"></A>
		<?php } else if ($arr['block']['sort']==$rows['center'] ){?>
		<A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_UP ;?>&move=up&id=<?php  echo $arr['block']['id'];?>&pblock=<?php echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="เลื่อนขึ้น"></A>
		 <?php }else{?>
		<A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_UP ;?>&move=up&id=<?php  echo $arr['block']['id'];?>&pblock=<?php echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="เลื่อนขึ้น"></A>&nbsp;&nbsp;&nbsp;<A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_DOWN ;?>&move=down&id=<?php  echo $arr['block']['id'];?>"><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="เลื่อนลง"></A><?php }
		} else	if ($arr['block']['pblock']=='right' ){ 
			 if ($arr['block']['sort']==1){?>
		 <A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_DOWN ;?>&move=down&id=<?php  echo $arr['block']['id'];?>&pblock=<?php echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="เลื่อนลง"></A>
		<?php } else if ($arr['block']['sort']==$rows['right'] ){?>
		<A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_UP ;?>&move=up&id=<?php  echo $arr['block']['id'];?>&pblock=<?php echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="เลื่อนขึ้น"></A>
		 <?php }else{?>
		<A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_UP ;?>&move=up&id=<?php  echo $arr['block']['id'];?>&pblock=<?php echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="เลื่อนขึ้น"></A>&nbsp;&nbsp;&nbsp;<A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_DOWN ;?>&move=down&id=<?php  echo $arr['block']['id'];?>"><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="เลื่อนลง"></A><?php }
		} else  if ($arr['block']['pblock']=='user1' ){ 
			 if ($arr['block']['sort']==1){?>
		 <A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_DOWN ;?>&move=down&id=<?php  echo $arr['block']['id'];?>&pblock=<?php echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="เลื่อนลง"></A>
		<?php } else if ($arr['block']['sort']==$rows['user1'] ){?>
		<A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_UP ;?>&move=up&id=<?php  echo $arr['block']['id'];?>&pblock=<?php echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="เลื่อนขึ้น"></A>
		 <?php }else{?>
		<A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_UP ;?>&move=up&id=<?php  echo $arr['block']['id'];?>&pblock=<?php echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="เลื่อนขึ้น"></A>&nbsp;&nbsp;&nbsp;<A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_DOWN ;?>&move=down&id=<?php  echo $arr['block']['id'];?>"><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="เลื่อนลง"></A><?php }
		} else if ($arr['block']['pblock']=='user2' ){ 
			 if ($arr['block']['sort']==1){?>
		 <A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_DOWN ;?>&move=down&id=<?php  echo $arr['block']['id'];?>&pblock=<?php echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="เลื่อนลง"></A>
		<?php } else if ($arr['block']['sort']==$rows['user2'] ){?>
		<A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_UP ;?>&move=up&id=<?php  echo $arr['block']['id'];?>&pblock=<?php echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="เลื่อนขึ้น"></A>
		 <?php }else{?>
		<A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_UP ;?>&move=up&id=<?php  echo $arr['block']['id'];?>&pblock=<?php echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="เลื่อนขึ้น"></A>&nbsp;&nbsp;&nbsp;<A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_DOWN ;?>&move=down&id=<?php  echo $arr['block']['id'];?>"><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="เลื่อนลง"></A><?php }
		} else if ($arr['block']['pblock']=='bottom' ){ 
			 if ($arr['block']['sort']==1){?>
		 <A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_DOWN ;?>&move=down&id=<?php  echo $arr['block']['id'];?>&pblock=<?php echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="เลื่อนลง"></A>
		<?php } else if ($arr['block']['sort']==$rows['bottom'] ){?>
		<A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_UP ;?>&move=up&id=<?php  echo $arr['block']['id'];?>&pblock=<?php echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="เลื่อนขึ้น"></A>
		 <?php }else{?>
		<A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_UP ;?>&move=up&id=<?php  echo $arr['block']['id'];?>&pblock=<?php echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="เลื่อนขึ้น"></A>&nbsp;&nbsp;&nbsp;<A HREF="?folder=admin&file=block&op=block_edit&action=sort&setsort=<?php echo $SETSORT_DOWN ;?>&move=down&id=<?php  echo $arr['block']['id'];?>&pblock=<?php echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="เลื่อนลง"></A><?php }
		} else{echo "";}?>


	 </td>
	<td align="center"  valign="top">
				  <?php  if($arr['block']['status']=='0') { echo "<a HREF=?folder=admin&file=block&op=block_update&action=update&id=".$arr['block']['id']."&status=1><img src=images/publish_x.png alt='ไม่เผยแพร่'></a>"; } else { echo "<a HREF=?folder=admin&file=block&op=block_update&action=update&id=".$arr['block']['id']."&status=0><img src=images/tick.png alt='่เผยแพร่'></a>"; };?>
				  </td>

     <td valign="top" align="center" width="40"><input type="checkbox" name="list[]" value="<?php  echo $arr['block']['id'];?>"></td>
    </tr>
	<TR>
		<TD colspan="6" height="1" class="dotline"></TD>
	</TR>
<?php 
		 $count++;
 } 
?>
 </table>
 <div align="right">
 <input type="button" name="CheckAll" value="Check All" onclick="checkAll(document.myform)" >
 <input type="button" name="UnCheckAll" value="Uncheck All" onclick="uncheckAll(document.myform)" >
 <input type="hidden" name="ACTION" value="block_del">
 <input type="submit" value="Delete" onclick="return delConfirm(document.myform)">
 </div>
 </form><BR><BR>
<?php 
		SplitPage($page,$totalpage,"?folder=admin&file=block");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
}
else if($op == "block_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม Database
	if(CheckLevel($admin_user,$op)){
	//	require("includes/class.resizepic.php");

		//ทำการเพิ่มข้อมูลลงดาต้าเบส
$REF = TIMESTAMP ; 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD); 
$res['maxsort'] = $db->select_query("SELECT *,count(pblock) as srt FROM ".TB_BLOCK." where pblock='".$_POST['PBLOCK']."' group by pblock ORDER BY sort DESC "); 
$arr['maxsort'] = mysql_fetch_array($res['maxsort']); 
$SORT = $arr['maxsort']['srt']+1 ; 
// ?????????????????
$db->add_db(TB_BLOCK,array(
"name"=> $_POST['NAME'],
"blockname"=> $_POST['BLOCKNAME'],
"filename"=> $_POST['FILENAME'],
"sfile"=> $_POST['SFILE'],
"code"=> $_POST['DETAIL'],
"pblock"=> $_POST['PBLOCK'],
"status"=> intval($_POST['STATUS']),
"sort"=>$SORT
));
$db->closedb ();


		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?folder=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการเพิ่ม block  เข้าสู่ระบบเรียบร้อยแล้ว</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?folder=admin&file=block\"><B>กลับหน้า จัดการ block</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "block_add"){
	//////////////////////////////////////////// กรณีเพิ่ม Form
	if(CheckLevel($admin_user,$op)){
?>
<FORM NAME="myform" METHOD=POST ACTION="?folder=admin&file=block&op=block_add&action=add" enctype="multipart/form-data">
<BR><BR><B>ชื่อ block (ภาษาอังกฤษ) :</B><BR>
<INPUT TYPE="text" NAME="NAME" size="20">
<BR><BR>
<B>รายการ block :</B><BR>
<INPUT TYPE="text" NAME="BLOCKNAME" size="50">
<BR>
<B>ชื่อไฟล์:</B><BR>
<INPUT TYPE="text" NAME="FILENAME" size="20">
<BR><BR>
<B>นามสกุลไฟล์ :</B><BR>
 <select name="SFILE">
<option value="">---</option>
<option value="php">php</option>
<option value="html">html</option>
<option value="htm">htm</option>
</select>
<BR><BR>
การแสดงผล<input type=radio name=STATUS value=0><B>ไม่แสดง</B><input type=radio name=STATUS value=1><B>แสดง</B><br>
ตำแหน่งการแสดง<input type=radio name=PBLOCK value=center><B>ตรงกลาง</B><input type=radio name=PBLOCK value=left><B>ด้านซ้าย</B><input type=radio name=PBLOCK value=right><B>ด้านขวา</B><input type=radio name=PBLOCK value=user1><B>user1</B><input type=radio name=PBLOCK value=user2><B>user2</B><input type=radio name=PBLOCK value=bottom><B>bottom</B><BR>
<BR><BR>
<B>สร้าง block เอง :</B><BR>
<textarea cols="100" id="DETAIL" rows="50" class="ckeditor"  name="DETAIL" ></textarea>

<input type="submit" value=" เพิ่มรายการเมนู " name="submit"> <input type="reset" value=" เคลีย " name="reset">
</FORM>
<BR><BR>
<?php 
	}else{
		//กรณีไม่ผ่าน
		echo  $PermissionFalse ;
	}
}
else if($op == "block_edit" AND $action == "edit" ){
	//////////////////////////////////////////// กรณีแก้ไข Database Edit
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['maxsort'] = $db->select_query("SELECT *,count(pblock) as srt FROM ".TB_BLOCK." where pblock='".$_POST['PBLOCK']."' group by pblock ORDER BY sort DESC "); 
$arr['maxsort'] = mysql_fetch_array($res['maxsort']);
if ($_POST['pblock_old'] !=$_POST['PBLOCK']){
$SORT = $arr['maxsort']['srt']+1;
} else {
$SORT=$_POST['pblock_old'];
}

		//ทำการแก้ไขข้อมูลลงดาต้าเบส
//$REF = TIMESTAMP ;
if ($_POST['FILENAME']){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$db->update_db(TB_BLOCK,array(
"name"=> $_POST['NAME'],
"blockname"=> $_POST['BLOCKNAME'],
"filename"=> $_POST['FILENAME'],
"sfile"=> $_POST['SFILE'],
"code"=> "",
"pblock"=> $_POST['PBLOCK'],
"sort"=>"".$SORT."",
"status"=> intval($_POST['STATUS'])
)," id=".$_GET['id']." ");
		$db->closedb ();
//file_put_contents("".WEB_PATH."/psdloc/block/".$_POST['FILENAME'].".".$_POST['SFILE']."", "".$_POST['DETAIL']."", FILE_APPEND);
$handle = fopen("".WEB_PATH."/psdloc/block/".$_POST['FILENAME'].".".$_POST['SFILE']."", "w");
fwrite($handle, "".stripslashes($_POST['DETAIL'])."");
fclose($handle);
} else {
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$db->update_db(TB_BLOCK,array(
"name"=> $_POST['NAME'],
"blockname"=> $_POST['BLOCKNAME'],
"filename"=> "",
"sfile"=> "",
"code"=> $_POST['DETAIL'],
"pblock"=> $_POST['PBLOCK'],
"sort"=>"".$SORT."",
"status"=> intval($_POST['STATUS'])
)," id=".$_GET['id']." ");
		$db->closedb ();
}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?folder=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการแก้ไขเมนูสร้างเอง เข้าสู่ระบบเรียบร้อยแล้ว</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?folder=admin&file=block\"><B>กลับหน้า จัดการเมนูสร้างเอง</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}

else if($op == "block_edit" AND $action == "sort"){
	//////////////////////////////////////////// กรณีแก้ไข Form
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['block'] = $db->select_query("SELECT * FROM ".TB_BLOCK." WHERE id='".$_GET['id']."' ");
		$arr['block'] = $db->fetch($res['block']);
		$db->closedb ();

		//กรณีเลื่อนขึ้น
		if($_GET['move'] == "up"){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETD'] = "UPDATE ".TB_BLOCK." SET sort = sort+1 WHERE sort = '".$_GET['setsort']."' and pblock='".$_GET['pblock']."' ";
			$sql['SETD'] = mysql_query ( $q['SETD'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETU'] = "UPDATE ".TB_BLOCK." SET sort = '".$_GET['setsort']."' WHERE id = '".$_GET['id']."' and pblock='".$_GET['pblock']."' ";
			$sql['SETU'] = mysql_query ( $q['SETU'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();
		}
		if($_GET['move'] == "down"){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETD'] = "UPDATE ".TB_BLOCK." SET sort = sort-1 WHERE sort = '".$_GET['setsort']."' and pblock='".$_GET['pblock']."'  ";
			$sql['SETD'] = mysql_query ( $q['SETD'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETU'] = "UPDATE ".TB_BLOCK." SET sort = '".$_GET['setsort']."' WHERE id = '".$_GET['id']."' and pblock='".$_GET['pblock']."' ";
			$sql['SETU'] = mysql_query ( $q['SETU'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();
		}
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?folder=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการแก้ไขเมนูสร้างเอง เข้าสู่ระบบเรียบร้อยแล้ว</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?folder=admin&file=block\"><B>กลับหน้า จัดการเมนูสร้างเอง</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "block_edit" ){
	//////////////////////////////////////////// กรณีแก้ไข Form
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['block'] = $db->select_query("SELECT * FROM ".TB_BLOCK." WHERE id='".$_GET['id']."' ");
		$arr['block'] = $db->fetch($res['block']);
		$db->closedb ();
		if($arr['block']['code']){
		$TextContent = stripslashes($arr['block']['code']);
		} else {
		$TextContent = file_get_contents ("psdloc/block/".$arr['block']['filename'].".".$arr['block']['sfile']."");
		}
?>
<FORM NAME="myform" METHOD=POST ACTION="?folder=admin&file=block&op=block_edit&action=edit&id=<?php echo $_GET['id'];?>" enctype="multipart/form-data">
<B>ชื่อ  block (ภาษาอังกฤษ) :</B><BR>
<INPUT TYPE="text" NAME="NAME" size="50" value="<?php echo $arr['block']['name'];?>">
<BR><BR>
<B>รายการ block :</B><BR>
<INPUT TYPE="text" NAME="BLOCKNAME" size="50" value="<?php echo $arr['block']['blockname'];?>">
<BR>
<B>ชื่อไฟล์:</B><BR>
<INPUT TYPE="text" NAME="FILENAME" size="20" value="<?php echo $arr['block']['filename'];?>">
<BR><BR>
<B>นามสกุลไฟล์ :</B><BR>
<INPUT TYPE="text" NAME="SFILE" size="20" value="<?php echo $arr['block']['sfile'];?>">
</select>
<BR>
<BR>
<input type="hidden" name=pblock_old value="<?php echo $arr['block']['pblock'];?>">
<?php 
		echo "<B>สถานะ / ตำแหน่งแสดงผล</B>&nbsp;&nbsp;<input type=Radio "; ?><?php  if ($arr['block']['status']==0) { echo "checked"; } ?> <?php   echo " name=STATUS  value=0>ไม่แสดง&nbsp;&nbsp;<input type=Radio ";?><?php  if ($arr['block']['status']==1) { echo "checked"; } ?> <?php   echo " name=STATUS value=1>แสดง&nbsp;&nbsp;<br><b>ตำแหน่งการแสดงผล</b><input type=Radio "; ?><?php  if ($arr['block']['pblock']==center) { echo "checked"; } ?> <?php   echo " name=PBLOCK  value=center>ตรงกลาง&nbsp;&nbsp;<input type=Radio "; ?><?php  if ($arr['block']['pblock']==left) { echo "checked"; } ?> <?php   echo " name=PBLOCK  value=left>ด้านซ้าย&nbsp;&nbsp;<input type=Radio "; ?><?php  if ($arr['block']['pblock']==right) { echo "checked"; } ?> <?php   echo " name=PBLOCK  value=right>ด้านขวา&nbsp;&nbsp;<input type=Radio "; ?><?php  if ($arr['block']['pblock']==user1) { echo "checked"; } ?> <?php   echo " name=PBLOCK  value=user1>user1&nbsp;&nbsp;<input type=Radio "; ?><?php  if ($arr['block']['pblock']==user2) { echo "checked"; } ?> <?php   echo " name=PBLOCK  value=user2>user2&nbsp;&nbsp;<input type=Radio "; ?><?php  if ($arr['block']['pblock']==bottom) { echo "checked"; } ?> <?php   echo " name=PBLOCK  value=bottom>bottom<BR>";
?>
<BR>
<B>สร้าง block เอง :</B><BR>
<?php  if ($arr['block']['filename']){?><textarea cols="150" id="DETAIL" rows="30" name="DETAIL" ><?php echo $TextContent;?></textarea>
<?php } else{?>
<textarea cols="150" id="DETAIL" rows="50" class="ckeditor"  name="DETAIL" ><?php echo $TextContent;?></textarea>
<?php }?>
<br><input type="submit" value=" แก้ไขเมนูสร้างเอง" name="submit"> <input type="reset" value=" เคลีย " name="reset">
</FORM>
<BR><BR>
<?php 
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}

}
else if($op == "block_del" AND $action == "multidel"){
	//////////////////////////////////////////// กรณีลบ Multi
	if(CheckLevel($admin_user,$op)){

		while(list($key, $value) = each ($_POST['list'])){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['block'] = $db->select_query("SELECT * FROM ".TB_BLOCK." WHERE id='".$value."' ");
			$arr['block'] = $db->fetch($res['block']);
			$res['blocks'] = $db->select_query("SELECT * FROM ".TB_BLOCK." WHERE sort >'".$arr['block']['sort']."' and pblock='".$arr['block']['pblock']."' order by sort");
			
			while($arr['blocks'] = $db->fetch($res['blocks'])){
			$i=1;
			$sortd=$arr['blocks']['sort']-$i;
			$db->update_db(TB_BLOCK,array(
			"sort"=> $sortd
			)," id=".$arr['blocks']['id']." ");
			}
			$db->del(TB_BLOCK," id='".$value."' "); 
			$db->closedb ();

		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?folder=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการลบเมนูสร้างเองเรียบร้อยแล้ว</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?folder=admin&file=block\"><B>กลับหน้า จัดการเมนูสร้างเอง</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "block_del"){
	//////////////////////////////////////////// กรณีลบ Form
	if(CheckLevel($admin_user,$op)){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['block'] = $db->select_query("SELECT * FROM ".TB_BLOCK." WHERE id='".$_GET['id']."' ");
			$arr['block'] = $db->fetch($res['block']);
			$res['blocks'] = $db->select_query("SELECT * FROM ".TB_BLOCK." WHERE sort >'".$arr['block']['sort']."' and pblock='".$arr['block']['pblock']."' order by sort");
			while($arr['blocks'] = $db->fetch($res['blocks'])){
			$i=1;
			$db->update_db(TB_BLOCK,array(
			"sort"=> $arr['blocks']['sort']-$i
			)," id=".$arr['blocks']['id']." ");
			}

		$db->del(TB_BLOCK," id='".$_GET['id']."' "); 
		$db->closedb ();

//	@unlink("blockicon/".$_GET['prefix'].".jpg");
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?folder=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการลบเมนูสร้างเองเรียบร้อยแล้ว</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?folder=admin&file=block\"><B>กลับหน้า จัดการเมนูสร้างเอง</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "block_update" AND $action == "update"){

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_BLOCK,array(
			"status"=>"".$_GET['status'].""
		)," id=".$_GET['id']."");
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?folder=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการ update block เรียบร้อยแล้ว</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?folder=admin&file=block\"><B>กลับหน้า จัดการ block </B></A>";
		$ProcessOutput .= "<meta http-equiv='refresh' content='1; url=?folder=admin&file=block'>";
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
