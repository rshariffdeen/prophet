--TEST--
Phar: fopen a .phar for writing (new file)
--SKIPIF--
<?php
if (!extension_loaded("phar")) die("skip");
if (version_compare(PHP_VERSION, "5.3", "<")) die("skip requires 5.3 or later");
?>
--INI--
phar.readonly=1
phar.require_hash=0
--FILE--
<?php
$fname = dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.phar.php';
$pname = 'phar://' . $fname;
$file = "<?php __HALT_COMPILER(); ?>";

$files = array();
$files['a.php'] = '<?php echo "This is a\n"; ?>';
$files['b.php'] = '<?php echo "This is b\n"; ?>';
$files['b/c.php'] = '<?php echo "This is b/c\n"; ?>';
include 'files/phar_test.inc';

function err_handler($errno, $errstr, $errfile, $errline) {
  echo "Catchable fatal error: $errstr in $errfile on line $errline\n";
}

set_error_handler("err_handler", E_RECOVERABLE_ERROR);

$fp = fopen($pname . '/b/new.php', 'wb');
fwrite($fp, 'extra');
fclose($fp);
include $pname . '/b/c.php';
include $pname . '/b/new.php';
?>

===DONE===
--CLEAN--
<?php unlink(dirname(__FILE__) . '/' . basename(__FILE__, '.clean.php') . '.phar.php'); ?>
--EXPECTF--

Warning: fopen(phar://%s.php): failed to open stream: phar error: write operations disabled by the php.ini setting phar.readonly in %s.php on line %d

Warning: fwrite() expects parameter 1 to be resource, boolean given in %s.php on line %d

Warning: fclose() expects parameter 1 to be resource, boolean given in %s.php on line %d
This is b/c

Warning: include(phar://%s.php): failed to open stream: phar error: "b/new.php" is not a file in phar "%s.php" in %s.php on line 22

Warning: include(): Failed opening 'phar://%s.php' for inclusion (include_path='%s') in %s.php on line %d

===DONE===
