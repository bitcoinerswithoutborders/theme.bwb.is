<?php
$footer_page_metabox = array(
  'id' => 'footer-page-metabox',
  'title' => __('Footer Page Options', 'quadro'),
  'page' => 'quadro_footer_page',
  'context' => 'normal',
  'priority' => 'high',
  'fields' => array(
    array(
      'name' => __('Show Icon, Image or Text?', 'quadro'),
      'id' => $prefix . 'footer_page_image_or_icon',
      'type' => 'radio',
      'options' => array(
        array('name' => 'Icon', 'value' => 'icon' ),
        array('name' => 'Image', 'value' => 'image' ),
        array('name' => 'Text', 'value' => 'text' ),
        array('name' => 'Nothing', 'value' => 'none' ),
      ),
      'std' => 'icon',
      'desc' => __('Will use the Featured Image if set to Image. Input the Link text below if set to text. If set to nothing the page will not have a menu item at all.', 'quadro'),
    ),
    array(
      'name' => __('Text:', 'quadro'),
      'id' => $prefix . 'footer_page_text',
      'type' => 'text',
    ),

    array(
      'name' => __('Social Icon:', 'quadro'),
      'id' => $prefix . 'footer_page_social_icon',
      'type' => 'icon_extended',
    ),
    array(
      'name' => __('Social Icon Color:', 'quadro'),
      'id' => $prefix . 'footer_page_social_icon_color',
      'type' => 'color',
      'std'  => '#',
    ),
    array(
      'name' => __('Social Icon Hover Color:', 'quadro'),
      'id' => $prefix . 'footer_page_social_icon_color_hover',
      'type' => 'color',
      'std'  => '#',
    ),
    array(
      'name' => __('Use as normal link:', 'quadro'),
      'id' => $prefix . 'footer_page_link_type',
      'type' => 'checkbox',
      'desc' => __('If this checkbox is checked the social icon will just open a new page on click instead of showing the page content on hover/click', 'quadro'),
    ),
    array(
      'name' => __('Link Target:', 'quadro'),
      'id' => $prefix . 'footer_page_link_url',
      'type' => 'text',
      'desc' => __('Will only be used if "Use as normal Link" above is checked.', 'quadro'),
    ),
    array(
      'name' => __('Open Link in a new Tab:', 'quadro'),
      'id' => $prefix . 'footer_page_link_target',
      'type' => 'checkbox',
      'desc' => __('If this checkbox is checked the social icon will open the link in a new tab. Only works if "Use as normal link" above is checked too.', 'quadro'),
    ),
    array(
      'name' => __('Show Link:', 'quadro'),
      'id' => $prefix . 'footer_page_link_show',
      'type' => 'checkbox',
      'desc' => __('If this checkbox is NOT checked, then the text will never be linked. Overwrites all link settings above.', 'quadro'),
    ),
    

    array(
      'name' => __('Hide Page Header:', 'quadro'),
      'id' => $prefix . 'footer_page_title_hide',
      'type' => 'checkbox',
    ),
    array(
      'name' => __('Header Text Color:', 'quadro'),
      'id'   => $prefix . 'footer_page_header_text_color',
      'type' => 'color',
      'std'  => '#676766',
    ),
    array(
      'name' => __('Header Bg Color:', 'quadro'),
      'id'   => $prefix . 'footer_page_header_bg_color',
      'type' => 'color',
      'std'  => '#ffffff',
    ),
    array(
      'name' => __('Subpage Background Color:', 'quadro'),
      'id'   => $prefix . 'footer_page_bg_color',
      'type' => 'color',
      'std'  => '#676766',
    ),
    array(
      'name' => __('Subpage Text Color:', 'quadro'),
      'id'   => $prefix . 'footer_page_text_color',
      'type' => 'color',
      'std'  => '#bfbfbf',
    ),
    array(
      'name' => __('Subpage Link Text Color:', 'quadro'),
      'id'   => $prefix . 'footer_page_link_color',
      'type' => 'color',
      'std'  => '#ff9d1c',
    ),
    array(
      'name' => __('Subpage Link Hover Color:', 'quadro'),
      'id'   => $prefix . 'footer_page_link_color_hover',
      'type' => 'color',
      'std'  => '#ffffff',
    ),
  )
);
?>
