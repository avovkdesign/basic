<?php get_header(); ?>
	<main id="content">

		<?php while ( have_posts() ) : the_post(); ?>

			<article class="page" id="pageid-<?php the_ID(); ?>">
				
				<h1><?php the_title(); ?></h1>
				<?php /*otravleniy_the_meta();*/ ?>

				<div class="entry clearfix">
					<?php the_content(); ?>
				</div>

			</article>

			<?php 

			if ( comments_open() || get_comments_number() ) { comments_template(); }

		endwhile; ?>
		
	</main> <!-- #content -->
	<?php get_sidebar(); ?>
<?php get_footer(); ?>