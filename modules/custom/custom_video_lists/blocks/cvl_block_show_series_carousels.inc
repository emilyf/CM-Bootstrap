<?php
  
function _custom_video_lists_block_series_carousels($nid) {
  $query = new EntityFieldQuery();
    $query->entityCondition('entity_type', 'node');
    $query->entityCondition('bundle', 'cm_show');
    $query->propertyCondition('status', 1);
    $query->range(0, 100);
    $query->propertyOrderBy('created', 'DESC');
    $query->fieldCondition('og_group_ref', 'target_id', $nid, '=');
  $result = $query->execute();
    
  if (isset($result['node'])) {
    $nids = array_keys($result['node']);
    $nodes = entity_load('node', $nids);
  
    foreach($nodes as $node) {
      //dpm($node);
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
      
      $allowable_tags = '';
      
      if (isset($node->field_description['und'][0]['value'])) {
        $field_description = strip_tags($node->field_description['und'][0]['value'], $allowable_tags);
      }
      else {
        $field_description = '';
      }
    
      $items[$node->nid] = array(
        'nid' => $node->nid,
        'title' => $node->title,
        'description' => custom_block_truncate($field_description, $length = 125, array('html' => true, 'ending' => ' . . .', 'exact' => FALSE)),  
        'img' => image_style_url('500x281', $image_uri),
        //'img' => image_style_url('500x281', file_build_uri($image_uri)),
      );
    }
    // Send $items array to TPL.  
    return theme('cvl_block_series_carousels', 
      array (
        'content' => $items,
      )
    );
    
  }
}