<?php //dpm($content); ?>
<?php $i = 1; ?>
<?php $h3id = 1; ?>
<?php foreach($content as $item): ?>
  <h2 id="item-<?php print $h3id++;?>" class="block-title">
    <a href="<?php print url('node/' . $item['nid']); ?>">
      <?php print $item['title']; ?>
    </a>
  </h2>
  <?php //dpm($item); ?>
  <section class="c-flexslider-video-carousel slider-cvl-partners-carousels" id ="section-id-<?php print $i++;?>">
    <div class="flexslider carousel">
      <ul class="cvlpc-carousel slides">
        <?php foreach($item['show_nodes'] as $video_item): ?> 
          <?php //dpm($video_item); ?>       
          <li>
            <a href="<?php print url('node/' . $video_item->nid); ?>">               
              <?php
                // Switch to account for cloudcast, vimeo, youtube, etc.     
                if (isset($video_item->field_show_vod['und'])) {        
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
                  //$field_description = strip_tags($video_item->field_description['und'][0]['value'], $allowable_tags);
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
                <?php if (isset($series_title)): ?>
                  <span class="series-title" style="font-style:italic;">
                    <?php print $series_title; ?>
                  </span>
                <?php endif; ?>
                <span class="watch-now-mobile">Watch Now &raquo;</span>
              </span>
            </a>  
          </li>      
        <?php endforeach; ?>
      </ul>
    </div>
  </section>
<?php endforeach; ?>