<?php
//countblock
function CountBlock($pblock=""){
	global $db ;
	//Check Level
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['Countsx'] = $db->select_query("SELECT *,count(pblock) as num FROM ".TB_BLOCK." WHERE status='1' and pblock='$pblock' group by pblock");
	$arr['Countsx'] = $db->fetch($res['Countsx']);
if($arr['Countsx']['num']){
return True;
} else {
echo "";
}
}

//loadblock
function LoadBlock($pblock=""){
	global $db ;
	//Check Level
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['blocksx'] = $db->select_query("SELECT * FROM ".TB_BLOCK." WHERE status='1' and pblock='$pblock' order by sort");
	while($arr['blocksx'] = $db->fetch($res['blocksx'])){
	$name=$arr['blocksx']['name'];
	$filename=$arr['blocksx']['filename'];
	$sfile=$arr['blocksx']['sfile'];
	$code=$arr['blocksx']['code'];
	if($code==''){
	include ("naivoi/".$name."/".$filename.".".$sfile."");
	}else{
	echo $code;
	}
	}
}

function OpenTable(){
echo "<table cellSpacing=0 cellPadding=0 width=580  border=0>
      <tbody>
        <tr>
          <td><img src=images/main/1.gif border=0 width=7 height=7></td><td background=images/main/2.gif border=0 height=7 width=560></td><td><img src=images/main/3.gif border=0 width=7 height=7></td>
		</tr>
        <tr>
          <td background=images/main/4.gif border=0 height=100% width=7></td>
		  <td width=100%>";

}
function CloseTable(){
echo "</td>
  <TD background=images/main/5.gif border=0 height=100% width=7></td>
		</tr>
        <TR>
          <TD><img src=images/main/6.gif border=0 width=7 height=7></td><td background=images/main/7.gif border=0 height=7 width=560></td><td><img src=images/main/8.gif border=0 width=7 height=7></td>
		</tr>
		</table>";

}
function FixQuotes ($what = ""){
        $what = ereg_replace("'","''",$what);
        while (eregi("\\\\'", $what)) {
                $what = ereg_replace("\\\\'","'",$what);
        }
        return $what;
}

//แปลงเวลาเป็นภาษาไทย
function ThaiTimeConvert($timestamp="",$full="",$showtime=""){
	global $SHORT_MONTH, $FULL_MONTH, $DAY_SHORT_TEXT, $DAY_FULL_TEXT;
	$day = date("l",$timestamp);
	$month = date("n",$timestamp);
	$year = date("Y",$timestamp);
	$short_year = date("y",$timestamp);
	$time = date("H:i:s",$timestamp);
	$times = date("H:i",$timestamp);
	if($full == "1"){
		$ThaiText = $DAY_FULL_TEXT[$day]." ที่ ".date("j",$timestamp)." เดือน ".$FULL_MONTH[$month]." พ.ศ.".($year+543) ;
    }else if($full == "2"){		
		$ThaiText = "วันที่&nbsp;&nbsp;&nbsp;".date("j",$timestamp)."&nbsp;&nbsp;&nbsp;เดือน&nbsp;&nbsp;&nbsp;".$FULL_MONTH[$month]."&nbsp;&nbsp;&nbsp;พ.ศ.&nbsp;&nbsp;".($year+543) ;
    }else if($full == "3"){		
		$ThaiText = "".date("j",$timestamp)."&nbsp;&nbsp;".$FULL_MONTH[$month]."&nbsp;&nbsp;".($year+543) ;		
    }else if($full == "4"){		
		$ThaiText = "".date("j",$timestamp)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		.$FULL_MONTH[$month]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".($year+543) ;	
	}else if($full == "5"){		
		$ThaiText = date("j",$timestamp)." ".$SHORT_MONTH[$month]." ".($short_year+43);
	}else{
		$ThaiText = date("j",$timestamp)." ".$SHORT_MONTH[$month]." ".($year+543);
	}

	if($showtime == "1"){
		return $ThaiText." เวลา ".$time;
	}else if($showtime == "2"){
		$ThaiText = date("j",$timestamp)." ".$SHORT_MONTH[$month]." ".($year+543);
		return $ThaiText." : ".$times;
	}else{
		return $ThaiText;
	}
}

function showerror($showmsg) { 
	echo" <table width=\"400\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  <tr>
    <td><div align=\"left\">
      <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\">
        <tbody>
          <tr>
            <td width=\"20\"></td>
            <td></td>
            <td width=\"19\"></td>
          </tr>
        </tbody>
      </table>
      <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\">
        <tbody>
          <tr>
            <td width=\"10\"></td>
            <td valign=\"top\" width=\"100%\"><div align=\"center\">
              <table cellspacing=\"0\" cellpadding=\"0\" width=\"98%\" border=\"0\">
                <tbody>
                  <tr>
                    <td><table width=\"100%\" cellspacing=\"5\">
                      <tr>
                        <td><div align=\"center\"><strong><br />
                          <br />
                          $showmsg</strong><br />
                        </div></td>
                      </tr>
                    </table></td>
                  </tr>
                </tbody>
              </table>
            </div></td>
            <td width=\"10\"></td>
          </tr>
        </tbody>
      </table>
      <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\">
        <tbody>
          <tr>
            <td width=\"20\"></td>
            <td></td>
            <td width=\"19\"></td>
          </tr>
        </tbody>
      </table>
    </div></td>
  </tr>
</table>";
}

function CheckUser_Nopwd($user = ""){
	global $db ;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['user'] = $db->select_query("SELECT member_id FROM ".TB_MEMBER." WHERE user='$user' ");
	$arr['user'] = $db->fetch($res['user']);
	if($arr['user']['member_id']){
		return True;
    } else {
		echo "<script language='javascript'>" ;
		echo "alert('กรุณาล็อกอินเข้าใช้งานก่อนครับ')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
	}
} 

function CheckUser_Admin($Username = "",$Adminname = "") {
	global $db ;
	//Check Level
//	echo $Username."," ;
//	echo $Adminname."," ;
//	echo $password ;	
    if(empty($Adminname) and isset($Username)) {
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['member'] = $db->select_query("SELECT user FROM ".TB_MEMBER." WHERE user='$Username' ");
	$row['member']=$db->rows($res['member']) ;
	if($row['member']) {
		return True;
    } else {
		echo "<script language='javascript'>" ;
		echo "alert('ท่านไม่ใช่สมาชิกที่มีสิทธิ์ใช้งานในส่วนนี้ ต้องขออภัย')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
	}
	}else  if(isset($Adminname) and empty($Username)) {
	$res['user'] = $db->select_query("SELECT id FROM ".TB_ADMIN." WHERE username='$Adminname' ");
	$rows['user'] = $db->rows($res['user']);
	if($rows['user']){
		return True;
    } else {	
		echo "<script language='javascript'>" ;
		echo "alert('ท่านไม่ใช่สมาชิกที่มีสิทธิ์ใช้งานในส่วนนี้ ต้องขออภัย')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
    }
    }
}
function CheckAdminAll($admin_user = "", $admin_level =""){
	global $db ;
	//Check Level
//	echo $Username."," ;
//	echo $Adminname."," ;
//	echo $password ;	
if(isset($admin_user) and isset($admin_level)) {
	$res['user'] = $db->select_query("SELECT id, level FROM ".TB_ADMIN." WHERE username='$admin_user' AND level='$admin_level' ");
	$rows['user'] = $db->rows($res['user']);
	$arr['user'] = $db->fetch($res['user']);
	if($rows['user']) {
	    return True;
    } else {	
		echo "<script language='javascript'>" ;
		echo "alert('ท่านไม่ใช่สมาชิกที่มีสิทธิ์ใช้งานในส่วนนี้  ต้องขออภัย')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
    }
    }
}
function CheckAdmin($admin_user = "", $admin_level =""){
	global $db ;
	//Check Level
//	echo $Username."," ;
//	echo $admin_user."," ;
//	echo $admin_level ;	
if(isset($admin_user) and isset($admin_level)) {
	$res['user'] = $db->select_query("SELECT id, level FROM ".TB_ADMIN." WHERE username='$admin_user' AND level='$admin_level' ");
	$rows['user'] = $db->rows($res['user']);
	$arr['user'] = $db->fetch($res['user']);
	if($rows['user'] and ($arr['user']['level']=='1' or $arr['user']['level']=='2')) {
	    return True;
    } else {	
		echo "<script language='javascript'>" ;
		echo "alert('ท่านไม่ใช่สมาชิกที่มีสิทธิ์ใช้งานในส่วนนี้  ต้องขออภัย')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
    }
    }
}
function Check_passadu($admin_user = "",$admin_level = "") {
	global $db ;
	//Check Level
//	echo $Username."," ;
//	echo $Adminname."," ;
//	echo $password ;	
if(isset($admin_user) and isset($admin_level)) {
	$res['user'] = $db->select_query("SELECT id, level FROM ".TB_ADMIN." WHERE username='$admin_user' AND level='$admin_level' ");
	$rows['user'] = $db->rows($res['user']);
	$arr['user'] = $db->fetch($res['user']);
	if($rows['user'] and $arr['user']['level']=='3'){
	    return True;
    } else {	
		echo "<script language='javascript'>" ;
		echo "alert('ท่านไม่ใช่สมาชิกที่มีสิทธิ์ใช้งานในส่วนนี้  ต้องขออภัย')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
    }
    }
}
function Check_boss($admin_user = "",$admin_level = "") {
	global $db ;
	//Check Level
//	echo $Username."," ;
//	echo $Adminname."," ;
//	echo $password ;	
if(isset($admin_user) and isset($admin_level)) {
	$res['user'] = $db->select_query("SELECT id, level FROM ".TB_ADMIN." WHERE username='$admin_user' AND level='$admin_level' ");
	$rows['user'] = $db->rows($res['user']);
	$arr['user'] = $db->fetch($res['user']);
	if($rows['user'] and $arr['user']['level']=='4'){
	    return True;
    } else {	
		echo "<script language='javascript'>" ;
		echo "alert('ท่านไม่ใช่สมาชิกที่มีสิทธิ์ใช้งานในส่วนนี้  ต้องขออภัย')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
    }
    }
}
function notview() {
   		echo "<script language='javascript'>" ;
		echo "alert('กำลังพัฒนา โปรดรอสักครู่')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
}
function section_name($id = "") {
	global $db ;
	$res['section'] = $db->select_query("SELECT section_name FROM ".TB_MEMBER_SECTION." WHERE section_id='$id'");
	$arr['section'] = $db->fetch($res['section']);
	echo " ".$arr['section']['section_name'] ;
}
//ทำการแบ่งหน้า
function SplitPage($page="",$totalpage="",$option="",$shs_id){
	global $ShowSumPages , $ShowPages ;
	// สร้าง link เพื่อไปหน้าก่อน-หน้าถัดไป
	$ShowSumPages .= "<B>กำลังแสดงที่หน้า</B>";
	if($page>1 && $page<=$totalpage) {
		$prevpage = $page-1;
		$ShowSumPages .= "&nbsp;&nbsp;&nbsp;<a href='".$option."&page=$prevpage&shs_id=$shs_id' title='Back'><B><<<--</B></a>\n";
	}
	$ShowSumPages .= " <b>$page</b>";
	if($page!=$totalpage) {
		$nextpage = $page+1;
		if($nextpage >= $totalpage){
			$nextpage = $totalpage ;
		}
		$ShowSumPages .= "&nbsp;&nbsp;&nbsp;<a href='".$option."&page=$nextpage&shs_id=$shs_id' title='Next'><B>-->>></B></a>\n";
	}

	// วนลูปแสดงเลขหน้าทั้งหมด แบบเป็นช่วงๆ ช่วงละ 10 หน้า
	$b=floor($page/10); 
	$c=(($b*10));

	if($c>1) {
		$prevpage = $c-1;
		$ShowPages .= "<a href='".$option."&page=$prevpage' title='10 หน้าก่อนนี้'><<</a> \n";
	}
	else{
		$ShowPages .= "<B><<</B>\n";
	}
	$ShowPages .= " <b>";
	for($i=$c; $i<$page ; $i++) {
		if($i>0)
		$ShowPages .= "<a href='".$option."&page=$i&shs_id=$shs_id'>$i</a> \n";
	}
	$ShowPages .= "<font color=red>$page</font> \n";
	for($i=($page+1); $i<($c+10) ; $i++) {
		if($i<=$totalpage)
		$ShowPages .= "<a href='".$option."&page=$i&shs_id=$shs_id'>$i</a> \n";
	}
	$ShowPages .= "</b> ";
	if($c>=0) {
		if(($c+2)<$totalpage){
	$nextpage = $c+10;
	$ShowPages .= "<a href='".$option."&page=$nextpage' title='10 หน้าถัดไป'>>></a> \n";
		}
		else
	$ShowPages .= "<B>>></B>\n";
	}
	else{
		$ShowPages .= "<B>>></B>\n";
	}
}
?>