<?php

namespace WC_Shipping_Wrapper;

/**
 * Dependecies check class.
 */
class Dependencies_Check {

    /**
     * Test whether all the dependecies are available.
     *
     * @access public
     * @return void
     */
    public static function test() {
        self::is_woocommerce_enabled();
        self::is_woocommerce_shipping_method_exists();
    }

    /**
     * Check whether the WooCommerce class is available.
     *
     * @access protected
     * @return void
     */
    protected static function is_woocommerce_enabled() {
        if ( ! class_exists( 'WooCommerce' ) ) {
            throw new \Exception( 'WooCommerce isn\'t enabled.' );
        }
    }

    /**
     * Check whether the WC_Shipping_Method class is available.
     *
     * @access protected
     * @return void
     */ 
    protected static function is_woocommerce_shipping_method_exists() {
        if ( ! class_exists( 'WC_Shipping_Method' ) ) {
            throw new \Exception( 'WC_Shipping_Method doesn\'t exist.' );
        }
    }
}