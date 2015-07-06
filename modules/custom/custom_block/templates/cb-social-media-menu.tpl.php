<?php //dpm($content); ?>
<ul class="social">
  <?php foreach($content as $menu_item): ?>
    <?php 
      if (isset($menu_item['options']['attributes']['target'])) {
        $target = $menu_item['options']['attributes']['target'];
      }
      else {
        $target = '_self';
      }
    ?>
    <li>
      <a href="<?php print $menu_item['href']; ?>" class="<?php print $menu_item['options']['attributes']['class'][0]; ?>" target="<?php print $target; ?>">
        <span style="display:none;">
          <?php print $menu_item['title']; ?>
        </span>
      </a>
    </li>
  <?php endforeach; ?>
</ul>
