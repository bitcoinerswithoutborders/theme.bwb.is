<?php
/**********************************************************************
 * Deregister the google font from the admin interface
 */ 

function bwb_deregister_styles() {

    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    wp_enqueue_style('open-sans','');

}


add_action( 'init', 'bwb_deregister_styles' );
?>
