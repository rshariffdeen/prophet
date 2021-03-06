--TEST--
Phar front controller $_SERVER munging success
--INI--
default_charset=UTF-8
--SKIPIF--
<?php if (!extension_loaded("phar")) die("skip"); ?>
--ENV--
SCRIPT_NAME=/frontcontroller21.php
REQUEST_URI=/frontcontroller21.php/index.php?test=hi
PATH_INFO=/index.php
QUERY_STRING=test=hi
--FILE_EXTERNAL--
files/frontcontroller12.phar
--EXPECTHEADERS--
Content-type: text/html; charset=UTF-8
--EXPECTF--
%unicode|string%(10) "/index.php"
string(10) "/index.php"
string(%d) "phar://%s.php"
string(18) "/index.php?test=hi"
string(32) "/frontcontroller21.php/index.php"
string(22) "/frontcontroller21.php"
string(%d) "%s.php"
string(40) "/frontcontroller21.php/index.php?test=hi"