<?php

// Register ACF Options Page
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page(array(
		'page_title'    => 'PNG Calculator',
		'menu_title'    => 'PNG Calculator',
		'menu_slug'     => 'png-calculator',
		'capability'    => 'manage_options',
		'redirect'      => false
	));
}

// Shortcode for Calculator
function png_calculator_shortcode() {
	ob_start();
	include PNG_CALCULATOR_PATH . 'templates/calculator.php';
	return ob_get_clean();
}
add_shortcode( 'png_calculator', 'png_calculator_shortcode' );

// Shortcode for Calculator Page Button
function png_calculator_button_shortcode( $atts ) {
	$calculator_page = get_field('calculator_page', 'options');
	$atts = shortcode_atts( array(
		'label' => $calculator_page['title'] ?? __('Прорахунок', 'pngcalc'),
		'url'   => $calculator_page['url'] ?? '#',
	), $atts );

	return '<a href="' . esc_url( $atts['url'] ) . '" class="png-calculator-button">' . esc_html( $atts['label'] ) . '</a>';
}
add_shortcode( 'png_calculator_button', 'png_calculator_button_shortcode' );
