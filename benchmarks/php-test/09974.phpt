--TEST--
Phar: include_path with phar:// wrapper
--SKIPIF--
<?php if (!extension_loaded("phar")) die("skip"); ?>
--INI--
phar.readonly=0
--FILE--
<?php
$fname = dirname(__FILE__) . '/tempmanifest1.phar.php';
$a = new Phar($fname);
$a['file1.php'] = 'file1.php
';
$a['test/file1.php'] = 'test/file1.php
';
unset($a);
set_include_path('.' . PATH_SEPARATOR . 'phar://' . $fname);
include 'file1.php';
set_include_path('.' . PATH_SEPARATOR . 'phar://' . $fname . '/test');
include 'file1.php';
include 'file2.php';
?>
===DONE===
--CLEAN--
<?php
@unlink(dirname(__FILE__) . '/tempmanifest1.phar.php');
?>
--EXPECTF--
file1.php
test/file1.php

Warning: include(file2.php): failed to open stream: No such file or directory in %s.php on line %d

Warning: include(): Failed opening 'file2.php' for inclusion (include_path='%s.php/test') in %s.php on line %d
===DONE===