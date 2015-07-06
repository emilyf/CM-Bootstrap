<style>
  #block-system-main {
    padding-top:25px;
  }
</style>

<?php
  $following = _community_features_get_following($account->uid);
  $follows = _community_features_get_follows($account->uid);
  $likes = _community_features_get_likes($account->uid);
  $recent_videos = _community_features_get_recent_videos($account->uid);
  $video_count = _community_features_get_user_video_count($account->uid);
?>

<h1><?php echo $account->name ?></h1>
<div class="col-lg-3 col-md-3 col-xs-4 user-profile-left-col no-padding">
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
      /*if ($account['user']->uid === $user['user']->uid) {
        echo "<a href='/user/{$user->uid}/edit'>Edit Profile</a>";
      }
      echo flag_create_link('cf_follow_user', $account['user']->uid);*/
      ?>
      <?php if ($account->uid === $GLOBALS['user']->uid): ?>
        <a href="/user/<?php print $GLOBALS['user']->uid; ?>/edit">Edit Profile</a>
      <?php else: ?>
        <?php print flag_create_link('cf_follow_user', $account->uid); ?>
      <?php endif; ?>
    </div>
  </div>
</div>


<div class="col-lg-9 col-md-9 col-xs-8 user-profile-right-col">
  <?php $cf_user_statistics_blocks = module_invoke('community_features', 'block_view', 'cf_user_statistics'); ?>
  <?php //dpm($cf_user_statistics_blocks); ?>
  <?php print render($cf_user_statistics_blocks['content']); ?>
  <div class="clearfix"></div>
</div>
<div class="col-lg-9 col-md-9 col-xs-12 user-profile-third-col">   
  <h2><?php echo $account->name ?> Followers</h2>
  
  <ul class="user-grid">
    <?php
    $flags = flag_get_user_flags('user');
    if (!empty($flags['cf_follow_user'])) {
      foreach ($flags['cf_follow_user'] as $flag) {
        $flagged_user = user_load($flag->entity_id);
        ?>
        <li>
          <a class="user-avatar" href="/user/<?php echo $flagged_user->uid ?>">
            <?php
            echo theme('image_style', array(
                'style_name' => 'user_avatar',
                'path' => !(empty($flagged_user->picture)) ? $flagged_user->picture->uri : variable_get('user_picture_default')
            ));
            ?>
            <h5><?php echo $flagged_user->name ?></h5>
          </a>
        </li>
        <?php
      }
    }
    ?>
  </ul>
</div>