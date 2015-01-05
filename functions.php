<?php 

if ( file_exists(  __DIR__ . '/cmb2/init.php' ) ) {
  require_once  __DIR__ . '/cmb2/init.php';
} elseif ( file_exists(  __DIR__ . '/CMB2/init.php' ) ) {
  require_once  __DIR__ . '/CMB2/init.php';
}

add_filter( 'cmb2_meta_boxes', 'cmb2_sample_metaboxes' );

function cmb2_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb2_';

	 $meta_boxes['menus_metabox'] = array(
        'id'            => 'menus_metabox',
        'title'         => __( 'Menu Item Details', 'cmb2' ),
        'object_types'  => array( 'menus', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        'fields'        => array(
            array(
                'name' => __( 'Description', 'cmb2' ),
                'desc' => __( 'field description (optional)', 'cmb2' ),
                'id'   => $prefix . 'description',
                'type' => 'textarea',
                // 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
                // 'repeatable' => true,
            ),
            array(
                'name' => __( 'Price', 'cmb2' ),
                'desc' => __( 'field description (optional)', 'cmb2' ),
                'id'   => $prefix . 'price',
                'type' => 'text_small',
                // 'repeatable' => true,
            ),
        ),
    );

	

	return $meta_boxes;
}
	
	function st_add_roles () {
		$roles = get_option('wp_user_roles');
	
		if (!isset($roles['investor'])) {
			add_role( 'investor', 'Investor', array('read' => true) );
		}	
	}
	add_action('after_setup_theme', 'simple_theme_setup');


	function add_supports() {
		add_theme_support( 'post-thumbnails' ); 
	}

	add_action('after_setup_theme', 'add_supports');


	/**
	 * Redirect user after successful login.
	 *
	 * @param string $redirect_to URL to redirect to.
	 * @param string $request URL the user is coming from.
	 * @param object $user Logged user's data.
	 * @return string
	 */
	function my_login_redirect( $redirect_to, $request, $user ) {
		//is there a user to check?
		global $user;
		if ( isset( $user->roles ) && is_array( $user->roles ) ) {
			//check for admins
			if ( in_array( 'investor', $user->roles ) ) {
				// redirect them to the default place
				return home_url();
				
			} else {
				return $redirect_to;
			}
		} else {
			return $redirect_to;
		}
	}

	add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );


	define('stheme_includes', get_template_directory_uri() . '/includes/');

	register_nav_menus( 
			array(
				'Header Nav' => '',
				'Footer Nav' => '',
				'Moible Nav' => 'Mobile navigation munues'
			));

	function reg_post_types() {
		// remember to comback and locoalize all this shyt
		$labels = array(
					'name' => 'Menus',
					'singuular_name' => 'Menu',
					'menu_name' => 'Menu',
					'name_admin_bar' => 'Menu',
					'all_items' => 'All Menus',
					'add_new' =>  'Add New Menu',
					'edit_item' => 'Edit Menu',
					'new_item' => 'New Menu',
					'view_item' => 'View Menu',
					'search_items' => 'Search Menus',
					'not_found' => 'No Menus Found'
				  );

		$staff_labels = array(
					'name' => 'Stafff',
					'singuular_name' => 'Staff',
					'menu_name' => 'Staff',
					'name_admin_bar' => 'Staff',
					'all_items' => 'All Staff Members',
					'add_new' =>  'Add New Staff Member',
					'edit_item' => 'Edit Staff Member',
					'new_item' => 'New Staff Member',
					'view_item' => 'View Staff',
					'search_items' => 'Search Staff',
					'not_found' => 'No Menus Found'
				  );

		$menu_supports = array(
							'title', 
							'revisions',
							'custom-fields',
							'excerpt'
						);

		$staff_supports = array(
							'title',
							'editor',
							'thumbnail'
						);

		$menu_tax = array('menu_types');

		$staff_tax = array('staff_categories');

		$args = array(
					'label' => 'Menus',
					'labels' => $labels,
					'descrition' => 'Availble food menu options',
					'public' => true,
					'menu_postion' => 5,
					'supports' => $menu_supports,
					'taxonomies' => $menu_tax,
					'rewrite' => array('slug' => 'menus')
				);

		$staff_args = array(
					'label' => 'Staff',
					'labels' => $staff_labels,
					'descrition' => 'Staff Members',
					'public' => true,
					'menu_postion' => 6,
					'supports' => $staff_supports,
					'taxonomies' => $staff_tax,
					'rewrite' => array('slug' => 'staff')
				);


		register_post_type('Menus', $args);

		register_post_type('Staff', $staff_args);
	}

	add_action( 'init' , 'reg_post_types' );

	// function menu_meta_boxes() {
		
	// 	add_meta_box('simple_menu_item', 'Menu Items', 'add_menu_item_cb', 'menus');
	// }

	// add_action('add_meta_boxes', 'menu_meta_boxes');

	// function add_menu_item_cb () {

	// 	echo '<div class="menu-item-hold">';
	// 	echo	'<div class="item-headers">';
	// 	echo		'<fieldset><label>Item</label></fieldset>';
	// 	echo		'<fieldset><label>Description</label></fieldset>';
	// 	echo		'<fieldset><label>Price</label></fieldset>';
	// 	echo	'</div>';
	// 	echo	'<div class="item-inputs">';
	// 	echo		'<fieldset><input type="text"></fieldset>';
	// 	echo		'<fieldset><textarea></textarea></fieldset>';
	// 	echo		'<fieldset><input type="text"></fieldset>';
	// 	echo	'</div>';
	// 	echo '</div>';
	// }

	function reg_taxonomies() {
		$labels = array(
					'name' => 'Menu Types',
					'singuular_name' => 'Menu Type',
					'menu_name' => 'Menu Types',
					'name_admin_bar' => 'Menu Types',
					'all_items' => 'All Menus Types',
					'add_new' =>  'Add New Menu Type',
					'edit_item' => 'Edit Menu Type',
					'new_item' => 'New Menu Type',
					'view_item' => 'View Menu Type',
					'search_items' => 'Search Menus Types',
					'not_found' => 'No Menus Types Found'
				  );
		$args = array( 
					'label' => 'Menus Types',
					'labels' => $labels,
					'public' => true,
					'hierarchical' => true,
					'rewrite' => array('slug' => 'menus-types')
				);

		$staff_labels = array(
					'name' => 'Staff Categories',
					'singuular_name' => 'Staff Category',
					'menu_name' => 'Staff Categories',
					'name_admin_bar' => 'Staff Categories',
					'all_items' => 'All Staff Categories',
					'add_new' =>  'Add Staff Category',
					'edit_item' => 'Edit Staff Category',
					'new_item' => 'New Staff Category',
					'view_item' => 'View Staff Category',
					'search_items' => 'Search Staff Categories',
					'not_found' => 'No Menus Types Found'
				  );
		$staff_args = array( 
					'label' => 'Staff Categories',
					'labels' => $staff_labels,
					'public' => true,
					'hierarchical' => true,
					'rewrite' => array('slug' => 'staff-categories')
				);

		register_taxonomy('menu_types', 'menus', $args);

		register_taxonomy('staff_categories', 'staff', $staff_args);
	}

	add_action('init', 'reg_taxonomies');



	function regenq_sitescripts() {
		//Register BootStrap Grid CSS & Custome Functionality JS
		wp_register_style( 'bootsrap_css', stheme_includes . 'css/bootstrap.min.css', '' , '3.3.1', 'all');  
		wp_register_script('site_functionality', stheme_includes . 'js/functionality.js', '', '1.0.0', true);

		// Add CSS & JS to Que
		wp_enqueue_style( 'bootsrap_css', stheme_includes . 'css/bootstrap.min.css');
		wp_enqueue_script('site_functionality', stheme_includes . 'js/functionality.js');
	}

	add_action('wp_enqueue_scripts','regenq_sitescripts');

	function regenq_admin_sitescripts() {
		wp_register_style( 'ss_admin_css', stheme_includes . 'css/ss_admin.css', '' , '1.0', 'all'); 
		wp_enqueue_style( 'ss_admin_css', stheme_includes .  'css/ss_admin.css'); 
	}

	add_action( 'admin_enqueue_scripts', 'regenq_admin_sitescripts' );

	
?>