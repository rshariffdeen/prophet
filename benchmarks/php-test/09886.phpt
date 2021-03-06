--TEST--
Phar: phar.cache_list basic read test
--SKIPIF--
<?php
if (!extension_loaded("phar")) die("skip");
if (version_compare(PHP_VERSION, "6.0", "<")) die("skip Unicode support required");
?>
--INI--
phar.cache_list={PWD}/files/nophar.phar
--FILE--
<?php
$pname = 'phar://' . dirname(__FILE__) . '/files/nophar.phar';
var_dump(file_get_contents($pname . '/b/c.php'));
$a = opendir($pname);
while (false !== ($b = readdir($a))) {
var_dump($b);
}
foreach (new RecursiveIteratorIterator(new Phar($pname)) as $f) {
	var_dump($f->getPathName());
}
var_dump(is_dir($pname . '/b'));
var_dump(is_dir($pname . '/d'));
var_dump(is_dir($pname . '/b/c.php'));
?>
===DONE===
--EXPECTF--
string(131) "<?php echo "in b\n";$a = fopen("index.php", "r", true);echo stream_get_contents($a);fclose($a);include dirname(__FILE__) . "/../d";"
unicode(1) "b"
unicode(1) "d"
unicode(9) "index.php"
unicode(7) "web.php"
string(%d) "phar://%s.php"
string(%d) "phar://%snophar.phar%cd"
string(%d) "phar://%s.php"
string(%d) "phar://%s.php"
bool(true)
bool(false)
bool(false)
===DONE===
