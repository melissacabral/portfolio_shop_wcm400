<?php get_header(); //requires header.php ?>
		<main class="content">

			<?php //The Loop
			if( have_posts() ){	
				while( have_posts() ){	
					the_post();
			?>

			<article <?php post_class( 'clearfix' ); ?>>
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php 
					//supports "multi-paged posts"
					wp_link_pages(); 
					?>
				</div>
				
			</article>
			<!-- end .post -->

		

			<?php 
				} //end while
			}else{ ?>

				<h2>No Posts to show</h2>

			<?php } //end of The Loop ?>


			<?php //custom query: get 1 piece of work in the "web-design" category
			$featured_work = new WP_Query( array(
				'post_type' 		=> 'work', 
				'posts_per_page' 	=> 1,
				'tax_query'			=> array(
											array(
												'taxonomy' 	=> 'portfolio_category',
												'field'		=> 'slug',
												'terms'		=> 'web-design',
											),
										),
			) ); 

			//Custom Loop
			if( $featured_work->have_posts() ){
			?>
			<section class="featured-work">
				<h2>Featured Work</h2>

				<?php while( $featured_work->have_posts() ){ 
						$featured_work->the_post();
					?>
				<article>
					<div class="">
						<h2 class="entry-title">
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h2>
						<?php the_post_thumbnail( 'banner' ); ?>
					</div>
					<div class="excerpt">
						<?php the_excerpt(); ?>
					</div>	
				</article>
				<?php } //end while ?>

			</section>
			<?php } //end of custom loop 
			//clean up to prevent other queries from being affected 
			wp_reset_postdata();
			?>
			
		</main>
		<!-- end .content -->
		
<?php get_sidebar('frontpage');   //require sidebar-frontpage.php ?>

	
<?php get_footer();  //require footer.php ?>