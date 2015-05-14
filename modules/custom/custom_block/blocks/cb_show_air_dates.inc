<?php
  
function _cb_show_air_dates() {
  if (arg(0) == 'node' && is_numeric(arg(1))) {
    $nid = arg(1);
    //
    $query = new EntityFieldQuery();
      $query->entityCondition('entity_type', 'airing');
      $query->fieldCondition('field_airing_show_ref', 'target_id', $nid, '=');
      $query->fieldOrderBy('field_airing_date', 'value', 'ASC');
      $query->range(0, 5);  
    $result = $query->execute();      
    if (isset($result['airing'])) {
      $aids = array_keys($result['airing']);
      $airings = entity_load('airing', $aids);
      foreach ($airings as $airing) { 
        $items[$airing->airing_id] = array(
          $airing,
        );
      }
      //dpm($items);
      // Send $items array to TPL.  
      return theme('cb_show_air_dates', 
        array (
          'content' => $items,
        )
      );
    }
  }
}
