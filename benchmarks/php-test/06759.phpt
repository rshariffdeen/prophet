--TEST--
Test rename() function: usage variations-6
--SKIPIF--
<?php
if (substr(PHP_OS, 0, 3) != 'WIN') die('skip..  for Windows');
if (!function_exists("symlink")) die("skip symlinks are not supported");
$ret = exec('mklink rename_variation13tmp.lnk ' . __FILE__ .' 2>&1', $out);
if (strpos($ret, 'privilege')) {
	die('skip. SeCreateSymbolicLinkPrivilege not enable for this user.');
}
?>
--FILE--
<?php

$tmp_file = __FILE__.".tmp";
$tmp_link = __FILE__.".tmp.link";
$tmp_link2 = __FILE__.".tmp.link2";

touch($tmp_file);
symlink($tmp_file, $tmp_link);
rename($tmp_link, $tmp_link2);

clearstatcache();

var_dump(readlink($tmp_link));
var_dump(readlink($tmp_link2));
var_dump(file_exists($tmp_file));

@unlink($tmp_link);
@unlink($tmp_link2);
@unlink($tmp_file);

echo "Done\n";
?>
--EXPECTF--	
Warning: readlink(): Could not open file (error 2) in %s on line %d
bool(false)
string(%d) "%s.php.tmp"
bool(true)
Done
