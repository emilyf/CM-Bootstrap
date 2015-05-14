<?php
/**
 * @file
 * Custom data queries.
 *
 */

/*function _custom_video_lists_block_series_show_carousels($nid) {
  
}*/







/**
 *
 */
function _custom_video_lists_block_carousels($nid) {
  if (isset($nid)) {
    $node = node_load($nid);    
    //dpm($node);
    
    foreach($node->field_custom_video_list['und'] as $custom_video_list_nid) {
      $custom_video_list_node = node_load($custom_video_list_nid['target_id']);
      
      
      if (isset($custom_video_list_node->field_videos_to_highlight['und'])) {    
        $field_videos_delta = $custom_video_list_node->field_videos_to_highlight['und'];
      }
        
      if (isset($custom_video_list_node->field_series_to_highlight['und'])) {       
        $field_videos_delta = $custom_video_list_node->field_series_to_highlight['und'];
      }
      
          
      $video_item_node_array = array();
      foreach($field_videos_delta as $video_item_nid) {
        $video_item_node = node_load($video_item_nid['target_id']);
        $video_item_node_array[] = $video_item_node;
        
        //        
        $items[$custom_video_list_node->nid] = array(
          'collection_nid' => $custom_video_list_node->nid,
          'collection_title' => $custom_video_list_node->title,
          'collection_desc' => $custom_video_list_node->field_custom_video_description['und'][0]['value'],
          'video_items' => $video_item_node_array,
        );  
      }
    }    
  }
  
  //dpm($items);
  
  
  return theme('cvl_block_carousels', 
    array (
      //'series_data' => $series_data,
      'content' => $items,
    )
  );
}

/**
 *
 */
function _custom_video_lists_partner_carousels() {
  // START: Get All 'Partner' Nodes
  $query = new EntityFieldQuery();
    $query->entityCondition('entity_type', 'node');
    $query->entityCondition('bundle', 'partner');
    $query->propertyCondition('status', 1);
    $query->range(0, 25);
    $query->propertyOrderBy('title', 'ASC');
  
  $result = $query->execute();
    
  if (isset($result['node'])) {
    $nids = array_keys($result['node']);
    $nodes = entity_load('node', $nids);
  }
  // END: Get All 'Partner' Nodes
  
  // For each partner node get ref'd cm_project nodes.
  // Each partner could have multiple ref'd cm_project nodes.
  foreach ($nodes as $node) { 
    $cm_project_query = new EntityFieldQuery();
      $cm_project_query->entityCondition('entity_type', 'node');
      $cm_project_query->entityCondition('bundle', 'cm_project');
      $cm_project_query->propertyCondition('status', 1);
      $cm_project_query->fieldCondition('field_partner', 'target_id', $node->nid, '=');
      
      $cm_project_query->propertyOrderBy('created', 'DESC');
    
    $cm_project_result = $cm_project_query->execute();    
    
    if (isset($cm_project_result['node'])) {
      $cm_project_nids = array_keys($cm_project_result['node']);
      $cm_project_nodes = entity_load('node', $cm_project_nids);
    }
    
    // Build items array for use in TPL.
    $items[$node->nid] = array(
      'nid' => $node->nid,
      'title' => $node->title,  
      'video_node' => $cm_project_nodes,
    );
  }
    
  //dpm($items);
  
  // Send $items array to TPL.  
  return theme('cvl_partner_carousels', 
    array (
      'content' => $items,
    )
  );
    
  //return 'test';
}
















/**
 *
 */
function _custom_video_lists_partner_carousels_old() {
  $query = new EntityFieldQuery();
    $query->entityCondition('entity_type', 'node');
    $query->entityCondition('bundle', 'partner');
    $query->propertyCondition('status', 1);
    //$query->propertyCondition('promote', 1);
    $query->range(0, 25);
    $query->propertyOrderBy('title', 'ASC');
    
    // Make sure node has an image to display.    
    //$query->fieldCondition('field_show_vod', 'fid', 'NULL', '!=');
  
  $result = $query->execute();
    
  if (isset($result['node'])) {
    $nids = array_keys($result['node']);
    $nodes = entity_load('node', $nids);
  }
  
  foreach ($nodes as $node) { 
    //dpm($node);
    
    // Get custom video list NID
    $field_custom_video_list_nid = $node->field_custom_video_list['und'][0]['target_id'];
    
    // Load custom video list Node.
    $field_custom_video_list_node = node_load($field_custom_video_list_nid);
    
    // Start building video nid array.
    $videos_nids[$node->nid][$field_custom_video_list_nid] = array();
    
    // Check if field_videos_to_highlight used for node.
    if (isset($field_custom_video_list_node->field_videos_to_highlight['und'])) {
      foreach($field_custom_video_list_node->field_videos_to_highlight['und'] as $video_items) {
        $videos_nids[$node->nid][$field_custom_video_list_nid][] = $video_items['target_id'];
      }
    }
    
    // Check if field_series_to_highlight used for node.
    if (isset($field_custom_video_list_node->field_series_to_highlight['und'])) {
      foreach($field_custom_video_list_node->field_series_to_highlight['und'] as $video_items) {
        $videos_nids[$node->nid][$field_custom_video_list_nid][] = $video_items['target_id'];
      }
    }
    
    $video_node[$node->nid][$field_custom_video_list_nid] = array();
    //
    foreach($videos_nids[$node->nid][$field_custom_video_list_nid] as $video_nid) {
      //dpm($video_nid);
      $video_node[$node->nid][$field_custom_video_list_nid][$node->nid][] = node_load($video_nid);
    }
    
    //dpm($video_node[$node->nid]);
    
    //dpm($videos_nids);
    
        
    $items[$node->nid] = array(
      'nid' => $node->nid,
      'title' => $node->title,  
      //'videos_nids' => $videos_nids[$node->nid][$field_custom_video_list_nid],
      'video_node' => $video_node[$node->nid][$field_custom_video_list_nid],
    );
    
  }
  
  //dpm($items);
  
  //theme  
  return theme('cvl_partner_carousels', 
    array (
      'content' => $items,
    )
  );
  
  //return 'test';
}






