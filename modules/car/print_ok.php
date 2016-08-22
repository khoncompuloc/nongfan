<?php
require_once("../../includes/config.in.php");
require_once("../../includes/class.mysql.php");
 $db = New DB();
 $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
 $db->update_db(TB_CAR_PERMISSION,array(
      "c_status"=>"p"
	  ),"id=".$_GET['id']."");
	  echo "บันทึกเรียบร้อยแล้ว" ;
?>
<script language="javascript" type="text/javascript">
  window.close();
</script>