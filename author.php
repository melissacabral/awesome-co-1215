<?php get_header(); //include header.php 

//get all the metadata about this author
$the_author = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));

?>

<main id="content">
	<?php //THE LOOP
		if( have_posts() ): ?>
		
		<?php echo get_avatar( $the_author->ID, 80 ); ?>
		<h1>This is <?php echo $the_author->nickname; ?>'s page</h1>
		
		<?php while( have_posts() ): the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?> 
				</a>
			</h2>
			<?php the_post_thumbnail('thumbnail'); ?>
			<div class="entry-content">
				<?php 
				if( is_page() OR is_single() ){
					the_content();
				}else{
					the_excerpt();
				}
				 ?>
			</div>
			<div class="postmeta"> 
				<span class="author"> Posted by: 
					<?php the_author_posts_link(); ?>
				</span>
				<span class="date"><a href="<?php the_permalink(); ?>"><?php the_date(); ?></a></span>
				<span class="num-comments"> <?php comments_number(); ?></span>
				<span class="categories"><?php the_category(); ?></span>
				<span class="tags"><?php the_tags(); ?></span> 
			</div><!-- end postmeta -->			
		</article><!-- end post -->

		<?php endwhile; ?>

		<?php awesome_pagination(); ?>

	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php get_sidebar(); //include sidebar.php ?>
<?php get_footer(); //include footer.php ?>