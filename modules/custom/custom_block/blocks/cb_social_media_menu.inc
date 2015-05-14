<?php

function _cb_social_media_menu() {
  $result = db_query('SELECT link_title, link_path, mlid, weight, options FROM {menu_links} WHERE menu_name = :menu_name AND hidden = :hidden ORDER BY weight ASC;', array(
    ':menu_name' => 'menu-social-media',
    ':hidden' => 0,
  ))->fetchAll();
  if (isset($result)) {
    foreach ($result as $menu_item) {        
      $items[$menu_item->mlid] = array(
        'title' => $menu_item->link_title,
        'href' => $menu_item->link_path,
        'options' => unserialize($menu_item->options),
        //'attributes' => array('class' => array('class_name'), 'title' => title_name),
      );
    }      
    // Send to TPL
    return theme('cb_social_media_menu', 
      array (
        'content' => $items,
      )
    );    
  }
}

function _cb_social_media_menu_2() {
  $result = db_query('SELECT link_title, link_path, mlid, weight, options FROM {menu_links} WHERE menu_name = :menu_name AND hidden = :hidden ORDER BY weight ASC;', array(
    ':menu_name' => 'menu-social-media',
    ':hidden' => 0,
  ))->fetchAll();
  if (isset($result)) {
    foreach ($result as $menu_item) {        
      $items[$menu_item->mlid] = array(
        'title' => $menu_item->link_title,
        'href' => $menu_item->link_path,
        'options' => unserialize($menu_item->options),
        //'attributes' => array('class' => array('class_name'), 'title' => title_name),
      );
    }      
    // Send to TPL
    return theme('cb_social_media_menu', 
      array (
        'content' => $items,
      )
    );    
  }
}