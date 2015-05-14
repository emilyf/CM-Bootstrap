<?php //dpm($content); ?>

<?php $i = 1; ?>
<?php $h3id = 1; ?>
<?php foreach($content as $item): ?>
  <h3 id="item-<?php print $h3id++;?>" class="video-car-title">
    <a href="<?php print url('node/' . $item['nid']); ?>"><?php print $item['title']; ?></a>
  </h3>
  
  <?php //dpm($item); ?>
  <section class="c-flexslider-video-carousel slider-cvl-partners-carousels" id ="section-id-<?php print $i++;?>">
    <div class="flexslider carousel">
      <ul class="cvlpc-carousel slides">
        <?php foreach($item['video_node'] as $video_item): ?> 
          <?php //dpm($video_item); ?>       
          <li>
            <a href="<?php print url('node/' .  $video_item->nid); ?>">              
              <?php
                if (isset($video_item->field_series_image['und'])) {
                  $image_uri = $video_item->field_series_image['und'][0]['uri'];
                }
                
                if (isset($video_item->field_show_vod['und'])) {        
                  // field_show_vod
                  switch($video_item->field_show_vod['und'][0]['filemime']) {
                    case 'video/vimeo':
                      $image_uri = str_replace('vimeo://v/', 'media-vimeo/', $video_item->field_show_vod['und'][0]['uri']);
                      $image_uri = $image_uri . '.jpg';
                      
                      break;
                      
                    case 'video/youtube':  
                      $image_uri = str_replace('youtube://v/', 'media-youtube/', $video_item->field_show_vod['und'][0]['uri']);
                      $image_uri = $image_uri . '.jpg';
                      break;
                  
                  }
                }
              ?>
              <img src="<?php print image_style_url('500x281', $image_uri);?>"/>
              <span class="overlay">
                <span class="play-button">
                  <i class="icon glyphicon glyphicon-play-circle" aria-hidden="true"></i>
                </span>
                <p class="title">
                  <?php print $video_item->title; ?>
                </p>
                
                <?php
                  //$allowable_tags = '<i><a>';
                  $field_description = strip_tags($video_item->field_description['und'][0]['value'], $allowable_tags);
                ?>
                
                
                <p class="description">
                  <?php print custom_block_truncate($field_description, $length = 125, array('html' => true, 'ending' => ' . . .', 'exact' => FALSE)); ?>  
                </p>
                <span class="series-title" style="font-style:italic;"><?php print $node['series_title']; ?></span>
                <span class="watch-now-mobile">Watch Now &raquo;</span>
              </span>
            </a>  
          </li>      
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

<?php endforeach; ?>