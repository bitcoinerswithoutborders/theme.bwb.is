<?php

  //  ===============================
  //  = Site Title & Tagline        =
  //  ===============================
  
  $wp_customize->add_section('BWB_branding_tagline', array(
      'title'    => __('Header Tagline', 'BWB'),
      'priority' => 6,
  ));

    BWB_add_setting( $wp_customize, 'header_tagline_alignment', 'BWB_branding_tagline',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => true,
        ),
        'control' => array(
          'label'    => __('Tagline text alignment:.', 'BWB'),
          'type'     => 'radio',
          'choices'  => $text_alignment_choices,
          'priority' => 1,
        ), 
      )
    );

    BWB_add_setting( $wp_customize, 'header_tagline_show', 'BWB_branding_tagline',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => true,
        ),
        'control' => array(
          'label'    => __('Check this to show the tagline in the page header.', 'BWB'),
          'type'     => 'checkbox',
          'priority' => 10,
        ), 
      )
    );

    BWB_add_setting( $wp_customize, 'header_tagline_width', 'BWB_branding_tagline',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => 100,
        ),
        'control' => array(
          'label'    => __('Tagline Width in percent of Page Width:.', 'BWB'),
          'type'     => 'slider',
          'choices'  => array(
            'max'   => 100,
            'min'   => 0,
          ),
          'priority' => 20,
        ), 
      )
    );

    
    BWB_add_setting( $wp_customize, 'header_tagline_min_width', 'BWB_branding_tagline',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
        ),
        'control' => array(
          'label'    => __('Tagline Minimum Width in pixels:', 'BWB'),
          'type'     => 'number',
          'priority' => 21,
        ), 
      )
    );

    BWB_add_setting( $wp_customize, 'header_tagline_max_width', 'BWB_branding_tagline',
      array(
        'setting' => array (
          'capability' => 'edit_theme_options',
        ),
        'control' => array(
          'label'    => __('Tagline Maximum Width in pixels:', 'BWB'),
          'type'     => 'number',
          'priority' => 22,
        ), 
      )
    );

    BWB_add_setting( $wp_customize, 'header_tagline', 'BWB_branding_tagline',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => 'header tagline',
        ),
        'control' => array(
          'label'    => __('Tagline.', 'BWB'),
          'type'     => 'text',
          'priority' => 30,
        ), 
      )
    );

    BWB_add_setting( $wp_customize, 'header_tagline_link', 'BWB_branding_tagline',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
        ),
        'control' => array(
          'label'    => __('Tagline Url:', 'BWB'),
          'type'     => 'text',
          'priority' => 31,
        ), 
      )
    );

    BWB_add_setting( $wp_customize, 'header_tagline_font_size', 'BWB_branding_tagline',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => '1.2em',
        ),
        'control' => array(
          'label'    => __('Page Tagline Font Size', 'BWB'),
          'type'     => 'text',
          'priority' => 40,
        ), 
      )
    );

    BWB_add_setting( $wp_customize, 'header_tagline_line_height', 'BWB_branding_tagline',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => '1.2em',
        ),
        'control' => array(
          'label'    => __('Page Tagline Line Height', 'BWB'),
          'type'     => 'text',
          'priority' => 50,
        ), 
      )
    );
    BWB_add_setting( $wp_customize, 'header_tagline_text_color', 'BWB_branding_tagline', 
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => '#fff',
        ),
        'control' => array(
          'label'    => __('Header Tagline Text Color', 'BWB'),
          'type'     => 'color',
          'priority' => 60,
        ), 
      )
    );
?>
