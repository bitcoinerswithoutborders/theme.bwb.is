<?php
/***********************************************************************
 *  Add the theme main css file and less variables
 */ 

add_action('wp_enqueue_scripts', 'load_scripts');
function load_scripts(){
  //~ wp_enqueue_script('site-js', get_stylesheet_directory_uri() . '/inc/js/site.js' );

  wp_enqueue_style('style-css', get_stylesheet_directory_uri() . '/style.less' );
}

//setting up the less variables:
if ( class_exists('WPLessPlugin') ) {

  $less = WPLessPlugin::getInstance();

  //~ $less->addVariable('myColor', '#666');
  // you could now use @myColor in your *.less files


  $less->setVariables( array(      
      'primarycolor'        => '#ff9d1c',
      'secondarycolor'      => '#666',
      'tertiarycolor'       => '#bfbfbf',
      'textcolor'           => '#fff',
      'menubgcolor'         => '#ff9d1c',
      'menutextcolor'       => '#666',
      'menutexthovercolor'  => '#fff',
      'logo'                => get_option('bwb_theme_image')
  ) );
}
?>
