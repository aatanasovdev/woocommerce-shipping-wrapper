<?php

namespace WC_Shipping_Wrapper;

use WC_Shipping_Wrapper\Shipping_Method;
use WC_Shipping_Wrapper\Dependencies_Check;

/**
 * The bootstrap class.
 */
class Shipping {
    /**
     * Shipping Method instance.
     *
     * @var object
     */
    public $method; 

    /**
     * Creates an instance of Shipping Method.
     *
     * @access public
     * @return void
     */
    public function __construct( $name, $title ) {
        $this->method               = new Shipping_Method();
        $this->method->id           = $name;
        $this->method->method_title = $title;

        $this->init();      
    }

    /**
     * Init our package.
     *
     * @access protected
     * @return void
     */
    protected function init() {
        Dependencies_Check::test();
    }
}