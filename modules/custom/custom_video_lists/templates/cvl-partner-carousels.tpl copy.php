<?php //dpm($content); ?>

<?php $i = 1; ?>
<?php $h3id = 1; ?>
<?php foreach($content as $key_nid => $item): ?>
  <h3 id="item-<?php print $h3id++;?>" class="video-car-title">
    <a href="/node/<?php print $key_nid; ?>"><?php print $item['title']; ?></a>
  </h3>
  
  <?php //dpm($item); ?>
  <section class="slider-cvl-partners-carousels" id ="<?php print $i++;?>">
    <div class="flexslider carousel">
      <ul class="cvlpc-carousel slides">
        <?php foreach($item['video_node'][$key_nid] as $delta => $video_item): ?>        
          <li>
            <a href="/node/<?php print $video_item->nid; ?>">
              <span class="play-button">
                <i class="icon glyphicon glyphicon-play-circle" aria-hidden="true"></i>
              </span>
              
              <span class="overlay">
                <?php print $video_item->title; ?>
    
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
              </span>
              <img src="<?php print image_style_url('500x281', $image_uri);?>"/>
            </a>  
          </li>      
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

<?php endforeach; ?>