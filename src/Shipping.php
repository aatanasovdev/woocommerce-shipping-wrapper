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
    public function __construct( $name, $title, $description ) {
        $this->set_method( $name, $title, $description );
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
        add_filter( 'woocommerce_shipping_methods', array( $this, 'add_shipping_method' ) );
    }

    /**
     * Configure the shipping method.
     *
     * @access protected
     * @return void
     */
    protected function set_method( $name, $title, $description ) {
        $this->method = new Shipping_Method();
        $this->method->set_default_id( $name );
        $this->method->set_default_title( $title );
        $this->method->set_default_description( $description );
        $this->method->set_default_settings();
    }

    /**
     * Add the shipping method to the other WooCommerce shipping methods.
     *
     * @access public
     * @return array
     */
    public function add_shipping_method( $methods ) {
        $methods[$this->method->id] = $this->method; 
        return $methods;
    }    
}