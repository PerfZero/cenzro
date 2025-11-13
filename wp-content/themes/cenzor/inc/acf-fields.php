<?php

if ( function_exists( 'acf_add_local_field_group' ) ) {

	acf_add_local_field_group(
		array(
			'key'                   => 'group_home_page',
			'title'                 => 'Home Page Fields',
			'fields'                => array(
				array(
					'key'               => 'field_hero_background_image',
					'label'             => 'Hero Background Image',
					'name'              => 'hero_background_image',
					'type'              => 'image',
					'instructions'      => 'Upload background image for hero section',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'return_format'     => 'array',
					'preview_size'      => 'medium',
					'library'           => 'all',
					'min_width'         => '',
					'min_height'        => '',
					'min_size'          => '',
					'max_width'         => '',
					'max_height'        => '',
					'max_size'          => '',
					'mime_types'        => '',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'          => '',
		)
	);

	acf_add_local_field_group(
		array(
			'key'                   => 'group_profession',
			'title'                 => 'Profession Fields',
			'fields'                => array(
				array(
					'key'               => 'field_profession_image',
					'label'             => 'Profession Image',
					'name'              => 'profession_image',
					'type'              => 'image',
					'instructions'      => 'Upload image for profession',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'return_format'     => 'array',
					'preview_size'      => 'medium',
					'library'           => 'all',
					'min_width'         => '',
					'min_height'        => '',
					'min_size'          => '',
					'max_width'         => '',
					'max_height'        => '',
					'max_size'          => '',
					'mime_types'        => '',
				),
				array(
					'key'               => 'field_profession_category',
					'label'             => 'Profession Category',
					'name'              => 'profession_category',
					'type'              => 'select',
					'instructions'      => 'Select category for profession',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'choices'           => array(
						'all'       => 'All Professions',
						'medical'    => 'Medical',
						'education'  => 'Education',
						'business'   => 'Business',
						'tech'       => 'IT and Technology',
					),
					'default_value'     => 'all',
					'allow_null'        => 0,
					'multiple'          => 0,
					'ui'                => 0,
					'return_format'     => 'value',
					'ajax'              => 0,
					'placeholder'       => '',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'profession',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'          => '',
		)
	);

}


