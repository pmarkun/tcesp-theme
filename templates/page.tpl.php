<?php

/**
 * @file
 * Displays a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $css: An array of CSS files for the current page.
 * - $directory: The directory the theme is located in, e.g. themes/garland or
 *   themes/garland/minelli.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Page metadata:
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or
 *   'rtl'.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   element.
 * - $head: Markup for the HEAD element (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $body_classes: A set of CSS classes for the BODY tag. This contains flags
 *   indicating the current layout (multiple columns, single column), the
 *   current path, whether the user is logged in, and so on.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled in
 *   theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $mission: The text of the site mission, empty when display has been
 *   disabled in theme settings.
 *
 * Navigation:
 * - $search_box: HTML to display the search box, empty if search has been
 *   disabled.
 * - $primary_links (array): An array containing primary navigation links for
 *   the site, if they have been configured.
 * - $secondary_links (array): An array containing secondary navigation links
 *   for the site, if they have been configured.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $left: The HTML for the left sidebar.
 * - $breadcrumb: The breadcrumb trail for the current page.
 * - $title: The page title, for use in the actual HTML content.
 * - $help: Dynamic help text, mostly for admin pages.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs: Tabs linking to any sub-pages beneath the current page (e.g., the
 *   view and edit tabs when displaying a node).
 * - $content: The main content of the current Drupal page.
 * - $right: The HTML for the right sidebar.
 * - $node: The node object, if there is an automatically-loaded node associated
 *   with the page, and the node ID is the second argument in the page's path
 *   (e.g. node/12345 and node/12345/revisions, but not comment/reply/12345).
 *
 * Footer/closing data:
 * - $feed_icons: A string of all feed icons for the current page.
 * - $footer_message: The footer message as defined in the admin settings.
 * - $footer : The footer region.
 * - $closure: Final closing markup from any modules that have altered the page.
 *   This variable should always be output last, after all other dynamic
 *   content.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 */

	 function filesInDir($dir) {
	    $results = array();
	    $handler = opendir($dir);

	    while ($file = readdir($handler)) {
	      if ($file != "." && $file != "..") {
	        $results[] = $file;
	      }
	    }

	    closedir($handler);
			return $results;
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; ?>
  <script type="text/javascript"><?php /* Needed to avoid Flash of Unstyled Content in IE */ ?> </script>
</head>
<body class="<?php print $body_classes; ?>">

  <div id="page">
   <div id="above">
       <div id="name-and-slogan">

      <?php if (!empty($logo)): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
        </a>
    <?php endif; ?>
    <?php if (!empty($site_name)): ?>
      <h1 id="site-name" style="font-family:'Amaranth';">
        <a href="<?php print $front_page ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
      </h1>
    <?php endif; ?>

    <?php if (!empty($search_box)): ?>
      <div id="search-box"><?php print $search_box; ?></div>
    <?php endif; ?>
  </div> <!-- /name-and-slogan -->
  
    <?php if (!empty($secondary_links)): ?>
      <div id="secondary" class="clear-block items-<?php print count($secondary_links); ?>">
        <?php print theme('menu_tree', menu_tree('secondary-links')); ?>
      </div>
      
    <?php endif; ?>

  </div> <!-- /above -->

   <div id="header">

      <?php if (!empty($header)): ?>
        <div id="header-region">
          <?php print $header; ?>
        </div>
      <?php endif; ?>

	<!--resultados das sessões-->
	<?php if($resultados): ?>
	<? if (empty($node)): ?>
		<div id="resultados">
		<?php print $resultados; ?>
		</div>
	<? endif; ?>
	<?php endif; ?>

    </div> <!-- /header -->

    <div id="container" class="clear-block">

      <?php if (!empty($primary_links) || !empty($sidebar_first)): ?>
        <div id="sidebar-left" class="column sidebar">
        <?php if (!empty($primary_links)): ?>
          <div id="primary" style="list-style: none;" class="clear-block items-<?php print count($primary_links); ?>">
          <!--  <?php print theme('links', tcesp_clean_navigation(menu_tree_page_data('primary-links')), 
array('class' 
=> 'links primary-links')); ?> -->
         <?php $menu_name = variable_get('menu_primary_links_source', 'primary-links');
            print menu_tree($menu_name); ?>
          </div>
        <?php endif; ?>   
        <?php print $sidebar_first; ?>
        </div> <!-- /sidebar-left -->
      <?php endif; ?>

      <div id="main" class="column"><div id="main-squeeze">
        <?php if (!empty($mission)): ?><div id="mission"><?php print $mission; ?></div><?php endif; ?>

        <?php if($content_top): ?>
          <div id="content-top">
            <?php print $content_top; ?>
          </div>
        <?php endif; ?>

        <div id="content">
          <?php if (!empty($node)): ?>
            <div class="meta">
              <?php if (!empty($meta_date)) print '<span class="content-date">' . $meta_date . '</span>';  ?>
            </div>
          <?php endif; ?>
          <?php if (!empty($title)): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
          <?php if (!empty($tabs)): ?><div class="tabs"><?php print $tabs; ?></div><?php endif; ?>
          <?php if (!empty($messages)): print $messages; endif; ?>
          <?php if (!empty($help)): print $help; endif; ?>
          <div id="content-content" class="clear-block">
 
            <?php print $content; ?>
          </div> <!-- /content-content -->
          <?php print $feed_icons; ?>
        </div> <!-- /content -->

					
          <?php if($content_bottom): ?>
            <div id="content-bottom">
              <?php print $content_bottom; ?>
            </div>
          <?php endif; ?>

      </div></div> <!-- /main-squeeze /main -->

    </div> <!-- /container -->

	<!--banners-->
          <?php if($rodapebanners): ?>
            <div id="banners">
              <?php print $rodapebanners; ?>
            </div>
          <?php endif; ?>

    <?php if($page_bottom): ?>
    <div id="page-bottom" style="list-style: none;" class="<?php print $page_bottom_block_count; ?>">
        <?php print $page_bottom; ?>
    </div>
    <?php endif; ?>
		
    <div id="footer-wrapper">
      <div id="footer">
        <?php print $footer_message; ?>
        <?php if (!empty($footer)): print $footer; endif; ?>
      </div> <!-- /footer -->
    </div> <!-- /footer-wrapper -->

    <?php print $closure; ?>

  </div> <!-- /page -->

</body>
</html>
