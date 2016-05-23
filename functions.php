<?php



/* ==========================================================================
 *  Theme settings
 * ========================================================================== */
if ( ! function_exists( 'basic_setup' ) ) :
function basic_setup() {

	if ( ! isset( $content_width ) )
		$content_width = 725;

	load_theme_textdomain( 'basic', get_template_directory() . '/languages' );
	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
	
	add_theme_support( 'custom-background', apply_filters( 'basic_custom_background_args', array('default-color' => 'ffffff') ) );
	add_theme_support( 'custom-header', array(
//		'width'         => 1160,
		'width'         => 1080,
		'height'        => 190,
		'flex-height'            => true,
//		'flex-width'             => false,
	) );
	
	register_nav_menus( array(
		'top' 	 => __( 'Main Menu',   'basic' ),
		'bottom' => __( 'Footer Menu', 'basic' )
	) );

}
endif;
add_action( 'after_setup_theme', 'basic_setup' );
/* ========================================================================== */



/* ==========================================================================
 *  Load scripts and styles
 * ========================================================================== */
if ( ! function_exists( 'basic_enqueue_style_and_script' ) ) :
function basic_enqueue_style_and_script() {
	
	global $post, $wp_query;

	// STYLES
	wp_enqueue_style( 'basic-fonts', '//fonts.googleapis.com/css?family=PT+Serif:400,700|Open+Sans:400,400italic,700,700italic&amp;subset=latin,cyrillic', array(), true );
	wp_enqueue_style( 'basic-style', get_stylesheet_uri(), array(), true);

	// SCRIPTS
	wp_deregister_script( 'jquery-core' );
	wp_register_script( 'jquery-core', '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', false, true);
	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'basic-scripts', get_template_directory_uri() . '/js/functions.js', array('jquery'), true, true );

	if ( is_singular() ) {
		$socbtns = basic_get_theme_option('social_share');

		if ( 'share42' == $socbtns )
			wp_enqueue_script( 'basic-share42', get_template_directory_uri() . '/js/share42.min.js', array('jquery'), true, true );

		if ( 'yandex' == $socbtns ) {
			wp_enqueue_script( 'basic-yandexshare', '//yastatic.net/share2/share.js', array(), true, true );
		}

		if ( comments_open() && get_option('thread_comments') ) {
			wp_enqueue_script( 'comment-reply', false, true, true );
		}
	}

}
endif;
add_action( 'wp_enqueue_scripts', 'basic_enqueue_style_and_script' );
/* ========================================================================== */


/* ==========================================================================
 *  admin area
 * ========================================================================== */
function basic_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'admin_init', 'basic_editor_styles' );
/* ========================================================================== */



/* ==========================================================================
 *  Register widget area
 * ========================================================================== */
function basic_widgets_init() {
	
	register_sidebar(array(
		'name' => __('Sidebar', 'basic'),
		'id' => 'sidebar',
		'description' => __( 'Add widgets here to appear in your sidebar.', 'basic' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<p class="wtitle">',
		'after_title' => '</p>',
	));	

}
add_action( 'widgets_init', 'basic_widgets_init' );



/* ==========================================================================
 *  Add Open Graph meta for singular pages
 * ========================================================================== */
function basic_add_social($content) {
	global $post;

	if ( is_singular() && basic_get_theme_option('add_social_meta') ) {
		
		$aiod = get_post_meta($post->ID, '_aioseop_description', true);
		$descr = (isset($aiod)) ? esc_html($aiod) : $post->post_excerpt;
		
		$title = get_the_title();
		$url = get_the_permalink();
		$blogname = get_bloginfo('name');
		$img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail', false ); 

		echo <<<EOT
		
<!-- BEGIN social meta -->
<meta property="og:type" content="article"/>
<meta property="og:title" content="$title"/>
<meta property="og:description" content="$descr" />
<meta property="og:image" content="$img[0]"/>
<meta property="og:url" content="$url"/>
<meta property="og:site_name" content="$blogname"/>
<link rel="image_src" href="$img[0]" />
<!-- END social meta -->


EOT;
	}
}
add_action( 'wp_head', 'basic_add_social' );
/* ========================================================================== */




/* ========================================================================== *
 * Schema.org COMMENT callback
 * ========================================================================== */
function basic_schemaorg_html5_comment( $comment, $args, $depth ) {
	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
	<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> itemscope itemtype="http://schema.org/Comment">
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">

			<footer class="comment-meta">
				<div class="comment-author">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
					<b class="fn" itemprop="author"><?php echo comment_author_link(); ?></b>
				</div>

				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>" itemprop="datePublished">
							<?php printf( __( '%1$s at %2$s', 'basic' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
					<?php edit_comment_link( __( 'Edit', 'basic' ), '<span class="edit-link">', '</span>' ); ?>
				</div>

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'basic' ); ?></p>
				<?php endif; ?>
			</footer>

			<div class="comment-content" itemprop="text">
				<?php comment_text(); ?>
			</div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 
							'add_below' => 'div-comment', 
							'depth' => $depth, 
							'max_depth' => $args['max_depth'] 
						)
				)); ?>
			</div>

		</div>

<?php
}
/* ========================================================================== */



/* ========================================================================== *
 * default COMMENT callback
 * ========================================================================== */
function basic_html5_comment( $comment, $args, $depth ) {
	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
	<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">

			<footer class="comment-meta">
				<div class="comment-author">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
					<b class="fn"><?php echo comment_author_link(); ?></b>
				</div>

				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'basic' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
					<?php edit_comment_link( __( 'Edit', 'basic' ), '<span class="edit-link">', '</span>' ); ?>
				</div>

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'basic' ); ?></p>
				<?php endif; ?>
			</footer>

			<div class="comment-content">
				<?php comment_text(); ?>
			</div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 
							'add_below' => 'div-comment', 
							'depth' => $depth, 
							'max_depth' => $args['max_depth'] 
						)
				)); ?>
			</div>

		</div>

<?php
}
/* ========================================================================== */




/* ==========================================================================
 *  ECHO markup Schema.org
 * ========================================================================== */
function basic_markup_schemaorg(){
//function basic_markup_schemaorg(){
	global $post;

	$markup = ( is_single() && basic_get_theme_option('schema_mark') ) ? true : false;
	$logo   = ( $markup && basic_get_theme_option('markup_logo') ) ? basic_get_theme_option('markup_logo') : get_template_directory_uri() . '/img/logo.jpg';
	$adress = ( $markup && basic_get_theme_option('markup_adress') ) ? basic_get_theme_option('markup_adress') : 'Russia';
	$phone  = ( $markup && basic_get_theme_option('markup_telephone') ) ? basic_get_theme_option('markup_telephone') : '+7 (000) 000-000-00';
	$img_attr = ( has_post_thumbnail($post->ID) ) 
				? wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' )
				: array( get_template_directory_uri() .'/img/default.jpg', 80, 80 );

	?><!-- Schema.org Article markup -->
			<div class="markup">
				
				<meta itemscope itemprop="mainEntityOfPage" content="<?php the_permalink() ?>" />	
				
				<div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
					<link itemprop="url" href="<?php echo $img_attr[0]; ?>">
					<link itemprop="contentUrl" href="<?php echo $img_attr[0]; ?>">
					<meta itemprop="width" content="<?php echo $img_attr[1]; ?>">
					<meta itemprop="height" content="<?php echo $img_attr[2]; ?>">
				</div>
				
				<meta itemprop="datePublished" content="<?php the_time('c') ?>">
				<meta itemprop="dateModified"  content="<?php the_modified_time('c')?>"/>	
				<meta itemprop="author" content="<?php the_author() ?>">
				
				<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
					<meta itemprop="name" content="<?php bloginfo('blogname'); ?>">
					<meta itemprop="address" content="<?php echo $adress; ?>">
					<meta itemprop="telephone" content="<?php echo $phone; ?>">
					<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
						<link itemprop="url" href="<?php echo $logo; ?>">
						<link itemprop="contentUrl" href="<?php echo $logo; ?>">
					</div>						
				</div>

			</div>
			<!-- END markup -->	
	<?php

}
/* ========================================================================== */



/* ==========================================================================
 *  Include libs
 * ========================================================================== */

// layout functions and filters
	require_once ( get_template_directory() . '/inc/layout.php' );

// hooks
	require_once ( get_template_directory() . '/inc/hooks.php' );

// custom content functions library
	require_once ( get_template_directory() . '/inc/functions.php' );

// theme options
	require_once ( get_template_directory() . '/inc/admin/options.php' );

// theme customizer
	require_once ( get_template_directory() . '/inc/customizer/customizer-settings.php' );
	require_once ( get_template_directory() . '/inc/customizer/customizer.php' );


if ( is_admin() ) :

	// meta-box for layout control
	require_once ( get_template_directory() . '/inc/admin/meta-boxes.php' );

endif;