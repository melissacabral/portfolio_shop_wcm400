<?php get_header(); //requires header.php ?>
<main class="content">

			<?php //The Loop
			if( have_posts() ){	
				?>

				<h1 class="page-heading">Portfolio</h1>

				<ul class="portfolio-subnav">
					<?php wp_list_categories( array(
						'taxonomy' 	=> 'portfolio_category',
						'title_li'	=> '',
					) ); ?>
				</ul>
				
				<?php
				while( have_posts() ){	
					the_post();
					?>

					<article <?php post_class(); ?>>
						<div class="overlay">
							
							<?php the_post_thumbnail('banner'); //featured image ?>
							<div class="info">
								<h2 class="entry-title">
									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>
								</h2>
								<div class="entry-content">
									<?php the_excerpt(); //just a snippet of the content ?>
								</div>
							</div>
						</div>
						
						
					</article>
					<!-- end .post -->

					<?php comments_template(); ?>

					<?php 
				} //end while
				?>
				<div class="pagination">
					<?php previous_posts_link( '&larr; Newer Posts' ); ?>
					<?php next_posts_link( 'Older Posts &rarr;' ); ?>

					<?php //the_posts_pagination(); ?>
				</div>
				<?php
			}else{ ?>

				<h2>No Posts to show</h2>

			<?php } //end of The Loop ?>
			
		</main>
		<!-- end .content -->
		
		
		<?php get_footer();  //require footer.php ?>