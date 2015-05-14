<?php

/**
 *
 */
function _cb_partner_carousels_data() {
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
      
      $info = field_info_field('field_series_image');
      if (!empty($info) && $info['settings']['default_image'] > 0) {
        $default_img_fid  = $info['settings']['default_image'];
        $default_img_file = file_load($default_img_fid);
        
        //dpm($default_img_file);
      }
      
      // Build items array for use in TPL.
      $items[$node->nid] = array(
        'nid' => $node->nid,
        'title' => $node->title,  
        'video_node' => $cm_project_nodes,
        //'default_img' => $default_img_file->uri,
      );
    }
      
    //dpm($items);
    
    // Send $items array to TPL.  
    return theme('cb_partner_carousels', 
      array (
        'content' => $items,
      )
    );
  }
}
