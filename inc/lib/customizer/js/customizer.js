/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {


  /* ==================================================
   * = customize                                      =
   * = usage:                                         =
   * =   customize(                                   =
   * =    'option_name',                              =
   * =    'option_type',                              =
   * =    'jquery trigger element',                   =
   * =    'css_attribute_to_change',                  =
   * =    'target'                                    =
   * =   );                                           =
   * =                                                =
   * = This function execs all wp.customize functions =
   * ==================================================
   */

  function customize(name, type, ele, attr, target, postfix) {

    name = 'BWB_' + name;
    target = target || ele;

    wp.customize( name, function( value ) {
      value.bind( function( to ) {

        console.log( 'name = ' + name + ' to = ' + to);

        if (type === 'css' ) {
          //saving current state
          //~ target.attr( 'old-' + attr, target.css(attr) );
          
          if ( typeof postfix !== 'undefined' ) {
            to = to + postfix;
          }

          //setting css attr of element to to
          target.css(attr, to);

        } else if (type === 'text' ) {
          //setting text of element to to
          target.text(to);

        } else if (type === 'showhide' ) {
          //showing or hiding the element based on to
          if (!to) {
            target.hide();
          } else {
            target.show();
          }
        } else if (type === 'hover' ) {
          //hover effects based on to
          ele.on( 'mouseover', function () {
            if (!target.hasClass( 'hover' )) {
              target.addClass( 'hover' );
              //saving current state
              target.attr( 'old-' + attr, target.css(attr) );

              //set target css to
              target.addClass( 'hover' );
            }
          } );

          ele.on( 'mouseout', function () {
            //delete state
            if (target.attr( 'old-' + attr ) ) {
              target.attr( 'old-' + attr, '' );
            }

            target.removeClass( 'hover' );

            //reset target state
            target.removeClass( 'hover' );
          } );

        } else if (type === 'attr' ) {
          //setting element attr to to
          target.attr(attr, to);
        }
      } );
    } );
  }

  /* ============================
   * = Frontpage Slideshow      =
   * ============================
   */

  customize(
      'layout[min_height]'
    , 'css'
    , $( '#background-image img' )
    , 'min-height'
  );
  customize(
      'layout[max_height]'
    , 'css'
    , $( '#background-image img' )
    , 'max-height'
  );

  /* =====================
   * = Header Title      =
   * =====================
   */


  //title width
  customize(
      'header_title_width'
    , 'css'
    , $( '#masthead #branding #site-title-container' )
    , 'width'
    , false
    , '%'
  );
  
  //title min width
  customize(
      'header_title_min_width'
    , 'css'
    , $( '#masthead #branding #site-title-container' )
    , 'min-width'
    , false
    , 'px'
  );
   //title max width
  customize(
      'header_title_max_width'
    , 'css'
    , $( '#masthead #branding #site-title-container' )
    , 'max-width'
    , false
    , 'px'
  );


  //header title text alignment
  customize(
      'header_title_alignment'
    , 'css'
    , $( '#masthead #branding #site-title-container' )
    , 'text-align'
  );

  //header title 
  customize(
      'header_title_font_size'
    , 'css'
    , $( '#branding #site-title-container' )
    , 'font-size'
  );

  
  customize(
      'header_tagline_font_size'
    , 'css'
    , $( '#branding #site-tagline-container' )
    , 'font-size'
  );

  customize(
      'header_title_line_height'
    , 'css'
    , $( '#branding #site-title-container' )
    , 'line-height'
  );

  
  customize(
      'header_tagline_line_height'
    , 'css'
    , $( '#branding #site-tagline-container' )
    , 'line-height'
  );


  //tagline width
  customize(
      'header_tagline_width'
    , 'css'
    , $( '#masthead #branding #site-tagline-container' )
    , 'width'
    , false
    , '%'
  );


  //tagline min width
  customize(
      'header_tagline_min_width'
    , 'css'
    , $( '#masthead #branding #site-tagline-container' )
    , 'min-width'
    , false
    , 'px'
  );
   //tagline max width
  customize(
      'header_tagline_max_width'
    , 'css'
    , $( '#masthead #branding #site-tagline-container' )
    , 'max-width'
    , false
    , 'px'
  );


  //header title text
  customize(
      'header_title'
    , 'text'
    , $( '#site-title' )
  );

  //header title text color
  customize(
      'header_title_text_color'
    , 'css'
    , $( '#site-title' )
    , 'color'
  );

  //show or hide header title
  customize(
      'header_title_show'
    , 'showhide'
    , $( '#site-title' )
  );

  /* =====================
   * = Header Tagline    =
   * =====================
   */
  
  //header tagline text alignment
  customize(
      'header_tagline_alignment'
    , 'css'
    , $( '#masthead #branding #site-tagline-container' )
    , 'text-align'
  );

  //header tagline text
  customize(
      'header_tagline'
    , 'text'
    , $( '.site-tagline' )
  );

  //header tagline text color
  customize(
      'header_tagline_text_color'
    , 'css'
    , $( '.site-tagline' )
    , 'color'
  );

  //show or hide header tagline
  customize(
      'header_tagline_show'
    , 'showhide'
    , $( '.site-tagline' )
  );

  /* ==================
   * = Colors Menu    =
   * ==================
  */

  //general page text color
  customize(
      'text_color'
    , 'css'
    , $( 'body' )
    , 'color'
  );

  //link color
  customize(
      'link_color'
    , 'css'
    , $( '#content a' )
    , 'color'
  );

  //color for hovered
  customize(
      'link_hover_color'
    , 'hover'
    , $( '#content a' )
    , 'color'
  );


  //color for headers
  customize(
      'header_bg_color'
    , 'css'
    , $( '#content header' )
    , 'background-color'
  );

  //color for header links
  customize(
      'header_text_color'
    , 'css'
    , $( '#content header h1 a, #content header h1' )
    , 'color'
  );


  //color for hovered header linksx
  customize(
      'header_text_color_hover'
    , 'hover'
    , $( '#content header h1 a, #content header h1' )
    , 'color'
  );


  var subs = ['.main', '.sub'];

  var i = 0;

  subs.forEach(function(sub) {
    i++;

    //menu background color
    customize(
        'menu_bg_color_' + i
      , 'css'
      , $( '.menu-container' + sub)
      , 'background-color'
    );

    //menu background color if hovered
    //~ customize(
        //~ 'menu_bg_hover_color_' + i
      //~ , 'hover'
      //~ , $( '.menu-container' + sub)
      //~ , 'background-color'
    //~ );

    //menu text color
    customize(
        'menu_bg_text_color_' + i
      , 'css'
      ,  $( '.menu-container' + sub).children( 'ul' ).children( 'li' ).children( 'a' )
      , 'color'
    );

    //hovered menu text color
    customize(
        'menu_bg_hover_text_color_' + i
      , 'hover'
      ,  $( '.menu-container' + sub)
      , 'color'
      , $( '.menu-container' + sub).children( 'ul' ).children( 'li' ).children( 'a' )
    );

    //hovered menu hover text color
    customize(
        'menu_bg_text_color_hover_' + i
      , 'hover'
      ,  $( '.menu-container' + sub).children( 'ul' ).children( 'li' ).children( 'a' )
      , 'color'
    );

    //set the text color for hovered links
    customize(
        'menu_bg_text_color_hover_' + i
      , 'hover'
      ,  $( '.menu-container' + sub).children( 'ul' ).children( 'li' ).children( 'a' )
      , 'color'
    );

    //set the text color for hovered links of the current page
    customize(
        'menu_bg_text_color_hover_' + i
      , 'hover'
      ,  $( '.menu-container' + sub).children( 'ul' ).children( 'li.current' ).children( 'a' )
      , 'color'
    );


    //the current menu item gets this color
    customize(
        'menu_bg_text_color_active_' + i
      , 'css'
      ,  $( '.menu-container' + sub).children( 'ul' ).children( 'li.current' ).children( 'a' )
      , 'color'
    );

    //menu current
    customize(
        'menu_bg_text_color_active_hover_' + i
      , 'hover'
      ,  $( '.menu-container' + sub).children( 'ul' ).children( 'li.current' ).children( 'a' )
      , 'color'
    );

    //menu current
    customize(
        'menu_bg_text_color_active_hover_' + i
      , 'hover'
      ,  $( '.menu-container' + sub)
      , 'color'
      , $( '.menu-container' + sub).children( 'ul' ).children( 'li.current' ).children( 'a' )
    );
  });


  /* =====================
   * = Footer Styles    =
   * =====================
   */

  //general footer visibility
  customize(
      'footer_show'
    , 'showhide'
    , $( 'footer#colophon' )
  );

  
  //general footer visibility
  customize(
      'footer_bg_color'
    , 'css'
    , $( 'footer#colophon' )
    , 'background-color'
  );
  
  //footer text color
  customize(
      'footer_text_color'
    , 'css'
    , $( '#menu-footer-container a' )
    , 'color'
  );

  //footer text hover color
  customize(
      'footer_text_hover_color'
    , 'hover'
    , $( '#menu-footer-container a' )
    , 'color'
  );


  /* =======================================
   * = Font Settings:                      =
   * =======================================
   */

} )( jQuery );
