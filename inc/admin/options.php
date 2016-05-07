<?php

//$themename = wp_get_theme().'';

if ( !defined('APP_NAME') ) {
	define( 'APP_NAME', get_template() );
}
define( 'BASIC_OPTION_NAME', 'theme_options_' . APP_NAME );

//$themedir = get_template();
//$optionname = 'theme_options_'.$themedir;


/* ==========================================================================
 * 	customize get_option for theme options
 * ========================================================================== */
if ( ! function_exists( 'get_avd_option' ) ) :
function get_avd_option( $key ) {

    $cache = wp_cache_get( 'avd_'. BASIC_OPTION_NAME );
    if ( $cache ) {
		return ( isset($cache[$key]) ) ? $cache[$key] : false;
    }

	$opt = get_option( BASIC_OPTION_NAME );
    wp_cache_add( 'avd_'. BASIC_OPTION_NAME, $opt  );

    return ( isset($opt[$key]) ) ? $opt[$key] : false;
}
endif;
/* ============================================================================= */



/* =============================================================================
 * theme options array with defaults
 * ============================================================================= */
function basic_get_options_list() {

	$avd_options = array(

		// GENERAL
		// .........................................................................
		array(
			"name" => "<a href='#tabgeneral' class='tab-title general' title='" . __( 'General theme options', 'basic' ) . "'><span class='dashicons dashicons-admin-generic'></span><b>" . __( 'General', 'basic' ) . "</b></a>",
			"id"   => "general",
			"type" => "section"
		),
		array(
			"name" => __( "Main color", 'basic' ),
			"desc" => __( "Choose main color", 'basic' ),
			"id"   => "maincolor",
			"std"  => "#936",
			"type" => "color",
		),
 		array(
			"name" => __( "Sidebar", 'basic' ),
			"desc" => __( "Show sidebar on mobile", 'basic' ),
			"id"   => "show_sidebar",
			"std"  => 0,
			"type" => "checkbox",
		),
		array(
			"name"    => __( "Default layout", 'basic' ),
			"desc"    => __( "Default layout for all pages", 'basic' ),
			"id"      => "layout_default",
			"std"     => "rightbar",
			"type"    => "select",
			"options" => array(
				'rightbar' => __( "Rightbar", 'basic' ),
				'leftbar'  => __( "Leftbar", 'basic' ),
				'full'     => __( "Fullwidth Content", 'basic' ),
				'center'   => __( "Centered Content", 'basic' )
			)
		),
		array(
			"name"    => __( "Home layout", 'basic' ),
			"desc"    => "",
			"id"      => "layout_home",
			"std"     => "rightbar",
			"type"    => "select",
			"options" => array(
				'rightbar' => __( "Rightbar", 'basic' ),
				'leftbar'  => __( "Leftbar", 'basic' ),
				'full'     => __( "Fullwidth Content", 'basic' ),
				'center'   => __( "Centered Content", 'basic' )
			)
		),
		array(
			"name"    => __( "Post layout", 'basic' ),
			"desc"    => "",
			"id"      => "layout_post",
			"std"     => "rightbar",
			"type"    => "select",
			"options" => array(
				'rightbar' => __( "Rightbar", 'basic' ),
				'leftbar'  => __( "Leftbar", 'basic' ),
				'full'     => __( "Fullwidth Content", 'basic' ),
				'center'   => __( "Centered Content", 'basic' )
			)
		),
		array(
			"name"    => __( "Pages layout", 'basic' ),
			"desc"    => "",
			"id"      => "layout_page",
			"std"     => "center",
			"type"    => "select",
			"options" => array(
				'rightbar' => __( "Rightbar", 'basic' ),
				'leftbar'  => __( "Leftbar", 'basic' ),
				'full'     => __( "Fullwidth Content", 'basic' ),
				'center'   => __( "Centered Content", 'basic' )
			)
		),
		// CODE
		// .........................................................................
		array(
			"name" => "<a href='#tabcode' class='tab-title code' title='" . __( 'Additional code', 'basic' ) . "'><span class='dashicons dashicons-editor-code'></span><b>" . __( 'Code', 'basic' ) . "</b></a>",
			"id"   => "code",
			"type" => "section"
		),
		array(
			"name" => __( "Scripts in header", 'basic' ),
			"desc" => __( "HTML code in &lt;head&gt; tag", 'basic' ),
			"id"   => "head_scripts",
			"std"  => "<!-- header html from theme option -->",
			"type" => "textarea",
		),
		array(
			"name" => __( "Scripts in site footer", 'basic' ),
			"desc" => __( "HTML code before &lt;/body&gt; tag", 'basic' ),
			"id"   => "footer_scripts",
			"std"  => "<!-- footer html from theme option -->",
			"type" => "textarea",
		),
		array(
			"name" => __( "Custom styles", 'basic' ),
			"desc" => __( "Add your custom CSS styles", 'basic' ),
			"id"   => "custom_styles",
			"std"  => "",
			"type" => "textarea",
		),
		array(
			"name" => __( "Before content", 'basic' ),
			"desc" => __( "Code before single post content", 'basic' ),
			"id"   => "before_content",
			"std"  => "<!-- ". __( "Code before single post content", "basic" ) ." -->",
			"type" => "textarea",
		),
		array(
			"name" => __( "After content", 'basic' ),
			"desc" => __( "Code after single post content", 'basic' ),
			"id"   => "after_content",
			"std"  => "<!-- ". __( "Code after single post content", "basic" ) ." -->",
			"type" => "textarea",
		),
		// SOCIAL
		// .........................................................................
		array(
			"name" => "<a href='#tabsocial' class='tab-title social' title='" . __( 'Social buttons', 'basic' ) . "'><span class='dashicons dashicons-twitter'></span><b>" . __( 'Social', 'basic' ) . "</b></a>",
			"id"   => "social",
			"type" => "section"
		),
		array(
			"name" => __( "Social data", 'basic' ),
			"desc" => __( "Add Open Graph tags to &lt;head&gt;", 'basic' ),
			"id"   => "add_social_meta",
			"std"  => 0,
			"type" => "checkbox",
		),
		array(
			"name"    => __( "Social share buttons", 'basic' ),
			"desc"    => __( "Select option to show or hide social share buttons after post", 'basic' ),
			"id"      => "social_share",
			"std"     => 'hide',
			"type"    => "select",
			"options" => array(
				'hide'    => __( "Hide", 'basic' ),
				'custom'  => __( "Custom theme buttons", 'basic' ),
				'share42' => __( "Share42 Buttons", 'basic' ),
				'yandex'  => __( "Yandex Buttons", 'basic' ),
			),
		),
		// SOCIAL
		// .........................................................................
		array(
			"name" => "<a href='#tabstructureddata' class='tab-title structured-data' title='" . __( 'Structured Data', 'basic' ) . "'><span class='dashicons dashicons-schedule'></span><b>" . __( 'Structured Data', 'basic' ) . "</b></a>",
			"id"   => "structureddata",
			"type" => "section"
		),
		array(
			"name" => __( "Schema.org Mark up", 'basic' ),
			"desc" => __( "Schema.org mark up according Creative Work->Article and Comment", 'basic' ),
			"id"   => "schema_mark",
			"std"  => "0",
			"type" => "checkbox",

		),
		array(
			"name" => __( "Publisher logo", 'basic' ),
			"desc" => __( "use in https://schema.org/Organization", 'basic' ),
			"id"   => "markup_logo",
			"std"  => get_template_directory_uri() . '/img/logo.jpg',
			"type" => "text",
		),
		array(
			"name" => __( "Adress", 'basic' ),
			"desc" => __( "use in https://schema.org/Organization", 'basic' ),
			"id"   => "markup_adress",
			"std"  => "Russia",
			"type" => "text",
		),
		array(
			"name" => __( "Phone", 'basic' ),
			"desc" => __( "use in https://schema.org/Organization", 'basic' ),
			"id"   => "markup_telephone",
			"std"  => "+7 (000) 000-000-00",
			"type" => "text",
		),


	);

	// create defaults array
	$defaults = array();
	foreach ( $avd_options as $val ){
		if( is_array($val) && isset($val['std']) )
			$defaults[ $val['id'] ] = $val['std'];
	}

	add_option( BASIC_OPTION_NAME, $defaults, '', 'yes' );


	return $avd_options;

}
/* ============================================================================= */



/* =============================================================================
 * load settings in admin console only
 * ============================================================================= */
//if ( is_admin() ) :

//// create defaults array
//$defaults = array();
//foreach ( $avd_options as $val ){
//	if( is_array($val) && isset($val['std']) )
//	$defaults[ $val['id'] ] = $val['std'];
//}

// create option in database
//	add_option( $optionname, $defaults, '', 'yes' );


/* -----------------------------------------------------------------------------
 * register options and callback function
 * ----------------------------------------------------------------------------- */
function basic_register_settings() {

	$avd_options = basic_get_options_list();

	// options register
    register_setting( BASIC_OPTION_NAME, BASIC_OPTION_NAME ); //, 'basic_validate_options' );

	$current_section = '';
	foreach ($avd_options as $opt) {
		switch ( $opt['type'] ) {

			// new section
			case "section":
				add_settings_section( 'basic_'.$opt['id'].'_section', $opt['name'], 'basic_display_section', 'basic_options_page' );
				$current_section = 'basic_'.$opt['id'].'_section';
				break;

            // new filelds
			case "text":
			case "textarea":			
			case "checkbox":
				$field_args = array(
					'type'      => $opt['type'],
					'id'        => $opt['id'],
					'name'      => $opt['id'],
					'desc'      => $opt['desc'],
					'std'       => $opt['std'],
					'label_for' => $opt['id'],
					'class'     => 'avd_input avd_text',
				);
				add_settings_field( $opt['id'].'_textbox', $opt['name'], 'basic_display_setting', 'basic_options_page', $current_section, $field_args );
				break;

			// selects
			case "select":
			case "check_select":
			case "multiple_select":
			case "radiogroup":
				$field_args = array(
					'type'      => $opt['type'],
					'id'        => $opt['id'],
					'name'      => $opt['id'],
					'desc'      => $opt['desc'],
					'std'       => $opt['std'],
					'label_for' => $opt['id'],
					'class'     => 'avd_input avd_select',
					'options_list'	=> $opt['options']
				);
				add_settings_field( $opt['id'].'_select', $opt['name'], 'basic_display_setting', 'basic_options_page', $current_section, $field_args );
				break;

			// colorbox
			case "color":
				$field_args = array(
					'type'      => $opt['type'],
					'id'        => $opt['id'],
					'name'      => $opt['id'],
					'desc'      => $opt['desc'],
					'std'       => $opt['std'],
					'label_for' => $opt['id'],
					'class'     => 'avd_input avd_color',
				);
				add_settings_field( $opt['id'].'_color', $opt['name'], 'basic_display_setting', 'basic_options_page', $current_section, $field_args );
				break;
		}
	}
}
add_action( 'admin_init', 'basic_register_settings' );
/* ----------------------------------------------------------------------------- */



/* -----------------------------------------------------------------------------
 * display all options
 * ----------------------------------------------------------------------------- */
function basic_display_setting($args) {
    extract( $args );

    $options = get_option( BASIC_OPTION_NAME );

    switch ( $type ) {

		case 'text':
			$options[$id] = ( isset($options[$id]) ) ? esc_attr(stripslashes($options[$id])) : $std;
			echo "<input class='regular-text $class' type='text' id='$id' name='" . BASIC_OPTION_NAME . "[$id]' value='$options[$id]' />";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
			break;

		case 'textarea':
			$options[$id] = ( isset($options[$id]) ) ? esc_attr(stripslashes($options[$id])) : $std;
			echo "<textarea class='regular-text $class' type='textarea' id='$id' name='" . BASIC_OPTION_NAME . "[$id]' cols='40' rows='5' >" . $options[$id] . "</textarea>";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
			break;

        case 'select':
			$options[$id] = ( isset($options[$id]) ) ? esc_attr(stripslashes($options[$id])) : $std;
			echo "<select name='" . BASIC_OPTION_NAME . "[$id]' class='$class' id='$id' />";
			foreach ( $options_list as $val => $title ) {
				$sel = ( $val == $options[$id] ) ? " selected='selected'" : "";
				echo "<option$sel value=\"$val\">$title</option>";
			}
			echo "</select>";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
			break;

		case 'multiple_select':
			$options[$id] = ( isset($options[$id]) ) ? $options[$id] : $std;
			echo "<select multiple name='" . BASIC_OPTION_NAME . "[$id][]' class='$class' id='$id' />";
			foreach ( $options_list as $val => $title ) {
				$sel = ( in_array($val, $options[$id]) ) ? " selected='selected'" : "";
				echo "<option$sel value=\"$val\">$title</option>";
			}
			echo "</select>";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
			break;

		case 'checkbox':
			$options[$id] = ( isset($options[$id]) ) ? esc_attr(stripslashes($options[$id])) : $std;
			$checked = ( $options[$id] ) ? "checked='checked'" : "";
			echo "<label for='$id'><input type='checkbox' name='". BASIC_OPTION_NAME ."[$id]' id='$id' value='true' $checked class='$class' /> $desc</label>";
			break;

		case 'check_select':
			$options[$id] = ( isset($options[$id]) ) ? $options[$id] : $std;
			echo "<div class='checkbox_group'>";
			$cnt = 1;
			foreach ( $options_list as $val => $title ) {
				$checked = ( in_array($val, $options[$id]) ) ? "checked='checked'" : "";
				echo "<label for='". BASIC_OPTION_NAME ."[$id]-$cnt' ><input type='checkbox' name='". BASIC_OPTION_NAME ."[$id][]' value='$val' id='". BASIC_OPTION_NAME ."[$id]-$cnt' $checked class='$class' />$title</label>";
				$cnt++;
			}
			echo "</div>";
			echo ($desc != '') ? "<span class='description'>$desc</span>" : "";
			break;

		case 'radiogroup':
			$options[$id] = ( isset($options[$id]) ) ? esc_attr(stripslashes($options[$id])) : $std;
			echo "<div class='radio_group'>";
			$cnt = 1;
			foreach ( $options_list as $val => $title ) {
				$checked = ( $val == $options[$id] ) ? "checked='checked'" : "";
				echo "<label for='". BASIC_OPTION_NAME ."[$id]-$cnt' ><input type='radio' name='". BASIC_OPTION_NAME ."[$id]' value='$val' id='". BASIC_OPTION_NAME ."[$id]-$cnt' $checked class='$class' />$title</label>";
				$cnt++;
			}
			echo "</div>";
			echo ($desc != '') ? "<span class='description'>$desc</span>" : "";
			break;

		case 'color':
			$options[$id] = ( isset($options[$id]) ) ? esc_attr(stripslashes($options[$id])) : $std;
			echo "<div class=\"farb-popup-wrapper\">";
			echo "<input class='$class popup-colorpicker' type='text' id='$id' name='" . BASIC_OPTION_NAME . "[$id]' value='$options[$id]' />";
			echo "<div id='".$id."picker' class='color-picker'></div>";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span></div>" : "</div>";
			break;

    }
}
/* ----------------------------------------------------------------------------- */



/* -----------------------------------------------------------------------------
 * section description
 * ----------------------------------------------------------------------------- */
function basic_display_section($section){
 
 	echo '<!-- new section -->';

}
/* ----------------------------------------------------------------------------- */




/* -----------------------------------------------------------------------------
 * add options page in console
 * ----------------------------------------------------------------------------- */
function basic_options_menu() {

	$hook_suffix = add_theme_page( __("Theme options", 'basic'), __("Theme options", 'basic'),
		'manage_options', 'basic_options_page', 'basic_options_func'
	);
    add_action( "admin_print_scripts-$hook_suffix", 'basic_admin_print_scripts' );
    add_action( "admin_footer-$hook_suffix", 'basic_admin_print_postboxes' );
}
add_action( 'admin_menu', 'basic_options_menu' );

function basic_admin_print_postboxes(){
	echo '<script>jQuery(document).ready(function(){ postboxes.add_postbox_toggles(pagenow); });</script>';
}

/* ----------------------------------------------------------------------------- */



/* -----------------------------------------------------------------------------
 * load scripts & styles in options page
 * ----------------------------------------------------------------------------- */
function basic_admin_print_scripts(){
	$dir = get_template_directory_uri();

    wp_enqueue_style( 'farbtastic' );
	wp_enqueue_style( 'basic-style', get_template_directory_uri() . '/inc/admin/themeoptions.css' );

    wp_enqueue_script( 'postbox' );
    wp_enqueue_script( 'farbtastic' );
	wp_enqueue_script( 'media-upload' );
	wp_enqueue_script( 'basic-script', get_template_directory_uri() . '/inc/admin/themeoptions.js', array('jquery', 'farbtastic', 'media-upload'));
}
/* ----------------------------------------------------------------------------- */



/* -----------------------------------------------------------------------------
 * create option page
 * ----------------------------------------------------------------------------- */
function basic_options_func() {

//	$opt = get_option( BASIC_OPTION_NAME );
?>

<div id="themeoptions" class="wrap" style="width:98%;">
	<h2><?php _e("Theme options", 'basic') ?></h2>

	<?php
	if ( isset( $_REQUEST['settings-updated'] ) && false !== $_REQUEST['settings-updated'] ) :
		echo '<div class="updated fade"><p><strong>'. __( 'Options saved', 'basic' ) .'</strong></p></div>';
	endif;
	?>

	<form method="post" action="options.php">

	<?php
		settings_fields( BASIC_OPTION_NAME );
		do_settings_sections( 'basic_options_page' );
		submit_button();
	?>

	</form>
</div>
<?php
}
/* ----------------------------------------------------------------------------- */




/* -----------------------------------------------------------------------------
 * validate option values
 * ----------------------------------------------------------------------------- */
function basic_validate_options( $input ) {
//	global $avd_options;

	/*foreach ($input as $key => $val) {
		$newinput[$key] = trim($val);

		// Check the input is a letter or a number
		if ( !preg_match('/^[A-Z0-9 _]*$/i', $val) ) {
			$newinput[$key] = '';
		}
	}

	return $newinput;  */


  	//$settings = get_option( 'avd_options', $def_options );

	// We strip all tags from the text field, to avoid vulnerablilties like XSS
	/*foreach ($avd_options as $value) {
		switch ( $value['type'] ) {
			case "text":
				$input[ $value['id'] ] = wp_filter_nohtml_kses( $value['id'] );
				//$links = $links . '<a href="#'.$value['id'].'">' . $value['name'] . '</a>';
				break;
		}
	} */
	/*$input['slide_posts'] = wp_filter_nohtml_kses( $input['slide_posts'] );
	$input['related_posts'] = wp_filter_nohtml_kses( $input['related_posts'] );
	$input['rss'] = wp_filter_nohtml_kses( $input['rss'] );
	$input['tw'] = wp_filter_nohtml_kses( $input['tw'] );
	$input['fb'] = wp_filter_nohtml_kses( $input['fb'] );
	$input['gp'] = wp_filter_nohtml_kses( $input['gp'] );
	$input['vk'] = wp_filter_nohtml_kses( $input['vk'] );    */

	// We strip all tags from the text field, to avoid vulnerablilties like XSS
	/*$input['ad_code'] = wp_filter_post_kses( $input['ad_code'] );*/

/*	// We select the previous value of the field, to restore it in case an invalid entry has been given
	$prev = $settings['featured_cat'];
	// We verify if the given value exists in the categories array
	if ( !array_key_exists( $input['featured_cat'], $avd_categories ) )
		$input['featured_cat'] = $prev;

	// We select the previous value of the field, to restore it in case an invalid entry has been given
	$prev = $settings['layout_view'];
	// We verify if the given value exists in the layouts array
	if ( !array_key_exists( $input['layout_view'], $avd_layouts ) )
		$input['layout_view'] = $prev;

	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['author_credits'] ) )
		$input['author_credits'] = basic;
	// We verify if the input is a boolean value
	$input['author_credits'] = ( $input['author_credits'] == 1 ? 1 : 0 );       */

	//return $input;
}

// -----------------------------------------------------------------------------


/* ============================================================================= */
//endif;

