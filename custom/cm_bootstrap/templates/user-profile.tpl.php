<?php
/**
 * @file
 * Default theme implementation to present all user profile data.
 *
 * This template is used when viewing a registered member's profile page,
 * e.g., example.com/user/124. 124 being the users ID.
 *
 * Use render($user_profile) to print all profile items, or print a subset
 * such as render($user_profile['user_picture']). Always call
 * render($user_profile) at the end in order to print all remaining items. If
 * the item is a category, it will contain all its profile items. By default,
 * $user_profile['summary'] is provided, which contains data on the user's
 * history. Other data can be included by modules. $user_profile['user_picture']
 * is available for showing the account picture.
 *
 * Available variables:
 *   - $user_profile: An array of profile items. Use render() to print them.
 *   - Field variables: for each field instance attached to the user a
 *     corresponding variable is defined; e.g., $account->field_example has a
 *     variable $field_example defined. When needing to access a field's raw
 *     values, developers/themers are strongly encouraged to use these
 *     variables. Otherwise they will have to explicitly specify the desired
 *     field language, e.g. $account->field_example['en'], thus overriding any
 *     language negotiation rule that was previously applied.
 *
 * @see user-profile-category.tpl.php
 *   Where the html is handled for the group.
 * @see user-profile-item.tpl.php
 *   Where the html is handled for each item in the group.
 * @see template_preprocess_user_profile()
 *
 * @ingroup themeable
 */
global $user;
$account = $elements['#account'];
?>
<div class="profile"<?php print $attributes; ?>>
  <h1><?php echo $account->name ?></h1>
  <div class="row">
    <div class="col-lg-3 col-md-3 col-xs-12 user-profile-left-col no-padding">
      <?php //dpm($account); ?>
      <?php 
        if (isset($account->picture->uri)) {
          $user_img_src = image_style_url('user_avatar_large', $account->picture->uri);
        }
        else {
          $user_img_src = $GLOBALS['base_url'] . '/' . path_to_theme() . '/images/user-avatar-large-placeholder.png';
        }
      ?>
      <img class="user-avatar-large" src="<?php print $user_img_src; ?>"/>
      <div class="user-details">
        <div class="btn btn-default">        
          <?php
          if ($account->uid === $user->uid) {
            echo "<a href='/user/{$user->uid}/edit'>Edit Profile</a>";
          }
          echo flag_create_link('cf_follow_user', $account->uid);
          ?>
        </div>
        <?php if (!empty($account->field_user_bio)): ?>
          <p style="padding: 10px 2px;">
            <?php print $account->field_user_bio[LANGUAGE_NONE][0]['value']; ?>
          </p>
        <?php endif; ?>
      </div>
    </div>
    <div class="col-lg-9 col-md-9 col-xs-12 user-profile-right-col">
      <?php $cf_user_statistics_blocks = module_invoke('community_features', 'block_view', 'cf_user_statistics'); ?>
      <?php //dpm($cf_user_statistics_blocks); ?>
      <?php print render($cf_user_statistics_blocks['content']); ?>
      <div class="clearfix"></div>
      
      <?php if ($featured_video) { ?>
        <h2>Featured Video</h2>
        <?php echo render($featured_video); ?>
      <?php } ?>
    </div>
    <div class="col-lg-9 col-md-9 col-xs-12 user-profile-third-col">
      <h2>Recently Uploaded</h2>
      <div class="recent-videos">
        <?php if (isset($recent_videos)): ?>
          <?php //dpm($recent_videos); ?>
          <ul class="user-shows-likes">
            <?php foreach($recent_videos['videos'] as $node): ?>
              <?php 
                // Get show images, accounting for variations.
                if (isset($node->field_show_vod['und'])) {        
                  switch($node->field_show_vod['und'][0]['filemime']) {
                    // Cloudcast
                    case 'video/cloudcast':
                      $image_uri = 'media-cloudcast/' . $node->field_show_vod['und'][0]['filename']  . '.jpg';								
                      break;
                    // Vimeo
                    case 'video/vimeo':
                      $image_uri = str_replace('vimeo://v/', 'media-vimeo/', $node->field_show_vod['und'][0]['uri']);
                      $image_uri = $image_uri . '.jpg';
                      break;
                    // Youtube
                    case 'video/youtube':  
                      $image_uri = str_replace('youtube://v/', 'media-youtube/', $node->field_show_vod['und'][0]['uri']);
                      $image_uri = $image_uri . '.jpg';
                      break;
                  }
                  $img_src = image_style_url('250x150', $image_uri);
                }
                else {
                  $img_src = '';
                }
                // Description
                if (isset($node->field_description['und'][0]['value'])) {
                  $show_description = $node->field_description['und'][0]['value'];
                }
                else {
                  $show_description = '';
                }
                // Series title
                if (isset($node->og_group_ref['und'][0]['target_id'])) {
                  $nid = $node->og_group_ref['und'][0]['target_id'];
                  $series_title = db_query("SELECT title FROM {node} WHERE nid = :nid", array(':nid' => $nid))->fetchField();
                }
                else {
                  $series_title = '';
                }
              ?>
              <li>
                <a href="<?php print url('node/' . $node->nid); ?>">
                  <img src="<?php print $img_src; ?>" />
                  <span class="overlay">
                    <p class="title">
                      <?php print $node->title; ?>
                    </p>
                    <p class="description">
                      <?php //print $show_description; ?>
                    </p>
                    <span class="series-title" style="font-style:italic;"><?php print $series_title; ?></span>
                    <span class="watch-now-mobile">Watch Now &raquo;</span>
                  </span>
                </a>
              </li>
            <?php endforeach; ?>
            <?php //echo render($recent_videos) ?>
          </ul>
          <?php print render($recent_videos['pager']); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
