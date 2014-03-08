<?php

  /*  ================================
  *  = layout Background          =
  *  =================================
  */

  $wp_customize->add_section('BWB_layout', array(
      'title'    => __('Header Slideshow', 'BWB'),
      'priority' => 4,
  ));


    BWB_add_setting( $wp_customize, 'layout_bg_info', 'BWB_layout',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => 'hide'
        ),
        'control' => array(
          'label'    => __('You can set a Slideshow for the layout here. This will also be used as default on other pages if they have no settings of their own.', 'BWB'),
          'type'     => 'text',
          'priority' => 1,
        ), 
      )
    );

    BWB_add_setting( $wp_customize, 'layout_bg_hint', 'BWB_layout',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => 'hide'
        ),
        'control' => array(
          'label'    => __('Hint: If you upload only one image in the loaded Slideshow this will act like a normal background image. If a Video gets added it will display as a Video. Multiple Videos will show a playlist control in the near future.', 'BWB'),
          'type'     => 'text',
          'priority' => 2,
        ), 
      )
    );

    $args = array( 
      'posts_per_page' => -1,
      'orderby'      => 'menu_order',
      'order'      => 'ASC',
      'post_type' => 'BWB_slideshow',
      'post_status' => 'publish',
    );

    $loop = new WP_Query( $args );

    $posts = array();

    foreach ($loop->posts as $post) :
      //~ print('post = ');
      //~ print_r($post->ID);
      if ( isset($post->ID) && isset( $post->post_name) ) {

        $posts[$post->ID] = $post->post_name;
      }

    endforeach;   

    if( empty( $posts ) ) :
      
      BWB_add_setting( $wp_customize, 'layout_slideshow_info', 'BWB_layout',
        array(
          'setting' => array(
            'capability' => 'edit_theme_options',
            'default' => 'hide'
          ),
          'control' => array(
            'label'    => __('There are no slideshows yet. Visit the backend admin interface to add some.', 'BWB'),
            'priority' => 10,
            'type'       => 'text',
          ), 
        )
      );
    endif;

    BWB_add_setting( $wp_customize, 'layout_slideshow', 'BWB_layout',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
        ),
        'control' => array(
          'label'    => __('Select Slideshow:', 'BWB'),
          'priority' => 10,
          'type'       => 'radio',
          'choices' => $posts,
        ),
      )
    );

    /******************************************************************
     *  LAYOUT STYLES, HARDCODED DEFAULTS
     */    

    $min_heights = array(
      '100px' => __('Min Height of 100 Pixels', 'BWB'),
      '256px' => __('Min Height of 256 Pixels', 'BWB'),
      '512px' => __('Min Height of 512 Pixels', 'BWB'),
      '768px' => __('Min Height of 768 Pixels', 'BWB'),
    );

        
    BWB_add_setting( $wp_customize, 'layout[min_height]', 'BWB_layout',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
        ),
        'control' => array(
          'label'    => __('Header minimum Height:', 'BWB'),
          'priority' => 15,
          'type'       => 'radio-extended',
          'choices' => $min_heights,
        ), 
      )
    );

    $layouts = array(
      '100%' => __('Full Screen', 'BWB'),
      '50%' => __('Half a Screen', 'BWB'),
      '25%' => __('Quarter of a Screen', 'BWB'),
      '768px' => __('Fixed height of 768px', 'BWB'),
      '512px' => __('Fixed height of 512px', 'BWB'),
      '256px' => __('Fixed height of 256px', 'BWB'),
      //~ 'custom'      => array('px', '%'),
    );

    BWB_add_setting( $wp_customize, 'layout[max_height]', 'BWB_layout',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
        ),
        'control' => array(
          'label'    => __('Header Slideshow Maximum Height:', 'BWB'),
          'priority' => 25,
          'type'       => 'radio-extended',
          'choices' => $layouts,
        ), 
      )
    );
?>
