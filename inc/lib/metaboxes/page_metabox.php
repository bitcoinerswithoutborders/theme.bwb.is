<?php
$page_metabox = array(
  'id' => 'page-metabox',
  'title' => __('Page Options', 'quadro'),
  'page' => 'page',
  'context' => 'normal',
  'priority' => 'high',
  'fields' => array(
    array(
      'name' => __('Select Sidebar', 'quadro'),
      'id' => $prefix . 'page_sidebar',
      'type' => 'sidebar_picker',
    ),
    array(
      'name' => __('Breadcrumbs on this page', 'quadro'),
      'id' => $prefix . 'page_breadcrumbs',
      'type' => 'select',
      'options' => array(
        array('name' => __('Show', 'quadro' ), 'value' => 'show'),
        array('name' => __('Hide', 'quadro' ), 'value' => 'hide')
        ),
      'std' => 'show'
    ),
    array(
      'name' => __('Header Style', 'quadro'),
      'id' => $prefix . 'page_header_style',
      'type' => 'select',
      'options' => array(
        array('name' => __('Default', 'quadro' ), 'value' => 'default'),
        array('name' => __('Styled', 'quadro' ), 'value' => 'styled')
        ),
      'std' => 'show',
      'desc' => __('Note: The following header styling options apply only for Styled page header.', 'quadro')
    ),
    array(
      'name' => __('Page Header Align', 'quadro'),
      'id' => $prefix . 'page_header_align',
      'type' => 'radio',
      'options' => array(
        array('name' => __('Centered', 'quadro' ), 'value' => 'center'),
        array('name' => __('Left Aligned', 'quadro' ), 'value' => 'left')
        ),
      'std' => 'center'
    ),
    array(
      'name' => __('Title color', 'quadro'),
      'id' => $prefix . 'page_title_color',
      'type' => 'color',
      'std' => '#'
    ),
    array(
      'name' => __('Header Back color', 'quadro'),
      'id' => $prefix . 'page_header_back_color',
      'type' => 'color',
      'std' => '#'
    ),
    array(
      'name' => __('Header Back pattern', 'quadro'),
      'id' => $prefix . 'page_header_back_pattern',
      'type' => 'pattern_picker'
    ),
    array(
      'name' => __('Use Picture as Header Back (uses Feat. Image)', 'quadro'),
      'id' => $prefix . 'page_header_back_usepic',
      'type' => 'checkbox'
    ),
    array(
      'name' => __('Header Animation:', 'quadro'),
      'id' => $prefix . 'page_header_anim',
      'type' => 'select',
      'options' => array(
        array('name' => __('None', 'quadro' ), 'value' => 'none'),
        array('name' => __('Left to Right', 'quadro' ), 'value' => 'left-to-right'),
        array('name' => __('Right to Left', 'quadro' ), 'value' => 'right-to-left'),
        array('name' => __('Top to Bottom', 'quadro' ), 'value' => 'top-to-bottom'),
        array('name' => __('Bottom to Top', 'quadro' ), 'value' => 'bottom-to-top'),
        array('name' => __('Scale and Fade in', 'quadro' ), 'value' => 'appear'),
      ),
      'std' => 'none',
    ),
    array(
      'name' => __('Display Title', 'quadro'),
      'id' => $prefix . 'page_show_title',
      'type' => 'checkbox'
    ),
    array(
      'name' => __('Display Tagline', 'quadro'),
      'id' => $prefix . 'page_show_tagline',
      'type' => 'checkbox'
    ),
    array(
      'name' => __('Tagline text', 'quadro'),
      'id' => $prefix . 'page_tagline',
      'type' => 'textarea',
      'sanitize' => 'html',
      'desc' => ''
    ),
    array(
      'name' => __('Use Picture as Page Back', 'quadro'),
      'id' => $prefix . 'page_back_usepic',
      'type' => 'checkbox'
    ),
    array(
      'name' => __('Background for this Page', 'quadro'),
      'id' => $prefix . 'page_back_pic',
      'type' => 'upload'
    ),
    array(
      'name' => __('Video Player Width', 'quadro'),
      'id' => $prefix . 'page_video_width',
      'type' => 'radio',
      'options' => array(
        array('name' => '50% of page Width', 'value' => '50'),
        array('name' => '75% of page Width', 'value' => '75'),
        array('name' => '100% of page Width', 'value' => '100'),
      ),
      'std' => '50',
    ),
    array(
      'name'  => __('Video Player Background Color', 'quadro'),
      'id'    => $prefix . 'page_video_bg_color',
      'type'  => 'color',
      'std'   => '#000000',
    ),
    array(
      'name'  => __('Video Player Title Text Color', 'quadro'),
      'id'    => $prefix . 'page_video_title_text_color',
      'type'  => 'color',
      'std'   => '#ffffff',
    ),
  )
);
?>
