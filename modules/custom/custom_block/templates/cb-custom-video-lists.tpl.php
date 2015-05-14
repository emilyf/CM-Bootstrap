<?php //dpm($content); ?>
<?php foreach($content as $item): ?>
  <h2 class="block-title"><?php print $item['collection_title']; ?>
    <p class="collection-description">
      <?php print $item['collection_desc']; ?>
    </p>
  </h3>
  <section class="c-flexslider-video-carousel">
    <div class="flexslider carousel">
      <ul class="slides">
        <?php foreach($item['video_items'] as $video_item): ?>
          <?php switch($video_item->type):
            case 'cm_show': ?>
              <?php
                //dpm($video_item);
                // Get series title
                if (isset($video_item->og_group_ref['und'])) {
                  $nid = $video_item->og_group_ref['und'][0]['target_id'];
                  $series_title = db_query("SELECT title FROM {node} WHERE nid = :nid", array(':nid' => $nid))->fetchField();
                }
                else {
                  $series_title = '';
                }
                //
                if (isset($video_item->field_series_image['und'])) {
                  $image_uri = $video_item->field_series_image['und'][0]['uri'];
                }
                if (isset($video_item->field_show_vod['und'])) {        
                  //dpm($video_item->nid);
                  switch($video_item->field_show_vod['und'][0]['filemime']) {
                    case 'video/cloudcast':
                      $image_uri = 'media-cloudcast/' . $video_item->field_show_vod['und'][0]['filename']  . '.jpg';			     					
                      break;
                    case 'video/vimeo':
                      $image_uri = str_replace('vimeo://v/', 'media-vimeo/', $video_item->field_show_vod['und'][0]['uri']);
                      $image_uri = $image_uri . '.jpg';
                      break;
                    case 'video/youtube':  
                      $image_uri = str_replace('youtube://v/', 'media-youtube/', $video_item->field_show_vod['und'][0]['uri']);
                      $image_uri = $image_uri . '.jpg';
                      break;
                  }
                  $img_src = image_style_url('500x281', $image_uri);
                }
                else {
                  $img_src = '';
                }
                //$img_src = image_style_url('500x281', $image_uri)
              ?>          
              <li>
                <a href="<?php print url('node/' . $video_item->nid); ?>">
                  <!--<span class="play-button">
                    <i class="icon glyphicon glyphicon-play-circle" aria-hidden="true"></i>
                  </span>-->
                  <?php if (isset($img_src)): ?>
                    <img src="<?php print $img_src; ?>" />
                  <?php endif; ?>
                  <span class="overlay">
                    <span class="play-button">
                      <i class="icon glyphicon glyphicon-play-circle" aria-hidden="true"></i>
                    </span>
                    <p class="title">
                      <?php print $video_item->title; ?>
                    </p>
                    <?php
                      $allowable_tags = '<i><a>';
                        
                      if (isset($video_item->field_description['und'][0]['value'])) {
                        $field_description = strip_tags($video_item->field_description['und'][0]['value'], $allowable_tags);
                      }
                      else {
                        $field_description = '';
                      }
                    ?>
                    <!--<p class="description">
                        <?php print custom_block_truncate($field_description, $length = 125, array('html' => true, 'ending' => ' . . .', 'exact' => FALSE)); ?>  
                      </p>-->
                    <?php if (!empty($series_title)): ?>
                      <span class="series-title" style="font-style:italic;">
                        <?php print $series_title; ?>
                      </span>
                    <?php endif; ?>
                    <span class="watch-now-mobile">Watch Now &raquo;</span>
                  </span>
                </a>
              </li>
              <?php break; ?>
            <?php case 'cm_project': ?>
              <?php //dpm($video_item); ?>
              <li>
                <a href="<?php print url('node/' . $video_item->nid); ?>">
                  <img src="<?php print image_style_url('500x281', $video_item->field_series_image['und'][0]['uri']) ?>" />
                  <!--<span class="play-button">
                    <i class="icon glyphicon glyphicon-play-circle" aria-hidden="true"></i>
                  </span>-->
                  <span class="overlay">
                    <span class="play-button">
                      <i class="icon glyphicon glyphicon-play-circle" aria-hidden="true"></i>
                    </span>
                     <p class="title">
                      <?php print $video_item->title; ?>
                     </p>
                      <?php
                        $allowable_tags = '<i><a>';
                        
                        if (isset($video_item->field_description['und'][0]['value'])) {
                          $field_description = strip_tags($video_item->field_description['und'][0]['value'], $allowable_tags);
                        }
                        else {
                          $field_description = '';
                        }
                      ?>
                      <p class="description">
                        <?php print custom_block_truncate($field_description, $length = 125, array('html' => true, 'ending' => ' . . .', 'exact' => FALSE)); ?>  
                      </p>
                    <span class="watch-now">Watch Now &raquo;</span>
                  </span>
                  <?php //if (isset($img_src)): ?>
                  <?php //endif; ?>
                </a>
              </li>              
              <?php break; ?>
          <?php endswitch; ?>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>
<?php endforeach; ?>
