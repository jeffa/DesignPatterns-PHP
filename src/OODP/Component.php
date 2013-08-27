<?php
/**
 * @abstract OODP_Component
 * @version 0.01
 * This is the abstract base class for Composite.
 */
abstract class OODP_Component {

    public $children;
    public $parent;
    public $name;

    abstract protected function add( $component );
    abstract protected function remove( $name );
    abstract protected function get_child( $name );
    abstract protected function is_composite();

    public function __construct( $name ) {
        $this->name = $name;
    }

    public function get_name() {
        return $this->name;
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
