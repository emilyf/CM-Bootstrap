<?php
  
function _cb_video_grid() {
  // Make sure we're on a node pg.
  if (arg(0) == 'node' && is_numeric(arg(1))) {
    $node = node_load(arg(1));
    if (isset($node->field_video_grid['und'])) {
      // Build array of video grid target IDs
      foreach($node->field_video_grid['und'] as $video_grid_item) {
        $video_grid_target_ids[] = $video_grid_item['target_id'];
      }
      $vg_nodes = entity_load('node', $video_grid_target_ids);
      foreach($vg_nodes as $vg_node) {
        //dpm($vg_node);
        $shows = array();
        foreach($vg_node->field_column_1_shows['und'] as $show) {
          $shows[] = node_load($show['target_id']);
        }
        $items[$vg_node->nid] = array(
          'title' => $vg_node->title,
          'description' => $vg_node->field_column_1_description['und'][0]['value'],
          'shows' => $shows,
        ); 
      }
      //dpm($items);
      // Send to TPL  
      return theme('cb_video_grid', 
        array (
          'content' => $items,
        )
      );
    }
  }
  //return '_cb_video_grid';
}

/*function cb_video_grid_get_video_grids($video_grid_target_id) {
  $query = new EntityFieldQuery();
    $query->entityCondition('entity_type', 'node');
    $query->entityCondition('bundle', 'video_grid');
    $query->propertyCondition('status', 1);
    $query->propertyCondition('nid', $video_grid_target_id);
    $query->range(0, 4);
    $query->propertyOrderBy('created', 'ASC');
  $result = $query->execute();
  return $result;
}*/