--TEST--
Array type hint
--FILE--
<?php
function foo(array $a) {
	echo count($a)."\n";
}

foo(array(1,2,3));
foo(123);
?>
--EXPECTF--
3

Catchable fatal error: Argument 1 passed to foo() must be of the type array, integer given, called in %s.php on line 7 and defined in %s.php on line 2
