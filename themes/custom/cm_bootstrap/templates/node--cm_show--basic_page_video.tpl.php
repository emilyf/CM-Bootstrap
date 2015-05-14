node--cm_show--basic_page_video.tpl.php
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <?php //dpm($yt_url); ?>

  <div class="content"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      //print render($content);
    ?>    
    <?php print render($content); ?>
  </div>




  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>

</div>
