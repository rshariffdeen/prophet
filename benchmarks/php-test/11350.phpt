--TEST--
FTP ftp_get file for both binary and ASCII transfer modes 
--CREDITS--
Nathaniel McHugh
--SKIPIF--
<?php
require 'skipif.inc';
?>
--FILE--
<?php
require 'server.inc';

$ftp = ftp_connect('127.0.0.1', $port);
if (!$ftp) die("Couldn't connect to the server");

var_dump(ftp_login($ftp, 'user', 'pass'));

//test simple text transfer
$tmpfname = tempnam(dirname(__FILE__), "ftp_test");
var_dump(ftp_get($ftp, $tmpfname ,'a story.txt', FTP_ASCII));
echo file_get_contents($tmpfname);
unlink($tmpfname);

//test binary data transfer
$tmpfname = tempnam(dirname(__FILE__), "ftp_test");
var_dump(ftp_get($ftp, $tmpfname, 'binary data.bin', FTP_BINARY));
var_dump(urlencode(file_get_contents($tmpfname)));
unlink($tmpfname);

//test non-existant file request 
ftp_get($ftp, $tmpfname ,'a warning.txt', FTP_ASCII);
?>
--EXPECTF--
bool(true)
bool(true)
For sale: baby shoes, never worn.
bool(true)
string(21) "BINARYFoo%00Bar%0D%0A"

Warning: ftp_get(): a warning: No such file or directory  in %s.php on line %d
