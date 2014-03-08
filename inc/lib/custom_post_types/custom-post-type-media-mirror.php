<?php
/*******************************
 * Custom post type members:
 * 
 */


function BWB_custom_post_type_media_mirror_init() {
  
  //~ $taxonomy_labels = array(
    //~ 'name'              => _x( 'Media Mirror Entries', 'taxonomy general name' ),
    //~ 'singular_name'     => _x( 'Media Mirror Entry', 'taxonomy singular name' ),
    //~ 'search_items'      => __( 'Search Media Mirror Entries' ),
    //~ 'all_items'         => __( 'All Media Mirror Entries' ),
    //~ 'parent_item'       => __( 'Parent Media Mirror Entry' ),
    //~ 'parent_item_colon' => __( ':' ),
    //~ 'edit_item'         => __( 'Edit Media Mirror Entry' ),
    //~ 'update_item'       => __( 'Update Media Mirror Entry' ),
    //~ 'add_new_item'      => __( 'Add New Media Mirror Entry' ),
    //~ 'new_item_name'     => __( 'New Media Mirror Entry' ),
    //~ 'menu_name'         => __( 'Media Mirror Entry' ),
  //~ );
//~ 
  //~ $args = array(
    //~ 'hierarchical'      => true,
    //~ 'labels'            => $taxonomy_labels,
    //~ 'show_ui'           => true,
    //~ 'show_admin_column' => true,
    //~ 'query_var'         => true,
    //~ 'rewrite'           => array( 'slug' => 'position' ),
  //~ );
//~ 
  //~ register_taxonomy( 'type', 'BWB_', $args );

  
  $media_mirror_labels = array(
    'name'               => 'Media Mirror Entries',
    'singular_name'      => 'Media Mirror Entry',
    'add_new'            => 'Add Media Mirror Entry',
    'add_new_item'       => 'Add New Media Mirror Entry',
    'edit_item'          => 'Edit Media Mirror Entry',
    'new_item'           => 'New Media Mirror Entry',
    'all_items'          => 'All Media Mirror Entries',
    'view_item'          => 'View Media Mirror Entry',
    'search_items'       => 'Search Media Mirror Entries',
    'not_found'          => 'No Media Mirror Entries found',
    'not_found_in_trash' => 'No Media Mirror Entries found in Trash',
    'parent_item_colon'  => '',
    'menu_name'          => 'Media Mirror'
  );

  register_post_type( 'BWB_media_mirror',
    array(
      'labels' => $media_mirror_labels,
      'public' => true,
      'has_archive' => true,
      'menu_position' => 20,
      'rewrite' => array('slug' => 'mediamirror'),
      'add_new' => _x('Add Staff', 'BWB'),
      'supports' => array( 'title', 'editor', 'hierarchical', 'revisions', 'thumbnail'),
    )
  );
}

add_action('init', 'BWB_custom_post_type_media_mirror_init');


/**
 * Adds a box to the main column on the Page edit screens.
 */
function BWB_media_mirror_add_meta_boxes() {

  $screens = array( 'BWB_media_mirror' );

  foreach ( $screens as $screen ) {

    add_meta_box(
      'BWB_media_mirror_settings',
      __( 'Media Mirror Settings', 'BWB' ),
      'BWB_media_mirror_settings_box',
      $screen
    );
  }
}
add_action( 'add_meta_boxes', 'BWB_media_mirror_add_meta_boxes' );



/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function BWB_media_mirror_settings_box( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'BWB_media_mirror_settings_box', 'BWB_media_mirror_settings_box_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  
  $BWB_media_mirror = get_post_meta( $post->ID, 'BWB_media_mirror', true);

  if ( ! isset ( $BWB_media_mirror['homepage']) ) :
    $BWB_media_mirror['homepage'] = '';
  endif;

  if ( ! isset ( $BWB_media_mirror['social']) ) :
    $BWB_media_mirror['social'] = '';
  endif;

  if ( ! isset ( $BWB_media_mirror['title']) ) :
    $BWB_media_mirror['title'] = '';
  endif;
  ?>
  <div>
    <h4><?php _e('Homepage url:', 'BWB')?></h4>
    <input type="text" name="BWB_media_mirror[homepage]" value="<?php echo $BWB_media_mirror['homepage'] ?>">
    <label><?php _e('The external url of this news item.', 'BWB')?></label>
  </div>
  
  <hr>
  <?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function BWB_media_mirror_save_postdata( $post_id ) {

  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['BWB_media_mirror_settings_box_nonce'] ) )
    return $post_id;

  $nonce = $_POST['BWB_media_mirror_settings_box_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'BWB_media_mirror_settings_box' ) )
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
  $BWB_media_mirror = $_POST['BWB_media_mirror'];

  if (!empty( $BWB_media_mirror ) ) :

    foreach ( $BWB_media_mirror as $key => $value ) :
      if ( $value === 'on' ) :
        $BWB_media_mirror[$key] = true;
      endif;
    endforeach;
  endif;

  //save staff custom post meta
  update_post_meta( $post_id, 'BWB_media_mirror', $BWB_media_mirror );
}

add_action( 'save_post', 'BWB_media_mirror_save_postdata' );


function BWB_media_mirror_shortcode( $atts ) {
  extract( shortcode_atts( array(
    'ids'         => array(),
    'categories'  => array(),
    'tags'        => array(),
    'logo_only'   => false,
    'num'         => 5,
    'name'       => array(),
  ), $atts, 'mirror' ) );

  $args = array(
    'post_type'      => 'BWB_media_mirror',
    'posts_per_page' => $num,
    'post__in'       => $ids,
    'order'          => 'DESC',
    'orderby'        => 'menu_order title',
  );


  if (! empty ($name) ) :
    $args['name'] = $name;
  endif;

  if (! empty ($ids) ) :
    if ( strpos($ids, ',') !== false ) :
      $ids = explode(',', $ids);
      $args['post__in'] = $ids;
    else :
      $args['p'] = $ids;
    endif;
  endif;

  if (! empty ($categories) ) :
    if ( strpos($categories, ',') !== false ) :
      $categories['category__in'] = explode(',', $categories);
    else :
      $args['cat'] = $categories;
    endif;
  endif;


  if (! empty ($tags) ) :
    if ( strpos($tags, ',') !== false ) :
      $args['tag_slug__in'] = explode(',', $tags);
    else :
      $args['tag'] = $tags;
    endif;
  endif;

  if ( empty($ids) && empty($categories) && empty ($tags) && empty($names)) :
    //the user made no decisions, load the 5 newest posts.
    $args['orderby'] = 'date ' . $args['orderby'];
  endif;


  
  //~ print('loading mediamirrors with args:');
  //~ print_r($args);

  // The Query
  $the_query = new WP_Query( $args );
  $ret = '';

  // The Loop
  if ( $the_query->have_posts() ) :
    $ret .=   '<div class="media-mirror-container slideshow-container">';

    $num_of_posts = 0;

    while ( $the_query->have_posts() ) :
      $the_query->the_post();

      $num_of_posts++;

      $id = get_the_ID();
      $ret .=   '<div id="media-mirror-' . $id . '" class="media-mirror">';

      $ret .=     '<header>';

      $BWB_media_mirror = get_post_meta( $id, 'BWB_media_mirror', true );

      $link = (isset ( $BWB_media_mirror['homepage'] ) ) ? $BWB_media_mirror['homepage'] : get_post_permalink( $id ); 

      if ( has_post_thumbnail( $id ) ) :
        $ret .=     '<a class="logo" href="' . $link . '">';
        $ret .=       get_the_post_thumbnail( $id );
        $ret .=     '</a>';
      endif;

      if ( ! isset ($logo_only) ) :
        $ret .=       '<a class="title" href="' . get_post_permalink( $id ) . '">';
        $ret .=         get_the_title();
        $ret .=       '</a>';
      endif;

      $ret .=     '</header>';

      
      if ( ! isset ($logo_only) ) :
        $ret .=   '<div class="entry-content">' . get_the_content() . '</div>';
      endif;
      $ret .= '</div>';
    endwhile;

    $ret .= '</div>';
  endif;

  /* Restore original Post Data */
  wp_reset_postdata();

  return $ret;
}

add_shortcode( 'mirror', 'BWB_media_mirror_shortcode' );

?>
