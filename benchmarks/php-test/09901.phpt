--TEST--
Phar: copy()
--SKIPIF--
<?php if (!extension_loaded("phar")) die("skip"); ?>
<?php if (!extension_loaded("spl")) die("skip SPL not available"); ?>
<?php if (!extension_loaded("zlib")) die("skip zlib not available"); ?>
--INI--
phar.readonly=0
phar.require_hash=1
--FILE--
<?php

$fname = dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.phar.php';
$fname2 = dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '2.phar.php';

$pname = 'phar://'.$fname;
$iname = '/file.txt';
$ename = '/error/..';

$p = new Phar($fname);

try
{
	$p['a'] = 'hi';
	$p->startBuffering();
	$p->copy('a', 'b');
	echo file_get_contents($p['b']->getPathName());
	$p['a']->compress(Phar::GZ);
	$p['b']->setMetadata('a');
	$p->copy('b', 'c');
	$p->stopBuffering();
	echo file_get_contents($p['c']->getPathName());
	copy($fname, $fname2);
	$p->copy('a', $ename);
}
catch(Exception $e)
{
	echo $e->getMessage() . "\n";
}
ini_set('phar.readonly',1);
$p2 = new Phar($fname2);
echo "\n";
echo 'a: ' , file_get_contents($p2['a']->getPathName());
echo 'b: ' ,file_get_contents($p2['b']->getPathName());
echo 'c: ' ,file_get_contents($p2['c']->getPathName()), $p2['c']->getMetaData(), "\n";
ini_set('phar.readonly', 0);
try {
$p2->copy('notexisting', 'another');
} catch (Exception $e) {
echo $e->getMessage() . "\n";
}
try {
$p2->copy('a', 'b');
} catch (Exception $e) {
echo $e->getMessage() . "\n";
}
$p2['a']->compress(Phar::GZ);
$p2->copy('a', 'd');
echo $p2['d']->getContent() . "\n";
try {
$p2->copy('d', '.phar/stub.php');
} catch (Exception $e) {
echo $e->getMessage(),"\n";
}
try {
$p2->copy('.phar/stub.php', 'd');
} catch (Exception $e) {
echo $e->getMessage(),"\n";
}
?>
===DONE===
--CLEAN--
<?php unlink(dirname(__FILE__) . '/' . basename(__FILE__, '.clean.php') . '.phar.php'); ?>
<?php unlink(dirname(__FILE__) . '/' . basename(__FILE__, '.clean.php') . '2.phar.php'); ?>
--EXPECTF--
hihifile "/error/.." contains invalid characters upper directory reference, cannot be copied from "a" in phar %s

a: hib: hic: hia
file "notexisting" cannot be copied to file "another", file does not exist in %s.php
file "a" cannot be copied to file "b", file must not already exist in phar %s.php
hi
file "d" cannot be copied to file ".phar/stub.php", cannot copy to Phar meta-file in %s.php
file ".phar/stub.php" cannot be copied to file "d", cannot copy Phar meta-file in %s.php
===DONE===