<?php

function BWB_custom_post_type_member_init() {

  $taxonomy_labels = array(
    'name'              => _x( 'Member Types', 'taxonomy general name' ),
    'singular_name'     => _x( 'Member Type', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Member Types' ),
    'all_items'         => __( 'All Member Types' ),
    'parent_item'       => __( 'Parent Member Type' ),
    'parent_item_colon' => __( ':' ),
    'edit_item'         => __( 'Edit Member Type' ),
    'update_item'       => __( 'Update Member Type' ),
    'add_new_item'      => __( 'Add New Member Type' ),
    'new_item_name'     => __( 'New Member Type Name' ),
    'menu_name'         => __( 'Member Type' ),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $taxonomy_labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'membertype' ),
  );

  register_taxonomy( 'type', 'BWB_member', $args );

  $member_labels = array(
    'name'               => 'Members',
    'singular_name'      => 'Member',
    'add_new'            => 'Add New',
    'add_new_item'       => 'Add New Member',
    'edit_item'          => 'Edit Member',
    'new_item'           => 'New Member',
    'all_items'          => 'All Members',
    'view_item'          => 'View Member',
    'search_items'       => 'Search Members',
    'not_found'          => 'No members found',
    'not_found_in_trash' => 'No members found in Trash',
    'parent_item_colon'  => '',
    'menu_name'          => 'Members'
  );


  register_post_type( 'BWB_member',
    array(
      'taxonomies'    => array('type'),
      'public'        => true,
      'has_archive'   => true,
      'menu_position' => 20,
      'labels'        => $member_labels,
      'rewrite'       => array('slug' => 'member'),
      'add_new'       => _x('Add Member', 'BWB'),
      'supports'      => array( 'title', 'editor', 'revisions', 'thumbnail'),
    )
  );
}

add_action('init', 'BWB_custom_post_type_member_init');


/**
 * Adds a box to the main column on the Page edit screens.
 */
function BWB_member_add_meta_boxes() {

    $screens = array( 'BWB_member' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'BWB_member_data',
            __( 'Member Settings', 'BWB' ),
            'BWB_member_data_box',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'BWB_member_add_meta_boxes' );



/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function BWB_member_data_box( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'BWB_member_sizes_box', 'BWB_member_box_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  
  $BWB_member = get_post_meta( $post->ID, 'BWB_member', true);

  if (!isset($BWB_member['homepage'] ) ) :
    $BWB_member['homepage'] = '';
  endif;

  ?>
  <div>
    <h4><?php _e('Member Homepage Url:', 'BWB')?></h4>
    <input type="text" name="BWB_member[homepage]" value="<?php echo $BWB_member['homepage'] ?>">
    <label><?php _e('This is the link of the member logo.', 'BWB')?></label>
  </div>
  <?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function BWB_member_save_postdata( $post_id ) {

  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['BWB_member_box_nonce'] ) )
    return $post_id;

  $nonce = $_POST['BWB_member_box_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'BWB_member_sizes_box' ) )
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
  $BWB_member = $_POST['BWB_member'];
  
  if (!empty( $BWB_member ) ) :

    foreach ( $BWB_member as $key => $value ) :
      if ($value === 'on') :
        $BWB_member[$key] = true;
      endif;
    endforeach;
  endif;

  //member height and max/min settings
  update_post_meta( $post_id, 'BWB_member', $BWB_member );

}

add_action( 'save_post', 'BWB_member_save_postdata' );



function BWB_member_shortcode( $atts ) {
  extract( shortcode_atts( array(
    'ids'         => array(),
    'categories'  => array(),
    'tags'        => array(),
    'logo_only'   => false,
    'num'         => -1,
    'name'       => array(),
  ), $atts, 'mirror' ) );

  $args = array(
    'post_type'      => 'BWB_member',
    'posts_per_page' => $num,
    'order'          => 'ASC',
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
      print_r(explode(',', $tags));
      $args['tag_slug__in'] = explode(',', $tags);
    else :
      $args['tag'] = $tags;
    endif;
  endif;

  if ( empty($ids) && empty($categories) && empty ($tags) && empty($names)) :
    //the user made no decisions, load the 5 newest posts.
    $args['orderby'] = 'date ' . $args->orderby;
  endif;


  
  //~ print('loading mediamirrors with args:');
  //~ print_r($args);

  // The Query
  $the_query = new WP_Query( $args );
  $members = array(
    'platinum' => '<div class="platinum member-container-div"><header>Platinum:</header><ul class="member-container-ul">',
    'gold' => '<div class="gold member-container-div"><header>Gold:</header><ul class="member-container-ul">',
    'silver' => array(
      'small' => '<div class="silver small member-container-div"><header>Silver Small:</header><ul class="member-container-ul">',
      'medium' => '<div class="silver medium member-container-div"><header>Silver Medium:</header><ul class="member-container-ul">',
      'large' => '<div class="silver large member-container-div"><header>Silver Large:</header><ul class="member-container-ul">',
    ),
  );

  // The Loop
  if ( $the_query->have_posts() ) :
    
    $ret .=   '<div class="member-container slideshow-container">';

    $num_of_posts = 0;

    while ( $the_query->have_posts() ) :
      $the_query->the_post();
      
      $num_of_posts++;
      
      $id = get_the_ID();

      $member_type = wp_get_post_terms($id, 'type', array('fields' => 'names') );

   
      //~ $member_ret = print_r($member_type, true);


      $member_ret = '<li id="member-' . $id . '" class="member">';


      $BWB_member = get_post_meta( $id, 'BWB_member', true );

      $link = (isset ( $BWB_member['homepage'] ) ) ? $BWB_member['homepage'] : get_post_permalink( $id ); 

      if ( has_post_thumbnail( $id ) ) :
        $member_ret .=     '<a class="logo" href="' . $link . '">';
        $member_ret .=       get_the_post_thumbnail( $id );
        $member_ret .=     '</a>';
      endif;

      $member_ret .= '</li>';

      //~ $ret .= print_r($member_type, true);

      if ( in_array( 'Platinum', $member_type ) ) :
        $members['platinum'] .= $member_ret;

      elseif ( in_array( 'Gold', $member_type ) ) :
        $members['gold'] .= $member_ret;

      elseif ( in_array( 'Silver', $member_type ) ) :

        if ( in_array('Large', $member_type ) ) :
          $members['silver']['large'] .= $member_ret;

        elseif ( in_array ('Medium', $member_type ) ) :
          $members['silver']['medium'] .= $member_ret;        

        else :
          $members['silver']['small'] .= $member_ret;
        endif;
      endif;


    endwhile;

    //close all those uls and divs
    $members['platinum'] .= '</ul></div>';
    $members['gold'] .= '</ul></div>';
    $members['silver']['large'] .= '</ul></div>';
    $members['silver']['medium'] .= '</ul></div>';
    $members['silver']['small'] .= '</ul></div>';

    $ret .= $members['platinum'];
    $ret .= $members['gold'];
    $ret .= $members['silver']['big'];
    $ret .= $members['silver']['middle'];
    $ret .= $members['silver']['small'];
    $ret .= '</div>';
  endif;

  /* Restore original Post Data */
  wp_reset_postdata();

  return $ret;
}

add_shortcode( 'members', 'BWB_member_shortcode' );

?>
