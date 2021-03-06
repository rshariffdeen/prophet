--TEST--
Bug #52361 (Throwing an exception in a destructor causes invalid catching)
--FILE--
<?php
class aaa {
	public function __destruct() {
		try {
			throw new Exception(__CLASS__);
		} catch(Exception $ex) {
			echo "1. $ex\n";
		}
	}
}
function bbb() {
	$a = new aaa();
	throw new Exception(__FUNCTION__);
}
try {
	bbb();
	echo "must be skipped !!!";
} catch(Exception $ex) {
	echo "2. $ex\n";
}
?>
--EXPECTF--
1. exception 'Exception' with message 'aaa' in %s.php:5
Stack trace:
#0 %s.php(16): aaa->__destruct()
#1 %s.php(16): bbb()
#2 {main}
2. exception 'Exception' with message 'bbb' in %s.php:13
Stack trace:
#0 %s.php(16): bbb()
#1 {main}

