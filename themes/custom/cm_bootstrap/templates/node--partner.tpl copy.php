<?php  
  $query = new EntityFieldQuery();
    $query->entityCondition('entity_type', 'node');
    $query->entityCondition('bundle', 'cm_show');
    $query->propertyCondition('status', 1);
    $query->range(0, 1);
    $query->propertyOrderBy('created', 'ASC');
    $query->fieldCondition('field_partner', 'target_id', $node->nid, '=');
  $result = $query->execute();    
  if (isset($result['node'])) {
    $nids = array_keys($result['node']);
    $nodes = entity_load('node', $nids);
    foreach($nodes as $node) {
      // Switch to account for cloudcast, vimeo, youtube, etc.     
      if (isset($node->field_show_vod['und'])) {        
        switch($node->field_show_vod['und'][0]['filemime']) {
          case 'video/cloudcast':
            $iframe_class = 'media-cloudcast-player';
            // Get param 'video'.
            $iframe_src_param_video = $node->field_show_vod['und'][0]['filename'];
            // Get param 'id'.
            $uri = $node->field_show_vod['und'][0]['uri'];
            $string_pieces = explode('/', $uri);
            $iframe_src_param_id = $string_pieces[3];
            // Build iframe src.
            $iframe_src = 'http://vp.telvue.com/player?wmode=opaque&amp;id=' . $iframe_src_param_id . '&amp;video=' . $iframe_src_param_video . '&amp;noplaylistskin=1&amp;width=400&amp;height=300';
            break;
          case 'video/vimeo':
          break;
          case 'video/youtube':  
            $iframe_class = 'media-youtube-player';
            $iframe_src_param_video = $node->field_show_vod['und'][0]['filename'];
            // Get param 'id'.
            $uri = $node->field_show_vod['und'][0]['uri'];
            $string_pieces = explode('/', $uri);
            $iframe_src_param_id = $string_pieces[3];
            //dpm($iframe_src_param_id);
            // Build iframe src.
            $iframe_src = 'http://www.youtube.com/embed/' . $iframe_src_param_id . '?controls=1&amp;wmode=opaque&amp;autoplay=0&amp;enablejsapi=0&amp;loop=0&amp;modestbranding=0&amp;rel=1&amp;showinfo=1"';
            break;
        }
      }
      // Series title
      if (isset($node->og_group_ref['und'][0]['target_id'])) {
        $series_nid = $node->og_group_ref['und'][0]['target_id'];
        $series_title = db_query("SELECT title FROM {node} WHERE nid = :nid", array(':nid' => $series_nid))->fetchField();
      }
      else {
        $series_title = '';
      }      
    }    
  }
?>
<div class="row">
  <?php if (isset($iframe_src)): ?>
    <?php //dpm($iframe_src); ?>
    <section class="col-sm-8">
      <div class="video-container">          
        <iframe class="<?php print $iframe_class; ?>" width="640" height="390" src="<?php print $iframe_src; ?>" frameborder="0" allowfullscreen=""></iframe>
      </div>
      <div class="show-meta">
        <a href="<?php print url('node/' . $series_nid); ?>">
          <?php print $series_title; ?>
        </a>
        <a style="color:#FFF;" href="<?php print url('node/' . $node->nid); ?>">
          <?php print $node->title; ?>
        </a>
        <?php //dpm($node); ?>
        <?php if (isset($node->field_description['und'][0]['value'])): ?>
          <p>
            <?php print custom_block_truncate(strip_tags($node->field_description['und'][0]['value']), $length = 200, $options = array('exact' => FALSE, 'ending' => ' . . .')); ?>
          </p>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>
  <aside class="col-sm-4" role="complementary">    
    <?php //dpm($content); ?>
    <?php $content['body']['#label_display'] = 'hidden'; ?>
    <?php print render($content['body']); ?>
    <?php $content['field_partner_logo_large']['#label_display'] = 'hidden'; ?>
    <?php print render($content['field_partner_logo_large']); ?>
    <?php if (isset($content['group_sidebar_project']['field_web_resources'])): ?>
      <?php print render($content['group_sidebar_project']['field_web_resources']); ?>
    <?php endif; ?>
    <?php if (isset($content['field_web_resources'])): ?>
      <?php print render($content['field_web_resources']); ?>
    <?php endif; ?>
  </aside>
</div>
