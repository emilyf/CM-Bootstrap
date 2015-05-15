<h1><?php echo $account->name ?> Followers</h1>
<div class="row">
  <div class="col-lg-8 col-md-8 col-xs-12">
    <ul class="user-grid">
      <?php
      $flags = flag_get_entity_flags('user', $account->uid, 'cf_follow_user');
      foreach ($flags as $flag) {
        $flagging_user = user_load($flag->uid);
        ?>
        <li>
          <a class="user-avatar" href="/user/<?php echo $flagging_user->uid ?>">
            <?php
            echo theme('image_style', array(
                'style_name' => 'thumbnail',
                'path' => !(empty($flagging_user->picture)) ? $flagging_user->picture->uri : variable_get('user_picture_default')
            ));
            ?>
            <h5><?php echo $flagging_user->name ?></h5>
          </a>
        </li>
        <?php
      }
      ?>
    </ul>
  </div>
</div>