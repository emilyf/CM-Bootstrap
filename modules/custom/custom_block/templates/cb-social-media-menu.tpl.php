<?php //dpm($content); ?>
<ul class="social">
  <?php foreach($content as $menu_item): ?>
    <li>
      <a href="<?php print $menu_item['href']; ?>" class="<?php print $menu_item['options']['attributes']['class'][0]; ?>">
        <span style="display:none;">
          <?php print $menu_item['title']; ?>
        </span>
      </a>
    </li>
  <?php endforeach; ?>
</ul>
