<?php

function BWB_custom_post_type_slideshow_init() {

  
  $slideshow_labels = array(
    'name'               => 'Slideshows',
    'singular_name'      => 'Slideshow',
    'add_new'            => 'Add New',
    'add_new_item'       => 'Add New Slideshow',
    'edit_item'          => 'Edit Slideshow',
    'new_item'           => 'New Slideshow',
    'all_items'          => 'All Slideshows',
    'view_item'          => 'View Slideshow',
    'search_items'       => 'Search Slideshows',
    'not_found'          => 'No slideshows found',
    'not_found_in_trash' => 'No slideshows found in Trash',
    'parent_item_colon'  => '',
    'menu_name'          => 'Slideshows'
  );


  register_post_type( 'BWB_slideshow',
    array(
      'labels' => $slideshow_labels,
      'public' => true,
      'has_archive' => true,
      'menu_position' => 20,
      'rewrite' => array('slug' => 'slideshows'),
      'add_new' => _x('Add Slideshow', 'BWB'),
      'supports' => array( 'title', 'editor', 'hierarchical', 'page-attributes', 'revisions'),
    )
  );
}

add_action('init', 'BWB_custom_post_type_slideshow_init');


/**
 * Adds a box to the main column on the Page edit screens.
 */
function BWB_slideshow_add_meta_boxes() {

    $screens = array( 'BWB_slideshow' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'BWB_slideshow_sizes',
            __( 'Slideshow Image Sizes', 'BWB' ),
            'BWB_slideshow_sizes_box',
            $screen
        );

        add_meta_box(
            'BWB_slideshow_animation',
            __( 'Slideshow Animation Settings', 'BWB' ),
            'BWB_slideshow_animation_box',
            $screen
        );

        add_meta_box(
            'BWB_slideshow_showhide',
            __( 'Slideshow Userinterface Settings', 'BWB' ),
            'BWB_slideshow_gui_box',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'BWB_slideshow_add_meta_boxes' );


/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function BWB_slideshow_sizes_box( $post ) {


  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'BWB_slideshow_sizes_box', 'BWB_slideshow_box_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  
  $BWB_slideshow = get_post_meta( $post->ID, 'BWB_slideshow', true);
    
  //~ print_r($BWB_slideshow);
  ?>
  <div>
    <label><?php _e('Image Height:', 'BWB')?></label>
    <input type="text" name="BWB_slideshow[height]" value="<?php echo $BWB_slideshow['height']?>">
  </div>
  
  <hr>
  
  <h4><?php _e('Max and Min Height for images, needed when using percentage above:', 'BWB')?></h4>
  <div>
    <label><?php _e('Image max height:', 'BWB')?></label>
    <input type="text" name="BWB_slideshow[max_height]" value="<?php echo $BWB_slideshow['max_height']?>">
  </div>

  <hr>
  
  <div>
    <label><?php _e('Image min height:', 'BWB')?></label>
    <input type="text" name="BWB_slideshow[min_height]" value="<?php echo $BWB_slideshow['min_height']?>">
  </div>
  <?php
}

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function BWB_slideshow_animation_box( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'BWB_slideshow_sizes_box', 'BWB_slideshow_box_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  
  $BWB_slideshow = get_post_meta( $post->ID, 'BWB_slideshow', true);
  
  //~ print_r($BWB_slideshow);
  
  ?>
  <div>
    <label><?php _e('Move Slideshow automatically:', 'BWB')?></label>
    <input type="checkbox" name="BWB_slideshow[automove]"<?php if (!isset ($BWB_slideshow['show_ui'] ) ) { $BWB_slideshow['show_ui'] = false; } checked( $BWB_slideshow['automove'] )?>>
  </div>
  
  <hr>
  
  <div>
    <h4><?php _e('Time between slides:', 'BWB')?></h4>
    <input type="text" name="BWB_slideshow[slide_time_between]" value="<?php echo $BWB_slideshow['slide_time_between']?>">
  </div>

  <hr>

  <div>
    <label><?php _e('Time taken by one slide movement:', 'BWB')?></label>
    <input type="text" name="BWB_slideshow[slide_duration]" value="<?php echo $BWB_slideshow['slide_duration']?>">
  </div>

  <?php
}


/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function BWB_slideshow_gui_box( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'BWB_slideshow_sizes_box', 'BWB_slideshow_box_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  
  $BWB_slideshow = get_post_meta( $post->ID, 'BWB_slideshow', true);
  ?>
  <div>
    <h4><?php _e('Show slideshow user interface:', 'BWB')?></h4>
    <input type="checkbox" name="BWB_slideshow[show_ui]"<?php if (!isset ($BWB_slideshow['show_ui'] ) ) { $BWB_slideshow['show_ui'] = false; } checked($BWB_slideshow['show_ui'] )?>>
    <label><?php _e('Toggles the visibility of the slideshow gui (button on right and left), requires: javascript', 'BWB')?></label>
  </div>
  
  <hr>  
  
  <div>
    <h4><?php _e('Show Slideshow Title:', 'BWB')?></h4>
    <input type="checkbox" name="BWB_slideshow[show_title]"<?php if ( !isset ($BWB_slideshow['show_title'] ) ) { $BWB_slideshow['show_title'] = false; } checked($BWB_slideshow['show_title'] )?>>
    <label><?php _e('Toggles the visibility of the title of this page over all the images, stationary:', 'BWB')?></label>
  </div>
  
  <hr>
  
  <div>
    <h4><?php _e('Show Slideshow Content', 'BWB')?></h4>
    <input type="checkbox" name="BWB_slideshow[show_content]"<?php if ( !isset ($BWB_slideshow['show_content'] ) ) { $BWB_slideshow['show_content'] = false; } checked($BWB_slideshow['show_content'] )?>>
    <div><?php _e('Toggles the visibility of the page content, stationary, in front of the slideshow:', 'BWB')?></div>
  </div>
  
  <hr>  
  
  <div>
    <h4><?php _e('Show Image Title:', 'BWB')?></h4>
    <input type="checkbox" name="BWB_slideshow[show_image_caption]"<?php if ( !isset ($BWB_slideshow['show_image_caption'] ) ) { $BWB_slideshow['show_image_caption'] = false; } checked($BWB_slideshow['show_image_caption'] )?>>
    <div><?php _e('Toggles visibility of the Image Caption, sliding with the images', 'BWB')?></div>
  </div>
  
  <hr>
  
  <div>
    <h4><?php _e('Show Image Content:', 'BWB')?></h4>
    <input type="checkbox" name="BWB_slideshow[show_image_description]"<?php if ( !isset ($BWB_slideshow['show_image_description'] ) ) { $BWB_slideshow['show_image_description'] = false; } checked($BWB_slideshow['show_image_description'] )?>>
    <div><?php _e('Toggles visibility of the Image description , sliding with the images', 'BWB')?></div>
  </div>
  
  <hr>

  <?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function BWB_slideshow_save_postdata( $post_id ) {

  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['BWB_slideshow_box_nonce'] ) )
    return $post_id;

  $nonce = $_POST['BWB_slideshow_box_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'BWB_slideshow_sizes_box' ) )
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
  $mydata = $_POST['BWB_slideshow'];
  
  if (!empty( $mydata ) ) :

    foreach ( $mydata as $key => $value ) :
      if ($value === 'on') {
        $mydata[$key] = true;
      }
    endforeach;
  endif;

  // Update the meta field in the database.
  update_post_meta( $post_id, 'BWB_slideshow', $mydata );

  //~ print('<h1>$_POST:</h1>');
  //~ $BWB_slideshow = $_POST['BWB_slideshow'];
  //~ print_r($BWB_slideshow);
  //~ print('<hr>');
  // THIS KILLS WORDPRESS BY CALLING A NON EXISTENT FUNCTION!!!!
  //~ wpdir();
  //~ 
  
  
  $BWB_slideshow = $_POST['BWB_slideshow'];

  $true_or_false_fields = array(
    'show_ui',
    'show_title',
    'show_content',
    'show_image_caption',
    'show_image_description',
  );
  foreach ($true_or_false_fields as $field_name ) :
    if ( ! isset ( $BWB_slideshow[$field_name] ) ) :
      $BWB_slideshow[$field_name] = false;
    endif;
  endforeach;

  if ( ! isset ( $BWB_slideshow['slide_time_between'] ) ) :
    $BWB_slideshow['slide_time_between'] = 5;
  endif;

  
  if ( ! isset ( $BWB_slideshow['slide_duration'] ) ) :
    $BWB_slideshow['slide_duration'] = 5;
  endif;




  //slideshow height and max/min settings
  //~ update_post_meta( $post_id, 'BWB_slideshow[height]', $BWB_slideshow['height'] );

  //~ update_post_meta( $post_id, 'BWB_slideshow[max_height]', $BWB_slideshow['max_height'] );
  //~ update_post_meta( $post_id, 'BWB_slideshow[min_height]', $BWB_slideshow['min_height'] );


  //animation edit metabox settings
  update_post_meta( $post_id, 'BWB_slideshow[automove]', $BWB_slideshow['automove'] );
  update_post_meta( $post_id, 'BWB_slideshow[slide_time_between]', $BWB_slideshow['slide_time_between'] );
  update_post_meta( $post_id, 'BWB_slideshow[slide_duration]', $BWB_slideshow['slide_duration'] );
  
  //GUI settings:
  update_post_meta( $post_id, 'BWB_slideshow[show_ui]', $BWB_slideshow['show_ui'] );
  update_post_meta( $post_id, 'BWB_slideshow[show_title]', $BWB_slideshow['show_title'] );
  update_post_meta( $post_id, 'BWB_slideshow[show_content]', $BWB_slideshow['show_content'] );  
  
  update_post_meta( $post_id, 'BWB_slideshow[show_image_caption]', $BWB_slideshow['show_image_caption'] );
  update_post_meta( $post_id, 'BWB_slideshow[show_image_description]', $BWB_slideshow['show_image_description'] );  
}

add_action( 'save_post', 'BWB_slideshow_save_postdata' );
?>
