
<?
			$data = iconv("TIS-620", "UTF-8", $_GET['data']);
			$val = iconv("TIS-620", "UTF-8", $_GET['val']);

			require_once("../../setconf.php");
	  		$db = New DB();
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

     if ($data=='section') { 
		  $res['section'] = $db->select_query("SELECT * FROM ".TB_MEMBER_SECTION." ORDER BY section_id ");	 
          echo "<select name='section_id' onChange=\"dochange_user('name_mem',this.value);\">\n";
          echo "<option value=''>----เลือกส่วน/กอง----</option>\n";
		  if($val == 3){echo "<option value=0 > พัสดุส่วนกลาง </option>";}
          while($arr['section'] = $db->fetch($res['section'])){
               echo "<option value=".$arr['section']['section_id']." >".$arr['section']['section_name']."</option> \n" ;
          }
		  echo "</select>\n";
     } else if ($data=='name_mem') {
	      if($val == 0){
		  $res['member'] = $db->select_query("SELECT member_id ,prefix ,fname ,lname FROM ".TB_MEMBER." WHERE parties_id='3' OR parties_id='4' ORDER BY level ");		  
		  } else {
		  $res['member'] = $db->select_query("SELECT member_id ,prefix ,fname ,lname FROM ".TB_MEMBER." WHERE parties_id=3 OR parties_id=4 AND section_id=".$val." ORDER BY level ");	
          }		  
          echo "<select name='member_id' onChange=\"dochange_user('position_name',this.value);\">\n";
          echo "<option value='0'>---เลือกชื่อ---</option>\n";                             
          while($arr['member'] = $db->fetch($res['member'])){
               echo "<option value=".$arr['member']['member_id']." >".$arr['member']['prefix'].$arr['member']['fname']."&nbsp;&nbsp;".$arr['member']['lname']."</option> \n" ;
          }
		  echo "</select>\n";
     } else if ($data=='position_name') {
	      $res['memb'] = $db->select_query("SELECT position_id FROM ".TB_MEMBER." WHERE member_id=".$val."");
		  $arr['memb'] = $db->fetch($res['memb']) ;
	      $res['position'] = $db->select_query("SELECT * FROM ".TB_MEMBER_POSITION." WHERE position_id=".$arr['memb']['position_id']."");
		  $arr['position'] = $db->fetch($res['position']) ;		  
		  echo "&nbsp;<b>ตำแหน่ง&nbsp;:</b>&nbsp;&nbsp;";
		  echo $arr['position']['position_name'];
		  echo "<br><br>";
		  echo "<B>อีกตำแหน่ง :</B><BR>";
          echo "<select name='elect_id' onChange=\"dochange_user('athor',this.value);\">\n";
          echo "<option value='0'>-ไม่เลือกแสดงว่าไม่มี-</option>\n";                             
               echo "<option value='1' >ปฏิบัติหน้าที่</option> \n" ;
			   echo "<option value='2' >รักษาราชการแทน</option> \n" ;
          echo "</select>\n";
		  echo "&nbsp;&nbsp;<font id='athor'><select><option value='0'>-------------------</option></select></font>";
     } else if ($data=='athor') {
		  $res['posit'] = $db->select_query("SELECT * FROM ".TB_MEMBER_POSITION." ORDER BY position_id ");		  
          echo "<select name='elect_position_id'>\n";
          echo "<option value='0'>---เลือกอีกตำแหน่ง---</option>\n";                             
          while($arr['posit'] = $db->fetch($res['posit'])){
               echo "<option value=".$arr['posit']['position_id']." >".$arr['posit']['position_name']."</option> \n" ;
          }
		  echo "</select>\n";
     }
     
$db->closedb ();

?>