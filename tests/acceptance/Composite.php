<?php

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Acceptance_CompositeTest::main');
}

require_once( 'PHPUnit/Autoload.php' );

require_once( 'tests/acceptance/src/Test/Composite/Cabinet.php' );
require_once( 'tests/acceptance/src/Test/Composite/Console.php' );
require_once( 'tests/acceptance/src/Test/Composite/Television.php' );

class Acceptance_CompositeTest extends PHPUnit_Framework_TestCase {

    var $object;

    public static function main() {
        PHPUnit_TextUI_TestRunner::run(
            new PHPUnit_Framework_TestSuite( 'Acceptance_CompositeTest' )
        );
    }

    function setUp() {
        $this->cabinet = new Cabinet( 'generic', 1, 50, 30 );
        $this->assertInstanceOf( 'OODP_Component', $this->cabinet );
        $this->assertInstanceOf( 'OODP_Composite', $this->cabinet );
        $this->assertInstanceOf( 'Cabinet', $this->cabinet );

        $this->console = new Console( 'PS3', 5, 600, 300 );
        $this->assertInstanceOf( 'OODP_Component', $this->console );
        $this->assertInstanceOf( 'OODP_Leaf', $this->console );
        $this->assertInstanceOf( 'Console', $this->console );

        $this->tv = new Television( 'Toshiba', 10, 400, 250 );
        $this->assertInstanceOf( 'OODP_Component', $this->tv );
        $this->assertInstanceOf( 'OODP_Leaf', $this->tv );
        $this->assertInstanceOf( 'Television', $this->tv );
    }

    function testAttrs() {
        $this->assertEquals( $this->cabinet->name, 'generic' );
        $this->assertEquals( $this->cabinet->power, 1 );
        $this->assertEquals( $this->cabinet->net_price, 50 );
        $this->assertEquals( $this->cabinet->discount_price, 30 );

        $this->assertEquals( $this->console->name, 'PS3' );
        $this->assertEquals( $this->console->power, 5 );
        $this->assertEquals( $this->console->net_price, 600 );
        $this->assertEquals( $this->console->discount_price, 300 );

        $this->assertEquals( $this->tv->name, 'Toshiba' );
        $this->assertEquals( $this->tv->power, 10 );
        $this->assertEquals( $this->tv->net_price, 400 );
        $this->assertEquals( $this->tv->discount_price, 250 );
    }
}

if (PHPUnit_MAIN_METHOD == 'Acceptance_CompositeTest::main') {
    Acceptance_CompositeTest::main();
}

?>
