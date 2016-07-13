<?php 
/*===========================================================
=            Owl Carousel Slide Custom Post Type            =
===========================================================*/

// Register Owl Carousel Slide Custom Post Type
function ncp_customPostTypeSlides() {

	$labels = array(
		'name'                  => _x( 'Owl Slides', 'Post Type General Name', 'owl-carousel-plus' ),
		'singular_name'         => _x( 'Owl Slide', 'Post Type Singular Name', 'owl-carousel-plus' ),
		'menu_name'             => __( 'Owl Slides', 'owl-carousel-plus' ),
		'name_admin_bar'        => __( 'Owl Slide', 'owl-carousel-plus' ),
		'archives'              => __( 'Owl Slide Archives', 'owl-carousel-plus' ),
		'parent_item_colon'     => __( 'Parent Owl Slide:', 'owl-carousel-plus' ),
		'all_items'             => __( 'All Owl Slides', 'owl-carousel-plus' ),
		'add_new_item'          => __( 'Add New Owl Slide', 'owl-carousel-plus' ),
		'add_new'               => __( 'Add New Owl Slide', 'owl-carousel-plus' ),
		'new_item'              => __( 'New Owl Slide', 'owl-carousel-plus' ),
		'edit_item'             => __( 'Edit Owl Slide', 'owl-carousel-plus' ),
		'update_item'           => __( 'Update Owl Slide', 'owl-carousel-plus' ),
		'view_item'             => __( 'View Owl Slide', 'owl-carousel-plus' ),
		'search_items'          => __( 'Search Owl Slides', 'owl-carousel-plus' ),
		'not_found'             => __( 'Not found', 'owl-carousel-plus' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'owl-carousel-plus' ),
		'featured_image'        => __( 'Featured Image', 'owl-carousel-plus' ),
		'set_featured_image'    => __( 'Set featured image', 'owl-carousel-plus' ),
		'remove_featured_image' => __( 'Remove featured image', 'owl-carousel-plus' ),
		'use_featured_image'    => __( 'Use as featured image', 'owl-carousel-plus' ),
		'insert_into_item'      => __( 'Insert into this Owl Slide', 'owl-carousel-plus' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Owl Slide', 'owl-carousel-plus' ),
		'items_list'            => __( 'Owl Slides list', 'owl-carousel-plus' ),
		'items_list_navigation' => __( 'Owl Slides list navigation', 'owl-carousel-plus' ),
		'filter_items_list'     => __( 'Filter Owl Slides list', 'owl-carousel-plus' ),
	);
	$args = array(
		'label'                 => __( 'Owl Slide', 'owl-carousel-plus' ),
		'description'           => __( 'Owl Carousel Slides', 'owl-carousel-plus' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
		'taxonomies'            => array( 'ncp-carousel' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-images-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'ncp-slides', $args );

}
add_action( 'init', 'ncp_customPostTypeSlides', 0 );

// Register Owl Carousel Slide Carousel Category Taxonomy
function ncp_OwlSlidesCarousel() {

	$labels = array(
		'name'                       => _x( 'Owl Slide Carousel', 'Taxonomy General Name', 'owl-carousel-plus' ),
		'singular_name'              => _x( 'Owl Slide Carousel', 'Taxonomy Singular Name', 'owl-carousel-plus' ),
		'menu_name'                  => __( 'Owl Slide Carousel', 'owl-carousel-plus' ),
		'all_items'                  => __( 'All Owl Slide Carousel', 'owl-carousel-plus' ),
		'parent_item'                => __( 'Parent Owl Slide Carousel', 'owl-carousel-plus' ),
		'parent_item_colon'          => __( 'Parent Owl Slide Carousel:', 'owl-carousel-plus' ),
		'new_item_name'              => __( 'New Owl Slide Carousel Name', 'owl-carousel-plus' ),
		'add_new_item'               => __( 'Add New Owl Slide Carousel', 'owl-carousel-plus' ),
		'edit_item'                  => __( 'Edit Owl Slide Carousel', 'owl-carousel-plus' ),
		'update_item'                => __( 'Update Owl Slide Carousel', 'owl-carousel-plus' ),
		'view_item'                  => __( 'View Owl Slide Carousel', 'owl-carousel-plus' ),
		'separate_items_with_commas' => __( 'Separate Owl Slide Carousel with commas', 'owl-carousel-plus' ),
		'add_or_remove_items'        => __( 'Add or remove Owl Slide Carousel', 'owl-carousel-plus' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'owl-carousel-plus' ),
		'popular_items'              => __( 'Popular Owl Slide Carousel', 'owl-carousel-plus' ),
		'search_items'               => __( 'Search Owl Slide Carousel', 'owl-carousel-plus' ),
		'not_found'                  => __( 'Not Found', 'owl-carousel-plus' ),
		'no_terms'                   => __( 'No items', 'owl-carousel-plus' ),
		'items_list'                 => __( 'Owl Slide Carousel list', 'owl-carousel-plus' ),
		'items_list_navigation'      => __( 'Owl Slide Carousel list navigation', 'owl-carousel-plus' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'ncp-carousel', array( 'ncp-slides' ), $args );

}
add_action( 'init', 'ncp_OwlSlidesCarousel', 0 );