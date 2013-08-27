<?php
/**
 * @package Device
 * @version 0.01
 * This is the 'parent' class for objects that consume OODP_Leaf.
 */
require_once( 'src/OODP/Leaf.php' );

abstract class Device extends OODP_Leaf {

    public $power;
    public $net_price;
    public $discount_price;

    public function __construct( $name, $power, $net_price, $discount_price ) {
        $this->name           = $name;
        $this->power          = $power;
        $this->net_price      = $net_price;
        $this->discount_price = $discount_price;
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
