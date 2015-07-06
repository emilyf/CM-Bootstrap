<?php
/**
 * @file
 * crp_cp administration functions.
 */

/**
 * Form constructor
 */
function site_cp_show_buttons_form($form, &$form_state) {  
  $form['show_buttons'] = array(); 
  $form['show_buttons']['show_buttons_1'] = array(
    '#type' => 'fieldset',
    '#title' => t('Show Button 1'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#tree' => TRUE,
  );
  $form['show_buttons']['show_buttons_1']['title'] = array(
    '#type' => 'textfield',
    '#title' => t('Title'),
    '#default_value' => site_cp_show_buttons_form_default_value('show_buttons_1', 'title'),
    '#required' => TRUE,
  );
  $form['show_buttons']['show_buttons_1']['url'] = array(
    '#type' => 'textfield',
    '#title' => t('URL'),
    '#default_value' => site_cp_show_buttons_form_default_value('show_buttons_1', 'url'),
    '#required' => TRUE,
  );
  $form['show_buttons']['show_buttons_1']['icon_class'] = array(
    '#type' => 'textfield',
    '#title' => t('Icon Class'),
    '#default_value' => site_cp_show_buttons_form_default_value('show_buttons_1', 'icon_class'),
    '#required' => TRUE,
  );
  // Button 2
  $form['show_buttons']['show_buttons_2'] = array(
    '#type' => 'fieldset',
    '#title' => t('Show Button 2'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#tree' => TRUE,
  );
  $form['show_buttons']['show_buttons_2']['title'] = array(
    '#type' => 'textfield',
    '#title' => t('Title'),
    '#default_value' => site_cp_show_buttons_form_default_value('show_buttons_2', 'title'),
    '#required' => TRUE,
  );
  $form['show_buttons']['show_buttons_2']['url'] = array(
    '#type' => 'textfield',
    '#title' => t('URL'),
    '#default_value' => site_cp_show_buttons_form_default_value('show_buttons_2', 'url'),
    '#required' => TRUE,
  );
  $form['show_buttons']['show_buttons_2']['icon_class'] = array(
    '#type' => 'textfield',
    '#title' => t('Icon Class'),
    '#default_value' => site_cp_show_buttons_form_default_value('show_buttons_2', 'icon_class'),
    '#required' => TRUE,
  );
  $form['show_buttons']['submit'] = array(
    '#type' => 'submit',
    '#value' => 'Submit',
  );
  return $form;
}

/**
 * Form validation
 */
function site_cp_show_buttons_form_validate($form, &$form_state) {
}

/**
 * Form submit
 */
function site_cp_show_buttons_form_submit($form, &$form_state) {  
  //dpm($form_state);
  foreach($form_state['values'] as $key => $value) {
    // Check if array has depth.
    if (count($value) > 1) {      
      foreach($value as $item_key => $item_value) {
        $data_array[$key][$item_key] = $item_value;
      }
    }  
  }
  //dpm($data_array);
  foreach($data_array as $key => $item) {
    $data = array(
      'machine_name' => $key,
      'title' => $item['title'],
      'url' => $item['url'],
      'icon_class' => $item['icon_class'],
    );
    //dpm($data);    
    // Check if the record exists, to determine if it's a new record or an update.
    $update_record = db_query('SELECT machine_name FROM {site_cp_show_buttons} WHERE machine_name = :machine_name', 
      array(
        ':machine_name' => $data['machine_name'],
      ))->fetchField();
    // Update record.
    if ($update_record) {
      drupal_write_record('site_cp_show_buttons', $data, array('machine_name'));
    } 
    // Create new record.
    else {
      drupal_write_record('site_cp_show_buttons', $data);
    }
  }
}

/**
 * Helper function to get default values for form.
 */
function site_cp_show_buttons_form_default_value($machine_name, $field_name) {  
  $default_value = db_select('site_cp_show_buttons')
    ->fields('site_cp_show_buttons', array($field_name))
    ->condition('machine_name', $machine_name, '=')
    ->execute()
    ->fetchField();
  return $default_value;
}
