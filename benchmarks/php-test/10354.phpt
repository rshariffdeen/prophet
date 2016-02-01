--TEST--
Phar front controller include from cwd test 1 [cache_list]
--INI--
default_charset=UTF-8
phar.cache_list={PWD}/frontcontroller22.phpt
--SKIPIF--
<?php if (!extension_loaded("phar")) die("skip"); ?>
--ENV--
SCRIPT_NAME=/frontcontroller22.php
REQUEST_URI=/frontcontroller22.php/index.php
PATH_INFO=/index.php
--FILE_EXTERNAL--
files/frontcontroller13.phar
--EXPECTHEADERS--
Content-type: text/html; charset=UTF-8
--EXPECTF--
%string|unicode%(4) "test"
%string|unicode%(12) "oof/test.php"

Warning: include(./hi.php): failed to open stream: No such file or directory in phar://%s.php on line %d

Warning: include(): Failed opening './hi.php' for inclusion (include_path='%s') in phar://%s.php on line %d