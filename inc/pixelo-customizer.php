<?php

class Pixelo_Customizer {

	public function __construct() {
		add_action( 'customize_register', array( $this, 'register_customize_sections' ) );
	}

	public function register_customize_sections( $wp_customize ) {

        /*
        * Add settings to sections.
        */
        $this->footer_callout_section( $wp_customize );
        $this->colours_callout_section( $wp_customize );
        $this->pixelo_layout_option( $wp_customize );
    }
    
    /* Sanitize Inputs */
    public function sanitize_custom_option($input) {
        return ( $input === "No" ) ? "No" : "Yes";
    }

    public function sanitize_custom_text($input) {
        return $input;
    }

    public function sanitize_about_text($input) {
        return $input;
    }

    public function sanitize_custom_url($input) {
        return filter_var($input, FILTER_SANITIZE_URL);
    }

    public function sanitize_custom_email($input) {
        return filter_var($input, FILTER_SANITIZE_EMAIL);
    }

    public function sanitize_hex_color( $color ) {
        if ( '' === $color ) {
            return '';
        }
     
        // 3 or 6 hex digits, or the empty string.
        if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
            return $color;
        }
    }

    public function sanitize_layout_option($input) {
        return ( $input === "boxed" ) ? "boxed" : "full-width";
    }

    /* Footer Section */
    private function footer_callout_section( $wp_customize ) {

        $wp_customize->add_section('pixelo-basic-footer-callout-section', array(
            'title' => 'Footer',
            'priority' => 5,
        ));
      
        $wp_customize->add_setting('pixelo-basic-footer-callout-display', array(
            'default' => 'No',
            'sanitize_callback' => array( $this, 'sanitize_custom_option' )
        ));
      
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'pixelo-basic-footer-callout-display-control', array(
            'label' => 'Display Policy section?',
            'section' => 'pixelo-basic-footer-callout-section',
            'settings' => 'pixelo-basic-footer-callout-display',
            'type' => 'select',
            'choices' => array('No' => 'No', 'Yes' => 'Yes'),
        ))); 
      
      
        $wp_customize->add_setting('pixelo-basic-footer-callout-privacy-policy', array(
            'default' => '/privacy',
            'sanitize_callback' => array( $this, 'sanitize_custom_url' )
        ));
      
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'pixelo-basic-footer-callout-privacy-control', array(
            'label' => 'Privacy Policy URL',
            'section' => 'pixelo-basic-footer-callout-section',
            'settings' => 'pixelo-basic-footer-callout-privacy-policy',
            'description' => 'You can add custom URL for your Privacy page. Default is set to /privacy',
        )));
      
        $wp_customize->add_setting('pixelo-basic-footer-callout-cookie-policy', array(
            'default' => '/cookie-policy',
            'sanitize_callback' => array( $this, 'sanitize_custom_url' )
        ));
      
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'pixelo-basic-footer-callout-cookie-control', array(
            'label' => 'Privacy Policy URL',
            'section' => 'pixelo-basic-footer-callout-section',
            'settings' => 'pixelo-basic-footer-callout-cookie-policy',
            'description' => 'You can add custom URL for your Cookie Policy page. Default is set to /cookie-policy',
        )));
      
        $wp_customize->add_setting('pixelo-basic-footer-callout-copyright', array(
            'default' => '',
            'sanitize_callback' => array( $this, 'sanitize_custom_text' )
        ));
      
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'pixelo-basic-footer-callout-control', array(
            'label' => 'Copyright',
            'section' => 'pixelo-basic-footer-callout-section',
            'settings' => 'pixelo-basic-footer-callout-copyright',
            'type' => 'textarea'
        )));

    }

    /* Colours */
    private function colours_callout_section( $wp_customize ) {
        
        // Text color
        $wp_customize->add_setting( 'text_color', array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => array( $this, 'sanitize_hex_color' )
        ));

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_color', array(
            'section' => 'colors',
            'label'   => esc_html__( 'Text color', 'pixelo' ),
        )));

        // Link color
        $wp_customize->add_setting( 'link_color', array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => array( $this, 'sanitize_hex_color' )
        ));

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
            'section' => 'colors',
            'label'   => esc_html__( 'Link color', 'pixelo' ),
        )));

        // Accent color
        $wp_customize->add_setting( 'accent_color', array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => array( $this, 'sanitize_hex_color' )
        ));

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
            'section' => 'colors',
            'label'   => esc_html__( 'Accent color', 'pixelo' ),
        )));

        // Background color
        $wp_customize->add_setting( 'custom_background_color', array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => array( $this, 'sanitize_hex_color' )
        ));

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'custom_background_color', array(
            'section' => 'colors',
            'label'   => esc_html__( 'Background color', 'pixelo' ),
        )));

        // Wrapper color
        $wp_customize->add_setting( 'wrapper_background_color', array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => array( $this, 'sanitize_hex_color' )
        ));

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wrapper_background_color', array(
            'section' => 'colors',
            'label'   => esc_html__( 'Wrapper color', 'pixelo' ),
        )));
    }

    private function pixelo_layout_option( $wp_customize ) {
        $wp_customize->add_section('pixelo_layout_settings', array(
            'title' => __('Container', 'pixelo'),
            'priority' => 4,
        ));

        $wp_customize->add_setting( 'pixelo_layout_options', array(
            'default'   => 'boxed',
            'transport' => 'refresh',
            'sanitize_callback' => array( $this, 'sanitize_layout_option' )
        ) );

        $wp_customize->add_control( 'pixelo_layout_options', array(
            'label'     => __('Layout', 'pixelo'),
            'section'   => 'pixelo_layout_settings',
            'type'      => 'select',
            'choices'   => array(
                'full-width'    => __( 'Full width', 'pixelo' ),
                'boxed'         => __( 'Boxed', 'pixelo' ),
            )
        ) );
    }

}