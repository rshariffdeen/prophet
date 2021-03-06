--TEST--
Phar: test edge cases of intercepted functions when the underlying phar archive has been unlinkArchive()d
--SKIPIF--
<?php if (!extension_loaded("phar")) die("skip");?>
--INI--
phar.readonly=0
--FILE--
<?php
Phar::interceptFileFuncs();
$fname = dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.phar.php';
$fname2 = dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.2.php';
$pname = 'phar://' . $fname;
file_put_contents($fname2, '<?php Phar::unlinkArchive("' . addslashes($fname) . '");');
file_put_contents($pname . '/foo/hi', '<?php
include "' . addslashes($fname2) . '";
readfile("foo/hi");
fopen("foo/hi", "r");
echo file_get_contents("foo/hi");
var_dump(is_file("foo/hi"),is_link("foo/hi"),is_dir("foo/hi"),file_exists("foo/hi"),stat("foo/hi"));
opendir("foo/hi");
?>
');
include $pname . '/foo/hi';
?>
===DONE===
--CLEAN--
<?php unlink(dirname(__FILE__) . '/' . basename(__FILE__, '.clean.php') . '.phar.php'); ?>
<?php unlink(dirname(__FILE__) . '/' . basename(__FILE__, '.clean.php') . '.2.php'); ?>
--EXPECTF--
Warning: readfile(foo/hi): failed to open stream: No such file or directory in phar://%s.php/foo/hi on line %d

Warning: fopen(foo/hi): failed to open stream: No such file or directory in phar://%s.php/foo/hi on line %d

Warning: file_get_contents(foo/hi): failed to open stream: No such file or directory in phar://%s.php/foo/hi on line %d

Warning: stat(): stat failed for foo/hi in phar://%s.php/foo/hi on line %d
bool(false)
bool(false)
bool(false)
bool(false)
bool(false)

Warning: opendir(foo/hi): failed to open dir: No such file or directory in phar://%s.php/foo/hi on line %d
===DONE===