<section class="c-flexslider-video-carousel slider-cvl-partners-carousels">
  <div class="flexslider carousel">
    <ul class="cvlpc-carousel slides">
      <?php foreach($content as $node): ?> 
        <?php //dpm($video_item); ?>       
        <li>
          <a href="<?php print url('node/' . $node['nid']); ?>">              
            <img src="<?php print $node['series_img'];?>"/>
            <span class="overlay">
              <span class="play-button">
                <i class="icon glyphicon glyphicon-play-circle" aria-hidden="true"></i>
              </span>
              <p class="title">
                <?php print $node['title']; ?>
              </p>
              <span class="watch-now-mobile">Watch Now &raquo;</span>
            </span>
          </a>  
        </li>      
      <?php endforeach; ?>
    </ul>
  </div>
</section>