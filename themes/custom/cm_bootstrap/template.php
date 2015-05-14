<?php

/**
 * @file
 * template.php
 */

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
  }
}

/**
 * Implements template_preprocess_field(&$variables, $hook).
 */
/*function cm_bootstrap_preprocess_field(&$variables, $hook) {  
  if ($variables['element']['#field_name'] == 'field_tags') {
    foreach($variables['items'] as $item) {
      dpm($item);
      $item['#title'] = $item['#title'] . ',';
    }
    dpm($variables);
  }
}*/

/**
 * Implements theme_field($variables).
 */
/*function cm_bootstrap_field__field_tags__cm_show($variables) {
  foreach($variables['items'] as $item) {
    dpm($item);
    $item['#title'] = $item['#title'] . ',';
  }
  dpm($variables);
}*/