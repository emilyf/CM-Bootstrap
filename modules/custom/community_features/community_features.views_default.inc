<?php

/**
 * Implements hook_views_default_views
 */
function community_features_views_default_views() {
  $files = file_scan_directory(drupal_get_path('module', 'community_features') . '/views', '/.*\.view$/');
  foreach ($files as $absolute => $file) {
    require $absolute;
    if (isset($view)) {
      $views[$file->name] = $view;
    }
  }
  return $views;
}
