<?php 
  if (module_exists('site_cp')) {
    $colors = site_cp_colors_get(); 
  }
?>

<?php if (isset($colors['cm_admin_form_color_2'])): ?>
div.vertical-tabs ul li.vertical-tab-button a {
  background-color:<?php print $colors['cm_admin_form_color_2']; ?> !important;
}
div.vertical-tabs {
  border-color:<?php print $colors['cm_admin_form_color_1']; ?> !important;
}
<?php endif; ?>

<?php if (isset($colors['cm_admin_form_color_1'])): ?>
div.vertical-tabs ul li.selected a {
  background-color:<?php print $colors['cm_admin_form_color_1']; ?> !important;
}
<?php endif; ?>

<?php if (isset($colors['cm_admin_form_color_3'])): ?>
div.vertical-tabs ul li.vertical-tab-button:not(.selected) a:hover {
  background-color:<?php print $colors['cm_admin_form_color_3']; ?> !important;
}
<?php endif; ?>

<?php if (isset($colors['cm_admin_form_color_2'])): ?>
fieldset {
  border-top-color:<?php print $colors['cm_admin_form_color_2']; ?> !important;
}
<?php endif; ?>

<?php if (isset($colors['cm_admin_text_tab_color'])): ?>
div.vertical-tabs ul li.vertical-tab-button strong {
  color:<?php print $colors['cm_admin_text_tab_color']; ?> !important;
}
<?php endif; ?>

<?php if (isset($colors['cm_admin_button_bg_color'])): ?>
#edit-actions input,
.page-user-edit #edit-submit {
  background-color:<?php print $colors['cm_admin_button_bg_color']; ?> !important;
}
<?php endif; ?>

<?php if (isset($colors['cm_admin_button_bg_hover_color'])): ?>
#edit-actions input:hover,
.page-user-edit #edit-submit:hover {
  background-color:<?php print $colors['cm_admin_button_bg_hover_color']; ?> !important;
}
<?php endif; ?>

<?php if (isset($colors['cm_admin_button_text_color'])): ?>
#edit-actions input,
.page-user-edit #edit-submit {
  color:<?php print $colors['cm_admin_button_text_color']; ?> !important;
}
<?php endif; ?>