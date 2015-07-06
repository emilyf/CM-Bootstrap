<?php //dpm($content); ?>

<style>
.node-type-cm-show .region-sidebar-second .tab-content {
  padding:0;
}
ul.cb-show-recent-videos {
  padding:0;
  margin:0;
  list-style-type:none;
  font-size:.75em;
}
ul.cb-show-recent-videos li {
  display:block;
  clear: both;
  margin-bottom:1px;
}
ul.cb-show-recent-videos li a .left {
}
ul.cb-show-recent-videos li a .right {
  padding:10px !important;
  background:#000;
  color:#FFF;
  height:103px;
}
ul.cb-show-recent-videos li a:hover .right {
  background:red;
  -webkit-transition: 250ms ease-out;
  -moz-transition: 250ms ease-out;
  -o-transition: 250ms ease-out;
  transition: 250ms ease-out;
}
ul.cb-show-recent-videos li a img {
  width: 100%;
  display: block;
}
ul.cb-show-recent-videos li .series-title {
  position:inherit;
  display:block;
}
ul.cb-show-recent-videos li .watch-now-link {
  display: block;
  text-transform: uppercase;
  position: absolute;
  bottom: 10px;
}
</style>


<ul class="cb-show-recent-videos">
  <?php foreach($content as $node): ?>
    <li class="row">
      <a href="<?php print url('node/' . $node['nid']); ?>">
        <span class="left col-md-6 no-padding">
          <img src="<?php print $node['img']; ?>" />   
        </span>         
        <span class="right col-md-6 no-padding">
          <p class="title">
            <?php print $node['title']; ?>
          </p>
          <!--<p class="series">
            Series: <?php print $node['series']; ?>
          </p>-->
          <!--<span class="play-button">
            <i class="icon glyphicon glyphicon-play-circle" aria-hidden="true"></i>
          </span>-->
          <span class="series-title" style="font-style:italic;"><?php print $node['series_title']; ?></span>
          <span class="watch-now-link">Watch Now &raquo;</span>
        </span>
      </a>
    </li>
  <?php endforeach; ?>
</ul>