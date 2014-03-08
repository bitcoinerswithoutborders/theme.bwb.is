<?php

  //  ===============================
  //  = Site Title & Tagline        =
  //  ===============================
  
  $wp_customize->add_section('BWB_branding_title', array(
      'title'    => __('Header Title', 'BWB'),
      'priority' => 5,
  ));
    
    
    BWB_add_setting( $wp_customize, 'branding_header_info', 'BWB_branding_title',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => 'hide'
        ),
        'control' => array(
          'label'    => __('Change Page Title Settings.', 'BWB'),
          'type'     => 'text',
          'priority' => 0,
        ), 
      )
    );


    
    BWB_add_setting( $wp_customize, 'header_title_show', 'BWB_branding_title',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => true,
        ),
        'control' => array(
          'label'    => __('Check this to show the Title in the header.', 'BWB'),
          'type'     => 'checkbox',
          'priority' => 10,
        ), 
      )
    );
    
    $text_alignment_choices = array (
      'left'   => 'left',
      'center' => 'center',
      'right'  => 'right',
    );


    BWB_add_setting( $wp_customize, 'header_title_width', 'BWB_branding_title',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => 100,
        ),
        'control' => array(
          'label'    => __('Title Width in percent of Page Width:.', 'BWB'),
          'type'     => 'slider',
          'choices'  => array(
            'max'   => 100,
            'min'   => 0,
          ),
          'priority' => 20,
        ), 
      )
    );
    
    BWB_add_setting( $wp_customize, 'header_title_min_width', 'BWB_branding_title',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => 100,
        ),
        'control' => array(
          'label'    => __('Title Minimum Width in pixels:.', 'BWB'),
          'type'     => 'number',
          'priority' => 21,
        ), 
      )
    );

    BWB_add_setting( $wp_customize, 'header_title_max_width', 'BWB_branding_title',
      array(
        'setting' => array (
          'capability' => 'edit_theme_options',
          'default'    => 100,
        ),
        'control' => array(
          'label'    => __('Title Maximum Width in pixels:.', 'BWB'),
          'type'     => 'number',
          'priority' => 22,
        ), 
      )
    );

    BWB_add_setting( $wp_customize, 'header_title', 'BWB_branding_title',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => 'header title',
        ),
        'control' => array(
          'label'    => __('Text:', 'BWB'),
          'type'     => 'text',
          'priority' => 30,
        ), 
      )
    );

    BWB_add_setting( $wp_customize, 'header_title_link', 'BWB_branding_title',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
        ),
        'control' => array(
          'label'    => __('Title Url:', 'BWB'),
          'type'     => 'text',
          'priority' => 31,
        ), 
      )
    );


    BWB_add_setting( $wp_customize, 'header_title_alignment', 'BWB_branding_title',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => true,
        ),
        'control' => array(
          'label'    => __('Title text alignment:.', 'BWB'),
          'type'     => 'radio',
          'choices'  => $text_alignment_choices,
          'priority' => 40,
        ), 
      )
    );

    BWB_add_setting( $wp_customize, 'header_title_font_size', 'BWB_branding_title',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => '1.2em',
        ),
        'control' => array(
          'label'    => __('Title Font Size', 'BWB'),
          'type'     => 'text',
          'priority' => 50,
        ), 
      )
    );

    BWB_add_setting( $wp_customize, 'header_title_line_height', 'BWB_branding_title',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => '1.2em',
        ),
        'control' => array(
          'label'    => __('Title Line Height', 'BWB'),
          'type'     => 'text',
          'priority' => 60,
        ), 
      )
    );
    
    BWB_add_setting( $wp_customize, 'header_title_text_color', 'BWB_branding_title', 
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => '#fff',
        ),
        'control' => array(
          'label'    => __('Header Title Text Color', 'BWB'),
          'type'     => 'color',
          'priority' => 70,
        ), 
      )
    );
    
?>
