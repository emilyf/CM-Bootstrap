<?php

/**
 * @file
 * template.php
 */
 
/**
 * Implements template_preprocess_html(&$variables).
 */
function cm_bootstrap_preprocess_html(&$variables) {
  foreach($variables['user']->roles as $role){
    $variables['classes_array'][] = 'role-' . drupal_html_class($role);
  }
  // Set meta data for show images for facebook opengraph
  $node = menu_get_object();
  if (!empty($node)) {
    if ($node->type == 'cm_show') {
      //dpm($node);
      // Switch to account for cloudcast, vimeo, youtube, etc.     
      if (isset($node->field_show_vod['und'])) {        
        switch($node->field_show_vod['und'][0]['filemime']) {
          case 'video/cloudcast':
            $image_uri = 'media-cloudcast/' . $node->field_show_vod['und'][0]['filename']  . '.jpg';
            break;
          case 'video/vimeo':
            $image_uri = str_replace('vimeo://v/', 'media-vimeo/', $node->field_show_vod['und'][0]['uri']);
            $image_uri = $image_uri . '.jpg';
            break;
          case 'video/youtube':  
            $image_uri = str_replace('youtube://v/', 'media-youtube/', $node->field_show_vod['und'][0]['uri']);
            $image_uri = $image_uri . '.jpg';
            break;
        }
      }
      $variables['cm_og_image'] = $GLOBALS['base_url'] . '/sites/default/files/styles/500x281/public/' . $image_uri;
    }
  }
}

/**
 * Implements template_preprocess_page(&$variables).
 */
function cm_bootstrap_preprocess_page(&$variables) {
  if (!drupal_is_front_page()) {
    //
    if (isset($variables['node'])) {
      $variables['theme_hook_suggestions'][] = 'page__' . $variables['node']->type;
    }
  }
}
 
/**
 * Implements template_preprocess_node(&$variables)
 */
function cm_bootstrap_preprocess_node(&$variables) {
  $variables['theme_hook_suggestions'][] = 'node__' . $variables['nid'];
  $variables['theme_hook_suggestions'][] = 'node__' . $variables['view_mode'];
  $variables['theme_hook_suggestions'][] = 'node__' . $variables['type'] . '__' . $variables['view_mode'];
}

/**
 * Implements template_preprocess_user_profile
 * 
 * @param type $variables
 */
function cm_bootstrap_preprocess_user_profile(&$variables) {
//  die("<pre>".var_export($variables, true));
  $account = $variables['elements']['#account'];

  if (module_exists('community_features')) {
    if (!empty($variables['field_featured_video']))
      $variables['featured_video'] = field_view_field('node', $variables['field_featured_video'][0]['entity'], 'field_show_vod', 'Full content');
    else
      $variables['featured_video'] = false;
    $variables['recent_videos'] = _community_features_get_recent_videos($account->uid);
    $variables['following'] = _community_features_get_following($account->uid);
    $variables['follows'] = _community_features_get_follows($account->uid);
    $variables['likes'] = _community_features_get_likes($account->uid);
    $variables['video_count'] = _community_features_get_user_video_count($account->uid);
  }
}

/**
 * Implements theme_menu_link(array $variables).
 *
 * Overrides bootstrap's theme/menu/menu-link.func.php:bootstrap_menu_link(array $variables) 
 * To remove the drop-down menus and other crap that bootstrap adds.
 * This resets theme_menu_link to its default code.
 */
function cm_bootstrap_menu_link(array $variables) {
  $element = $variables ['element'];
  $sub_menu = '';

  if ($element ['#below']) {
    $sub_menu = drupal_render($element ['#below']);
  }
  $output = l($element ['#title'], $element ['#href'], $element ['#localized_options']);
  return '<li' . drupal_attributes($element ['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Implements template_preprocess_search_result(&$variables)
 */
function cm_bootstrap_preprocess_search_result(&$variables) {
  //dpm($variables);
  if (isset($variables['result']['node'])) {
    $node = $variables['result']['node'];
    if (isset($node->field_show_vod['und'])) {        
      switch($node->field_show_vod['und'][0]['filemime']) {
        case 'video/cloudcast':
          $image_uri = 'media-cloudcast/' . $node->field_show_vod['und'][0]['filename']  . '.jpg';
          break;
        case 'video/vimeo':
          $image_uri = str_replace('vimeo://v/', 'media-vimeo/', $node->field_show_vod['und'][0]['uri']);
          $image_uri = $image_uri . '.jpg';
          break;
        case 'video/youtube':  
          $image_uri = str_replace('youtube://v/', 'media-youtube/', $node->field_show_vod['und'][0]['uri']);
          $image_uri = $image_uri . '.jpg';
          break;
      }
      $variables['cm_show_img'] = image_style_url('medium', $image_uri);
    }
  }
}
