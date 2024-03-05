<?php
// don't load directly
defined( 'ABSPATH' ) || exit;

if ( file_exists( TFSP_ADMIN . 'tf-options/options/tf-menu-icon.php' ) ) {
	require_once TFSP_ADMIN . 'tf-options/options/tf-menu-icon.php';
} else {
	$menu_icon = 'dashicons-palmtree';
}

TF_Settings::option( 'tfsp_settings', array(
	'title'    => __( 'Tourfic Settings ', 'tourfic' ),
	'icon'     => $menu_icon,
	'position' => 26,
	'sections' => array(
		// Tour Options
		'tour'                  => array(
			'title'  => __( 'Tour Options', 'tourfic' ),
			'icon'   => 'fas fa-umbrella-beach',
			'fields' => array(
				array(
					'id'         => 'tf-related-tours',
					'type'       => 'select2',
					'multiple'   => 'true',
					'label'      => __( 'Choose Your Related Tours', 'tourfic' ),
					'subtitle' => __( 'Select the tour you wish to feature in the “Related Tour” section on each single tour page.', 'tourfic' ),
					'options'    => 'posts',
					'query_args' => array(
						'post_type'      => 'product',
						'posts_per_page' => - 1,
						'order' => 'ASC'
					),
				),
			),
		),
	),
) );
