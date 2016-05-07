<?php 

if ( !in_array(basic_get_layout(), array('full','center')) ) : 

	$mobile_sidebar = '';
	if ( get_avd_option('show_sidebar') ){
		$mobile_sidebar = ' class="block"';
 	} ?>

	<!-- BEGIN #sidebar -->
	<aside id="sidebar"<?php echo $mobile_sidebar; ?>>
		<ul id="widgetlist">

        <?php if ( is_active_sidebar( 'sidebar' ) ) :
        	dynamic_sidebar( 'sidebar' ); 
        else : ?>

			<li class="widget widget_search">
				<?php get_search_form(); ?>
			</li>
							
			<?php wp_list_categories('title_li=<p class="wtitle">'. __("Categories", 'basic') .'</p>');  ?>

		<?php endif; ?>
			
		</ul>
	</aside>
	<!-- END #sidebar -->

<?php endif; ?>