<?php
// don't load directly
defined( 'ABSPATH' ) || exit;

TF_Settings::option( 'tfsp_settings', array(
	'title'    => __( 'Themefic Popup', 'tourfic' ),
	'icon'     => "dashicons-superhero",
	'position' => 26,
	'sections' => array(
		// Tour Options
		'tfsp_services' => array(
			'title'  => __( 'Services', 'tfsp' ),
			'icon'   => 'fa-solid fa-toolbox',
			'fields' => array(
				array(
					'id'         => 'tfsp_popup_products',
					'type'       => 'repeater',
					'label'      => __( 'Popup Products and Services', 'tfsp' ),
					'subtitle' => __( 'Add Products and Services for Popup Page', 'tfsp' ),
					'button_title' => __( 'Add Product and Service', 'tfsp' ),
					'fields'       => array(
						array(
							'id'         => 'tfsp_products_for_popup',
							'type'       => 'select2',
							'label'      => __( 'Choose Products for Popup', 'tfsp' ),
							'subtitle' => __( 'Select the products for which you want to display the popup on the checkout page.', 'tfsp' ),
							'placeholder' => __( 'Select Products', 'tfsp' ),
							'options'    => 'posts',
							'query_args' => array(
								'post_type'      => 'product',
								'posts_per_page' => - 1,
								'post_status' => 'publish',
								'order' => 'ASC'
							),
						),
						array(
							'id'         => 'tfsp_popup_services',
							'type'       => 'repeater',
							'label'      => __( 'Popup Services', 'tfsp' ),
							'subtitle' => __( 'Add Service for Popup Page', 'tfsp' ),
							'button_title' => __( 'Add Service', 'tfsp' ),
							'fields'       => array(
								array(
									'id'    => 'tfsp_service_title',
									'type'  => 'text',
									'label' => __( 'Service Title', 'tfsp' ),
									'subtitle' => __( 'Enter the title of the service.', 'tfsp' ),
								),
								array(
									'id'       => 'tfsp_service_price',
									'type'     => 'number',
									'label'    => __( 'Service Price', 'tfsp' ),
									'subtitle' => __( 'Enter the estimated price of the service. Please note that this price is not included in the total price of the checkout. Leave this field blank if you prefer not to display the price.', 'tfsp' ),
								),
								array(
									'id'       => 'tfsp_service_desc',
									'type'     => 'editor',
									'label'    => __( 'Service Description', 'tfsp' ),
									'subtitle' => __( 'Enter the description of your service, ensuring it is below 25 words.', 'tfsp' ),
								),
							),
						),
					)
				),
			),
		),
		'tfsp_popup_settings' => array(
			'title'  => __( 'Popup Settings', 'tfsp' ),
			'icon'   => 'fa-solid fa-screwdriver-wrench',
			'fields' => array(
				array(
					'id'         => 'tfsp_disable_popup',
					'type'       => 'switch',
					'label'      => __( 'Disable Popups', 'tfsp' ),
					'subtitle' => __( 'Enable this option if you wish to disable all the popups from showing.', 'tfsp' ),
					"placeholder" => __("Popup Title", 'tfsp'),
					'default' => false,
				),
				array(
					'id'         => 'tfsp_popup_opening_delay',
					'type'       => 'number',
					'label'      => __( 'Popup Delay', 'tfsp' ),
					'subtitle' => __( 'Enter the amount of delay you want before the popup opens.', 'tfsp' ),
					"placeholder" => __("Popup Delay Time in MS", 'tfsp'),
					'default' => 1000,
					'attributes' => array(
						'min' => '0',
					),
					'dependency' => array("tfsp_disable_popup", "!=", "1"),
				),
				array(
					'id'         => 'tfsp_popup_main_title',
					'type'       => 'text',
					'label'      => __( 'Popup Section Title', 'tfsp' ),
					'subtitle' => __( 'Enter the title for the popup.', 'tfsp' ),
					"placeholder" => __("Popup Title", 'tfsp'),
					"default" => __("Services You May Like to Add", 'tfsp'),
					'attributes' => array(
						'min' => '0',
					),
					'dependency' => array("tfsp_disable_popup", "!=", "1"),
				),
				array(
					'id'         => 'tfsp_popup_button_text',
					'type'       => 'text',
					'label'      => __( 'Popup Button Text', 'tfsp' ),
					'subtitle' => __( 'Enter the popup button text.', 'tfsp' ),
					"placeholder" => __("Popup Button Text", 'tfsp'),
					"default" => __("Continue", 'tfsp'),
					'dependency' => array("tfsp_disable_popup", "!=", "1"),
				),
				array(
					'id'         => 'tfsp_other_service_box',
					'type'       => 'switch',
					'label'      => __( 'Other Service Box', 'tfsp' ),
					'subtitle' => __( 'Enable this option if you wish to include an "Other Service" textbox in the popup.', 'tfsp' ),
					'default' => true,
					'dependency' => array("tfsp_disable_popup", "!=", "1"),
				),
			),
		)	
	),
) );
