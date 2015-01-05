<?php get_header(); ?>

<div class="hero-image">
	<div class="container">
		<h1>
			Hello World
		</h1>
	</div>
</div>

<div class="post-hold">
	<div class="container">
		<div class="row">
		
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post() ; ?>

			<article class="col-sm-12">
				<hgroup>
					<h1><?php the_title(); ?></h1>
					<ul>
						<li class="col-sm-3"><h3><?php the_date(); ?></h3></li>
						<li class="col-sm-9"><h3><?php the_author(); ?></h3></li>
					</ul>
				</hgroup>

				<div>
					<?php the_content(); ?>
				</div>
			</article>
			

			<?php endwhile; ?>
		<?php endif; ?>
		<?php comments_template( $file, $separate_comments ); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>