<?php 
//hide the comments if the post is password protected
if( post_password_required() ){
	return;  //stop the rest of this file from running
}
?>
<section id="comments" class="clearfix">
	<h3>
		<?php comments_number('No comments yet', 'One Comment', '% Comments' ); ?>
	 	| <a href="#respond">Leave a comment</a></h3>

	<ol class="commentlist">
		<?php wp_list_comments( array(
			'type' => 'comment',
			'avatar_size' => 70,
		) ); ?>
	</ol>

	<?php //show pagination only if needed
	if( get_comment_pages_count() > 1 AND get_option( 'page_comments' ) ): ?>
		<div class="pagination">
			<?php previous_comments_link(); ?>
			<?php next_comments_link(); ?>
		</div>
	<?php endif; //comment_pagination ?>

	<?php comment_form(); ?>
</section>