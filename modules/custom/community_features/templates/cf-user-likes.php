<h1><?php echo $account->name ?> Likes</h1>
<div class="col-lg-8 col-md-8 col-xs-12">
  <?php
  $flags = flag_get_user_flags('node', null, $account->uid);
  foreach ($flags['cf_like_show'] as $flag) {
//      die(var_export(node_load($flag->entity_id), true));
    ?>
    <div class="col-lg-6 col-md-6 col-xs-12"><?php
      $video = field_view_field('node', node_load($flag->entity_id), 'field_show_vod', 'Full content');
      echo render($video);
      ?></div>
    <?php
  }
  ?>
</div>