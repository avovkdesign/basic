<?php
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

<?php if ( have_comments() ) : ?>
	<h3 class="comments-title"><?php _e('Comments', 'basic'); ?> <span class="cnt"><i class="fa fa-comments-o"></i><?php comments_number('0', '1', '%' );?></span></h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  ?>
		<div class="comment-navigation">
			<div class="nav-prev"><?php previous_comments_link( __('&larr; Older Comments', 'basic') ); ?></div>
			<div class="nav-next"><?php next_comments_link( __('Newer Comments &rarr;', 'basic') ); ?></div>
		</div>
		<?php endif; ?>

		<ul class="comment-list">
			<?php 
				$comm_args = array( 
					'avatar_size' => '60',
					'callback' => 'basic_html5_comment' 
				);
				if ( basic_get_theme_option('schema_mark') ) {
					$comm_args['callback'] = 'basic_schemaorg_html5_comment';
				}
				wp_list_comments( $comm_args ); 
			?>
		</ul><!-- .comment-list -->
	
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  ?>
		<div class="comment-navigation">
			<div class="nav-prev"><?php previous_comments_link( __('&larr; Older Comments', 'basic') ); ?></div>
			<div class="nav-next"><?php next_comments_link( __('Newer Comments &rarr;', 'basic') ); ?></div>
		</div>
		<?php endif; ?>

<?php endif; // have_comments() 

	$commenter = wp_get_current_commenter();

	$fields =  array(
		'author' => '<p class="rinput rauthor"><input type="text" placeholder="'.__('Your Name','basic').'" name="author" id="author" class="required" value="' . esc_attr( $commenter['comment_author'] ) . '" /></p>',		
		'email'  => '<p class="rinput remail"><input type="text" placeholder="'.__('Your E-mail','basic').'" name="email" id="email" class="required" value="'.esc_attr(  $commenter['comment_author_email'] ) . '" /></p>',
		'url'  => '<p class="rinput rurl"><input type="text" placeholder="'.__('Your Website','basic').'" name="url" id="url" class="last-child" value="'. esc_attr( $commenter['comment_author_url'] ) . '"  /></p>'
	);
	$args = array(
	    'fields' => apply_filters( 'comment_form_default_fields', $fields ),
	    'comment_field' => '<p class="rcomment"><textarea id="comment" name="comment" cols="45" rows="8" placeholder="'. __('Message','basic') .'" aria-required="true"></textarea></p>',
	);



	comment_form( $args ); ?>

</div><!-- #comments -->