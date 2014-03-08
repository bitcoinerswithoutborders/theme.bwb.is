<?php


  //  =============================
  //  = Main Colors               =
  //  =============================
  
  
  BWB_add_setting( $wp_customize, 'text_color', 'colors', 
    array(
      'setting' => array(
        'capability' => 'edit_theme_options',
        'default'    => '#000',
      ),
      'control' => array(
        'label'    => __('Text color', 'BWB'),
        'type'     => 'color',
        'priority' => 21,
      ), 
    )
  );

  BWB_add_setting( $wp_customize, 'link_color', 'colors', 
    array(
      'setting' => array(
        'capability' => 'edit_theme_options',
        'default'    => '#f99d1c',
      ),
      'control' => array(
        'label'    => __('Link Color', 'BWB'),
        'type'     => 'color',
        'priority' => 22,
      ), 
    )
  );
  
  BWB_add_setting( $wp_customize, 'link_hover_color', 'colors', 
    array(
      'setting' => array(
        'capability' => 'edit_theme_options',
        'default'    => '#676766',
      ),
      'control' => array(
        'label'    => __('Link Hover Color', 'BWB'),
        'type'     => 'color',
        'priority' => 23,
      ), 
    )
  );
  
  BWB_add_setting( $wp_customize, 'header_bg_color', 'colors', 
    array(
      'setting' => array(
        'capability' => 'edit_theme_options',
        'default'    => '#fff',
      ),
      'control' => array(
        'label'    => __('Header Background Color', 'BWB'),
        'type'     => 'color',
        'priority' => 24,
      ), 
    )
  );
  //~ BWB_add_setting( $wp_customize, 'header_bg_color_hover', 'colors', 
    //~ array(
      //~ 'setting' => array(
        //~ 'capability' => 'edit_theme_options',
        //~ 'default'    => '#f99d1c',
      //~ ),
      //~ 'control' => array(
        //~ 'label'    => __('Header Background Hover Color', 'BWB'),
        //~ 'type'     => 'color',
        //~ 'priority' => 25,
      //~ ), 
    //~ )
  //~ );

  BWB_add_setting( $wp_customize, 'header_text_color', 'colors', 
    array(
      'setting' => array(
        'capability' => 'edit_theme_options',
        'default'    => '#f99d1c',
      ),
      'control' => array(
        'label'    => __('Header Text Color', 'BWB'),
        'type'     => 'color',
        'priority' => 26,
      ), 
    )
  );
  BWB_add_setting( $wp_customize, 'header_text_color_hover', 'colors', 
    array(
      'setting' => array(
        'capability' => 'edit_theme_options',
        'default'    => '#676766',
      ),
      'control' => array(
        'label'    => __('Header Text Hover Color', 'BWB'),
        'type'     => 'color',
        'priority' => 27,
      ), 
    )
  );

?>
