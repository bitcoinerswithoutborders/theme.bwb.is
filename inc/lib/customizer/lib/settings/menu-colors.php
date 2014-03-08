<?php
  //  =============================
  //  = Menu Colors               =
  //  =============================
  
  $num_of_runs = 2;

  

    //~ menu_bg_color
    //~ menu_bg_hover_color
    //~ menu_bg_text_color
    //~ menu_bg_hover_text_color
    //~ menu_bg_text_color_hover
    //~ menu_bg_text_color_active
    //~ menu_bg_text_color_active_hover
    //~ menu_bg_hover_text_color_active
    //~ menu_bg_hover_text_color_active_hover

  $classes = array(
    'header' => array(
      'menu_bg_color'                           => '#fff',
      'menu_bg_hover_color'                     => '#676766',
      'menu_bg_text_color'                      => '#676766',
      'menu_bg_text_color_hover'                => '#f99d1c',
      'menu_bg_hover_text_color'                => '#fff',
      'menu_bg_hover_text_color_hover'          => '#f99d1c',
      'menu_bg_text_color_active'               => '#000',
      'menu_bg_text_color_active_hover'         => '#f99d1c',
      'menu_bg_hover_text_color_active'         => '#000',
      'menu_bg_hover_text_color_active_hover'   => '#f99d1c',
      'name'                            => __( 'Main Menu Bar', 'BWB' ),
    ), 
    1 => array(
      'menu_bg_color'                           => '#676766',
      'menu_bg_hover_color'                     => '#fff',
      'menu_bg_text_color'                      => '#fff',
      'menu_bg_text_color_hover'                => '#f99d1c',
      'menu_bg_hover_text_color'                => '#676766',
      'menu_bg_hover_text_color_hover'          => '#f99d1c',
      'menu_bg_text_color_active'               => '#000',
      'menu_bg_text_color_active_hover'         => '#f99d1c',
      'menu_bg_hover_text_color_active'         => '#000',
      'menu_bg_hover_text_color_active_hover'   => '#f99d1c',
      'name'                       => __( 'Sub Menu Level 1', 'BWB' ),
    ), 
    2 => array(
      'menu_bg_color'                           => '#676766',
      'menu_bg_hover_color'                     => '#fff',
      'menu_bg_text_color'                      => '#fff',
      'menu_bg_text_color_hover'                => '#f99d1c',
      'menu_bg_hover_text_color'                => '#676766',
      'menu_bg_hover_text_color_hover'          => '#f99d1c',
      'menu_bg_text_color_active'               => '#000',
      'menu_bg_text_color_active_hover'         => '#f99d1c',
      'menu_bg_hover_text_color_active'         => '#000',
      'menu_bg_hover_text_color_active_hover'   => '#f99d1c',
      'name'                       => __( 'Sub Menu Level 2', 'BWB' ),
    ),
    3 => array(
      'menu_bg_color'                           => '#676766',
      'menu_bg_hover_color'                     => '#fff',
      'menu_bg_text_color'                      => '#fff',
      'menu_bg_text_color_hover'                => '#f99d1c',
      'menu_bg_hover_text_color'                => '#676766',
      'menu_bg_hover_text_color_hover'          => '#f99d1c',
      'menu_bg_text_color_active'               => '#000',
      'menu_bg_text_color_active_hover'         => '#f99d1c',
      'menu_bg_hover_text_color_active'         => '#000',
      'menu_bg_hover_text_color_active_hover'   => '#f99d1c',
      'name'                       => __( 'Sub Menu Level 3', 'BWB' ),
    ),
    4 => array(
      'menu_bg_color'                           => '#676766',
      'menu_bg_hover_color'                     => '#fff',
      'menu_bg_text_color'                      => '#fff',
      'menu_bg_text_color_hover'                => '#f99d1c',
      'menu_bg_hover_text_color'                => '#676766',
      'menu_bg_hover_text_color_hover'          => '#f99d1c',
      'menu_bg_text_color_active'               => '#000',
      'menu_bg_text_color_active_hover'         => '#f99d1c',
      'menu_bg_hover_text_color_active'         => '#000',
      'menu_bg_hover_text_color_active_hover'   => '#f99d1c',
      'name'                       => __( 'Sub Menu Level 4', 'BWB' ),
    ),
    5 => array(
      'menu_bg_color'                           => '#676766',
      'menu_bg_hover_color'                     => '#fff',
      'menu_bg_text_color'                      => '#fff',
      'menu_bg_text_color_hover'                => '#f99d1c',
      'menu_bg_hover_text_color'                => '#676766',
      'menu_bg_hover_text_color_hover'          => '#f99d1c',
      'menu_bg_text_color_active'               => '#000',
      'menu_bg_text_color_active_hover'         => '#f99d1c',
      'menu_bg_hover_text_color_active'         => '#000',
      'menu_bg_hover_text_color_active_hover'   => '#f99d1c',
      'name'                       => __( 'Sub Menu Level 5', 'BWB' ),
    ),
    
  );

  $i = 0;
  foreach ( $classes as $key => $value ) :
    $i++;

    $wp_customize->add_section('BWB_menu_' . $key, array(
        'title'    => sprintf ( __( "%s Settings:", 'BWB'), $value['name'] ),
        'priority' => 120 + $i,
    ));

    BWB_add_setting( $wp_customize, 'menu_bg_color_' . $key, 'BWB_menu_' . $key, 
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => $value['menu_bg_color'],
        ),
        'control' => array(
          'label'    => __('Background Color', 'BWB'),
          'type'     => 'color',
          'priority' => 1,
        ), 
      )
    );

    BWB_add_setting( $wp_customize, 'menu_bg_hover_color_' . $key, 'BWB_menu_' . $key,
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => $value['menu_bg_hover_color'],
        ),
        'control' => array(
          'label'    => __('Background Hover Color', 'BWB'),
          'type'     => 'color',
          'priority' => 2,
        ),
      )
    );

    BWB_add_setting( $wp_customize, 'menu_bg_text_color_' . $key, 'BWB_menu_' . $key,
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => $value['menu_bg_text_color'],
        ),
        'control' => array(
          'label'    => __('Link Color', 'BWB'),
          'type'     => 'color',
          'priority' => 3,
        ),
      )
    );

    BWB_add_setting( $wp_customize, 'menu_bg_hover_text_color_' . $key, 'BWB_menu_' . $key,
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => $value['menu_bg_hover_text_color'],
        ),
        'control' => array(
          'label'    => __('Hovered Menu Bar ' . $key . ' Link Color', 'BWB'),
          'type'     => 'color',
          'priority' => 4,
        ),
      )
    );


    BWB_add_setting( $wp_customize, 'menu_bg_text_color_hover_' . $key, 'BWB_menu_' . $key,
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => $value['menu_bg_text_color_hover'],
        ),
        'control' => array(
          'label'    => __('Link Hover Color', 'BWB'),
          'type'     => 'color',
          'priority' => 5,
        ),
      )
    );
        
    BWB_add_setting( $wp_customize, 'menu_bg_text_color_active_' . $key, 'BWB_menu_' . $key,
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => $value['menu_bg_text_color_active'],
        ),
        'control' => array(
          'label'    => __('Current Page Link Color', 'BWB'),
          'type'     => 'color',
          'priority' => 6,
        ),
      )
    );

    BWB_add_setting( $wp_customize, 'menu_bg_text_color_active_hover_' . $key, 'BWB_menu_' . $key,
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => $value['menu_bg_text_color_active_hover'],
        ),
        'control' => array(
          'label'    => __('Current Page Link Hover Color', 'BWB'),
          'type'     => 'color',
          'priority' => 7,
        ),
      )
    );
    
    BWB_add_setting( $wp_customize, 'menu_bg_hover_text_color_active_' . $key, 'BWB_menu_' . $key,
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => $value['menu_bg_hover_text_color_active'],
        ),
        'control' => array(
          'label'    => __('Hovered Menu Current Page Link Color', 'BWB'),
          'type'     => 'color',
          'priority' => 8,
        ),
      )
    );


    BWB_add_setting( $wp_customize, 'menu_bg_hover_text_color_active_hover_' . $key, 'BWB_menu_' . $key,
      array(
        'setting' => array(
          'capability' => 'edit_theme_options',
          'default'    => $value['menu_bg_hover_text_color_active_hover'],
        ),
        'control' => array(
          'label'    => __('Hovered Menu Current Page Link Color', 'BWB'),
          'type'     => 'color',
          'priority' => 9,
        ),
      )
    );
  endforeach;
?>
