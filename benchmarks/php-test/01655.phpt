--TEST--
__HALT_COMPILER() basic test
--FILE--
<?php

if (true) {
	__HALT_COMPILER();
}
--EXPECTF--
Fatal error: __HALT_COMPILER() can only be used from the outermost scope in %s.php on line %d
