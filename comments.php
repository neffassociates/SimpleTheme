<?php get_header(); ?>
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post() ; ?>

			

		<?php endwhile; ?>
	<?php endif; ?>

	<div class="comments">
		<div class="container">
			<div class="row">
				<div clas="col-sm-12">
					<?php 
						$args = array();

						$comments_query = new WP_Comment_Query;
						$comments = $comments_query->query();

						if ( $comments ) :
							foreach ( $comments as $comment ) :
					?>
					<div class="col-sm-6 comment">
						<h4><?php comment_author(); ?></h4>
						<ul class="col-sm-12">
							<li class="col-sm-6"><?php comment_date(); ?> | <?php comment_time(); ?></li>
						</ul>
						<p class="col-sm-12">
							<?php comment_text(); ?>
						</p>
						<?php comment_form(); ?>
					</div>
					<?php 
							endforeach ;
						endif;
					 ?>	
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>