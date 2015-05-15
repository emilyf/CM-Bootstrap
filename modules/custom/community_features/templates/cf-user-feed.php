<div role="tabpanel">
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="<?php echo (empty($_REQUEST['tab']) || $_REQUEST['tab'] == 'feed') ? " active" : "" ?>">
      <a href="#user-feed" aria-controls="user-feed" role="tab" data-toggle="tab">All</a>
    </li>
    <li role="presentation" class="<?php echo (!empty($_REQUEST['tab']) && $_REQUEST['tab'] == 'likes') ? " active" : '' ?>">
      <a href="#user-likes" aria-controls="user-likes" role="tab" data-toggle="tab">Likes</a>
    </li>
  </ul>
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane<?php echo (empty($_REQUEST['tab']) || $_REQUEST['tab'] == 'feed') ? " active" : "" ?>" id="user-feed">
      <?php echo views_embed_view('my_feed'); ?>
    </div>
    <div role="tabpanel" class="tab-pane<?php echo (!empty($_REQUEST['tab']) && $_REQUEST['tab'] == 'likes') ? " active" : '' ?>" id="user-likes">
      <?php echo views_embed_view('my_likes'); ?>
    </div>
  </div>
</div>