<?php
/**
 * @file
 * site_wrapper.inc
 *
 */

/**
 * Gets data for Main Menu
 */
function _site_wrapper_main_menu_data_query() {
  $result = db_query('SELECT link_title, link_path, mlid, depth, plid, weight FROM {menu_links} WHERE plid = :plid AND menu_name = :menu_name AND hidden = :hidden ORDER BY weight ASC;', array(
      ':menu_name' => 'main-menu',
      ':plid' => 0,
      ':hidden' => 0,
    ))->fetchAll();
  
  foreach($result as $menu_item) {
    
    $result_second_level = db_query('SELECT link_title, link_path, mlid, depth, plid, weight FROM {menu_links} WHERE plid = :plid AND menu_name = :menu_name AND hidden = :hidden ORDER BY weight ASC;', array(
      ':menu_name' => 'main-menu',
      ':plid' => $menu_item->mlid,
      ':hidden' => 0,
    ))->fetchAll();
    
    foreach($result_second_level as $second_level_menu_item) {
      
      $result_third_level = db_query('SELECT link_title, link_path, mlid, depth, plid, weight FROM {menu_links} WHERE plid = :plid AND menu_name = :menu_name AND hidden = :hidden AND depth = :depth ORDER BY weight ASC;', array(
      ':menu_name' => 'main-menu',
      ':plid' => $second_level_menu_item->mlid,
      ':hidden' => 0,
      ':depth' => 3,
    ))->fetchAll();
      
      foreach($result_third_level as $third_level_menu_item) {
        
        $third_level[$third_level_menu_item->plid][$third_level_menu_item->mlid] = array(
          'title' => $third_level_menu_item->link_title,
          'path' => $third_level_menu_item->link_path,
          'depth' => $third_level_menu_item->depth,
          'plid' => $third_level_menu_item->plid,
        );
      }
      
      //dpm($third_level);
      
      
    
      $second_level[$second_level_menu_item->plid][$second_level_menu_item->mlid] = array(
        'title' => $second_level_menu_item->link_title,
        'path' => $second_level_menu_item->link_path,
        'depth' => $second_level_menu_item->depth,
        'plid' => $second_level_menu_item->plid,
        'children' => $third_level[$third_level_menu_item->plid],
      );
      
      //array_filter($second_level['children']);
    }
    
    //dpm($second_level);
    
    $first_level[$menu_item->mlid] = array(
      'title' => $menu_item->link_title,
      'path' => $menu_item->link_path,
      'depth' => $menu_item->depth,
      'plid' => $menu_item->plid,
      'children' => $second_level[$second_level_menu_item->plid], 
    );
  }
  
  //dpm($second_level);
  
  //dpm($level_3);
  
  //dpm($first_level);
  
  //send data to TPL
  return theme(
    'site_wrapper_main_menu', array(
      'content' => $first_level,
    )
  );  
}


/**
 * Gets data for Main Menu
 */
function _site_wrapper_main_menu_data_query_2() {
  $result = db_query('SELECT link_title, link_path, mlid, depth, plid, weight FROM {menu_links} WHERE plid = :plid AND menu_name = :menu_name AND hidden = :hidden ORDER BY weight ASC;', array(
      ':menu_name' => 'main-menu',
      ':plid' => 0,
      ':hidden' => 0,
    ))->fetchAll();
  
  foreach($result as $menu_item) {
    $children = db_query('SELECT link_title, link_path, mlid, depth, plid, weight FROM {menu_links} WHERE plid = :plid AND menu_name = :menu_name AND hidden = :hidden ORDER BY weight ASC;', array(
      ':menu_name' => 'main-menu',
      ':plid' => $menu_item->mlid,
      ':hidden' => 0,
    ))->fetchAll();
    
    foreach($children as $item) {
      $level_3_result = db_query('SELECT link_title, link_path, mlid, depth, plid, weight FROM {menu_links} WHERE plid = :plid AND menu_name = :menu_name AND hidden = :hidden ORDER BY weight ASC;', array(
      ':menu_name' => 'main-menu',
      ':plid' => $item->mlid,
      ':hidden' => 0,
    ))->fetchAllKeyed('mlid');
                
      dpm($level_3_result);
    
      $content[$menu_item->mlid] = array(
        'title' => $menu_item->link_title,
        'path' => $menu_item->link_path,
        'depth' => $menu_item->depth,
        'plid' => $menu_item->plid,
        'children' => $children,      
      );
    }
  }
  
  //dpm($level_3);
  
  dpm($content);
  
  //send data to TPL
  return theme(
    'site_wrapper_main_menu', array(
      'content' => $content,
    )
  );  
}
