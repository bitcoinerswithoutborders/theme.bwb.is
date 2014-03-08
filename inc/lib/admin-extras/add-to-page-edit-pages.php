<?php
/**
 * Adds a box to the main column on the Page edit screens.
 */
function BWB_admin_extras_add_childpage_box() {

  $screens = array( 'member' );

  foreach ( $screens as $screen ) {

    add_meta_box(
      'BWB_admin_extras',
      __( 'Add Page Settings', 'BWB' ),
      'BWB_admin_extras_inner_custom_box',
      $screen
    );
  }
}

add_action( 'add_meta_boxes', 'BWB_admin_extras_add_childpage_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function BWB_admin_extras_inner_custom_box( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'BWB_admin_extras_inner_custom_box', 'BWB_admin_extras_inner_custom_box_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */

  print_r($post);

  $BWB_child_pages = get_post_meta( $post->ID, 'BWB_child_pages', true );

  $BWB_page_visibility = get_post_meta( $post->ID, 'BWB_page_visibility', true );

  ?>

  <h3><?php _e('Page Visibility Settings:', 'BWB')?></h3>
  <?php
    $selector = 'show_page_title';
    $page_html_id = 'BWB_page_visibility[' . $selector . ']';

    echo '<div class="misc-BWB_childpage-actions">';
    echo '<input type="checkbox" id="' . $page_html_id . '" name="' . $page_html_id . '"';
    if ( isset( $BWB_page_visibility[$selector]) ) :
      checked($BWB_page_visibility[$selector]);
    endif;
    echo '" />';

    echo '<label for="' . $page_html_id . '">' . __('Show Page Title', 'BWB') . '</label> ';
    echo '</div>';

    $selector = 'show_page_content';
    $page_html_id = 'BWB_page_visibility[' . $selector . ']';

    echo '<div class="misc-BWB_childpage-actions">';
    echo '<input type="checkbox" id="' . $page_html_id . '" name="' . $page_html_id . '"';
    if ( isset( $BWB_page_visibility[$selector]) ) :
      checked($BWB_page_visibility[$selector]);
    endif;
    echo '" />';

    echo '<label for="' . $page_html_id . '">' . __('Show Page Content', 'BWB') . '</label> ';
    echo '</div>';
  ?>
<?php /*
  <h3><?php _e('Child Pages:', 'BWB')?></h3>
  <div><?php _e('The Pages you select here will be shown below the page content.', 'BWB')?></div>
  <div><?php _e('Drag and Drop coming soon.', 'BWB')?></div>
  <?php 
  $page_height = get_post_meta( $post->ID, 'BWB_page_height', true );

  $pages = get_pages();

  $i = 0;

  foreach ( $pages as $key => $page ) {
    if ($page->ID != get_the_ID()) {
      
      $selector = $page->post_name . '-' . $i . '-' . $page->ID;
      $i++;
      $page_html_id = 'BWB_child_pages[' . $selector . ']';
      
      //~ print('$value[$page->post_name] = ');
      //~ print_r($value[$selector]);
      //~ 
      //~ print('<br>selector = ');
      //~ print($selector);
      
      echo '<div class="misc-BWB_childpage-actions">';
      echo '<input type="checkbox" id="' . $page_html_id . '" name="' . $page_html_id . '"';
      checked(isset($BWB_child_pages[$page->ID]));
      echo '" />';
      
      echo '<label for="' . $page_html_id . '">' . $page->post_name . '</label> ';
      echo '</div>';
    }
  }
*/ 
  ?>
  <?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function BWB_admin_extras_save_postdata( $post_id ) {

  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['BWB_admin_extras_inner_custom_box_nonce'] ) )
    return $post_id;

  $nonce = $_POST['BWB_admin_extras_inner_custom_box_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'BWB_admin_extras_inner_custom_box' ) )
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

  if ( isset ( $_POST['BWB_child_pages'] ) ) :
    $BWB_child_pages = $_POST['BWB_child_pages'];
    $pages_to_save = array();
    if (!empty( $BWB_child_pages ) ) :

      foreach ( $BWB_child_pages as $key => $value ) :
        $realkey = explode('-', $key);
        $pages_to_save[$realkey[count($realkey)-1]] = true;
      endforeach;


      // Update the child pages meta field.
      update_post_meta( $post_id, 'BWB_child_pages', $pages_to_save );
    endif;
  endif;

 
  if ( isset ( $_POST['BWB_page_visibility'] ) ) :
    $BWB_page_visibility = $_POST['BWB_page_visibility'];

    if (!empty( $BWB_page_visibility ) ) :

      foreach ( $BWB_page_visibility as $key => $value ) :
        if ($value === 'on') :
          $BWB_page_visibility[$key] = true;
        endif;
      endforeach;
      // Update the child pages meta field.
      update_post_meta( $post_id, 'BWB_page_visibility', $BWB_page_visibility );
    endif;
  endif;

 
}
add_action( 'save_post', 'BWB_admin_extras_save_postdata' );
?>
