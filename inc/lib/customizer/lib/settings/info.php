<?php

  //  ==============================
  //  = Info Section               =
  //  ==============================

   $wp_customize->add_section('info', array(
      'title'    => __('Information / Help', 'BWB'),
      'priority' => 0,
  ));

    BWB_add_setting( $wp_customize, 'info_text', 'info',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => 'hide'
        ),
        'control' => array(
          'label'    => __('This is the theme customizer for this wordpress install. every one of the pages below has a header like this to explain what can be done on it.', 'BWB'),
          'type'     => 'text',
          'priority' => 0,
        ), 
      )
    );
    
    BWB_add_setting( $wp_customize, 'info_text_2', 'info',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => 'hide'
        ),
        'control' => array(
          'label'    => __('Currently NOT working:', 'BWB'),
          'type'     => 'text',
          'priority' => 1,
        ), 
      )
    );
    BWB_add_setting( $wp_customize, 'info_text_42', 'info',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => 'hide'
        ),
        'control' => array(
          'label'    => __('Slide Settings: The slideshows are actual slideshows, but the images will not be loaded from them. HIGH on the todo list.', 'BWB'),
          'type'     => 'text',
          'priority' => 1,
        ), 
      )
    );

    BWB_add_setting( $wp_customize, 'info_text_3', 'info',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => 'hide'
        ),
        'control' => array(
          'label'    => __('ALL Hover color previews (they will be set to the correct hover color after reload though)', 'BWB'),
          'type'     => 'text',
          'priority' => 2,
        ), 
      )
    );

    
    BWB_add_setting( $wp_customize, 'info_text_4', 'info',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => 'hide'
        ),
        'control' => array(
          'label'    => __('Fonts can not be uploaded yet. Some of the font size settings have no preview, just reload the page to show them.', 'BWB'),
          'type'     => 'text',
          'priority' => 2,
        ),
      )
    );
?>
