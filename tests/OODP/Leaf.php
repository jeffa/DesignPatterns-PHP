<?php

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Numbers_Words_BulgarianTest::main');
}

require_once( 'PHPUnit/Autoload.php' );

require_once( 'src/OODP/Leaf.php' );

class MyLeaf extends OODP_Leaf { }

class OODP_LeafTest extends PHPUnit_Framework_TestCase {

    var $object;

    public static function main() {
        PHPUnit_TextUI_TestRunner::run(
            new PHPUnit_Framework_TestSuite( 'OODP_LeafTest' )
        );
    }

    function setUp() {
        $this->object = new MyLeaf();
    }

    function testIsComposite() {
        $this->assertEquals( $this->object->is_composite(), 0 );
    }
}

if (PHPUnit_MAIN_METHOD == 'OODP_LeafTest::main') {
    OODP_LeafTest::main();
}

?>
