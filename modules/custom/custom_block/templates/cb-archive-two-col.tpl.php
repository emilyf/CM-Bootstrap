<?php //dpm($items); ?>
<?php 
  if (arg(0) == 'node' && is_numeric(arg(1))) {
    $archive_node = node_load(arg(1));
    //dpm($archive_node);
    if (isset($archive_node->field_archive_more_copy['und'][0]['value'])) {
      $archive_link_copy = $archive_node->field_archive_more_copy['und'][0]['value'];
    }
    else {
      $archive_link_copy = 'More';
    }
  }
?>
<ul class="two-col-list">
  <?php $i = 0; ?>  
  <?php foreach($items as $node): ?>
    <li class="item-<?php print $i++%4; ?> <?php print $node['type']; ?>">
      <div class="container">
        <div class="left">
          <!--<span class="overlay">-->
            <img src="<?php print $node['img']; ?>" />
          <!--</span>-->
        </div>
        <div class="right">
          <div class="inner">
            <?php if (isset($node['datetime'])): ?>
              <div class="datetime">
                <?php print $node['datetime']; ?>
              </div>
            <?php endif; ?>
            <h2><?php print $node['title']; ?></h2>
            <div class="description-container">
              <?php print $node['description']; ?>
            </div>
            <a href="<?php print url('node/' . $node['nid']); ?>" class="learn-more">
              <?php print $archive_link_copy; ?> »</a>
            </a>
          </div>
        </div>
      </div>
    </li>
  <?php endforeach; ?>
</ul>

<?php if (!empty($pager)): ?>
  <?php //dpm_gettype($pager); ?>
  <?php print $pager; ?>
<?php endif; ?>