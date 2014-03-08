<?php
/*******************************
 * Custom post type members:
 * 
 */


function BWB_custom_post_type_staff_init() {

  $taxonomy_labels = array(
    'name'              => _x( 'Staff Positions', 'taxonomy general name' ),
    'singular_name'     => _x( 'Staff Position', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Staff Positions' ),
    'all_items'         => __( 'All Staff Positions' ),
    'parent_item'       => __( 'Parent Staff Position Type' ),
    'parent_item_colon' => __( ':' ),
    'edit_item'         => __( 'Edit Staff Position' ),
    'update_item'       => __( 'Update Staff Position' ),
    'add_new_item'      => __( 'Add New Staff Position' ),
    'new_item_name'     => __( 'New Staff Position' ),
    'menu_name'         => __( 'Staff Position' ),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $taxonomy_labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'position' ),
  );

  register_taxonomy( 'position', 'BWB_position', $args );

  
  $staff_labels = array(
    'name'               => 'Staff',
    'singular_name'      => 'Staff',
    'add_new'            => 'Add New',
    'add_new_item'       => 'Add New Staff',
    'edit_item'          => 'Edit Staff',
    'new_item'           => 'New Staff',
    'all_items'          => 'All Staff Members',
    'view_item'          => 'View Staff',
    'search_items'       => 'Search Staff Members',
    'not_found'          => 'No staff members found',
    'not_found_in_trash' => 'No staff members found in Trash',
    'parent_item_colon'  => '',
    'menu_name'          => 'Staff'
  );

  register_post_type( 'BWB_staff',
    array(
      'taxonomies'    => array('position'),
      'labels'        => $staff_labels,
      'public'        => true,
      'has_archive'   => true,
      'menu_position' => 20,
      'rewrite'       => array('slug' => 'staff'),
      'add_new'       => _x('Add Staff', 'BWB'),
      'supports'      => array( 'title', 'editor', 'hierarchical', 'revisions', 'thumbnail', 'page-attributes'),
    )
  );
}

add_action('init', 'BWB_custom_post_type_staff_init');


/**
 * Adds a box to the main column on the Page edit screens.
 */
function BWB_staff_add_meta_boxes() {

  $screens = array( 'BWB_staff' );

  foreach ( $screens as $screen ) {

    add_meta_box(
      'BWB_staff_settings',
      __( 'Staff Settings', 'BWB' ),
      'BWB_staff_settings_box',
      $screen
    );
  }
}
add_action( 'add_meta_boxes', 'BWB_staff_add_meta_boxes' );



/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function BWB_staff_settings_box( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'BWB_staff_settings_box', 'BWB_staff_settings_box_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  
  $BWB_staff = get_post_meta( $post->ID, 'BWB_staff', true);
  
  //~ print_r('<h1>BWB STaff=</h1>');
  //~ print_r($BWB_staff);
  //~ print('<br>');

  if ( ! isset ( $BWB_staff['homepage']) ) :
    $BWB_staff['homepage'] = '';
  endif;

  if ( ! isset ( $BWB_staff['social']) ) :
    $BWB_staff['social'] = '';
  endif;

  if ( ! isset ( $BWB_staff['title']) ) :
    $BWB_staff['title'] = '';
  endif;
  ?>
  <div>
    <h4><?php _e('Homepage url:', 'BWB')?></h4>
    <input type="text" name="BWB_staff[homepage]" value="<?php echo $BWB_staff['homepage'] ?>">
    <label><?php _e('The homepage url of this staff member.', 'BWB')?></label>
  </div>
  
  <hr>  
  
  <div>
    <h4><?php _e('Staff Title:', 'BWB')?></h4>
    <input type="text" name="BWB_staff[title]" value="<?php echo $BWB_staff['title'] ?>">
    <label><?php _e('This is the staff position within the organisation.', 'BWB')?></label>
  </div>

  <hr>
  
  <div>
    <h4><?php _e('Staff Social Links:', 'BWB')?></h4>
    <input type="checkbox" name="BWB_staff[social]"<?php if ( !isset ($BWB_staff['social'] ) ) { $BWB_staff['social'] = false; } checked($BWB_staff['social'] )?>>
    <div><?php _e('Toggles the visibility of the page content, stationary, in front of the staff:', 'BWB')?></div>
  </div>
  
  <hr>  
  

  <?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function BWB_staff_save_postdata( $post_id ) {

  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['BWB_staff_settings_box_nonce'] ) )
    return $post_id;

  $nonce = $_POST['BWB_staff_settings_box_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'BWB_staff_settings_box' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;

  // Check the user's permissions.
  if ( 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;
  
  } else {

    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
  }

  /* OK, its safe for us to save the data now. */

  // Sanitize user input.
  $BWB_staff = $_POST['BWB_staff'];

  if (!empty( $BWB_staff ) ) :

    foreach ( $BWB_staff as $key => $value ) :
      if ( $value === 'on' ) :
        $BWB_staff[$key] = true;
      endif;
    endforeach;
  endif;

  //save staff custom post meta
  update_post_meta( $post_id, 'BWB_staff', $BWB_staff );
}

add_action( 'save_post', 'BWB_staff_save_postdata' );
?>
