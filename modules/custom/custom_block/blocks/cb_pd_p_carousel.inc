<?php
// Debug Mode.
// Set to FALSE to hide all dpm() when pushing code to acquia cloud.
define('CUSTOM_BLOCK_DEBUG_MODE', FALSE);

function _cb_pd_p_carousel() {
  $content_types = array(
    'cm_show',
    'cm_project',
  );
  // Get current nid
  if (arg(0) == 'node' && is_numeric(arg(1))) {
    $nid = arg(1);
    $query = new EntityFieldQuery();
      $query->entityCondition('entity_type', 'node');
      $query->entityCondition('bundle', $content_types);
      $query->propertyCondition('status', 1);
      $query->range(0, 25);
      $query->propertyOrderBy('created', 'ASC');
      $query->fieldCondition('field_partner', 'target_id', $nid, '=');
    $result = $query->execute();    
    if (isset($result['node'])) {
      $nids = array_keys($result['node']);
      $nodes = entity_load('node', $nids);
      foreach($nodes as $node) {
        if ($node->type == 'cm_show') {
          $show_assoc_partner_array[] = $node;     
        }
        // Series
        if ($node->type == 'cm_project') {
          //dpm($node);
          // Get all shows that are part of this series.
          $cm_s_query = new EntityFieldQuery();
            $cm_s_query->entityCondition('entity_type', 'node');
            $cm_s_query->entityCondition('bundle', 'cm_show');
            $cm_s_query->propertyCondition('status', 1);
            $cm_s_query->range(0, 25);
            $cm_s_query->propertyOrderBy('created', 'ASC');
            $cm_s_query->fieldCondition('og_group_ref', 'target_id', $node->nid, '=');
          $cm_s_result = $cm_s_query->execute();    
          if (isset($cm_s_result['node'])) {
            $cm_s_nids = array_keys($cm_s_result['node']);
            $cm_s_nodes = entity_load('node', $cm_s_nids);
            foreach ($cm_s_nodes as $cm_s_node) {
              $entire_series_shows_node_array[] = $cm_s_node;
            }
          }
        }
      }
    }
    // Debug
    if (CUSTOM_BLOCK_DEBUG_MODE === TRUE) {
      dpm('shows associated directly with partner:');
      if (empty($show_assoc_partner_array)) {
        dpm('empty');
      }
      else {
        dpm($show_assoc_partner_array);
      }
      dpm('entire series of shows associated with partner:');
      dpm($entire_series_shows_node_array);
      dpm('----------------------------------------------------------------------------------------------');
    }
    // both shows + series
    if (isset($show_assoc_partner_array) && isset($entire_series_shows_node_array)) {
      $show_nodes = array_merge($show_assoc_partner_array, $entire_series_shows_node_array);
      // Debug
      if (CUSTOM_BLOCK_DEBUG_MODE === TRUE) {
        dpm('array merge: shows + series');
        dpm($show_nodes);
        dpm('----------------------------------------------------------------------------------------------');
      }
    }
    // series only
    else if (isset($entire_series_shows_node_array) && empty($show_assoc_partner_array)) {
      $show_nodes = $entire_series_shows_node_array;
      // Debug
      if (CUSTOM_BLOCK_DEBUG_MODE === TRUE) {
        dpm('no array merge, only series shows:');
        dpm($show_nodes);
        dpm('----------------------------------------------------------------------------------------------');
      }
    }
    // show only
    else if (isset($show_assoc_partner_array) && empty($entire_series_shows_node_array)) {
      $show_nodes = $show_assoc_partner_array;
      if (CUSTOM_BLOCK_DEBUG_MODE === TRUE) {
        dpm('no array merge, only shows associated w/ partner:');
        dpm($show_nodes);
        dpm('----------------------------------------------------------------------------------------------');
      }
    }
    //
    foreach($show_nodes as $show_node) {
      // Switch to account for cloudcast, vimeo, youtube, etc.     
      if (isset($show_node->field_show_vod['und'])) {        
        switch($show_node->field_show_vod['und'][0]['filemime']) {
          case 'video/cloudcast':
            $image_uri = 'media-cloudcast/' . $show_node->field_show_vod['und'][0]['filename']  . '.jpg';
            break;
          case 'video/vimeo':
            $image_uri = str_replace('vimeo://v/', 'media-vimeo/', $show_node->field_show_vod['und'][0]['uri']);
            $image_uri = $image_uri . '.jpg';
            break;
          case 'video/youtube':  
            $image_uri = str_replace('youtube://v/', 'media-youtube/', $show_node->field_show_vod['und'][0]['uri']);
            $image_uri = $image_uri . '.jpg';
            break;
        }
      }
      // field_description
      if (isset($show_node->field_description['und'][0]['value'])) {
        $allowable_tags = '<i><a>';
        $field_description = strip_tags($show_node->field_description['und'][0]['value'], $allowable_tags);
      }
      else {
        $allowable_tags = '';
        $field_description = '';
      }
      // field_topic
      if (isset($show_node->field_topic['und'][0]['tid'])) {
        $field_topic_term = taxonomy_term_load($show_node->field_topic['und'][0]['tid']);
        $field_topic_term_name = $field_topic_term->name;
      }
      else {
        $field_topic_term_name = '';
      }    
      // Series
      if (isset($show_node->og_group_ref['und'][0]['target_id'])) {
        $nid = $show_node->og_group_ref['und'][0]['target_id'];
        $series_title = db_query("SELECT title FROM {node} WHERE nid = :nid", array(':nid' => $nid))->fetchField();
      }
      else {
        $series_title = '';
      }
      // Production date
      if (isset($show_node->field_show_production_date['und'][0]['value'])) {
        $timestamp = strtotime($show_node->field_show_production_date['und'][0]['value']);
        $date_type = 'p';
      }
      else {
        $timestamp = $show_node->created;
        $date_type = 'nc';
      }      
      // Build items data array
      $items[$show_node->nid] = array(
        'nid' => $show_node->nid,
        'title' => $show_node->title,      
        'description' => custom_block_truncate($field_description, $length = 125, array('html' => true, 'ending' => ' . . .', 'exact' => FALSE)),  
        'series' => $field_topic_term_name,  
        'series_title' => $series_title,  
        'img' => image_style_url('500x281', $image_uri),
        'timestamp' => $timestamp,
        'date_type' => $date_type,
      );
    }
    if (CUSTOM_BLOCK_DEBUG_MODE === TRUE) {
      dpm('---before sorting----');
      dpm($items);  
    }
    uasort($items, 'custom_block_order_by_timestamp');
    if (CUSTOM_BLOCK_DEBUG_MODE === TRUE) {
      dpm('---after sorting----');
      dpm($items);
      dpm('---first item/featured video');
      $feature_video = reset($items);
      dpm($feature_video);  
    }
  }
  // Send to TPL  
  return theme('cb_pd_p_carousel', 
    array (
      'content' => $items,
    )
  );
}

/**
 * Custom sort function, sorts by timestamp (production date or node created)
 */ 
function custom_block_order_by_timestamp($a, $b) {
  //dpm($a);
  return $a['timestamp'] < $b['timestamp'];
}