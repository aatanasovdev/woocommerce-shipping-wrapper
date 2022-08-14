<?php

namespace WC_Shipping_Wrapper;

/**
 * Register a custom shipping method.
 */
class Shipping_Method extends \WC_Shipping_Method {

    /**
     * Constructor for shipping methods.
     *
     * @access public
     * @return void
     */
    public function __construct( $instance_id = 0 ) {
        $this->instance_id = absint( $instance_id );
        $this->init();
    }

    /**
     * Initialize the settings of the shipping method.
     * Register the required WC_Shipping_Method hooks.
     *
     * @access protected
     * @return void
     */
    protected function init() {
        $this->set_form_fields(); 
        $this->set_default_settings();
               
        add_filter( 'woocommerce_shipping_methods', array( $this, 'add_shipping_method' ) );
        add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );

    }

    /**
     * Set the default settings of the shipping method.
     *
     * @access protected
     * @return void
     */
    protected function set_default_settings() {  
        $this->supports = array(
            'shipping-zones',
            'instance-settings'
        );      
        $this->enabled            = $this->get_option( 'enabled' );
        $this->title              = $this->get_title();
        $this->method_title       = $this->get_title();
        $this->description        = $this->get_description();  
        $this->method_description = $this->get_description();  
    }

    /**
     * Set the form settings fields.
     *
     * @access protected
     * @return void
     */
    protected function set_form_fields() {
        $this->instance_form_fields = array(
            'enabled'     => array(
                'title'   => __( 'Enable/Disable' ),
                'type'    => 'checkbox',
                'label'   => __( 'Enable this shipping method' ),
                'default' => 'yes',
            ),
            'title' => array(
                'title'       => __( 'Method Title' ),
                'type'        => 'text',
                'description' => __( 'This controls the title which the user sees during checkout.' ),
                'default'     => '',
                'desc_tip'    => true
            ),
            'cost' => array(
                'title'       => __( 'Method Cost' ),
                'type'        => 'number',
                'description' => __( 'This controls the cost of this method.' ),
                'default'     => 0,
                'desc_tip'    => true
            ),            
            'description' => array(
                'title'       => __( 'Method Description' ),
                'type'        => 'text',
                'description' => __( 'This controls the description which the user sees during checkout.' ),
                'default'     => '',
                'desc_tip'    => true
            ),           
        ); 
    }

    /**
     * Set the rate of the shipping method.
     *
     * @access public
     * @return void
     */
    public function calculate_shipping( $package = array() ) {
        $this->add_rate( array(
            'id'    => $this->id . $this->instance_id,
            'label' => $this->get_title(),
            'cost'  => $this->get_cost(),
        ) );
    }   

    /**
     * Add the shipping method to the WordPress dashboard.
     *
     * @access public
     * @return array
     */
    public function add_shipping_method( $methods ) {
        $methods[$this->id] = $this; 
        return $methods;
    }

    /**
     * Get the title of the shipping method.
     *
     * @access public
     * @return string
     */
    public function get_title() {
        $title = $this->method_title;

        $option_title = $this->get_option( 'title' );

        if( $option_title ) {
            $title = $option_title;
        }

        return $title;
    }

    /**
     * Get the cost of the shipping method.
     *
     * @access public
     * @return string
     */
    public function get_cost() {
        return $this->get_option( 'cost' );
    }

    /**
     * Get the description of the shipping method.
     *
     * @access public
     * @return string
     */
    public function get_description() {
        return $this->get_option( 'description' );
    }    
}