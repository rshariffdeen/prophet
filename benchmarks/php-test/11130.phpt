--TEST--
pspell configs
--SKIPIF--
<?php
if (!extension_loaded('pspell')) die('skip');
if (!@pspell_new('en')) die('skip English dictionary is not available');
?>
--FILE--
<?php

$wordlist = dirname(__FILE__).'/wordlist.txt';

var_dump(pspell_new_personal(__FILE__, 'en'));
$p = pspell_new_personal($wordlist, 'en');

var_dump(pspell_check($p, 'dfnvnsafksfksf'));

echo "--\n";
$cfg = pspell_config_create('en');
var_dump(pspell_config_personal($cfg, "$wordlist.tmp"));
$p = pspell_new_config($cfg);

copy($wordlist, "$wordlist.tmp");

var_dump(pspell_check($p, 'ola'));
var_dump(pspell_add_to_personal($p, 'ola'));
var_dump(pspell_check($p, 'ola'));

echo "--\n";
var_dump(pspell_save_wordlist($p));
var_dump(strpos(file_get_contents("$wordlist.tmp"), 'ola') !== FALSE);

unlink("$wordlist.tmp");
?>
--EXPECTF--
Warning: pspell_new_personal(): PSPELL couldn't open the dictionary. reason: The file "%s.php" is not in the proper format. in %s.php on line 5
bool(false)
bool(true)
--
bool(true)
bool(false)
bool(true)
bool(true)
--
bool(true)
bool(true)
