<?php

 /**
* This outputs the javascript needed to automate the live settings preview.
* Also keep in mind that this function isn't necessary unless your settings 
* are using 'transport'=>'postMessage' instead of the default 'transport'
* => 'refresh'
* 
* Used by hook: 'customize_preview_init'
* 
* @see add_action('customize_preview_init',$func)
* @since MyTheme 1.0
*/

function BWB_live_preview() {
  wp_enqueue_script( 
   'BWB-customizer', // Give the script a unique ID
   get_template_directory_uri() . '/inc/lib/customizer/js/customizer.js', // Define the path to the JS file
   array(  'jquery', 'customize-preview' ), // Define dependencies
   BWB_VERSION, // Define a version (optional) 
   true // Specify whether to put in footer (leave this true)
  );
  
  wp_enqueue_script( 
   'BWB-customizer-gui', // Give the script a unique ID
   get_template_directory_uri() . '/inc/lib/customizer/js/customizer-gui.js', // Define the path to the JS file
   array(  'jquery' ), // Define dependencies
   BWB_VERSION, // Define a version (optional) 
   true // Specify whether to put in footer (leave this true)
  );
}


// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , 'BWB_live_preview' );
?>
