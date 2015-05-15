<h1><?php echo $account->name ?> Following</h1>
<div class="row">
  <div class="col-lg-8 col-md-8 col-xs-12">
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
                  'style_name' => 'thumbnail',
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
</div>