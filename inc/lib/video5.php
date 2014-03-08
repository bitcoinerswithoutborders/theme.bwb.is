<?php
  function bwb_video5( $atts ) {
    extract( shortcode_atts( array(
      'mp4' => null,
      'webm' => null,
      'ogg' => null,
      'height' => null,
      'width'  => null,
      'videoId' => 'player',
      'loop'   => null,
      'controls' => null,
      'altText' => null,
    ), $atts ) );

    if ($mp4 || $webm || $ogg ) :
      $str = '<video id="' . $videoId . '"';

      if ( $height ) :
        $str .= ' height="' . $height . '"';
      endif;

      if ( $width ) :
        $str .= ' width="' . $width . '"';
      endif;

      if ( $controls ) :
        $str .= ' controls="controls"';
      endif;

      if ( $loop ) :
        $str .= ' loop="loop"';
      endif;

      $str .= '>';

      if ( $mp4 ) :
        $str .= '<source src="' . $mp4 . '" type="video/ogg; codecs=&quot;theora, vorbis&quot;">';
      endif;

      if ( $webm ) :
        $str .= '<source src="' . $webm . '" type="video/ogg; codecs=&quot;theora, vorbis&quot;">';
      endif;

      if ( $ogg ) :
        $str .= '<source src="' . $ogg . '" type="video/ogg; codecs=&quot;theora, vorbis&quot;">';
      endif;

      if ( $altText ) :
        $str .= '<div>' . $altText . '</div>';
      endif;

      $str .= '</video>';

      return $str;

    endif;
  }

  add_shortcode( 'video5', 'bwb_video5' );
