--TEST--
076: Unknown constants in namespace
--FILE--
<?php
namespace foo;

$a = array(unknown => unknown);

echo unknown;
echo "\n";
var_dump($a);
echo \unknown;
--EXPECTF--
Notice: Use of undefined constant unknown - assumed 'unknown' in %s.php on line %d

Notice: Use of undefined constant unknown - assumed 'unknown' in %s.php on line %d

Notice: Use of undefined constant unknown - assumed 'unknown' in %s.php on line %d
unknown
array(1) {
  ["unknown"]=>
  %s(7) "unknown"
}

Fatal error: Undefined constant 'unknown' in %s.php on line %d
