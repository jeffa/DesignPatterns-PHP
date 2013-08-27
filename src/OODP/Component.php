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

    abstract protected function add();
    abstract protected function remove();
    abstract protected function get_child();
    abstract protected function is_composite();
}



/**
 * @author Jeff Anderson <jeffa@unlocalhost.com>
 * @copyright Copyright (c) 2013, Jeffrey Hayes Anderson
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
?>
