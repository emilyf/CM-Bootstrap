<?php $cb_show_recent_videos_block = module_invoke('custom_block', 'block_view', 'cb_show_recent_videos'); ?>
<?php $cb_show_air_dates_block = module_invoke('custom_block', 'block_view', 'cb_show_air_dates'); ?>
<?php $cb_show_chapters_block = module_invoke('custom_block', 'block_view', 'cb_show_chapters'); ?>

<div role="tabpanel">
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="recent-videos active">
      <a href="#recent-video" aria-controls="recent-video" role="tab" data-toggle="tab">Recent Videos</a>
    </li>  
    <?php if (!empty($cb_show_chapters_block['content'])): ?>
    <li role="presentation" class="chapters">
      <a href="#chapters" aria-controls="chapters" role="tab" data-toggle="tab">Chapters</a>
    </li>
    <?php endif; ?>   
    <?php //if (!empty($cb_show_air_dates_block['content'])): ?>
      <li role="presentation" class="airdate">
        <a href="#airdate" aria-controls="airdate" role="tab" data-toggle="tab">Air Date</a>
      </li>  
    <?php //endif; ?>  
  </ul>
  <div class="tab-content">
    <?php if (!empty($cb_show_recent_videos_block['content'])): ?>
      <div role="tabpanel" class="tab-pane active" id="recent-video">
        <?php print render($cb_show_recent_videos_block['content']); ?>
      </div>
    <?php endif; ?>
    <?php if(!empty($cb_show_chapters_block['content'])): ?>
      <div role="tabpanel" class="tab-pane" id="chapters">
        <?php print render($cb_show_chapters_block['content']); ?>
      </div>
    <?php endif; ?>
      <div role="tabpanel" class="tab-pane" id="airdate">
        <?php if (!empty($cb_show_air_dates_block['content'])): ?>
          <?php print render($cb_show_air_dates_block['content']); ?>
        <?php else: ?>
          <p style="padding:10px;">No airdates added yet.</p>
        <?php endif; ?>
      </div>
  </div>
</div>

<?php $show_buttons = site_cp_show_buttons_get(); ?>
<?php if(isset($show_buttons)): ?>
  <ul class="bottom-buttons">  
  <?php foreach($show_buttons as $show_button): ?>
    <li>
      <?php //dpm($show_button); ?>
      <a href="<?php print $show_button->url; ?>">
        <span class="glyphicon <?php print $show_button->icon_class; ?>" aria-hidden="true"></span>
        <?php print $show_button->title; ?>
      </a>
    </li>
  <?php endforeach; ?>
  </ul>
<?php endif; ?>
