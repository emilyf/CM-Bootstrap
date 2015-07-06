<?php //dpm($content); ?>

<?php if (empty($content)): ?>
<br />
<br />
<p>You are currently not following any users. Please follow some users and their videos will appear here</p>

<?php else: ?>
<ul class="user-feed">
  <?php foreach($content as $node): ?>
    <?php //dpm($node); ?>
    <?php 
      // Get show images, accounting for variations.
      if (isset($node['node']->field_show_vod['und'])) {        
        switch($node['node']->field_show_vod['und'][0]['filemime']) {
          // Cloudcast
          case 'video/cloudcast':
            $image_uri = 'media-cloudcast/' . $node['node']->field_show_vod['und'][0]['filename']  . '.jpg';								
            break;
          // Vimeo
          case 'video/vimeo':
            $image_uri = str_replace('vimeo://v/', 'media-vimeo/', $node['node']->field_show_vod['und'][0]['uri']);
            $image_uri = $image_uri . '.jpg';
            break;
          // Youtube
          case 'video/youtube':  
            $image_uri = str_replace('youtube://v/', 'media-youtube/', $node['node']->field_show_vod['und'][0]['uri']);
            $image_uri = $image_uri . '.jpg';
            break;
        }
        $img_src = image_style_url('user_feed_large', $image_uri);
      }
      else {
        $img_src = '';
      }
      // Get series title
      if (isset($node['node']->og_group_ref['und'][0]['target_id'])) {
        $nid = $node['node']->og_group_ref['und'][0]['target_id'];
        $series_title = db_query("SELECT title FROM {node} WHERE nid = :nid", array(':nid' => $nid))->fetchField();
      }
      else {
        $series_title = '';
      }
    ?>  
    <li>
      <div class="row">
        <div class="col-md-3 no-padding author-data">
          <?php
            $author = user_load($node['node']->uid); 
            //dpm($author);
            if (isset($author->picture->uri)) {
              $user_avatar_src = $author->picture->uri;
            }
            else {
              $user_avatar_src = '';
            }
          ?>
          <a href="<?php print url('user/' . $node['node']->uid); ?>">
            <img src="<?php print image_style_url('user_avatar', $user_avatar_src); ?>"/>
            <p><?php print $author->name; ?></p>
          </a>
          <!--User id: <?php print $node['node']->uid; ?>-->
        </div>
         <div class="col-md-9 no-padding video-data">
          <a class="show-link" href="<?php print url('node/' . $node['node']->nid); ?>"> 
            <img src="<?php print $img_src; ?>" />
            <span class="overlay">
              <p class="title">
                <?php print $node['node']->title; ?>
              </p>
              <?php if (!empty($series_title)): ?>
                <span class="series-title" style="font-style:italic;">
                  <?php print $series_title; ?>
                </span>
              <?php endif; ?>
              <span class="watch-now-mobile">Watch Now »</span>
            </span>
          </a>
        </div>
      </div>
    </li>
  <?php endforeach; ?>
</ul>
<?php print render($pager); ?>
<?php endif; ?>