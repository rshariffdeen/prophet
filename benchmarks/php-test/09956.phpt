--TEST--
Phar: fopen/stat/fseek/unlink/rename edge cases
--SKIPIF--
<?php if (!extension_loaded("phar")) die("skip"); ?>
--INI--
phar.readonly=0
phar.require_hash=0
--FILE--
<?php
$fname = dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.phar.php';
$fname2 = dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.2.phar.php';
$fname3 = dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.3.phar.php';
$pname = 'phar://' . $fname;
$pname2 = 'phar://' . $fname2;
$pname3 = 'phar://' . $fname3;

// create in cwd
chdir(dirname(__FILE__));
file_put_contents('phar://fopen_edgetest.phar/hi', 'hi');
// append
$a = fopen($pname . '/b/c.php', 'a');
// invalid pharname
$a = fopen($pname . '.phar.gz', 'r');
// test phar_open_url() with quiet stat for code coverage
var_dump(file_exists($pname . '.phar.gz/hi'));
// test open for write with new phar
$a = fopen($pname . '/hi', 'w');
fclose($a);
// test open for write with corrupted phar
file_put_contents($fname2, '<?php oh crap __HALT_COMPILER();');
$a = fopen($pname2 . '/hi', 'w');
$a = fopen('phar://', 'r');
$a = fopen('phar://foo.phar', 'r');

file_put_contents($pname . '/hi', 'hi');
$a = fopen($pname . '/hi', 'r');
var_dump(fseek($a, 1), ftell($a));
var_dump(fseek($a, 1, SEEK_CUR), ftell($a));
fclose($a);

var_dump(stat('phar://'));
var_dump(stat('phar://foo.phar'));
var_dump(is_dir($pname));

// this tests coverage of the case where the phar exists and has no files
$phar = new Phar($fname3);
var_dump(file_exists($pname3 . '/test'));

unlink($pname2 . '/hi');
unlink('phar://');
unlink('phar://foo.phar');
unlink($pname . '/oops');

rename('phar://', 'phar://');
rename($pname . '/hi', 'phar://');
rename('phar://foo.phar/hi', 'phar://');
rename($pname . '/hi', 'phar://foo.phar/hi');

ini_set('phar.readonly', 1);
rename($pname . '/hi', $pname . '/there');
ini_set('phar.readonly', 0);
Phar::unlinkArchive($fname);
file_put_contents($pname . '/test.php', '<?php
$a = fopen("./notfound.php", "r");
?>');
include $pname . '/test.php';
?>

===DONE===
--CLEAN--
<?php unlink(dirname(__FILE__) . '/' . basename(__FILE__, '.clean.php') . '.phar.php'); ?>
<?php unlink(dirname(__FILE__) . '/' . basename(__FILE__, '.clean.php') . '.2.phar.php'); ?>
<?php unlink(dirname(__FILE__) . '/fopen_edgetest.phar');
--EXPECTF--
Warning: fopen(phar://%s.php): failed to open stream: phar error: open mode append not supported in %s.php on line %d

Warning: fopen(phar://%s.php.phar.gz): failed to open stream: phar error: invalid url or non-existent phar "phar://%s.php.phar.gz" in %s.php on line %d
bool(false)

Warning: fopen(phar://%s.php/hi): failed to open stream: internal corruption of phar "%s.php" (truncated manifest at stub end) in %s.php on line %d

Warning: fopen(phar://): failed to open stream: phar error: no directory in "phar://", must have at least phar:/// for root directory (always use full path to a new phar) in %s.php on line %d

Warning: fopen(phar://foo.phar): failed to open stream: %s in %s.php on line %d
int(0)
int(1)
int(0)
int(2)

Warning: stat(): stat failed for phar:// in %s.php on line %d
bool(false)

Warning: stat(): stat failed for phar://foo.phar in %s.php on line %d
bool(false)
bool(true)
bool(false)

Warning: unlink(): internal corruption of phar "%s.php" (truncated manifest at stub end) in %s.php on line %d

Warning: unlink(): phar error: unlink failed in %s.php on line %d

Warning: unlink(): phar error: no directory in "phar://", must have at least phar:/// for root directory (always use full path to a new phar) in %s.php on line %d

Warning: unlink(): phar error: unlink failed in %s.php on line %d

Warning: unlink(): phar error: invalid url or non-existent phar "phar://foo.phar" in %s.php on line %d

Warning: unlink(): phar error: unlink failed in %s.php on line %d

Warning: unlink(): unlink of "phar://%s.php/oops" failed, file does not exist in %s.php on line %d

Warning: rename(): phar error: cannot rename "phar://" to "phar://": invalid or non-writable url "phar://" in %s.php on line %d

Warning: rename(): phar error: cannot rename "phar://%s.php/hi" to "phar://": invalid or non-writable url "phar://" in %s.php on line %d

Warning: rename(): phar error: cannot rename "phar://foo.phar/hi" to "phar://": invalid or non-writable url "phar://" in %s.php on line %d

Warning: rename(): phar error: cannot rename "phar://%s.php/hi" to "phar://foo.phar/hi", not within the same phar archive in %s.php on line %d

Warning: rename(): phar error: cannot rename "phar://%s.php/hi" to "phar://%s.php/there": invalid or non-writable url "phar://%s.php/hi" in %s.php on line %d

Warning: fopen(./notfound.php): failed to open stream: No such file or directory in phar://%s.php on line %d

===DONE===