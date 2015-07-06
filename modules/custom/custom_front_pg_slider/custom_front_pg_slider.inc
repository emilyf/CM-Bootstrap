<?php
/**
 * @file
 * Custom data queries.
 *
 */

function _front_pg_slider_data() {
  $query = new EntityFieldQuery();
    $query->entityCondition('entity_type', 'node')
    ->entityCondition('bundle', 'slider')
    ->propertyCondition('status', 1)
    ->propertyCondition('promote', 1)
    ->range(0, 4);  
  $result = $query->execute();
    
  if (isset($result['node'])) {
    $nids = array_keys($result['node']);
    $nodes = entity_load('node', $nids);
    foreach ($nodes as $node) {    
      //dpm($node);    
      if (isset($node->field_slider_reference['und']) && !isset($node->field_slider_link['und'])) {
        $url = url('node/' . $node->field_slider_reference['und'][0]['target_id']);
      }
      elseif (isset($node->field_slider_link['und'])) {
        $url = $node->field_slider_link['und'][0]['url'];
      }  
      else {
        $url = url('node/' . $node->nid);
      }          
      $items[$node->nid] = array(
        'nid' => $node->nid,
        'title' => $node->title,
        'img' => image_style_url('front_pg_slider_1440_x_720', $node->field_slideshow_image['und'][0]['uri']),
        'url' => $url,
      );
    }
    // Send to TPL  
    return theme('front_pg_slider', 
      array (
        'content' => $items,
      )
    );
  }
}
