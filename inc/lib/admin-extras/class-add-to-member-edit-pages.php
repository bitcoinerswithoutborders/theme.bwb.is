<?php

/**
 * Calls the class on the post edit screen.
 */
function call_BWB_Member_Meta_Box() {
    new BWB_Member_Meta_Box();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'call_BWB_Member_Meta_Box' );
    add_action( 'load-post-new.php', 'call_BWB_Member_Meta_Box' );
}

/** 
 * The Class.
 */
class BWB_Member_Meta_Box {

  /**
   * Hook into the appropriate actions when the class is constructed.
   */
  public function __construct() {
    add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
    add_action( 'save_post', array( $this, 'save' ) );
  }

  /**
   * Adds the meta box container.
   */
  public function add_meta_box( $post_type ) {
    $post_types = array('bwb_members');     //limit meta box to certain post types
    if ( in_array( $post_type, $post_types )) {
      add_meta_box(
        'BWB_members_admin_extras'
        ,__( 'Some Member Settings', 'BWB' )
        ,array( $this, 'render_meta_box_content' )
        ,$post_type
        ,'advanced'
        ,'high'
      );
    }
  }

  /**
   * Save the meta when the post is saved.
   *
   * @param int $post_id The ID of the post being saved.
   */
  public function save( $post_id ) {
  
    /*
     * We need to verify this came from the our screen and with proper authorization,
     * because save_post can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['bwb_member_inner_custom_box_nonce'] ) )
      return $post_id;

    $nonce = $_POST['bwb_member_inner_custom_box_nonce'];

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'bwb_member_inner_custom_box' ) )
      return $post_id;

    // If this is an autosave, our form has not been submitted,
                //     so we don't want to do anything.
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


    // Sanitize the user input.

    $current_member = get_post_meta($post->ID, "bwb_member", true);

    $member = sanitize_text_field( $_POST['bwb_member'] );

    $this->my_meta_clean($member);
    // Update the meta field.
    update_post_meta( $post_id, 'bwb_member', $member );
  }

  private function my_meta_clean($member, $current_member) {
    
  }

  /**
   * Render Meta Box content.
   *
   * @param WP_Post $post The post object.
   */
  public function render_meta_box_content( $post ) {
  
    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'bwb_member_inner_custom_box', 'bwb_member_inner_custom_box_nonce' );


    // Use get_post_meta to retrieve an existing value from the database.
    $member = get_post_meta( $post->ID, 'bwb_member', true );

    // Display the form, using the current value.
    echo '<label for="bwb_member[nickname]">';
    _e( 'Description for this field', 'BWB' );
    echo '</label> ';
    echo '<input type="text" id="bwb_member[nickname]" name="bwb_member[nickname]" value="' . esc_attr( isset($member['nickname']) ? $member['nickname'] : '' ) . '" size="25" />';
  }
}
