<?php if (drupal_is_front_page()): ?>
  <div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
    <?php print $user_picture; ?>
    <?php print render($title_prefix); ?>
    <?php if (!$page): ?>
      <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
    <?php if ($display_submitted): ?>
      <div class="submitted">
        <?php print $submitted; ?>
      </div>
    <?php endif; ?>
    <div class="content"<?php print $content_attributes; ?>>
      <?php
        // We hide the comments and links now so that we can render them later.
        hide($content['comments']);
        hide($content['links']);
        print render($content);
      ?>
    </div>
    <?php print render($content['links']); ?>
    <?php print render($content['comments']); ?>  
  </div>
<?php else: ?>
  <?php 
    //dpm($node); 
    $node_wrapper = entity_metadata_wrapper('node', $node);
    if ($node_wrapper) {
      if (db_table_exists('field_featured_video')) {
        $featured_video_node = $node_wrapper->field_featured_video->value();
        // Switch to account for cloudcast, vimeo, youtube, etc.     
        if (isset($featured_video_node->field_show_vod['und'])) {        
          switch($featured_video_node->field_show_vod['und'][0]['filemime']) {
            case 'video/cloudcast':
              $video_container_class = 'media-cloudcast-video media-cloudcast-1';
              $iframe_class = 'media-cloudcast-player';
              // Get param 'video'.
              $iframe_src_param_video = $featured_video_node->field_show_vod['und'][0]['filename'];
              // Get param 'id'.
              $uri = $featured_video_node->field_show_vod['und'][0]['uri'];
              $string_pieces = explode('/', $uri);
              $iframe_src_param_id = $string_pieces[3];
              // Build iframe src.
              $iframe_src = 'http://vp.telvue.com/player?wmode=opaque&modestbranding=1
    &HTML5=true&id=' . $iframe_src_param_id . '&video=' . $iframe_src_param_video . '&noplaylistskin=1&width=400&height=300';
              break;
            case 'video/vimeo':
              $video_container_class = 'video-container-vimeo';
              $iframe_class = 'media-vimeo-player';
              // Get param 'video'.
              $iframe_src_param_video = $featured_video_node->field_show_vod['und'][0]['filename'];
              // Get param 'id'.
              $uri = $featured_video_node->field_show_vod['und'][0]['uri'];
              $string_pieces = explode('/', $uri);
              $iframe_src_param_id = $string_pieces[3];
              // Build iframe src.
              $iframe_src = 'http://player.vimeo.com/video/' . $iframe_src_param_id . '?color=" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""';
              break;
            case 'video/youtube':  
              $video_container_class = 'video-container';
              $iframe_class = 'media-youtube-player';
              $iframe_src_param_video = $featured_video_node->field_show_vod['und'][0]['filename'];
              // Get param 'id'.
              $uri = $featured_video_node->field_show_vod['und'][0]['uri'];
              $string_pieces = explode('/', $uri);
              $iframe_src_param_id = $string_pieces[3];
              //dpm($iframe_src_param_id);
              // Build iframe src.
              $iframe_src = 'http://www.youtube.com/embed/' . $iframe_src_param_id . '?controls=1&amp;wmode=opaque&amp;autoplay=0&amp;enablejsapi=0&amp;loop=0&amp;modestbranding=0&amp;rel=1&amp;showinfo=1"';
              break;
            }
          }
        }
      }
  ?>
  
  <?php print render($content); ?>
  
  <div class="row">
    <?php if (isset($iframe_src)): ?>
      <?php //dpm($iframe_src); ?>
      <section class="col-sm-8 no-padding">
        <!--<div class="video-container">-->
        <div class="<?php print $video_container_class; ?>">          
          <iframe class="<?php print $iframe_class; ?>" width="640" height="390" src="<?php print $iframe_src; ?>" frameborder="0" allowfullscreen=""></iframe>
        </div>
      </section>
    <?php endif; ?>
  </div>

<?php endif;
  