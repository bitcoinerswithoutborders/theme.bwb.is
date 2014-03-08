<?php

  //  =============================
  //  = Font family Settings      =
  //  =============================

  $wp_customize->add_section('BWB_font', array(
      'title'    => __('Font Settings', 'BWB'),
      'priority' => 120,
  ));

    BWB_add_setting( $wp_customize, 'info_text_font', 'BWB_font',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => 'hide'
        ),
        'control' => array(
          'label'    => __('The font file upload does NOT work at the moment. The sizes properties dont preview, but work.', 'BWB'),
          'type'     => 'text',
          'priority' => 0,
        ), 
      )
    );

    BWB_add_setting( $wp_customize, 'font_file', 'BWB_font',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => 'UbuntuM',
        ),
        'control' => array(
          'label'    => __('Font Upload', 'BWB'),
          'settings' => 'BWB_font_file',
          'type'     => 'upload',
          'priority' => 1,
        ), 
      )
    );

    BWB_add_setting( $wp_customize, 'font_min_size', 'BWB_font',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => '12',
        ),
        'control' => array(
          'label'    => __('Font Minimum Size', 'BWB'),
          'type'     => 'text',
          'priority' => 5,
        ), 
      )
    );

    BWB_add_setting( $wp_customize, 'font_max_size', 'BWB_font',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => '20',
        ),
        'control' => array(
          'label'    => __('Font Maximum Size', 'BWB'),
          'type'     => 'text',
          'priority' => 6,
        ), 
      )
    );

    BWB_add_setting( $wp_customize, 'screen_min_size', 'BWB_font',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => '300px',
        ),
        'control' => array(
          'label'    => __('Screen Minimum Size For Font Calculations', 'BWB'),
          'type'     => 'text',
          'priority' => 15,
        ), 
      )
    );
   
    
    BWB_add_setting( $wp_customize, 'screen_max_size', 'BWB_font',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => '950px',
        ),
        'control' => array(
          'label'    => __('Screen Maximum Size For Font Calculations', 'BWB'),
          'type'     => 'text',
          'priority' => 16,
        ), 
      )
    );


    BWB_add_setting( $wp_customize, 'font_menu_header_font_size', 'BWB_font',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => '1.2em',
        ),
        'control' => array(
          'label'    => __('Header Menu Items Font Size)', 'BWB'),
          'type'     => 'text',
          'priority' => 21,
        ), 
      )
    );

    
    BWB_add_setting( $wp_customize, 'font_menu_footer_font_size', 'BWB_font',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => '1.2em',
        ),
        'control' => array(
          'label'    => __('Footer Menu Items Font Size', 'BWB'),
          'type'     => 'text',
          'priority' => 22,
        ), 
      )
    );

    

    BWB_add_setting( $wp_customize, 'font_branding_title_font_size', 'BWB_font',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => '2em',
        ),
        'control' => array(
          'label'    => __('Main Page Title Font Size', 'BWB'),
          'type'     => 'text',
          'priority' => 23,
        ), 
      )
    );


    BWB_add_setting( $wp_customize, 'font_branding_tagline_font_size', 'BWB_font',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => '1.5em',
        ),
        'control' => array(
          'label'    => __('Main Page Tagline Font size', 'BWB'),
          'type'     => 'text',
          'priority' => 24,
        ), 
      )
    );
    
?>
