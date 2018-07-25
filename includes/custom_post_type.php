<?php
//----------------------------------------------------------------------//
// Initiate the plugin to add custom post type 
//----------------------------------------------------------------------//
add_action("init", "custom_posttype_menu_wp_admin");
function custom_posttype_menu_wp_admin()
{
////////////// Code Start to Add Slides Types of Post //////////////
register_post_type(	'Slides', 
				array(	'label' 			=> __('Slides'),
						'labels' 			=> array(	'name' 					=> __('Slides'),
														'singular_name' 		=> __('Slide'),
														'add_new' 				=> __('Add Slides'),
														'add_new_item' 			=> __('Add New Slide '),
														'edit' 					=> __('Edit'),
														'edit_item' 			=> __('Edit Slide'),
														'new_item' 				=> __('New Slide'),
														'view_item'				=> __('View Slide'),
														'search_items' 			=> __('Search Slide'),
														'not_found' 			=> __('No Slide found'),
														'not_found_in_trash' 	=> __('No Slide found in trash')	),
						'public' 			=> true,
						'can_export'		=> true,
						'show_ui' 			=> true, // UI in admin panel
						'_builtin' 			=> false, // It's a custom post type, not built in
						//'_edit_link' 		=> 'post.php?post=%d',
						'capability_type' 	=> 'post',
						//'menu_icon' 		=> get_bloginfo('template_url').'/images/favicon.ico',
						'hierarchical' 		=> false,
						//'rewrite' 			=> array(	"slug" => "slides"	), // Permalinks
						'query_var' 		=> "slides", // This goes to the WP_Query schema
						'supports' 			=> array(	'title',
														//'author', 
														//'excerpt',
														'thumbnail',
														//'comments',
														//'editor', 
														//'trackbacks',
														'custom-fields',
														//'revisions'
														) 
														
					)
				);
////////// Code Start to Add News Post Type /////////

	$newslabels = array(
		'name'                  => _x( 'news', 'Post Type General Name', 'lps_wp' ),
		'singular_name'         => _x( 'news', 'Post Type Singular Name', 'lps_wp' ),
		'menu_name'             => __( 'News', 'lps_wp' ),
		'name_admin_bar'        => __( 'News', 'lps_wp' ),
		'archives'              => __( 'News', 'lps_wp' ),
		'attributes'            => __( 'News', 'lps_wp' ),
		'parent_item_colon'     => __( 'Parent Item:', 'lps_wp' ),
		'all_items'             => __( 'All News', 'lps_wp' ),
		'add_new_item'          => __( 'Add New News', 'lps_wp' ),
		'add_new'               => __( 'Add News', 'lps_wp' ),
		'new_item'              => __( 'New News', 'lps_wp' ),
		'edit_item'             => __( 'Edit News', 'lps_wp' ),
		'update_item'           => __( 'Update News', 'lps_wp' ),
		'view_item'             => __( 'View News', 'lps_wp' ),
		'view_items'            => __( 'View News', 'lps_wp' ),
		'search_items'          => __( 'Search News', 'lps_wp' ),
		'not_found'             => __( 'Not found', 'lps_wp' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'lps_wp' ),
		'featured_image'        => __( 'Featured Image', 'lps_wp' ),
		'set_featured_image'    => __( 'Set featured image', 'lps_wp' ),
		'remove_featured_image' => __( 'Remove featured image', 'lps_wp' ),
		'use_featured_image'    => __( 'Use as featured image', 'lps_wp' ),
		'insert_into_item'      => __( 'Insert into News', 'lps_wp' ),
		'uploaded_to_this_item' => __( 'Uploaded to this News', 'lps_wp' ),
		'items_list'            => __( 'Items News', 'lps_wp' ),
		'items_list_navigation' => __( 'Items News navigation', 'lps_wp' ),
		'filter_items_list'     => __( 'Filter News list', 'lps_wp' ),
	);
	$args = array(
		'label'                 => __( 'news', 'lps_wp' ),
		'description'           => __( 'Post Type Description', 'lps_wp' ),
		'labels'                => $newslabels,
		'supports'              => array( 'title', 'editor' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'supports' 			=> array(	'title',
														//'author', 
														//'excerpt',
														'thumbnail',
														//'comments',
														'editor', 
														//'trackbacks',
														'custom-fields',
														//'revisions'
														) 
		
	);
	register_post_type( 'news', $args );
//////// Code Start for Events Posts Type /////////////////////

// Register Custom Post Type

	$eventlabels = array(
		'name'                  => _x( 'events', 'Post Type General Name', 'lps_wp' ),
		'singular_name'         => _x( 'event', 'Post Type Singular Name', 'lps_wp' ),
		'menu_name'             => __( 'Events', 'lps_wp' ),
		'name_admin_bar'        => __( 'Events', 'lps_wp' ),
		'archives'              => __( 'Event Archives', 'lps_wp' ),
		'attributes'            => __( 'Event Attributes', 'lps_wp' ),
		'parent_item_colon'     => __( 'Parent Event:', 'lps_wp' ),
		'all_items'             => __( 'All Events', 'lps_wp' ),
		'add_new_item'          => __( 'Add New Event', 'lps_wp' ),
		'add_new'               => __( 'Add Event', 'lps_wp' ),
		'new_item'              => __( 'New Event', 'lps_wp' ),
		'edit_item'             => __( 'Edit Events', 'lps_wp' ),
		'update_item'           => __( 'Update Event', 'lps_wp' ),
		'view_item'             => __( 'View Events', 'lps_wp' ),
		'view_items'            => __( 'View Events', 'lps_wp' ),
		'search_items'          => __( 'Search Eventw', 'lps_wp' ),
		'not_found'             => __( 'Not found', 'lps_wp' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'lps_wp' ),
		'featured_image'        => __( 'Featured Image', 'lps_wp' ),
		'set_featured_image'    => __( 'Set featured image', 'lps_wp' ),
		'remove_featured_image' => __( 'Remove featured image', 'lps_wp' ),
		'use_featured_image'    => __( 'Use as featured image', 'lps_wp' ),
		'insert_into_item'      => __( 'Insert into Event', 'lps_wp' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Event', 'lps_wp' ),
		'items_list'            => __( 'Events list', 'lps_wp' ),
		'items_list_navigation' => __( 'Events list navigation', 'lps_wp' ),
		'filter_items_list'     => __( 'Filter Events list', 'lps_wp' ),
	);
	$args = array(
		'label'                 => __( 'event', 'lps_wp' ),
		'description'           => __( 'Events', 'lps_wp' ),
		'labels'                => $eventlabels,
		'supports'              => array( 'title', 'editor','thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'events', $args );

/////////// Code Start to Get Article Post Types ////////


	$articlelabels = array(
		'name'                  => _x( 'articles', 'Post Type General Name', 'lps_wp' ),
		'singular_name'         => _x( 'article', 'Post Type Singular Name', 'lps_wp' ),
		'menu_name'             => __( 'Articles', 'lps_wp' ),
		'name_admin_bar'        => __( 'Articles', 'lps_wp' ),
		'archives'              => __( 'Article Archives', 'lps_wp' ),
		'attributes'            => __( 'Article Attributes', 'lps_wp' ),
		'parent_item_colon'     => __( 'Parent Article:', 'lps_wp' ),
		'all_items'             => __( 'All Articles', 'lps_wp' ),
		'add_new_item'          => __( 'Add New Article', 'lps_wp' ),
		'add_new'               => __( 'Add New Article', 'lps_wp' ),
		'new_item'              => __( 'New Article', 'lps_wp' ),
		'edit_item'             => __( 'Edit Article', 'lps_wp' ),
		'update_item'           => __( 'Update Article', 'lps_wp' ),
		'view_item'             => __( 'View Article', 'lps_wp' ),
		'view_items'            => __( 'View Articles', 'lps_wp' ),
		'search_items'          => __( 'Search Article', 'lps_wp' ),
		'not_found'             => __( 'Not found', 'lps_wp' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'lps_wp' ),
		'featured_image'        => __( 'Featured Image', 'lps_wp' ),
		'set_featured_image'    => __( 'Set featured image', 'lps_wp' ),
		'remove_featured_image' => __( 'Remove featured image', 'lps_wp' ),
		'use_featured_image'    => __( 'Use as featured image', 'lps_wp' ),
		'insert_into_item'      => __( 'Insert into Article', 'lps_wp' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Article', 'lps_wp' ),
		'items_list'            => __( 'Articles list', 'lps_wp' ),
		'items_list_navigation' => __( 'Articles list navigation', 'lps_wp' ),
		'filter_items_list'     => __( 'Filter Articles list', 'lps_wp' ),
	);
	$args = array(
		'label'                 => __( 'article', 'lps_wp' ),
		'description'           => __( 'Articles', 'lps_wp' ),
		'labels'                => $articlelabels,
		'supports'              => array( 'title', 'editor' ),
		'taxonomies'            => array( 'Article Category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'articles', $args );
	
$articlecategorylabels = array(
		'name'              => _x( 'Article', 'taxonomy general name', 'lps_wp' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'lps_wp' ),
		'search_items'      => __( 'Search Articles Category', 'lps_wp' ),
		'all_items'         => __( 'All Articles Category', 'lps_wp' ),
		'parent_item'       => __( 'Parent Artcles Category', 'lps_wp' ),
		'parent_item_colon' => __( 'Parent Artcles Category:', 'lps_wp' ),
		'edit_item'         => __( 'Edit Artcles Category', 'lps_wp' ),
		'update_item'       => __( 'Update Artcles Category', 'lps_wp' ),
		'add_new_item'      => __( 'Add New Artcles Category', 'lps_wp' ),
		'new_item_name'     => __( 'New Artcles Category Name', 'lps_wp' ),
		'menu_name'         => __( 'Article Category', 'lps_wp' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $articlecategorylabels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'article_category' ),
	);

	register_taxonomy( 'article_category', array( 'articles' ), $args );

////// Code Start to Add FAQ Custom Post Type ///////////

// Register Custom Post Type

	$faqlabels = array(
		'name'                  => _x( 'faq', 'Post Type General Name', 'lps_wp' ),
		'singular_name'         => _x( 'faq', 'Post Type Singular Name', 'lps_wp' ),
		'menu_name'             => __( 'FAQ', 'lps_wp' ),
		'name_admin_bar'        => __( 'FAQ', 'lps_wp' ),
		'archives'              => __( 'Question Archives', 'lps_wp' ),
		'attributes'            => __( 'Question Attributes', 'lps_wp' ),
		'parent_item_colon'     => __( 'Parent Question:', 'lps_wp' ),
		'all_items'             => __( 'All FAQ', 'lps_wp' ),
		'add_new_item'          => __( 'Add New Question', 'lps_wp' ),
		'add_new'               => __( 'Add New Question', 'lps_wp' ),
		'new_item'              => __( 'New Question', 'lps_wp' ),
		'edit_item'             => __( 'Edit Question', 'lps_wp' ),
		'update_item'           => __( 'Update Question', 'lps_wp' ),
		'view_item'             => __( 'View FAQ', 'lps_wp' ),
		'view_items'            => __( 'View FAQ', 'lps_wp' ),
		'search_items'          => __( 'Search Question', 'lps_wp' ),
		'not_found'             => __( 'Not found', 'lps_wp' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'lps_wp' ),
		'featured_image'        => __( 'Featured Image', 'lps_wp' ),
		'set_featured_image'    => __( 'Set featured image', 'lps_wp' ),
		'remove_featured_image' => __( 'Remove featured image', 'lps_wp' ),
		'use_featured_image'    => __( 'Use as featured image', 'lps_wp' ),
		'insert_into_item'      => __( 'Insert into Question', 'lps_wp' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Question', 'lps_wp' ),
		'items_list'            => __( 'Questions list', 'lps_wp' ),
		'items_list_navigation' => __( 'Questions list navigation', 'lps_wp' ),
		'filter_items_list'     => __( 'Filter Questions list', 'lps_wp' ),
	);
	$args = array(
		'label'                 => __( 'faq', 'lps_wp' ),
		'description'           => __( 'FAQ', 'lps_wp' ),
		'labels'                => $faqlabels,
		'supports'              => array( 'title', 'editor' ),
		'taxonomies'            => array( 'FAQ Category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'faq', $args );
	
$faqcategorylabels = array(
		'name'              => _x( 'FAQ Category', 'FAQ Category', 'lps_wp' ),
		'singular_name'     => _x( 'FAQ Category', 'FAQ Category', 'lps_wp' ),
		'search_items'      => __( 'Search FAQ Category', 'lps_wp' ),
		'all_items'         => __( 'All FAQ Category', 'lps_wp' ),
		'parent_item'       => __( 'Parent FAQ Category', 'lps_wp' ),
		'parent_item_colon' => __( 'Parent FAQ Category:', 'lps_wp' ),
		'edit_item'         => __( 'Edit FAQ Category', 'lps_wp' ),
		'update_item'       => __( 'Update FAQ Category', 'lps_wp' ),
		'add_new_item'      => __( 'Add New FAQ Category', 'lps_wp' ),
		'new_item_name'     => __( 'New FAQ Category Name', 'lps_wp' ),
		'menu_name'         => __( 'FAQ Category', 'lps_wp' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $faqcategorylabels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'faq_category' ),
	);

	register_taxonomy( 'faq_category', array( 'faq' ), $args );
	
/////// Code Starts for Creating Brand Post Type ////////	
// Register Custom Post Type

	$brandlabels = array(
		'name'                  => _x( 'Clients', 'Post Type Clients Name', 'lps_wp' ),
		'singular_name'         => _x( 'brand', 'Post Type Clients Name', 'lps_wp' ),
		'menu_name'             => __( 'Clients', 'lps_wp' ),
		'name_admin_bar'        => __( 'brand', 'lps_wp' ),
		'archives'              => __( 'Clients Archives', 'lps_wp' ),
		'attributes'            => __( 'Clients Attributes', 'lps_wp' ),
		'parent_item_colon'     => __( 'Parent Clients:', 'lps_wp' ),
		'all_items'             => __( 'All Clients', 'lps_wp' ),
		'add_new_item'          => __( 'Add New Clients', 'lps_wp' ),
		'add_new'               => __( 'Add New ', 'lps_wp' ),
		'new_item'              => __( 'New Clients', 'lps_wp' ),
		'edit_item'             => __( 'Edit Clients', 'lps_wp' ),
		'update_item'           => __( 'Update Clients', 'lps_wp' ),
		'view_item'             => __( 'View Clients', 'lps_wp' ),
		'view_items'            => __( 'View Clients', 'lps_wp' ),
		'search_items'          => __( 'Search Clients', 'lps_wp' ),
		'not_found'             => __( 'Not found', 'lps_wp' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'lps_wp' ),
		'featured_image'        => __( 'Featured Image', 'lps_wp' ),
		'set_featured_image'    => __( 'Set featured image', 'lps_wp' ),
		'remove_featured_image' => __( 'Remove featured image', 'lps_wp' ),
		'use_featured_image'    => __( 'Use as featured image', 'lps_wp' ),
		'insert_into_item'      => __( 'Insert into Clients', 'lps_wp' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Clients', 'lps_wp' ),
		'items_list'            => __( 'Items Clients', 'lps_wp' ),
		'items_list_navigation' => __( 'Items Clients navigation', 'lps_wp' ),
		'filter_items_list'     => __( 'Filter items Clients', 'lps_wp' ),
	);
	$args = array(
		'label'                 => __( 'brand', 'lps_wp' ),
		'description'           => __( 'Clients', 'lps_wp' ),
		'labels'                => $brandlabels,
		'supports'              => array( 'title',  'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => false,
		'capability_type'       => 'page',
	);
	register_post_type( 'brands', $args );

/////// Code Start for Custom Post Type Trainers /////////


	$trainerslabels = array(
		'name'                  => _x( 'Trainers', 'Post Type General Name', 'lps_wp' ),
		'singular_name'         => _x( 'trainer', 'Post Type Singular Name', 'lps_wp' ),
		'menu_name'             => __( 'Trainers', 'lps_wp' ),
		'name_admin_bar'        => __( 'Trainer', 'lps_wp' ),
		'archives'              => __( 'Trainer Archives', 'lps_wp' ),
		'attributes'            => __( 'Trainer Attributes', 'lps_wp' ),
		'parent_item_colon'     => __( 'Parent Trainer:', 'lps_wp' ),
		'all_items'             => __( 'All Trainers', 'lps_wp' ),
		'add_new_item'          => __( 'Add New Trainer', 'lps_wp' ),
		'add_new'               => __( 'Add New Trainers', 'lps_wp' ),
		'new_item'              => __( 'New Trainer', 'lps_wp' ),
		'edit_item'             => __( 'Edit Trainer', 'lps_wp' ),
		'update_item'           => __( 'Update Trainer', 'lps_wp' ),
		'view_item'             => __( 'View Trainer', 'lps_wp' ),
		'view_items'            => __( 'View Trainers', 'lps_wp' ),
		'search_items'          => __( 'Search Trainer', 'lps_wp' ),
		'not_found'             => __( 'Not found', 'lps_wp' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'lps_wp' ),
		'featured_image'        => __( 'Featured Image', 'lps_wp' ),
		'set_featured_image'    => __( 'Set featured image', 'lps_wp' ),
		'remove_featured_image' => __( 'Remove featured image', 'lps_wp' ),
		'use_featured_image'    => __( 'Use as featured image', 'lps_wp' ),
		'insert_into_item'      => __( 'Insert into Trainer', 'lps_wp' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Trainer', 'lps_wp' ),
		'items_list'            => __( 'Trainers list', 'lps_wp' ),
		'items_list_navigation' => __( 'Trainers list navigation', 'lps_wp' ),
		'filter_items_list'     => __( 'Filter Trainers list', 'lps_wp' ),
	);
	$args = array(
		'label'                 => __( 'trainer', 'lps_wp' ),
		'description'           => __( 'Trainers', 'lps_wp' ),
		'labels'                => $trainerslabels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'trainers', $args );

////////// Code Start to Add Training Methodology //////////


	$methodlabels = array(
		'name'                  => _x( 'methodology', 'Post Type General Name', 'lps_wp' ),
		'singular_name'         => _x( 'methodology', 'Post Type Singular Name', 'lps_wp' ),
		'menu_name'             => __( 'Training Methodology', 'lps_wp' ),
		'name_admin_bar'        => __( 'Methodology', 'lps_wp' ),
		'archives'              => __( 'Methodology Archives', 'lps_wp' ),
		'attributes'            => __( 'Methodology Attributes', 'lps_wp' ),
		'parent_item_colon'     => __( 'Parent Methodology:', 'lps_wp' ),
		'all_items'             => __( 'All Methodology', 'lps_wp' ),
		'add_new_item'          => __( 'Add New Methodology', 'lps_wp' ),
		'add_new'               => __( 'Add Methodology', 'lps_wp' ),
		'new_item'              => __( 'New Methodology', 'lps_wp' ),
		'edit_item'             => __( 'Edit Methodology', 'lps_wp' ),
		'update_item'           => __( 'Update Methodology', 'lps_wp' ),
		'view_item'             => __( 'View Methodology', 'lps_wp' ),
		'view_items'            => __( 'View Methodology', 'lps_wp' ),
		'search_items'          => __( 'Search Methodology', 'lps_wp' ),
		'not_found'             => __( 'Not found', 'lps_wp' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'lps_wp' ),
		'featured_image'        => __( 'Featured Image', 'lps_wp' ),
		'set_featured_image'    => __( 'Set featured image', 'lps_wp' ),
		'remove_featured_image' => __( 'Remove featured image', 'lps_wp' ),
		'use_featured_image'    => __( 'Use as featured image', 'lps_wp' ),
		'insert_into_item'      => __( 'Insert into item', 'lps_wp' ),
		'uploaded_to_this_item' => __( 'Uploaded to this methodology', 'lps_wp' ),
		'items_list'            => __( 'Items methodology', 'lps_wp' ),
		'items_list_navigation' => __( 'Methodology list navigation', 'lps_wp' ),
		'filter_items_list'     => __( 'Filter methodology list', 'lps_wp' ),
	);
	$args = array(
		'label'                 => __( 'methodology', 'lps_wp' ),
		'description'           => __( 'Training Methodology', 'lps_wp' ),
		'labels'                => $methodlabels,
		'supports'              => array( 'title', 'editor','thumbnail' ),
		'taxonomies'            => array( 'methodology_category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'methodology', $args );

$methodologycategorylabels = array(
		'name'              => _x( 'Methodology Category', 'Methodology Category', 'lps_wp' ),
		'singular_name'     => _x( 'Methodology Category', 'Methodology Category', 'lps_wp' ),
		'search_items'      => __( 'Search Methodology Category', 'lps_wp' ),
		'all_items'         => __( 'All Methodology Category', 'lps_wp' ),
		'parent_item'       => __( 'Parent Methodology Category', 'lps_wp' ),
		'parent_item_colon' => __( 'Parent Methodology Category:', 'lps_wp' ),
		'edit_item'         => __( 'Edit Methodology Category', 'lps_wp' ),
		'update_item'       => __( 'Update Methodology Category', 'lps_wp' ),
		'add_new_item'      => __( 'Add New Methodology Category', 'lps_wp' ),
		'new_item_name'     => __( 'New Methodology Category Name', 'lps_wp' ),
		'menu_name'         => __( 'Methodology Category', 'lps_wp' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $methodologycategorylabels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'methodology_category' ),
	);

	register_taxonomy( 'methodology_category', array( 'methodology' ), $args );
	

	$courselabels = array(
		'name'                  => _x( 'Courses', 'Post Type General Name', 'lps_wp' ),
		'singular_name'         => _x( 'course', 'Post Type Singular Name', 'lps_wp' ),
		'menu_name'             => __( 'Courses', 'lps_wp' ),
		'name_admin_bar'        => __( 'Course', 'lps_wp' ),
		'archives'              => __( 'Course Archives', 'lps_wp' ),
		'attributes'            => __( 'Course Attributes', 'lps_wp' ),
		'parent_item_colon'     => __( 'Parent Course:', 'lps_wp' ),
		'all_items'             => __( 'All Courses', 'lps_wp' ),
		'add_new_item'          => __( 'Add New Course', 'lps_wp' ),
		'add_new'               => __( 'Add New', 'lps_wp' ),
		'new_item'              => __( 'New Course', 'lps_wp' ),
		'edit_item'             => __( 'Edit Course', 'lps_wp' ),
		'update_item'           => __( 'Update Course', 'lps_wp' ),
		'view_item'             => __( 'View Course', 'lps_wp' ),
		'view_items'            => __( 'View Courses', 'lps_wp' ),
		'search_items'          => __( 'Search Course', 'lps_wp' ),
		'not_found'             => __( 'Not found', 'lps_wp' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'lps_wp' ),
		'featured_image'        => __( 'Featured Image', 'lps_wp' ),
		'set_featured_image'    => __( 'Set featured image', 'lps_wp' ),
		'remove_featured_image' => __( 'Remove featured image', 'lps_wp' ),
		'use_featured_image'    => __( 'Use as featured image', 'lps_wp' ),
		'insert_into_item'      => __( 'Insert into course', 'lps_wp' ),
		'uploaded_to_this_item' => __( 'Uploaded to this course', 'lps_wp' ),
		'items_list'            => __( 'Courses list', 'lps_wp' ),
		'items_list_navigation' => __( 'Courses list navigation', 'lps_wp' ),
		'filter_items_list'     => __( 'Filter courses list', 'lps_wp' ),
	);
	$args = array(
		'label'                 => __( 'course', 'lps_wp' ),
		'description'           => __( 'Training Courses', 'lps_wp' ),
		'labels'                => $courselabels,
		'supports'              => array( 'title', 'editor','thumbnail' ),
		'taxonomies'            => array( 'course_category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'course', $args );


$coursecategorylabels = array(
		'name'              => _x( 'Course Category', 'Course Category', 'lps_wp' ),
		'singular_name'     => _x( 'Course Category', 'Course Category', 'lps_wp' ),
		'search_items'      => __( 'Search Course Category', 'lps_wp' ),
		'all_items'         => __( 'All Course Category', 'lps_wp' ),
		'parent_item'       => __( 'Parent Course Category', 'lps_wp' ),
		'parent_item_colon' => __( 'Parent Course Category:', 'lps_wp' ),
		'edit_item'         => __( 'Edit Course Category', 'lps_wp' ),
		'update_item'       => __( 'Update Course Category', 'lps_wp' ),
		'add_new_item'      => __( 'Add New Course Category', 'lps_wp' ),
		'new_item_name'     => __( 'New Course Category Name', 'lps_wp' ),
		'menu_name'         => __( 'Course Category', 'lps_wp' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $coursecategorylabels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'course_category' ),
	);

	register_taxonomy( 'course_category', array( 'course' ), $args );

////////// Code Start for Creating Scheduled Course ///////
	
	$scheduledlabels = array(
'name'                  => _x( 'Scheduled Course', 'Post Type General Name', 'lps_wp' ),
'singular_name'         => _x( 'scheduled_course', 'Post Type Singular Name', 'lps_wp' ),
'menu_name'             => __( 'Scheduled Course', 'lps_wp' ),
'name_admin_bar'        => __( 'Scheduled Course', 'lps_wp' ),
'archives'              => __( 'Scheduled Course Archives', 'lps_wp' ),
'attributes'            => __( 'Scheduled Course Attributes', 'lps_wp' ),
'parent_item_colon'     => __( 'Parent Scheduled Course:', 'lps_wp' ),
'all_items'             => __( 'All Scheduled Course', 'lps_wp' ),
'add_new_item'          => __( 'Add New Scheduled Course', 'lps_wp' ),
'add_new'               => __( 'Add New Scheduled Course', 'lps_wp' ),
'new_item'              => __( 'New Scheduled Course', 'lps_wp' ),
'edit_item'             => __( 'Edit Scheduled Course', 'lps_wp' ),
'update_item'           => __( 'Update Scheduled Course', 'lps_wp' ),
'view_item'             => __( 'View Scheduled Course', 'lps_wp' ),
'view_items'            => __( 'View Scheduled Courses', 'lps_wp' ),
'search_items'          => __( 'Search Scheduled Course', 'lps_wp' ),
'not_found'             => __( 'Not found', 'lps_wp' ),
'not_found_in_trash'    => __( 'Not found in Trash', 'lps_wp' ),
'featured_image'        => __( 'Featured Image', 'lps_wp' ),
'set_featured_image'    => __( 'Set featured image', 'lps_wp' ),
'remove_featured_image' => __( 'Remove featured image', 'lps_wp' ),
'use_featured_image'    => __( 'Use as featured image', 'lps_wp' ),
'insert_into_item'      => __( 'Insert into Scheduled Course', 'lps_wp' ),
'uploaded_to_this_item' => __( 'Uploaded to this Scheduled Course', 'lps_wp' ),
'items_list'            => __( 'Scheduled Course list', 'lps_wp' ),
'items_list_navigation' => __( 'Scheduled Course list navigation', 'lps_wp' ),
'filter_items_list'     => __( 'Filter Scheduled Course list', 'lps_wp' ),
	);
	$args = array(
		'label'                 => __( 'scheduled_course', 'lps_wp' ),
		'description'           => __( 'Sscheduled course', 'lps_wp' ),
		'labels'                => $scheduledlabels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'scheduled_course', $args );

	//////// Code Start to Create Gallery Post Type //////////

	$gallerylabels = array(
		'name'                  => _x( 'gallery', 'Post Type General Name', 'lps_wp' ),
		'singular_name'         => _x( 'gallery', 'Post Type Singular Name', 'lps_wp' ),
		'menu_name'             => __( 'Gallery', 'lps_wp' ),
		'name_admin_bar'        => __( 'Gallery', 'lps_wp' ),
		'archives'              => __( 'Gallery Archives', 'lps_wp' ),
		'attributes'            => __( 'Item Attributes', 'lps_wp' ),
		'parent_item_colon'     => __( 'Parent Item:', 'lps_wp' ),
		'all_items'             => __( 'All Gallery Items', 'lps_wp' ),
		'add_new_item'          => __( 'Add New Image / Video', 'lps_wp' ),
		'add_new'               => __( 'Add New Items', 'lps_wp' ),
		'new_item'              => __( 'New Item', 'lps_wp' ),
		'edit_item'             => __( 'Edit Image / Video', 'lps_wp' ),
		'update_item'           => __( 'Update Image / Video', 'lps_wp' ),
		'view_item'             => __( 'View Image / Video', 'lps_wp' ),
		'view_items'            => __( 'View Items', 'lps_wp' ),
		'search_items'          => __( 'Search Image / Video', 'lps_wp' ),
		'not_found'             => __( 'Not found', 'lps_wp' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'lps_wp' ),
		'featured_image'        => __( 'Featured Image', 'lps_wp' ),
		'set_featured_image'    => __( 'Set featured image', 'lps_wp' ),
		'remove_featured_image' => __( 'Remove featured image', 'lps_wp' ),
		'use_featured_image'    => __( 'Use as featured image', 'lps_wp' ),
		'insert_into_item'      => __( 'Insert into item', 'lps_wp' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'lps_wp' ),
		'items_list'            => __( 'Items list', 'lps_wp' ),
		'items_list_navigation' => __( 'Items list navigation', 'lps_wp' ),
		'filter_items_list'     => __( 'Filter items list', 'lps_wp' ),
	);
	$args = array(
		'label'                 => __( 'gallery', 'lps_wp' ),
		'description'           => __( 'Gallery', 'lps_wp' ),
		'labels'                => $gallerylabels,
		'supports'              => array( 'title', 'thumbnail' ),
		'taxonomies'            => array( 'gallery_category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => false,
		'capability_type'       => 'page',
	);
	register_post_type( 'gallery', $args );

	
$gallerycategorylabels = array(
		'name'              => _x( 'Gallery Category', 'Gallery Category', 'lps_wp' ),
		'singular_name'     => _x( 'Gallery Category', 'Gallery Category', 'lps_wp' ),
		'search_items'      => __( 'Search Gallery Category', 'lps_wp' ),
		'all_items'         => __( 'All Gallery Category', 'lps_wp' ),
		'parent_item'       => __( 'Parent Gallery Category', 'lps_wp' ),
		'parent_item_colon' => __( 'Parent Gallery Category:', 'lps_wp' ),
		'edit_item'         => __( 'Edit Gallery Category', 'lps_wp' ),
		'update_item'       => __( 'Update Gallery Category', 'lps_wp' ),
		'add_new_item'      => __( 'Add New Gallery Category', 'lps_wp' ),
		'new_item_name'     => __( 'New Gallery Category Name', 'lps_wp' ),
		'menu_name'         => __( 'Gallery Category', 'lps_wp' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $gallerycategorylabels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'gallery_category' ),
	);

	register_taxonomy( 'gallery_category', array( 'gallery' ), $args );
	

	//////// End of Code to Create Gallery Post Type ///////

	////////// Code Start to Add News letter Post Type /////////

	$newsletterlabels = array(
		'name'                  => _x( 'newsletter', 'Post Type General Name', 'lps_wp' ),
		'singular_name'         => _x( 'newsletter', 'Post Type Singular Name', 'lps_wp' ),
		'menu_name'             => __( 'Newsletter', 'lps_wp' ),
		'name_admin_bar'        => __( 'Newsletter', 'lps_wp' ),
		'archives'              => __( 'Newsletter', 'lps_wp' ),
		'attributes'            => __( 'Newsletter', 'lps_wp' ),
		'parent_item_colon'     => __( 'Parent Item:', 'lps_wp' ),
		'all_items'             => __( 'All Newsletter', 'lps_wp' ),
		'add_new_item'          => __( 'Add New Newsletter', 'lps_wp' ),
		'add_new'               => __( 'Add Newsletter', 'lps_wp' ),
		'new_item'              => __( 'New Newsletter', 'lps_wp' ),
		'edit_item'             => __( 'Edit Newsletter', 'lps_wp' ),
		'update_item'           => __( 'Update Newsletter', 'lps_wp' ),
		'view_item'             => __( 'View Newsletter', 'lps_wp' ),
		'view_items'            => __( 'View Newsletter', 'lps_wp' ),
		'search_items'          => __( 'Search Newsletter', 'lps_wp' ),
		'not_found'             => __( 'Not found', 'lps_wp' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'lps_wp' ),
		'featured_image'        => __( 'Featured Image', 'lps_wp' ),
		'set_featured_image'    => __( 'Set featured image', 'lps_wp' ),
		'remove_featured_image' => __( 'Remove featured image', 'lps_wp' ),
		'use_featured_image'    => __( 'Use as featured image', 'lps_wp' ),
		'insert_into_item'      => __( 'Insert into Newsletter', 'lps_wp' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Newsletter', 'lps_wp' ),
		'items_list'            => __( 'Items Newsletter', 'lps_wp' ),
		'items_list_navigation' => __( 'Items Newsletter navigation', 'lps_wp' ),
		'filter_items_list'     => __( 'Filter Newsletter list', 'lps_wp' ),
	);
	$args = array(
		'label'                 => __( 'newsletter', 'lps_wp' ),
		'description'           => __( '', 'lps_wp' ),
		'labels'                => $newsletterlabels,
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'supports' 			=> array(	'title',
														//'author', 
														//'excerpt',
														'thumbnail',
														//'comments',
														'editor', 
														//'trackbacks',
														'custom-fields',
														//'revisions'
														) 
		
	);
	register_post_type( 'newsletter', $args );
	
		
$newslettercategorylabels = array(
		'name'              => _x( 'Newsletter Category', 'Newsletter Category', 'lps_wp' ),
		'singular_name'     => _x( 'Newsletter Category', 'Newsletter Category', 'lps_wp' ),
		'search_items'      => __( 'Search Newsletter Category', 'lps_wp' ),
		'all_items'         => __( 'All Newsletter Category', 'lps_wp' ),
		'parent_item'       => __( 'Parent Newsletter Category', 'lps_wp' ),
		'parent_item_colon' => __( 'Parent Newsletter Category:', 'lps_wp' ),
		'edit_item'         => __( 'Edit Newsletter Category', 'lps_wp' ),
		'update_item'       => __( 'Update Newsletter Category', 'lps_wp' ),
		'add_new_item'      => __( 'Add New Newsletter Category', 'lps_wp' ),
		'new_item_name'     => __( 'New Newsletter Category Name', 'lps_wp' ),
		'menu_name'         => __( 'Newsletter Category', 'lps_wp' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $newslettercategorylabels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'newsletter_category' ),
	);

	register_taxonomy( 'newsletter_category', array( 'newsletter' ), $args );
	
}
?>