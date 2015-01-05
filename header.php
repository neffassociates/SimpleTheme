<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="<?php bloginfo( 'description' ) ?>" />
	<title><?php wp_title() ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body>
<header>
	<nav class="mobile-nav">

	</nav>
	<nav class="desktop-nav">
		<div class="branding col-sm-4">

		</div>
		<div class="main-navigation col-sm-8">
			<?php 
				$defaults = array(
					'container'       => 'ul',
					'container_id'    => 'main-menu',
					'menu_class'      => 'menu',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 0,
				);

				wp_nav_menu( $defaults ); 
			?>
		</div>
	</nav>
</header>
<div id="main-conent"> <!-- Main Content -->

