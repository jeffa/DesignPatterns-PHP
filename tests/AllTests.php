<?php
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Numbers_Words_AllTests::main');
}

require_once( 'PHPUnit/Autoload.php' );

// these are the test classes, not the actual classes
require_once( 'OODP/Leaf.php' );
require_once( 'OODP/Composite.php' );

class OODP_AllTests {

    public static function main() {
        PHPUnit_TextUI_TestRunner::run( self::suite() );
    }

    public static function suite() {
        $suite = new PHPUnit_Framework_TestSuite();

        $suite->addTestSuite( 'OODP_LeafTest' );
        $suite->addTestSuite( 'OODP_CompositeTest' );

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == 'OODP_AllTests::main') {
    OODP_AllTests::main();
}

?>
