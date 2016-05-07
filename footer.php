</div> 
<!-- #main -->

<?php do_action( 'basic_before_footer' ); ?>

<footer id="footer">

	<?php do_action( 'basic_before_footer_menu' ); ?>

	<?php if (has_nav_menu('bottom')) : ?>
	<div class="footer-menu maxwidth">
		<?php 
		wp_nav_menu( array(
				'theme_location' => 'bottom',
				'menu_id' => 'footer-menu',
				'depth' => 1,
				'container' => false,
				'items_wrap' => '<ul class="footmenu clearfix">%3$s</ul>'
			)); 
		?>
	</div>
	<?php endif; ?>

	<?php do_action( 'basic_before_footer_copyrights' ); ?>

	<div class="maxwidth grid">
		<p id="copy" class="col6">
			<!--noindex--><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a><!--/noindex--> &copy; <?php echo date("Y",time()); ?>
			<br/> <?php _e("All rights reserved", 'basic'); ?>
		</p>
	    <p id="designedby" class="col6"><?php _e('Theme by', 'basic'); ?> 
	    	<!--noindex--><a href="http://wp-puzzle.com" target="_blank" rel="external nofollow"><?php _e('WP Puzzle', 'basic'); ?></a><!--/noindex-->
	    </p>
	</div>

	<?php do_action( 'basic_after_footer_copyrights' ); ?>

</footer>

</div> 
<!-- .wrapper -->

<a id="toTop">&#10148;</a>

<?php wp_footer(); ?>

</body>
</html>