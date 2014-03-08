<?php

  //  =============================
  //  = Navigation menus          =
  //  =============================
  
  
  BWB_add_setting( $wp_customize, 'info_text_nav', 'nav',
    array(
      'setting' => array(
        'capability' => 'edit_theme_options',
        'default'    => 'hide'
      ),
      'control' => array(
        'label'    => __( "The navigation menu has no instant previews. To see the changes just reload the page.", 'BWB' ),
        'type'     => 'text',
        'priority' => 0,
      ), 
    )
  );

?>
