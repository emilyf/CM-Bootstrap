<?php //dpm($content); ?>
<section class="slider">
  <div class="flexslider carousel">
    <ul class="front-pg-slider-items slides">
      <?php foreach($content as $node): ?>
        <li>
          <a href="<?php print '/node/' . $node['nid']; ?>">
            <span class="title-container">
              <span class="title">
                <?php print $node['title']; ?> &raquo;
              </span>
            </span>
            <img src="<?php print $node['img']; ?>" />
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
