<?php get_header();

    if ( is_user_logged_in() ) {
      $user = new WP_User( $user_ID );
      
      if ($user->roles[0] == 'investor') {
        show_admin_bar( false);
      }
      
    }
 ?>

<?php get_template_part('ST_hearo_image_template'); ?>

<div class="post-hold">
	<div class="container">
		<div class="row">

		
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post() ; ?>

			<article class="col-sm-12">
				<hgroup>
					<h1><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h1>
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

    <?php
      $args = array(
        'post_type' => 'Menus'
      );

      $query = new WP_Query( $args );

      if ($query->have_posts()) {
          while ($query->have_posts()) {
              $query->the_post();
              $meta = get_post_meta(get_the_id(), '_cmb2_price', true);
              echo $meta;
          }
      }

    ?>



		</div>
	</div>
</div>

<?php get_footer(); ?>