--TEST--
Bug #31098 (isset() / empty() incorrectly returns true in dereference of a wrong type)
--FILE--
<?php
$a = '';
var_dump(isset($a->b));
$a = 'a';
var_dump(isset($a->b));
$a = '0';
var_dump(isset($a->b));
$a = '';
var_dump(isset($a['b']));
$a = 'a';
var_dump(isset($a['b']));
$a = '0';
var_dump(isset($a['b']));

$simpleString = "Bogus String Text";
echo isset($simpleString->wrong)?"bug\n":"ok\n";
echo isset($simpleString["wrong"])?"ok\n":"bug\n";
echo isset($simpleString[-1])?"bug\n":"ok\n";
echo isset($simpleString[0])?"ok\n":"bug\n";
echo isset($simpleString["0"])?"ok\n":"bug\n";
echo isset($simpleString["16"])?"ok\n":"bug\n";
echo isset($simpleString["17"])?"bug\n":"ok\n";
echo $simpleString->wrong === null?"ok\n":"bug\n";
echo $simpleString["wrong"] === "B"?"ok\n":"bug\n";
echo $simpleString["0"] === "B"?"ok\n":"bug\n";
$simpleString["wrong"] = "f";
echo $simpleString["0"] === "f"?"ok\n":"bug\n";
?>
--EXPECTF--
bool(false)
bool(false)
bool(false)
bool(false)
bool(true)
bool(true)
ok
ok
ok
ok
ok
ok
ok

Notice: Trying to get property of non-object in %s.php on line %d
ok
ok
ok
ok
