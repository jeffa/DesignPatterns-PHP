<?php
/**
 * @package OODP_Leaf
 * @version 0.01
 * This is the Leaf class for Composite.
 */
require_once( 'Component.php' );

abstract class OODP_Leaf extends OODP_Component {

    public function add( $component )   {}
    public function remove( $name )     {}
    public function get_child( $name )  {}
    public function is_composite()      { return 0; }
    
}



/**
 * @author Jeff Anderson <jeffa@unlocalhost.com>
 * @copyright Copyright (c) 2013, Jeffrey Hayes Anderson
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
?>
