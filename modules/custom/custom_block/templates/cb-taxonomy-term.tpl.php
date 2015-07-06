<?php //dpm($content); ?>
<div class="main-container container">
  <div class="taxonomy-term-pg">
    <ul class="video-grid-shows">
      <?php foreach($content as $node): ?>  
        <li>
          <a href="<?php print url('node/' . $node['nid']); ?>">        
            <img src="<?php print $node['img_src']; ?>" />
            <span class="overlay">
              <p class="title">
                <?php print $node['title']; ?>
              </p>
              <p class="description">
                <?php //print $show_description; ?>
              </p>
              <span class="series-title" style="font-style:italic;">
                <?php print $node['series_title']; ?>
              </span>
              <span class="watch-now-mobile">Watch Now &raquo;</span>
            </span>
          </a>
        </li>    
      <?php endforeach; ?>
    </ul>
  </div>
  
  <div class="pager-container">
    <?php print render($pager); ?>
  </div>
</div>