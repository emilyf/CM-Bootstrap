<?php
  
function _cb_partners_list_view() {
  $query = new EntityFieldQuery();
    $query->entityCondition('entity_type', 'node');
    $query->entityCondition('bundle', 'partner');
    $query->propertyCondition('status', 1);
    $query->range(0, 25);
    $query->propertyOrderBy('title', 'ASC');
    //->addTag('byWeightBlock');
  
  $result = $query->execute();
    
  if (isset($result['node'])) {
    $nids = array_keys($result['node']);
    $nodes = entity_load('node', $nids);
    
    foreach ($nodes as $node) {    
      // Build $items data array.
      $items[$node->nid] = array(
        'nid' => $node->nid,
        'title' => $node->title,  
        'img' => image_style_url('500x281', $node->field_partner_logo_large['und'][0]['uri']),
      );    
    }  
  }
  
  //dpm($items);
  
  return theme('cb_partners_list', 
    array (
      'content' => $items,
    )
  );
  
  //return 'test!';
}  