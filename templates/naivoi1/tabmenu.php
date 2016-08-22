<table align="center" cellspacing="0" cellpadding="0" width="990" border="0">
<tr>
<td width="990" colspan="3" valign="top">
<?php if($folder=="" or $folder=="home") { ?>
<div id="header" height="40">
<ul>
  <li id="<?php if($op == ""){ echo "current" ; } ?>"><a href="index.php">ล็อกอินผู้ใช้</a></li>
  <li id="<?php if($op == "vision"){ echo "current" ; } ?>"><a href="index.php?compu=home&loc=page&op=vision">นโยบายเว็บ</a></li>
  <li id="<?php if($op == "training"){ echo "current" ; } ?>"><a href="index.php?compu=home&loc=page&op=training">วีดีโอสาธิตใช้งาน</a></li>
</ul>
</div>
<?php } else if($folder=="car" ) { ?>
<div id="header" height="40">
<ul>
  <li id="<?php if($file == "" or $file == "edit_car"){ echo "current" ; } ?>"><a href="index.php?compu=car">บันทึกขอใช้รถ</a></li>
  <li id="<?php if($file == "list_printcar"){ echo "current" ; } ?>"><a href="index.php?compu=car&loc=list_printcar">พิมพ์ใบอนุญาตขอใช้รถ</a></li>
  <li id="<?php if($file == "listcar"){ echo "current" ; } ?>"><a href="index.php?compu=car&loc=listcar">รายการขอใช้รถ</a></li>
  <li id="<?php if($file == "listcar_all"){ echo "current" ; } ?>"><a href="index.php?compu=car&loc=listcar_all">รายการขอใช้รถทุกคน</a></li>
</ul>
</div>
<?php } else if($folder=="wsd" and $admin_level=="") { ?>
<div id="header" height="40">
<ul>
  <li id="<?php if($file == "" or $file == "index" or $op == "requist_form"){ echo "current" ; } ?>"><a href="index.php?compu=wsd">เบิกวัสดุ</a></li>
  <li id="<?php if($file == "print_requistion"){ echo "current" ; } ?>"><a href="index.php?compu=wsd&loc=print_requistion">รายการเบิกวัสดุ</a></li>
  <li id="<?php if($file == "want_material"){ echo "current" ; } ?>"><a href="index.php?compu=wsd&loc=want_material">ต้องการใช้วัสดุ</a></li>
</ul>
</div>
<?php } else if($folder=="kuru" ) { ?>
<div id="header" height="40">
<ul>
  <li id="<?php if($file == ""){ echo "current" ; } ?>"><a href="index.php?compu=kuru">กำหนดรหัสครุภัณฑ์</a></li>
  <li id="<?php if($file == "office_kuru"){ echo "current" ; } ?>"><a href="index.php?compu=kuru&loc=office_kuru">ครุภัณฑ์สำนักงาน</a></li>
  <li id="<?php if($file == "building_kuru"){ echo "current" ; } ?>"><a href="index.php?compu=kuru&loc=building_kuru">ที่ดินและสิ่งก่อสร้าง</a></li>
  <li id="<?php if($file == "print_send_kuru"){ echo "current" ; } ?>"><a href="index.php?compu=kuru&loc=print_send_kuru">รายงานและพิมพ์ส่ง สตง.</a></li>
</ul>
</div>
<?php } else if($folder=="member" ) {?>
<div id="header" height="40">
<ul>
  <li id="<?php if($file == ""){ echo "current" ; } ?>"><a href="index.php?compu=member">ฝ่ายบริหาร</a></li>
  <li id="<?php if($op == "2"){ echo "current" ; } ?>"><a href="index.php?compu=member&loc=member&op=2">ฝ่ายสมาชิกสภา</a></li>
  <li id="<?php if($op == "4"){ echo "current" ; } ?>"><a href="index.php?compu=member&loc=member&op=4">ฝ่ายพนักงานข้าราชการและลูกจ้าง</a></li>
  <li id="<?php if($op == "5"){ echo "current" ; } ?>"><a href="index.php?compu=member&loc=member&op=5">ฝ่ายกำนันผู้ใหญ่บ้าน</a></li>
  <li id="<?php if($op == "6"){ echo "current" ; } ?>"><a href="index.php?compu=member&loc=member&op=6">ฝ่ายสถานศึกษา</a></li>  
  <li id="<?php if($op == "7"){ echo "current" ; } ?>"><a href="index.php?compu=member&loc=member&op=7">ฝ่ายสถานพยาบาล</a></li>  
</ul>
</div>
<?php } else if($folder=="admin" and $file=="main" or $file=="") {?>
<div id="header" height="40">
<ul>
  <li id="current"><a href="#">หน้าผู้ดูแลระบบ</a></li>
</ul>
</div>
<?php } else if($folder=="admin" and $file=="member_add") {?>
<div id="header" height="40">
<ul>
  <li id="current"><a href="index.php?compu=admin&loc=member_add">เพิ่มชื่อบุคลากร</a></li>
</ul>
</div>
<?php } else if($folder=="wsd" and  $file!="main" and $admin_level=="4") {?>
<div id="header" height="40">
<ul>
  <li id="<?php if($file == "material_addstart"){ echo "current" ; } ?>"><a href="index.php?compu=wsd&loc=material_addstart">บันทึกบัญชีวัสดุ</font></a></li>
  <li id="<?php if($file == "material_requistion_section"){ echo "current" ; } ?>"><a href="index.php?compu=wsd&loc=material_requistion_section">เบิกจ่ายวัสดุ</font></a></li>
  <li id="<?php if($file == "material_requistion_section_print" or $file == "requistion_section_print"){ echo "current" ; } ?>"><a href="index.php?compu=wsd&loc=material_requistion_section_print">พิมพ์ใบเบิกวัสดุ</font></a></li>
  <li id="<?php if($file == "material_acc_section_print" or $file == "acc_section_print_view"){ echo "current" ; } ?>"><a href="index.php?compu=wsd&loc=material_acc_section_print">บัญชีวัสดุ</font></a></li>
  <li id="<?php if($file == "check_material_section"){ echo "current" ; } ?>"><a href="index.php?compu=wsd&loc=check_material_section">เช็ควัสดุเหลือ</font></a></li>
  <li id="<?php if($file == "want_material_section"){ echo "current" ; } ?>"><a href="index.php?compu=home&loc=notview">สั่งซื้อวัสดุ</a></li>
</ul>
</div>
<?php } else if($folder=="wsd" and $admin_level=="3"){  ?>
<div id="header" height="40">
<ul>
  <li id="<?php if($file == "material_central"){ echo "current" ; } ?>"><a href="index.php?compu=wsd&loc=material_central">บันทึกบัญชีวัสดุ<font color="#FF0000"><?php echo "  ส่วนกลาง" ;?></font></a></li>
  <li id="<?php if($file == "material_requistion"){ echo "current" ; } ?>"><a href="index.php?compu=wsd&loc=material_requistion">เบิกจ่ายวัสดุ<font color="#0000FF"><?php echo "  ส่วนกลาง" ;?></font></a></li>
  <li id="<?php if($file == "material_requistion_print" or $file == "requistion_center_print"){ echo "current" ; } ?>"><a href="?compu=wsd&loc=material_requistion_print">ใบเบิก-ลงบัญชีวัสดุ<font color="#FF00FF"><?php echo "  ส่วนกลาง" ;?></font></a></li>
  <li id="<?php if($file == "material_acc_center_print"){ echo "current" ; } ?>"><a href="index.php?compu=wsd&loc=material_acc_center_print">บัญชีวัสดุ<font color="#00FFFF"><?php echo "  ส่วนกลาง" ;?></font></a></li>
  <li id="<?php if($file == "balance_section"){ echo "current" ; } ?>"><a href="index.php?compu=wsd&loc=balance_section">ตัดยอดยกมา ส่วนกอง</font></a></li>
<!--  <li id="<?php //if($file == "present_section"){ echo "current" ; } ?>"><a href="index.php?compu=wsd&loc=present_section">ตัดยอด ณ ปัจจุบัน ส่วนกอง</font></a></li> -->
</ul>
</div>
<?php
}
?>
</td>
</tr>
<tr>
<td background="images/main/r.gif" border="0" height="100%" width="7"></td>
<td width="976" align="center" valign="top">
<?php if($folder == "" and $file == "") { ?>
			    <table cellspacing="0" cellpadding="0" width="100%"  border="0">
			    <tr valign="top">
			    <td width="100%" align="center" id="leftcol">
			    <?php include ("modules/home/loginuser.php"); ?>
				</td>
				</tr>
			    </table><br>
<?php } else { ?>
			    <table cellspacing="0" cellpadding="0" width="100%" border="0">
			    <tr valign="top">
			    <td width="100%" id="leftcol">
			    <?php echo $content ; ?>
				</td>
				</tr>
			    </table>
<?php } ?>	
</td>
<td background="images/main/l.gif" border="0" height="100%" width="7"></td>
</tr>
<tr>
<td background="images/main/b.gif" border="0" height="7" width="990" colspan="3"></td>
</tr>		  
</table>

<!--
<table width="100%" border="0" align="center" cellPadding="0" cellSpacing="0" >
	<tr height="10">
		<td align="center">
        <center>
          <?php //if($folder=="") { 				
            //if (CountBlock('home')) { ?>
			    <table cellspacing="0" cellpadding="0" width="100%" >
			    <tr valign="top">
			    <td width="100%"  id="leftcol">
			    <?php//LoadBlock('home'); ?>
				</td>
				</tr>
			    </table><br>
          <?// } } ?>
		</td>
	</tr>	
</table>
-->