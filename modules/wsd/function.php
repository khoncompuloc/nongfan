<?php
function checkProductCode($code_id){
	if($code_id==""){
		$code="วัสดุ-00001";
	}else{
		$explode=explode("-",$code_id);
		$plus = $explode[1]+1;
		$lenght=strlen($plus);
		
		if($lenght=="1"){
			$code="วัสดุ-0000".$plus;
		}else if($lenght=="2"){
			$code="วัสดุ-000".$plus;
		}else if($lenght=="3"){
			$code="วัสดุ-00".$plus;
		}else if($lenght=="4"){
			$code="วัสดุ-0".$plus;
		}else {
			$code="วัสดุ-".$plus;
		}
	}
	
	return  $code;
}
?>