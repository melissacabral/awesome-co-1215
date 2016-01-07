<?php 
/*
* this file can be used for:
* building your own custom functions
* activating "sleeping features"
* taking advantage of hooks
*/
//REQUIRED. max auto-embed width in pixels
if ( ! isset( $content_width ) ) $content_width = 740;

add_theme_support( 'post-thumbnails' );
//only activate the formats that you want to support
add_theme_support( 'post-formats', array( 'video', 'audio', 'gallery', 'chat', 'image', 
	'quote', 'link', 'aside', 'status' ) );

add_theme_support( 'custom-background' );
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption') );
//OMIT the <title> tag in header.php, this will take care of it for you in an SEO friendly way
add_theme_support( 'title-tag' );

//adds <link> tags for contextual feeds
add_theme_support( 'automatic-feed-links' );

//allows you to make editor-style.css for a better experience editing posts
add_editor_style();

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/**
 * Make default excerpts better - change the length and [...]
 */
function awesome_excerpt_length(){
	return 70;
}
add_filter( 'excerpt_length', 'awesome_excerpt_length' );

function awesome_readmore(){
	return ' <a href="' . get_permalink() . '" class="readmore">Read More</a>';
}
add_filter( 'excerpt_more', 'awesome_readmore' );

/**
 * Set up all menu areas that the theme needs
 * don't forget to put wp_nav_menu() in your header or wherever...
 * @since  0.1 created two basic areas 
 */
function awesome_menu_areas(){
	register_nav_menus( array(
		'main_menu' => 'Main Navigation Area',
		'utilities' => 'Utility Bar',
	) );
}
add_action( 'init', 'awesome_menu_areas' );

/**
 * Customized Archive Pagination Helper function
 * @since  0.1 
 * @return string HTML output of our pagination
 */
function awesome_pagination(){
	?>
	<section class="pagination">
	<?php if( !is_single() ){ //ARCHIVE ?>

		<?php 
		//added in 4.1, so check
		 if( function_exists('the_posts_pagination') ){
		 	//numbered, pretty pagination
			 the_posts_pagination( array(
			 	'prev_text' => '&larr;',
			 	'next_text' => 'Next &rarr;',
			 	'mid_size'	=> 3, 
			 ) ); 
		 }else{
		 	previous_posts_link('&larr; Newer Posts');  
			next_posts_link('Older Posts &rarr;'); 
		 }
		 ?>

	<?php }else{   //SINGLE ?>
		
		<?php next_post_link( '%link', '&larr; %title'); //1 newer post ?>
		<?php previous_post_link(  '%link', '%title &rarr;' );  //1 older post ?>

	<?php } ?>
	</section>
	<?php
}

/**
 * Register 4 widget areas aka "dynamic sidebars"
 * @since  0.1  
 */
function awesome_widget_areas(){
	register_sidebar( array(
		'name'			=> 	'Blog Sidebar',
		'id'			=> 	'blog_sidebar',
		'description'	=> 	'appears alongside posts',
		'before_widget'	=> 	'<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> 	'</section>',
		'before_title'	=> 	'<h3 class="widget-title">',
		'after_title'	=> 	'</h3>',
	) );
	register_sidebar( array(
		'name'			=> 	'Footer Area',
		'id'			=> 	'footer_area',
		'description'	=> 	'appears at the bottom of everything',
		'before_widget'	=> 	'<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> 	'</section>',
		'before_title'	=> 	'<h3 class="widget-title">',
		'after_title'	=> 	'</h3>',
	) );
	register_sidebar( array(
		'name'			=> 	'Front Page Area',
		'id'			=> 	'front_page_area',
		'description'	=> 	'appears only on the front page',
		'before_widget'	=> 	'<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> 	'</section>',
		'before_title'	=> 	'<h3 class="widget-title">',
		'after_title'	=> 	'</h3>',
	) );
	register_sidebar( array(
		'name'			=> 	'Page Sidebar',
		'id'			=> 	'page_sidebar',
		'description'	=> 	'appears alongside pages',
		'before_widget'	=> 	'<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> 	'</section>',
		'before_title'	=> 	'<h3 class="widget-title">',
		'after_title'	=> 	'</h3>',
	) );

}//end function
add_action( 'widgets_init', 'awesome_widget_areas' );



function comment_script(){
	if ( is_singular() ) wp_enqueue_script( "comment-reply" ); 
}
add_action('wp_print_scripts', 'comment_script');



/**
 * display a list of product thumbnails
 * @param  integer $limit max number of products to show
 * @param  string  $title title of the section
 * @return html         displays the UL 
 */

function awesome_products( $limit = 5, $title = '' ){
	//custom query to get 6 recent products
	$product_query = new WP_Query( array(
		'post_type' 		=> 'product', 
		'posts_per_page' 		=> $limit,	//maximum
	) );
	//custom loop
	if( $product_query->have_posts() ){
	 ?>
	 	<h2><?php echo $title; ?></h2>

		<ul class="latest-products">
			<?php while( $product_query->have_posts() ){
					$product_query->the_post();
			?>
			<li>
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'thumbnail' ); ?>
					
					<div class="product-info">
						<h3><?php the_title(); ?></h3>
						<p><?php the_excerpt(); ?></p>
					</div>
				</a>
			</li>
			<?php } //end while ?>
		</ul>
	<?php }//end if 
	//done with custom query. clean up!
	wp_reset_postdata(); 
}

/**
 * Example of how to customize a default loop
 *  this will hide the category "uncategorized (1)" from the blog
 */
function awesome_exclude_category( $query ){
	if( $query->is_home() ){
		$query->set( 'cat', '-1' );
	}
}
// add_action('pre_get_posts', 'awesome_exclude_category');

//no close php