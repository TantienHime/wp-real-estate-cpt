<?php
/**
 * Plugin Name: My CPT
 * Plugin URI: http://shanta.ca
 * Description: Simple CPT Plugin
 * Version: 0.1
 * Author: Shanta
 * Author URI: http://shanta.ca
 * License: GPL2
 */

/*Create my listings CPT*/

function my_custom_posttypes(){
	    $labels = array(
        'name'               => 'Listings',
        'singular_name'      => 'Listing',
        'menu_name'          => 'Listings',
        'name_admin_bar'     => 'Listing',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Listing',
        'new_item'           => 'New Listing',
        'edit_item'          => 'Edit Listing',
        'view_item'          => 'View Listing',
        'all_items'          => 'All Listings',
        'search_items'       => 'Search Listings',
        'parent_item_colon'  => 'Parent Listings:',
        'not_found'          => 'No Listings found.',
        'not_found_in_trash' => 'No Listings found in Trash.',
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-location-alt',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'listings' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-field', 'comments' ),
 		'taxonomies'         => array( 'category', 'post_tag' )
	);

register_post_type( 'listings', $args );
}

add_action('init', 'my_custom_posttypes');

function my_rewrite_flush() {
    // First, we "add" the custom post type via the above written function.
    // Note: "add" is written with quotes, as CPTs don't get added to the DB,
    // They are only referenced in the post_type column with a post entry, 
    // when you add a post of this CPT.
    my_custom_posttypes();

    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_rewrite_flush' );

// Custom Taxonomies

function my_custom_taxonomies(){
	
    // Type of Listing taxonomy
    $labels = array(
        'name'              => 'Type of Listings',
        'singular_name'     => 'Type of Listing',
        'search_items'      => 'Search Types of Listings',
        'all_items'         => 'All Types of Listings',
        'parent_item'       => 'Parent Type of Listing',
        'parent_item_colon' => 'Parent Type of Listing:',
        'edit_item'         => 'Edit Type of Listing',
        'update_item'       => 'Update Type of Listing',
        'add_new_item'      => 'Add New Type of Listing',
        'new_item_name'     => 'New Type of Listing',
        'menu_name'         => 'Type of Listing',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'listing-type' ),
    );

    register_taxonomy( 'listing-type', array( 'listings', 'post' ), $args );

    // Feature taxonomy (non-hierarchical)
    $labels = array(
        'name'                       => 'Features',
        'singular_name'              => 'Feature',
        'search_items'               => 'Search Features',
        'popular_items'              => 'Popular Features',
        'all_items'                  => 'All Features',
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => 'Edit Feature',
        'update_item'                => 'Update Feature',
        'add_new_item'               => 'Add New Feature',
        'new_item_name'              => 'New Feature Name',
        'separate_items_with_commas' => 'Separate features with commas',
        'add_or_remove_items'        => 'Add or remove features',
        'choose_from_most_used'      => 'Choose from the most used Features',
        'not_found'                  => 'No Features found.',
        'menu_name'                  => 'Features',
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'features' ),
    );

    register_taxonomy( 'features', array( 'listings', 'post' ), $args );

        // Type of Listing taxonomy
    $labels = array(
        'name'              => 'Type of Ownerships',
        'singular_name'     => 'Type of Ownership',
        'search_items'      => 'Search Types of Ownerships',
        'all_items'         => 'All Types of Ownerships',
        'parent_item'       => 'Parent Type of Ownership',
        'parent_item_colon' => 'Parent Type of Ownership:',
        'edit_item'         => 'Edit Type of Ownership',
        'update_item'       => 'Update Type of Ownership',
        'add_new_item'      => 'Add New Type of Ownership',
        'new_item_name'     => 'New Type of Ownership',
        'menu_name'         => 'Type of Ownership',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'ownership' ),
    );

    register_taxonomy( 'ownership', array( 'listings', 'post' ), $args );

}

add_action( 'init', 'my_custom_taxonomies' );

?>