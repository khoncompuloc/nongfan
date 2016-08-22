<html>
<head><title></title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
</head>
<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
<?php 
			require_once("../../includes/config.in.php");
			require_once("../../includes/class.mysql.php");
			$db = New DB();
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			
empty($op)?$op="":$op=$_GET['op'] ;	
empty($ProcessOutput)?$ProcessOutput="":$ProcessOutput=$ProcessOutput ;
		
if($op == "position_add") {       
            
			//echo "parties_id=".$_POST["parties_id"] ;
			//echo "section_id=".$_POST["section_id"] ;
			
			for($i=1;$i<=(int($_POST["hdnLine"]));$i++) {
			
			$res["position"] = $db->select_query("SELECT * FROM ".TB_MEMBER_POSITION." WHERE parties_id='".$_POST["parties_id"]."' AND section_id='".$_POST["section_id"]."'");			
			$arr["position"] = $db->fetch($res["position"]);
			
			if($arr["position"]["position_name"] <> $_POST["position_name_".$i]) {
			$db->add_db(TB_MEMBER_POSITION,array(
					"position_name"=>"".$_POST["position_name_".$i]."",
					"section_id"=>"".$_POST["section_id"]."",
					"parties_id"=>"".$_POST["parties_id"].""
			));
			}
			}
			$ProcessOutput .= "<BR><BR>";
			$ProcessOutput .= "<CENTER><IMG SRC=\"../../images/login-welcome.gif\" BORDER=\"0\"><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการบันทึกข้อมูล  ตำแหน่งงาน  เรียบร้อยแล้ว</B></FONT>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";


            echo "<script language=\"JavaScript\">";
            echo "window.opener.location.reload();";
            echo "setTimeout(\"self.close()\",3000);";
            echo "window.onLoad=reload_view();";
            echo "</script>";
	} 
			
?>	
<script language="javascript" type="text/javascript">
	function fncCreateElement(){
		
	   var mySpan = document.getElementById('mySpan');
       //alert(mySpan);
	   var myLine = document.getElementById('hdnLine');
	   myLine.value++;
       //alert(myLine);
	   // Create input file
	   var myElement2 = document.createElement('input');
	   myElement2.setAttribute('type',"text");
	   myElement2.setAttribute('name',"position_name_"+myLine.value);
	   myElement2.setAttribute('id',"position_name_"+myLine.value);
	   myElement2.setAttribute('size',"35");
	   mySpan.appendChild(myElement2);	
       // Create <br>
	   var myElement3 = document.createElement('br');
	   myElement3.setAttribute('name',"br"+myLine.value);
	   myElement3.setAttribute('id',"br"+myLine.value);
	   mySpan.appendChild(myElement3);
	}

	function fncDeleteElement(){

		var mySpan = document.getElementById('mySpan');

		var myLine = document.getElementById('hdnLine');
		
		if(myLine.value > 1 )
		{
			// Remove input file
			var deleteFile = document.getElementById("position_name_"+myLine.value);
			mySpan.removeChild(deleteFile);
			// Remove <br>
			var deleteBr = document.getElementById("br"+myLine.value);
			mySpan.removeChild(deleteBr);
			myLine.value--;
		}
	}
</script>
<?php 
if(!$ProcessOutput){
            $parties_id=$_GET["parties_id"];
	        $section_id=$_GET["section_id"];
			$res['parties'] = $db->select_query("SELECT * FROM ".TB_MEMBER_PARTIES." WHERE parties_id='".$parties_id."'" );
			$res['section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." WHERE section_id='".$section_id."'" );			
			$arr['parties'] = $db->fetch($res['parties']);
			$arr['section'] = $db->fetch($res['section']);
            //echo "1.= ".$parties_id." 2.= ".$section_id ;
?>
<table border="0" cellspacing="1" width="100%" >
<tbody>
<tr>
<form name="positionForm" action="position_add.php?op=position_add" method="post" ENCTYPE="multipart/form-data" >
<td>
<table border="0" cellspacing="1" width="100%" >
  <tr>
  <td colspan="2">&nbsp;&nbsp;<img src="../../images/post.gif" align=center>&nbsp;&nbsp;<font size=4>เพิ่มตำแหน่ง</font>
  <input type="hidden" name="hdnMaxLine" value="1">
  </td>
  </tr>
  
  <tr>
  <td height="30" width="150" align="center" >&nbsp;&nbsp;ฝ่าย :&nbsp;&nbsp;</td>
  <td><input type="text" size="35" value="<?php echo $arr['parties']['parties_name'];?>" disabled="disabled">
  <input name="parties_id" type="hidden" value="<?php echo $_GET["parties_id"];?>" /></td>
  </tr>
  <tr>
  <td height="30" width="150" align="center" >&nbsp;&nbsp;ส่วน/กอง :&nbsp;&nbsp;</td>
  <td><input type="text" size="35" value="<?php echo $arr['section']['section_name'];?>" disabled="disabled">
  <input name="section_id" type="hidden" value="<?php echo $_GET["section_id"];?>" /></td>
  </tr>
 </table> 
 <table border="0" cellspacing="1" width="100%" > 
  <tr>
  <td height="30" width="150" valign="top">&nbsp;คีย์ชื่อตำแหน่ง :&nbsp;&nbsp;</td>
  <td><input type="text" name="position_name_1" name="position_name_1" size="35">
	  <input name="btnCreate" type="button" value=" + " onClick="JavaScript:fncCreateElement();">
	  <input name="btnDelete" type="button" value=" - " onClick="JavaScript:fncDeleteElement();"><br>	
	  <span name="mySpan" id="mySpan"></span>
	  <input name="hdnLine" id="hdnLine" type="hidden" value="1">
      <br><input name="btnSubmit" type="submit" value=" เพิ่ม  ตำแหน่ง  " >
  </td>
  </tr>
</table>
</td>
</form>
</tr>
</tbody>
</table>
<?php 

}else{
	echo $ProcessOutput ;
    $db->closedb ();
}	
?>
<SCRIPT LANGUAGE="javascript">			
/**
function check() {
if(document.positionForm.position_name_1.value=="") {
alert("กรุณากรอก ชื่อตำแหน่ง ด้วยครับ") ;
document.positionForm.position_name.focus() ;
return false ;
} 
else 
return true ;
}	
**/		
</SCRIPT>
</body>
</html>