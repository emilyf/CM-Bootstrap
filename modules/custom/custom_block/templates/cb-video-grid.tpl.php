<?php //dpm($content); ?>
<div class="video-grid-container">
  <?php foreach($content as $item): ?>
    <?php //dpm($item); ?>
    
    <div class="video-grid-column">
      <div class="top-details">
        <h3 class="video-grid-title">
          <?php print $item['title']; ?>
        </h3>
        <div class="description">
          <?php print $item['description']; ?>
        </div>
      </div>
      <ul class="video-grid-shows">
        <?php foreach($item['shows'] as $show_node): ?>        
          <?php 
            // Get show images, accounting for variations.
            if (isset($show_node->field_show_vod['und'])) {        
              switch($show_node->field_show_vod['und'][0]['filemime']) {
                // Cloudcast
                case 'video/cloudcast':
                  $image_uri = 'media-cloudcast/' . $show_node->field_show_vod['und'][0]['filename']  . '.jpg';								
                  break;
                // Vimeo
                case 'video/vimeo':
                  $image_uri = str_replace('vimeo://v/', 'media-vimeo/', $show_node->field_show_vod['und'][0]['uri']);
                  $image_uri = $image_uri . '.jpg';
                  break;
                // Youtube
                case 'video/youtube':  
                  $image_uri = str_replace('youtube://v/', 'media-youtube/', $show_node->field_show_vod['und'][0]['uri']);
                  $image_uri = $image_uri . '.jpg';
                  break;
              }
              $img_src = image_style_url('250x150', $image_uri);
            }
            else {
              $img_src = '';
            }
            
            // Description
            if (isset($show_node->field_description['und'][0]['value'])) {
              $show_description = $show_node->field_description['und'][0]['value'];
            }
            else {
              $show_description = '';
            }
            
            // Get series title
            if (isset($show_node->og_group_ref['und'][0]['target_id'])) {
              $nid = $show_node->og_group_ref['und'][0]['target_id'];
              $series_title = db_query("SELECT title FROM {node} WHERE nid = :nid", array(':nid' => $nid))->fetchField();
            }
            else {
              $series_title = '';
            }
          ?>    
          <li>
            <a href="<?php print url('node/' . $show_node->nid); ?>">
              <?php //print drupal_render($img_src); ?>
              
              <img src="<?php print $img_src; ?>" />
              <span class="overlay">
                <!--<span class="play-button">
                  <i class="icon glyphicon glyphicon-play-circle" aria-hidden="true"></i>
                </span>-->
                <p class="title">
                  <?php print $show_node->title; ?>
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
      </ul>
      
    </div>
  <?php endforeach; ?>
</div>
