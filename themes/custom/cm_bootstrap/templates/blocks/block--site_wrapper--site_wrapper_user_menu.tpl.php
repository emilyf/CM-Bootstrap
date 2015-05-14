<div id="<?php print $block_html_id; ?>" class="col-md-4  <?php print $classes; ?>"<?php print $attributes; ?>>
  <div class="user-menu-naviation">
    <?php print render($title_prefix); ?>
  
    <?php if ($block->subject): ?>
      <h2<?php print $title_attributes; ?>><?php print $block->subject ?></h2>
    <?php endif;?>
    <?php print render($title_suffix); ?>
  
    <?php print $content ?>
    
    
    <a class="jpanel-trigger"></a>
    
    <a class="jpanel-user-login" href="/user/login">Login</a>
  </div>
</div>