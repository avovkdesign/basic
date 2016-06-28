<?php 

	$markup_opt = basic_get_theme_option('schema_mark'); // false or 0
	$markup = ( is_single() && $markup_opt || false === $markup_opt ) ? true : false;

?>

		<article <?php post_class(); ?><?php echo ($markup) ? ' itemscope itemtype="http://schema.org/Article"' : ''; ?>>


		<?php if ( is_single() ) :
			do_action( 'basic_single_before_title' );
			?><h1<?php echo ($markup) ? ' itemprop="headline"' : ''; ?>><?php the_title(); ?></h1>
			<?php do_action( 'basic_single_after_title' );
		else:
			do_action( 'basic_postexcerpt_before_title' ); ?>
			<h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<?php do_action( 'basic_postexcerpt_after_title' );
		endif; ?>
			
			<aside class="meta">
				<?php do_action( 'basic_post_meta_before_first' ); ?>
				<span class="date"><?php the_time(get_option('date_format')); ?></span>
				<span class="category"><?php the_category(', ') ?></span>
				<span class="comments"><?php comments_popup_link( __('Comments', 'basic').': 0', __( "Comments", 'basic') .': 1', __("Comments", 'basic').': %', '', ''); ?></span>
				<?php do_action( 'basic_post_meta_after_last' ); ?>
			</aside>
	
			<?php do_action( 'basic_before_content' ); ?>
			<div class="entry-box clearfix" <?php if ($markup) { echo "itemprop='articleBody'"; } ?>>
				
				<?php $thumb = get_the_post_thumbnail( get_the_ID(), 'thumbnail', 'class=thumbnail' );
				if ( strlen($thumb) && !is_singular() ) : ?>			
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="anons-thumbnail">
						<?php echo $thumb; ?>
					</a>				
				<?php endif; ?>
				
				<?php if ( !is_single() ) {
						the_excerpt();
					} else {
						the_content(''); 
					}
				?>
				
				<?php if ( !is_single() ) : ?>
				<p class="more-link-box">	
					<a class="more-link" href="<?php the_permalink() ?>#more-<?php the_ID(); ?>" title="<?php the_title_attribute(); ?>"><?php _e('Read more', 'basic'); ?></a>
				</p>
				<?php endif; ?>
				
			</div>
			<?php do_action( 'basic_after_content' ); ?>


			<?php if ( is_single() ) { ?>
				<aside class="meta"><?php the_tags(); ?></aside>
			<?php } ?>

		<?php if ( $markup ) { basic_markup_schemaorg(); } ?>

		</article> 
