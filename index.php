<?php get_header(); ?>
	<main id="content">

<?php if (have_posts()) : 
	while (have_posts()) : the_post(); 

		get_template_part( 'content' ); 

	endwhile; ?>

	<?php

	the_posts_pagination( array(
		'mid_size' => 2,
		'prev_text' => __( '&laquo; Prev', 'basic'),
		'next_text' => __( 'Next &raquo;', 'basic'),
	) );

else: ?>

	<div class="post clearfix">		
	    <h2><?php _e( 'Posts not found', 'basic' ); ?></h2>
	    <?php get_search_form(); ?>
	</div>
		
<?php endif; ?>
    

	</main> 
	<!-- END #content -->
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>