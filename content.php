<?php

$markup_opt = basic_get_theme_option( 'schema_mark' ); // false or 0
$markup     = ( is_single() && $markup_opt || false === $markup_opt ) ? true : false;

?>

<article <?php post_class(); ?><?php echo ( $markup ) ? ' itemscope itemtype="http://schema.org/Article"' : ''; ?>><?php

	/**
	 * basic_before_post_title hook
	 */
	do_action( 'basic_before_post_title' );

	if ( is_single() ) :

		/**
		 * basic_single_before_title hook
		 */
		do_action( 'basic_single_before_title' ); ?>
		<h1<?php echo ( $markup ) ? ' itemprop="headline"' : ''; ?>><?php the_title(); ?></h1>
		<?php

		/**
		 * basic_single_after_title hook
		 */
		do_action( 'basic_single_after_title' );

	else:

		/**
		 * basic_postexcerpt_before_title hook
		 */
		do_action( 'basic_postexcerpt_before_title' ); ?>

		<h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<?php

		/**
		 * basic_postexcerpt_after_title hook
		 */
		do_action( 'basic_postexcerpt_after_title' );

	endif;

	/**
	 * basic_after_post_title hook
	 */
	do_action( 'basic_after_post_title' );


	/**
	 * basic_before_content hook
	 *
	 * @hooked basic_get_postmeta - 10
	 */
	do_action( 'basic_before_content' ); ?>


	<div class="entry-box clearfix" <?php if ( $markup ) {
		echo "itemprop='articleBody'";
	} ?>>

		<?php

		if ( ! is_single() ) {

			$thumbnail_size = 'medium';
			$attributes     = array(
				'class' => 'thumbnail'
			);

			$thumbnail_size = apply_filters( 'basic_singular_thumbnail_size', $thumbnail_size );
			$attributes     = apply_filters( 'basic_singular_thumbnail_attr', $attributes );

			/**
			 * basic_before_post_thumbnail hook
			 */
			do_action( 'basic_before_post_thumbnail' );

			?>
			<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="anons-thumbnail">
				<?php the_post_thumbnail( $thumbnail_size, $attributes ); ?>
			</a>
			<?php

			/**
			 * basic_after_post_thumbnail hook
			 */
			do_action( 'basic_after_post_thumbnail' );

			the_excerpt();


			/**
			 * basic_before_more_link hook
			 */
			do_action( 'basic_before_more_link' );

			?>
			<p class="more-link-box">
			<a class="more-link" href="<?php the_permalink() ?>#more-<?php the_ID(); ?>" title="<?php the_title_attribute(); ?>"><?php _e( 'Read more', 'basic' ); ?></a>
			</p><?php

			/**
			 * basic_after_more_link hook
			 */
			do_action( 'basic_after_more_link' );

		} else {

			/**
			 * basic_before_more_link hook
			 */
			do_action( 'basic_before_single_content' );

			the_content( '' );

			/**
			 * basic_before_more_link hook
			 */
			do_action( 'basic_after_single_content' );


		} ?>

	</div> <?php

	/**
	 * basic_after_content hook
	 */
	do_action( 'basic_after_content' );


	if ( is_single() ) { ?>
		<aside class="meta"><?php the_tags(); ?></aside>
	<?php }

	if ( $markup ) {
		basic_markup_schemaorg();
	} ?>

</article>
