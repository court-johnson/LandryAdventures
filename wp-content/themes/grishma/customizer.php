    <?php
    /**
     * Theme options via the Customizer.
     *
     * @package grishma
     * @since grishma 1.0
     */

    // ------------- Theme Customizer  ------------- //

    add_action( 'customize_register', 'grishma_customizer_register' );

    function grishma_customizer_register( $wp_customize ) {

        class grishma_Customize_Textarea_Control extends WP_Customize_Control {
            public $type = 'textarea';

            public function render_content() {
                ?>
                <label>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
                </label>
                <?php
            }
        }

        //General Theme Options

        $wp_customize->add_section( 'grishma_customizer_basic', array(
            'title'       => __( 'Theme Options', 'grishma' ),
            'description' => __( 'Add your logo and social media links below.', 'grishma' ),
            'priority'    => 1
        ) );

        //Logo Image
        $wp_customize->add_setting( 'grishma_customizer_logo', array(
            'sanitize_callback'	=> 'esc_attr',

        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'grishma_customizer_logo', array(
            'label'    => __( 'Logo Upload', 'grishma' ),
            'section'  => 'grishma_customizer_basic',
            'settings' => 'grishma_customizer_logo',
            'priority' => 1
        ) ) );

        //Excerpt Slider
        $wp_customize->add_setting( 'grishma_customizer_slider_disable', array(
            'default'    => 'enable',
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'sanitize_callback'	=> 'esc_attr',
        ) );

        $wp_customize->add_control( 'grishma_slider_select_box', array(
            'settings' => 'grishma_customizer_slider_disable',
            'label'    => __( 'Homepage Excerpt Slider', 'grishma' ),
            'section'  => 'grishma_customizer_basic',
            'type'     => 'select',
            'choices'  => array(
                'enable'  => __( 'Enable', 'grishma' ),
                'disable' => __( 'Disable', 'grishma' ),
                ),
            'priority' => 6
        ) );

        //Custom CSS
        $wp_customize->add_setting( 'grishma_customizer_css', array(
            'default' 	=> '',
            'sanitize_callback'	=> 'esc_attr',
        ) );

        $wp_customize->add_control( new grishma_Customize_Textarea_Control( $wp_customize, 'grishma_customizer_css', array(
            'label'   	=> __( 'Custom CSS', 'grishma' ),
            'section' 	=> 'grishma_customizer_basic',
            'settings'  => 'grishma_customizer_css',
        ) ) );


    }
    /*
    * Adding a section to manage social links
    */
    function grishma_sociallink_customizer( $wp_customize ) {
        $wp_customize->add_section( 'grishma_social_section' , array(
            'title' => __( 'Social Links', 'grishma' ),
            'priority' => 30,
            'description' => 'Add social links to website',

        ) );

        $wp_customize->add_setting( 'grishma_facebook', array(
            'sanitize_callback'	=> 'esc_attr',

        ) );
        $wp_customize->add_setting( 'grishma_twitter', array(
            'sanitize_callback'	=> 'esc_attr',

        ) );
        $wp_customize->add_setting( 'grishma_googleplus', array(
            'sanitize_callback'	=> 'esc_attr',

        ) );

        $wp_customize->add_setting( 'grishma_pinterest', array(
            'sanitize_callback'	=> 'esc_attr',

        ) );

        $wp_customize->add_setting( 'grishma_linkedin', array(
            'sanitize_callback'	=> 'esc_attr',

        ) );


        $wp_customize->add_control( 'facebook', array(
            'type' => 'url',
            'label' => __( 'Facebook', 'grishma' ),
            'section' => 'grishma_social_section',
            'settings' => 'grishma_facebook',
        ) );
        $wp_customize->add_control( 'twitter', array(
            'type' => 'url',
            'label' => __( 'Twitter', 'grishma' ),
            'section' => 'grishma_social_section',
            'settings' => 'grishma_twitter',
        ) );
        $wp_customize->add_control( 'googleplus', array(
            'type' => 'url',
            'label' => __( 'Google Plus', 'grishma' ),
            'section' => 'grishma_social_section',
            'settings' => 'grishma_googleplus',
        ) );
        $wp_customize->add_control( 'linkedin', array(
            'type' => 'url',
            'label' => __( 'Linkedin', 'grishma' ),
            'section' => 'grishma_social_section',
            'settings' => 'grishma_linkedin',
        ) );
        $wp_customize->add_control( 'pinterest', array(
            'type' => 'url',
            'label' => __( 'Pinterest', 'grishma' ),
            'section' => 'grishma_social_section',
            'settings' => 'grishma_pinterest',
        ) );
    }
    add_action('customize_register', 'grishma_sociallink_customizer');
