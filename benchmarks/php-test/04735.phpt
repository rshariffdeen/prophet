--TEST--
Reflection Bug #33389 (double free() when exporting a ReflectionClass)
--FILE--
<?php
define ('foobar', 1);
class Test {
    function foo1($arg=foobar) {
    }
    function foo2($arg=null) {
    }
    function foo3($arg=false) {
    }
    function foo4($arg='foo') {
    }
    function foo5($arg=1) {
    }
    function bar($arg) {
    }
    function foo() {
    }
}
Reflection::export(new ReflectionClass('Test'));
?>
===DONE===
<?php exit(0); ?>
--EXPECTF--
Class [ <user> class Test ] {
  @@ %s.php 3-18

  - Constants [0] {
  }

  - Static properties [0] {
  }

  - Static methods [0] {
  }

  - Properties [0] {
  }

  - Methods [7] {
    Method [ <user> public method foo1 ] {
      @@ %s.php 4 - 5

      - Parameters [1] {
        Parameter #0 [ <optional> $arg = 1 ]
      }
    }

    Method [ <user> public method foo2 ] {
      @@ %s.php 6 - 7

      - Parameters [1] {
        Parameter #0 [ <optional> $arg = NULL ]
      }
    }

    Method [ <user> public method foo3 ] {
      @@ %s.php 8 - 9

      - Parameters [1] {
        Parameter #0 [ <optional> $arg = false ]
      }
    }

    Method [ <user> public method foo4 ] {
      @@ %s.php 10 - 11

      - Parameters [1] {
        Parameter #0 [ <optional> $arg = 'foo' ]
      }
    }

    Method [ <user> public method foo5 ] {
      @@ %s.php 12 - 13

      - Parameters [1] {
        Parameter #0 [ <optional> $arg = 1 ]
      }
    }

    Method [ <user> public method bar ] {
      @@ %s.php 14 - 15

      - Parameters [1] {
        Parameter #0 [ <required> $arg ]
      }
    }

    Method [ <user> public method foo ] {
      @@ %s.php 16 - 17
    }
  }
}

===DONE===
