<div id="main">
  <div class="container-fluid navigation">
    <div class="row">
      <?php if (!empty($page['navigation'])): ?>
        <?php print render($page['navigation']); ?>
      <?php endif; ?>
      <!--<div class="col-md-2">
        <a class="jpanel-trigger">
          <span>MENU</span>
        </a>
      </div>-->
    </div>
  </div>
  
  <div id="menu-panel">
    <?php if (!empty($page['jpanel_region'])): ?>
      <?php print render($page['jpanel_region']); ?>
    <?php endif; ?>
  </div>
  
  <div class="container below-navigation">
    <div class="row">
      <?php print render($page['below_navigation']); ?>
      
    </div>
  </div>
  
  
  
  <div class="main-container container">  
    
    <div class="row">
      <?php print render($page['above_content']); ?>
    </div>  
    
    
    
    <div class="row">
  
      <?php if (!empty($page['sidebar_first'])): ?>
        <aside class="col-sm-3" role="complementary">
          <?php print render($page['sidebar_first']); ?>
        </aside>  <!-- /#sidebar-first -->
      <?php endif; ?>
    
       
      <section<?php print $content_column_class; ?>>
        <?php if (!empty($page['highlighted'])): ?>
          <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
        <?php endif; ?>
        <?php if (!empty($breadcrumb)): print $breadcrumb; endif;?>
        <a id="main-content"></a>
        <?php print $messages; ?>
        <?php if (!empty($tabs)): ?>
          <?php print render($tabs); ?>
        <?php endif; ?>
        <?php if (!empty($page['help'])): ?>
          <?php print render($page['help']); ?>
        <?php endif; ?>
        <?php if (!empty($action_links)): ?>
          <ul class="action-links"><?php print render($action_links); ?></ul>
        <?php endif; ?>
        <?php //print render($page['content']); ?>
        <!-- START: Video -->
        <?php
          if (arg(0) == 'node' && is_numeric(arg(1))) {
            $node = node_load(arg(1), $vid = NULL, $reset = TRUE);   
            //dpm($node);
            if (isset($node->field_show_vod['und'])) {        
              switch($node->field_show_vod['und'][0]['filemime']) {
                case 'video/cloudcast':
                  $iframe_class = 'media-cloudcast-player';
                  // Get param 'video'.
                  $iframe_src_param_video = $node->field_show_vod['und'][0]['filename'];
                  // Get param 'id'.
                  $uri = $node->field_show_vod['und'][0]['uri'];
                  $string_pieces = explode('/', $uri);
                  $iframe_src_param_id = $string_pieces[3];
                  // Build iframe src.
                  $iframe_src = 'http://vp.telvue.com/player?wmode=opaque&amp;id=' . $iframe_src_param_id . '&amp;video=' . $iframe_src_param_video . '&amp;noplaylistskin=1&amp;width=400&amp;height=300';
                  break;
                case 'video/vimeo':
                  $iframe_class = 'media-vimeo-player';
                  // Get param 'video'.
                  $iframe_src_param_video = $node->field_show_vod['und'][0]['filename'];
                  // Get param 'id'.
                  $uri = $node->field_show_vod['und'][0]['uri'];
                  $string_pieces = explode('/', $uri);
                  $iframe_src_param_id = $string_pieces[3];
                  // Build iframe src.
                  $iframe_src = 'http://player.vimeo.com/video/' . $iframe_src_param_id . '?color=" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""';
                  break;
                case 'video/youtube':  
                  $iframe_class = 'media-youtube-player';
                  $iframe_src_param_video = $node->field_show_vod['und'][0]['filename'];
                  // Get param 'id'.
                  $uri = $node->field_show_vod['und'][0]['uri'];
                  $string_pieces = explode('/', $uri);
                  $iframe_src_param_id = $string_pieces[3];
                  //dpm($iframe_src_param_id);
                  // Build iframe src.
                  $iframe_src = 'http://www.youtube.com/embed/' . $iframe_src_param_id . '?controls=1&amp;wmode=opaque&amp;autoplay=0&amp;enablejsapi=0&amp;loop=0&amp;modestbranding=0&amp;rel=1&amp;showinfo=1"';
                  break;
              }
            }
            // Series meta data
            if (isset($node->og_group_ref['und'])) {
              $series_nid = $node->og_group_ref['und'][0]['target_id'];
              $series_title = db_query("SELECT title FROM {node} WHERE nid = :nid", array(':nid' => $series_nid))->fetchField();  
            }
            else {
              $series_nid = '';
              $series_title = '';
            }
            // Genres/Topics data
            if (isset($node->field_genres['und'])) {
              foreach($node->field_genres['und'] as $genre) {
                $genre_title = db_query("SELECT title FROM {node} WHERE nid = :nid", array(':nid' => $genre['target_id']))->fetchField(); 
                $genres[] = array(
                  'nid' => $genre['target_id'],
                  'title' => $genre_title
                );
              }
            }
            //dpm($genres);
          }
        ?>
        <?php if (isset($iframe_src)): ?>
          <div class="video-container">          
            <iframe class="<?php print $iframe_class; ?>" width="640" height="390" src="<?php print $iframe_src; ?>" frameborder="0" allowfullscreen=""></iframe>
          </div>
          <div class="show-meta">
            <a class="meta-series-title" href="<?php print url('node/' . $series_nid); ?>">
              <?php print $series_title; ?>
            </a>
            <a class="meta-node-title" style="color:#FFF;" href="<?php print url('node/' . $node->nid); ?>">
              <?php print $node->title; ?>
            </a>
            <div class="genres-section">
              <span class="genres-label">Topics:</span>
              <?php foreach($genres as $genre_item): ?>
                <a href="<?php print url('node/' . $genre_item['nid']); ?>">
                  <?php print $genre_item['title']; ?>
                </a>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>
        <!-- END: Video -->
      </section>
  
      <?php if (!empty($page['sidebar_second'])): ?>
        <aside class="col-sm-3" role="complementary">
          <?php print render($page['sidebar_second']); ?>
        </aside>  <!-- /#sidebar-second -->
      <?php endif; ?>
  
    </div>
  </div>
  
  <?php if ($page['below_content_fwidth']): ?>
    <div class="main-container-below-content container">  
      <div class="row">
        <?php print render($page['below_content_fwidth']); ?>
      </div>  
    </div>
  <?php endif; ?>
  
  <?php if ($page['below_content']): ?>
    <div class="main-container-below-content container-fluid">  
      <div class="row">
        <?php print render($page['below_content']); ?>
      </div>  
    </div>
  <?php endif; ?>
  
  <footer class="footer container-fluid">
    <div class="row">
      <?php print render($page['footer']); ?>
    </div>
  </footer>
  
  <footer class="footer-bottom container-fluid">
    <div class="container">
      <div class="row">
        <div class="contact-info-container col-md-12">
          <?php print render($page['footer_bottom']); ?>
        </div>
      </div>
  </footer>
</div>

<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>

