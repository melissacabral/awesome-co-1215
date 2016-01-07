<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
		if( have_posts() ): ?>

		<h2 class="archive-title">Products by: <?php single_term_title(); ?></h2>

		<?php while( have_posts() ): the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php the_post_thumbnail('thumbnail'); ?>

			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?> 
				</a>
			</h2>

			<?php the_terms( $post->ID, 'brand', '<h3>by ', ' | ', '</h3>' ); ?>			

			<div class="entry-content">
				<?php the_excerpt(); ?>

				
				<?php 
				$price = get_post_meta( $post->ID, 'price', true );
				
				if($price){ ?>
				<span class="product-price">
					<?php echo $price; ?>
				</span>
				<?php } ?>

			</div>
					
		</article><!-- end post -->

		<?php endwhile; ?>

		<?php awesome_pagination(); ?>

	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php get_sidebar('shop'); //include sidebar-shop.php ?>
<?php get_footer(); //include footer.php ?>