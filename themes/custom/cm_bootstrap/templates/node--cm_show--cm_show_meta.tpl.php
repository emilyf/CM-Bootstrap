<?php //dpm($content); ?>

<?php //print render($content['field_show_vod']); ?>
<div class="row">
  <h1 class="page-header"><?php print $node->title; ?></h1>
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