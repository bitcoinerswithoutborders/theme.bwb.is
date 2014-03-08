<?php
/**
 * BWB Theme Customizer
 *
 * @package BWB
 */

/**
 * Add custom meta boxes to pages.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

//~ require_once('./options-page.php');
//~ require_once('custom_post_types/custom-post-type-slideshow.php');
//~ require_once('custom_post_types/custom-post-type-staff.php');
//~ require_once('custom_post_types/custom-post-type-member.php');
//~ require_once('custom_post_types/custom-post-type-media-mirror.php');

  /***
   * Add metabox to all page edit pages
   */ 
  require_once('admin-extras/add-to-page-edit-pages.php');
  require_once('admin-extras/add-to-member-edit-pages.php');
  require_once('bwb-theme-options.php');

  /***
   * Remove google fonts from admin interface
   */

  require_once('admin-extras/remove-admin-fonts.php');
  
  /**
   * custom login page
   */
  require_once('clf/bwb-login-page.php');

?>
