--TEST--
Bug #32647 (Using register_shutdown_function() with invalid callback can crash PHP)
--INI--
error_reporting=4095
display_errors=1
--FILE--
<?php

function foo()
{
  echo "foo!\n";
}

class bar
{
	function barfoo ()
	{ echo "bar!\n"; }
}

unset($obj);
register_shutdown_function(array($obj,""));            // Invalid
register_shutdown_function(array($obj,"some string")); // Invalid
register_shutdown_function(array(0,""));               // Invalid
register_shutdown_function(array('bar','foo'));        // Invalid
register_shutdown_function(array(0,"some string"));    // Invalid
register_shutdown_function('bar');                     // Invalid
register_shutdown_function('foo');                     // Valid
register_shutdown_function(array('bar','barfoo'));     // Invalid

$obj = new bar;
register_shutdown_function(array($obj,'foobar'));      // Invalid
register_shutdown_function(array($obj,'barfoo'));      // Valid

?>
--EXPECTF--
Notice: Undefined variable: obj in %s on line %d

Warning: register_shutdown_function(): Invalid shutdown callback 'Array' passed in %s on line %d

Notice: Undefined variable: obj in %s on line %d

Warning: register_shutdown_function(): Invalid shutdown callback 'Array' passed in %s on line %d

Warning: register_shutdown_function(): Invalid shutdown callback 'Array' passed in %s on line %d

Warning: register_shutdown_function(): Invalid shutdown callback 'bar::foo' passed in %s on line %d

Warning: register_shutdown_function(): Invalid shutdown callback 'Array' passed in %s on line %d

Warning: register_shutdown_function(): Invalid shutdown callback 'bar' passed in %s on line %d

Strict Standards: Non-static method bar::barfoo() should not be called statically in %s.php on line %d

Warning: register_shutdown_function(): Invalid shutdown callback 'bar::foobar' passed in %s.php on line %d
foo!

Strict Standards: Non-static method bar::barfoo() should not be called statically in Unknown on line 0

Strict Standards: Non-static method bar::barfoo() should not be called statically in Unknown on line 0
bar!
bar!
