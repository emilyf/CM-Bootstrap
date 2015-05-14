<?php //dpm($items); ?>

<ul class="two-col-list">
  <?php $i = 1; ?>  
  <?php foreach($items as $item): ?>
    <li class="item-<?php print $i++; ?>">
      <?php print render($item[0]); ?>
    </li>
  <?php endforeach; ?>
</ul>