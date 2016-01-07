<aside id="sidebar">
	
	<?php 
	//don't show the button if we're viewing the shop
	if( ! is_post_type_archive( 'product' ) ){ ?>
	<section class="widget products-view-all">
		<a href="<?php echo get_post_type_archive_link('product'); ?>" class="button">Remove Filter</a>
	</section>	
	<?php } ?>

	<section class="widget">
		<h3 class="widget-title">Filter by Brand:</h3>
		<ul>
			<?php wp_list_categories( array(
				'taxonomy'		=> 'brand',
				'title_li'		=> '',
				'show_count'	=> true,
			) ); ?>
		</ul>
	</section>
</aside>