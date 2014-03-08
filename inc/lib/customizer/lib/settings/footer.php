<?php


  //  ===============================
  //  = Footer Settings        =
  //  ===============================


  $wp_customize->add_section('BWB_branding_footer', array(
      'title'    => __('Footer Branding', 'BWB'),
      'priority' => 10,
  ));
    
    
    BWB_add_setting( $wp_customize, 'branding_footer_info', 'BWB_branding_footer',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => 'hide'
        ),
        'control' => array(
          'label'    => __('This Area can be used to adjust footer branding settings', 'BWB'),
          'type'     => 'text',
          'priority' => 1,
        ), 
      )
    );
    
    BWB_add_setting( $wp_customize, 'footer_show', 'BWB_branding_footer',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => false,
        ),
        'control' => array(
          'label'    => __('Check this to show the Footer.', 'BWB'),
          'type'     => 'checkbox',
          'priority' => 3,
        ), 
      )
    );
    
    BWB_add_setting( $wp_customize, 'footer_bg_color', 'BWB_branding_footer',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => '#676766'
        ),
        'control' => array(
          'label'    => __('Footer Background Color.', 'BWB'),
          'type'     => 'color',
          'priority' => 4,
        ), 
      )
    );

    BWB_add_setting( $wp_customize, 'footer_menu', 'BWB_branding_footer',
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
        ),
        'control' => array(
          'label'    => __('Footer Left Menu:', 'BWB'),
          'type'     => 'checkbox-array',
          'priority' => 5,
          'choices'  => $menu_selection

        ), 
      )
    );
    

    BWB_add_setting( $wp_customize, 'footer_text_color', 'BWB_branding_footer', 
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => '#ffffff',
        ),
        'control' => array(
          'label'    => __('Footer Text Color', 'BWB'),
          'type'     => 'color',
          'priority' => 10,
        ),
      )
    );

    BWB_add_setting( $wp_customize, 'footer_text_hover_color', 'BWB_branding_footer', 
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => '#f99d1c',
        ),
        'control' => array(
          'label'    => __('Footer Text Hover Color', 'BWB'),
          'type'     => 'color',
          'priority' => 11,
        ),
      )
    );
?>
