<?php get_header(); ?>
	<main id="content">

	<?php while (have_posts()) : the_post(); 

			get_template_part( 'content',  get_post_format() );		

			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

	endwhile; ?>
		


	</main> <!-- #content -->
	<?php get_sidebar(); ?>
<?php get_footer(); ?>