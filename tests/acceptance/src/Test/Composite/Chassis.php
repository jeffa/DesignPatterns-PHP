<?php
/**
 * @package Chassis
 * @version 0.01
 * This is the 'parent' class for objects that consume OODP_Composite.
 */
require_once( 'src/OODP/Composite.php' );

abstract class Chassis extends OODP_Composite {

    public $power;
    public $net_price;
    public $discount_price;

    public function __construct( $name, $power, $net_price, $discount_price ) {
        $this->name           = $name;
        $this->power          = $power;
        $this->net_price      = $net_price;
        $this->discount_price = $discount_price;
    }

    public function get_total_net_price() {
        $total = $this->net_price;
        foreach ($this->children as $child) {
            $total += $child->net_price; 
        }
        return $total;
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
