<?php

function _cb_show_node_meta() {
  if (arg(0) == 'node' && is_numeric(arg(1))) {
    $node = node_load(arg(1));    
    //dpm($node);
    //unset($node->field_show_vod);
    $nodeView = node_view($node, 'cm_show_meta'); 
    return drupal_render($nodeView); 
  }
  
  //return '_cb_show_node_meta';
}