--TEST--
Phar: rename_dir test
--SKIPIF--
<?php if (!extension_loaded("phar")) die("skip"); ?>
--INI--
phar.readonly=0
phar.require_hash=0
--FILE--
<?php

$fname = dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.phar.php';
$pname = 'phar://' . $fname;
$file = "<?php
Phar::mapPhar('hio');
__HALT_COMPILER(); ?>";

$files = array();
$files['a/x'] = 'a';
include 'files/phar_test.inc';
include $fname;

echo file_get_contents($pname . '/a/x') . "\n";
rename($pname . '/a', $pname . '/b');
echo file_get_contents($pname . '/b/x') . "\n";
echo file_get_contents($pname . '/a/x') . "\n";
?>
--CLEAN--
<?php unlink(dirname(__FILE__) . '/' . basename(__FILE__, '.clean.php') . '.phar.php'); ?>
--EXPECTF--
a
a

Warning: file_get_contents(phar://%s.php/a/x): failed to open stream: phar error: "a/x" is not a file in phar "%s.php" in %s.php on line %d
