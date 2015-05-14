<?php
/**
 * @file
 * site_wrapper.footer.main_menu.inc
 *
 */

/**
 * Generates user menu
 */
function site_wrapper_footer_main_menu_1() {
  $tree = menu_tree_all_data('main-menu');
  $tree = site_wrapper_footer_main_menu_add_active_trail($tree);
  
  return menu_tree_output($tree);
}

/**
 * Helper function to check active menu item
 */
function site_wrapper_footer_main_menu_check_active($tree, $current){
	foreach ($tree as $menuItem) {
		if (isset($menuItem['below']) && is_array($menuItem['below']) && !empty($menuItem['below'])) {
			$menuItem['link']['in_active_trail'] = site_wrapper_footer_main_menu_check_active($menuItem['below'], $current);
		} else 
			if (isset($menuItem['link']['link_path']) && $menuItem['link']['link_path'] == $current){
				return 1;
			}
	}
	return false;
}

/**
 * Helper function to add active menu trail to active menu item
 */
function site_wrapper_footer_main_menu_add_active_trail($tree) {
	$current = current_path();
	$newTree = array();
	foreach ($tree as $k=>$menuItem) {
		if (isset($menuItem['below']) && is_array($menuItem['below']) && !empty($menuItem['below'])) {
			$menuItem['link']['in_active_trail'] = site_wrapper_footer_main_menu_check_active($menuItem['below'], $current);
		} else if (isset($menuItem['link']['link_path']) && $menuItem['link']['link_path'] == $current)
			$menuItem['link']['link_path'] = 1;
		$newTree[$k] = $menuItem;
	}
	return $newTree;
}
