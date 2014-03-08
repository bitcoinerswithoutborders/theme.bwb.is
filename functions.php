<?php

  define('BWB_VERSION', '0.0.1');

  add_theme_support('post-formats');
  add_theme_support('post-thumbnails');
  add_theme_support('menus');

  define('THEME_URL', get_template_directory_uri());

  if ( ! function_exists ('bwb_setup') ) :
    require_once('inc/lib/bwb-setup.php');
  endif;

  function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
  add_filter( 'upload_mimes', 'cc_mime_types' );

//force less recompilation on every load
//~ define('WP_LESS_COMPILATION', 'always');

/***********************************************************************
 * Remove Generator Tags
 */
  require_once('inc/lib/remove-html-tags.php');

/***********************************************************************
 * Require Admin Extras, all admin scripts should be required in it.
 */
  require_once('inc/lib/admin-extras.php');

/***********************************************************************
 * HTML 5 Video Shortcode
 */
  require_once('inc/lib/video5.php');

/***********************************************************************
 * Customizer scripts, 
 * loads everything customizer needs, 
 * less and twig variables are defined in ./inc/lib/twig.php or ./inc/lib/less.php
 */
  require_once('inc/lib/customizer/customizer.php');


/***********************************************************************
 * Twig functions and Timber Context
 */
  require_once('inc/lib/twig.php');

/***********************************************************************
 * Less functions and Variables
 */
  require_once('inc/lib/less.php');
