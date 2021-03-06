--TEST--
Phar: delete a file within a zip-based .phar
--SKIPIF--
<?php if (!extension_loaded("phar")) die("skip"); ?>
--INI--
phar.readonly=0
phar.require_hash=0
--FILE--
<?php

$fname = dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.phar.zip';
$alias = 'phar://' . $fname;

$phar = new Phar($fname);
$phar['a.php'] = '<?php echo "This is a\n"; ?>';
$phar['b.php'] = '<?php echo "This is b\n"; ?>';
$phar['b/c.php'] = '<?php echo "This is b/c\n"; ?>';
$phar->setStub('<?php __HALT_COMPILER(); ?>');
$phar->stopBuffering();
ini_set('phar.readonly', 1);

include $alias . '/a.php';
include $alias . '/b.php';
include $alias . '/b/c.php';
unlink($alias . '/b/c.php');
?>
===AFTER===
<?php
include $alias . '/a.php';
include $alias . '/b.php';
include $alias . '/b/c.php';
?>

===DONE===
--CLEAN--
<?php unlink(dirname(__FILE__) . '/' . basename(__FILE__, '.clean.php') . '.phar.zip'); ?>
--EXPECTF--
This is a
This is b
This is b/c

Warning: unlink(): phar error: write operations disabled by the php.ini setting phar.readonly in %s.php on line %d
===AFTER===
This is a
This is b
This is b/c

===DONE===
