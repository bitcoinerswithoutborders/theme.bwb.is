<?php

/***********************************************************************
  * BWB_add_setting
  * used in ../customizer.php to create settings and controls.
  */


function BWB_add_setting( $wp_customize, $setting_name, $setting_section, $config) {

  $s_name = plugin_prefix($setting_name);
  $s_section = plugin_prefix($setting_section);

  $config['control']['section'] = $setting_section;
  //~ $config['setting']['section'] = $setting_section;

  //~ $config['setting']['transport'] = 'postMessage';
  //~ $config['control']['transport'] = 'postMessage';

  $type = $config['control']['type'];

  $wp_customize->add_setting($s_name, $config['setting']);
 
  if ( $type == 'color' ) :
 
    $wp_customize->add_control( new WP_Customize_Color_Control(
      $wp_customize, 
      $s_name, 
      $config['control']
    ) );

  elseif ($type == 'image-upload') :
    
    $wp_customize->add_control( 
      new WP_Customize_Image_Control(
         $wp_customize,
         $s_name,
         $config['control']
      )
    );

  elseif ($type == 'upload') :

    $wp_customize->add_control( 
      new WP_Customize_Upload_Control( 
        $wp_customize, 
        $s_name, 
        $config['control'] 
      ) 
    );
  elseif ($type == 'checkbox-array') :

    $wp_customize->add_control( 
      new WP_Customize_Checkbox_Array_Control( 
        $wp_customize, 
        $s_name, 
        $config['control'] 
      ) 
    );
  elseif ($type == 'radio-extended' ) :
    if ( ! empty ( $config['control'] ) ) :
      $wp_customize->add_control( 
        new WP_Customize_Radio_Control(
          $wp_customize, 
          $s_name, 
          $config['control']
        )
      );
    endif;
  elseif ($type == 'slider' ) :
    if ( ! empty ( $config['control'] ) ) :
      $wp_customize->add_control( 
        new WP_Customize_Slider_Control(
          $wp_customize, 
          $s_name, 
          $config['control']
        )
      );
    endif;
  elseif ($type == 'number' ) :
    if ( ! empty ( $config['control'] ) ) :
      $wp_customize->add_control( 
        new WP_Customize_Number_Control(
          $wp_customize, 
          $s_name, 
          $config['control']
        )
      );
    endif;
  else :
    $wp_customize->add_control($s_name, $config['control'] );
  endif;
}
?>
