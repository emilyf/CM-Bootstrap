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
    <div class="col-lg-4 col-md-4 col-xs-12">
      <?php echo render($user_profile['user_picture']); ?>
      <div class="user-details">
        <div class="btn btn-default">        
          <?php
          if ($account->uid === $user->uid) {
            echo "<a href='/user/{$user->uid}/edit'>Edit Profile</a>";
          }
          echo flag_create_link('cf_follow_user', $account->uid);
          ?>
        </div>
      </div>
    </div>
    <div class="col-lg-8 col-md-8 col-xs-12">
      <ul class="user-statistics">
        <?php
        /*
         * NOTE: These elements are aligned with inline-block.  Do not add spaces between the 
         * Do not add spaces or line breaks between the li tags or a space will be inserted between
         * the elements.
         */
        ?>
        <li class="user-likes"><div class="statistic"><?php echo $likes ?></div><a href="/user/<?php echo $account->uid ?>/likes">Likes</a>
        </li><li class="user-follows"><div class="statistic"><?php echo $follows ?></div><a href="/user/<?php echo $account->uid ?>/followers">Followers</a>
        </li><li class="user-following"><div class="statistic"><?php echo $following ?></div><a href="/user/<?php echo $account->uid ?>/following">Following</a></li>
      </ul>
      <div class="clearfix"></div>
      <?php if ($featured_video) { ?>
        <h2>Featured Video</h2>
        <?php echo render($featured_video); ?>
      <?php } ?>
      <h2>Recently Uploaded</h2>
      <div class="recent-videos">
        <?php echo render($recent_videos) ?>
      </div>
    </div>
  </div>
