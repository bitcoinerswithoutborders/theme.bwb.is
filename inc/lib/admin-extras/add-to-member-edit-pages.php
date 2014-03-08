<?php

add_filter( 'rwmb_meta_boxes', 'BWB_members_register_meta_boxes' );

function BWB_members_register_meta_boxes( $meta_boxes ) {
  $prefix = 'bwb_members_';

  $networks = array(
    array(
      'id'   => $prefix . 'nickname',
      'desc' => "Your bwb.is public nickname", 
      'type' => 'text',
      'std'  => '',
    ),
    array(
      'id'   => $prefix . 'title',
      'desc' => "Your bwb.is public title/position within the ngo", 
      'type' => 'text',
      'std'  => '',
    ),
    array(
      'id'   => $prefix . 'first_name',
      'desc' => "Your bwb.is public first name", 
      'type' => 'text',
      'std'  => '',
    ),
    array(
      'id'   => $prefix . 'last_name',
      'desc' => "Your bwb.is public last name", 
      'type' => 'text',
      'std'  => '',
    ),
    array(
      'id'   => $prefix . 'homepage',
      'desc' => "Your homepage url including http://", 
      'type' => 'text',
      'std'  => '',
    ),
    array(
      'id'   => $prefix . 'github',
      'desc' => "Your github username", 
      'type' => 'text',
      'std'  => '',
    ),
    array(
      'id'   => $prefix . 'bwb_blog',
      'desc' => 'Your bwb blog domain (****.bwb.is)',
      'type' => 'text',
      'std'  => 'http://',
    ),
    array(
      'id'   => $prefix . 'twitter',
      'desc' => 'Your twitter handle (without @)',
      'type' => 'text',
      'std' => '',
    ),
    array(
      'id'   => $prefix . 'linkedin',
      'desc' => 'Your linkedin url (full url with http://)',
      'type' => 'url',
      'std' => '',
    ),
    array(
      'id'   => $prefix . 'soup',
      'desc' => 'Your soup url (full url with http://)',
      'type' => 'url',
      'std' => '',
    ),
    array(
      'id'   => $prefix . 'facebook',
      'desc' => 'Your facebook url (full url with http://)',
      'type' => 'url',
      'std' => '',
    ),
    array(
      'id'   => $prefix . 'googleplus',
      'desc' => 'Your googleplus url (full url with http://)',
      'type' => 'url',
      'std' => '',
    ),
  );

  $meta_boxes[] = array(
    'id'       => 'social',
    'title'    => 'Social Networks:',
    'pages'    => array( 'bwb_members' ),
    'context'  => 'normal',
    'priority' => 'high',

    'fields' => $networks,
  );

  return $meta_boxes;
}
?>
