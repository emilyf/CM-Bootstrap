<?php
  
function _cb_pd_p_all_series() {
  // Get current nid
  if (arg(0) == 'node' && is_numeric(arg(1))) {
    $nid = arg(1);
    $query = new EntityFieldQuery();
      $query->entityCondition('entity_type', 'node');
      $query->entityCondition('bundle', 'cm_project');
      $query->propertyCondition('status', 1);
      $query->fieldCondition('field_partner', 'target_id', $nid, '=');
      $query->propertyOrderBy('created', 'DESC');
      $result = $query->execute();    
      if (isset($result['node'])) {
        $nids = array_keys($result['node']);
        $nodes = entity_load('node', $nids);        
        //dpm($nodes);
        foreach ($nodes as $node) {
          // Series img
          // Get image from field_series_image                
          if (isset($node->field_series_image['und'])) {
            $image_uri = $node->field_series_image['und'][0]['uri'];
          }
          // Else, no image, use default image.
          else {
            $info = field_info_field('field_series_image');
            if (!empty($info) && $info['settings']['default_image'] > 0) {
              $default_img_fid  = $info['settings']['default_image'];
              $default_img_file = file_load($default_img_fid);
              $image_uri = $default_img_file->uri;
            }
          }          
          // Build items array for use in TPL.
          $items[$node->nid] = array(
            'nid' => $node->nid,
            'title' => $node->title,  
            'series_img' => image_style_url('500x281', $image_uri),
          );
        }
        //dpm($items);
        // Send $items array to TPL.  
        return theme('cb_pd_p_all_series', 
          array (
            'content' => $items,
          )
        );
      }
  }  
  
  
  
  
  //return '_cb_pd_p_all_series';
}