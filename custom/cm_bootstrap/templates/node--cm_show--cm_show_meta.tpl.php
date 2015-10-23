<?php //dpm($content); ?>

<?php //print render($content['field_show_vod']); ?>
<div class="row">
  <section class="col-md-12 no-padding top-section">
    <div class="row">
      <div class="col-md-9 no-padding">
        <h1 class="page-header">
          <?php print $node->title; ?>
        </h1>
      </div>
      <div class="col-md-3 no-padding">
        <div class="flag-container">
          <?php //print flag_create_link('cf_like_show', $node->nid); ?>
        </div>
      </div>
    </div>
  </section>
  <section class="col-sm-8">
    <!-- START: Social Media Block -->
    <?php $social_media_block = module_invoke('widgets', 'block_view', 's_socialmedia_share-default'); ?>
    <?php if (isset($social_media_block)): ?>
      <?php print render($social_media_block['content']); ?>
    <?php endif; ?>
    <!-- END: Social Media Block -->
    <?php hide($content['field_show_vod']); ?>
    <?php hide($content['group_sidebar']); ?>
    <?php print render($content); ?>
  </section>
  <aside class="col-sm-4" role="complementary">   
    <?php print render($content['group_sidebar']); ?>       
  </aside>
</div>