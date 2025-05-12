<?php

add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_style( 'png-calculator-style', PNG_CALCULATOR_URL . 'dist/css/main.min.css' );
	wp_enqueue_script( 'png-calculator-script', PNG_CALCULATOR_URL . 'dist/js/main.min.js', array(), null, true );
	wp_localize_script('png-calculator-script', 'ajaxurl', admin_url('admin-ajax.php'));

	$product_price_koefs = get_field('product_price_koefs', 'options');
	$product_discounts_koefs = get_field('prod_discounts', 'options');

	//type_options
	$print_types_data = array();
	$print_types = get_posts(array(
		'post_type'      => 'print_type',
		'posts_per_page' => -1, // get all
		'orderby'        => 'date',
		'order'          => 'DESC',
	));
	foreach ($print_types as $post) {
		setup_postdata($post);
		$type_id = $post->ID;

		$type_options = get_field('type_options', $post); // This is the group field


		if (!$type_options) {
			continue;
		}

		$distance     = $type_options['distance'] ?? null;
		$tape_width   = $type_options['tape_width'] ?? null;
		$tape_price   = $type_options['tape_price'] ?? null;

		$applying_price = array();

		if (!empty($type_options['applying_price'])) {
			foreach ($type_options['applying_price'] as $row) {
				$applying_price[] = array(
					'quantity_min' => $row['quantity_min'] ?? 0,
					'quantity_max' => $row['quantity_max'] ?? 0,
					'price'        => $row['price'] ?? 0,
				);
			}
		}

		$print_types_data["type_{$type_id}"] = array(
			'distance'       => $distance,
			'tape_width'     => $tape_width,
			'tape_price'     => $tape_price,
			'applying_price' => $applying_price,
		);
	}
	wp_reset_postdata();

	wp_localize_script('png-calculator-script', 'printTypeOptions', $print_types_data);


	//To delete
	$sublimation_koefs   = get_field('sublimation_koefs', 'options');
	$silk_screen_koefs  = get_field('silk_screen_koefs', 'options');
	$uv_dtf_koefs  = get_field('uv_dtf_koefs', 'options');
	$dtf_koefs           = get_field('dtf_koefs', 'options');

	$additional_urgency           = get_field('Additional', 'options')['urgency'];

	wp_localize_script( 'png-calculator-script', 'pngCalculatorData', array(
		'productPriceKoefs' => $product_price_koefs,
		'productDiscountKoefs' => $product_discounts_koefs,
		'sublimationKoefs' => $sublimation_koefs,
		'silkScreenKoefs' => $silk_screen_koefs,
		'dtfKoefs' => $dtf_koefs,
		'uvDtfKoefs' => $uv_dtf_koefs,
		'additionalUrgency' => $additional_urgency,
	));
});
