<?php
  
function _cb_genres_carousels() {
  $query = new EntityFieldQuery();
    $query->entityCondition('entity_type', 'node');
    $query->entityCondition('bundle', 'genre');
    $query->propertyCondition('status', 1);
    $query->range(0, 25);
    $query->propertyOrderBy('title', 'ASC');
  $result = $query->execute();
  if (isset($result['node'])) {
    $nids = array_keys($result['node']);
    $nodes = entity_load('node', $nids);
    //
    foreach ($nodes as $node) { 
      $cm_show_query = new EntityFieldQuery();
        $cm_show_query->entityCondition('entity_type', 'node');
        $cm_show_query->entityCondition('bundle', 'cm_show');
        $cm_show_query->propertyCondition('status', 1);
        $cm_show_query->fieldCondition('field_genres', 'target_id', $node->nid, '=');
        $cm_show_query->range(0, 25);
        $cm_show_query->propertyOrderBy('created', 'DESC');
      $cm_show_result = $cm_show_query->execute();    
      if (isset($cm_show_result['node'])) {
        $cm_show_nids = array_keys($cm_show_result['node']);
        $cm_show_nodes = entity_load('node', $cm_show_nids);      
        // Build items array for use in TPL.
        $items[$node->nid] = array(
          'nid' => $node->nid,
          'title' => $node->title,  
          'show_nodes' => $cm_show_nodes,
        );
      }
    }  
    //dpm($items);
    // Send $items array to TPL.  
    return theme('cb_genres_carousels', 
      array (
        'content' => $items,
      )
    );
  }      
  //return 'cb_genres_carousels';
}