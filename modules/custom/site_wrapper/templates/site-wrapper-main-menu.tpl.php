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
            <?php //dpm($menu['children'][$delta]); ?>
            <li>
               <a href="<?php print url($menu['children'][$delta]['path']);?>"><?php print $menu['children'][$delta]['title']; ?></a>  
            <?php if($menu['children'][$delta]['children']): ?>
              <ul class="third-level">
                <?php foreach($menu['children'][$delta]['children'] as $third_level_delta => $third_level_item): ?>
                <li>
                  <?php //dpm($third_level_item); ?>  
                  <a href="<?php print url($menu['children'][$delta]['children'][$third_level_delta]['path']);?>"><?php print $menu['children'][$delta]['children'][$third_level_delta]['title']; ?></a>
                  
                  
                </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>  
              
           
            </li>
          <?php endforeach; ?>
        </ul>
      </li>
      
      
    <?php endforeach; ?>
  </ul>
</nav>