<?php

class Pixelo_Customizer {

    public function __construct() {
        add_action( 'customize_register', array( $this, 'pixelo_register_customize_sections' ) );
    }

    public function pixelo_register_customize_sections( $wp_customize ) {

        /*
        * Add settings to sections.
        */
        $this->pixelo_colours_callout_section( $wp_customize );
        $this->pixelo_layout_option( $wp_customize );
        $this->pixelo_sidebar_layout_option( $wp_customize );
        $this->pixelo_blog_settings_option( $wp_customize );
        $this->pixelo_single_blog_settings_option( $wp_customize );
    }
    
    /* Sanitize Inputs */
    public function pixelo_sanitize_hex_color( $color ) {
        if ( '' === $color ) {
            return '';
        }
     
        // 3 or 6 hex digits, or the empty string.
        if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
            return $color;
        }
    }

    public function pixelo_sanitize_layout_option( $input ) {
        return ( $input === "boxed" ) ? "boxed" : "full-width";
    }

    public function pixelo_sanitize_sidebar_option( $input ) {
        return ( $input === "right-sidebar" ) ? "right-sidebar" : (( $input === 'left-sidebar' ) ? "left-sidebar" : "no-sidebar");
    }

    public function pixelo_sanitize_post_content_option( $input ) {
        return ( $input === "excerpt" ) ? "excerpt" : "full-content";
    }

    public function pixelo_sanitize_single_post_related( $input ) {
        return ( $input === "hide" ) ? "hide" : "show";
    }

    function pixelo_sanitize_checkbox( $checked ) {
        // Boolean check.
        return ( ( isset( $checked ) && true == $checked ) ? true : false );
    }

    /* Colours */
    private function pixelo_colours_callout_section( $wp_customize ) {

        // Background color
        $wp_customize->add_setting( 'custom_background_color', array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => array( $this, 'pixelo_sanitize_hex_color' )
        ));

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'custom_background_color', array(
            'section' => 'colors',
            'label'   => esc_html__( 'Background color', 'pixelo' ),
        )));

        // Text color
        $wp_customize->add_setting( 'text_color', array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => array( $this, 'pixelo_sanitize_hex_color' )
        ));

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_color', array(
            'section' => 'colors',
            'label'   => esc_html__( 'Text color', 'pixelo' ),
        )));

        // Link color
        $wp_customize->add_setting( 'link_color', array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => array( $this, 'pixelo_sanitize_hex_color' )
        ));

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
            'section' => 'colors',
            'label'   => esc_html__( 'Link color', 'pixelo' ),
        )));

        // Link hover color
        $wp_customize->add_setting( 'link_hover_color', array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => array( $this, 'pixelo_sanitize_hex_color' )
        ));

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', array(
            'section' => 'colors',
            'label'   => esc_html__( 'Link hover color', 'pixelo' ),
        )));

        // Heading color
        $wp_customize->add_setting( 'heading_color', array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => array( $this, 'pixelo_sanitize_hex_color' )
        ));

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heading_color', array(
            'section' => 'colors',
            'label'   => esc_html__( 'Heading color', 'pixelo' ),
        )));

        
    }

    private function pixelo_layout_option( $wp_customize ) {
        $wp_customize->add_section('pixelo_layout_settings', array(
            'title' => esc_html__('Container', 'pixelo'),
            'priority' => 4,
        ));

        $wp_customize->add_setting( 'pixelo_layout_options', array(
            'default'   => 'boxed',
            'transport' => 'refresh',
            'sanitize_callback' => array( $this, 'pixelo_sanitize_layout_option' )
        ) );

        $wp_customize->add_control( 'pixelo_layout_options', array(
            'label'     => esc_html__('Layout', 'pixelo'),
            'section'   => 'pixelo_layout_settings',
            'type'      => 'select',
            'choices'   => array(
                'full-width'    => esc_html__( 'Full width', 'pixelo' ),
                'boxed'         => esc_html__( 'Boxed', 'pixelo' ),
            )
        ) );
    }

    /* Sidebar */
    private function pixelo_sidebar_layout_option( $wp_customize ) {
        $wp_customize->add_section('pixelo_sidebar_layout_settings', array(
            'title' => __('Sidebar', 'pixelo'),
            'priority' => 4,
        ));

        $wp_customize->add_setting( 'pixelo_page_sidebar', array(
            'default'   => 'left-sidebar',
            'transport' => 'refresh',
            'sanitize_callback' => array( $this, 'pixelo_sanitize_sidebar_option' )
        ) );

        $wp_customize->add_control( 'pixelo_page_sidebar', array(
            'label'     => __('Page Sidebar', 'pixelo'),
            'section'   => 'pixelo_sidebar_layout_settings',
            'type'      => 'select',
            'choices'   => array(
                'no-sidebar'        => __( 'No Sidebar', 'pixelo' ),
                'left-sidebar'      => __( 'Left Sidebar', 'pixelo' ),
                'right-sidebar'     => __( 'Right Sidebar', 'pixelo' ),
            )
        ) );

        $wp_customize->add_setting( 'pixelo_single_post_sidebar', array(
            'default'   => 'right-sidebar',
            'transport' => 'refresh',
            'sanitize_callback' => array( $this, 'pixelo_sanitize_sidebar_option' )
        ) );

        $wp_customize->add_control( 'pixelo_single_post_sidebar', array(
            'label'     => __('Single Post Sidebar', 'pixelo'),
            'section'   => 'pixelo_sidebar_layout_settings',
            'type'      => 'select',
            'choices'   => array(
                'no-sidebar'        => __( 'No Sidebar', 'pixelo' ),
                'left-sidebar'      => __( 'Left Sidebar', 'pixelo' ),
                'right-sidebar'     => __( 'Right Sidebar', 'pixelo' ),
            )
        ) );

        $wp_customize->add_setting( 'pixelo_wc_sidebar_layout_options', array(
            'default'   => 'no-sidebar',
            'transport' => 'refresh',
            'sanitize_callback' => array( $this, 'pixelo_sanitize_sidebar_option' )
        ) );

        $wp_customize->add_control( 'pixelo_wc_sidebar_layout_options', array(
            'label'     => __('WooCommerce Sidebar', 'pixelo'),
            'section'   => 'pixelo_sidebar_layout_settings',
            'type'      => 'select',
            'choices'   => array(
                'no-sidebar'        => __( 'No Sidebar', 'pixelo' ),
                'left-sidebar'      => __( 'Left Sidebar', 'pixelo' ),
                'right-sidebar'     => __( 'Right Sidebar', 'pixelo' ),
            )
        ) );

        $wp_customize->add_setting( 'pixelo_single_product_sidebar', array(
            'default'   => 'no-sidebar',
            'transport' => 'refresh',
            'sanitize_callback' => array( $this, 'pixelo_sanitize_sidebar_option' )
        ) );

        $wp_customize->add_control( 'pixelo_single_product_sidebar', array(
            'label'     => __(' Single Product', 'pixelo'),
            'section'   => 'pixelo_sidebar_layout_settings',
            'type'      => 'select',
            'choices'   => array(
                'no-sidebar'        => __( 'No Sidebar', 'pixelo' ),
                'left-sidebar'      => __( 'Left Sidebar', 'pixelo' ),
                'right-sidebar'     => __( 'Right Sidebar', 'pixelo' ),
            )
        ) );

    }

    /* Blog setting */
    private function pixelo_blog_settings_option( $wp_customize ) {

        /* Blog Options */
        $wp_customize->add_panel( 'pixelo_blog_option_panel', 
            array(
                //'priority'       => 100,
                'title'            => __( 'Blog / Archive', 'pixelo' ),
                'priority'    => 10,
            ) 
        );

        $wp_customize->add_section( 'pixelo_blog_post_structure', 
            array(
                'title'         => __( 'Post Structure', 'pixelo' ),
                'priority'      => 1,
                'panel'         => 'pixelo_blog_option_panel'
            ) 
        );

        $wp_customize->add_section( 'pixelo_blog_post_title_meta', 
            array(
                'title'         => __( 'Meta', 'pixelo' ),
                'priority'      => 1,
                'panel'         => 'pixelo_blog_option_panel'
            ) 
        );

        $wp_customize->add_section( 'pixelo_blog_post_content', 
            array(
                'title'         => __( 'Post Content', 'pixelo' ),
                'priority'      => 1,
                'panel'         => 'pixelo_blog_option_panel'
            ) 
        );

        /* Feature Image */
        $wp_customize->add_setting( 'pixelo_blog_post_feature_image',
            array(
                'sanitize_callback' => array( $this, 'pixelo_sanitize_checkbox' ),
                'transport'         => 'refresh',
                'default'       =>  true
            )
        );

        $wp_customize->add_control( 'pixelo_blog_post_feature_image', 
            array(
                'type'        => 'checkbox',
                'label'       => 'Featured Image',
                'priority'    => 10,
                'section'     => 'pixelo_blog_post_structure',
            ) 
        );

        /* Post Title */
        $wp_customize->add_setting( 'pixelo_blog_post_title_tag',
            array(
                'sanitize_callback' => array( $this, 'pixelo_sanitize_checkbox' ),
                'transport'         => 'refresh',
                'default'       =>  true
            )
        );

        $wp_customize->add_control( 'pixelo_blog_post_title_tag', 
            array(
                'type'        => 'checkbox',
                'label'       => 'Title & Blog Meta',
                'priority'    => 10,
                'section'     => 'pixelo_blog_post_structure',
            ) 
        );

        /* Comment */
        $wp_customize->add_setting( 'pixelo_blog_post_comment',
            array(
                'sanitize_callback' => array( $this, 'pixelo_sanitize_checkbox' ),
                'transport'         => 'refresh',
                'default'       =>  true
            )
        );

        $wp_customize->add_control( 'pixelo_blog_post_comment', 
            array(
                'type'        => 'checkbox',
                'label'       => 'Comment',
                'priority'    => 10,
                'section'     => 'pixelo_blog_post_title_meta',
            ) 
        );

        /* Author */
        $wp_customize->add_setting( 'pixelo_blog_post_author',
            array(
                'sanitize_callback' => array( $this, 'pixelo_sanitize_checkbox' ),
                'transport'         => 'refresh',
                'default'       =>  true
            )
        );

        $wp_customize->add_control( 'pixelo_blog_post_author', 
            array(
                'type'        => 'checkbox',
                'label'       => 'Author',
                'priority'    => 10,
                'section'     => 'pixelo_blog_post_title_meta',
            ) 
        );

        /* Date */
        $wp_customize->add_setting( 'pixelo_blog_post_publish_date',
            array(
                'sanitize_callback' => array( $this, 'pixelo_sanitize_checkbox' ),
                'transport'         => 'refresh',
                'default'       =>  true
            )
        );

        $wp_customize->add_control( 'pixelo_blog_post_publish_date', 
            array(
                'type'        => 'checkbox',
                'label'       => 'Publish Date',
                'priority'    => 10,
                'section'     => 'pixelo_blog_post_title_meta',
            ) 
        );

        /* Post Content */
        $wp_customize->add_setting( 'pixelo_blog_post_content_option',
            array(
                'transport'         => 'refresh',
                'default'   => 'excerpt',
                'sanitize_callback' => array( $this, 'pixelo_sanitize_post_content_option' )
            )
        );

        $wp_customize->add_control( 'pixelo_blog_post_content_option', 
            array(
                'type'        => 'radio',
                'label'       => 'Post Content',
                'priority'    => 10,
                'section'     => 'pixelo_blog_post_content',
                'choices'           => array(
                    'full-content'       => __( 'Full Content', 'pixelo' ),
                    'excerpt'      => __( 'Excerpt', 'pixelo' ),
                ),
            ) 
        );
    }

    /* Single blog setting */
    private function pixelo_single_blog_settings_option( $wp_customize ) {

        /* Blog Options */
        $wp_customize->add_panel( 'pixelo_single_blog_post_panel', 
            array(
                'title'            => __( 'Single Post', 'pixelo' ),
                'priority'    => 10,
            ) 
        );

        $wp_customize->add_section( 'pixelo_single_blog_post_structure_section', 
            array(
                'title'         => __( 'Post Structure', 'pixelo' ),
                'priority'      => 1,
                'panel'         => 'pixelo_single_blog_post_panel'
            ) 
        );

        $wp_customize->add_section( 'pixelo_single_blog_post_title_meta_section', 
            array(
                'title'         => __( 'Meta', 'pixelo' ),
                'priority'      => 1,
                'panel'         => 'pixelo_single_blog_post_panel'
            ) 
        );

        $wp_customize->add_section( 'pixelo_single_blog_post_content_section', 
            array(
                'title'         => __( 'Related Post', 'pixelo' ),
                'priority'      => 1,
                'panel'         => 'pixelo_single_blog_post_panel'
            ) 
        );

        /* Feature Image */
        $wp_customize->add_setting( 'pixelo_single_blog_post_feature_image',
            array(
                'sanitize_callback' => array( $this, 'pixelo_sanitize_checkbox' ),
                'transport'         => 'refresh',
                'default'       =>  true
            )
        );

        $wp_customize->add_control( 'pixelo_single_blog_post_feature_image', 
            array(
                'type'        => 'checkbox',
                'label'       => 'Featured Image',
                'priority'    => 10,
                'section'     => 'pixelo_single_blog_post_structure_section',
            ) 
        );

        /* Post Title */
        $wp_customize->add_setting( 'pixelo_single_blog_post_title_tag',
            array(
                'sanitize_callback' => array( $this, 'pixelo_sanitize_checkbox' ),
                'transport'         => 'refresh',
                'default'       =>  true
            )
        );

        $wp_customize->add_control( 'pixelo_single_blog_post_title_tag', 
            array(
                'type'        => 'checkbox',
                'label'       => 'Title & Blog Meta',
                'priority'    => 10,
                'section'     => 'pixelo_single_blog_post_structure_section',
            ) 
        );

        /* Comment */
        $wp_customize->add_setting( 'pixelo_single_blog_post_comment',
            array(
                'sanitize_callback' => array( $this, 'pixelo_sanitize_checkbox' ),
                'transport'         => 'refresh',
                'default'       =>  true
            )
        );

        $wp_customize->add_control( 'pixelo_single_blog_post_comment', 
            array(
                'type'        => 'checkbox',
                'label'       => 'Comment',
                'priority'    => 10,
                'section'     => 'pixelo_single_blog_post_title_meta_section',
            ) 
        );

        /* Category */
        $wp_customize->add_setting( 'pixelo_single_blog_post_category',
            array(
                'sanitize_callback' => array( $this, 'pixelo_sanitize_checkbox' ),
                'transport'         => 'refresh',
                'default'       =>  true
            )
        );

        $wp_customize->add_control( 'pixelo_single_blog_post_category', 
            array(
                'type'        => 'checkbox',
                'label'       => 'Category',
                'priority'    => 10,
                'section'     => 'pixelo_single_blog_post_title_meta_section',
            ) 
        );

        /* Author */
        $wp_customize->add_setting( 'pixelo_signle_blog_post_author',
            array(
                'sanitize_callback' => array( $this, 'pixelo_sanitize_checkbox' ),
                'transport'         => 'refresh',
                'default'       =>  true
            )
        );

        $wp_customize->add_control( 'pixelo_signle_blog_post_author', 
            array(
                'type'        => 'checkbox',
                'label'       => 'Author',
                'priority'    => 10,
                'section'     => 'pixelo_single_blog_post_title_meta_section',
            ) 
        );

        /* Date */
        $wp_customize->add_setting( 'pixelo_single_blog_post_publish_date',
            array(
                'sanitize_callback' => array( $this, 'pixelo_sanitize_checkbox' ),
                'transport'         => 'refresh',
                'default'       =>  true
            )
        );

        $wp_customize->add_control( 'pixelo_single_blog_post_publish_date', 
            array(
                'type'        => 'checkbox',
                'label'       => 'Publish Date',
                'priority'    => 10,
                'section'     => 'pixelo_single_blog_post_title_meta_section',
            ) 
        );

        /* Tag */
        $wp_customize->add_setting( 'pixelo_single_blog_post_tag',
            array(
                'sanitize_callback' => array( $this, 'pixelo_sanitize_checkbox' ),
                'transport'         => 'refresh',
                'default'       =>  true
            )
        );

        $wp_customize->add_control( 'pixelo_single_blog_post_tag', 
            array(
                'type'        => 'checkbox',
                'label'       => 'Tag',
                'priority'    => 10,
                'section'     => 'pixelo_single_blog_post_title_meta_section',
            ) 
        );

        /* Related Post */
        $wp_customize->add_setting( 'pixelo_single_blog_post_related',
            array(
                'sanitize_callback' => array( $this, 'pixelo_sanitize_single_post_related' ),
                'transport'         => 'refresh',
                'default'   => 'hide',
            )
        );

        $wp_customize->add_control( 'pixelo_single_blog_post_related', 
            array(
                'type'        => 'radio',
                'label'       => 'Related Post',
                'priority'    => 10,
                'section'     => 'pixelo_single_blog_post_content_section',
                'choices'           => array(
                    'hide'       => __( 'Hide', 'pixelo' ),
                    'show'      => __( 'Show', 'pixelo' ),
                ),
            ) 
        );

    }



}