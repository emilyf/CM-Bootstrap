<?php //dpm($node); ?>

<?php  
  $query = new EntityFieldQuery();
    $query->entityCondition('entity_type', 'node');
    $query->entityCondition('bundle', 'cm_show');
    $query->propertyCondition('status', 1);
    $query->range(0, 1);
    $query->propertyOrderBy('created', 'DESC');
    $query->fieldCondition('og_group_ref', 'target_id', $node->nid, '=');
  $result = $query->execute();    
  if (isset($result['node'])) {
    $nids = array_keys($result['node']);
    $nodes = entity_load('node', $nids);
    foreach($nodes as $cm_show_node) {
      //dpm($node);
      // Switch to account for cloudcast, vimeo, youtube, etc.     
      if (isset($cm_show_node->field_show_vod['und'])) {        
        switch($cm_show_node->field_show_vod['und'][0]['filemime']) {
          case 'video/cloudcast':
            $video_container_class = 'media-cloudcast-video media-cloudcast-1';
            $iframe_class = 'media-cloudcast-player';
            // Get param 'video'.
            $iframe_src_param_video = $cm_show_node->field_show_vod['und'][0]['filename'];
            // Get param 'id'.
            $uri = $cm_show_node->field_show_vod['und'][0]['uri'];
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
            $iframe_src_param_video = $cm_show_node->field_show_vod['und'][0]['filename'];
            // Get param 'id'.
            $uri = $cm_show_node->field_show_vod['und'][0]['uri'];
            $string_pieces = explode('/', $uri);
            $iframe_src_param_id = $string_pieces[3];
            // Build iframe src.
            $iframe_src = 'http://player.vimeo.com/video/' . $iframe_src_param_id . '?color=" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""';
            break;
          case 'video/youtube':  
            $video_container_class = 'video-container';
            $iframe_class = 'media-youtube-player';
            $iframe_src_param_video = $cm_show_node->field_show_vod['und'][0]['filename'];
            // Get param 'id'.
            $uri = $cm_show_node->field_show_vod['und'][0]['uri'];
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
<div class="row">
  <?php if (isset($iframe_src)): ?>
    <?php //dpm($iframe_src); ?>
    <section class="col-sm-8">
      <!--<div class="video-container">-->
      <div class="<?php print $video_container_class; ?>">          
        <iframe class="<?php print $iframe_class; ?>" width="640" height="390" src="<?php print $iframe_src; ?>" frameborder="0" allowfullscreen=""></iframe>
      </div>
      <div class="show-meta">
        <a href="<?php print url('node/' . $node->nid); ?>">
          <?php print $node->title; ?>
        </a>
        <a style="color:#FFF;" href="<?php print url('node/' . $cm_show_node->nid); ?>">
          <?php print $cm_show_node->title; ?>
        </a>
        <?php //dpm($node); ?>
        <?php if (isset($cm_show_node->field_description['und'][0]['value'])): ?>
          <p>
            <?php print custom_block_truncate(strip_tags($cm_show_node->field_description['und'][0]['value']), $length = 200, $options = array('exact' => FALSE, 'ending' => ' . . .')); ?>
          </p>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>
  <aside class="col-sm-4" role="complementary">        
    <?php //dpm($node); ?>
    <?php //dpm($content); ?>
    <h2><?php print $node->title; ?></h2>
    <!-- START: Social Media Block -->
    <?php $social_media_block = module_invoke('widgets', 'block_view', 's_socialmedia_share-default'); ?>
    <?php if (isset($social_media_block)): ?>
      <?php print render($social_media_block['content']); ?>
    <?php endif; ?>
    <!-- END: Social Media Block -->
    <?php print render($content); ?>
  </aside>
</div>
