<?php
Check_passadu($admin_user,$admin_level);
empty($ProcessOutput)?$ProcessOutput="":$ProcessOutput=$ProcessOutput ;
?>
<link href="modules/admin/css/style.css" rel="stylesheet" type="text/css">
<TABLE cellSpacing="0" cellPadding="0" width="950" border="0">
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="940" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/admin/texmenu_stock_start.gif" BORDER="0"><BR>
				<TABLE width="940" align="center" cellSpacing="0" cellPadding="0" border="0" >
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD><br>
<?php  
  if(!$ProcessOutput AND $op == "material_acc_section_report" AND $action == "add" AND $data != "") {
	  
	  
	  empty($_POST['sh_id'])?$sh_id="":$sh_id=$_POST['sh_id'] ;
	  empty($_POST['shs_id'])?$shs_id="":$shs_id=$_POST['shs_id'] ;
	  empty($_POST['src_number'])?$ss_ref="":$ss_ref=$_POST['src_number']." /25".WEB_BUDGET ;  
	  empty($_POST['src_number'])?$src_number="":$src_number=$_POST['src_number'] ;  
	  empty($_POST['src_date'])?$ss_date="":$ss_date=$_POST['src_date'] ;
	  empty($_POST['section_id'])?$section_id="":$section_id=$_POST['section_id'] ;
	  empty($_POST['ss_name'])?$ss_name="":$ss_name=$_POST['ss_name'] ;
	  empty($_POST['shs_keep'])?$shs_keep="":$shs_keep=$_POST['shs_keep'] ;
	  empty($_POST['shc_id'])?$shc_id="":$shc_id=$_POST['shc_id'] ;
	  empty($_POST['sc_price'])?$ss_price="":$ss_price=$_POST['sc_price'] ;
	  empty($_POST['sc_amount'])?$ss_amount="":$ss_amount=$_POST['sc_amount'] ;
	  empty($_POST['sc_note'])?$sc_note="":$sc_note=$_POST['sc_note'] ;
	  empty($_POST['shp_diff_name'])?$shp_diff_name="":$shp_diff_name=$_POST['shp_diff_name'] ;
	  empty($_POST['sh_diff_name'])?$sh_diff_name="":$sh_diff_name=$_POST['sh_diff_name'] ;
  
                $ss_logic = 1 ;
				$ss_acc_logic = 1 ;
				//$s_requistion = 1 ;
				
/***				
					echo "sh_id=".$sh_id ;
					echo "<br>shs_id=".$shs_id ;
					echo "<br>ss_ref=".$ss_ref ;
					echo "<br>src_number=".$src_number ;
					echo "<br>ss_date=".$ss_date ;
					echo "<br>section_id=".$section_id ;
					echo "<br>ss_name=".$ss_name ;
					echo "<br>shc_id=".$shc_id ;					
					echo "<br>ss_price=".$ss_price ;
					echo "<br>ss_amount=".$ss_amount ;
					echo "<br>sc_note=".$sc_note ;
					echo "<br>shp_diff_name=".$shp_diff_name ;
					echo "<br>sh_diff_name=".$sh_diff_name ;
					echo "<br><br>";
***/					
					   
if($data=="new_head_section") { // NEW

// start NEW start NEW start NEW start NEW start NEW start NEW start NEW start NEW start NEW start NEW start NEW start NEW start NEW start NEW start NEW 
    
/***
	if($rows['stock_head']){
		    echo "<script language='javascript'>" ;
		    echo "alert('ต้องขออภัยชื่อหรือชนิดวัสดุ : ".$_POST['sh_name']." มีในระบบแล้วไม่สามารถเพิ่มได้' )" ;
		    echo "</script>" ;
		    echo "<script language='javascript'>javascript:history.go(-1)</script>";
		    exit();			
			$check_psd = false ;
		}
***/
            $ss_amountcost =  $ss_amount ;
            $ss_pricecost  =  $ss_price*$ss_amount ; 
			
	        $res['stock_data'] = $db->select_query("SELECT acc_number FROM ".TB_STOCK_DATA." WHERE section_id='".$section_id."'");
		    $arr['stock_data'] = $db->fetch($res['stock_data']);
		    $acc_number = $arr['stock_data']['acc_number'] + 1 ;			
   
            $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
            
			$res['head_section_shc_id'] = $db->select_query("SELECT * FROM ".TB_STOCK_HEAD_CENTER." WHERE shc_id='".$shc_id."'");
			$arr['head_section_shc_id'] = $db->fetch($res['head_section_shc_id']);
			
			$db->add_db(TB_STOCK_HEAD_SECTION,array(
			    "sh_id"=>"".$sh_id."",
				//"shs_diff_name"=>"".$arr['head_section_shc_id']['shc_diff_name']."",
				"shs_keep"=>"".$shs_keep."",
				"shs_high"=>"".$arr['head_section_shc_id']['shc_high']."",
				"shs_low"=>"".$arr['head_section_shc_id']['shc_low']."",
				"section_id"=>"".$section_id."",			
                "acc_number"=>"".$acc_number."",
				"shc_id"=>"".$shc_id.""
				));

			$check_shs_id=mysql_query("select shs_id  from ".TB_STOCK_HEAD_SECTION." WHERE section_id='".$section_id."' ORDER BY shs_id  DESC");
		    list($shs_id)=mysql_fetch_row($check_shs_id);
			empty($shs_id)?$shs_id="":$shs_id=$shs_id ;
			$ss_requistion = 0 ;			
			
                 
//                if( $_POST['ss_logic_1'] == '1' ) {
//	                $res['shop'] = $db->select_query("SELECT shop_name FROM ".TB_SHOP." WHERE shop_name ='".$_POST['ss_name_1']."'");
//	                $rows['shop'] = $db->rows($res['shop']);                     
//					if(!$rows['shop']){
//					    $db->add_db(TB_SHOP,array(
//				        "shop_name"=>"".$_POST['ss_name_1'].""
//			            ));	
//                   }					
//                }				
	            	
                $db->add_db(TB_STOCK_HEAD_PRICE,array(
				"shp_amountcost"=>"".$ss_amount."",
				"shp_price"=>"".$ss_price."",
				"shp_diff_name"=>"".$shp_diff_name."",
				"src_number"=>"".$src_number."",
				"shs_id"=>"".$shs_id.""				
	            ));	
				
			    $check_shp_id=mysql_query("select shp_id  from ".TB_STOCK_HEAD_PRICE." ORDER BY shp_id  DESC");
		        list($shp_id)=mysql_fetch_row($check_shp_id);
			    empty($shp_id)?$shp_id="":$shp_id=$shp_id ;				

                $db->add_db(TB_STOCK_SECTION,array(
				"shs_id"=>"".$shs_id."",
				"ss_date"=>"".$ss_date."",
				"ss_name"=>"".$ss_name."",
				"ss_ref"=>"".$ss_ref."",
				"ss_price"=>"".$ss_price."",
				"ss_amount"=>"".$ss_amount."",
				"ss_amountcost"=>"".$ss_amountcost."",
				"ss_pricecost"=>"".$ss_pricecost."",
				"ss_note"=>"".$sc_note."",				
				"ss_logic"=>"".$ss_logic."",								
				"ss_requistion"=>"".$ss_requistion."",												
				"section_id"=>"".$section_id."",
				"ss_acc_logic"=>"".$ss_acc_logic."",
				"src_number"=>"".$src_number."",
				"shp_id"=>"".$shp_id.""				
			    ));					

			    $db->update_db(TB_STOCK_DATA,array(
				"acc_number"=>"".$acc_number.""
				)," section_id='".$section_id."'");
				
			//$db->closedb ();
			$ProcessOutput  = "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?compu=admin&loc=main\"><IMG SRC=\"images/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>ได้ทำการบันทึก  ชื่อวัสดุ : ".$ss_name." เป็นที่เรียบร้อย</B></FONT><BR><BR>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR><BR><BR>";
            //echo "<script type='text/javascript'>window.location.href = \"index.php?compu=wsd&loc=material_requistion_print&op=material_acc_report&data=".$src_number."\";</script>" ;
			
// end NEW end NEW end NEW end NEW end NEW end NEW end NEW end NEW end NEW end NEW end NEW end NEW end NEW end NEW end NEW end NEW end NEW end NEW 					   		

} else if($data=="old_head_section"){


// start OLD start OLD start OLD start OLD start OLD start OLD start OLD start OLD start OLD start OLD start OLD start OLD start OLD start OLD start OLD 


				   $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
                    
                   $ss_requistion = 0 ;

                   $res['stock_section'] = $db->select_query("SELECT max(ss_date) as max_date  FROM ".TB_STOCK_SECTION." WHERE shs_id='".$shs_id."' AND section_id='".$section_id."'");
                   $arr['stock_section'] = $db->fetch($res['stock_section']) ;
				   
                   if($ss_date < $arr['stock_section']['max_date']){
					   
					   echo "<script language='javascript'>" ;
		               echo "alert('ไม่ผ่าน  วันที่  ".$ss_date." น้อยกว่า ".$arr['stock_section']['max_date']."  วันที่ล่าสุด')" ;
		               echo "</script>" ;
		               //echo "<script language='javascript'>javascript:history.go(-1)</script>";
		               //exit();						  
				   } else {
					   
					   //echo "ผ่าน OK. วันที่ ".$ss_date." ไม่น้อยกว่า ".$arr['stock_section']['max_date'] ;
				   
                   $res['stock_head_from'] = $db->select_query("SELECT shs_id, sum(shp_amountcost) as amount, sum(shp_price*shp_amountcost) as price  FROM ".TB_STOCK_HEAD_PRICE." WHERE shs_id='".$shs_id."' GROUP BY shs_id ");
                   $arr['stock_head_from'] = $db->fetch($res['stock_head_from']) ;
		           $row['stock_head_from'] = $db->rows($res['stock_head_from']) ;

		            if($row['stock_head_from']) {	
                    $amountcost =  $arr['stock_head_from']['amount'] ;	 
		            $pricecost =  $arr['stock_head_from']['price'] ;
		            } else {
		            $amountcost =  0 ;	 
		            $pricecost  =  0 ;
		            }
		
		    $ss_amountcost = $amountcost + $ss_amount ;
			$ss_pricecost = $pricecost + ($ss_price*$ss_amount);
			
			      echo "amountcost = ".$amountcost  ;
				  echo "<br>pricecost = ".$pricecost  ;
				  
                   $res['stock_head_price'] = $db->select_query("SELECT shp_id ,shp_amountcost FROM ".TB_STOCK_HEAD_PRICE." WHERE shs_id='".$shs_id."' AND shp_price='".$ss_price."' AND shp_diff_name='".$shp_diff_name."'");
                   $arr['stock_head_price'] = $db->fetch($res['stock_head_price']) ;
		           $row['stock_head_price'] = $db->rows($res['stock_head_price']) ;

                  	if($row['stock_head_price']) {	
                       //echo "มีราคาและคุณสมบัติหรือลักษณะเดิมอยู่  shp_id = ".$row['stock_head_price']['shp_id']  ;
					   
						$amount_cost =  $arr['stock_head_price']['shp_amountcost'] + $ss_amount ;
				        $db->update_db(TB_STOCK_HEAD_PRICE,array(
			            "shp_amountcost"=>"".$amount_cost."",
						"src_number"=>"".$src_number.""
	            	    )," shp_id='".$arr['stock_head_price']['shp_id']."'");
						
						empty($arr['stock_head_price']['shp_id'])?$shp_id="":$shp_id=$arr['stock_head_price']['shp_id'] ;
						
		            } else {
                       //echo "กำหนดราคาและลักษณะใหม่  shp_id = ".$shs_id  ;
					   
                        $db->add_db(TB_STOCK_HEAD_PRICE,array(
				        "shp_amountcost"=>"".$ss_amount."",
				        "shp_price"=>"".$ss_price."",
					    "shp_diff_name"=>"".$shp_diff_name."",
						"src_number"=>"".$src_number."",
				        "shs_id"=>"".$shs_id.""
			            ));	
						
			            $check_shp_id=mysql_query("select shp_id  from ".TB_STOCK_HEAD_PRICE." ORDER BY shp_id  DESC");
		                list($shp_id)=mysql_fetch_row($check_shp_id);
			            empty($shp_id)?$shp_id="":$shp_id=$shp_id ;						
					
		            }				   

                $db->add_db(TB_STOCK_SECTION,array(
				"shs_id"=>"".$shs_id."",
				"ss_date"=>"".$ss_date."",
				"ss_name"=>"".$ss_name."",
				"ss_ref"=>"".$ss_ref."",
				"ss_price"=>"".$ss_price."",
				"ss_amount"=>"".$ss_amount."",
				"ss_amountcost"=>"".$ss_amountcost."",
				"ss_pricecost"=>"".$ss_pricecost."",
				"ss_note"=>"".$sc_note."",				
				"ss_logic"=>"".$ss_logic."",								
				"ss_requistion"=>"".$ss_requistion."",												
				"section_id"=>"".$section_id."",
				"ss_acc_logic"=>"".$ss_acc_logic."",
				"src_number"=>"".$src_number."",
				"shp_id"=>"".$shp_id.""				
			    ));	

				$db->update_db(TB_STOCK_HEAD_SECTION,array(
				"shc_id"=>"".$shc_id.""
				)," shs_id='".$shs_id."'");       				
				
// end OLD end OLD end OLD end OLD end OLD end OLD end OLD end OLD end OLD end OLD end OLD end OLD end OLD end OLD end OLD end OLD end OLD end OLD 					   		
                   }
}          
			$db->closedb ();
            echo "<script type='text/javascript'>window.location.href = \"index.php?compu=wsd&loc=material_requistion_print&op=material_acc_report&data=".$src_number."\";</script>" ;
            break;
} else if(!$ProcessOutput AND $op == "material_acc_section_report" AND $data != "") {
	
	                $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					
					$res['stock_requistion_center'] = $db->select_query("SELECT * ,UNIX_TIMESTAMP(src_date) AS srcdate FROM ".TB_STOCK_REQUISTION_CENTER." WHERE src_number=$data");
	                $arr['stock_requistion_center'] = $db->fetch($res['stock_requistion_center']);
					//$res['member'] = $db->select_query("SELECT member_id ,prefix ,fname ,lname FROM ".TB_MEMBER." WHERE member_id='".$arr['stock_requistion_center']['member_id']."'");
					//$arr['member'] = $db->fetch($res['member']);						
					$res['member_section'] = $db->select_query("SELECT section_name FROM ".TB_MEMBER_SECTION." WHERE section_id='".$arr['stock_requistion_center']['section_id']."'");
					$arr['member_section'] = $db->fetch($res['member_section']);
					
					$res['stock_center'] = $db->select_query("SELECT sc_id ,shc_id ,sc_name ,sc_price ,sc_amount ,sc_note ,sc_requistion ,shp_diff_name FROM ".TB_STOCK_CENTER." WHERE sc_id='".$_GET['sc_id']."' AND src_number=$data ");
					$arr['stock_center'] = $db->fetch($res['stock_center']);
					$res['stock_head_center'] = $db->select_query("SELECT shc_id ,sh_id FROM ".TB_STOCK_HEAD_CENTER." WHERE shc_id='".$arr['stock_center']['shc_id']."'");
					$arr['stock_head_center'] = $db->fetch($res['stock_head_center']);
					$res['stock_head'] = $db->select_query("SELECT sh_name ,sh_unit ,sh_diff_name FROM ".TB_STOCK_HEAD." WHERE sh_id='".$arr['stock_head_center']['sh_id']."'");
					$arr['stock_head'] = $db->fetch($res['stock_head']);
					
  			        $res['section'] = $db->select_query("SELECT section_name FROM ".TB_MEMBER_SECTION." WHERE section_id='".$arr['stock_requistion_center']['section_id']."'");
			        $arr['section'] = $db->fetch($res['section']);	
					
				    $count_str=mb_strlen($arr['section']['section_name']);
				    if($count_str > 12){
					  $arr_p['name']="ห้อง".mb_substr($arr['section']['section_name'],0,12,"utf-8")."..."; 
				    }else{
					  $arr_p['name']="ห้อง".$arr['section']['section_name'];
				    }						

// เช็ค  stock section ว่ามี บ/ช วัสดุยัง ในส่วนงาน 					
                       $res['head_section'] = $db->select_query("SELECT shs_id ,shs_keep FROM ".TB_STOCK_HEAD_SECTION." WHERE sh_id='".$arr['stock_head_center']['sh_id']."' AND section_id='".$arr['stock_requistion_center']['section_id']."'");
					   $row['head_section'] = $db->rows($res['head_section']);
					   $arr['head_section'] = $db->fetch($res['head_section']);
                       if($row['head_section']) {  //มีชื่อวัสดุอยู่บัญชีส่วนงาน
                            //$res['head_section_shc_id'] = $db->select_query("SELECT shs_id FROM ".TB_STOCK_HEAD_SECTION." WHERE shc_id='".$arr['stock_head_center']['shc_id']."'");
					        //$row['head_section_shc_id'] = $db->rows($res['head_section_shc_id']);
							//if($row['head_section_shc_id']) { //ได้มีการเชื่อนโยงบัญชีส่วนกลางกับส่วนงานแล้ว
							//	$acc_all_logic = true ;								
							//} else { // ยังไม่ได้เชื่อนโยงัญชีส่วนกลางกับส่วนงานแล้ว
							//	$acc_all_logic = false ;
							//}
						   $acc_logic = true ;
					   } else {  //ยังไม่มีบัญชีวัสดุ
						   $acc_logic = false ; 
					   }
					   //echo "sh_id=".$arr['stock_head_center']['sh_id']."<br>"  ;
					   //echo "section_id=".$arr['stock_requistion_center']['section_id']."<br>"  ;
					   //echo "shc_id=".$arr['stock_head_center']['shc_id']."<br>"  ;
?>
<script language="javascript" type="text/javascript">
function acc_submit(data) {
    //if(confirm("คุณต้องการบันทึกข้อมูล หรือไม่!")){
	document.frm_acc.method="post";
	document.frm_acc.action="?compu=wsd&loc=material_requistion_print&op=material_acc_section_report&action=add&data="+data+"";
	document.frm_acc.submit();
	//}
	return ;
}
</script>
<form name="frm_acc" id="frm_acc" enctype="multipart/form-data">  
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">บัญชีวัสดุ :</td>
	<td width="35%" align="left">&nbsp;&nbsp;&nbsp;<b><?php echo " ".$arr['member_section']['section_name'] ;?></b></td>
	<td width="21%" align="right">
	<input  type="hidden" name="sh_id" id="sh_id" value="<?php echo $arr['stock_head_center']['sh_id'] ;?>">
	</td>
</tr>
<tr>
    <td height="10" colspan="6"></td>
</tr>	
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">เลขที่เอกสาร :</td>
    <td width="35%" align="left">&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="<?php echo $arr['stock_requistion_center']['src_number']." /25".WEB_BUDGET ;?>" disabled>
	</td>
	<td width="21%" align="right">
	<input type="hidden" name="src_number" id="src_number" value="<?php echo $arr['stock_requistion_center']['src_number'] ;?>" >
	</td>	
</tr>
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">วัน เดือน ปี :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
	<input name="tCalendar_1" type="text" id="tCalendar_1" size="15" style="color:#ff0000;font-weight:bold" value="<?php echo ThaiTimeConvert($arr['stock_requistion_center']['srcdate'],"","");?>" disabled>
	</td>  
	<td width="21%" align="right">
	<input  type="hidden" name="src_date" id="src_date" value="<?php echo $arr['stock_requistion_center']['src_date'] ;?>">
	</td>	
</tr>
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">หน่วยงาน :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
    <input  type="text" size="25" value="<?php echo $arr['member_section']['section_name'] ;?>" disabled>
	</td>
	<td width="21%" align="right">
	<input  type="hidden" name="section_id" id="section_id" value="<?php echo $arr['stock_requistion_center']['section_id'] ;?>">
	</td>	
</tr>
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">รับจาก :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
<?php
						$res['memberSection'] = $db->select_query("SELECT section_name FROM ".TB_MEMBER_SECTION." WHERE section_id='2'");
						$arr['memberSection'] = $db->fetch($res['memberSection']) ; 
?>							
	<input  type="text" size="25" value="<?php echo $arr['memberSection']['section_name'] ;?>" disabled>
	</td>
	<td width="21%" align="right">
	<input  type="hidden" name="ss_name" id="ss_name" value="<?php echo $arr['memberSection']['section_name'] ;?>">
	</td>	
</tr>
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">ประเภทวัสดุ :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
<?php
						$res['stock_type'] = $db->select_query("SELECT type_name FROM ".TB_STOCK_TYPE." WHERE type_id='".$arr['stock_requistion_center']['type_id']."'");
						$arr['stock_type'] = $db->fetch($res['stock_type']) ;
?>	
	<input  type="text" size="25" value="<?php echo $arr['stock_type']['type_name'] ;?>" disabled>
	</td>
	<td width="21%" align="right">
	</td>	
</tr>
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">ชื่อหรือชนิดวัสดุ :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
    <input  type="text" size="25" value="<?php echo $arr['stock_head']['sh_name'] ;?>" disabled>
	</td>
	<td width="21%" align="right">
	<input  type="hidden" name="shc_id" id="shc_id" value="<?php echo $arr['stock_head_center']['shc_id'] ;?>">
	</td>	
</tr>
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">ขนาดหรือลักษณะ :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
    <input  type="text" size="25" value="<?php echo $arr['stock_head']['sh_diff_name']; ?>" disabled>
	<input type="hidden" name="sh_diff_name" id="sh_diff_name" value="<?php echo $arr['stock_head']['sh_diff_name']; ?>">
	<input type="hidden" name="sc_note" id="sc_note" value="<?php echo $arr['stock_center']['sc_note']; ?>">
	</td>	
</tr>
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">ราคาต่อหน่วย :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
    <input  type="text" size="25" value="<?php echo $arr['stock_center']['sc_price']." บาท" ;?>" disabled>
	</td>
	<td width="21%" align="right">
	<input type="hidden" name="sc_price" id="sc_price" value="<?php echo $arr['stock_center']['sc_price']; ?>">
	</td>	
</tr>
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">รับจำนวน :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
    <input  type="text" size="25" value="<?php echo $arr['stock_center']['sc_amount']." ".$arr['stock_head']['sh_unit'] ;?>" disabled>
	</td>
	<td width="21%" align="right">
	<input type="hidden" name="sc_amount" id="sc_amount" value="<?php echo $arr['stock_center']['sc_amount']; ?>">
	</td>	
</tr>
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">ขนาดหรือลักษณะ (ย่อย):</td>
    <td width="35%" align="left">&nbsp;&nbsp;
    <input  type="text" size="25" value="<?php echo $arr['stock_center']['shp_diff_name']; ?>" disabled>
	</td>	
	<td width="21%" align="right">
	<input type="hidden" name="shp_diff_name" id="shp_diff_name" value="<?php echo $arr['stock_center']['shp_diff_name']; ?>">
	<input type="hidden" name="sc_note" id="sc_note" value="<?php echo $arr['stock_center']['sc_note']; ?>">
    </td>
</tr>
<?php
       if($acc_logic) {
	   echo "<script language=\"javascript\" type=\"text/javascript\">" ;
	   echo "function  print_acc_section_open(data) {" ;
	   echo "window.open(\"modules/wsd/print_acc_section.php?shs_id=\"+data+\"\",\"\",\"toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=960,height=815,left=5,top=0\"); " ;
       echo "}" ;
	   echo "</script>" ;
?>	
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">ที่เก็บ :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
	<input  type="text" size="25" value="<?php echo $arr['head_section']['shs_keep'] ;?>" disabled>
	</td>
	<td width="21%" align="right">
	</td>	
</tr>
<tr>
    <td height="35" colspan="4" align="center"><input type="button" name="submit1" id="submit1" onClick="acc_submit('old_head_section');" value="  บันทึกลงบัญชีวัสดุตัวเดิม  ">
	<input type="button" onClick="print_acc_section_open(<?php echo $arr['head_section']['shs_id']; ?>);" value="...">
	<input type="hidden" name="shs_id" id="shs_id" value="<?php echo $arr['head_section']['shs_id']; ?>">
	</td>
</tr>   
<?php	   
	   } else {
?>
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right"><font color="#ff0000">ที่เก็บ :</font></td>
    <td width="35%" align="left">&nbsp;&nbsp;
    <input  type="text" name="shs_keep" id="shs_keep" size="25" value="<?php echo $arr_p['name'] ;?>">
	&nbsp;(<font color="#ff0000">คีย์ที่เก็บใหม่ได้</font>)
	</td>
	<td width="21%" align="right">
	</td>	
</tr>		   
<tr>
    <td height="35" colspan="4" align="center"><input type="button" name="submit2" id="submit2" onClick="acc_submit('new_head_section');" value="  บันทึกลงบัญชีวัสดุตัวใหม่  "></td>
</tr>
<?php	   
	   }
?>
 <tr>
    <td height="10" colspan="4"></td>
 </tr>
 <tr>
    <td height="20" colspan="4" align="right">
	<input type="button" onClick="window.location.href='?compu=wsd&loc=material_requistion_print&op=material_acc_report&data=<?php echo $arr['stock_requistion_center']['src_number'];?>'" value="<-- กลับก่อนหน้านี้ ">
	</td>
</tr>
 <tr>
    <td height="20" colspan="4"></td>
</tr>
</table><br>
</form>
<?php	   
} else if(!$ProcessOutput AND $op == "material_acc_center_report" AND $action == "add" AND $data != "") {
	  
	  empty($_POST['sc_id'])?$sc_id="":$sc_id=$_POST['sc_id'] ;
	  empty($_POST['src_number'])?$src_number="":$src_number=$_POST['src_number'] ;  
	  empty($_POST['src_date'])?$src_date="":$src_date=$_POST['src_date'] ;
	  empty($_POST['section_id'])?$section_id="":$section_id=$_POST['section_id'] ;
	  empty($_POST['sc_name'])?$sc_name="":$sc_name=$_POST['sc_name'] ;
	  empty($_POST['member_id'])?$member_id="":$member_id=$_POST['member_id'] ;
	  empty($_POST['shc_id'])?$shc_id="":$shc_id=$_POST['shc_id'] ;
	  empty($_POST['sc_price'])?$sc_price="":$sc_price=$_POST['sc_price'] ;
	  empty($_POST['sc_amount'])?$sc_amount="":$sc_amount=$_POST['sc_amount'] ;
	  empty($_POST['sc_note'])?$sc_note="":$sc_note=$_POST['sc_note'] ;
	  empty($_POST['shp_diff_name'])?$shp_diff_name="":$shp_diff_name=$_POST['shp_diff_name'] ;
	  //empty($_POST['shc_diff_name'])?$shc_diff_name="":$shc_diff_name=$_POST['shc_diff_name'] ;
	  
                $sc_logic = 0 ;
				$sc_deega = "" ;
				$sc_requistion = 1 ;
				$sc_acc_logic = 1 ;
				$sc_ref = $src_number." /25".WEB_BUDGET ;
				
				
			    $check_amount_id=mysql_query("select sc_amountcost  from ".TB_STOCK_CENTER." where shc_id='".$shc_id."' order by sc_id  DESC");
		        list($sc_amountcost)=mysql_fetch_row($check_amount_id);
				$check_date=mysql_query("select sc_date  from ".TB_STOCK_CENTER." where shc_id='".$shc_id."' order by sc_id  DESC");
				list($sc_date)=mysql_fetch_row($check_date);
			    empty($sc_amountcost)?$amountcost="":$amountcost=$sc_amountcost ;
				empty($sc_date)?$sc_date="":$sc_date=$sc_date ;
                $Vamountcost = $amountcost - $sc_amount ;


				
				if($src_date < $sc_date){
				    echo "<script language='javascript'>" ;
		            echo "alert('ต้องขออภัย วันที่ต้องมากกว่าหรือเท่ากับวันที่ล่าสุด' )" ;
		            echo "</script>" ;
		            echo "<script language='javascript'>javascript:history.go(-1)</script>";
		            exit();					
				} else {
/***					
					echo "amountcost=".$amountcost ;
					echo "<br>sc_date=".$sc_date ;
					echo "<br>src_date=".$src_date ;
					echo "<br>Vamountcost=".$Vamountcost ;
					echo "<br>shc_id=".$shc_id ;
					echo "<br>sc_ref=".$sc_ref ;
					echo "<br>src_number=".$src_number ;
					echo "<br>sc_id=".$sc_id ;
				}
***/				
				$db->add_db(TB_STOCK_CENTER,array(
				"shc_id"=>"".$shc_id."",
				"sc_date"=>"".$src_date."",
				"sc_name"=>"".$sc_name."",
				"sc_ref"=>"".$sc_ref."",
				"sc_price"=>"".$sc_price."",
				"sc_amount"=>"".$sc_amount."",
				"sc_amountcost"=>"".$Vamountcost."",
				"sc_deega"=>"".$sc_deega."",
				"sc_note"=>"".$sc_note."",				
				"sc_logic"=>"".$sc_logic."",
                "sc_requistion"=>"".$sc_requistion."",				
				"sc_acc_logic"=>"".$sc_acc_logic."",
				"src_number"=>"".$src_number."",
				"shp_diff_name"=>"".$shp_diff_name.""
		     	));	

			    $db->update_db(TB_STOCK_CENTER,array(
				"sc_acc_logic"=>"".$sc_acc_logic.""
				)," sc_id='".$sc_id."'");

                echo "<script type='text/javascript'>window.location.href = \"index.php?compu=wsd&loc=material_requistion_print&op=material_acc_report&data=".$src_number."\";</script>" ;				
				}
	  	        
} else if(!$ProcessOutput AND $op == "material_acc_center_report" AND $data != "") {
	
	                $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					
					
					$res['stock_requistion_center'] = $db->select_query("SELECT * ,UNIX_TIMESTAMP(src_date) AS srcdate FROM ".TB_STOCK_REQUISTION_CENTER." WHERE src_number=$data");
	                $arr['stock_requistion_center'] = $db->fetch($res['stock_requistion_center']);
					$res['member_section'] = $db->select_query("SELECT section_name FROM ".TB_MEMBER_SECTION." WHERE section_id='".$arr['stock_requistion_center']['section_id']."'");
					$arr['member_section'] = $db->fetch($res['member_section']);
					$res['member'] = $db->select_query("SELECT member_id ,prefix ,fname ,lname FROM ".TB_MEMBER." WHERE member_id='".$arr['stock_requistion_center']['member_id']."'");
					$arr['member'] = $db->fetch($res['member']);						
					$res['member_section'] = $db->select_query("SELECT section_name FROM ".TB_MEMBER_SECTION." WHERE section_id='".$arr['stock_requistion_center']['section_id']."'");
					$arr['member_section'] = $db->fetch($res['member_section']);
					
					$res['stock_center'] = $db->select_query("SELECT sc_id ,shc_id ,sc_name ,sc_price ,sc_amount ,sc_note ,sc_requistion ,shp_diff_name FROM ".TB_STOCK_CENTER." WHERE sc_id='".$_GET['sc_id']."' AND src_number=$data ");
					$arr['stock_center'] = $db->fetch($res['stock_center']);
					$res['stock_head_center'] = $db->select_query("SELECT shc_id ,sh_id FROM ".TB_STOCK_HEAD_CENTER." WHERE shc_id='".$arr['stock_center']['shc_id']."'");
					$arr['stock_head_center'] = $db->fetch($res['stock_head_center']);
					$res['stock_head'] = $db->select_query("SELECT sh_name ,sh_unit ,sh_diff_name FROM ".TB_STOCK_HEAD." WHERE sh_id='".$arr['stock_head_center']['sh_id']."'");
					$arr['stock_head'] = $db->fetch($res['stock_head']);
					
?>
<script language="javascript">
 function checkconfirm()
 {
 if(confirm('กรุณาตรวจสอบ แล้วยืนยัน')==true)
 {
 f.submit();
 document.f.submit.disabled='true';
 return true;
 }else{ return false;}
 }
 </script>
<form name="frm" id="frm" method="post" action="?compu=wsd&loc=material_requistion_print&op=material_acc_center_report&action=add&data=voi_add"  enctype="multipart/form-data"> <!-- onsubmit="return checkconfirm()"  -->  
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">บัญชีวัสดุ :</td>
	<td width="35%" align="left">&nbsp;&nbsp;&nbsp;<b>ส่วนกลาง</b></td>
	<td width="21%" align="right">
	<input  type="hidden" name="sc_id" id="sc_id" value="<?php echo $arr['stock_center']['sc_id'] ;?>">
	</td>
</tr>
<tr>
    <td height="10" colspan="4"></td>
</tr>	
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">เลขที่เอกสาร :</td>
    <td width="35%" align="left">&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="<?php echo $arr['stock_requistion_center']['src_number']." /25".WEB_BUDGET ;?>" > (เลขที่ใบเบิก)</td>	    
    <td width="21%" height="30">
	<input type="hidden" name="src_number" id="src_number" value="<?php echo $arr['stock_requistion_center']['src_number']; ?>" >	
	</td>
</tr>
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">วัน เดือน ปี :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
	<input  type="text" size="15" value="<?php echo ThaiTimeConvert($arr['stock_requistion_center']['srcdate'],"","");?>"></td>	
    <td width="21%" height="30">
	<input  type="hidden" name="src_date" id="src_date" value="<?php echo $arr['stock_requistion_center']['src_date'] ;?>">	
	</td>
</tr>
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">หน่วยงาน :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
    <input  type="text" size="25" value="<?php echo WEB_AGEN_MINI.WEB_AGEN_NAME ;?>">
	</td>
    <td width="21%" height="30">
	<input  type="hidden" name="section_id" id="section_id" value="<?php echo $arr['stock_requistion_center']['section_id'] ;?>">	
	</td>
</tr>
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">จ่ายให้ :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
	<input  type="text" size="25" value="<?php echo $arr['member']['prefix'].$arr['member']['fname']." ".$arr['member']['lname'] ;?>">
	</td>
    <td width="21%" height="30">
	<input  type="hidden" name="sc_name" id="sc_name" value="<?php echo $arr['member']['prefix'].$arr['member']['fname']." ".$arr['member']['lname'] ;?>">
	<input  type="hidden" name="member_id" id="member_id" value="<?php echo $arr['member']['member_id'] ;?>">	
	</td>
</tr>
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">ประเภทวัสดุ :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
<?php
						$res['stock_type'] = $db->select_query("SELECT type_name FROM ".TB_STOCK_TYPE." WHERE type_id='".$arr['stock_requistion_center']['type_id']."'");
						$arr['stock_type'] = $db->fetch($res['stock_type']) ;
?>
	<input  type="text" size="25" value="<?php echo $arr['stock_type']['type_name'] ;?>">
	</td>
    <td width="21%" height="30"></td>
</tr>
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">ชื่อหรือชนิดวัสดุ :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
    <input  type="text" size="25" value="<?php echo $arr['stock_head']['sh_name'] ;?>">
	</td>
    <td width="1%" height="30">
	<input  type="hidden" name="shc_id" id="shc_id" value="<?php echo $arr['stock_head_center']['shc_id'] ;?>">	
	</td>
</tr>
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">ขนาดหรือลักษณะ :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
    <input  type="text" size="25" value="<?php echo $arr['stock_head']['sh_diff_name']; ?>">
	</td>
    <td width="21%" height="30">
	</td>
</tr>
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">ราคาต่อหน่วย :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
    <input  type="text" size="25" value="<?php echo $arr['stock_center']['sc_price']." บาท" ;?>">
	</td>
    <td width="21%" height="30">
	<input type="hidden" name="sc_price" id="sc_price" value="<?php echo $arr['stock_center']['sc_price']; ?>">	
	</td>
</tr>
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">จ่ายจำนวน :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
    <input  type="text" size="25" value="<?php echo $arr['stock_center']['sc_amount']." ".$arr['stock_head']['sh_unit'] ;?>">
	</td>
    <td width="21%" height="30">
	<input type="hidden" name="sc_amount" id="sc_amount" value="<?php echo $arr['stock_center']['sc_amount']; ?>">	
	</td>
</tr>
<tr>
    <td width="24%" height="30"></td>
    <td width="20%" align="right">ขนาดหรือลักษณะ (ย่อย):</td>
    <td width="35%" align="left">&nbsp;&nbsp;
    <input  type="text" size="25" value="<?php echo $arr['stock_center']['shp_diff_name']; ?>">
	</td>	
	<td width="21%" align="right">
	<input type="hidden" name="shp_diff_name" id="shp_diff_name" value="<?php echo $arr['stock_center']['shp_diff_name']; ?>">
	<input type="hidden" name="sc_note" id="sc_note" value="<?php echo $arr['stock_center']['sc_note']; ?>">
    </td>
</tr>
<tr>
    <td height="35" colspan="4" align="center"><input type="submit" name="submit" id="submit" value="  บันทึกลงบัญชีวัสดุส่วนกลาง  "></td>
</tr>
<tr>
    <td height="10" colspan="4"></td>
</tr>
 <tr>
    <td height="20" colspan="4" align="right">
	<input type="button" onClick="window.location.href='?compu=wsd&loc=material_requistion_print&op=material_acc_report&data=<?php echo $arr['stock_requistion_center']['src_number'];?>'" value="<-- กลับก่อนหน้านี้ ">
	</td>
</tr>
 <tr>
    <td height="20" colspan="4"></td>
</tr>
</table><br>
</form>
<?php					
} else	if(!$ProcessOutput AND $op == "material_acc_report" AND $data != ""){
	                
	                $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					$res['stock_requistion_center'] = $db->select_query("SELECT * ,UNIX_TIMESTAMP(src_date) AS srcdate FROM ".TB_STOCK_REQUISTION_CENTER." WHERE src_number=$data");
	                $arr['stock_requistion_center'] = $db->fetch($res['stock_requistion_center']);
					$res['member_section'] = $db->select_query("SELECT section_name FROM ".TB_MEMBER_SECTION." WHERE section_id='".$arr['stock_requistion_center']['section_id']."'");
					$arr['member_section'] = $db->fetch($res['member_section']);
					$res['member'] = $db->select_query("SELECT prefix ,fname ,lname FROM ".TB_MEMBER." WHERE member_id='".$arr['stock_requistion_center']['member_id']."'");
					$arr['member'] = $db->fetch($res['member']);						
					//$res['member_section'] = $db->select_query("SELECT section_name FROM ".TB_MEMBER_SECTION." WHERE section_id='".$arr['stock_requistion_center']['section_id']."'");
					//$arr['member_section'] = $db->fetch($res['member_section']);
					
				         $count_str=mb_strlen($arr['member_section']['section_name']);
				         if($count_str > 12){
					        $arr_p['name']= mb_substr($arr['member_section']['section_name'],0,12,"utf-8")."..."; 
				            }else{
					        $arr_p['name']=$arr['member_section']['section_name'];
				            }					
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="14%" align="right" colspan="2">บัญชีวัสดุ :</td>
	<td width="35%" align="left">&nbsp;&nbsp;&nbsp;<b>ส่วนกลาง</b></td>
	<td width="11%" align="right" colspan="2">บัญชีวัสดุ  :</td>
	<td width="40%" align="left">&nbsp;&nbsp;&nbsp;<b><?php echo " ".$arr['member_section']['section_name'] ;?></b></td>
</tr>
<tr>
    <td height="10" colspan="6"></td>
</tr>	
<tr>
    <td width="4%" height="30"></td>
    <td width="10%" align="right">เลขที่เอกสาร :</td>
    <td width="35%" align="left">&nbsp;&nbsp;&nbsp;<input type="text" value="<?php echo $arr['stock_requistion_center']['src_number']." /25".WEB_BUDGET ;?>" size="5"> (เลขที่ใบเบิก)</td>	    
    <td width="1%" height="30"></td>
    <td width="10%" align="right">เลขที่เอกสาร :</td>
    <td width="40%" align="left">&nbsp;&nbsp;&nbsp;<input type="text" value="<?php echo $arr['stock_requistion_center']['src_number']." /25".WEB_BUDGET ;?>" size="5"></td>	    
</tr>
<tr>
    <td width="4%" height="30"></td>
    <td width="10%" align="right">วัน เดือน ปี :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
	<input  type="text" size="12" value="<?php echo ThaiTimeConvert($arr['stock_requistion_center']['srcdate'],"","");?>"></td>	
    <td width="1%" height="30"></td>
    <td width="10%" align="right">วัน เดือน ปี :</td>
    <td width="40%" align="left">&nbsp;&nbsp;
	<input name="tCalendar_1" type="text" id="tCalendar_1" size="12" value="<?php echo ThaiTimeConvert($arr['stock_requistion_center']['srcdate'],"","");?>"></td>    
</tr>
<tr>
    <td width="4%" height="30"></td>
    <td width="10%" align="right">หน่วยงาน :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
    <input  type="text" value="<?php echo WEB_AGEN_MINI.WEB_AGEN_NAME ;?>">
	</td>
    <td width="1%" height="30"></td>
    <td width="10%" align="right">หน่วยงาน :</td>
    <td width="40%" align="left">&nbsp;&nbsp;
    <input  type="text" value="<?php echo $arr_p['name'] ;?>">
	</td>	
</tr>
<tr>
    <td width="4%" height="30"></td>
    <td width="10%" align="right">จ่ายให้ :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
	<input  type="text" value="<?php echo $arr['member']['prefix'].$arr['member']['fname']." ".$arr['member']['lname'] ;?>">
	</td>
    <td width="1%" height="30"></td>
    <td width="10%" align="right">รับจาก :</td>
    <td width="40%" align="left">&nbsp;&nbsp;
<?php
						$res['memberSection'] = $db->select_query("SELECT section_name FROM ".TB_MEMBER_SECTION." WHERE section_id='2'");
						$arr['memberSection'] = $db->fetch($res['memberSection']) ; 
?>							
	<input  type="text" value="<?php echo $arr['memberSection']['section_name'] ;?>">
	</td>	
</tr>
<tr>
    <td width="4%" height="30"></td>
    <td width="10%" align="right">ประเภทวัสดุ :</td>
    <td width="35%" align="left">&nbsp;&nbsp;
<?php
						$res['stock_type'] = $db->select_query("SELECT type_name FROM ".TB_STOCK_TYPE." WHERE type_id='".$arr['stock_requistion_center']['type_id']."'");
						$arr['stock_type'] = $db->fetch($res['stock_type']) ;
?>
	<input  type="text" value="<?php echo $arr['stock_type']['type_name'] ;?>">
	</td>
    <td width="1%" height="30"></td>
    <td width="10%" align="right">ประเภทวัสดุ :</td>
    <td width="40%" align="left">&nbsp;&nbsp;
	<input  type="text" value="<?php echo $arr['stock_type']['type_name'] ;?>">
	</td>	
</tr>
<tr>
    <td height="10" colspan="6"></td>
</tr>
</table><br>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=3%  valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>ที่</b></span></p>
  </td>
  <td width=38%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>ชื่อหรือชนิดวัสดุ  (ขนาดหรือลักษณะ)</b></span></p>
  </td>
  <td width=12%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
 <b>จำนวน (รับ-จ่าย)</b></span></p>
  </td>
  <td width=14% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>ราคาต่อหน่วย (บาท)</b></span></p>
  </td>
  <td width=33% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <b>บันทึกลงบัญชีวัสดุ (ส่วนกลาง : ส่วนงาน/กอง)</b></span></p>
  </td>  
</tr>
<script language="javascript" type="text/javascript">
function  print_acc_center_open(data) {
	window.open("modules/wsd/print_acc_center.php?shc_id="+data+"","","toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=999,height=830,left=5,top=5"); 
}	
function  print_acc_section_open(data) {
	window.open("modules/wsd/print_acc_section.php?shs_id="+data+"","","toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=999,height=830,left=5,top=5"); 
}
</script>
 <form name="frm_report" id="frm_report" enctype="multipart/form-data">    
 <?php
                       $check_acc_center_ok = array() ;
					   $check_acc_section_ok = array() ;
					   $count_no = 1 ;
					   $res['stock_center'] = $db->select_query("SELECT sc_id ,shc_id ,sc_name ,sc_amount ,sc_price ,sc_acc_logic ,shp_diff_name FROM ".TB_STOCK_CENTER." WHERE sc_logic='1' AND sc_requistion='1' AND src_number='".$data."' ORDER BY sc_date");
					   while($arr['stock_center'] = $db->fetch($res['stock_center'])){
					   $res['stock_head_center'] = $db->select_query("SELECT shc_id ,sh_id FROM ".TB_STOCK_HEAD_CENTER." WHERE shc_id='".$arr['stock_center']['shc_id']."'");
					   $arr['stock_head_center'] = $db->fetch($res['stock_head_center']);
					   $res['stock_head'] = $db->select_query("SELECT sh_name ,sh_unit ,sh_diff_name FROM ".TB_STOCK_HEAD." WHERE sh_id='".$arr['stock_head_center']['sh_id']."'");
					   $arr['stock_head'] = $db->fetch($res['stock_head']);
					   //ส่วนงาน/กอง
                       $res['stock_head_section'] = $db->select_query("SELECT shs_id FROM ".TB_STOCK_HEAD_SECTION." WHERE section_id='".$arr['stock_requistion_center']['section_id']."' AND shc_id='".$arr['stock_head_center']['shc_id']."'");
					   $row['stock_head_section'] = $db->rows($res['stock_head_section']);
					   $arr['stock_head_section'] = $db->fetch($res['stock_head_section']);
                       if($row['stock_head_section']) {
                            //$res['stock_section'] = $db->select_query("SELECT shp_id FROM ".TB_STOCK_SECTION." WHERE shs_id='".$arr['stock_head_section']['shs_id']."' AND ss_acc_logic='1' AND src_number='".$arr['stock_requistion_center']['src_number']."'");
					        //$row['stock_section'] = $db->rows($res['stock_section']);
							//$arr['stock_section'] = $db->fetch($res['stock_section']);
							
							        $res['stock_price'] = $db->select_query("SELECT shp_id FROM ".TB_STOCK_HEAD_PRICE." WHERE shs_id='".$arr['stock_head_section']['shs_id']."' AND shp_price='".$arr['stock_center']['sc_price']."' AND shp_diff_name='".$arr['stock_center']['shp_diff_name']."' AND src_number='".$arr['stock_requistion_center']['src_number']."'");
					                $row['stock_price'] = $db->rows($res['stock_price']);
							
							if($row['stock_price'] or $arr['stock_requistion_center']['src_requistion_logic']=='2') {
								$acc_logic = true ;								
							} else {
								$acc_logic = false ;
							}
						   $shs_logic = true ;
					   } else {
						   $acc_logic = false ; 
						   $shs_logic = false ;
					   }	
					   
					   empty($arr['stock_head']['sh_diff_name'])?$sh_diff_name="":$sh_diff_name=" ".$arr['stock_head']['sh_diff_name']."" ;
					   empty($arr['stock_center']['shp_diff_name'])?$shp_diff_name="":$shp_diff_name=" (".$arr['stock_center']['shp_diff_name'].")" ;					   					   					   					   
?>
<script language="javascript" type="text/javascript">
function center_submit_<?php echo $count_no ; ?>() {
    //alert("<?php echo $count_no ; ?>");
    document.frm_report.method="post";
	document.frm_report.action="?compu=wsd&loc=material_requistion_print&op=material_acc_center_report&data=<?php echo $arr['stock_requistion_center']['src_number'];?>&sc_id=<?php echo $arr['stock_center']['sc_id'];?>";
	document.frm_report.submit();
}
function section_submit_<?php echo $count_no ; ?>() {
    //alert("<?php echo $count_no ; ?>");
    document.frm_report.method="post";
	document.frm_report.action="?compu=wsd&loc=material_requistion_print&op=material_acc_section_report&data=<?php echo $arr['stock_requistion_center']['src_number'];?>&sc_id=<?php echo $arr['stock_center']['sc_id'];?>";
	document.frm_report.submit();
}
</script>
  <tr style='mso-yfti-irow:2;height:14.05pt'>
  <td valign=top style='border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:14.05pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $count_no ; ?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:14.05pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_head']['sh_name'] ;?><?php echo $sh_diff_name ;?><?php echo $shp_diff_name ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:14.05pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_center']['sc_amount']."  ".$arr['stock_head']['sh_unit'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:14.05pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_center']['sc_price'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:14.05pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>

<?php 
  if($arr['stock_center']['sc_acc_logic']==0) {
  echo "<input type=\"button\" value=\"ส่วนกลาง\" onClick=\"center_submit_".$count_no."();\">&nbsp;" ;
       $check_acc_center_ok[$count_no-1] = "NO" ;
  
  } else {
  echo "<input type=\"button\" value=\" เรียบร้อย  \">" ;	  
      $check_acc_center_ok[$count_no-1] = "YES" ;
  }
?> 
  <input type="button" onClick="print_acc_center_open(<?php echo $arr['stock_head_center']['shc_id'];?>)" value="...">&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;
<?php 
  if($acc_logic) {
  echo "<input type=\"button\" value=\" เรียบร้อย  \">&nbsp;" ;	
      $check_acc_section_ok[$count_no-1] = "YES" ;  
  } else {
  echo "<input type=\"button\" value=\"".$arr_p['name']."\" onClick=\"section_submit_".$count_no."();\">&nbsp;" ;
      $check_acc_section_ok[$count_no-1] = "NO" ;  
  }
  if($shs_logic) {
  echo "<input type=\"button\" onClick=\"print_acc_section_open(".$arr['stock_head_section']['shs_id'].")\" value=\"...\">" ;
  } else {
  echo "<input type=\"button\" onClick=\"#\" value=\".N.\">" ;	  
  }
?> 
  <input type="hidden" name="shc_id" id="shc_id" value="<?php echo $arr['stock_head_center']['shc_id'];?>" ></span></p>
  </td>  
</tr>
 <?php 
 $count_no ++ ;
 }
 ?>
</form>
<tr><td width="100%" height="10" colspan="5"></td></tr>
<?php if(!($arr['stock_requistion_center']['src_requistion_logic']=='2' or $arr['stock_requistion_center']['src_requistion_logic']=='3') and !in_array("NO",$check_acc_center_ok) and !in_array("NO",$check_acc_section_ok)) {
        echo "<tr><td width=\"100%\" height=\"45\" colspan=\"5\" align=\"center\"><input type=\"button\" onclick=\"window.location.href='?compu=wsd&loc=material_requistion_print&op=material_acc_all&data=".$arr['stock_requistion_center']['src_number']."'\" value=\"บันทึกลงบัญชีวัสดุเรียบร้อยทั้งหมด\"></td></tr>" ;
        }
?>
<tr><td width="100%" height="30" colspan="5"></td></tr>
</table>
<?php
} else	if(!$ProcessOutput AND $op == "material_acc_all" AND $data != "") {
	            $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	
			    $src_requistion_logic = 2 ;
				$db->update_db(TB_STOCK_REQUISTION_CENTER,array(
				"src_requistion_logic"=>"".$src_requistion_logic.""
				)," src_number='".$data."'");

echo "<script type='text/javascript'>window.location.href = \"index.php?compu=wsd&loc=material_requistion_print\";</script>" ;				
	
} else	if(!$ProcessOutput AND $op == "") {
	                $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					$res['stock_requistion_center'] = $db->select_query("SELECT * ,UNIX_TIMESTAMP(src_date) AS srcdate FROM ".TB_STOCK_REQUISTION_CENTER." ORDER BY src_number");
?>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes' bgcolor='#eeeeee'>
  <td width=8%  valign=top style='width:59.4pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
 ใบเบิกที่</span></p>
  </td>
  <td width=11% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  วัน เดือน ปี</span></p>
  </td>
  <td width=21%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ประเภทวัสดุ</span></p>
  </td>
  <td width=23%  valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ส่วนงาน/กอง</span></p>
  </td>
  <td width=17% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ผู้เบิก</span></p>
  </td>
<!-- 
  <td width=17% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  ผู้อนุมัติ</span></p>
  </td>
-->  
  <td width=20% valign=top style='border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  เลือก</span></p>
  </td>
</tr>
 <?php
                       $count_no = 1 ;
                       while($arr['stock_requistion_center'] = $db->fetch($res['stock_requistion_center'])){
					   $res['stock_type'] = $db->select_query("SELECT type_name FROM ".TB_STOCK_TYPE." WHERE type_id='".$arr['stock_requistion_center']['type_id']."'");
					   $arr['stock_type'] = $db->fetch($res['stock_type']);
					   $res['member_section'] = $db->select_query("SELECT section_name FROM ".TB_MEMBER_SECTION." WHERE section_id='".$arr['stock_requistion_center']['section_id']."'");
					   $arr['member_section'] = $db->fetch($res['member_section']);
					   $res['member'] = $db->select_query("SELECT prefix ,fname ,lname FROM ".TB_MEMBER." WHERE member_id='".$arr['stock_requistion_center']['member_id']."'");
					   $arr['member'] = $db->fetch($res['member']);
					   //$res['boss'] = $db->select_query("SELECT prefix ,fname ,lname FROM ".TB_MEMBER." WHERE member_id='".$arr['stock_requistion_center']['boss_id']."'");
					   //$arr['boss'] = $db->fetch($res['boss']);
					   $res['requistion'] = $db->select_query("SELECT COUNT(sc_id) AS number FROM ".TB_STOCK_CENTER." WHERE sc_logic='1' AND src_number='".$arr['stock_requistion_center']['src_number']."'");
					   $arr['requistion'] = $db->fetch($res['requistion']);
 ?>
 <tr style='mso-yfti-irow:2;height:17.35pt'>
  <td valign=top style='border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo "<b>".$arr['stock_requistion_center']['src_number']."</b> /<b>25".WEB_BUDGET."</b>" ; ?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo ThaiTimeConvert($arr['stock_requistion_center']['srcdate'],"","") ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['stock_type']['type_name']." (<b>".$arr['requistion']['number']."</b>)" ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['member_section']['section_name'] ;?></span></p>
  </td>
  <td valign=top style='border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php echo $arr['member']['prefix'].$arr['member']['fname']." ".$arr['member']['lname'] ;?></span></p>
  </td>
<!--  
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <?php //echo $arr['boss']['prefix'].$arr['boss']['fname']." ".$arr['boss']['lname'] ;?></span></p>
  </td>
-->  
<?php
if($arr['stock_requistion_center']['src_requistion_logic']=='0'){
?>  
  <td valign=top  style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <form name="frm_report" id="frm_report" method="post" action="?compu=wsd&loc=requistion_center_print&data=<?php echo $arr['stock_requistion_center']['src_number'];?>"  enctype="multipart/form-data">
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <input type="submit" name="submit" id="submit" value=" พิมพ์ใบเบิก "></span></p>
  </form>
  </td>
<?php
} else if($arr['stock_requistion_center']['src_requistion_logic']=='1'){
?>  
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <form name="frm_report" id="frm_report" method="post" action="?compu=wsd&loc=material_requistion_print&op=material_acc_report&data=<?php echo $arr['stock_requistion_center']['src_number'];?>"  enctype="multipart/form-data">
  <p class=MsoNormal align=center style='text-align:center'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <input type="submit" name="submit" id="submit" value="ลงบัญชีวัสดุ">&nbsp;<input type="button" name="submit1" id="submit1" onClick="window.location='?compu=wsd&loc=requistion_center_print&data=<?php echo $arr['stock_requistion_center']['src_number'];?>';" value="พิมพ์"></span></p>
  </form>  
  </td> 
<?php
} else if($arr['stock_requistion_center']['src_requistion_logic']=='2' or $arr['stock_requistion_center']['src_requistion_logic']=='3'){
?>
<form name="frm_<?php echo $count_no ;?>" id="frm_<?php echo $count_no ;?>">
  <td valign=top style='border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:17.35pt'>
  <p class=MsoNormal align=left style='text-align:left'><span lang=TH style='font-size:14.0pt;font-family:"TH SarabunPSK"'>
  <input type="button" name="button" id="button" onclick="window.location.href='?compu=wsd&loc=requistion_center_print&data=<?php echo $arr['stock_requistion_center']['src_number'];?>'" value="ใบเบิก">&nbsp;
  <input type="button" name="button" id="button" onclick="window.location.href='?compu=wsd&loc=material_requistion_print&op=material_acc_report&data=<?php echo $arr['stock_requistion_center']['src_number'];?>'" value="บัญชีเบิก">&nbsp;
<?php if($arr['stock_requistion_center']['src_requistion_logic']=='3') { ?>
  <input type="button" name="button" id="button" onclick="#" value="ฎีกา OK.">
<?php  } else { ?>
  <input type="button" name="button" id="button" onclick="window.location.href='?compu=wsd&loc=material_acc_deega&data=<?php echo $arr['stock_requistion_center']['src_number'];?>'" value="เลขฎีกา">	  
<?php  } ?>
  </span></p>
  </td> 
</form>  
<?php
}
?>  
</tr>
 <?php 
 $count_no ++ ;
 }
 ?>
<tr><td width="100%" height="30" colspan="7"></td></tr>
</table>
<?php
$db->closedb ();
} else if($ProcessOutput) {
	echo $ProcessOutput ;
}	
?>  
					</TD>
				</TR>
			</TABLE>
		</TD>
	  </TR>
</TABLE>