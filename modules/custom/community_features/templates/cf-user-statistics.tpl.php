<script>
(function ($, Drupal) { 
  $(function () {
    setNavigation();
  });
  
  function setNavigation() {
    var path = window.location.pathname;
    path = path.replace(/\/$/, "");
    path = decodeURIComponent(path);
    
    $("ul.user-statistics li a").each(function () {
      var href = $(this).attr('href');
      //console.log('href:' + href);
      if (path.substring(0, href.length) === href) {
        $(this).closest('li').addClass('active');
      }
    });
  }
})(jQuery, Drupal);
</script>
<?php //dpm($content); ?>

<ul class="user-statistics">
  <li class="user-videos">
    <a href="/users/<?php print $content['user_name']; ?>">
      <div class="statistic">
        <?php if (isset($content['video_count'])): ?>
          <?php print $content['video_count']; ?>
        <?php else: ?>
          <?php print '0'; ?>
        <?php endif; ?>
      </div>
      Videos
    </a>
  </li>
  <li class="user-likes">
    <a href="/user/<?php print $content['uid']; ?>/likes">
      <div class="statistic">
        <?php print $content['likes_count']; ?>
      </div>
      Likes
    </a>
  </li>
  <li class="user-follows">
    <a href="/user/<?php print $content['uid']; ?>/followers">
      <div class="statistic">
        <?php print $content['followers_count']; ?>
      </div>
      Followers
    </a>
  </li>
  <li class="user-following">
    <a href="/user/<?php print $content['uid']; ?>/following">
      <div class="statistic">
        <?php print $content['following_count']; ?>
      </div>
      Following
    </a>
  </li>
</ul>