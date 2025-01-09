<?php

add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_style( 'png-calculator-style', PNG_CALCULATOR_URL . 'dist/css/main.min.css' );
	wp_enqueue_script( 'png-calculator-script', PNG_CALCULATOR_URL . 'dist/js/main.min.js', array(), null, true );

	$product_price_koefs = get_field('product_price_koefs', 'options');
	$sublimation_koefs   = get_field('sublimation_koefs', 'options');
	$white_direct_koefs  = get_field('white_direct_koefs', 'options');
	$color_direct_koefs  = get_field('color_direct_koefs', 'options');
	$additional_urgency           = get_field('Additional', 'options')['urgency'];

	$dtf_koefs           = get_field('dtf_koefs', 'options');

	wp_localize_script( 'png-calculator-script', 'pngCalculatorData', array(
		'productPriceKoefs' => $product_price_koefs,
		'sublimationKoefs' => $sublimation_koefs,
		'whiteDirectKoefs' => $white_direct_koefs,
		'colorDirectKoefs' => $color_direct_koefs,
		'dtfKoefs' => $dtf_koefs,
		'additionalUrgency' => $additional_urgency,
	));
});
