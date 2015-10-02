<div class="row">
  <?php //dpm($content); ?>      
  <?php $content['body']['#label_display'] = 'hidden'; ?>
  <?php print render($content['body']); ?>
</div>
