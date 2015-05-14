<div role="tabpanel">
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
      <a href="#chapters" aria-controls="chapters" role="tab" data-toggle="tab">Chapters</a>
    </li>   
    <li role="presentation">
      <a href="#airdate" aria-controls="airdate" role="tab" data-toggle="tab">Air Date</a>
    </li>     
  </ul>
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="chapters">
      <?php $chapters_view = views_embed_view($name = 'chapters_block', $display_id = 'default'); ?> 
      <?php print $chapters_view; ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="airdate">
      <?php //$airdate_view = views_embed_view($name = 'show_air_date', $display_id = 'block_1'); ?> 
      <?php //print $airdate_view; ?>
      <!-- START: Air Date Block -->
      <?php $air_date_block = module_invoke('custom_block', 'block_view', 'cb_show_air_dates'); ?>
      <?php if (isset($air_date_block)): ?>
        <?php print render($air_date_block['content']); ?>
      <?php endif; ?>
      <!-- END: Air Date Block -->
    </div>
  </div>
</div>
<ul class="bottom-buttons">
  <li class="left">
    <a href="#" class="airdate">Request Air Date</a>
  </li>
  <li class="right">
    <a href="#" class="order"> Order a Copy</a>
  </li>
</ul>