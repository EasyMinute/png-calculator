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

function add_hidden_inputs_to_form() {
	if (!class_exists('WooCommerce')) {
		return false; // Exit if WooCommerce is not active
	}

	if (is_product()) { // Check if we're on a single product page
		global $product;

		// Get product details
		$product_id = $product->get_id();
		$product_sku = $product->get_sku();
		$product_name = $product->get_name();
		$product_price = $product->get_price();
		$product_url = get_permalink($product_id); // Get the product URL


		// Output hidden inputs
		echo '<input type="hidden" name="product_id" value="' . esc_attr($product_id) . '">';
		echo '<input type="hidden" name="product_sku" value="' . esc_attr($product_sku) . '">';
		echo '<input type="hidden" name="product_name" value="' . esc_attr($product_name) . '">';
		echo '<input type="hidden" name="product_price" value="' . esc_attr($product_price) . '">';
		echo '<input type="hidden" name="product_url" value="' . esc_url($product_url) . '">';


		return $product_price;
	} else {
		return false;
	}
}
