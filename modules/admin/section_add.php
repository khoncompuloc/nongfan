<html>
<head><title></title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">

<?php 
empty($op)?$op="":$op=$_GET['op'] ;	
empty($ProcessOutput)?$ProcessOutput="":$ProcessOutput=$ProcessOutput ;
if($op == "section_add"){       
			require_once("../../includes/config.in.php");
			require_once("../../includes/class.mysql.php");
			$db = New DB();
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			
			for($i=1;$i<=(int)($_POST["hdnLine"]);$i++) {
			
			$res["section"] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." WHERE parties_id='4'");			
			$arr["section"] = $db->fetch($res["section"]);
			
			if($arr["section"]["section_name"] <> $_POST["section_name_".$i]) {
			$db->add_db(TB_MEMBER_SECTION,array(
					"section_name"=>"".$_POST["section_name_".$i]."",
					"parties_id"=>"4"
			));
			}
			}
			$ProcessOutput .= "<BR><BR>";
			$ProcessOutput .= "<CENTER><IMG SRC=\"../../images/login-welcome.gif\" BORDER=\"0\"><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการบันทึกข้อมูล  ส่วนงาน  เรียบร้อยแล้ว</B></FONT>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";


            echo "<script language=\"JavaScript\">";
            echo "window.opener.location.reload();";
            echo "setTimeout(\"self.close()\",3000);";
            echo "window.onLoad=reload_view();";
            echo "</script>";
	}	
?>	
</head>
<body topmargin=0 leftmargin=0 marginheight=0 marginwidth=0>
<?php 
if(!$ProcessOutput){
?>
<script language="javascript" type="text/javascript">
	function fncCreateElement(){
		
	   var mySpan = document.getElementById('mySpan');

	   var myLine = document.getElementById('hdnLine');
	   myLine.value++;

	   // Create input file
	   var myElement2 = document.createElement('input');
	   myElement2.setAttribute('type',"text");
	   myElement2.setAttribute('name',"section_name_"+myLine.value);
	   myElement2.setAttribute('id',"section_name_"+myLine.value);
	   myElement2.setAttribute('size',"35");
	   mySpan.appendChild(myElement2);	
		
       // Create <br>
	   var myElement3 = document.createElement('br');
	   myElement3.setAttribute('id',"br"+myLine.value);
	   mySpan.appendChild(myElement3);
	}

	function fncDeleteElement(){

		var mySpan = document.getElementById('mySpan');

		var myLine = document.getElementById('hdnLine');
		
		if(myLine.value > 1 )
		{

			// Remove input file
			var deleteFile = document.getElementById("section_name_"+myLine.value);
			mySpan.removeChild(deleteFile);

			// Remove <br>
			var deleteBr = document.getElementById("br"+myLine.value);
			mySpan.removeChild(deleteBr);

			myLine.value--;
		}
	}
</script>

<form name="sectionForm" action="section_add.php?op=section_add" method="post" onSubmit="return check()">
<table border=0 cellspacing=1 width=100% >
<tr>
   <td colspan=2>&nbsp;&nbsp;<img src="../../images/post.gif" align=center>&nbsp;&nbsp;<font size=4>กำหนดชื่อ ส่วนงาน / กอง
 </font></td>
</tr>
  <tr><br><td height="30" width="60" valign="top">ชื่อ :</td>
  <td><input type="text" name="section_name_1" size="35">
	  <input name="btnCreate" type="button" value=" + " onClick="JavaScript:fncCreateElement();">
	  <input name="btnDelete" type="button" value=" - " onClick="JavaScript:fncDeleteElement();"><br>	
	  <span id="mySpan"></span><br>
	  <input name="hdnLine" id="hdnLine" type="hidden" value="1">
      <input name="btnSubmit" type="submit" value=" เพิ่ม  ส่วนงาน/กอง  " >
  </td>
  </tr>
</table>
</form>
<?php 

}else{
	echo $ProcessOutput ;
    $db->closedb ();
}	
?>
<SCRIPT LANGUAGE="javascript">			
function check() {
if(document.sectionForm.section_name.value=="") {
alert("กรุณากรอก ชื่อส่วนงานหรือกอง ด้วยครับ") ;
document.sectionForm.section_name.focus() ;
return false ;
} 
else 
return true ;
}			
</SCRIPT>
</body>
</html>