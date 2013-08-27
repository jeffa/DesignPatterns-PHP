<?php
/**
 * @package OODP_Composite
 * @version 0.01
 * This is the Composite class for Composite.
 */
require_once( 'Component.php' );

abstract class OODP_Composite extends OODP_Component {

    public $children;

    public function add( $component ) {

        if (isset( $this->children[ $component->name ] )) {
            throw new CollisionException( 'Name Exists: ' . $component->name );
        }

        $this->children[ $component->name ] = $component;
    }

    public function remove( $name ) {
        if (isset( $this->children[ $name ] )) {
            unset( $this->children[ $name ] );
        }
    }

    public function get_child( $name ) {

        if (isset( $this->children[ $name ] )) {
            return $this->children[ $name ];
        }
    }

    public function is_composite()  {
        return 1;
    }
}

class CollisionException extends Exception {
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}



/**
 * @author Jeff Anderson <jeffa@unlocalhost.com>
 * @copyright Copyright (c) 2013, Jeffrey Hayes Anderson
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
?>
