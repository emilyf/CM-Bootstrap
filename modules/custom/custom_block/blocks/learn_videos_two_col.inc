<?php

/**
 *
 */
function custom_block_learn_videos_two_col_data() {
  $query = new EntityFieldQuery();
    $query->entityCondition('entity_type', 'node');
    $query->entityCondition('bundle', 'page');
    $query->propertyCondition('status', 1);
    $query->propertyOrderBy('created', 'DESC');
    //$query->propertyOrderBy('title', 'ASC');
    $query->range(0, 100);
    
    // Fields
    $query->fieldCondition('field_show_on_learn_landing_page', 'value', 1, '=');
  
  $result = $query->execute();
    
  $nids = $result['node'];
    
    if (!empty($nids)) {
      $nodes = node_load_multiple(array_keys($nids));        
      
      foreach($nodes as $node) {
        //dpm($node);
        //
        $items[$node->nid] = array( 
          custom_block_render_node_teaser($node),
        );
      }
    }
  
  return theme('learn_videos_two_col', 
    array(
      'items' => $items, 
    )
  ); 
}