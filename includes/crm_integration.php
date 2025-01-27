<?php
function send_to_crm() {
	$api_url = 'https://api.keycrm.app/v1/pipelines/cards'; // Replace with the actual KeyCRM endpoint
	$api_key = 'YjRmYWRmY2Y4YzExYTEyOTg4MzM0MzI3YzI4OWNlODA0ZWMzODVmYg'; // Optionally use the localized API key

	$data = [
		"title" => 'Прорахунок', // назва заявки
		"source_id" => 57, // ідентифікатор джерела
		"manager_comment" => 'коментар до заявки', // коментар до заявки
		"manager_id" => 74, //ідентифікатор відповідального менеджера
		"pipeline_id" => 2, // ідентифікатор воронки (за відсутності параметра буде використана перша воронка у списку)
		"contact" => [
			"full_name" => 'ПІБ покупця', // ПІБ покупця
			"email" => 'nikyura23@gmail.com', // email покупця
			"phone" => '3545345' // номер телефону покупця
		],
//		"products" => [
//			[
//				"name" => $_POST['product_name'], // назву товару
//				"sku" => $_POST['product_sku'], // артикул товару
//				"quantity" => $_POST['product_quantity'], // кількість проданого товару
//				"price" => $_POST['product_price'], // ціна продажу
//				"picture" => $_POST['product_url'], // зображення товару
//			]
//		],
	];

	//  "упаковуємо дані"
	$data_string = json_encode($data);


// відправляємо на сервер
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://openapi.keycrm.app/v1/pipelines/cards");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Content-type: application/json",
			"Accept: application/json",
			"Cache-Control: no-cache",
			"Pragma: no-cache",
			'Authorization:  Bearer ' . $api_key)
	);
	$result = curl_exec($ch);
	curl_close($ch);

	return $result;

}


// Hook to handle the Ajax request for logged-in users
add_action('wp_ajax_send_to_crm_action', 'send_calculations_to_crm');

// Hook to handle the Ajax request for non-logged-in users (if needed)
add_action('wp_ajax_nopriv_send_to_crm_action', 'send_calculations_to_crm');

function send_calculations_to_crm() {

	$api_url = 'https://openapi.keycrm.app/v1/pipelines/cards'; // Replace with the actual KeyCRM endpoint
	$api_key = 'YjRmYWRmY2Y4YzExYTEyOTg4MzM0MzI3YzI4OWNlODA0ZWMzODVmYg'; // Optionally use the localized API key

	// Check if it's a valid POST request
	if (!isset($_POST['user_name'])) {
		echo $_POST['user_name'];
		echo json_encode(['error' => 'Invalid request']);
		wp_die();
	}

	// Collect form data from the Ajax request
	$full_name = sanitize_text_field($_POST['user_name']);
	$email = sanitize_email($_POST['user_email']);
	$phone = sanitize_text_field($_POST['user_phone']);

	$calc_note = 'Кількість товару: ' . $_POST['product_quantity'] . '; ' .
	             'Роздрібна ціна: ' . $_POST['product_price'] . ' ;  ' .
	             'Ціна за 1 шт: ' . $_POST['product_final_price'] . ' ;  ' .
	             'Ціна за тираж: ' . $_POST['product_sum'] . ' ;  ' .
	             'Ціна за принт 1 шт: ' . $_POST['print_final_price'] . ' ;  ' .
	             'Сума за принт: ' . $_POST['print_sum'] ;

	var_dump($_POST);

     $data = [
		"title" => 'Прорахунок PNG Calculator', //ACF ADD FIELD
		"source_id" => 57, //ACF ADD FIELD
		"manager_comment" => $calc_note, // коментар до заявки
		"manager_id" => 74, //ACF ADD FIELD
		"pipeline_id" => 2, //ACF ADD FIELD
		"contact" => [
			"full_name" => $full_name, // ПІБ покупця
			"email" => $email, // email покупця
			"phone" => $phone // номер телефону покупця
		],
	];

	 if (isset($_POST['product_name'])) {
		 $data["products"] = [
			 [
			 "name"     => $_POST['product_name'], // назву товару
			 "sku"      => $_POST['product_sku'], // артикул товару
			 "quantity" => $_POST['product_quantity'], // кількість проданого товару
			 "price"    => $_POST['product_price'], // ціна продажу
			 "picture"  => $_POST['product_url'], // зображення товару
			 ]
		 ];
	 }

	//  "упаковуємо дані"
	$data_string = json_encode($data);


// відправляємо на сервер
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://openapi.keycrm.app/v1/pipelines/cards");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Content-type: application/json",
			"Accept: application/json",
			"Cache-Control: no-cache",
			"Pragma: no-cache",
			'Authorization:  Bearer ' . $api_key)
	);
	$result = curl_exec($ch);
	curl_close($ch);

//	return $result;



	// Return the response to the frontend
	if ($result === false) {
		echo json_encode(['error' => 'Failed to send to CRM']);
	} else {
		echo $result; // You can return the result from CRM if needed
	}

	wp_die(); // Always call wp_die() to properly terminate the request
}
