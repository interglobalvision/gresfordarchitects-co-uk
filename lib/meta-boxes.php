<?php
add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );

function cmb_sample_metaboxes( array $meta_boxes ) {

	$prefix = '_cmb_';

	$meta_boxes[] = array(
		'id'         => 'postype_metabox',
		'title'      => '... Settings',
		'pages'      => array( 'post', ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name' => 'Project Description',
				'desc' => 'All text goes here. The box above should only contain a gallery',
				'id'   => $prefix . 'projdesc',
				'type' => 'wysiwyg',
			),
			/*
array(
				'name' => 'Homepage thumbnail',
				'desc' => 'Must be 860 x 300 px',
				'id'   => $prefix . 'featurethumb',
				'type' => 'file',
			),
			array(
				'name' => 'Homepage order',
				'desc' => 'IMPORTANT - This must have a numeric value otherwise project will not show on homepage. Lower numbers at top of the page.',
				'id'   => $prefix . 'featureorder',
				'type' => 'text',
			),
*/
		),
	);
	
	$meta_boxes[] = array(
		'id'         => 'postype_metabox',
		'title'      => 'Details',
		'pages'      => array( 'page', ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name' => 'Page Text',
				'desc' => 'All text goes here. The box above should only contain a gallery',
				'id'   => $prefix . 'pagetext',
				'type' => 'wysiwyg',
			),
			array(
				'name' => 'Smaller Text',
				'desc' => 'Smaller text at the bottom of page below images',
				'id'   => $prefix . 'pagetextsmall',
				'type' => 'wysiwyg',
			),
			array(
				'name' => 'Text for sidebar',
				'desc' => 'This text goes in the menu below the G & Gresford Architects',
				'id'   => $prefix . 'sidebartext',
				'type' => 'wysiwyg',
			),
		),
	);

	return $meta_boxes;
}
?>