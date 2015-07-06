<?php
/**
 * Data
 */
function _front_pg_featured_videos_carousel_data() {
  $query = new EntityFieldQuery();
    $query->entityCondition('entity_type', 'node')
    ->entityCondition('bundle', 'cm_show')
    ->propertyCondition('status', 1)
    ->propertyCondition('promote', 1)
    ->range(0, 25);  
  $result = $query->execute();
  if (isset($result['node'])) {
    $nids = array_keys($result['node']);
    $nodes = entity_load('node', $nids);
    foreach ($nodes as $node) { 
      //dpm($node);
      if (isset($node->field_show_vod['und'])) {
        switch($node->field_show_vod['und'][0]['filemime']) {
          case 'video/cloudcast':
            $field_cm_show_video_img_uri = 'media-cloudcast/' . $node->field_show_vod['und'][0]['filename']  . '.jpg';
            //dpm($field_cm_show_video_img_uri);
            $cm_show_image = image_style_url('500x281', $field_cm_show_video_img_uri);
            break;
          case 'video/vimeo':
            $field_cm_show_video_img_uri = str_replace('vimeo://v/', 'media-vimeo/', $node->field_show_vod['und'][0]['uri']) . '.jpg';
            $cm_show_image = image_style_url('500x281', $field_cm_show_video_img_uri);
            break;
          case 'video/youtube':
            $field_cm_show_video_img_uri = str_replace('youtube://v/', 'media-youtube/', $node->field_show_vod['und'][0]['uri']) . '.jpg';
            $cm_show_image = image_style_url('500x281', $field_cm_show_video_img_uri);
            break;
        }
      }
      else {
        $cm_show_image = $GLOBALS['base_url'] . '/' . path_to_theme() . '/images/500x281-placeholder.gif';
      }
      // field_description
      //$allowable_tags = '<i><a>';
      //$field_description = strip_tags($node->field_description['und'][0]['value'], $allowable_tags);
      if (isset($node->og_group_ref['und'][0]['target_id'])) {
        $nid = $node->og_group_ref['und'][0]['target_id'];
        $series_title = db_query("SELECT title FROM {node} WHERE nid = :nid", array(':nid' => $nid))->fetchField();
      }
      else {
        $series_title = '';
      }
      // Build data array.     
      $items[$node->nid] = array(
        'nid' => $node->nid,
        'title' => $node->title,      
        //'description' => custom_block_truncate($field_description, $length = 125, array('html' => true, 'ending' => ' . . .', 'exact' => FALSE)),
        'img' => $cm_show_image,
        'series_title' => $series_title,
      );
    }
    // Send to theme layer.
    return theme('front_pg_fv_carousel', 
      array (
        'content' => $items,
      )
    );
  }
}
