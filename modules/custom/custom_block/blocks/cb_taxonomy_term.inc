<?php

function _cb_taxonomy_term() {
  $query = new CmShowEntityFieldQuery();
  $query->fieldCondition('field_tags', 'tid', arg(2), '=')
    ->pager(10);
  $result = $query->execute();      
  if (isset($result['node'])) {
    $nids = array_keys($result['node']);
    $nodes = entity_load('node', $nids);
    foreach ($nodes as $node) { 
      // Get show images, accounting for variations.
      if (isset($node->field_show_vod['und'])) {        
        switch($node->field_show_vod['und'][0]['filemime']) {
          // Cloudcast
          case 'video/cloudcast':
            $image_uri = 'media-cloudcast/' . $node->field_show_vod['und'][0]['filename']  . '.jpg';								
            break;
          // Vimeo
          case 'video/vimeo':
            $image_uri = str_replace('vimeo://v/', 'media-vimeo/', $node->field_show_vod['und'][0]['uri']);
            $image_uri = $image_uri . '.jpg';
            break;
          // Youtube
          case 'video/youtube':  
            $image_uri = str_replace('youtube://v/', 'media-youtube/', $node->field_show_vod['und'][0]['uri']);
            $image_uri = $image_uri . '.jpg';
            break;
        }
        $img_src = image_style_url('250x150', $image_uri);
      }
      else {
        $img_src = '';
      }
      // Description
      if (isset($node->field_description['und'][0]['value'])) {
        $show_description = $node->field_description['und'][0]['value'];
      }
      else {
        $show_description = '';
      }
      // Get series title
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
        'img_src' => $img_src,
        'show_description' => $show_description,
        'series_title' => $series_title,
      );
    }
    // Send data to TPL.  
    return theme('cb_taxonomy_term', 
      array (
        'content' => $items,
        'pager' => array('#theme' => 'pager'),
      )
    );
  }   
}