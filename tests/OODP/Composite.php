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

    function testIsComposite() {
        $this->assertEquals( $this->object->is_composite(), 1 );
    }

    function testGetName() {
        $this->assertObjectHasAttribute( 'name', $this->object );
        $this->assertEquals( $this->object->name, 'MyComposite' );
    }

    function testAdd() {
        $this->object->add( new MyComposite('inner') );
        $this->assertInstanceOf( 'MyComposite', $this->object->children['inner'] );
        $this->assertEquals( $this->object->children['inner']->name, 'inner' );
    }

    function testGetChild() {
        $this->object->add( new MyComposite('foo') );
        $this->assertInstanceOf( 'MyComposite', $this->object->get_child('foo') );
        $this->assertEquals( $this->object->get_child('foo')->name, 'foo' );

        $this->object->add( new MyComposite('bar') );
        $this->assertInstanceOf( 'MyComposite', $this->object->get_child('bar') );
        $this->assertEquals( $this->object->get_child('bar')->name, 'bar' );

        $this->assertNull( $this->object->get_child('undef') );
    }

    /**
     * @expectedException CollisionException
     * @expectedExceptionMessage Name Exists: some_name
     */
    function testCollisionException() {
        $this->object->add( new MyComposite('some_name') );
        $this->object->add( new MyComposite('some_name') );
    }
}

if (PHPUnit_MAIN_METHOD == 'OODP_CompositeTest::main') {
    OODP_CompositeTest::main();
}

?>
