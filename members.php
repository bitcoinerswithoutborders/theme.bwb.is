<?php
/**
 * Template Name: Member Page
 * The template for displaying all member pages.
 * @package  WordPress
 * @subpackage  BWB
 * @since    BWB 0.1
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

$member_data = get_post_meta($post->ID, 'member', true);

$context['member'] = $member_data;

Timber::render(array('member-' . $post->post_name . '.twig', 'member.twig'), $context);
