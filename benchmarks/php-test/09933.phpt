--TEST--
Phar: mkdir/rmdir test
--SKIPIF--
<?php if (!extension_loaded("phar")) die("skip"); ?>
--INI--
phar.readonly=0
phar.require_hash=0
--FILE--
<?php
$fname = dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.phar.php';
$pname = 'phar://' . $fname;
$fname2 = dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.1.phar.php';
$pname2 = 'phar://' . $fname2;
$fname3 = dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.2.phar.php';
$pname3 = 'phar://' . $fname3;
$phar = new Phar($fname);
var_dump($phar->isFileFormat(Phar::PHAR));

$phar->addEmptyDir('test');
var_dump($phar['test']->isDir());
var_dump($phar['test/']->isDir());
copy($fname, $fname2);
mkdir($pname . '/another/dir/');
var_dump($phar['another/dir']->isDir());
rmdir($pname . '/another/dir/');
copy($fname, $fname3);
clearstatcache();
var_dump(file_exists($pname . '/another/dir/'));
var_dump(file_exists($pname2 . '/test/'));
var_dump(file_exists($pname3 . '/another/dir/'));
ini_set('phar.readonly', 1);
mkdir($pname . '/fails');
ini_set('phar.readonly', 0);
// create new phar by mkdir
mkdir('phar://' . dirname(__FILE__) . '/ok.phar/fails');
mkdir('phar://' . dirname(__FILE__) . '/ok.phar/fails');
file_put_contents('phar://' . dirname(__FILE__) . '/ok.phar/sub/directory.txt', 'hi');
mkdir('phar://' . dirname(__FILE__) . '/ok.phar/sub');
mkdir('phar://' . dirname(__FILE__) . '/ok.phar/sub/directory.txt');
file_put_contents(dirname(__FILE__) . '/oops.phar', '<?php this should screw em up __HALT_COMPILER();');
mkdir('phar://' . dirname(__FILE__) . '/oops.phar/fails');

mkdir('phar://');
rmdir('phar://');
rmdir('phar://' . dirname(__FILE__) . '/unknown.phar/hi');
ini_set('phar.readonly', 1);
rmdir($pname . '/another/dir');
ini_set('phar.readonly', 0);
rmdir($pname);
rmdir($pname . '/');
mkdir($pname . '/');
?>
===DONE===
--CLEAN--
<?php unlink(dirname(__FILE__) . '/' . basename(__FILE__, '.clean.php') . '.phar.php'); ?>
<?php unlink(dirname(__FILE__) . '/ok.phar'); ?>
<?php unlink(dirname(__FILE__) . '/oops.phar'); ?>
<?php unlink(dirname(__FILE__) . '/' . basename(__FILE__, '.clean.php') . '.1.phar.php'); ?>
<?php unlink(dirname(__FILE__) . '/' . basename(__FILE__, '.clean.php') . '.2.phar.php'); ?>
--EXPECTF--
bool(true)
bool(true)
bool(true)
bool(true)
bool(false)
bool(true)
bool(false)

Warning: mkdir(): phar error: cannot create directory "phar://%s.php/fails", write operations disabled in %s.php on line %d

Warning: mkdir(): phar error: cannot create directory "fails" in phar "%sok.phar", directory already exists in %s.php on line %d

Warning: mkdir(): phar error: cannot create directory "sub" in phar "%sok.phar", directory already exists in %s.php on line %d

Warning: mkdir(): phar error: cannot create directory "sub/directory.txt" in phar "%sok.phar", phar error: path "sub/directory.txt" exists and is a not a directory in %s.php on line %d

Warning: mkdir(): internal corruption of phar "%soops.phar" (truncated manifest at stub end) in %s.php on line %d

Warning: mkdir(): phar error: cannot create directory "phar://", no phar archive specified in %s.php on line %d

Warning: rmdir(): phar error: cannot remove directory "phar://", no phar archive specified, or phar archive does not exist in %s.php on line %d

Warning: rmdir(): phar error: cannot remove directory "hi" in phar "%sunknown.phar", directory does not exist in %s.php on line %d

Warning: rmdir(): phar error: cannot rmdir directory "phar://%s.php/another/dir", write operations disabled in %s.php on line %d

Warning: rmdir(): phar error: cannot remove directory "" in phar "%s.php", directory does not exist in %s.php on line %d

Warning: rmdir(): phar error: cannot remove directory "" in phar "%s.php", directory does not exist in %s.php on line %d

Warning: mkdir(): phar error: cannot create directory "" in phar "%s.php", phar error: invalid path "" must not be empty in %s.php on line %d
===DONE===