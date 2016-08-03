<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge" /><![endif]-->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<div class="wrapper cleafix">

<?php do_action( 'basic_before_header' ); ?>

<!-- BEGIN header -->
<header id="header" class="clearfix">

	<?php do_action( 'basic_before_sitetitle' ); ?>

	<div class="sitetitle maxwidth grid <?php echo basic_get_theme_option('title_position'); ?>">
		<div class="logo">
			
			<?php do_action( 'basic_before_sitelogo' );
			if ( is_home() ) :
				?><h1><a id="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo('name') ); ?>"><?php bloginfo('name'); ?></a></h1>
			<?php else: 
				?><a id="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo('name') ); ?>"><?php bloginfo('name'); ?></a>
			<?php endif; ?>
			<?php do_action( 'basic_after_sitelogo' ); ?>

			<?php $tagline = basic_get_theme_option('showsitedesc');
			if ( false === $tagline || !empty($tagline) || is_customize_preview() ) { ?>
				<p class="sitedescription"><?php bloginfo('description'); ?></p>
			<?php } ?>
			<?php do_action( 'basic_after_sitedescription' ); ?>

		</div>
		<?php do_action( 'basic_after_sitetitle' ); ?>
	</div>

	<?php do_action( 'basic_before_topnav' ); ?>

	<div class="topnav grid">
		<div id="mobile-menu" class="mm-active"><?php _e( 'Menu', 'basic' ); ?></div>
		<nav>
			<?php if (has_nav_menu('top')) : 
				wp_nav_menu( array(
					'theme_location' => 'top',
					'menu_id' => 'navpages',
					'container' => false,
					'items_wrap' => '<ul class="top-menu maxwidth clearfix">%3$s</ul>'
				) ); 
			else : ?>
				<ul class="top-menu maxwidth clearfix">
					<?php if ( is_front_page() ) { ?>
						<li class="page_item current_page_item"><span><?php _e( 'Home', 'basic' ); ?></span></li>
					<?php } else { ?>
						<li class="page_item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e( 'Home', 'basic' ); ?></a></li>
					<?php } 
					wp_list_pages('title_li=&depth=2'); ?>
				</ul>
			<?php endif; ?>
		</nav>				
	</div>

	<?php do_action( 'basic_after_topnav' ); ?>

</header>
<!-- END header -->

<?php do_action( 'basic_after_header' ); ?>


<div id="main" class="maxwidth clearfix">

	<!-- BEGIN content -->
	
