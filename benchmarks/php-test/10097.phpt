--TEST--
Phar front controller $_SERVER munging failure 3
--SKIPIF--
<?php if (!extension_loaded("phar")) die("skip"); ?>
--ENV--
SCRIPT_NAME=/frontcontroller20.php
REQUEST_URI=/frontcontroller20.php/
PATH_INFO=/
--FILE_EXTERNAL--
files/frontcontroller11.phar
--EXPECTF--
Fatal error: Uncaught exception 'PharException' with message 'Non-string value passed to Phar::mungServer(), expecting an array of any of these strings: PHP_SELF, REQUEST_URI, SCRIPT_FILENAME, SCRIPT_NAME' in %s.php:2
Stack trace:
#0 %s.php(2): Phar::mungServer(Array)
#1 {main}
  thrown in %s.php on line 2
