<?php

namespace WC_Shipping_Wrapper;

/**
 * Register a custom shipping method.
 */
class Shipping_Method extends \WC_Shipping_Method {
    /**
     * Default name value.
     *
     * @var object
     */
    static $default_id;

    /**
     * Default title value.
     *
     * @var object
     */
    static $default_title;

    /**
     * Default description value.
     *
     * @var object
     */
    static $default_description;    

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
     * Initialize the instance.
     *
     * @access protected
     * @return void
     */
    protected function init() {
        $this->set_default_settings();
        $this->set_form_fields(); 
    }

    /**
     * Set the default settings of the shipping method.
     *
     * @access public
     * @return void
     */
    public function set_default_settings() {  
        $this->supports = array(
            'shipping-zones',
            'instance-settings'
        );      

        $this->id                 = $this->get_default_id();
        $this->method_title       = $this->get_default_title();
        $this->method_description = $this->get_default_description(); 
    }

    /**
     * Set the option values of the shipping method.
     *
     * @access public
     * @return void
     */
    public function set_options() {
        $this->enabled = $this->get_option( 'enabled' );
        $this->title   = $this->get_option( 'title' );
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
                'default'     => $this->get_default_title(),
                'desc_tip'    => true
            ),
            'cost' => array(
                'title'       => __( 'Method Cost' ),
                'type'        => 'number',
                'description' => __( 'This controls the cost of this method.' ),
                'default'     => 0,
                'desc_tip'    => true
            )          
        ); 

        $this->set_options();

        add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
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
            'label' => $this->title,
            'cost'  => $this->get_option( 'cost' )
        ) );
    }

    /**
     * Get the default name of the shipping method.
     *
     * @access public
     * @return string
     */
    public function get_default_id() {
        return self::$default_id;
    }

    /**
     * Get the default title of the shipping method.
     *
     * @access public
     * @return string
     */
    public function get_default_title() {
        return self::$default_title;
    }    

    /**
     * Get the default description of the shipping method.
     *
     * @access public
     * @return string
     */
    public function get_default_description() {
        return self::$default_description;
    }    

    /**
     * Set the name of the shipping method.
     *
     * @param string $id Method Name.
     * @access public
     * @return void
     */
    public function set_default_id( $id ) {
        self::$default_id = $id;
    } 

    /**
     * Set the default title of the shipping method.
     *
     * @param string $title Default Title.
     * @access public
     * @return void
     */
    public function set_default_title( $title ) {
        self::$default_title = $title;
    }

    /**
     * Set the default description of the shipping method.
     *
     * @param string $description Default Description.
     * @access public
     * @return void
     */
    public function set_default_description( $description ) {
        self::$default_description = $description;
    }
}