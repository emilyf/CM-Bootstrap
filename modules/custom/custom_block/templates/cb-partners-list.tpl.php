<?php //dpm($content);?>

<h2 class="block-title">
  Partner Channels
  <p>Watch videos produced by these partner organizations.</p>
</h2>

<section class="c-flexslider-video-carousel">
  <div class="flexslider carousel">
    <ul class="slides">
      <?php foreach($content as $node): ?>
        <?php //dpm($node); ?>
        <li>
          <a href="<?php print url('node/' . $node['nid']); ?>">
            <img src="<?php print $node['img']; ?>" />
            <span class="overlay" style="background-color:<?php //print $node['bg-color'];?>;" data-accent-color="<?php //print $node['accent-color'];?>">
              <span class="play-button">
                <i class="icon glyphicon glyphicon-play-circle" aria-hidden="true"></i>
              </span>
              <p class="title">
                <?php print $node['title']; ?>
              </p>
              <?php //print $node['sub_title']; ?>
              <p class="description">
                <?php print $node['description']; ?>
              </p>
              <span class="watch-now">Watch Now &raquo;</span>
            </span>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>