<?php

add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
		'key' => 'group_6762e872643fd',
		'title' => 'Calculator',
		'fields' => array(
			array(
				'key' => 'field_6762f3a120734',
				'label' => 'Загальні',
				'name' => '',
				'aria-label' => '',
				'type' => 'accordion',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'open' => 0,
				'multi_expand' => 0,
				'endpoint' => 0,
			),
			array(
				'key' => 'field_6762e872d7901',
				'label' => 'Сторінка калькулятора',
				'name' => 'calculator_page',
				'aria-label' => '',
				'type' => 'link',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'allow_in_bindings' => 0,
			),
			array(
				'key' => 'field_6762e8add7902',
				'label' => 'Визначення вартості виробів',
				'name' => '',
				'aria-label' => '',
				'type' => 'accordion',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'open' => 0,
				'multi_expand' => 0,
				'endpoint' => 0,
			),
			array(
				'key' => 'field_6762e974d7903',
				'label' => 'Визначення вартості виробів',
				'name' => 'product_price_koefs',
				'aria-label' => '',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'pagination' => 0,
				'min' => 0,
				'max' => 0,
				'collapsed' => '',
				'button_label' => 'Add Row',
				'rows_per_page' => 20,
				'sub_fields' => array(
					array(
						'key' => 'field_6762ea83d7905',
						'label' => 'Ціна від',
						'name' => 'price_min',
						'aria-label' => '',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'min' => '',
						'max' => '',
						'allow_in_bindings' => 1,
						'placeholder' => '',
						'step' => '',
						'prepend' => '',
						'append' => '',
						'parent_repeater' => 'field_6762e974d7903',
					),
					array(
						'key' => 'field_6762ecf5e8425',
						'label' => 'Ціна до',
						'name' => 'price_max',
						'aria-label' => '',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'min' => '',
						'max' => '',
						'allow_in_bindings' => 1,
						'placeholder' => '',
						'step' => '',
						'prepend' => '',
						'append' => '',
						'parent_repeater' => 'field_6762e974d7903',
					),
					array(
						'key' => 'field_6762ed1ae8426',
						'label' => 'Коефіцієнти',
						'name' => 'quantity_rows',
						'aria-label' => '',
						'type' => 'repeater',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'layout' => 'table',
						'pagination' => 0,
						'min' => 0,
						'max' => 0,
						'collapsed' => '',
						'button_label' => 'Add Row',
						'rows_per_page' => 20,
						'sub_fields' => array(
							array(
								'key' => 'field_6762ee2be8427',
								'label' => 'Кількість від',
								'name' => 'quantity_min',
								'aria-label' => '',
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '25',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'min' => '',
								'max' => '',
								'allow_in_bindings' => 0,
								'placeholder' => '',
								'step' => '',
								'prepend' => '',
								'append' => '',
								'parent_repeater' => 'field_6762ed1ae8426',
							),
							array(
								'key' => 'field_6762eea7e8429',
								'label' => 'Кількість до',
								'name' => 'quantity_max',
								'aria-label' => '',
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '25',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'min' => '',
								'max' => '',
								'allow_in_bindings' => 0,
								'placeholder' => '',
								'step' => '',
								'prepend' => '',
								'append' => '',
								'parent_repeater' => 'field_6762ed1ae8426',
							),
							array(
								'key' => 'field_6762eeb6e842a',
								'label' => 'Коефіцієнт множення',
								'name' => 'koef',
								'aria-label' => '',
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '50',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'min' => '',
								'max' => '',
								'allow_in_bindings' => 0,
								'placeholder' => '',
								'step' => '',
								'prepend' => '',
								'append' => '',
								'parent_repeater' => 'field_6762ed1ae8426',
							),
						),
						'parent_repeater' => 'field_6762e974d7903',
					),
				),
			),
			array(
				'key' => 'field_67646ad9c9ee2',
				'label' => 'Коефіцієнти сублімаційного друку',
				'name' => '',
				'aria-label' => '',
				'type' => 'accordion',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'open' => 0,
				'multi_expand' => 0,
				'endpoint' => 0,
			),
			array(
				'key' => 'field_67646b21c9ee3',
				'label' => 'Коефіцієнти сублімаційного друку',
				'name' => 'sublimation_koefs',
				'aria-label' => '',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'pagination' => 0,
				'min' => 0,
				'max' => 0,
				'collapsed' => '',
				'button_label' => 'Add Row',
				'rows_per_page' => 20,
				'sub_fields' => array(
					array(
						'key' => 'field_67646b36c9ee4',
						'label' => 'Формат',
						'name' => 'format',
						'aria-label' => '',
						'type' => 'select',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'a6' => 'A6 10 х 15 см',
							'a5' => 'A5 20 х 14 см',
							'a4' => 'A4 20 х 29см',
							'a3' => 'A3 40 х 29 см',
							'a2' => 'A2 58 х 40 см',
							'5to5cm' => '5x5 cm',
							'30to12cm' => '30 x 12см',
						),
						'default_value' => false,
						'return_format' => 'array',
						'multiple' => 0,
						'allow_null' => 0,
						'allow_in_bindings' => 0,
						'ui' => 0,
						'ajax' => 0,
						'placeholder' => '',
						'parent_repeater' => 'field_67646b21c9ee3',
					),
					array(
						'key' => 'field_67646b5bc9ee5',
						'label' => 'Тираж - ціна',
						'name' => 'products_price',
						'aria-label' => '',
						'type' => 'repeater',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'layout' => '',
						'pagination' => 0,
						'min' => 0,
						'max' => 0,
						'collapsed' => '',
						'button_label' => 'Add Row',
						'rows_per_page' => 20,
						'sub_fields' => array(
							array(
								'key' => 'field_67646c6ac9ee6',
								'label' => 'Тираж від',
								'name' => 'quantity_min',
								'aria-label' => '',
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'min' => '',
								'max' => '',
								'allow_in_bindings' => 0,
								'placeholder' => '',
								'step' => '',
								'prepend' => '',
								'append' => '',
								'parent_repeater' => 'field_67646b5bc9ee5',
							),
							array(
								'key' => 'field_67646c8bc9ee7',
								'label' => 'Тираж до',
								'name' => 'quantity_max',
								'aria-label' => '',
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'min' => '',
								'max' => '',
								'allow_in_bindings' => 0,
								'placeholder' => '',
								'step' => '',
								'prepend' => '',
								'append' => '',
								'parent_repeater' => 'field_67646b5bc9ee5',
							),
							array(
								'key' => 'field_67646c94c9ee8',
								'label' => 'Коефіцієнт',
								'name' => 'koef',
								'aria-label' => '',
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'min' => '',
								'max' => '',
								'allow_in_bindings' => 0,
								'placeholder' => '',
								'step' => '',
								'prepend' => '',
								'append' => '',
								'parent_repeater' => 'field_67646b5bc9ee5',
							),
						),
						'parent_repeater' => 'field_67646b21c9ee3',
					),
				),
			),
			array(
				'key' => 'field_67a0c1ceacf50',
				'label' => 'Коефіцієнти шовкотрафаретного друку',
				'name' => '',
				'aria-label' => '',
				'type' => 'accordion',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'open' => 0,
				'multi_expand' => 0,
				'endpoint' => 0,
			),
			array(
				'key' => 'field_67a0c1e6acf51',
				'label' => 'Коефіцієнти шовкотрафаретного друку',
				'name' => 'silk_screen_koefs',
				'aria-label' => '',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'pagination' => 0,
				'min' => 0,
				'max' => 0,
				'collapsed' => '',
				'button_label' => 'Add Row',
				'rows_per_page' => 20,
				'sub_fields' => array(
					array(
						'key' => 'field_67a0c1e6acf52',
						'label' => 'Формат',
						'name' => 'format',
						'aria-label' => '',
						'type' => 'select',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'a6' => 'A6 10 х 15 см',
							'a5' => 'A5 20 х 14 см',
							'a4' => 'A4 20 х 29см',
							'a3' => 'A3 40 х 29 см',
							'a2' => 'A2 58 х 40 см',
							'5to5cm' => '5x5 cm',
							'30to12cm' => '30 x 12см',
						),
						'default_value' => false,
						'return_format' => 'array',
						'multiple' => 0,
						'allow_null' => 0,
						'allow_in_bindings' => 0,
						'ui' => 0,
						'ajax' => 0,
						'placeholder' => '',
						'parent_repeater' => 'field_67a0c1e6acf51',
					),
					array(
						'key' => 'field_67a0c1e6acf53',
						'label' => 'Тираж - ціна',
						'name' => 'products_price',
						'aria-label' => '',
						'type' => 'repeater',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'layout' => 'table',
						'min' => 0,
						'max' => 0,
						'collapsed' => '',
						'button_label' => 'Add Row',
						'rows_per_page' => 20,
						'sub_fields' => array(
							array(
								'key' => 'field_67a0c1e6acf54',
								'label' => 'Тираж від',
								'name' => 'quantity_min',
								'aria-label' => '',
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'min' => '',
								'max' => '',
								'allow_in_bindings' => 0,
								'placeholder' => '',
								'step' => '',
								'prepend' => '',
								'append' => '',
								'parent_repeater' => 'field_67a0c1e6acf53',
							),
							array(
								'key' => 'field_67a0c1e6acf55',
								'label' => 'Тираж до',
								'name' => 'quantity_max',
								'aria-label' => '',
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'min' => '',
								'max' => '',
								'allow_in_bindings' => 0,
								'placeholder' => '',
								'step' => '',
								'prepend' => '',
								'append' => '',
								'parent_repeater' => 'field_67a0c1e6acf53',
							),
							array(
								'key' => 'field_67a0c1e6acf56',
								'label' => 'Коефіцієнт',
								'name' => 'koef',
								'aria-label' => '',
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'min' => '',
								'max' => '',
								'allow_in_bindings' => 0,
								'placeholder' => '',
								'step' => '',
								'prepend' => '',
								'append' => '',
								'parent_repeater' => 'field_67a0c1e6acf53',
							),
						),
						'parent_repeater' => 'field_67a0c1e6acf51',
					),
				),
			),
			array(
				'key' => 'field_67646decc9ef8',
				'label' => 'Коефіцієнти DTF',
				'name' => '',
				'aria-label' => '',
				'type' => 'accordion',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'open' => 0,
				'multi_expand' => 0,
				'endpoint' => 0,
			),
			array(
				'key' => 'field_67646dfcc9ef9',
				'label' => 'Коефіцієнти DTF',
				'name' => 'dtf_koefs',
				'aria-label' => '',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'pagination' => 0,
				'min' => 0,
				'max' => 0,
				'collapsed' => '',
				'button_label' => 'Add Row',
				'rows_per_page' => 20,
				'sub_fields' => array(
					array(
						'key' => 'field_67646dfcc9efa',
						'label' => 'Формат',
						'name' => 'format',
						'aria-label' => '',
						'type' => 'select',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'a6' => 'A6 10 х 15 см',
							'a5' => 'A5 20 х 14 см',
							'a4' => 'A4 20 х 29см',
							'a3' => 'A3 40 х 29 см',
							'a2' => 'A2 58 х 40 см',
							'5to5cm' => '5x5 cm',
							'30to12cm' => '30 x 12см',
						),
						'default_value' => false,
						'return_format' => 'array',
						'multiple' => 0,
						'allow_null' => 0,
						'allow_in_bindings' => 0,
						'ui' => 0,
						'ajax' => 0,
						'placeholder' => '',
						'parent_repeater' => 'field_67646dfcc9ef9',
					),
					array(
						'key' => 'field_67646dfcc9efb',
						'label' => 'Тираж - ціна',
						'name' => 'products_price',
						'aria-label' => '',
						'type' => 'repeater',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'layout' => 'table',
						'pagination' => 0,
						'min' => 0,
						'max' => 0,
						'collapsed' => '',
						'button_label' => 'Add Row',
						'rows_per_page' => 20,
						'sub_fields' => array(
							array(
								'key' => 'field_67646dfcc9efc',
								'label' => 'Тираж від',
								'name' => 'quantity_min',
								'aria-label' => '',
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'min' => '',
								'max' => '',
								'allow_in_bindings' => 0,
								'placeholder' => '',
								'step' => '',
								'prepend' => '',
								'append' => '',
								'parent_repeater' => 'field_67646dfcc9efb',
							),
							array(
								'key' => 'field_67646dfcc9efd',
								'label' => 'Тираж до',
								'name' => 'quantity_max',
								'aria-label' => '',
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'min' => '',
								'max' => '',
								'allow_in_bindings' => 0,
								'placeholder' => '',
								'step' => '',
								'prepend' => '',
								'append' => '',
								'parent_repeater' => 'field_67646dfcc9efb',
							),
							array(
								'key' => 'field_67646dfcc9efe',
								'label' => 'Коефіцієнт',
								'name' => 'koef',
								'aria-label' => '',
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'min' => '',
								'max' => '',
								'allow_in_bindings' => 0,
								'placeholder' => '',
								'step' => '',
								'prepend' => '',
								'append' => '',
								'parent_repeater' => 'field_67646dfcc9efb',
							),
						),
						'parent_repeater' => 'field_67646dfcc9ef9',
					),
				),
			),
			array(
				'key' => 'field_67a0c1a0acf49',
				'label' => 'Коефіцієнти UV DTF',
				'name' => '',
				'aria-label' => '',
				'type' => 'accordion',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'open' => 0,
				'multi_expand' => 0,
				'endpoint' => 0,
			),
			array(
				'key' => 'field_67a0c1b0acf4a',
				'label' => 'Коефіцієнти UV DTF',
				'name' => 'uv_dtf_koefs',
				'aria-label' => '',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'pagination' => 0,
				'min' => 0,
				'max' => 0,
				'collapsed' => '',
				'button_label' => 'Add Row',
				'rows_per_page' => 20,
				'sub_fields' => array(
					array(
						'key' => 'field_67a0c1b0acf4b',
						'label' => 'Формат',
						'name' => 'format',
						'aria-label' => '',
						'type' => 'select',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'a6' => 'A6 10 х 15 см',
							'a5' => 'A5 20 х 14 см',
							'a4' => 'A4 20 х 29см',
							'a3' => 'A3 40 х 29 см',
							'a2' => 'A2 58 х 40 см',
							'5to5cm' => '5x5 cm',
							'30to12cm' => '30 x 12см',
						),
						'default_value' => false,
						'return_format' => 'array',
						'multiple' => 0,
						'allow_null' => 0,
						'allow_in_bindings' => 0,
						'ui' => 0,
						'ajax' => 0,
						'placeholder' => '',
						'parent_repeater' => 'field_67a0c1b0acf4a',
					),
					array(
						'key' => 'field_67a0c1b0acf4c',
						'label' => 'Тираж - ціна',
						'name' => 'products_price',
						'aria-label' => '',
						'type' => 'repeater',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'layout' => 'table',
						'min' => 0,
						'max' => 0,
						'collapsed' => '',
						'button_label' => 'Add Row',
						'rows_per_page' => 20,
						'sub_fields' => array(
							array(
								'key' => 'field_67a0c1b0acf4d',
								'label' => 'Тираж від',
								'name' => 'quantity_min',
								'aria-label' => '',
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'min' => '',
								'max' => '',
								'allow_in_bindings' => 0,
								'placeholder' => '',
								'step' => '',
								'prepend' => '',
								'append' => '',
								'parent_repeater' => 'field_67a0c1b0acf4c',
							),
							array(
								'key' => 'field_67a0c1b0acf4e',
								'label' => 'Тираж до',
								'name' => 'quantity_max',
								'aria-label' => '',
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'min' => '',
								'max' => '',
								'allow_in_bindings' => 0,
								'placeholder' => '',
								'step' => '',
								'prepend' => '',
								'append' => '',
								'parent_repeater' => 'field_67a0c1b0acf4c',
							),
							array(
								'key' => 'field_67a0c1b0acf4f',
								'label' => 'Коефіцієнт',
								'name' => 'koef',
								'aria-label' => '',
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'min' => '',
								'max' => '',
								'allow_in_bindings' => 0,
								'placeholder' => '',
								'step' => '',
								'prepend' => '',
								'append' => '',
								'parent_repeater' => 'field_67a0c1b0acf4c',
							),
						),
						'parent_repeater' => 'field_67a0c1b0acf4a',
					),
				),
			),
			array(
				'key' => 'field_67729538e351c',
				'label' => 'Знижки',
				'name' => '',
				'aria-label' => '',
				'type' => 'accordion',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'open' => 0,
				'multi_expand' => 0,
				'endpoint' => 0,
			),
			array(
				'key' => 'field_677296cfe351d',
				'label' => 'Знижки',
				'name' => 'print_discounts',
				'aria-label' => '',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'table',
				'pagination' => 0,
				'min' => 0,
				'max' => 0,
				'collapsed' => '',
				'button_label' => 'Add Row',
				'rows_per_page' => 20,
				'sub_fields' => array(
					array(
						'key' => 'field_677296eae351e',
						'label' => 'Назва знижки',
						'name' => 'title',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'allow_in_bindings' => 0,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'parent_repeater' => 'field_677296cfe351d',
					),
					array(
						'key' => 'field_67729707e351f',
						'label' => 'Значення у відсотках',
						'name' => 'value',
						'aria-label' => '',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'min' => '',
						'max' => '',
						'allow_in_bindings' => 0,
						'placeholder' => '',
						'step' => '',
						'prepend' => '',
						'append' => '',
						'parent_repeater' => 'field_677296cfe351d',
					),
				),
			),
			array(
				'key' => 'field_67729c22e3520',
				'label' => 'Націнки',
				'name' => '',
				'aria-label' => '',
				'type' => 'accordion',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'open' => 0,
				'multi_expand' => 0,
				'endpoint' => 0,
			),
			array(
				'key' => 'field_67729c35e3521',
				'label' => 'Націнки',
				'name' => 'Additional',
				'aria-label' => '',
				'type' => 'group',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'sub_fields' => array(
					array(
						'key' => 'field_67729c57e3522',
						'label' => 'Терміновість',
						'name' => 'urgency',
						'aria-label' => '',
						'type' => 'repeater',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'layout' => 'table',
						'pagination' => 0,
						'min' => 0,
						'max' => 0,
						'collapsed' => '',
						'button_label' => 'Add Row',
						'rows_per_page' => 20,
						'sub_fields' => array(
							array(
								'key' => 'field_67729c9be3523',
								'label' => 'Мінімальна кількість',
								'name' => 'quantity_min',
								'aria-label' => '',
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'min' => '',
								'max' => '',
								'allow_in_bindings' => 0,
								'placeholder' => '',
								'step' => '',
								'prepend' => '',
								'append' => '',
								'parent_repeater' => 'field_67729c57e3522',
							),
							array(
								'key' => 'field_67729cbbe3524',
								'label' => 'Максимальна кількість',
								'name' => 'quantity_max',
								'aria-label' => '',
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'min' => '',
								'max' => '',
								'allow_in_bindings' => 0,
								'placeholder' => '',
								'step' => '',
								'prepend' => '',
								'append' => '',
								'parent_repeater' => 'field_67729c57e3522',
							),
							array(
								'key' => 'field_67729ccae3525',
								'label' => 'Коефіцієнт',
								'name' => 'quantity_max_copy',
								'aria-label' => '',
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'min' => '',
								'max' => '',
								'allow_in_bindings' => 0,
								'placeholder' => '',
								'step' => '',
								'prepend' => '',
								'append' => '',
								'parent_repeater' => 'field_67729c57e3522',
							),
						),
					),
					array(
						'key' => 'field_67729ce3e3526',
						'label' => 'Коефіцієнт за продукцію клієнта',
						'name' => 'clients_items',
						'aria-label' => '',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'min' => '',
						'max' => '',
						'allow_in_bindings' => 0,
						'placeholder' => '',
						'step' => '',
						'prepend' => '',
						'append' => '',
					),
					array(
						'key' => 'field_67729d21e3527',
						'label' => 'Коефіцієнт за складність нанесення',
						'name' => 'difficulty_koef',
						'aria-label' => '',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'min' => '',
						'max' => '',
						'allow_in_bindings' => 0,
						'placeholder' => '',
						'step' => '',
						'prepend' => '',
						'append' => '',
					),
					array(
						'key' => 'field_67729d48e3529',
						'label' => 'Націнка за додаткове пакування',
						'name' => 'package_add',
						'aria-label' => '',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'min' => '',
						'max' => '',
						'allow_in_bindings' => 0,
						'placeholder' => '',
						'step' => '',
						'prepend' => '',
						'append' => '',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'png-calculator',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
	) );

	acf_add_local_field_group( array(
		'key' => 'group_67a0a4659cf60',
		'title' => 'CRM Options',
		'fields' => array(
			array(
				'key' => 'field_67a0a46577a1e',
				'label' => 'PNG CRM Options',
				'name' => 'png_crm_options',
				'aria-label' => '',
				'type' => 'group',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'sub_fields' => array(
					array(
						'key' => 'field_67a0a48977a1f',
						'label' => 'API key',
						'name' => 'api_key',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'allow_in_bindings' => 0,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array(
						'key' => 'field_67a0a5a177a24',
						'label' => 'API url',
						'name' => 'api_url',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => 'https://openapi.keycrm.app/v1/pipelines/cards',
						'maxlength' => '',
						'allow_in_bindings' => 0,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array(
						'key' => 'field_67a0a49377a20',
						'label' => 'Title of card',
						'name' => 'title',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => 'Прорахунок PNG Calculator',
						'maxlength' => '',
						'allow_in_bindings' => 0,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array(
						'key' => 'field_67a0a55c77a21',
						'label' => 'Source id',
						'name' => 'source_id',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'allow_in_bindings' => 0,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array(
						'key' => 'field_67a0a56e77a22',
						'label' => 'Manager id',
						'name' => 'manager_id',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'allow_in_bindings' => 0,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array(
						'key' => 'field_67a0a58677a23',
						'label' => 'Pipeline id',
						'name' => 'pipeline_id',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'allow_in_bindings' => 0,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array(
						'key' => 'field_67Mail_to',
						'label' => 'Email',
						'name' => 'email_to_send',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'allow_in_bindings' => 0,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-crm-options',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
	) );
} );

