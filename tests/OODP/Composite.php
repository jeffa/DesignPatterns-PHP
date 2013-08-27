<?php

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Numbers_Words_BulgarianTest::main');
}

require_once( 'PHPUnit/Autoload.php' );

require_once( 'src/OODP/Composite.php' );

class MyComposite extends OODP_Composite { }

class OODP_CompositeTest extends PHPUnit_Framework_TestCase {

    var $object;

    public static function main() {
        PHPUnit_TextUI_TestRunner::run(
            new PHPUnit_Framework_TestSuite( 'OODP_CompositeTest' )
        );
    }

    function setUp() {
        $this->object = new MyComposite( 'MyComposite' );
    }

    function testGetName() {
        $this->assertEquals( $this->object->get_name(), 'MyComposite' );
    }

    function testIsComposite() {
        $this->assertEquals( $this->object->is_composite(), 1 );
    }
}

if (PHPUnit_MAIN_METHOD == 'OODP_CompositeTest::main') {
    OODP_CompositeTest::main();
}

?>
