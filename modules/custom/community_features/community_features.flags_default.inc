<?php

/**
 * Implements hook_flag_default_flags
 * 
 * @return array
 */
function community_features_flag_default_flags() {
  $flags = array();
// Exported flag: "Follow User".
  $flags['cf_follow_user'] = array(
      'entity_type' => 'user',
      'title' => 'Follow User',
      'global' => 0,
      'types' => array(),
      'flag_short' => 'Follow User',
      'flag_long' => '',
      'flag_message' => '',
      'unflag_short' => 'Stop Following User',
      'unflag_long' => '',
      'unflag_message' => '',
      'unflag_denied_text' => '',
      'link_type' => 'toggle',
      'weight' => 0,
      'show_in_links' => array(
          'full' => 'full',
          'token' => 0,
      ),
      'show_as_field' => 0,
      'show_on_form' => 0,
      'access_author' => '',
      'show_contextual_link' => 0,
      'show_on_profile' => 1,
      'access_uid' => 'others',
      'api_version' => 3,
  );
  // Exported flag: "Like Show".
  $flags['cf_like_show'] = array(
      'entity_type' => 'node',
      'title' => 'Like Show',
      'global' => 0,
      'types' => array(
          0 => 'cm_show',
      ),
      'flag_short' => 'Like',
      'flag_long' => '',
      'flag_message' => '',
      'unflag_short' => 'Unlike',
      'unflag_long' => '',
      'unflag_message' => '',
      'unflag_denied_text' => '',
      'link_type' => 'toggle',
      'weight' => 0,
      'show_in_links' => array(
          'full' => 'full',
          'teaser' => 'teaser',
          'rss' => 0,
          'search_index' => 0,
          'search_result' => 0,
          'token' => 0,
      ),
      'show_as_field' => 0,
      'show_on_form' => 0,
      'access_author' => '',
      'show_contextual_link' => 0,
      'i18n' => 0,
      'api_version' => 3,
  );
  return $flags;
}
