<?php
/***********************************************************************
 * BWB Theme Setup functions
 */


add_action('after_setup_theme', 'bwb_setup');

function bwb_setup() {
  register_nav_menus( array(
    'top' => __( 'Top Menu', 'bwb' ),
    'bottom' => __( 'Bottom Menu', 'bwb' ),
    'left' => __( 'Left Menu', 'bwb' ),
    'right' => __( 'Right Menu', 'bwb' ),
  ) );

  register_post_type( 'bwb_members', array(
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'people' ),
    'has_archive' => true,
    'hierarchical' => true,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'thumbnail', 'revisions', 'page-attributes', 'excerpt' ),
    'taxonomies' => array(),
    'capability_type' => 'page',
    'capabilities' => array(),
    'menu_icon'=> 'dashicons-screenoptions',
    'labels' => array(
      'name' => __( 'Members', 'quadro' ),
      'singular_name' => __( 'Member', 'quadro' ),
      'add_new' => __( 'Add New', 'quadro' ),
      'add_new_item' => __( 'Add New Member', 'quadro' ),
      'edit_item' => __( 'Edit Member', 'quadro' ),
      'new_item' => __( 'New Member', 'quadro' ),
      'all_items' => __( 'All Members', 'quadro' ),
      'view_item' => __( 'View Member', 'quadro' ),
      'search_items' => __( 'Search Members', 'quadro' ),
      'not_found' =>  __( 'No Member found', 'quadro' ),
      'not_found_in_trash' => __( 'No Member found in Trash', 'quadro' ),
      'parent_item_colon' => '',
      'menu_name' => 'Members',
    )
  ) );
}
?>
