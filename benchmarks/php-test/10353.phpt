--TEST--
Phar front controller $_SERVER munging failure [cache_list]
--INI--
phar.cache_list={PWD}/frontcontroller18.php
--SKIPIF--
<?php if (!extension_loaded("phar")) die("skip"); ?>
--ENV--
SCRIPT_NAME=/frontcontroller18.php
REQUEST_URI=/frontcontroller18.php/fronk.gronk
PATH_INFO=/fronk.gronk
--FILE_EXTERNAL--
files/frontcontroller9.phar
--EXPECTF--
Fatal error: Uncaught exception 'PharException' with message 'No values passed to Phar::mungServer(), expecting an array of any of these strings: PHP_SELF, REQUEST_URI, SCRIPT_FILENAME, SCRIPT_NAME' in %s.php:2
Stack trace:
#0 %s.php(2): Phar::mungServer(Array)
#1 {main}
  thrown in %s.php on line 2
