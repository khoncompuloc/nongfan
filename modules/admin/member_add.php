<?php
CheckAdmin($admin_user,$admin_level);
empty($ProcessOutput)?$ProcessOutput="":$ProcessOutput=$ProcessOutput ;
?>
<link href="modules/admin/css/style.css" rel="stylesheet" type="text/css">
	<TABLE cellSpacing="0" cellPadding="0" width="950" border="0">
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="940" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/admin/texmenu_title.gif" BORDER="0"><BR>
				<TABLE width="940" align="center" cellSpacing="0" cellPadding="0" border="0">
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
<?php
if($op == "member_add"){
	
	if(CheckLevel($_SESSION['admin_user'],$op)){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	//ตรวจสอบมี user นี้หรือยัง
	$res['member'] = $db->select_query("SELECT member_id FROM ".TB_MEMBER." WHERE fname='".$_POST['fname']."' AND lname='".$_POST['lname']."' AND section_id='".$_POST['section_id']."' ");
	$rows['member'] = $db->rows($res['member']); 
	$db->closedb ();
		if($rows['member']){
			$ProcessOutput .= "<BR><BR>";
			$ProcessOutput .= "<CENTER><IMG SRC=\"images/notview.gif\" BORDER=\"0\"><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ชื่อบุคลากร : ".$_POST['NAME']." มีในระบบแล้วไม่สามารถเพิ่มได้</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"javascript:history.go(-1);\"><B>กลับไปแก้ไข</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
		}else {

		require("includes/class.resizepic.php");
		$FILESS = $_FILES['FILE'];
		$namepic=$FILESS['tmp_name'];
		$namepic_name=$FILESS['name'];
		$namepic_size=$FILESS['size'];
		$namepic_type=$FILESS['type'];

$size = getimagesize($FILESS['tmp_name']);
$sizezz=$size['0']*$size['1'];
$widths = $size['0'];
$heights = $size['1'];
if ($namepic_size > _MEMBER_LIMIT_UPLOAD ) {
				$ProcessOutput .= "<BR><BR>";
			    $ProcessOutput .= "<CENTER><A HREF=\"?naivoi=admin&voi=main\"><IMG SRC=\"images/icon/dangerous.png\" BORDER=\"0\"></A><BR><BR>";
				$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ขนาดรูปภาพต้องกว้างไม่เกิน"._MEMBER_LIMIT_UPLOAD." KB.<br> รูปภาพของท่านขนาด ".$namepic_size/1024 ." KB. ครับ</FONT><BR><BR>";
				$ProcessOutput .= "<A HREF=\"?naivoi=admin&voi=member_add\"><B>กลับหน้า จัดการเพิ่มบุคลากรใหม่</B></A>";
				$ProcessOutput .= "</CENTER>";
}  else {

if (($namepic_type=='image/jpg') || ($namepic_type=='image/jpeg') || ($namepic_type=='image/pjpeg')){

                copy($namepic, "images/personnel/".TIMESTAMP."_".$namepic_name.""); 
				$original_image = "images/personnel/".TIMESTAMP."_".$namepic_name."";
				$width = _IPERTHB_W ;
				$height = _IPERTHB_H ;
				$desired_width = $size['0'] ;
				$desired_height = $size['1'] ;
				if ($desired_width > $width ) {
					$im=$desired_width/$width;
					$imheight=$desired_height/$im;
				$image = new hft_image($original_image);
				$image->resize($width,$imheight,  '0');
				} else {
					$im=$size['1']/$height;
					$imwidth=$size['0']/$im;
				$image = new hft_image($original_image);
				$image->resize($imwidth,$height,  '0');
				}
				$image->output_resized("images/personnel/thb_".TIMESTAMP."_".$namepic_name."", "JPG");

				} else if (($namepic_type=='image/gif')){

                copy($namepic, "images/personnel/".TIMESTAMP."_".$namepic_name.""); 
				$original_image = "images/personnel/".TIMESTAMP."_".$namepic_name."";
				$width = _IPERTHB_W ;
				$height = _IPERTHB_H ;
				$desired_width = $size['0'] ;
				$desired_height = $size['1'] ;
				if ($desired_width > $width ) {
					$im=$desired_width/$width;
					$imheight=$desired_height/$im;
				$image = new hft_image($original_image);
				$image->resize($width,$imheight,  '0');
				} else {
					$im=$size['1']/$height;
					$imwidth=$size['0']/$im;
				$image = new hft_image($original_image);
				$image->resize($imwidth,$height,  '0');
				}
				$image->output_resized("images/personnel/thb_".TIMESTAMP."_".$namepic_name."", "GIF");
				} else if (($namepic_type=='image/x-png')){

                copy($namepic, "images/personnel/".TIMESTAMP."_".$namepic_name.""); 
				$original_image = "images/personnel/".TIMESTAMP."_".$namepic_name."";
				$width = _IPERTHB_W ;
				$height = _IPERTHB_H ;
				$desired_width = $size['0'] ;
				$desired_height = $size['1'] ;
				if ($desired_width > $width ) {
					$im=$desired_width/$width;
					$imheight=$desired_height/$im;
				$image = new hft_image($original_image);
				$image->resize($width,$imheight,  '0');
				} else {
					$im=$size['1']/$height;
					$imwidth=$size['0']/$im;
				$image = new hft_image($original_image);
				$image->resize($imwidth,$height,  '0');
				}
				$image->output_resized("images/personnel/thb_".TIMESTAMP."_".$namepic_name."", "PNG");
}

if ($FILESS['tmp_name'] !=''){
$pername="".TIMESTAMP."_".$namepic_name."";
}else {
$pername='';
}

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

			
            $db->add_db(TB_MEMBER,array(
				"prefix"=>"".$_POST['prefix']."",
				"fname"=>"".$_POST['fname']."",
				"lname"=>"".$_POST['lname']."",
				"nic_name"=>"".$_POST['nic_name']."",
				"sex"=>"".$_POST['sex']."",
				"position_id"=>"".$_POST['position_id']."",
				"section_id"=>"".$_POST['section_id']."",
				"parties_id"=>"".$_POST['parties_id']."",	
                "level"=>"".$_POST['level']."",				
				"user"=>"".$_POST['user']."",
				"password"=>"".$_POST['pwd_name1']."",						
				"member_pic"=>"".$pername.""				
			));

			$db->closedb ();
			$ProcessOutput = "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?naivoi=admin&voi=main\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการเพิ่มชื่อบุคลากร : ".$_POST['fname']." เข้าสู่ระบบเรียบร้อยแล้ว</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"?naivoi=admin&voi=member_add\"><B>กลับหน้า จัดการเพิ่มบุคลากรใหม่</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
		}
		}

	}else{
	    $PermissionFalse = "ไม่สามารถดเนินการได้...".$_SESSION['admin_user'] ;
		$ProcessOutput = $PermissionFalse ;
	}
} else if($op == "member_edit") {
?>
<form NAME="memberForm" METHOD="post" ACTION="?naivoi=admin&voi=member_add&op=member_add" onSubmit="return check()" ENCTYPE="multipart/form-data">
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
    <td width="140" height="30" align="right"><strong>ฝ่าย :</strong>&nbsp;</td>
    <td height="30"><font id="parties">
		<SELECT NAME="type_id" ID="type_id" onChange="dochange_edit('stock_subtype_edit',this.value);" >
	    <?php
		$res['member_parties'] = $db->select_query("SELECT * FROM ".TB_STOCK_TYPE." ORDER BY type_id");
		while($arr['member_parties'] = $db->fetch($res['member_parties'])) {
		?>
		<OPTION value=<?php echo $arr['member_parties']['type_id'];?><?php if($arr['member_parties']['type_id']=="".$arr['member_parties']['type_id'].""){ echo " selected" ; } ?>><?php echo $arr['stock_type']['type_name'];?></OPTION>
        <?php } ?>
        </SELECT>
	</font></td>
	<td height="30" align="right"><strong>คำนำหน้าชื่อ :</strong>&nbsp;</td>
    <td height="30">
	<select name="prefix" id="prefix" onChange="dochange_prefix()" >
    <option value="" selected="selected">อื่นๆ</option>
    <option value="นาย">นาย</option>
    <option value="นาง">นาง</option>
    <option value="นางสาว">นางสาว</option>
    </select>&nbsp;
    <font id="prefix_psd"><input type="text" name="prefix2" id="prefix2" size="18"/></font>
	</td>	
</tr>
<tr>
    <td width="140" height="30" align="right"><strong>ส่วน/กอง :</strong>&nbsp;</td>
    <td height="30"><font id="section"><select><option value="0">-------------------</</option></select></font>
	</td>
    <td height="30" align="right"><strong>ชื่อ :</strong>&nbsp;</td> 
    <td height="30"><input type="text" name="fname" id="fname" size="15" /><strong>&nbsp;สกุล :</strong>&nbsp;<input type="text" name="lname" id="lname" size="20" /></td>
</tr>
<tr>
    <td width="140" height="30" align="right"><strong>ตำแหน่ง :</strong>&nbsp;</td>
    <td height="30"><font id="position"><select><option value="0">-------------------</</option></select></font>
	</td>
    <td height="30" align="right"><strong>ชื่อเล่น :</strong>&nbsp;</td>
    <td height="30"><input type="text" name="nic_name" id="nic_name" size="13" />&nbsp;&nbsp;ซี&nbsp;(เทียบเท่า)<input type="text" name="level" id="level" size="5" /></td>		
</tr>
<tr>
    <td height="30" align="right"><strong>หน้าที่ตำแหน่ง :</strong>&nbsp;</td>
    <td height="30">
	</td>
    <td width="140" height="30" align="right"><strong>เพศ :</strong>&nbsp;</td>
    <td height="30">
	<INPUT name=sex type=radio value=1>
    <img src="images/icon/male.gif" >ชาย&nbsp;&nbsp;&nbsp;
    <INPUT name=sex type=radio value=2>
    <img src="images/icon/female.gif">หญิง&nbsp;&nbsp;&nbsp;
    <INPUT name=sex type=radio value=3>
    <img src="images/icon/notsoure.gif">ไม่แน่ใจ<img src="images/icon/priority.gif" width="11" height="12">
	</td>	
</tr>
<tr>

   <td colspan="4" align="right">
   
    <table border="0" cellspacing="1" cellpadding="0"width="500" bgcolor="#CCCCCC" align="center">
              <TR>
                <TD WIDTH="100%" height="30" ALIGN="left" BGCOLOR="#0099FF" colspan="2" >&nbsp;&nbsp;<IMG SRC="images/admin/user.gif" ><FONT SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif" color="#FFFFFF"><b>&nbsp;&nbsp;ข้อมูลในการเข้าสู่ระบบ</FONT></TD>
              </TR>
              <TR>
                <TD WIDTH="40%" height="30" ALIGN="right" BGCOLOR="#FFFFFF"><FONT SIZE="1"><STRONG><FONT FACE="MS Sans Serif, Tahoma, sans-serif">Login Name : </FONT></STRONG></FONT></TD>
                <TD BGCOLOR="#FFFFFF"><FONT SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif">
                  <INPUT NAME="user" TYPE="text" ID="user" SIZE="20" MAXLENGTH="30" OnChange="JavaScript:doCallAjax();"><span id="mySpan"></span>
                  <FONT COLOR="#FF0000" SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif">**<STRONG>&nbsp;(อังกฤษเท่านั้น)</STRONG></FONT> </FONT></TD>
              </TR>
              <TR>
                <TD WIDTH="40%" height="30" ALIGN="right" BGCOLOR="#FFFFFF"><FONT SIZE="1" FACE="MS Sans Serif, Tahoma, sans-serif"><STRONG>Password : </STRONG></FONT></TD>
                <TD BGCOLOR="#FFFFFF"><FONT SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif">
                  <INPUT NAME="pwd_name1" TYPE="password" ID="pwd_name1" SIZE="20" MAXLENGTH="30">
&nbsp;<FONT COLOR="#FF0000" SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif">**</FONT> </FONT></TD>
              </TR>
              <TR>
                <TD WIDTH="40%" height="30" ALIGN="right" BGCOLOR="#FFFFFF"><FONT SIZE="1" FACE="MS Sans Serif, Tahoma, sans-serif"><STRONG>Re-Password :</STRONG></FONT></TD>
                <TD BGCOLOR="#FFFFFF"><FONT SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif">
                  <INPUT NAME="pwd_name2" TYPE="password" ID="pwd_name2" SIZE="20" MAXLENGTH="30">
&nbsp;<FONT COLOR="#FF0000" SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif">**</FONT> </FONT></TD>
              </TR>

			  <TR>
                <TD WIDTH="40%" ALIGN="right" height="30" BGCOLOR="#FFFFFF"><FONT SIZE="2"><STRONG>&nbsp;&nbsp;รูปภาพ: </FONT></STRONG></FONT></TD>
                <TD BGCOLOR="#FFFFFF"><INPUT TYPE="file" NAME="FILE" onpropertychange="view01.src=FILE.value;" STYLE="width:250" CLASS="inputform">
				</TD>
              </TR>
	
    </table><BR> <FONT COLOR="#FF0000">ขนาดภาพไม่เกิน  <?php echo (_MEMBER_LIMIT_UPLOAD/1024);?> kb </FONT>
   </td>
</tr>   
</table>
<BR>
<center><input type="submit" value="บันทึกการแก้ไขข้อมูลบุคลากร" name="submit">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value=" เคลีย " name="reset">
</form>
<?php

}

?>
<!--
<script type="text/javascript" src="datepicker.js"></script>
<script type="text/javascript" src="js/jquery1.3.2.js"></script>
-->   

<?php
if($op == "" and !$ProcessOutput){
?>
<TABLE width="100%" align="center" cellSpacing="0" cellPadding="0" border="0">
<TR>
<TD>
<script language="javascript" type="text/javascript">
function Inint_AJAX() {
   try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
   try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
   try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
   alert("XMLHttpRequest not supported");
   return null;
};

function dochange_elect() {
     //alert("s0");
     var req = Inint_AJAX();
	 var elect_id = document.memberForm.elect.value ;
     req.onreadystatechange = function () { 
          if (req.readyState==4) {
		           
               if (req.status==200) {
			        
                    document.getElementById("position_elect").innerHTML=req.responseText; //รับค่ากลับมา
               } 
          }
     };
	 var random=Math.random()
     req.open("GET", "modules/admin/ajax_elect.php?val="+elect_id+"&random="+random , true); //สร้าง connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
     req.send(null); //ส่งค่า
}

function dochange2(src, val) {
     //alert("s0");
     var req = Inint_AJAX();
     req.onreadystatechange = function () { 
          if (req.readyState==4) {
		           
               if (req.status==200) {
			        if (val==4 || val==-1 || src=="position") {
                     document.getElementById(src).innerHTML=req.responseText; //รับค่ากลับมา
					} else {
				var text_str = "<input type=\"hidden\" name=\"section_id\" id=\"section_id\" value=\"0\" />" ;	
					 document.getElementById("section").innerHTML="<select name='sec_dis' disabled='disabled'><option value='0'>--ไปเลือกตำแหน่งเลยครับ--</option></select>"+text_str ;
					 
			//	var text_str = "<SELECT NAME=\"elect\" disabled=\"disabled\">" ;
            //        text_str = text_str+"<OPTION selected VALUE=\"\">-------------------</OPTION>" ;
 	        //        text_str = text_str+"</SELECT>&nbsp;" ;
			//		text_str = text_str+"<select disabled=\"disabled\"><option value=\"\">-------------------</</option></select>" ;
            //        text_str = text_str+"<input type=\"hidden\" name=\"elect\" value=\"0\" />" ;					   
            //        text_str = text_str+"<input type=\"hidden\" name=\"position_id_elect\" value=\"0\" />" ;
			//		 document.getElementById("disp_position").innerHTML=text_str ;
				     document.getElementById("position").innerHTML=req.responseText; //รับค่ากลับมา
				}
               } 
          }
     };
	 var random=Math.random()
     req.open("GET", "modules/admin/position_admin.php?data="+src+"&val="+val+"&random="+random , true); //สร้าง connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
     req.send(null); //ส่งค่า
}

window.onLoad=dochange2('parties', -1);   
 
function  section_Open(){ window.open('modules/admin/section_add.php','','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=500,height=350,left=400,top=180'); }   
function  position_Open(form){ window.open('modules/admin/position_add.php?parties_id='+form.parties_id.value+'&section_id='+form.section_id.value+'','','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=400,left=400,top=180'); }   

	   var HttPRequest = false;

function doCallAjax() {
		  HttPRequest = false;
          var HttPRequest = Inint_AJAX();	  

		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
	
		  var url = 'modules/admin/checkuser.php';
		  var pmeters = "tUsername=" + encodeURI( document.getElementById("user").value);
			

			HttPRequest.open('POST',url,true);
			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
			HttPRequest.onreadystatechange = function()
			{

				if(HttPRequest.readyState == 3)  // Loading Request
				{
					document.getElementById("mySpan").innerHTML = "..";
				}

				if(HttPRequest.readyState == 4) // Return Request
				{
					if(HttPRequest.responseText == 'Y')
					{
						window.location = 'AjaxPHPRegister3.php';
					}
					else
					{
						document.getElementById("mySpan").innerHTML = HttPRequest.responseText;
					}
				}
				
			}

}

function dochange_prefix() {
	    if (document.memberForm.prefix.value == "") {
        document.getElementById("prefix_psd").innerHTML="<input type=\"text\" name=\"prefix2\" id=\"prefix2\" size=\"18\" value=\"\" >" ;		
		} else {
        document.getElementById("prefix_psd").innerHTML="<input type=\"text\" size=\"18\" disabled=\"disabled\" >" ;
		}
}	   

function dochange_position() {
     //alert("s0");
     var req = Inint_AJAX();
	 var position_id = document.memberForm.position_id.value ;
     req.onreadystatechange = function () { 
          if (req.readyState==4) {
		           
               if (req.status==200) {
			        
                    document.getElementById("disp_position").innerHTML=req.responseText; //รับค่ากลับมา
               } 
          }
     };
	 var random=Math.random()
     req.open("GET", "modules/admin/ajax_position.php?val="+position_id+"&random="+random , true); //สร้าง connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
     req.send(null); //ส่งค่า
}
</script>
<form NAME="memberForm" METHOD="post" ACTION="?naivoi=admin&voi=member_add&op=member_add" onSubmit="return check()" ENCTYPE="multipart/form-data">
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
    <td width="140" height="30" align="right"><strong>ฝ่าย :</strong>&nbsp;</td>
    <td height="30"><font id="parties"><select><option value="0">-------------------</</option></select></font></td>
	<td height="30" align="right"><strong>คำนำหน้าชื่อ :</strong>&nbsp;</td>
    <td height="30">
	<select name="prefix" id="prefix" onChange="dochange_prefix()" >
    <option value="" selected="selected">อื่นๆ</option>
    <option value="นาย">นาย</option>
    <option value="นาง">นาง</option>
    <option value="นางสาว">นางสาว</option>
    </select>&nbsp;
    <font id="prefix_psd"><input type="text" name="prefix2" id="prefix2" size="18"/></font>
	</td>	
</tr>
<tr>
    <td width="140" height="30" align="right"><strong>ส่วน/กอง :</strong>&nbsp;</td>
    <td height="30"><font id="section"><select><option value="0">-------------------</</option></select></font>
	</td>
    <td height="30" align="right"><strong>ชื่อ :</strong>&nbsp;</td> 
    <td height="30"><input type="text" name="fname" id="fname" size="15" /><strong>&nbsp;สกุล :</strong>&nbsp;<input type="text" name="lname" id="lname" size="20" /></td>
</tr>
<tr>
    <td width="140" height="30" align="right"><strong>ตำแหน่ง :</strong>&nbsp;</td>
    <td height="30"><font id="position"><select><option value="0">-------------------</</option></select></font>
	</td>
    <td height="30" align="right"><strong>ชื่อเล่น :</strong>&nbsp;</td>
    <td height="30"><input type="text" name="nic_name" id="nic_name" size="13" /></td>		
</tr>
<tr>
    <td height="30" align="right"><strong>ระดับ :<strong>&nbsp;</td>
    <td height="30"><select>
	                   <option value="0">-------------------</</option>
	</select>&nbsp;*เฉพาะพนักงานราชการ</td>
    <td width="140" height="30" align="right"><strong>เพศ :</strong>&nbsp;</td>
    <td height="30">
	<INPUT name=sex type=radio value=1>
    <img src="images/admin/male.gif" >ชาย&nbsp;&nbsp;&nbsp;
    <INPUT name=sex type=radio value=2>
    <img src="images/admin/female.gif">หญิง&nbsp;&nbsp;&nbsp;
    <INPUT name=sex type=radio value=3>
    <img src="images/admin/notsoure.gif">ไม่แน่ใจ<img src="images/admin/priority.gif" width="11" height="12">
	</td>	
</tr>
<tr>
   <td colspan="4" align="right">
    <table border="0" cellspacing="1" cellpadding="0"width="500" bgcolor="#CCCCCC" align="center">
              <TR>
                <TD WIDTH="100%" height="30" ALIGN="left" BGCOLOR="#0099FF" colspan="2" >&nbsp;&nbsp;<IMG SRC="images/admin/user.gif" ><FONT SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif" color="#FFFFFF"><b>&nbsp;&nbsp;ข้อมูลในการเข้าสู่ระบบ</FONT></TD>
              </TR>
              <TR>
                <TD WIDTH="40%" height="30" ALIGN="right" BGCOLOR="#FFFFFF"><FONT SIZE="1"><STRONG><FONT FACE="MS Sans Serif, Tahoma, sans-serif">Login Name : </FONT></STRONG></FONT></TD>
                <TD BGCOLOR="#FFFFFF"><FONT SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif">
                  <INPUT NAME="user" TYPE="text" ID="user" SIZE="20" MAXLENGTH="30" OnChange="JavaScript:doCallAjax();"><span id="mySpan"></span>
                  <FONT COLOR="#FF0000" SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif">**<STRONG>&nbsp;(อังกฤษเท่านั้น)</STRONG></FONT> </FONT></TD>
              </TR>
              <TR>
                <TD WIDTH="40%" height="30" ALIGN="right" BGCOLOR="#FFFFFF"><FONT SIZE="1" FACE="MS Sans Serif, Tahoma, sans-serif"><STRONG>Password : </STRONG></FONT></TD>
                <TD BGCOLOR="#FFFFFF"><FONT SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif">
                  <INPUT NAME="pwd_name1" TYPE="password" ID="pwd_name1" SIZE="20" MAXLENGTH="30">
&nbsp;<FONT COLOR="#FF0000" SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif">**</FONT> </FONT></TD>
              </TR>
              <TR>
                <TD WIDTH="40%" height="30" ALIGN="right" BGCOLOR="#FFFFFF"><FONT SIZE="1" FACE="MS Sans Serif, Tahoma, sans-serif"><STRONG>Re-Password :</STRONG></FONT></TD>
                <TD BGCOLOR="#FFFFFF"><FONT SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif">
                  <INPUT NAME="pwd_name2" TYPE="password" ID="pwd_name2" SIZE="20" MAXLENGTH="30">
&nbsp;<FONT COLOR="#FF0000" SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif">**</FONT> </FONT></TD>
              </TR>

			  <TR>
                <TD WIDTH="40%" ALIGN="right" height="30" BGCOLOR="#FFFFFF"><FONT SIZE="2"><STRONG>&nbsp;&nbsp;รูปภาพ: </FONT></STRONG></FONT></TD>
                <TD BGCOLOR="#FFFFFF"><INPUT TYPE="file" NAME="FILE" onpropertychange="view01.src=FILE.value;" STYLE="width:250" CLASS="inputform">
				</TD>
              </TR>
	
    </table><BR> <FONT COLOR="#FF0000">ขนาดภาพไม่เกิน  <?php echo (_MEMBER_LIMIT_UPLOAD/1024);?> kb </FONT>
   </td>
</tr>   
</table>
<BR>
<center><input type="submit" value="บันทึกข้อมูลบุคลากร" name="submit">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value=" เคลีย " name="reset">
</form>
<?php
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

?>

<table width="100%" cellspacing="2" cellpadding="1" >
 <tr>
 <td colspan="3" align="left"><b>ฝ่ายบริหาร</b></td>
 </tr>
  <tr bgcolor="#0066FF" height="25">
   <td><font color="#FFFFFF"><B><CENTER>Option</CENTER></B></font></td>
   <td><font color="#FFFFFF"><B>ชื่อ - นามสกุล</B></font></td>
   <td><font color="#FFFFFF"><B>ตำแหน่ง</B></font></td>
  </tr>  
<?php
$res['user'] = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE parties_id=1 ORDER BY member_id ");
$count=0;
while($arr['user'] = $db->fetch($res['user'])){
	$res['position'] = $db->select_query("SELECT * FROM ".TB_MEMBER_POSITION." WHERE position_id='".$arr['user']['position_id']."' ");
	$arr['position'] = $db->fetch($res['position']);

    if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = "#FDEAFB";
} else {
$ColorFill = "#F0F0F0";
}

?>
    <tr bgcolor="<?php echo $ColorFill; ?>" onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='<?php echo $ColorFill;?>' ">
     <td width="44">
      <a href="?naivoi=admin&voi=member_add&op=member_edit&id=<?php echo $arr['user']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="แก้ไข" ></a> 
      <a href="?naivoi=admin&voi=member_add&op=admin_del&id=<?php echo $arr['user']['id'];?>" onClick="return chkdel();" ></a><img src="images/admin/trash.gif"  border="0" alt="ลบ" >
	 </td> 
     <td><?php echo $arr['user']['prefix'];?><?php echo $arr['user']['fname'];?>&nbsp;&nbsp;<?php echo $arr['user']['lname'];?></td>
     <td ><?php echo $arr['position']['position_name'];?></td>
    </tr>
	<TR>
		<TD colspan="3" height="1" class="dotline"></TD>
	</TR>
<?php
	$count++;
 } 
?>
</table>
<br>
 <table width="100%" cellspacing="2" cellpadding="1" >
 <tr>
 <td colspan="3" align="left"><b>ฝ่ายหัวหน้าสำนักงาน</b></td>
 </tr>
  <tr bgcolor="#0066FF" height=25>
   <td><font color="#FFFFFF"><B><CENTER>Option</CENTER></B></font></td>
   <td><font color="#FFFFFF"><B>ชื่อ - นามสกุล</B></font></td>
   <td><font color="#FFFFFF"><B>ตำแหน่ง</B></font></td>
  </tr>  
<?php
$res['user'] = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE parties_id=3 ORDER BY member_id ");
$count=0;
while($arr['user'] = $db->fetch($res['user'])){
	$res['position'] = $db->select_query("SELECT * FROM ".TB_MEMBER_POSITION." WHERE position_id='".$arr['user']['position_id']."' ");
	$arr['position'] = $db->fetch($res['position']);

    if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = "#FDEAFB";
} else {
$ColorFill = "#F0F0F0";
}

?>
    <tr bgcolor="<?php echo $ColorFill; ?>" onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='<?php echo $ColorFill;?>' ">
     <td width="44">
      <a href="?naivoi=admin&voi=member_add&op=member_edit&id=<?php echo $arr['user']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="แก้ไข" ></a> 
      <a href="?naivoi=admin&voi=member_add&op=admin_del&id=<?php echo $arr['user']['id'];?>" onClick="return chkdel();" ><img src="images/admin/trash.gif"  border="0" alt="ลบ" ></a>
	 </td> 
     <td><?php echo $arr['user']['prefix'];?><?php echo $arr['user']['fname'];?>&nbsp;&nbsp;<?php echo $arr['user']['lname'];?></td>
     <td ><?php echo $arr['position']['position_name'];?></td>
    </tr>
	<TR>
		<TD colspan="3" height="1" class="dotline"></TD>
	</TR>
<?php
	$count++;
 } 
?>
</table>
<br>
 <table width="100%" cellspacing="2" cellpadding="1" >
 <tr>
 <td colspan="3" align="left"><b>ฝ่ายพนักงานราชการและลูกจ้าง</b></td>
 </tr>
  <tr bgcolor="#0066FF" height=25>
   <td><font color="#FFFFFF"><B><CENTER>Option</CENTER></B></font></td>
   <td><font color="#FFFFFF"><B>ชื่อ - นามสกุล</B></font></td>
   <td><font color="#FFFFFF"><B>ตำแหน่ง</B></font></td>
  </tr>  
<?php
$res['section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." WHERE parties_id=4 ORDER BY section_id ");
$count=0;
while($arr['section'] = $db->fetch($res['section'])){
?>
 <tr>
 <td colspan="3" align="left" bgcolor="#cccccc"><b><?php echo $arr['section']['section_name'];?></b></td>
 </tr>
<?php
$res['user'] = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE section_id='".$arr['section']['section_id']."' ORDER BY degree_id DESC");
while($arr['user'] = $db->fetch($res['user'])){
$res['position'] = $db->select_query("SELECT * FROM ".TB_MEMBER_POSITION." WHERE position_id='".$arr['user']['position_id']."' ORDER BY position_id ");
$arr['position'] = $db->fetch($res['position']);
$res['degree'] = $db->select_query("SELECT degree_name FROM ".TB_MEMBER_DEGREE." WHERE degree_id='".$arr['user']['degree_id']."'");
$arr['degree'] = $db->fetch($res['degree']);
    if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = "#FDEAFB";
} else {
$ColorFill = "#F0F0F0";
}

?>
    <tr bgcolor="<?php echo $ColorFill; ?>" onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='<?php echo $ColorFill;?>' ">
     <td width="44">
      <a href="?naivoi=admin&voi=member_add&op=member_edit&id=<?php echo $arr['user']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="แก้ไข" ></a> 
      <a href="?naivoi=admin&voi=member_add&op=admin_del&id=<?php echo $arr['user']['id'];?>" onClick="return chkdel();" ><img src="images/admin/trash.gif"  border="0" alt="ลบ" ></a>
	 </td> 
     <td><?php echo $arr['user']['prefix'];?><?php echo $arr['user']['fname'];?>&nbsp;&nbsp;<?php echo $arr['user']['lname'];?></td>
     <td ><?php echo $arr['position']['position_name'].$arr['degree']['degree_name'] ;?></td>
    </tr>
	<TR>
		<TD colspan="6" height="1" class="dotline"></TD>
	</TR>
<?php
	$count++;
 }
} 
?>
</table>
						<BR><BR>
					</TD>
				</TR>
			</TABLE>
<SCRIPT LANGUAGE="javascript">	
function check() {
if(document.memberForm.parties_id.value==0) {
alert("กรุณาเลือกฝ่ายด้วยครับ") ;
document.memberForm.parties_id.focus() ;
return false ;
}
else if(document.memberForm.section_id.value==0 && document.memberForm.parties_id.value==4 )   {
alert("กรุณาเลือกกอง/ส่วนงาน ด้วยครับ") ;
document.memberForm.section_id.focus() ;
return false ;
}
else if(document.memberForm.position_id.value==0) {
alert("กรุณาเลือกตำแหน่งด้วยครับ") ;
document.memberForm.position_id.focus() ;
return false ;
}
else if(document.memberForm.prefix.selectedIndex=="" && document.memberForm.prefix2.value=="") {
alert("กรุณาใส่คำนำหน้าชื่อหรือยศด้วยครับ") ;
document.memberForm.prefix.focus() ;
return false ;
}
else if(document.memberForm.fname.value=="") {
alert("กรุณาระบุชื่อของท่านอยู่ด้วยครับ") ;
document.memberForm.fname.focus() ;
return false ;
}
else if(document.memberForm.lname.value=="") {
alert("กรุณาระบุนามสกุลท่านอยู่ด้วยครับ") ;
document.memberForm.lname.focus() ;
return false ;
}
else if(document.memberForm.nic_name.value=="") {
alert("กรุณาระบุชื่อเล่นท่านอยู่ด้วยครับ") ;
document.memberForm.nic_name.focus() ;
return false ;
}
else if(document.memberForm.level.value=="") {
alert("กรุณาระบุ ซี ด้วยครับ") ;
document.memberForm.level.focus() ;
return false ;
}
else if(document.memberForm.sex.value=="") {
alert("กรุณาระบุเพศท่านอยู่ด้วยครับ") ;
document.memberForm.sex.focus() ;
return false ;
}
else if(document.memberForm.user.value=="") {
alert("กรุณากรอก USER ด้วยครับ") ;
document.memberForm.user.focus() ;
return false ;
}
else if(document.memberForm.pwd_name1.value=="") {
alert("กรุณากรอกรหัสผ่านที่ต้องการด้วยครับ") ;
document.memberForm.pwd_name1.focus() ;
return false ;
}
else if(document.memberForm.pwd_name2.value=="") {
alert("กรุณายืนยันรหัสผ่านอีกครั้ง") ;
document.memberForm.pwd_name2.focus() ;
return false ;
}
else if(document.memberForm.pwd_name1.value != document.memberForm.pwd_name2.value) {
alert("รหัสผ่านทั้งสองไม่ตรงกัน กรุณายืนยันรหัสผ่านให้ถูกต้องด้วยครับ") ;
document.memberForm.pwd_name2.focus() ;
return false ;
}
else 
return true ;
}			
</SCRIPT>
<?php
}else{
	echo $ProcessOutput ;
}
// $db->closedb ();
?>

		</TD>
	  </TR>
	</TABLE>
		</TD>
	  </TR>
	</TABLE>	