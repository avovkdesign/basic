<?php


/* ==========================================================================
 *  customizer settings init
 * ========================================================================== */
function basic_customizer_init( $wp_customize ) {

	$transport = 'postMessage'; // для обновления не перегружая страницу


	/* --------------  S I T E   T I T L E   ---------------- */

	// rename title setting
	$wp_customize->get_section( 'title_tagline' )->title = __( 'Site title', 'basic' );
	$wp_customize->remove_control( 'display_header_text' );

	// ----

	if ( class_exists( 'Group_Title_Control' ) ) {
		$wp_customize->add_setting( 'site_title_group', array(
			'default' => '',
			'sanitize_callback' => 'sanitize_key'
		));
		$wp_customize->add_control( new Group_Title_Control( $wp_customize, 'site_title_group', array(
			'label'       => __( 'Site title', 'basic' ),
			'section'     => 'title_tagline',
			'priority'    => 10,
			'settings'    => 'site_title_group',
		) ) );
	}

	// change title setting transport
	$wp_customize->get_setting( 'blogname' )->transport = $transport;
	$wp_customize->get_control( 'blogname' )->priority  = 11;

	$wp_customize->get_setting( 'header_textcolor' )->transport = $transport;
	$wp_customize->get_control( 'header_textcolor' )->section   = 'title_tagline';
	$wp_customize->get_control( 'header_textcolor' )->priority  = 11;

	// ----

	if ( class_exists( 'Group_Title_Control' ) ) {
		$wp_customize->add_setting( 'blogdescription_title', array(
			'default' => '',
			'sanitize_callback' => 'sanitize_key',
		));
		$wp_customize->add_control( new Group_Title_Control( $wp_customize, 'blogdescription_title', array(
			'label'       => __( 'Description', 'basic' ),
			'section'     => 'title_tagline',
			'priority'    => 12,
			'settings'    => 'blogdescription_title',
		) ) );
	}

	$wp_customize->get_setting( 'blogdescription' )->transport = $transport;
	$wp_customize->get_control( 'blogdescription' )->section   = 'title_tagline';
	$wp_customize->get_control( 'blogdescription' )->priority  = 13;

	// ---

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[title_position]',
		array(
			'type'      => 'option',
			'default'   => 'left',
			'sanitize_callback' => 'sanitize_key',
			'transport' => $transport
		)
	);
	$wp_customize->add_control( 'title_position_control',
		array(
			'settings' => BASIC_OPTION_NAME . '[title_position]',
			'label'    => __( "Title position", 'basic' ),
			'section'  => 'title_tagline',
			'type'     => 'select',
			'choices'  => array(
				'left'   => __( "Left", 'basic' ),
				'right'  => __( "Right", 'basic' ),
				'center' => __( "Center", 'basic' )
			),
			'priority' => 11,
		)
	);

	// ---

	// site descriptions
	$wp_customize->add_setting( BASIC_OPTION_NAME . '[showsitedesc]', array(
		'type'      => 'option',
		'default'   => 1,
		'sanitize_callback' => 'sanitize_key',
		'transport' => $transport
	) );
	$wp_customize->add_control( 'showsitedesc_control',
		array(
			'label'    => __( 'Show site description', 'basic' ),
			'settings' => BASIC_OPTION_NAME . '[showsitedesc]',
			'section'  => 'title_tagline',
			'type'     => 'checkbox',
			'priority' => 21,
		)
	);

	// ----

	if ( class_exists( 'Group_Title_Control' ) ) {
		$wp_customize->add_setting( 'other_title', array(
			'default' => '',
			'sanitize_callback' => 'sanitize_key',
		));
		$wp_customize->add_control( new Group_Title_Control( $wp_customize, 'other_title', array(
			'label'       => __( 'Other', 'basic' ),
			'section'     => 'title_tagline',
			'priority'    => 22,
			'settings'    => 'other_title',
		) ) );
	}


	/*----------  H E A D E R    I M A G E   ----------*/

	$wp_customize->get_section( 'header_image' )->title    = __( 'Header', 'basic' );
	$wp_customize->get_section( 'header_image' )->priority = 30;

	// ---

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[fix_header_height]',
		array(
			'type'      => 'option',
			'default'   => 1,
			'sanitize_callback' => 'sanitize_key',
			'transport' => $transport
		)
	);
	$wp_customize->add_control( 'fix_header_height_control',
		array(
			'settings' => BASIC_OPTION_NAME . '[fix_header_height]',
			'label'    => __( "Set header height as background image size", 'basic' ),
			'section'  => 'header_image',
			'type'     => 'checkbox',
		)
	);
	// ---

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[header_image_repeat]',
		array(
			'type'      => 'option',
			'default'   => 'no-repeat',
			'sanitize_callback' => 'sanitize_key',
			'transport' => $transport
		)
	);
	$wp_customize->add_control( 'header_image_repeat_control',
		array(
			'settings' => BASIC_OPTION_NAME . '[header_image_repeat]',
			'label'    => __( "Image repeat", 'basic' ),
			'section'  => 'header_image',
			'type'     => 'radio',
			'choices'  => array(
				'no-repeat' => __( "No repeat", 'basic' ),
				'repeat-x'  => __( "Repeat", 'basic' ),
			),
		)
	);


	/*----------  C O L O R S   &&   B A C K G R O U N D  ----------*/

	$wp_customize->get_section( 'background_image' )->title = __( 'Background', 'basic' );

	$wp_customize->get_control( 'background_color' )->priority = 30;
	$wp_customize->get_control( 'background_image' )->priority = 30;

	$wp_customize->get_control( 'background_color' )->section = 'background_image';
	$wp_customize->remove_section( 'colors' );


	/*----------  L A Y O U T   ----------*/

	// content custom section
	$wp_customize->add_section(
		'layout',
		array(
			'title'       => __( 'Design', 'basic' ),
			'priority'    => 80,
			'description' => __( 'Main theme options', 'basic' )
		)
	);

	// ----

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[maincolor]',
		array(
			'type'      => 'option',
			'default'   => '#936',
			'priority'  => 10,
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => $transport
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		BASIC_OPTION_NAME . '[maincolor]',
		array(
			'label'       => __( "Main color", 'basic' ),
			'description' => __( "Choose main color", 'basic' ),
			'section'     => 'layout',
			'settings'    => BASIC_OPTION_NAME . '[maincolor]',
		)
	) );

	// ----

	if ( class_exists( 'Group_Title_Control' ) ) {
		$wp_customize->add_setting( 'layout_title', array(
			'default' => '',
			'sanitize_callback' => 'sanitize_key',
		));
		$wp_customize->add_control( new Group_Title_Control( $wp_customize, 'layout_title', array(
			'label'       => __( 'Layout', 'basic' ),
			'description' => __( 'Set up layout for site pages', 'basic' ),
			'section'     => 'layout',
			'settings'    => 'layout_title',
		) ) );
	}

	// ----

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[show_sidebar]',
		array(
			'type'      => 'option',
			'default'   => '0',
			'sanitize_callback' => 'sanitize_key',
			'transport' => $transport
		)
	);
	$wp_customize->add_control( 'show_sidebar_control',
		array(
			'settings' => BASIC_OPTION_NAME . '[show_sidebar]',
			'label'    => __( "Show sidebar on mobile", 'basic' ),
			'section'  => 'layout',
			'type'     => 'checkbox',
		)
	);

	// ----

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[layout_home]',
		array(
			'type'      => 'option',
			'default'   => 'rightbar',
			'sanitize_callback' => 'sanitize_key',
			'transport' => $transport
		)
	);
	$wp_customize->add_control( 'layout_home_control',
		array(
			'settings'        => BASIC_OPTION_NAME . '[layout_home]',
			'label'           => __( "Layout on Home", 'basic' ),
			'section'         => 'layout',
			'active_callback' => 'is_home',
			'type'            => 'select',
			'choices'         => array(
				'rightbar' => __( "Rightbar", 'basic' ),
				'leftbar'  => __( "Leftbar", 'basic' ),
				'full'     => __( "Fullwidth Content", 'basic' ),
				'center'   => __( "Centered Content", 'basic' )
			),
		)
	);

	// ----

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[layout_post]',
		array(
			'type'      => 'option',
			'default'   => 'rightbar',
			'sanitize_callback' => 'sanitize_key',
			'transport' => $transport
		)
	);
	$wp_customize->add_control( 'layout_post_control',
		array(
			'settings'        => BASIC_OPTION_NAME . '[layout_post]',
			'label'           => __( "Layout on Post", 'basic' ),
			'section'         => 'layout',
			'active_callback' => 'callback_single',
			'type'            => 'select',
			'choices'         => array(
				'rightbar' => __( "Rightbar", 'basic' ),
				'leftbar'  => __( "Leftbar", 'basic' ),
				'full'     => __( "Fullwidth Content", 'basic' ),
				'center'   => __( "Centered Content", 'basic' )
			),
		)
	);

	// ----

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[layout_page]',
		array(
			'type'      => 'option',
			'default'   => 'center',
			'sanitize_callback' => 'sanitize_key',
			'transport' => $transport
		)
	);
	$wp_customize->add_control( 'layout_page_control',
		array(
			'settings'        => BASIC_OPTION_NAME . '[layout_page]',
			'label'           => __( "Layout on Page", 'basic' ),
			'section'         => 'layout',
			'active_callback' => 'callback_page',
			'type'            => 'select',
			'choices'         => array(
				'rightbar' => __( "Rightbar", 'basic' ),
				'leftbar'  => __( "Leftbar", 'basic' ),
				'full'     => __( "Fullwidth Content", 'basic' ),
				'center'   => __( "Centered Content", 'basic' )
			),
		)
	);

	// ----

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[layout_default]',
		array(
			'type'      => 'option',
			'default'   => 'rightbar',
			'sanitize_callback' => 'sanitize_key',
			'transport' => $transport
		)
	);
	$wp_customize->add_control( 'layout_default_control',
		array(
			'settings'        => BASIC_OPTION_NAME . '[layout_default]',
			'label'           => __( "Global layout", 'basic' ),
			'description'     => __( "It used when individual page layout not set", 'basic' ),
			'section'         => 'layout',
			'type'            => 'select',
			'active_callback' => 'callback_default_layout',
			'choices'         => array(
				'rightbar' => __( "Rightbar", 'basic' ),
				'leftbar'  => __( "Leftbar", 'basic' ),
				'full'     => __( "Fullwidth Content", 'basic' ),
				'center'   => __( "Centered Content", 'basic' )
			),
		)
	);


	// -------  S O C I A L ------------------------------------------------------------------

	$wp_customize->add_section(
		'social',
		array(
			'title'           => __( 'Social', 'basic' ),
			'description'     => __( 'Social buttons', 'basic' ),
			'priority'        => 81,
			'active_callback' => 'callback_singular'
		)
	);

	// ----

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[add_social_meta]',
		array(
			'type'      => 'option',
			'default'   => '0',
			'sanitize_callback' => 'sanitize_key',
			'transport' => $transport
		)
	);
	$wp_customize->add_control( 'add_social_meta_control',
		array(
			'settings' => BASIC_OPTION_NAME . '[add_social_meta]',
			'label'    => __( "Add Open Graph tags to &lt;head&gt;", 'basic' ),
			'section'  => 'social',
			'type'     => 'checkbox',
		)
	);


	// ----

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[social_share]',
		array(
			'type'      => 'option',
			'default'   => 'custom',
			'sanitize_callback' => 'sanitize_key',
			'transport' => 'refresh'//$transport
		)
	);
	$wp_customize->add_control( 'social_share_control',
		array(
			'settings' => BASIC_OPTION_NAME . '[social_share]',
			'label'    => __( "Social share buttons after post", 'basic' ),
			'section'  => 'social',
			'type'     => 'select',
			'choices'  => array(
				'hide'    => __( "Hide", 'basic' ),
				'custom'  => __( "Custom theme buttons", 'basic' ),
				'share42' => __( "Share42 Buttons", 'basic' ),
				'yandex'  => __( "Yandex Buttons", 'basic' ),
			),
		)
	);


	// -----

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[title_before_socshare]',
		array(
			'type'              => 'option',
			'default'           => '',
			'sanitize_callback' => 'basic_sanitize_text',
			'transport'         => $transport
		)
	);
	$wp_customize->add_control( 'title_before_socshare_control',
		array(
			'settings' => BASIC_OPTION_NAME . '[title_before_socshare]',
			'label'    => __( "Custom text before share buttons", 'basic' ),
			'section'  => 'social',
			'type'     => 'text',
		)
	);


	// --------  S T U C T U R E D   D A T A   --------------------------------------------------

	$wp_customize->add_section(
		'structured_data',
		array(
			'title'           => __( 'Structured Data', 'basic' ),
			'priority'        => 82,
			'active_callback' => 'callback_singular'
		)
	);

	// ----

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[schema_mark]',
		array(
			'type'      => 'option',
			'default'   => '0',
			'sanitize_callback' => 'sanitize_key',
			'transport' => $transport
		)
	);
	$wp_customize->add_control( 'schema_mark_control',
		array(
			'settings' => BASIC_OPTION_NAME . '[schema_mark]',
			'label'    => __( "Enable Schema.org mark up according CreativeWork->Article and Comment", 'basic' ),
			'section'  => 'structured_data',
			'type'     => 'checkbox',
		)
	);

	// ----

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[markup_telephone]',
		array(
			'type'              => 'option',
			'default'           => '+7 (000) 000-000-00',
			'sanitize_callback' => 'basic_sanitize_text',
			'transport'         => $transport
		)
	);
	$wp_customize->add_control( 'markup_telephone_control',
		array(
			'settings'    => BASIC_OPTION_NAME . '[markup_telephone]',
			'label'       => __( "Phone", 'basic' ),
			'description' => __( "use in https://schema.org/Organization", 'basic' ),
			'section'     => 'structured_data',
			'type'        => 'text',
		)
	);

	// ----

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[markup_adress]',
		array(
			'type'              => 'option',
			'default'           => 'Russia',
			'sanitize_callback' => 'basic_sanitize_text',
			'transport'         => $transport
		)
	);
	$wp_customize->add_control( 'markup_adress_control',
		array(
			'settings'    => BASIC_OPTION_NAME . '[markup_adress]',
			'label'       => __( "Adress", 'basic' ),
			'description' => __( "use in https://schema.org/Organization", 'basic' ),
			'section'     => 'structured_data',
			'type'        => 'text',
		)
	);


	// ----

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[markup_logo]',
		array(
			'type'      => 'option',
			'default'   => get_template_directory_uri() . '/img/logo.jpg',
			'sanitize_callback' => 'esc_url_raw',
			'transport' => $transport
		)
	);
	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'markup_logo_control',
		array(
			'settings'    => BASIC_OPTION_NAME . '[markup_logo]',
			'label'       => __( 'Publisher logo', 'basic' ),
			'description' => __( "use in https://schema.org/Organization", 'basic' ),
			'section'     => 'structured_data',
		)
	) );


	// --------  C U S T O M   C O D E S  --------------------------------------------------

	$wp_customize->add_section(
		'custom_code',
		array(
			'title'       => __( 'Custom codes', 'basic' ),
			'description' => __( 'It help you setup custom scripts and styles', 'basic' ),
			'priority'    => 91,
		)
	);

	// ----

	if ( class_exists( 'Group_Title_Control' ) ) {
		$wp_customize->add_setting( 'single_code_title', array(
			'default' => '',
			'sanitize_callback' => 'sanitize_key',
		));
		$wp_customize->add_control( new Group_Title_Control( $wp_customize, 'single_code_title', array(
			'label'           => __( 'Singular pages', 'basic' ),
			'section'         => 'custom_code',
			'settings'        => 'single_code_title',
			'active_callback' => 'callback_singular',
		) ) );
	}

	// ----

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[before_content]',
		array(
			'type'              => 'option',
			'default'           => "<!-- " . __( "Code before single post content", "basic" ) . " -->",
			'sanitize_callback' => 'basic_sanitize_html',
			'transport'         => $transport
		)
	);
	$wp_customize->add_control( 'before_content_control',
		array(
			'settings'        => BASIC_OPTION_NAME . '[before_content]',
			'label'           => __( "Before content", 'basic' ),
			'description'     => __( "Code before single post content", 'basic' ),
			'section'         => 'custom_code',
			'type'            => 'textarea',
			'active_callback' => 'callback_singular',
		)
	);

	// ----

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[after_content]',
		array(
			'type'              => 'option',
			'default'           => "<!-- " . __( "Code after single post content", "basic" ) . " -->",
			'sanitize_callback' => 'basic_sanitize_html',
			'transport'         => $transport
		)
	);
	$wp_customize->add_control( 'after_content_control',
		array(
			'settings'        => BASIC_OPTION_NAME . '[after_content]',
			'label'           => __( "After content", 'basic' ),
			'description'     => __( "Code after single post content", 'basic' ),
			'section'         => 'custom_code',
			'type'            => 'textarea',
			'active_callback' => 'callback_singular',
		)
	);


	// ----

	if ( class_exists( 'Group_Title_Control' ) ) {
		$wp_customize->add_setting( 'global_code_title', array(
			'default' => '',
			'sanitize_callback' => 'sanitize_key',
		));
		$wp_customize->add_control( new Group_Title_Control( $wp_customize, 'global_code_title', array(
			'label'    => __( 'Global settings', 'basic' ),
			'section'  => 'custom_code',
			'settings' => 'global_code_title',
		) ) );
	}

	// ----

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[head_scripts]',
		array(
			'type'              => 'option',
			'default'           => '<!-- header html from theme option -->',
			'sanitize_callback' => 'basic_sanitize_html',
			'transport'         => 'refresh'//$transport
		)
	);
	$wp_customize->add_control( 'head_scripts_control',
		array(
			'settings'    => BASIC_OPTION_NAME . '[head_scripts]',
			'label'       => __( "Scripts in header", 'basic' ),
			'description' => __( "HTML code in &lt;head&gt; tag", 'basic' ),
			'section'     => 'custom_code',
			'type'        => 'textarea',
		)
	);

	// ----

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[footer_scripts]',
		array(
			'type'              => 'option',
			'default'           => '<!-- footer html from theme option -->',
			'sanitize_callback' => 'basic_sanitize_html',
			'transport'         => 'refresh'//$transport
		)
	);
	$wp_customize->add_control( 'footer_scripts_control',
		array(
			'settings'    => BASIC_OPTION_NAME . '[footer_scripts]',
			'label'       => __( "Scripts in site footer", 'basic' ),
			'description' => __( "HTML code before &lt;/body&gt; tag", 'basic' ),
			'section'     => 'custom_code',
			'type'        => 'textarea',
		)
	);


	// ----

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[custom_styles]',
		array(
			'type'              => 'option',
			'default'           => '',
			'sanitize_callback' => 'basic_sanitize_textarea',
			'transport'         => $transport
		)
	);
	$wp_customize->add_control( 'custom_styles_control',
		array(
			'settings'    => BASIC_OPTION_NAME . '[custom_styles]',
			'label'       => __( "Custom styles", 'basic' ),
			'description' => __( "Add your custom CSS styles", 'basic' ),
			'section'     => 'custom_code',
			'type'        => 'textarea',
		)
	);


	// ----------  F O O T E R  ----------


	$wp_customize->add_section(
		'footer_text',
		array(
			'title'       => __( 'Footer', 'basic' ),
			'description' => __( 'Customize footer', 'basic' ),
			'priority'    => 92,
		)
	);

	// ----

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[copyright_text]',
		array(
			'type'              => 'option',
			'default'           => __( 'All rights reserved', 'basic' ),
			'sanitize_callback' => 'basic_sanitize_text',
			'transport'         => $transport
		)
	);
	$wp_customize->add_control( 'copyright_text_control',
		array(
			'settings' => BASIC_OPTION_NAME . '[copyright_text]',
			'label'    => __( "Copyright text", 'basic' ),
			'section'  => 'footer_text',
			'type'     => 'text',
		)
	);

	// ----

	$wp_customize->add_setting(
		BASIC_OPTION_NAME . '[footer_counters]',
		array(
			'type'              => 'option',
			'default'           => '',
			'sanitize_callback' => 'basic_sanitize_html',
			'transport'         => $transport
		)
	);
	$wp_customize->add_control( 'footer_counters_control',
		array(
			'settings' => BASIC_OPTION_NAME . '[footer_counters]',
			'label'    => __( "Counters code", 'basic' ),
			'section'  => 'footer_text',
			'type'     => 'textarea',
		)
	);

}

add_action( 'customize_register', 'basic_customizer_init' );
