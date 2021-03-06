<?php get_header(); //requires header.php ?>
		<main class="content">

			<?php //The Loop
			if( have_posts() ){	
				while( have_posts() ){	
					the_post();
			?>

			<article <?php post_class(); ?>>
				<div class="overlay">
					<?php the_post_thumbnail('banner');  ?>

					<div class="info">
						<h2 class="entry-title">
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h2>
						<h3><?php the_field('subtitle'); ?></h3>
					</div>
				</div>
				<div class="entry-content">
					<?php 
					//show all the portfolio categories for this piece (taxonomy demo)
					the_terms( $post->ID, 'portfolio_category', '<h4>', ', ', '</h4>' ); ?>

					<?php 
					if(get_field('client')){
					?>
					
					<p>
						Client: <?php the_field('client'); ?>
					</p>
					<?php } //end if client ?>

					<?php the_content(); ?>
					<?php 
					//supports "multi-paged posts"
					wp_link_pages(); 
					?>
				</div>
				
			</article>
			<!-- end .post -->

			<div class="pagination">
				<?php previous_post_link( '%link', '&larr; Previous: %title' ); ?>
				<?php next_post_link( '%link', 'Next: %title &rarr;' ); ?>
			</div>


			<?php 
				} //end while
			}else{ ?>

				<h2>No Posts to show</h2>

			<?php } //end of The Loop ?>
			
		</main>
		<!-- end .content -->
		
<?php get_footer();  //require footer.php ?>