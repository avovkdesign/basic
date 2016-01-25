<?php 

	$markup = ( is_single() && get_avd_option('schema_mark') ) ? true : false;

?>

		<article <?php post_class(); ?><?php echo ($markup) ? ' itemscope itemtype="http://schema.org/Article"' : ''; ?>>
			
		<?php if ( is_single() ) :  
			?><h1<?php echo ($markup) ? ' itemprop="headline"' : ''; ?>><?php the_title(); ?></h1>
		<?php else: ?>
			<h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<?php endif; ?>
			
			<aside class="meta">
				<span class="date"><?php the_time(get_option('date_format')); ?></span>
				<span class="category"><?php the_category(', ') ?></span>
				<span class="comments"><?php comments_popup_link( __('Comments', 'basic').': 0', __( "Comments", 'basic') .': 1', __("Comments", 'basic').': %', '', ''); ?></span>
			</aside>
	
			
			<div class="entry clearfix" <?php if ($markup) { echo "itemprop='articleBody'"; } ?>>
				
				<?php $thumb = get_the_post_thumbnail( get_the_ID(), 'thumbnail', 'class=thumbnail' );
				if ( strlen($thumb) && !is_singular() ) : ?>			
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="anons-thumbnail">
						<?php echo $thumb; ?>
					</a>				
				<?php endif; ?>
				
				<?php if ( !is_single() ) {
						the_excerpt(''); 
					} else {
						the_content(''); 
					}
				?>
				
				<?php if ( !is_single() ) : ?>
					<a class="more-link" href="<?php the_permalink() ?>#more-<?php the_ID(); ?>" title="<?php the_title_attribute(); ?>"><?php _e('Read more', 'basic'); ?></a>
				<?php endif; ?>
				
			</div>
			
		<?php if ( is_single() ) { ?>
			<aside class="meta"><?php the_tags(); ?></aside>	
		<?php } ?>

		<?php if ( $markup ) { the_markup_schemaorg(); } ?>

		</article> 
