<?php 
  if (module_exists('site_cp')) {
    $colors = site_cp_colors_get(); 
  }
?>
<?php // START: Global Colors ?>
<?php if (isset($colors['anchor_color'])): ?>
a {
  color:<?php print $colors['anchor_color']; ?>;
}
#admin-menu a {
  color:#FFF;
}
<?php endif; ?>
<?php if (isset($colors['anchor_hover_color'])): ?>
a:hover {
  color:<?php print $colors['anchor_hover_color']; ?>;
}
#admin-menu a:hover {
  color:#FFF;
}
<?php endif; ?>
<?php if (isset($colors['page_title_color'])): ?>
h1.page-header {
  color:<?php print $colors['page_title_color']; ?>!important;
}
<?php endif; ?>
<?php if (isset($colors['h2_color'])): ?>
h2 {
  color:<?php print $colors['h2_color']; ?>;
}
<?php endif; ?>
<?php if (isset($colors['h3_color'])): ?>
h3 {
  color:<?php print $colors['h3_color']; ?>;
}
<?php endif; ?>
<?php if (isset($colors['h4_color'])): ?>
h4 {
  color:<?php print $colors['h4_color']; ?>;
}
<?php endif; ?>
<?php if (isset($colors['right_sidebar_title_color'])): ?>
.region-sidebar-second h2.block-title {
  color:<?php print $colors['right_sidebar_title_color']; ?>!important;
}
<?php endif; ?>
<?php if (isset($colors['right_sidebar_bg_color'])): ?>
.region-sidebar-second .block {
  background-color:<?php print $colors['right_sidebar_bg_color']; ?>!important;
}
<?php endif; ?>
<?php if (isset($colors['right_sidebar_text_color'])): ?>
.region-sidebar-second .block {
  color:<?php print $colors['right_sidebar_text_color']; ?>;
}
<?php endif; ?>
<?php if (isset($colors['right_sidebar_link_color'])): ?>
.region-sidebar-second a {
  color:<?php print $colors['right_sidebar_link_color']; ?>!important;
}
<?php endif; ?>
<?php // END: Global Colors ?>

<?php // START: Navigation ?>
<?php if (isset($colors['nav_bg_color'])): ?>
.navigation {
  background-color:<?php print $colors['nav_bg_color']; ?>;
}
<?php endif; ?>
<?php if (isset($colors['nav_site_name_color'])): ?>
#block-site-wrapper-site-wrapper-sitename a {
  color:<?php print $colors['nav_site_name_color']; ?>;
}
<?php endif; ?>
<?php if (isset($colors['nav_link_color'])): ?>
.region-navigation ul.menu li a:not(.menu-panel-trigger) {
  color:<?php print $colors['nav_link_color']; ?>;
}
<?php endif; ?>
<?php if (isset($colors['nav_social_media_color'])): ?>
#block-custom-block-cb-social-media-menu-2 ul.social li a {
  color:<?php print $colors['nav_social_media_color']; ?>;
}
<?php endif; ?>
<?php // END: Navigation ?>

<?php // START: Jumbotron ?>
<?php if (isset($colors['jumbotron_overlay_color'])): ?>
  ul.front-pg-slider-items li span.title {
    background-color: <?php print $colors['jumbotron_overlay_color']; ?>;
  }
<?php endif; ?>

<?php if (isset($colors['jumbotron_overlay_color'])): ?>
ul.front-pg-slider-items li span.title {
  background-color: <?php print $colors['jumbotron_overlay_color']; ?>;
}
<?php endif; ?>
<?php if (isset($colors['jumbotron_arrow_color'])): ?>
#block-custom-front-pg-slider-front-pg-slider .flex-direction-nav a {
  color: <?php print $colors['jumbotron_arrow_color'];?>;
}
<?php endif; ?>
<?php if (isset($colors['jumbotron_arrow_bg_color'])): ?>
#block-custom-front-pg-slider-front-pg-slider .flex-direction-nav a {
  background-color: <?php print $colors['jumbotron_arrow_bg_color'];?>;
}
<?php endif; ?>
<?php if (isset($colors['jumbotron_arrow_hover_color'])): ?>
#block-custom-front-pg-slider-front-pg-slider .flex-direction-nav a:hover {
  background-color: <?php print $colors['jumbotron_arrow_hover_color']; ?>;
}
<?php endif; ?>
<?php // END: Jumbotron ?>

<?php // START: jPanel ?>
<?php if (isset($colors['jpanel_menu_trigger_color'])): ?>
.menu-panel-trigger,
.menu-panel-trigger.active,
.menu-panel-trigger:hover,
.menu-panel-trigger:after {
  color:<?php print $colors['jpanel_menu_trigger_color']; ?>;
}

.jpanel-trigger span {
  color:<?php print $colors['jpanel_menu_trigger_color']; ?>;
}
<?php endif; ?>

<?php if (isset($colors['jpanel_bg_color'])): ?>
#menu-panel {
  background-color:<?php print $colors['jpanel_bg_color']; ?>;
}
<?php endif; ?>

<?php if (isset($colors['jpanel_parent_item_color'])): ?>
#menu-panel #block-menu-block-3 ul > li > a,
#menu-panel .block-menu-block ul > li > a {
  color:<?php print $colors['jpanel_parent_item_color']; ?>;
}
<?php endif; ?>

<?php if (isset($colors['jpanel_child_item_color'])): ?>
#menu-panel #block-menu-block-3 ul li ul li a,
#menu-panel .block-menu-block ul li ul li a {
  color:<?php print $colors['jpanel_child_item_color']; ?>;
}
<?php endif; ?>

<?php if (isset($colors['jpanel_close_hover_color'])): ?>
@media screen {
  #menu-panel .close-menu:hover {
    color:<?php print $colors['jpanel_close_hover_color']; ?>;
  }
}
<?php endif; ?>
<?php // END: jPanel ?>

<?php // START: Video Slider ?>
<?php if (isset($colors['vs_heading_bg_color_1'])): ?>
.block-custom-block h2.block-title.cb-vl-item-1,
.block-custom-block h2.block-title.cb-vl-item-5,
.block-custom-block h2.block-title.cb-vl-item-9,
.block-custom-block h2.block-title.cb-vl-item-13,
.block-custom-block h2.block-title.cb-vl-item-17 {
  background-color:<?php print $colors['vs_heading_bg_color_1']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['vs_heading_bg_color_2'])): ?>
.block-custom-block h2.block-title.cb-vl-item-2,
.block-custom-block h2.block-title.cb-vl-item-6,
.block-custom-block h2.block-title.cb-vl-item-10,
.block-custom-block h2.block-title.cb-vl-item-14,
.block-custom-block h2.block-title.cb-vl-item-18 {
  background-color:<?php print $colors['vs_heading_bg_color_2']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['vs_heading_bg_color_3'])): ?>
.block-custom-block h2.block-title.cb-vl-item-3,
.block-custom-block h2.block-title.cb-vl-item-7,
.block-custom-block h2.block-title.cb-vl-item-11,
.block-custom-block h2.block-title.cb-vl-item-15,
.block-custom-block h2.block-title.cb-vl-item-19 {
  background-color:<?php print $colors['vs_heading_bg_color_3']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['vs_heading_bg_color_4'])): ?>
.block-custom-block h2.block-title.cb-vl-item-4,
.block-custom-block h2.block-title.cb-vl-item-8,
.block-custom-block h2.block-title.cb-vl-item-12,
.block-custom-block h2.block-title.cb-vl-item-16,
.block-custom-block h2.block-title.cb-vl-item-20 {
  background-color:<?php print $colors['vs_heading_bg_color_4']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['vs_heading_text_color'])): ?>
#block-custom-block-front-pg-fv-carousel h2,
#block-custom-block-front-pg-ls-carousel h2,
#block-custom-block-cb-custom-video-lists-front h2,
#block-custom-block-cb-custom-video-lists h2,
.block-custom-block h2.block-title,
.block-custom-block h2.block-title a,
.block-custom-video-lists h2.block-title {
  color:<?php print $colors['vs_heading_text_color']; ?>;
}
<?php endif; ?>
<?php if (isset($colors['vs_overlay_color_1'])): ?>
.c-flexslider-video-carousel ul li:nth-child(1) span.overlay,
.c-flexslider-video-carousel ul li:nth-child(5) span.overlay,
.c-flexslider-video-carousel ul li:nth-child(9) span.overlay,
.c-flexslider-video-carousel ul li:nth-child(13) span.overlay,
.c-flexslider-video-carousel ul li:nth-child(17) span.overlay,
.c-flexslider-video-carousel ul li:nth-child(21) span.overlay,
.c-flexslider-video-carousel ul li:nth-child(25) span.overlay,
.video-grid-column ul.video-grid-shows li:nth-child(1) a span.overlay,
.taxonomy-term-pg ul.video-grid-shows li a span.overlay {
  background-color:<?php print $colors['vs_overlay_color_1']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['vs_overlay_color_2'])): ?>
.c-flexslider-video-carousel ul li:nth-child(2) span.overlay,
.c-flexslider-video-carousel ul li:nth-child(6) span.overlay,
.c-flexslider-video-carousel ul li:nth-child(10) span.overlay,
.c-flexslider-video-carousel ul li:nth-child(14) span.overlay,
.c-flexslider-video-carousel ul li:nth-child(18) span.overlay,
.c-flexslider-video-carousel ul li:nth-child(22) span.overlay,
.video-grid-column ul.video-grid-shows li:nth-child(2) a span.overlay {
  background-color:<?php print $colors['vs_overlay_color_2']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['vs_overlay_color_3'])): ?>
.c-flexslider-video-carousel ul li:nth-child(3) span.overlay,
.c-flexslider-video-carousel ul li:nth-child(7) span.overlay,
.c-flexslider-video-carousel ul li:nth-child(11) span.overlay,
.c-flexslider-video-carousel ul li:nth-child(15) span.overlay,
.c-flexslider-video-carousel ul li:nth-child(19) span.overlay,
.c-flexslider-video-carousel ul li:nth-child(23) span.overlay,
.video-grid-column ul.video-grid-shows li:nth-child(3) a span.overlay {
  background-color:<?php print $colors['vs_overlay_color_3']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['vs_overlay_color_4'])): ?>
.c-flexslider-video-carousel ul li:nth-child(4) span.overlay,
.c-flexslider-video-carousel ul li:nth-child(8) span.overlay,
.c-flexslider-video-carousel ul li:nth-child(12) span.overlay,
.c-flexslider-video-carousel ul li:nth-child(16) span.overlay,
.c-flexslider-video-carousel ul li:nth-child(20) span.overlay,
.c-flexslider-video-carousel ul li:nth-child(24) span.overlay,
.video-grid-column ul.video-grid-shows li:nth-child(4) a span.overlay {
  background-color:<?php print $colors['vs_overlay_color_4']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['vs_arrow_bg_color'])): ?>
.c-flexslider-video-carousel .flexslider .flex-direction-nav a {
  background-color:<?php print $colors['vs_arrow_bg_color']; ?>;
}
<?php endif; ?>
<?php if (isset($colors['vs_arrow_color'])): ?>
.c-flexslider-video-carousel .flex-direction-nav a:before {
  color:<?php print $colors['vs_arrow_color']; ?>;
}
<?php endif; ?>
<?php if (isset($colors['vs_arrow_bg_hover_color'])): ?>
.c-flexslider-video-carousel .flex-direction-nav a:hover {
  background-color:<?php print $colors['vs_arrow_bg_hover_color']; ?>;
}
<?php endif; ?>
<?php // END: Video Slider ?>

<?php // START: Footer ?>
<?php if (isset($colors['footer_bg_color'])): ?>
footer.footer {
  background-color:<?php print $colors['footer_bg_color']; ?>;
}
<?php endif; ?>
<?php if (isset($colors['footer_accent_color'])): ?>
footer.footer {
  border-top-color:<?php print $colors['footer_accent_color']; ?>;
}
footer .block-menu-block {
  border-right-color: <?php print $colors['footer_accent_color']; ?>;
}
<?php endif; ?>
<?php if (isset($colors['footer_link_color'])): ?>
footer .block-menu-block ul li a {
  color:<?php print $colors['footer_link_color']; ?>;
}
<?php endif; ?>
<?php if (isset($colors['footer_bottom_bg_color'])): ?>
footer.footer-bottom {
  background-color:<?php print $colors['footer_bottom_bg_color']; ?>;
}
<?php endif; ?>
<?php // END: Footer ?>

<?php // START: Archive Pg ?>
<?php if (isset($colors['archive_color_1'])): ?>
.two-col-list li.item-0 .right {
  background-color:<?php print $colors['archive_color_1']; ?>;
}
<?php endif; ?>
<?php if (isset($colors['archive_color_2'])): ?>
.two-col-list li.item-1 .right {
  background-color:<?php print $colors['archive_color_2']; ?>;
}
<?php endif; ?>
<?php if (isset($colors['archive_color_3'])): ?>
.two-col-list li.item-2 .right {
  background-color:<?php print $colors['archive_color_3']; ?>;
}
<?php endif; ?>
<?php if (isset($colors['archive_color_4'])): ?>
.two-col-list li.item-3 .right {
  background-color:<?php print $colors['archive_color_4']; ?>;
}
<?php endif; ?>
<?php // END: Archive Pg ?>

<?php // START: Video Grid ?>
<?php if (isset($colors['vg_background_color'])): ?>
#block-custom-block-cb-video-grid {
  background-color:<?php print $colors['vg_background_color']; ?>;
}
<?php endif; ?>
<?php if (isset($colors['vg_title_color'])): ?>
#block-custom-block-cb-video-grid .video-grid-title {
  color:<?php print $colors['vg_title_color']; ?>;
}
<?php endif; ?>
<?php if (isset($colors['vg_description_color'])): ?>
.video-grid-column .top-details .description {
  color:<?php print $colors['vg_description_color']; ?>;
}
<?php endif; ?>
<?php // END: Video Grid ?>

<?php // START: Show Detail Pg. ?>
<?php if (isset($colors['sidebar_link_color'])): ?>
.node-type-cm-show .col-sm-4 .field a {
  color:<?php print $colors['sidebar_link_color']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['sidebar_link_hover_color'])): ?>
.node-type-cm-show .col-sm-4 .field a:hover {
  color:<?php print $colors['sidebar_link_hover_color']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['sidebar_field_label_color'])): ?>
.node-type-cm-show .col-sm-4 .field-label,
.node-type-cm-show span.genres-label {
  color:<?php print $colors['sidebar_field_label_color']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['recent_video_bg_color'])): ?>
ul.cb-show-recent-videos li a .right {
  background-color:<?php print $colors['recent_video_bg_color']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['recent_video_bg_hover_color'])): ?>
ul.cb-show-recent-videos li a:hover .right {
  background-color:<?php print $colors['recent_video_bg_hover_color']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['recent_video_text_color'])): ?>
ul.cb-show-recent-videos li a .right {
  color:<?php print $colors['recent_video_text_color']; ?> !important;
}
<?php endif; ?>
<?php // END: Show Detail Pg. ?>

<?php // START: Cm Features ?>
<?php if (isset($colors['cm_features_tile_bg_color'])): ?>
ul.user-feed li .overlay,
ul.user-shows-likes li .overlay {
  background:<?php print $colors['cm_features_tile_bg_color']; ?> !important;
}  
<?php endif; ?>
<?php if (isset($colors['cm_features_tile_bg_hover_color'])): ?>
ul.user-feed li a:hover .overlay,
ul.user-shows-likes li a:hover .overlay {
  background:<?php print $colors['cm_features_tile_bg_hover_color']; ?> !important;
}  
<?php endif; ?>
<?php if (isset($colors['cm_features_button_color'])): ?>
.profile .btn-default,
ul.user-statistics {
  background-color:<?php print $colors['cm_features_button_color']; ?> !important;
}
.user-statistics:before {
  border-right-color:<?php print $colors['cm_features_button_color']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['cm_features_button_hover_color'])): ?>
.profile .btn-default:hover {
  background-color:<?php print $colors['cm_features_button_hover_color']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['cm_features_text_color'])): ?>
.profile .btn-default a {
  color:<?php print $colors['cm_features_text_color']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['cm_features_text_hover_color'])): ?>
.profile .btn-default a:hover {
  color:<?php print $colors['cm_features_text_hover_color']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['cm_features_menu_bg_color'])): ?>
.menu-name-menu-user-profile-menu ul.nav {
  background-color:<?php print $colors['cm_features_menu_bg_color']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['cm_features_menu_item_bg_color'])): ?>
.menu-name-menu-user-profile-menu ul.nav li a,
.user-statistics li a {
  background-color:<?php print $colors['cm_features_menu_item_bg_color']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['cm_features_menu_item_text_color'])): ?>
.menu-name-menu-user-profile-menu ul.nav li a,
.user-statistics li a {
  color:<?php print $colors['cm_features_menu_item_text_color']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['cm_features_menu_item_active_bg_color'])): ?>
.menu-name-menu-user-profile-menu ul.nav li.active-upmi a,
.menu-name-menu-user-profile-menu ul.nav li a:hover,
.user-statistics li.active a,
.user-statistics li a:hover {
  background-color:<?php print $colors['cm_features_menu_item_active_bg_color']; ?> !important;
}
<?php endif; ?>
<?php // END: Cm Features ?>

<?php // START: User Registration ?>
<?php if (isset($colors['cm_admin_button_bg_color'])): ?>
#user-register-form #edit-submit {
  background-color:<?php print $colors['cm_admin_button_bg_color']; ?> !important;
  border-color:<?php print $colors['cm_admin_button_bg_color']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['cm_admin_button_bg_hover_color'])): ?>
#user-register-form #edit-submit:hover {
  background-color:<?php print $colors['cm_admin_button_bg_hover_color']; ?> !important;
  border-color:<?php print $colors['cm_admin_button_bg_hover_color']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['cm_admin_button_text_color'])): ?>
#user-register-form #edit-submit {
  color:<?php print $colors['cm_admin_button_text_color']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['cm_admin_form_color_1'])): ?>
.page-user-register p.help-block {
  background:<?php print $colors['cm_admin_form_color_1']; ?> !important;
}
<?php endif; ?>
<?php // END: User Registration ?>

<?php // START: Show/Series Main Content Colors ?>
<?php if (isset($colors['show_main_content_bg_color'])): ?>
.node-type-cm-show .main-container {
  background-color:<?php print $colors['show_main_content_bg_color']; ?> !important;
}
<?php endif; ?>
<?php if (isset($colors['series_main_content_bg_color'])): ?>
.node-type-cm-project .main-container {
  background-color:<?php print $colors['series_main_content_bg_color']; ?> !important;
}
<?php endif; ?>
<?php // END: Show/Series Main Content Colors ?>
