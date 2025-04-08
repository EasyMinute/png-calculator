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

	acf_add_options_sub_page(array(
		'page_title' 	=> 'CRM Options',
		'menu_title'	=> 'CRM Options',
		'parent_slug'	=> 'png-calculator',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Tape Calculator',
		'menu_title'	=> 'Tape Calculator',
		'parent_slug'	=> 'png-calculator',
	));
}

// Shortcode for Calculator
function png_calculator_shortcode() {
	ob_start();
	include PNG_CALCULATOR_PATH . 'templates/calculator.php';
	return ob_get_clean();
}
add_shortcode( 'png_calculator', 'png_calculator_shortcode' );

// Shortcode for Calculator
function png_tape_calculator_shortcode() {
	ob_start();
	include PNG_CALCULATOR_PATH . 'templates/tape-calculator.php';
	return ob_get_clean();
}
add_shortcode( 'png_tape_calculator', 'png_tape_calculator_shortcode' );

function png_calculator_popup_shortcode() {
	ob_start();
	echo "<button id='png-calculator-popup-trigger' class='pngcalc_button png-calculator-popup-trigger'>". __('Додати друк', 'pngcalc') ."</button>";
	echo "<div class='png-modal' id='png-calculator-popup'>";
	include PNG_CALCULATOR_PATH . 'templates/calculator.php';
	echo "</div>";
	return ob_get_clean();
}
add_shortcode( 'png_calculator_popup', 'png_calculator_popup_shortcode' );

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

		if (!$product) {
			return false;
		}

		$product_id = $product->get_id();
		$product_sku = $product->get_sku();
		$product_name = $product->get_name();
		$product_url = get_permalink($product_id); // Get the product URL
		$product_price = '';

		// Handle variable products
		if ($product->is_type('variable')) {
			$available_variations = $product->get_available_variations();
			$prices = [];

			foreach ($available_variations as $variation) {
				$variation_id = $variation['variation_id'];
				$variation_obj = wc_get_product($variation_id);


				if ($variation_obj->get_manage_stock()===true && $variation_obj->is_in_stock() && $variation_obj->get_stock_quantity()) {
					$prices[] = $variation_obj->get_price();
				}
			}

			$product_price = !empty($prices) ? min($prices) : ''; // Get the lowest in-stock variation price
		} else {
			$product_price = $product->get_price();
		}

		$product_price = wc_format_decimal($product_price, 2);

		// Output hidden inputs
		echo '<input type="hidden" name="product_id" value="' . esc_attr($product_id) . '">';
		echo '<input type="hidden" name="product_sku" value="' . esc_attr($product_sku) . '">';
		echo '<input type="hidden" name="product_name" value="' . esc_attr($product_name) . '">';
		echo '<input type="hidden" name="product_price" value="' . esc_attr($product_price) . '">';
		echo '<input type="hidden" name="product_url" value="' . esc_url($product_url) . '">';

		return $product_price;
	}

	return false;
}

function add_recaptcha_to_head() {
	?>
	<script type="text/javascript">
        var onloadCallback = function() {
            grecaptcha.render('html_element', {
                'sitekey' : '6Lc-AM8qAAAAAHK4wRP7JIXw0Fp75bfTKPN45hLn'
            });
        };
	</script>
	<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
	<?php
}
add_action('wp_head', 'add_recaptcha_to_head');

