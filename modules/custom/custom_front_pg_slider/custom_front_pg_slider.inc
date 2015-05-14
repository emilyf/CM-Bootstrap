<?php
/**
 * @file
 * Custom data queries.
 *
 */

/**
 *
 */
function _front_pg_slider_data() {
  $query = new EntityFieldQuery();
    $query->entityCondition('entity_type', 'node')
    ->entityCondition('bundle', 'slider')
    ->propertyCondition('status', 1)
    ->propertyCondition('promote', 1)
    ->range(0, 4);
    //->propertyOrderBy('title', 'ASC')
    //->addTag('byWeightBlock');
  
  $result = $query->execute();
    
  if (isset($result['node'])) {
    $nids = array_keys($result['node']);
    $nodes = entity_load('node', $nids);
    
    foreach ($nodes as $node) {            
      $items[$node->nid] = array(
        'nid' => $node->nid,
        'title' => $node->title,
        'img' => image_style_url('front_pg_slider_1440_x_720', $node->field_slideshow_image['und'][0]['uri']),
        //'bg-color' => $node->field_background_color['und'][0]['value'],
        //'text-color' => $node->field_text_color['und'][0]['value'],
        //'accent-color' => $node->field_accent_color['und'][0]['value'],
      );
    }
    // Theme  
    return theme('front_pg_slider', 
      array (
        'content' => $items,
      )
    );
  }
}
