<?php 
/*
Template Name: Page with no sidebar

This template can be applied by editing any "page" and choosing it from the "template" dropdown
*/

get_header(); //include header.php ?>

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
			<?php the_post_thumbnail('large'); ?>
			<div class="entry-content">
				<?php the_content();?>
				<?php wp_link_pages( array(
					'before' => '<div class="pagination"> Keep reading this page: ',
					'after' => '</div>',
					// 'next_or_number' => 'next',
					'pagelink' => '%',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) ); ?>
			</div>
					
		</article><!-- end post -->

		<?php endwhile; ?>

		<?php comments_template(); ?>

	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php get_footer(); //include footer.php ?>