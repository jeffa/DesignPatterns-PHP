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
        $this->assertInstanceOf( 'OODP_Composite', $this->object );
        $this->assertInstanceOf( 'OODP_Component', $this->object );
    }

    function testGetName() {
        $this->assertObjectHasAttribute( 'name', $this->object );
        $this->assertEquals( $this->object->name, 'MyComposite' );
    }

    function testSetGetChildren() {
        $children = array( 'foo', 'bar', 'baz', 'qux' );
        $this->assertObjectHasAttribute( 'children', $this->object );
        $this->object->children = $children;
        $this->assertSame( $children, $this->object->children );
    }

    function testIsComposite() {
        $this->assertEquals( $this->object->is_composite(), 1 );
    }
}

if (PHPUnit_MAIN_METHOD == 'OODP_CompositeTest::main') {
    OODP_CompositeTest::main();
}

?>
