<?php
/**
 * @package OODP_Composite
 * @version 0.01
 * This is the Composite class for Composite.
 */
require_once( 'Component.php' );

abstract class OODP_Composite extends OODP_Component {

    public function add( $component ) {
    }

    public function remove( $name ) {
    }

    public function get_child( $name ) {
    }

    public function is_composite()  { return 1; }
}



/**
 * @author Jeff Anderson <jeffa@unlocalhost.com>
 * @copyright Copyright (c) 2013, Jeffrey Hayes Anderson
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
?>
