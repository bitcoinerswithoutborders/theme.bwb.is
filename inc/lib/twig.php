<?php
  /*********************************************************************
   * Add variables and functions to twig
   */


add_filter('timber_context', 'add_to_context');
add_filter('get_twig', 'add_to_twig');



function add_to_twig($twig) {
  /* this is where you can add your own fuctions to twig */
  
  //~ $twig->addExtension(new Twig_Extension_StringLoader());
  //~ $twig->addFilter('myfoo', new Twig_Filter_Function('myfoo'));
  return $twig;
}

//~ function myfoo($text) {
    //~ $text .= ' bar!';
    //~ return $text;
//~ }
  

function add_to_context($context){
  /* this is where you can add your own data to Timber's context object */
  //~ $data['qux'] = 'I am a value set in your functions.php file';

  $context['menus'] = array();
  $context['menus']['bottom'] = new TimberMenu('bottom');
  $context['menus']['top'] = new TimberMenu('top');
  $context['menus']['left'] = new TimberMenu('left');
  $context['menus']['right'] = new TimberMenu('right');

  $pages = array();
  $page_ids = '';
  foreach ( $context['menus'] as $key => $menu ) :
    if ( isset($menu->items ) ) : 
      foreach ( $menu->items as $item) :
        if ( $item->object_id ) :
          //~ $pages[$key] = (isset($pages[$key])) ? $pages[$key] : array();
          //~ $pages[$key][] = $item->object_id;
          $item->page = new TimberPost($item->object_id);
        else:
          $item->page = false;
        endif;

        if ( isset ( $item->children ) ) :
          foreach ( $item->children as $child ) :
            if ( $child->object_id ) : 
              $child->page = new TimberPost($child->object_id);
            else:
              $child->page = false;
            endif;
          endforeach;
        endif;
      endforeach;
    endif;
  endforeach;

  $context['logo'] = get_option('bwb_theme_image');
  $context['logo_title'] = get_option('bwb_theme_logo_title');

  $context['show_page_title'] = get_option('bwb_theme_show_title');

  $context['page_title'] = get_option('bwb_theme_page_title');
  $context['page_title_link'] = get_option('bwb_theme_page_title_link');

  $context['show_page_tagline'] = get_option('bwb_theme_show_tagline');

  $context['page_tagline'] = get_option('bwb_theme_page_tagline');
  $context['page_tagline_link'] = get_option('bwb_theme_page_tagline_link');

  return $context;
}


?>
