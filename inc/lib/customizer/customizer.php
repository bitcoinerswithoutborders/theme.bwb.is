<?php
/**
 * bitcoinerswithoutborders Theme Customizer
 *
 * @package bitcoinerswithoutborders
 */
 

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

require_once('lib/customizer-css.php');
require_once('lib/customizer-js.php');
require_once('lib/add-setting.php');

function plugin_prefix($string){
  if (strpos($string, 'BWB_') === 0) {
    return $string;
  }
  return 'BWB_' . $string;
}

function BWB_remove_sections ($wp_customize) {
  //~ $wp_customize->remove_section( 'static_front_page' );
  //~ $wp_customize->add_section( 'header_image' );
  $wp_customize->remove_section( 'background_image' );
  //~ $wp_customize->remove_section( 'nav' );
  $wp_customize->remove_section( 'title_tagline' );
}

function BWB_add_postMessage($wp_customize) {
  $wp_customize->get_setting( 'BWB_header_title' )->transport = 'postMessage';
  $wp_customize->get_setting( 'BWB_header_tagline' )->transport = 'postMessage';
  //~ $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
  //~ $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
  //~ $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
}


function BWB_customize_register( $wp_customize ) {
  require_once('lib/custom-controls.php');
  
  $args = array(
    'post_type' => 'menu',
  );

  $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) ); 

  $menu_selection = array();

  foreach ( $menus as $menu ) :
    $menu_selection[$menu->term_id] = $menu->name;
  endforeach;


  BWB_remove_sections($wp_customize);

  require('lib/settings/info.php');

  require('lib/settings/layouts.php');
  //~ require('lib/settings/frontpage-slideshow.php');

  require('lib/settings/title.php');
  require('lib/settings/tagline.php');
  
  //~ require('lib/settings/footer.php');

  require('lib/settings/colors.php');
  
  require('lib/settings/nav.php');

  require('lib/settings/font.php');

  //~ require('lib/settings/menu-colors.php');
}

//~ add_action( 'customize_register', 'BWB_customize_register' );
?>
