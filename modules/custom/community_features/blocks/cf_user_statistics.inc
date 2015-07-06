<?php

function _cf_user_statistics() {
  //$variables['recent_videos'] = _community_features_get_recent_videos($account->uid);
  //$variables['following'] = _community_features_get_following($account->uid);
  //$variables['follows'] = _community_features_get_follows($account->uid);
  //$variables['likes'] = _community_features_get_likes($account->uid);
  //$variables['video_count'] = _community_features_get_user_video_count($account->uid);
  
  $uid = arg(1);
  $user = user_load($uid);
  //dpm($user);
  
  $build = array(
    'uid' => $uid,
    'user_name' => $user->name,
    'video_count' => _community_features_get_user_video_count($uid),
    'following_count' => _community_features_get_following($uid),
    'followers_count' => _community_features_get_follows($uid),
    'likes_count' => _community_features_get_likes($uid),
  );
  
  // Send data to TPL.  
  return theme('cf_user_statistics', 
    array (
      'content' => $build,
    )
  ); 
}