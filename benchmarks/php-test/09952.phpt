--TEST--
Phar front controller mime type extension is not a string
--INI--
default_charset=
--SKIPIF--
<?php if (!extension_loaded("phar")) die("skip"); ?>
<?php die("skip"); ?>
--ENV--
SCRIPT_NAME=/frontcontroller11.php
REQUEST_URI=/frontcontroller11.php/a.php
PATH_INFO=/a.php
--FILE_EXTERNAL--
files/frontcontroller5.phar
--EXPECTHEADERS--
Content-type: text/html
--EXPECTF--
Fatal error: Uncaught exception 'PharException' with message 'Key of MIME type overrides array must be a file extension, was "0"' in %s.php:2
Stack trace:
#0 %s.php(2): Phar::webPhar('whatever', 'index.php', '', Array)
#1 {main}
  thrown in %s.php on line 2