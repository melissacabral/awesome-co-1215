<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
		if( have_posts() ): ?>
		<?php while( have_posts() ): the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?> 
				</a>
			</h2>

			<?php the_terms( $post->ID, 'brand', '<h3>by ', ' | ', '</h3>' ); ?>
			
			<?php the_post_thumbnail('medium'); ?>
			<div class="entry-content">
				<?php 
				//show a list of all custom fields
				the_meta(); ?>
				<?php the_content();?>
			</div>
				
		</article><!-- end post -->

		<?php endwhile; ?>

		<?php awesome_pagination(); ?>
	

	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php get_footer(); //include footer.php ?>