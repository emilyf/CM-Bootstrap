<?php //dpm($content); ?>
<section class="slider-fpfvbc">
  <div class="flexslider carousel">
    <ul class="fv-carousel slides">
      <?php foreach($content as $node): ?>
        <li>
          <a href="<?php print url('node/' . $node['nid']); ?>">
            
            <span class="play-button">
              <i class="icon glyphicon glyphicon-play-circle" aria-hidden="true"></i>
            </span>
            
            
            <span class="overlay" style="background-color:<?php print $node['bg-color'];?>;" data-accent-color="<?php print $node['accent-color'];?>">
              <?php print $node['title']; ?>
              
              <p class="description">
                <?php print $node['description']; ?>
              </p>
              
              <p class="series">
                Series: <?php print $node['series']; ?>
              </p>
              
              <!--<span class="play-button">
                <i class="icon glyphicon glyphicon-play-circle" aria-hidden="true"></i>
              </span>-->
              
              <span class="watch-now">Watch Now >
              </span>
            </span>
            <img src="<?php print $node['img']; ?>" />
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
