<?php
  
function _cb_custom_video_lists() {
  // Make sure we're on a node pg.
  if (arg(0) == 'node' && is_numeric(arg(1))) {
    $node = node_load(arg(1));
    // Make sure there's a custom video list.
    if (isset($node->field_custom_video_list['und'])) {
      //dpm($node);      
      foreach ($node->field_custom_video_list['und'] as $custom_video_list_nid) {
        // Load each custom video list node.
        $custom_video_list_node = node_load($custom_video_list_nid['target_id']);      
        //dpm($custom_video_list_node);
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
          
          $collection_desc = isset($custom_video_list_node->field_custom_video_description['und'][0]['value']) ? $custom_video_list_node->field_custom_video_description['und'][0]['value'] : '';
          //
          $items[$custom_video_list_node->nid] = array(
            'collection_nid' => $custom_video_list_node->nid,
            'collection_title' => $custom_video_list_node->title,
            'collection_desc' => $collection_desc,
            'video_items' => $video_item_node_array,
          );  
        }
      }
      //dpm($items);
      return theme('cb_custom_video_lists', 
        array (
          //'series_data' => $series_data,
          'content' => $items,
        )
      );
    }
  }
}