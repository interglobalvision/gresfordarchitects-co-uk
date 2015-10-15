<?php

function scripts_and_styles_method() {

  $templateuri = get_template_directory_uri() . '/js/';

  // library.js is to bundle plugins. my.js is your scripts. enqueue more files as needed
  $jslib = $templateuri."library.js";
  wp_enqueue_script( 'jslib', $jslib,'','',true);
  $myscripts = $templateuri."main.js";
  wp_enqueue_script( 'myscripts', $myscripts,'','',true);

  // enqueue stylesheet here. file does not exist until stylus file is processed
  wp_enqueue_style( 'site', get_stylesheet_directory_uri() . '/css/site.css' );

  // dashicons for admin
  if(is_admin()){
    wp_enqueue_style( 'dashicons' );
  }

}
add_action('wp_enqueue_scripts', 'scripts_and_styles_method');

/*
function my_scripts_method() {
    wp_deregister_script( 'jquery' );

    wp_register_script( 'jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js');
    wp_enqueue_script('jquery','','','',true);

    $templateuri = get_template_directory_uri() . '/js/';

    $localjq = $templateuri."jquery-1.8.1.min.js";

    $jslib = $templateuri."lib.js";
    wp_enqueue_script( 'jslib', $jslib,'','',true);

    $myscripts = $templateuri."my.js";
    wp_enqueue_script( 'myscripts', $myscripts,'','',true);
}
add_action('wp_enqueue_scripts', 'my_scripts_method');
*/


if ( function_exists( 'add_theme_support' ) ) {
  	add_theme_support( 'post-thumbnails' );
}

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'mason', 280, 9999, false );
	add_image_size( 'single', 860, 600, false );
	add_image_size( 'home', 860, 300, true );
}

remove_shortcode('gallery', 'gallery_shortcode');
function my_gallery_shortcode($attr) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'li',
		'icontag'    => 'li',
		'captiontag' => 'div',
		'columns'    => 3,
		'size'       => 'single',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$icontag = tag_escape($icontag);
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) )
		$itemtag = 'dl';
	if ( ! isset( $valid_tags[ $captiontag ] ) )
		$captiontag = 'dd';
	if ( ! isset( $valid_tags[ $icontag ] ) )
		$icontag = 'dt';

	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_div = "<ul id='$selector' class='gallery galleryid-{$id}'>";
	$output = $gallery_div;

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {

		$tag = '';

		$img = wp_get_attachment_image_src($id, $size);
/*
		$largeimg = wp_get_attachment_image_src($id, 'single');
		$large = $largeimg[0];
*/
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$tag = "
				<div class='gallery-caption-toggle pointer'>&bull;</div>
				<{$captiontag} class='wp-caption-text gallery-caption'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}

		$output .= "
			<{$icontag} class='gallery-item'>
			<div class='gallery-item-holder'>
				<div class='gallery-img' style='height: {$img[2]}px'>
					<img src='{$img[0]}'>
				</div>
				{$tag}
			</div>
			</{$icontag}>";

		}

	$output .= "</ul>\n";

	return $output;
}
add_shortcode('gallery', 'my_gallery_shortcode');

get_template_part( 'lib/meta-boxes' );
add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
function cmb_initialize_cmb_meta_boxes() {
	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'lib/metabox/init.php';
}
/* disable that freaking admin bar */
add_filter('show_admin_bar', '__return_false');
/* turn off version in meta */
function no_generator() { return ''; }
add_filter( 'the_generator', 'no_generator' );
?>