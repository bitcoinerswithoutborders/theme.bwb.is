<?php
/**
* This will output the custom WordPress settings to the live theme's WP head.
* 
* Used by hook: 'wp_head'
* 
* @see add_action('wp_head',$func)
* @since MyTheme 1.0
*/

/**
 * This will generate a line of CSS for use in header output. If the setting
 * ($mod_name) has no defined value, the CSS will not be output.
 * 
 * @uses get_theme_mod()
 * @param string $selector CSS selector
 * @param string $style The name of the CSS *property* to modify
 * @param string $mod_name The name of the 'theme_mod' option to fetch
 * @param string $prefix Optional. Anything that needs to be output before the CSS property
 * @param string $postfix Optional. Anything that needs to be output after the CSS property
 * @param bool $echo Optional. Whether to print directly to the page (default: true).
 * @return string Returns a single line of CSS with selectors and a property.
 * @since BWB 0.0.1
 */
function BWB_generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true, $type=false ) {
  $return = '';
  $property = false;
  
  if ( gettype( $mod_name ) == 'array' ) :
    $property = $mod_name['property'];
    $mod_name = $mod_name['mod_name'];
  endif;
  
  
  $mod_name = plugin_prefix($mod_name);

  $mod = get_theme_mod($mod_name);
  
  if ($property) :
    $mod = $mod[$property];
  endif;

  if ($type) {
    
    if ( $type == 'boolean' ) :

      if ( is_null( $mod ) || !$mod) :
        $mod = 'none';
      else :
        $mod = 'block';
      endif; 
    endif;
  }
  
  if ( ! empty( $mod ) ) {

    $return = sprintf('%s { %s:%s; }',
      $selector,
      $style,
      $prefix . $mod . $postfix
    );
    if ( $echo ) {
      echo $return;
    }
  }
  return $return;
}

function BWB_header_output() {
  ?>
  <!--Customizer CSS--> 
  <style type="text/css">
    <?php
      /*******************************************
       * Header Layout:
       */ 

      BWB_generate_css( '#background-image img', 'min-height', 
        array(
          'mod_name' => 'layout', 
          'property' => 'min_height',
        )
      );

      BWB_generate_css( '#background-image img', 'max-height', 
        array(
          'mod_name' => 'layout', 
          'property' => 'max_height',
        )
      );

      //body text color
      BWB_generate_css('body', 'color', 'text_color');
      
      //link colors
      BWB_generate_css('a', 'color', 'link_color');
      BWB_generate_css('a:visited', 'color', 'link_color');
      BWB_generate_css('a:hover, a.hover', 'color', 'link_hover_color');

      //site title and tagline alignment
      BWB_generate_css('#masthead #branding #site-title-container', 'text-align', 'header_title_alignment');
      BWB_generate_css('#masthead #branding #site-tagline-container', 'text-align', 'header_tagline_alignment');

      BWB_generate_css('#masthead #branding #site-title-container', 'width', 'header_title_width', '', '%');
      BWB_generate_css('#masthead #branding #site-title-container', 'max-width', 'header_title_max_width', '', 'px');
      BWB_generate_css('#masthead #branding #site-title-container', 'min-width', 'header_title_min_width', '', 'px');

      BWB_generate_css('#masthead #branding #site-tagline-container', 'width', 'header_tagline_width', '', '%');
      BWB_generate_css('#masthead #branding #site-tagline-container', 'max-width', 'header_tagline_max_width', '', 'px');
      BWB_generate_css('#masthead #branding #site-tagline-container', 'min-width', 'header_tagline_min_width', '', 'px');

      BWB_generate_css( '#branding #site-title-container', 'font-size', 'header_title_font_size');
      BWB_generate_css( '#branding #site-tagline-container', 'font-size', 'header_tagline_font_size');

      BWB_generate_css( '#branding #site-title-container', 'line-height', 'header_title_line_height');
      BWB_generate_css( '#branding #site-tagline-container', 'line-height', 'header_tagline_line_height');

      //site-title settings
      BWB_generate_css('#masthead #branding #site-title-container', 'display', 'header_title_show', '', '', true, 'boolean');
      BWB_generate_css('#masthead #branding #site-title-container, #masthead #branding #site-title-container a', 'color', 'header_title_text_color');

      //tagline / site description
      BWB_generate_css('#site-tagline-container', 'display', 'header_tagline_show', '', '', true, 'boolean');
      BWB_generate_css('#site-tagline-container, #masthead #branding #site-tagline-container a', 'color', 'header_tagline_text_color');

      //~ BWB_generate_css( '#content header', 'background-color', 'header_bg_color');
      //~ BWB_generate_css( '#content header:hover', 'background-color', 'header_bg_color_hover');
      
      BWB_generate_css( '#content header h1, #content header h1 a', 'color', 'header_text_color');
      BWB_generate_css( '#content header h1:hover, #content header h1:hover a', 'color', 'header_text_color_hover');
      
      BWB_generate_css('#menu-footer-container a', 'color', 'footer_text_color');
      BWB_generate_css('#menu-footer-container a:hover, #menu-footer-container a.hover', 'color', 'footer_text_hover_color');
      
      BWB_generate_css('footer#colophon', 'display', 'footer_show', '', '', true, 'boolean');
      BWB_generate_css('footer#colophon', 'background-color', 'footer_bg_color');



      //generate font css:
      $screen_min_size = get_theme_mod( plugin_prefix( 'screen_min_size' ) );
      $screen_max_size = get_theme_mod( plugin_prefix( 'screen_max_size' ) );

      $font_max_size = get_theme_mod(plugin_prefix( 'font_max_size' ) );
      $font_min_size = get_theme_mod(plugin_prefix( 'font_min_size' ) );
      
      $font_size_difference = $font_max_size - $font_min_size;
      $screen_size_difference = $screen_max_size - $screen_min_size;
      $font_size_steps = (int)( $screen_max_size - $screen_min_size ) / $font_size_difference;
      print( 'body {' );
      print(   'font-size:' . $font_max_size . 'px;' );
      print( '}' );

      //~ print( '#site-logo img {');
      //~ print(   'height:' . (int)( ( $font_max_size - $i) * 2 ) . 'px;');
      //~ print( '}');

      for( $i = 0; $i < $font_size_difference; $i++) :
        //~ print('test');
        print(  '@media screen and (max-width:' . (int)( $screen_max_size - ( $font_size_steps * $i ) )  . 'px) {');
        print(    'body {');
        print(      'font-size:' . (int)($font_max_size - $i) . 'px;');
        print(    '}');
        print(  '}');
      endfor;
      

      BWB_generate_css( '#menu-header-container ul li a', 'font-size', 'font_menu_header_font_size');
      BWB_generate_css( '#menu-footer-container ul li a', 'font-size', 'font_menu_footer_font_size');
      
      BWB_generate_css( '.hentry header h1', 'font-size', 'font_header_font_size');
      


      $name = 'header';

      //menu background colors
      BWB_generate_css('#menu-' . $name . '-container', 'background-color', 'menu_bg_color_' . $name);
      BWB_generate_css('#menu-' . $name . '-container:hover', 'background-color', 'menu_bg_hover_color_' . $name);

      BWB_generate_css('#menu-' . $name . '-container a', 'color', 'menu_bg_text_color_' . $name);
      BWB_generate_css('#menu-' . $name . '-container:hover  a:hover', 'color', 'menu_bg_text_color_hover_' . $name);
      BWB_generate_css('#menu-' . $name . '-container li.current a', 'color', 'menu_bg_text_color_active_' . $name);
      BWB_generate_css('#menu-' . $name . '-container:hover  li.current a:hover', 'color', 'menu_bg_text_color_active_hover_' . $name);

      BWB_generate_css('#menu-header-container:hover a', 'color', 'menu_bg_hover_text_color_' . $name);
      BWB_generate_css('#menu-header-container:hover li.current > a', 'color', 'menu_bg_hover_text_color_active_' . $name);
      BWB_generate_css('#menu-header-container:hover a', 'color', 'menu_bg_hover_text_color_' . $name);


      for ( $i = 1; $i < 6; $i++ ) :
        //menu background colors
        BWB_generate_css('#menu-header-container ul.menu-depth-' . $i, 'background-color', 'menu_bg_color_' . $i);
        BWB_generate_css('#menu-header-container ul.menu-depth-' . $i . ':hover', 'background-color', 'menu_bg_hover_color_' . $i);

        BWB_generate_css('#menu-header-container ul.menu-depth-' . $i . ' > li > a', 'color', 'menu_bg_text_color_' . $i);
        BWB_generate_css('#menu-header-container ul.menu-depth-' . $i . ':hover > li > a:hover', 'color', 'menu_bg_text_color_hover_' . $i);
        BWB_generate_css('#menu-header-container ul.menu-depth-' . $i . ' > li.current > a' , 'color', 'menu_bg_text_color_active_' . $i);
        BWB_generate_css('#menu-header-container ul.menu-depth-' . $i . ':hover > li.current > a:hover', 'color', 'menu_bg_text_color_active_hover_' . $i);

        BWB_generate_css('#menu-header-container ul.menu-depth-' . $i . ':hover > li > a', 'color', 'menu_bg_hover_text_color_' . $i);
        BWB_generate_css('#menu-header-container ul.menu-depth-' . $i . ':hover > li.current > a', 'color', 'menu_bg_hover_text_color_active_' . $i);
        BWB_generate_css('#menu-header-container ul.menu-depth-' . $i . ':hover > li > a', 'color', 'menu_bg_hover_text_color_' . $i);
      endfor;      
  ?>
  </style>
  <!--/Customizer CSS-->
  <?php
}


// Output custom CSS to live site
//~ add_action( 'wp_head' , 'BWB_header_output' );



function BWB_customize_controls_print_styles() {
  wp_enqueue_style('BWB-customizer', get_template_directory_uri() . '/inc/lib/customizer/css/customizer.css');
}

//~ add_action( 'customize_controls_print_styles', 'BWB_customize_controls_print_styles' );

?>
