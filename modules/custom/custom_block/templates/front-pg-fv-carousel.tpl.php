<?php //dpm($content); ?>
<section class="c-flexslider-video-carousel">
  <div class="flexslider carousel">
    <ul class="slides">
      <?php foreach($content as $node): ?>
        <li>
          <a href="<?php print url('node/' . $node['nid']); ?>">
            <img src="<?php print $node['img']; ?>" />
            <span class="overlay">
              <span class="play-button">
                <i class="icon glyphicon glyphicon-play-circle" aria-hidden="true"></i>
              </span>
              <p class="title">
                <?php print $node['title']; ?>
              </p>
              <p class="description">
                <?php //print $node['description']; ?>
              </p>
              
              <!--<p class="series">
                Series: <?php //print $node['series']; ?>
              </p>-->
              
              <!--<span class="play-button">
                <i class="icon glyphicon glyphicon-play-circle" aria-hidden="true"></i>
              </span>-->
              <?php if (!empty($node['series_title'])): ?>
                <span class="series-title" style="font-style:italic;"><?php print $node['series_title']; ?></span>
              <?php endif; ?>
              <span class="watch-now-mobile">Watch Now &raquo;</span>
            </span>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
