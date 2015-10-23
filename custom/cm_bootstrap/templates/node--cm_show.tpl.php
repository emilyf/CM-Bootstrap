<style>
  .default-image {
    width:100%;
    height:auto;
  }
</style>

<?php //dpm($content); ?>

<?php print render($content); ?>

<?php if (!isset($content['field_show_vod'])): ?>
  <?php 
    if (module_exists('site_cp_default_images')) {
      $file = site_cp_default_images_load_image($node->type);
      //dpm($file);
      $image_uri = $file->uri;
      $default_image = image_style_url('site_cp_default_images_cm_show_video', $image_uri);
    }
  ?>
  <div class="fluid-width-video-wrapper">
    <img class="default-image" src="<?php print $default_image; ?>"/>
  </div>
<?php endif; ?>

<?php
  // Series meta data
  if (isset($node->og_group_ref['und'])) {
    $series_nid = $node->og_group_ref['und'][0]['target_id'];
    $series_title = db_query("SELECT title FROM {node} WHERE nid = :nid", array(':nid' => $series_nid))->fetchField();  
  }
  else {
    $series_nid = '';
    $series_title = '';
  }
  // Genres/Topics data
  if (isset($node->field_genres['und'])) {
    foreach($node->field_genres['und'] as $genre) {
      $genre_title = db_query("SELECT title FROM {node} WHERE nid = :nid", array(':nid' => $genre['target_id']))->fetchField(); 
      $genres[] = array(
        'nid' => $genre['target_id'],
        'title' => $genre_title
      );
    }
  }
?>

<div class="show-meta">
  <div class="row">
    <div class="col-md-10 col-xs-10 no-padding">
      <a class="meta-series-title" href="<?php print url('node/' . $series_nid); ?>">
        <?php print $series_title; ?>
      </a>
      <a class="meta-node-title" style="color:#FFF;" href="<?php print url('node/' . $node->nid); ?>">
        <?php print $node->title; ?>
      </a>
      <?php if (isset($genres)): ?>
        <div class="genres-section">
          <span class="genres-label">Topics:</span>
          <?php foreach($genres as $genre_item): ?>
            <a href="<?php print url('node/' . $genre_item['nid']); ?>">
              <?php print $genre_item['title']; ?>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="col-md-2 col-xs-2 no-padding">
      <div class="flag-container pull-right">
        <?php print flag_create_link('cf_like_show', $node->nid); ?>
      </div>
    </div>
  </div>
</div>