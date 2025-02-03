<?php

add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_style( 'png-calculator-style', PNG_CALCULATOR_URL . 'dist/css/main.min.css' );
	wp_enqueue_script( 'png-calculator-script', PNG_CALCULATOR_URL . 'dist/js/main.min.js', array(), null, true );
	wp_localize_script('png-calculator-script', 'ajaxurl', admin_url('admin-ajax.php'));

	$product_price_koefs = get_field('product_price_koefs', 'options');
	$sublimation_koefs   = get_field('sublimation_koefs', 'options');
	$silk_screen_koefs  = get_field('silk_screen_koefs', 'options');
	$uv_dtf_koefs  = get_field('uv_dtf_koefs', 'options');
	$dtf_koefs           = get_field('dtf_koefs', 'options');

	$additional_urgency           = get_field('Additional', 'options')['urgency'];

	wp_localize_script( 'png-calculator-script', 'pngCalculatorData', array(
		'productPriceKoefs' => $product_price_koefs,
		'sublimationKoefs' => $sublimation_koefs,
		'silkScreenKoefs' => $silk_screen_koefs,
		'dtfKoefs' => $dtf_koefs,
		'uvDtfKoefs' => $uv_dtf_koefs,
		'additionalUrgency' => $additional_urgency,
	));
});
