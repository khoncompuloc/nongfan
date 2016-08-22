<?
define('_W_ROOT_', "/");
class cookies {
	
	/**
	* remove($name) ลบคุกกี้ออกตามชื่อคุกกี้
	*/
	static public function remove($name) {
		if (!empty($name)) {
			if ($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "localhost:81") {
				$webaddress = false;
			} else {
				$webaddress = $_SERVER['HTTP_HOST'];
			}
			setcookie($name, "", time()-63113851.9, _W_ROOT_, $webaddress);
			return true;
		} else {
			return false;
		}
	}//remove
	
	/**
	* write($name,$value,$timeout='0') เขียนคุกกี้
	*/
	static public function write($name, $value, $timeout='0') {
		if (!empty($name) && !empty($value)) {
			if ($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "localhost:81") {
				$webaddress = false;
			} else {
				$webaddress = $_SERVER['HTTP_HOST'];
			}
			setcookie($name, $value, $timeout, _W_ROOT_, $webaddress);
			return true;
		} else {
			return false;
		}
	}//write
	
}
// cookies::write("name","value",time()+1111);

// ลบก็ cookies::remove("name");
?>