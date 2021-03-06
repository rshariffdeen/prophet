--TEST--
Phar: copy-on-write test 5 [cache_list]
--INI--
default_charset=UTF-8
phar.cache_list={PWD}/copyonwrite5.phar.php
phar.readonly=0
--SKIPIF--
<?php if (!extension_loaded("phar")) die("skip"); ?>
--FILE_EXTERNAL--
files/write5.phar
--CLEAN--
<?php
unlink(dirname(__FILE__) . '/copyonwrite5/file1');
unlink(dirname(__FILE__) . '/copyonwrite5/file2');
rmdir(dirname(__FILE__) . '/copyonwrite5');
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