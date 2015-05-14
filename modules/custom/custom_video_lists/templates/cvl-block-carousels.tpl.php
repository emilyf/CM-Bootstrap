cvl-block-carousels.tpl.php

<?php //dpm($content); ?>

<?php foreach($content as $item): ?>
  <h3 class="video-car-title"><?php print $item['collection_title']; ?>
    <p><?php print $item['collection_desc']; ?></p>
  </h3>
  
  <section class="c-flexslider-video-carousel">
    <div class="flexslider carousel">
      <ul class="slides">

        <?php foreach($item['video_items'] as $video_item): ?>
          <?php //dpm($video_item); ?>
          
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
            
            $img_src = image_style_url('500x281', $image_uri)
          ?>
          
          
          
          
          <li>
            <a href="<?php print url('node/' . $video_item->nid); ?>">
              <span class="play-button">
                <i class="icon glyphicon glyphicon-play-circle" aria-hidden="true"></i>
              </span>
              
              <span class="overlay" style="background-color:<?php print $node['bg-color'];?>;" data-accent-color="<?php print $node['accent-color'];?>">
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
                 
                <span class="watch-now">Watch Now &raquo;</span>
              </span>
              
              
              <img src="<?php print $img_src; ?>" />
              
              
              
               
            </a>
            
          </li>
          
          
          
        <?php endforeach; ?>
        
      </ul>
    </div>
  </section>
<?php endforeach; ?>