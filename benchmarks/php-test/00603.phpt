--TEST--
Bug #27468 (foreach in __destruct() causes segfault)
--FILE--
<?php
class foo {
	function __destruct() {
		foreach ($this->x as $x);
	}
}
new foo();
echo 'OK';
?>
--EXPECTF--
Notice: Undefined property: foo::$x in %s.php on line 4

Warning: Invalid argument supplied for foreach() in %s.php on line 4
OK
