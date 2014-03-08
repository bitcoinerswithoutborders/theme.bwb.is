<?php

require_once('bwb-login-admin-options.php');

//remove all styles from wp-login:
if ( basename($_SERVER['PHP_SELF']) == 'wp-login.php' ) {
  add_action( 'style_loader_tag', create_function( '$a', "return null;" ) );
}


function BWB_login_logo() { ?>
    <link rel="stylesheet" id="custom_wp_login_css"  href="<?php echo get_template_directory_uri() . '/inc/lib/clf/login.css'; ?>" type="text/css" media="all" />
<?php }
add_action( 'login_enqueue_scripts', 'BWB_login_logo' );


function BWB_login_deregister() {
  wp_dequeue_style('open-sans-css');
  wp_dequeue_style('dashicons-css');
}
add_action( 'wp_enqueue_scripts', 'BWB_login_deregister' );


function BWB_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'BWB_login_logo_url' );

function BWB_login_logo_url_title() {
    return 'Your Site Name and Info';
}
add_filter( 'login_headertitle', 'BWB_login_logo_url_title' );


?>
