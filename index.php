<?php get_header(); //requires header.php ?>
		<main class="content">

			<?php //The Loop
			if( have_posts() ){	
				while( have_posts() ){	
					the_post();
			?>

			<article <?php post_class(); ?>>

				<?php the_post_thumbnail('banner'); //featured image ?>

				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>
				<div class="entry-content">
					<?php 
					//if it's a special post format, show full content, otherwise show excerpt
					if( has_post_format( array( 'gallery', 'image' ) ) ){
						the_content(); //full content
					}else{
						the_excerpt(); //just a snippet of the content 
					}
					
					?>
				</div>
				<div class="postmeta">
					<span class="author">by: <?php the_author(); ?> </span>
					<span class="date"> <?php the_time('F j, Y'); ?> </span>
					<span class="num-comments"><?php comments_number(); ?></span>
					<span class="categories"><?php the_category(); ?></span>
					<?php the_tags('<span class="tags">', ', ', '</span>'); ?>
				</div>
				<!-- end .postmeta -->
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
		
<?php get_sidebar(); //require sidebar.php ?>		
<?php get_footer();  //require footer.php ?>