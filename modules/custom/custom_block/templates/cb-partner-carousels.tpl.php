<?php //dpm($content); ?>
<?php $i = 1; ?>
<?php $h3id = 1; ?>
<?php foreach($content as $item): ?>
  <h2 id="item-<?php print $h3id++;?>" class="block-title">
    <a href="<?php print url('node/' . $item['nid']); ?>"><?php print $item['title']; ?></a>
  </h2>
  <?php //dpm($item); ?>
  <section class="c-flexslider-video-carousel slider-cvl-partners-carousels" id ="section-id-<?php print $i++;?>">
    <div class="flexslider carousel">
      <ul class="cvlpc-carousel slides">
        <?php foreach($item['video_node'] as $video_item): ?> 
          <?php //dpm($video_item); ?>       
          <li>
            <a href="<?php print url('node/' . $video_item->nid); ?>">
              <?php
                // Get series title.
                if (isset($video_item->og_group_ref['und'][0]['target_id'])) {
                  $nid = $video_item->og_group_ref['und'][0]['target_id'];
                  $series_title = db_query("SELECT title FROM {node} WHERE nid = :nid", array(':nid' => $nid))->fetchField();
                }
                // Get image from field_series_image                
                if (isset($video_item->field_series_image['und'])) {
                  $image_uri = $video_item->field_series_image['und'][0]['uri'];
                }
                // Else, no image, use default image.
                else {
                  $info = field_info_field('field_series_image');
                  if (!empty($info) && $info['settings']['default_image'] > 0) {
                    $default_img_fid  = $info['settings']['default_image'];
                    $default_img_file = file_load($default_img_fid);
                    //dpm($default_img_file);
                    $image_uri = $default_img_file->uri;
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