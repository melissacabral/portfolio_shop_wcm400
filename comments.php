<?php 
//exit this file if the password is required
if( post_password_required() ){
	return;
} 
?>

<section class="comments">
	<h3><?php comments_number(); ?> <?php _e( 'on this post' , 'portfolio-shop-wcm400') ?></h3>

	<ol class="comment-list">
		<?php wp_list_comments(array(
			'type' => 'comment', //hide pingbacks & trackbacks
			'avatar_size' => 50, //pixels square
		)); ?>
	</ol>
</section>

<section class="pagination">
	<?php previous_comments_link( '&larr; Older Comments' ); ?>
	<?php next_comments_link( 'Newer Comments &rarr;' ); ?>
</section>

<section class="comment-form">
	<?php comment_form(); ?>
</section>


<?php //count up all the pingbacks and trackbacks
$pings_count = sc_pings_count(); 
if( $pings_count ){
?>
<section class="pings">
	<h3><?php echo $pings_count == 1 ? 'One site mentions' : $pings_count . ' sites mention' ; ?>  this post</h3>
	<ul>
		<?php wp_list_comments( array(
			'type' 			=> 'pings',
			'short_ping' 	=> true,
		) ); ?>
	</ul>
</section>
<?php } //end if there are pings ?>