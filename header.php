<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge" /><![endif]-->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>	
<![endif]-->	
	
<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<div class="wrapper cleafix">

<!-- BEGIN header --><?php $header_image = get_header_image(); ?>
<header id="header"<?php if ($header_image){ echo 'style="background-image:url('. esc_url( $header_image ) .')"'; } ?>>
    
	<div class="sitetitle maxwidth grid">	
		<div class="logo col5">
			
			<?php if ( is_home() ) : 
				?><h1><a id="logo" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
			<?php else: 
				?><a id="logo" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>
			<?php endif; ?>
			<p class="sitedescription"><?php bloginfo('description'); ?></p>

		</div>		
		<div class="ban col7 on_desktop">
			
		</div>		
	</div>
	
	<div class="topnav grid">
		<div id="mobile-menu" class="mm-active"><?php _e( 'Menu', 'basic' ); ?></div>
		<nav>
			<?php if (has_nav_menu('top')) : 
				wp_nav_menu( array(
					'theme_location' => 'top',
					'menu_id' => 'navpages',
					'container' => false,
					'items_wrap' => '<ul class="menu maxwidth clearfix">%3$s</ul>'
				) ); 
			else : ?>
				<ul class="menu maxwidth clearfix"><?php wp_list_pages('title_li=&depth=2'); ?> </ul>
			<?php endif; ?>
		</nav>				
	</div>
	
</header>
<!-- END header -->	


<div id="main" class="maxwidth clearfix">

	<!-- BEGIN content -->
	
