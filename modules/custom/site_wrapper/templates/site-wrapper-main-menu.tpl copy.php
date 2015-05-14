<?php //dpm($content); ?>
<nav id ="site-wrapper-main-menu">
  <ul class="first-level">
    <?php $i = 1; ?>
    <?php foreach($content as $menu): ?>
      <?php //dpm($menu); ?>      
      <li class="item-<?php print $i++; ?>">
        <a href="<?php print url($menu['path']);?>"><?php print $menu['title'];?></a>
        <ul class="second-level">
          <?php foreach($menu['children'] as $delta => $item): ?>
            <?php //dpm($item); ?>
            <li>
              <a href="<?php print url($menu['children'][$delta]->link_path);?>"><?php print $menu['children'][$delta]->link_title; ?></a>
            </li>
          <?php endforeach; ?>
        </ul>
      </li>
    <?php endforeach; ?>
  </ul>
</nav>