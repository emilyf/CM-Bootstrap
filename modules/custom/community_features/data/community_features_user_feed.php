<?php

function community_features_user_feed() {
  $uid = $GLOBALS['user']->uid;
  $flags = flag_get_user_flags('user', null, $uid);
  //dpm($flags); 
  if (isset($flags)) {
    foreach($flags['cf_follow_user'] as $flag) {
      //dpm($flag);
      $author_uid = $flag->entity_id;
      $query = new EntityFieldQuery();
      $query->entityCondition('entity_type', 'node')
        ->entityCondition('bundle', 'cm_show')
        ->propertyCondition('status', 1)
        ->propertyCondition('uid', $author_uid)
        ->propertyOrderBy('created', 'DESC')
        // Skip node if field_show_vod has no video
        ->fieldCondition('field_show_vod', 'fid', 'NULL', '!=')
        ->pager(5);
        //->range(0, 100);    
      $result = $query->execute();      
      if (isset($result['node'])) {
        $nids = array_keys($result['node']);
        $nodes = entity_load('node', $nids);
        foreach ($nodes as $node) { 
          $items[$node->nid] = array(
            'node' => $node, 
          );
        }
      } 
    }  
    $build['pager'] = array(
      '#theme' => 'pager',
      '#weight' => 5,
    );
    //dpm($items);
    // Send data to TPL.  
    return theme('cf_user_feed_all', 
      array (
        'content' => isset($items) ? $items : '',
        'pager' => $build['pager'],
      )
    );
  }
  //return 'community_features_user_feed';
}