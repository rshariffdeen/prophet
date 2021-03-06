--TEST--
Phar: copy-on-write test 6 [cache_list]
--INI--
default_charset=UTF-8
phar.cache_list={PWD}/copyonwrite6.phar.php
phar.readonly=0
open_basedir=
--SKIPIF--
<?php if (!extension_loaded("phar")) die("skip"); ?>
<?php if (version_compare(PHP_VERSION, "5.3", "<")) die("skip PHP 5.3+ required"); ?>
--FILE_EXTERNAL--
files/write6.phar
--CLEAN--
<?php
unlink(dirname(__FILE__) . '/copyonwrite6/file1');
unlink(dirname(__FILE__) . '/copyonwrite6/file2');
rmdir(dirname(__FILE__) . '/copyonwrite6');
?>
--EXPECTF--
array(2) {
  ["file1"]=>
  string(%d) "%sfile1"
  ["file2"]=>
  string(%d) "%sfile2"
}
phar://%s.php%cfile1 file1
phar://%s.php%cfile2 file2
phar://%s.php%chi hi
ok
