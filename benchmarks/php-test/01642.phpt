--TEST--
Bug #34064 (arr[] as param to function in class gives invalid opcode)
--FILE--
<?php
class XmlTest {

    function test_ref(&$test)
    {
    	$test = "ok";
    }

    function test($test)
    {
    }

    function run()
    {
        $ar = array();
        $this->test_ref($ar[]);
        var_dump($ar);
        $this->test($ar[]);
    }
}

$o = new XmlTest();
$o->run();
?>
--EXPECTF--
array(1) {
  [0]=>
  string(2) "ok"
}

Fatal error: Cannot use [] for reading in %s.php on line 18

