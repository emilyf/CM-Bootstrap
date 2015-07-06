<?php
/**
 * @file
 * crp_cp administration functions.
 */

/**
 * Form constructor
 */
function site_cp_colors_form($form, &$form_state) {  
  // START: Global Colors
  $form['global_colors'] = array(
    '#type' => 'fieldset',
    '#title' => t('Global Colors'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#tree' => TRUE,
  );
  $form['global_colors']['page_title_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Page Title, H1 Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('page_title_color'),
  );
  $form['global_colors']['anchor_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Link/Anchor Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('anchor_color'),
  );
  $form['global_colors']['anchor_hover_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Link/Anchor Hover Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('anchor_hover_color'),
  );
  $form['global_colors']['h2_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('H2 Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('h2_color'),
  );
  $form['global_colors']['h3_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('H3 Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('h3_color'),
  );
  $form['global_colors']['h4_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('H4 Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('h4_color'),
  );
  $form['global_colors']['right_sidebar_title_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Right Sidebar Block Title Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('right_sidebar_title_color'),
  );
  $form['global_colors']['right_sidebar_bg_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Right Sidebar Background Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('right_sidebar_bg_color'),
  );
  $form['global_colors']['right_sidebar_text_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Right Sidebar Text Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('right_sidebar_text_color'),
  );
  $form['global_colors']['right_sidebar_link_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Right Sidebar Link Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('right_sidebar_link_color'),
  );
  // END: Global Colors  
  // START: Primary Colors
  $form['primary_colors'] = array(
    '#type' => 'fieldset',
    '#title' => t('Primary Colors'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#tree' => TRUE,
  );
  $form['primary_colors']['primary1_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Primary Color 1'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('primary1_color'),
  );
  $form['primary_colors']['primary2_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Primary Color 2'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('primary2_color'),
  );
  $form['primary_colors']['primary3_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Primary Color 3'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('primary3_color'),
  );
  $form['primary_colors']['primary4_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Primary Color 4'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('primary4_color'),
  );
  // END: Primary Colors
  
  // START: Navigation Colors
  $form['nav_colors'] = array(
    '#type' => 'fieldset',
    '#title' => t('Navigation Colors'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#tree' => TRUE,
  );
  $form['nav_colors']['nav_site_name_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Navigation Site Name Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('nav_site_name_color'),
  );
  $form['nav_colors']['nav_bg_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Navigation Background Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('nav_bg_color'),
  );
  $form['nav_colors']['nav_link_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Navigation Link Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('nav_link_color'),
  );
  // END: Navigation Colors
  
  // START: Jumbotron Colors
  $form['jumbotron_colors'] = array(
    '#type' => 'fieldset',
    '#title' => t('Jumbotron Colors'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#tree' => TRUE,
  );
  $form['jumbotron_colors']['jumbotron_overlay_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Jumbotron Overlay Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('jumbotron_overlay_color'),
  );
  $form['jumbotron_colors']['jumbotron_arrow_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Jumbotron Arrow Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('jumbotron_arrow_color'),
  );
  $form['jumbotron_colors']['jumbotron_arrow_bg_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Jumbotron Arrow Background Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('jumbotron_arrow_bg_color'),
  );
  $form['jumbotron_colors']['jumbotron_arrow_hover_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Jumbotron Arrow Hover Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('jumbotron_arrow_hover_color'),
  );
  // END: Jumbotron Colors
  
  // START: jPanel Colors
  $form['jpanel_colors'] = array(
    '#type' => 'fieldset',
    '#title' => t('jPanel Colors'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    // Need to add this?
    '#tree' => TRUE,
  );
  $form['jpanel_colors']['jpanel_menu_trigger_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Menu Trigger'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('jpanel_menu_trigger_color'),
  );
  $form['jpanel_colors']['jpanel_bg_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('jPanel Background Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('jpanel_bg_color'),
  );
  $form['jpanel_colors']['jpanel_parent_item_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('jPanel Parent Item Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('jpanel_parent_item_color'),
  );
  $form['jpanel_colors']['jpanel_child_item_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('jPanel Child Item Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('jpanel_child_item_color'),
  );
  $form['jpanel_colors']['jpanel_close_hover_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('jPanel Close Hover Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('jpanel_close_hover_color'),
  );
  // END: jPanel Colors
  
  // START: Video Grid Colors
  $form['vg_colors'] = array(
    '#type' => 'fieldset',
    '#title' => t('Video Grid Colors'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    // Need to add this?
    '#tree' => TRUE,
  );
  $form['vg_colors']['vg_background_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Video Grid Background Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('vg_background_color'),
  );
  $form['vg_colors']['vg_title_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Video Grid Title Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('vg_title_color'),
  );
  $form['vg_colors']['vg_description_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Video Grid Description Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('vg_description_color'),
  );
  // END: Video Grid Colors
  
  // START: Video Slider Colors
  $form['vs_colors'] = array(
    '#type' => 'fieldset',
    '#title' => t('Video Slider Colors'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    // Need to add this?
    '#tree' => TRUE,
  );
  $form['vs_colors']['vs_heading_bg_color_1'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Video Slider Heading Background Color 1'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('vs_heading_bg_color_1'),
  );
  $form['vs_colors']['vs_heading_bg_color_2'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Video Slider Heading Background Color 2'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('vs_heading_bg_color_2'),
  );
  $form['vs_colors']['vs_heading_bg_color_3'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Video Slider Heading Background Color 3'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('vs_heading_bg_color_3'),
  );
  $form['vs_colors']['vs_heading_bg_color_4'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Video Slider Heading Background Color 4'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('vs_heading_bg_color_4'),
  );
  $form['vs_colors']['vs_heading_text_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Video Slider Heading Text Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('vs_heading_text_color'),
  );
  $form['vs_colors']['vs_overlay_color_1'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Video Slider Tile Overlay Color 1'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('vs_overlay_color_1'),
  );
  $form['vs_colors']['vs_overlay_color_2'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Video Slider Tile Overlay Color 2'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('vs_overlay_color_2'),
  );
  $form['vs_colors']['vs_overlay_color_3'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Video Slider Tile Overlay Color 3'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('vs_overlay_color_3'),
  );
  $form['vs_colors']['vs_overlay_color_4'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Video Slider Tile Overlay Color 4'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('vs_overlay_color_4'),
  );
  $form['vs_colors']['vs_arrow_bg_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Video Slider Arrow Background Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('vs_arrow_bg_color'),
  );
  $form['vs_colors']['vs_arrow_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Video Slider Arrow Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('vs_arrow_color'),
  );
  $form['vs_colors']['vs_arrow_bg_hover_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Video Slider Arrow Background Hover Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('vs_arrow_bg_hover_color'),
  );
  // END: Video Slider Colors
  
  // START: Archive Pg Colors
  $form['archive_colors'] = array(
    '#type' => 'fieldset',
    '#title' => t('Archive Pg Colors'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#tree' => TRUE,
  );
  $form['archive_colors']['archive_color_1'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Archive Color 1'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('archive_color_1'),
  );
  $form['archive_colors']['archive_color_2'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Archive Color 2'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('archive_color_2'),
  );
  $form['archive_colors']['archive_color_3'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Archive Color 3'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('archive_color_3'),
  );
  $form['archive_colors']['archive_color_4'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Archive Color 4'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('archive_color_4'),
  );
  // END: Archive Pg Colors
  
  // START: Show Colors
  $form['show'] = array(
    '#type' => 'fieldset',
    '#title' => t('Show Colors'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#tree' => TRUE,
  );
  $form['show']['sidebar_link_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Sidebar Link Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('sidebar_link_color'),
  );
  $form['show']['sidebar_link_hover_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Sidebar Link Hover Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('sidebar_link_hover_color'),
  );
  $form['show']['sidebar_field_label_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Sidebar Field Label Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('sidebar_field_label_color'),
  );
  $form['show']['recent_video_text_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Recent Videos: Text Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('recent_video_text_color'),
  );
  $form['show']['recent_video_bg_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Recent Videos: Background Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('recent_video_bg_color'),
  );
  $form['show']['recent_video_bg_hover_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Recent Videos: Background Hover Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('recent_video_bg_hover_color'),
  );
  // END: Show Colors
  
  // START: Footer Colors
  $form['footer'] = array(
    '#type' => 'fieldset',
    '#title' => t('Footer Colors'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#tree' => TRUE,
  );
  $form['footer']['footer_bg_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Footer Background Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('footer_bg_color'),
  );
  $form['footer']['footer_link_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Footer Link Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('footer_link_color'),
  );
  $form['footer']['footer_bottom_bg_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Footer Bottom Background Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('footer_bottom_bg_color'),
  );
  $form['footer']['footer_accent_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Footer Accent Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('footer_accent_color'),
  );
  // END: Footer Colors
  
  // START: cm_admin Colors
  $form['cm_admin'] = array(
    '#type' => 'fieldset',
    '#title' => t('CM_ADMIN Colors'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#tree' => TRUE,
  );
  $form['cm_admin']['cm_admin_form_color_1'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('cm_admin Form Color 1'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('cm_admin_form_color_1'),
  );
  $form['cm_admin']['cm_admin_form_color_2'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('cm_admin Form Color 2'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('cm_admin_form_color_2'),
  );
  $form['cm_admin']['cm_admin_form_color_3'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('cm_admin Form Color 3'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('cm_admin_form_color_3'),
  );
  $form['cm_admin']['cm_admin_text_tab_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('cm_admin text tab color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('cm_admin_text_tab_color'),
  );
  $form['cm_admin']['cm_admin_button_bg_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('cm_admin: button background color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('cm_admin_button_bg_color'),
  );
  $form['cm_admin']['cm_admin_button_bg_hover_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('cm_admin: button background hover color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('cm_admin_button_bg_hover_color'),
  );
  $form['cm_admin']['cm_admin_button_text_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('cm_admin: button text color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('cm_admin_button_text_color'),
  );
  // END: cm_admin Colors
  
  // START: Community Features Colors
  $form['cm_features'] = array(
    '#type' => 'fieldset',
    '#title' => t('Community Features Colors'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#tree' => TRUE,
  );
  $form['cm_features']['cm_features_tile_bg_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Tile Background Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('cm_features_tile_bg_color'),
  );
  $form['cm_features']['cm_features_tile_bg_hover_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Tile Hover Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('cm_features_tile_bg_hover_color'),
  );
  $form['cm_features']['cm_features_button_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Button Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('cm_features_button_color'),
  );
  $form['cm_features']['cm_features_button_hover_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Button Hover Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('cm_features_button_hover_color'),
  );
  $form['cm_features']['cm_features_text_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Text/Link Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('cm_features_text_color'),
  );
  $form['cm_features']['cm_features_text_hover_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Text/Link Hover Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('cm_features_text_hover_color'),
  );
  $form['cm_features']['cm_features_menu_bg_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Menu Background Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('cm_features_menu_bg_color'),
  );
  $form['cm_features']['cm_features_menu_item_bg_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Menu Item Background Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('cm_features_menu_item_bg_color'),
  );
  $form['cm_features']['cm_features_menu_item_text_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Menu Item Text Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('cm_features_menu_item_text_color'),
  );
  $form['cm_features']['cm_features_menu_item_active_bg_color'] = array(
    '#type' => 'spectrum_field',
    '#title' => t('Menu Item Active Background Color'),
    '#size' => 90,
    '#default_value' => site_cp_colors_form_default_value('cm_features_menu_item_active_bg_color'),
  );
  // END: Community Features Colors
      
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => 'Submit',
  );
  
  $form['#attached']['js'] = array(
    drupal_get_path('module', 'site_cp') . '/js/site_cp.js',
  );
  
  //dpm($form);
  
  return $form;
  //return system_settings_form($form);
}

/**
 * Form validation
 */
function site_cp_colors_form_validate($form, &$form_state) {
}

/**
 * Form submit
 */
function site_cp_colors_form_submit($form, &$form_state) {  
  //dpm($form_state);
  
  foreach($form_state['values'] as $key => $value) {
    // Check if array has depth.
    if (count($value) > 1) {      
      foreach($value as $item_key => $item_value) {
        $data_array[$key][$item_key] = $item_value;
          
        $data = array(
          'name' => $item_key,
          'value' => $item_value['spectrum_field'],
        );                
        // Check if the record exists, to determine if it's a new record or an update.
        $update_record = db_query('SELECT name FROM {site_cp_colors} WHERE name = :name', 
          array(
            ':name' => $data['name'],
          ))->fetchField();
        // Update record.
        if ($update_record) {
          drupal_write_record('site_cp_colors', $data, array('name'));
        } 
        // Create new record.
        else {
          drupal_write_record('site_cp_colors', $data);
        }
      }
    }
  }
}

/**
 * Helper function to get default values for form.
 */
function site_cp_colors_form_default_value($name) {  
  $default_value = db_query('SELECT value FROM {site_cp_colors} WHERE name = :name', 
    array(
      ':name' => $name,
    ))->fetchField();
    
  return $default_value;
}

