<?php

  /*  ================================
  *  = Frontpage Background          =
  *  =================================
  */

  $wp_customize->add_section('BWB_frontpage_bg', array(
      'title'    => __('Header Slideshow', 'BWB'),
      'priority' => 4,
  ));


    BWB_add_setting( $wp_customize, 'frontpage_bg_info', 'BWB_frontpage_bg',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => 'hide'
        ),
        'control' => array(
          'label'    => __('You can set a Slideshow for the Frontpage here. This will also be used as default on other pages if they have no settings of their own.', 'BWB'),
          'type'     => 'text',
          'priority' => 1,
        ), 
      )
    );

    BWB_add_setting( $wp_customize, 'frontpage_bg_hint', 'BWB_frontpage_bg',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => 'hide'
        ),
        'control' => array(
          'label'    => __('Hint: If you just set one image in the slideshow this will act like a normal background image.', 'BWB'),
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
      
      BWB_add_setting( $wp_customize, 'frontpage_slideshow_info', 'BWB_frontpage_bg',
        array(
          'setting' => array(
            'capability' => 'edit_theme_options',
            'default' => 'hide'
          ),
          'control' => array(
            'label'    => __('There are no slideshows yet. Visit the backend admin interface to add some.', 'BWB'),
            'priority' => 3,
            'type'       => 'text',
          ), 
        )
      );
    endif;

    BWB_add_setting( $wp_customize, 'frontpage_slideshow[ID]', 'BWB_frontpage_bg',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
        ),
        'control' => array(
          'label'    => __('Select Slideshow:', 'BWB'),
          'priority' => 3,
          'type'       => 'radio',
          'choices' => $posts,
        ), 
      )
    );
    
    BWB_add_setting( $wp_customize, 'frontpage_slideshow[height]', 'BWB_frontpage_bg',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
        ),
        'control' => array(
          'label'    => __('Slideshow Height: (add px or %)', 'BWB'),
          'priority' => 5,
          'type'       => 'text',
        ), 
      )
    );

    BWB_add_setting( $wp_customize, 'frontpage_slideshow[max_height]', 'BWB_frontpage_bg',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
        ),
        'control' => array(
          'label'    => __('Slideshow Max Height: (add px or %)', 'BWB'),
          'priority' => 10,
          'type'       => 'text',
        ), 
      )
    );
    
    BWB_add_setting( $wp_customize, 'frontpage_slideshow[min_height]', 'BWB_frontpage_bg',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
        ),
        'control' => array(
          'label'    => __('Slideshow Min Height: (add px or %)', 'BWB'),
          'priority' => 15,
          'type'       => 'text',
        ), 
      )
    );
    
    BWB_add_setting( $wp_customize, 'frontpage_slideshow[image_max_height]', 'BWB_frontpage_bg',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
        ),
        'control' => array(
          'label'    => __('Slideshow Image Max Height: (add px or %)', 'BWB'),
          'priority' => 20,
          'type'       => 'text',
        ), 
      )
    );
    
    BWB_add_setting( $wp_customize, 'frontpage_slideshow[image_min_height]', 'BWB_frontpage_bg',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
        ),
        'control' => array(
          'label'    => __('Slideshow Image Min Height: (add px or %)', 'BWB'),
          'priority' => 25,
          'type'       => 'text',
        ), 
      )
    );
?>
