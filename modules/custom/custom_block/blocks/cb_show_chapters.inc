<?php
  
function _cb_show_chapters() {
  if (arg(0) == 'node' && is_numeric(arg(1))) {
    $node = node_load(arg(1)); 
    //dpm($node); 
    if (isset($node->field_show_vod['und'])) {
      $field_show_vod_fid = $node->field_show_vod['und'][0]['fid'];
      // Get chapters data
      $result = db_query("SELECT * FROM {field_data_video_chapters} WHERE entity_id = :entity_id", array(':entity_id' => $field_show_vod_fid))->fetchAll();
      foreach($result as $item) {
        $items[] = $item;
      }
    }
    if (isset($items)) {
      // Send $items array to TPL.  
      return theme('cb_show_chapters', 
        array (
          'content' => $items,
        )
      );
    }
  }
}
