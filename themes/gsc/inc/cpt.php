<?php

/*SLIDER CPT*/

// Register Custom Post Type Slider
function create_slider_cpt() {

	$labels = array(
		'name' => _x( 'Slider', 'Post Type General Name', 'textdomain' ),
		'singular_name' => _x( 'Slider', 'Post Type Singular Name', 'textdomain' ),
		'menu_name' => _x( 'Slider', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar' => _x( 'Slider', 'Add New on Toolbar', 'textdomain' ),
		'archives' => __( 'Slider Archives', 'textdomain' ),
		'attributes' => __( 'Slider Attributes', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Slider:', 'textdomain' ),
		'all_items' => __( 'All Slider', 'textdomain' ),
		'add_new_item' => __( 'Add New Slider', 'textdomain' ),
		'add_new' => __( 'Add New', 'textdomain' ),
		'new_item' => __( 'New Slider', 'textdomain' ),
		'edit_item' => __( 'Edit Slider', 'textdomain' ),
		'update_item' => __( 'Update Slider', 'textdomain' ),
		'view_item' => __( 'View Slider', 'textdomain' ),
		'view_items' => __( 'View Slider', 'textdomain' ),
		'search_items' => __( 'Search Slider', 'textdomain' ),
		'not_found' => __( 'Not found', 'textdomain' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
		'featured_image' => __( 'Featured Image', 'textdomain' ),
		'set_featured_image' => __( 'Set featured image', 'textdomain' ),
		'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
		'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
		'insert_into_item' => __( 'Insert into Slider', 'textdomain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Slider', 'textdomain' ),
		'items_list' => __( 'Slider list', 'textdomain' ),
		'items_list_navigation' => __( 'Slider list navigation', 'textdomain' ),
		'filter_items_list' => __( 'Filter Slider list', 'textdomain' ),
	);
	$args = array(
		'label' => __( 'Slider', 'textdomain' ),
		'description' => __( 'Slider', 'textdomain' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-editor-video',
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields'),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => true,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'slider', $args );

}
add_action( 'init', 'create_slider_cpt', 0 );


/*CPT*/

// Register Custom Post Type Gallery
function create_gallery_cpt() {

	$labels = array(
		'name' => _x( 'Gallery', 'Post Type General Name', 'textdomain' ),
		'singular_name' => _x( 'Gallery', 'Post Type Singular Name', 'textdomain' ),
		'menu_name' => _x( 'Video Gallery', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar' => _x( 'Gallery', 'Add New on Toolbar', 'textdomain' ),
		'archives' => __( 'Gallery Archives', 'textdomain' ),
		'attributes' => __( 'Gallery Attributes', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Gallery:', 'textdomain' ),
		'all_items' => __( 'All Gallery', 'textdomain' ),
		'add_new_item' => __( 'Add New Gallery', 'textdomain' ),
		'add_new' => __( 'Add New', 'textdomain' ),
		'new_item' => __( 'New Gallery', 'textdomain' ),
		'edit_item' => __( 'Edit Gallery', 'textdomain' ),
		'update_item' => __( 'Update Gallery', 'textdomain' ),
		'view_item' => __( 'View Gallery', 'textdomain' ),
		'view_items' => __( 'View Gallery', 'textdomain' ),
		'search_items' => __( 'Search Gallery', 'textdomain' ),
		'not_found' => __( 'Not found', 'textdomain' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
		'featured_image' => __( 'Featured Image', 'textdomain' ),
		'set_featured_image' => __( 'Set featured image', 'textdomain' ),
		'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
		'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
		'insert_into_item' => __( 'Insert into Gallery', 'textdomain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Gallery', 'textdomain' ),
		'items_list' => __( 'Gallery list', 'textdomain' ),
		'items_list_navigation' => __( 'Gallery list navigation', 'textdomain' ),
		'filter_items_list' => __( 'Filter Gallery list', 'textdomain' ),
	);
	$args = array(
		'label' => __( 'Gallery', 'textdomain' ),
		'description' => __( 'Gallery', 'textdomain' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-editor-video',
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields'),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => true,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'gallery', $args );

}
add_action( 'init', 'create_gallery_cpt', 0 );

/*EVENT GALLERY*/

// Register Custom Post Type Event Gallery
function create_eventgallery_cpt() {

	$labels = array(
		'name' => _x( 'Event Gallery', 'Post Type General Name', 'textdomain' ),
		'singular_name' => _x( 'Event Gallery', 'Post Type Singular Name', 'textdomain' ),
		'menu_name' => _x( 'Event Gallery', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar' => _x( 'Event Gallery', 'Add New on Toolbar', 'textdomain' ),
		'archives' => __( 'Event Gallery Archives', 'textdomain' ),
		'attributes' => __( 'Event Gallery Attributes', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Event Gallery:', 'textdomain' ),
		'all_items' => __( 'All Event Gallery', 'textdomain' ),
		'add_new_item' => __( 'Add New Event Gallery', 'textdomain' ),
		'add_new' => __( 'Add New', 'textdomain' ),
		'new_item' => __( 'New Event Gallery', 'textdomain' ),
		'edit_item' => __( 'Edit Event Gallery', 'textdomain' ),
		'update_item' => __( 'Update Event Gallery', 'textdomain' ),
		'view_item' => __( 'View Event Gallery', 'textdomain' ),
		'view_items' => __( 'View Event Gallery', 'textdomain' ),
		'search_items' => __( 'Search Event Gallery', 'textdomain' ),
		'not_found' => __( 'Not found', 'textdomain' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
		'featured_image' => __( 'Featured Image', 'textdomain' ),
		'set_featured_image' => __( 'Set featured image', 'textdomain' ),
		'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
		'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
		'insert_into_item' => __( 'Insert into Event Gallery', 'textdomain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Event Gallery', 'textdomain' ),
		'items_list' => __( 'Event Gallery list', 'textdomain' ),
		'items_list_navigation' => __( 'Event Gallery list navigation', 'textdomain' ),
		'filter_items_list' => __( 'Filter Event Gallery list', 'textdomain' ),
	);
	$args = array(
		'label' => __( 'Event Gallery', 'textdomain' ),
		'description' => __( '', 'textdomain' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-format-gallery',
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'eventgallery', $args );

}
add_action( 'init', 'create_eventgallery_cpt', 0 );