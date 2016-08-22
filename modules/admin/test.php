<?php
	                $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					$ress = $db->select_query("SELECT * FROM ".TB_STOCK_REQUISTION_CENTER." WHERE src_number=1 ");
					$arrs = $db->fetch($ress);
					if($arrs['src_id']) {
						//$res['stock_requistion_center'] = $db->select_query("SELECT MAX(src_number) AS max_number FROM ".TB_STOCK_REQUISTION_CENTER."");
						//$arr['stock_requistion_center'] = $db->fetch($res['stock_requistion_center']) ;
						//$number_no = $arr['stock_requistion_center']['max_number'] + 1 ;
						echo "123" ;
						$number_no = 3 ;
					} else {
						$number_no = 1 ;						
					}
					echo "test =".$arrs['src_id']."  =".TB_STOCK_REQUISTION_CENTER." ".$number_no."<br>" ;
					echo "วันที่ =".$arrs['src_date']."<br>" ;
?>