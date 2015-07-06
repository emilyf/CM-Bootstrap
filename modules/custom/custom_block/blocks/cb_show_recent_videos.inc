<?php

function _cb_show_recent_videos() {
  $query = new EntityFieldQuery();
    $query->entityCondition('entity_type', 'node');
    $query->entityCondition('bundle', 'cm_show');
    $query->propertyCondition('status', 1);
    $query->range(0, 25);
    $query->propertyOrderBy('created', 'DESC');
    // Make sure node has an image to display.    
    $query->fieldCondition('field_show_vod', 'fid', 'NULL', '!=');
  $result = $query->execute();
  if (isset($result['node'])) {
    $nids = array_keys($result['node']);
    $nodes = entity_load('node', $nids);
    foreach ($nodes as $node) {       
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
      // field_description
      if (isset($node->field_description['und'][0]['value'])) {
        $allowable_tags = '<i><a>';
        $field_description = strip_tags($node->field_description['und'][0]['value'], $allowable_tags);
      }
      else {
        $allowable_tags = '';
        $field_description = '';
      }
      // field_topic
      if (isset($node->field_topic['und'][0]['tid'])) {
        $field_topic_term = taxonomy_term_load($node->field_topic['und'][0]['tid']);
        $field_topic_term_name = $field_topic_term->name;
      }
      else {
        $field_topic_term_name = '';
      }     
      if (isset($node->og_group_ref['und'][0]['target_id'])) {
        $nid = $node->og_group_ref['und'][0]['target_id'];
        $series_title = db_query("SELECT title FROM {node} WHERE nid = :nid", array(':nid' => $nid))->fetchField();
      }
      else {
        $series_title = '';
      }
      // Build data array
      $items[$node->nid] = array(
        'nid' => $node->nid,
        'title' => $node->title,      
        'description' => custom_block_truncate($field_description, $length = 125, array('html' => true, 'ending' => ' . . .', 'exact' => FALSE)),  
        'series' => $field_topic_term_name,  
        'series_title' => $series_title,  
        'img' => image_style_url('500x281', $image_uri),
      );
    }
  }
  // Send data to TPL.  
  return theme('cb_show_recent_videos', 
    array (
      'content' => $items,
    )
  );
  
  
  
  return '_cb_show_recent_videos';
}