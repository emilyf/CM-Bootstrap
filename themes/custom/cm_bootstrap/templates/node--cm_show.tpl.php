<?php //dpm($content); ?>

<?php print render($content); ?>

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