--TEST--
Phar object: getContent()
--SKIPIF--
<?php if (!extension_loaded("phar")) die("skip"); ?>
<?php if (!extension_loaded("spl")) die("skip SPL not available"); ?>
--INI--
phar.readonly=0
--FILE--
<?php
$fname = dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.phar.php';

$phar = new Phar($fname);
$phar['a/b'] = 'file contents
this works';
$phar->addEmptyDir('hi');
echo $phar['a/b']->getContent() . "\n";
try {
echo $phar['a']->getContent(), "\n";
} catch (Exception $e) {
echo $e->getMessage(), "\n";
}
try {
echo $phar['hi']->getContent(), "\n";
} catch (Exception $e) {
echo $e->getMessage(), "\n";
}
?>
===DONE===
--CLEAN--
<?php 
unlink(dirname(__FILE__) . '/' . basename(__FILE__, '.clean.php') . '.phar.php');
__halt_compiler();
?>
--EXPECTF--
file contents
this works
Phar error: Cannot retrieve contents, "a" in phar "%s.php" is a directory
Phar error: Cannot retrieve contents, "hi" in phar "%s.php" is a directory
===DONE===