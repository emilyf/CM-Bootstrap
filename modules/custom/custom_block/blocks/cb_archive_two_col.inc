<?php

/**
 *
 */
function _cb_archive_two_col() {
  // Check if current pg is 'archive_content_type'.
  if (arg(0) == 'node' && is_numeric(arg(1))) {
    $node = node_load(arg(1));    
    //dpm($node);
    
    // Content Type: 'archive_content_type' 
    if ($node->type == 'archive_content_type') {
      $content_type = $node->field_archive_content_type['und'][0]['value'];
      
      switch ($content_type) {
        case 'blog':
          $nids = _cb_archive_two_col_query($content_type);
          if (!empty($nids)) {
            //dpm(count($nids));
            $nodes = node_load_multiple(array_keys($nids));        
            //dpm($nodes);
            foreach($nodes as $node) {
              // Image
              if (isset($node->field_blog_image['und'])) {
                $img_src = $img_src = image_style_url('500x281', $node->field_blog_image['und'][0]['uri']);
              }
              else {
                $info = field_info_field('field_blog_image');
                if (!empty($info) && $info['settings']['default_image'] > 0) {
                  $default_img_fid  = $info['settings']['default_image'];
                  $default_img_file = file_load($default_img_fid);
                  
                  //dpm($default_img_file);
                }
                $img_src = image_style_url('500x281', $default_img_file->uri);
              }
              // Description/Body
              if (isset($node->body['und'][0]['summary'])) {
                $allowable_tags = '<img><p><strong><em><ol><ul><li><u><a>';
                $description = strip_tags($node->body['und'][0]['summary'], $allowable_tags);
                //$description = custom_block_truncate($description, $length = 125, array('html' => true, 'ending' => ' . . .', 'exact' => FALSE));
              }
              else {
                $description = '';
              }
              /*else {
                if (isset($node->body['und'][0]['value'])) {
                  $description = $node->body['und'][0]['value'];
                  //$description = custom_block_truncate($description, $length = 125, array('html' => true, 'ending' => ' . . .', 'exact' => FALSE));
                }
                else {
                  $description = '';
                }
              }*/
              // Build $items array.
              $items[$node->nid] = array( 
                'nid' => $node->nid,
                'type' => $node->type,
                'datetime' => date('F t, Y | h:i', $node->created),
                'title' => $node->title,
                //'description' => custom_block_truncate($description, $length = 125, array('html' => true, 'ending' => ' . . .', 'exact' => FALSE)),
                'description' => $description,
                'img' => $img_src,
              );   
            }
          }       
          break;        
        case 'cm_show':
          $nids = _cb_archive_two_col_query($content_type);
          //dpm($nids);   
          if (!empty($nids)) {
            $nodes = node_load_multiple(array_keys($nids));        
            //dpm($nodes);
            foreach($nodes as $node) {
              // Image
              if (isset($node->field_show_vod['und'])) {        
                //dpm($node);
                switch($node->field_show_vod['und'][0]['filemime']) {
                  case 'video/cloudcast':
                    $image_uri = 'media-cloudcast/' . $node->field_show_vod['und'][0]['filename']  . '.jpg';
                    break;
                  case 'video/vimeo':
                    $image_uri = str_replace('vimeo://v/', 'media-vimeo/', $node->field_show_vod['und'][0]['uri']);
                    $image_uri = $image_uri . '.jpg';
                    break;
                  case 'video/youtube':  
                    $image_uri = str_replace('youtube://v/', 'media-youtube/', $node->field_show_vod['und'][0]['uri']);
                    $image_uri = $image_uri . '.jpg';
                    break;
                }
                //dpm($image_uri);
                $img_src = image_style_url('500x281', file_build_uri($image_uri));
                //dpm($img_src);
                
                //dpm($img_url);
                //$img_src = image_style_url('500x281', $image_uri);
              }
              else {
                $img_src = $GLOBALS['base_url'] . '/' . path_to_theme() . '/images/500x281-placeholder.gif';
              }
              // Description/Body
              if (isset($node->field_description['und'][0]['value'])) {
                $description = $node->field_description['und'][0]['value'];
              }
              else {
                $description = '';
              }              
              // Only build $item array for node if img is present.
              //if (!empty($img_src)) {
                // Build $items array.
                $items[$node->nid] = array( 
                  'nid' => $node->nid,
                  'type' => $node->type,
                  'title' => $node->title,
                  'description' => custom_block_truncate($description, $length = 125, array('html' => true, 'ending' => ' . . .', 'exact' => FALSE)),
                  'img' => $img_src,
                );
              //}
            }
          }
          //dpm($nodes);
          break;
      }  
    }
    
    // Content Type: 'archive_node_ref' 
    if ($node->type == 'archive_node_ref') {
      //dpm('archive_node_ref!');  
      //dpm($node);
      
      foreach($node->field_archive_node_ref['und'] as $nid) {
        $nids[$nid['target_id']] = $nid['target_id'];
        if (!empty($nids)) {
          //dpm(count($nids));
          $nodes = node_load_multiple(array_keys($nids));        
          //dpm($nodes);
          foreach($nodes as $node) {
            // Image
            if (isset($node->field_main_image['und'])) {
              $img_src = $img_src = image_style_url('500x281', $node->field_main_image['und'][0]['uri']);
            }
            else {
              $info = field_info_field('field_main_image');
              if (!empty($info) && $info['settings']['default_image'] > 0) {
                $default_img_fid  = $info['settings']['default_image'];
                $default_img_file = file_load($default_img_fid);
                
                //dpm($default_img_file);
              }
              $img_src = image_style_url('500x281', $default_img_file->uri);
            }
            // Description/Body
            if (isset($node->field_teaser['und'][0]['value'])) {              
              $allowable_tags = '<img><p><strong><em><ol><ul><li><u><a>';
              $description = strip_tags($node->field_teaser['und'][0]['value'], $allowable_tags);
            }
            else {
              $description = '';
            }
            // Build $items array.
            $items[$node->nid] = array( 
              'nid' => $node->nid,
              'type' => $node->type,
              'title' => $node->title,
              //'description' => custom_block_truncate($description, $length = 125, array('html' => true, 'ending' => ' . . .', 'exact' => FALSE)),
              'description' => $description,
              'img' => $img_src,
            );
          }
        }        
      }  
    }    
    // Pager
    // element = 1 must match this in query:
    // $query->pager(10, 1);
    $pager = theme('pager', 
      array(
       'element' => 1,
      )
    );
    
    // Send to TPL.
    return theme('cb_archive_two_col', 
      array(
        'items' => $items, 
        'pager' => $pager,
      )
    ); 
  }
}

/**
 * Query helper function.
 */
function _cb_archive_two_col_query($content_type) {
  $query = new EntityFieldQuery();
    $query->entityCondition('entity_type', 'node');
    $query->entityCondition('bundle', $content_type);
    $query->propertyCondition('status', 1);
    $query->propertyOrderBy('created', 'DESC');
    //$query->propertyOrderBy('title', 'ASC');
 
    // Add Pager
    $query->pager(10, 1);
    $result = $query->execute();
      
    $nids = $result['node'];
    
    return $nids;
}