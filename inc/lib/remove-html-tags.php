<?php 
/***********************************************************************
 * Remove Generator tag from html
 */ 

function change_generator_link() {
  return '<meta name="generator" content="BWB Framework 0.23.5 &#9398;">';
}

add_filter( 'the_generator', 'change_generator_link', 1 );

remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

?>
