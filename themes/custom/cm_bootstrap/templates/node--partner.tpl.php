<?php //dpm($node); ?>

<?php  
$content_types = array(
  'cm_show',
  'cm_project',
);
$query = new EntityFieldQuery();
  $query->entityCondition('entity_type', 'node');
  $query->entityCondition('bundle', $content_types);
  $query->propertyCondition('status', 1);
  $query->range(0, 25);
  $query->propertyOrderBy('created', 'ASC');
  $query->fieldCondition('field_partner', 'target_id', $node->nid, '=');
$result = $query->execute();    
if (isset($result['node'])) {
  $nids = array_keys($result['node']);
  $nodes = entity_load('node', $nids);
  foreach($nodes as $q_node) {
    if ($q_node->type == 'cm_show') {
      $show_assoc_partner_array[] = $q_node;     
    }
    // Series
    if ($q_node->type == 'cm_project') {
      //dpm($node);
      // Get all shows that are part of this series.
      $cm_s_query = new EntityFieldQuery();
        $cm_s_query->entityCondition('entity_type', 'node');
        $cm_s_query->entityCondition('bundle', 'cm_show');
        $cm_s_query->propertyCondition('status', 1);
        $cm_s_query->range(0, 25);
        $cm_s_query->propertyOrderBy('created', 'ASC');
        $cm_s_query->fieldCondition('og_group_ref', 'target_id', $q_node->nid, '=');
      $cm_s_result = $cm_s_query->execute();    
      if (isset($cm_s_result['node'])) {
        $cm_s_nids = array_keys($cm_s_result['node']);
        $cm_s_nodes = entity_load('node', $cm_s_nids);
        foreach ($cm_s_nodes as $cm_s_node) {
          $entire_series_shows_node_array[] = $cm_s_node;
        }
      }
    }
  }
}
// both shows + series
if (isset($show_assoc_partner_array) && isset($entire_series_shows_node_array)) {
  $show_nodes = array_merge($show_assoc_partner_array, $entire_series_shows_node_array);
}
// series only
else if (isset($entire_series_shows_node_array) && empty($show_assoc_partner_array)) {
  $show_nodes = $entire_series_shows_node_array;
}
// show only
else if (isset($show_assoc_partner_array) && empty($entire_series_shows_node_array)) {
  $show_nodes = $show_assoc_partner_array;
}
//dpm($show_nodes);
//
foreach($show_nodes as $show_node) {
  // Build items data array
  $items[$show_node->nid] = array(
    'nid' => $show_node->nid,
    'node' => $show_node,
    'title' => $show_node->title,      
    'timestamp' => $show_node->created,
  );
}
// Sort items
uasort($items, 'partner_featured_video_order_by_timestamp');
//dpm($items);

// Get first item as featured video
$feature_video = reset($items);
$feature_video = $feature_video['node'];
//dpm($feature_video);

// Series meta data
if (isset($feature_video->og_group_ref['und'])) {
  $series_nid = $feature_video->og_group_ref['und'][0]['target_id'];
  $series_title = db_query("SELECT title FROM {node} WHERE nid = :nid", array(':nid' => $series_nid))->fetchField();  
}
else {
  $series_nid = '';
  $series_title = '';
}
// Get iframe data
if (isset($feature_video->field_show_vod['und'])) {        
  switch($feature_video->field_show_vod['und'][0]['filemime']) {
    case 'video/cloudcast':
      $iframe_class = 'media-cloudcast-player';
      // Get param 'video'.
      $iframe_src_param_video = $feature_video->field_show_vod['und'][0]['filename'];
      // Get param 'id'.
      $uri = $feature_video->field_show_vod['und'][0]['uri'];
      $string_pieces = explode('/', $uri);
      $iframe_src_param_id = $string_pieces[3];
      // Build iframe src.
      $iframe_src = 'http://vp.telvue.com/player?wmode=opaque&amp;id=' . $iframe_src_param_id . '&amp;video=' . $iframe_src_param_video . '&amp;noplaylistskin=1&amp;width=400&amp;height=300';
      break;
    case 'video/vimeo':
      $iframe_class = 'media-vimeo-player';
      // Get param 'video'.
      $iframe_src_param_video = $feature_video->field_show_vod['und'][0]['filename'];
      // Get param 'id'.
      $uri = $feature_video->field_show_vod['und'][0]['uri'];
      $string_pieces = explode('/', $uri);
      $iframe_src_param_id = $string_pieces[3];
      // Build iframe src.
      $iframe_src = 'http://player.vimeo.com/video/' . $iframe_src_param_id . '?color=" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""';
      break;
    case 'video/youtube':  
      $iframe_class = 'media-youtube-player';
      $iframe_src_param_video = $feature_video->field_show_vod['und'][0]['filename'];
      // Get param 'id'.
      $uri = $feature_video->field_show_vod['und'][0]['uri'];
      $string_pieces = explode('/', $uri);
      $iframe_src_param_id = $string_pieces[3];
      //dpm($iframe_src_param_id);
      // Build iframe src.
      $iframe_src = 'http://www.youtube.com/embed/' . $iframe_src_param_id . '?controls=1&amp;wmode=opaque&amp;autoplay=0&amp;enablejsapi=0&amp;loop=0&amp;modestbranding=0&amp;rel=1&amp;showinfo=1"';
      break;
  }
}
/**
 * Custom sort function, sorts by node->created)
 */ 
function partner_featured_video_order_by_timestamp($a, $b) {
  //dpm($a);
  return $a['timestamp'] < $b['timestamp'];
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
        <a style="color:#FFF;" href="<?php print url('node/' . $feature_video->nid); ?>">
          <?php print $feature_video->title; ?>
        </a>
        <?php //dpm($node); ?>
        <?php if (isset($feature_video->field_description['und'][0]['value'])): ?>
          <p>
            <?php print custom_block_truncate(strip_tags($feature_video->field_description['und'][0]['value']), $length = 200, $options = array('exact' => FALSE, 'ending' => ' . . .')); ?>
          </p>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>
  <aside class="col-sm-4" role="complementary">        
    <?php //dpm($node); ?>
    <?php //dpm($content); ?>
    <?php print render($content['field_partner_logo_large']); ?>
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