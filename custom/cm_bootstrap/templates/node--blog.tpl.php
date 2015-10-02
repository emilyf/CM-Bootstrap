<?php //dpm($content); ?>

<?php hide($content['links']); ?>

<?php //dpm($node); ?>

<div class="blog-date">
  <?php print date('F j, Y', $node->created); ?>
</div>

<?php print render($content); ?>
