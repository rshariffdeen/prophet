--TEST--
Bug #41633.2 (Undefined class constants must not be substituted by strings)
--FILE--
<?php
class Foo {
	const A = self::B;
}
echo Foo::A."\n";
?>
--EXPECTF--
Fatal error: Undefined class constant 'self::B' in %s.php on line 5
