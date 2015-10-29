<!doctype html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="<?php bloginfo('charset'); ?>">

<title><?php wp_title('|',true,'right'); bloginfo('name'); ?></title>

<!-- meta -->

  	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame  -->
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  	<meta name="google-site-verification" content="yT0eDZAaWF8vL_3XpW70UMDDiao58BRVyuvPrqKQvH4" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Design by Modern Activity, Build by Patrick Best, Typography by StormType, Entypo pictograms by Daniel Bruce www.entypo.com">

	<meta name="description" content="<?php bloginfo('description'); ?>">

<!-- social graph meta -->
<!-- 	<meta name="twitter:site" value="@">	 -->
	<?php if (have_posts()):while(have_posts()):the_post(); endwhile; endif;
		$excerpt = get_the_excerpt();
		if(has_post_thumbnail()) { $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'opengraph' ); ?>
	<meta property="og:image" content="<?php echo $thumb['0'] ?>" />
		<?php } else { ?>
	<meta property="og:image" content="<?php bloginfo('stylesheet_directory'); ?>/img/favicon.png" />
		<?php }
		if (is_home()) { ?>
	<meta property="og:title" content="<?php bloginfo('name'); ?>" />
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:description" content="<?php bloginfo('description'); ?>" />
	<meta name="twitter:card" value="<?php bloginfo('description'); ?>">
<?php } elseif (is_single()) { ?>
	<meta property="og:url" content="<?php the_permalink() ?>"/>
	<meta property="og:title" content="<?php single_post_title(''); ?>" />
	<meta property="og:description" content="<?php echo $excerpt ?>" />
	<meta name="twitter:card" value="<?php echo $excerpt ?>">
	<meta property="og:type" content="article" />
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
<?php } else { ?>
	<meta property="og:title" content="<?php single_post_title(''); ?>" />
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
	<meta property="og:description" content="<?php bloginfo('description'); ?>" />
	<meta name="twitter:card" value="<?php bloginfo('description'); ?>">
	<meta property="og:type" content="website" />
<?php } ?>

<!-- links -->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />

	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/favicon.ico">
	<link rel="shortcut" href="<?php bloginfo('stylesheet_directory'); ?>/img/favicon.ico">
	<link rel="apple-touch-icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/favicon-touch.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('stylesheet_directory'); ?>/img/favicon.png">

  <script src="<?php bloginfo('stylesheet_directory'); ?>/js/modernizr.js"></script>
	<script type="text/javascript">
		Modernizr.load([
			{
				test: Modernizr.mq('only all'),
				nope: "<?php bloginfo('stylesheet_directory'); ?>/js/polyfills/mediaqueries.js"
			}
		]);
	</script>
	<!-- wordpress header -->
	 <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
</head>

<!-- start page -->
<body <?php body_class(); ?>>
<section id="container" class="cf">
<!-- sub 7.0 internet explorer warning-->

<!--[if lt IE 7 ]>The website will not work properly on Internet Explorer versions older than 7 as they are outdated, instable and insecure. Free (and improved) browsers can be downloaded for free: <a href="www.google.com/chrome">Google Chrome</a>, <a href="www.getfirefox.net/">Mozilla Firefox</a>, or <a href="www.apple.com/safari/">Apple Safari</a> <![endif]-->

<!-- start content -->

<div id="top-bar">
	<div id="top-bar-inner"></div>
	<div id="top-bar-gradient"></div>
</div>

<nav id="menu">
<div class="fixed">

	<a href="<?php echo home_url(); ?>"><img id="logo" src="<?php bloginfo('stylesheet_directory'); ?>/img/masterG_78px.gif"></a>

	<div id="menu-content">
  	<div>
  		<h3>Gresford Architects</h3>
  		<?php
  			$about = get_page_by_title('About Us');
  			$meta = get_post_meta($about->ID);
  			echo wpautop($meta['_cmb_sidebartext'][0]);
  		?>
  	</div>

  	<ul id="links" <?php
  		$cat = sanitize_title(single_cat_title( null, false ));
  		if (!empty($cat)) {
  			echo 'data-cat="category-' . $cat . '"';
  		}
  	?>>
  		<li class="cat-item category-extensions-restorations"><a href="<?php echo home_url('/category/extensions-restorations/'); ?>" title="View all posts filed under Extensions &amp; Restorations">Extensions &amp; Restorations</a></li>
  		<li class="cat-item category-housing-urbanism"><a href="<?php echo home_url('/category/housing-urbanism/'); ?>" title="View all posts filed under Housing">Housing  &amp; Urbanism</a></li>
  		<li class="cat-item category-houses"><a href="<?php echo home_url('/category/houses/'); ?>" title="View all posts filed under New Houses">Houses</a></li>
  		<li class="cat-item category-all"><a href="<?php echo home_url('/category/all/'); ?>" title="View all posts">All Projects</a></li>
  		<li>&nbsp;</li>
  		<li></li>
  		<li <?php if (is_page('sustainability-passivhaus')) {echo 'class="current"';} ?>><a href="<?php echo home_url('/sustainability-passivhaus'); ?>">Passivhaus & Sustainability</a></li>
  		<li <?php if (is_post_type_archive('news')) {echo 'class="current"';} ?>><a href="<?php echo home_url('/news'); ?>">News & Press</a></li>
  		<li <?php if (is_page('about-us')) {echo 'class="current"';} ?>><a href="<?php echo home_url('/about-us'); ?>">About Us</a></li>
  	</ul>
	</div>

</div>
</nav>