<?php




// Hook to handle the Ajax request for logged-in users
add_action('wp_ajax_send_to_crm_action', 'send_calculations_to_crm');

// Hook to handle the Ajax request for non-logged-in users (if needed)
add_action('wp_ajax_nopriv_send_to_crm_action', 'send_calculations_to_crm');

//function send_calculations_to_crm() {
//
//
//	$crm_otions = get_field('png_crm_options', 'options');
//	$api_url = $crm_otions['api_url'] ?? 'https://openapi.keycrm.app/v1/pipelines/cards'; // Replace with the actual KeyCRM endpoint
//	$api_key = $crm_otions['api_key'] ?? 'YjRmYWRmY2Y4YzExYTEyOTg4MzM0MzI3YzI4OWNlODA0ZWMzODVmYg'; // Optionally use the localized API key
//
//	// Check if it's a valid POST request
//	if (!isset($_POST['user_name'])) {
//		echo $_POST['user_name'];
//		echo json_encode(['error' => 'Invalid request']);
//		wp_die();
//	}
//
//	// Collect form data from the Ajax request
//	$full_name = sanitize_text_field($_POST['user_name']);
//	$email = sanitize_email($_POST['user_email']);
//	$phone = sanitize_text_field($_POST['user_phone']);
//
//	$calc_note = "Кількість товару: " . $_POST["product_quantity"] . "; \n " .
//	             "Роздрібна ціна: " . $_POST["product_price"] . "; \n " .
//	             "Ціна за 1 шт: " . $_POST["product_final_price"] . "; \n " .
//	             "Ціна за тираж: " . $_POST["product_sum"] . "; \n " .
//	             "Ціна за принт 1 шт: " . $_POST["print_final_price"] . "; \n " .
//	             "Сума за принт: " . $_POST["print_sum"] . "; \n " .
//
//	$print_formats = isset($_POST["printFormats"]) ? json_decode(stripslashes($_POST["printFormats"]), true) : [];
//	$print_types = isset($_POST["printTypes"]) ? json_decode(stripslashes($_POST["printTypes"]), true) : [];
//
//	if (!empty($print_formats) && !empty($print_types)) {
//		foreach ($print_formats as $key => $format) {
//			$calc_note .= "(Тип друку: " . $print_types[$key] . " - Формат дурку: " . $format . "); \n ";
//		}
//	}
//
//	$calc_note .= "Загальна вартість одиниці: " . $_POST["totalPrice"] . "; \n " .
//	              "Загальна сума: " . $_POST["totalSum"] ;
//
//	if (isset($_POST['product_url'])) {
//		$calc_note .= "\n Посилання на продукт: " . $_POST["product_url"] ;
//	}
//
//	if (isset($_POST['user_notes'])) {
//		$calc_note .= "\n Повідомлення користувача: " . $_POST["user_notes"] ;
//	}
//
//	$formatted_calc_note = $calc_note;
//
//	var_dump($_POST);
//
//     $data = [
//		"title" => $crm_otions['title'], //ACF ADD FIELD
//		"source_id" => $crm_otions['source_id'], //ACF ADD FIELD
//		"manager_comment" => $formatted_calc_note, // коментар до заявки
//		"manager_id" => $crm_otions['manager_id'], //ACF ADD FIELD
//		"pipeline_id" => $crm_otions['pipeline_id'], //ACF ADD FIELD
//		"contact" => [
//			"full_name" => $full_name, // ПІБ покупця
//			"email" => $email, // email покупця
//			"phone" => $phone // номер телефону покупця
//		],
//	];
//
//	 if (isset($_POST['product_name'])) {
//		 $data["products"] = [
//			 [
//			 "name"     => $_POST['product_name'], // назву товару
//			 "sku"      => $_POST['product_sku'], // артикул товару
//			 "quantity" => $_POST['product_quantity'], // кількість проданого товару
//			 "price"    => $_POST['product_price'], // ціна продажу
//			 "picture"  => $_POST['product_url'], // зображення товару
//			 ]
//		 ];
//	 }
//
//	//  "упаковуємо дані"
//	$data_string = json_encode($data);
//
//
//// відправляємо на сервер
//	$ch = curl_init();
//	curl_setopt($ch, CURLOPT_URL, $api_url);
//	curl_setopt($ch, CURLOPT_POST, 1);
//	curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
//	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
//	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//			"Content-type: application/json",
//			"Accept: application/json",
//			"Cache-Control: no-cache",
//			"Pragma: no-cache",
//			'Authorization:  Bearer ' . $api_key)
//	);
//	$result = curl_exec($ch);
//	curl_close($ch);
//
////	return $result;
//
//	// Prepare email content
//
//	$email_subject = "Нова заявка на CRM";
//	$email_body = "Отримано нову заявку:\n\n";
//	foreach ($data as $key => $value) {
//		if (is_array($value)) {
//			$email_body .= strtoupper($key) . ":\n";
//			foreach ($value as $sub_key => $sub_value) {
//				if (is_array($sub_value)) {
//					$email_body .= "  " . ucfirst($sub_key) . ":\n";
//					foreach ($sub_value as $item_key => $item_value) {
//						$email_body .= "    " . ucfirst($item_key) . ": " . $item_value . "\n";
//					}
//				} else {
//					$email_body .= "  " . ucfirst($sub_key) . ": " . $sub_value . "\n";
//				}
//			}
//		} else {
//			$email_body .= ucfirst($key) . ": " . $value . "\n";
//		}
//	}
//
//	// Send email
//	$admin_email = $crm_otions['email_to_send'] ?? get_option('admin_email'); // Change this if needed
//	$headers = ['Content-Type: text/plain; charset=UTF-8'];
//	wp_mail($admin_email, $email_subject, $email_body, $headers);
//
//
//
//	// Return the response to the frontend
//	if ($result === fa
//lse) {
//		echo json_encode($data);
//		echo json_encode(['error' => 'Failed to send to CRM']);
//	} else {
//		echo json_encode($data);
//		echo json_encode($result); // You can return the result from CRM if needed
//	}
//
//	wp_die(); // Always call wp_die() to properly terminate the request
//}

function send_calculations_to_crm() {
	$crm_options = get_field('png_crm_options', 'options');
	$api_url = $crm_options['api_url'] ?? 'https://openapi.keycrm.app/v1/pipelines/cards';
	$api_key = $crm_options['api_key'] ?? 'YjRmYWRmY2Y4YzExYTEyOTg4MzM0MzI3YzI4OWNlODA0ZWMzODVmYg';

	// Validate required fields
	if (!isset($_POST['user_name'])) {
		echo json_encode(['error' => 'Invalid request']);
		wp_die();
	}

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

	$calc_note = "Кількість товару: " . $_POST["product_quantity"] . "; \n " .
	             "Роздрібна ціна: " . $_POST["product_price"] . "; \n " .
	             "Ціна за 1 шт: " . $_POST["product_final_price"] . "; \n " .
	             "Ціна за тираж: " . $_POST["product_sum"] . "; \n " .
	             "Ціна за принт 1 шт: " . $_POST["print_final_price"] . "; \n " .
	             "Сума за принт: " . $_POST["print_sum"] . "; \n " .

	$print_formats = isset($_POST["printFormats"]) ? json_decode(stripslashes($_POST["printFormats"]), true) : [];
	$print_types = isset($_POST["printTypes"]) ? json_decode(stripslashes($_POST["printTypes"]), true) : [];

	if (!empty($print_formats) && !empty($print_types)) {
		foreach ($print_formats as $key => $format) {
			$calc_note .= "(Тип друку: " . $print_types[$key] . " - Формат дурку: " . $format . "); \n ";
		}
	}

	$calc_note .= "Загальна вартість одиниці: " . $_POST["totalPrice"] . "; \n " .
	              "Загальна сума: " . $_POST["totalSum"] ;

	if (isset($_POST['product_url'])) {
		$calc_note .= "\n Посилання на продукт: " . $_POST["product_url"] ;
	}

	if (isset($_POST['user_notes'])) {
		$calc_note .= "\n Повідомлення користувача: " . $_POST["user_notes"] ;
	}

	$page_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'Unknown';
	$calc_note .= "Сторінка форми: " . $page_url . "\n";

	$formatted_calc_note = $calc_note;

	// Create a new card in KeyCRM
	$card_data = [
		"title" => $crm_options['title'],
		"source_id" => $crm_options['source_id'],
		"manager_comment" => $formatted_calc_note,
		"manager_id" => $crm_options['manager_id'],
		"pipeline_id" => $crm_options['pipeline_id'],
		"contact" => [
			"full_name" => $full_name,
			"email" => $email,
			"phone" => $phone
		],
	];

	if (isset($_POST['product_name'])) {
		$card_data["products"] = [
			[
				"name"     => $_POST['product_name'], // назву товару
				"sku"      => $_POST['product_sku'], // артикул товару
				"quantity" => $_POST['product_quantity'], // кількість проданого товару
				"price"    => $_POST["totalPrice"], // ціна продажу
				"picture"  => $_POST['product_url'], // зображення товару
			]
		];
	}

	$card_response = keycrm_api_request($api_url, $card_data, $api_key);
	if (!$card_response || empty($card_response['response']['id'])) {
		echo json_encode(['error' => 'Failed to create CRM card']);
		wp_die();
	}

	$card_id = $card_response['response']['id']; // Retrieve created card ID

	// Handle file uploads
	$uploaded_file_ids = [];

	if (!empty($_FILES['attachments'])) {
		foreach ($_FILES['attachments']['tmp_name'] as $index => $tmp_name) {
			if ($_FILES['attachments']['error'][$index] === UPLOAD_ERR_OK) {

				$file_path = $_FILES['attachments']['tmp_name'][$index];
				$file_name = $_FILES['attachments']['name'][$index];

				// Upload file to KeyCRM storage
				$file_id = upload_file_to_keycrm($file_path, $file_name, $api_key);
				if ($file_id) {
					$uploaded_file_ids[] = $file_id;
				}
			}
		}
	}

	// Attach uploaded files to the created card
	if (!empty($uploaded_file_ids)) {
		echo "UPLOADED";
		foreach ($uploaded_file_ids as $file_id) {
//			$attach_url = "https://openapi.keycrm.app/v1/pipelines/cards/{$card_id}/attachments";
			$attach_url = "https://openapi.keycrm.app/v1/pipelines/cards/{$card_id}/attachment/{$file_id}";

			keycrm_api_request($attach_url, ['file_id' => $file_id], $api_key, 'POST');
		}
	}

	// Prepare email content

	$email_subject = "Нова заявка на CRM";
	$email_body = "Отримано нову заявку:\n\n";
	$email_body .= $calc_note;


	// Send email
	$admin_email = $crm_options['email_to_send'] ?? get_option('admin_email'); // Change this if needed
	$headers = ['Content-Type: text/plain; charset=UTF-8'];
	wp_mail($admin_email, $email_subject, $email_body, $headers);

	echo json_encode(['success' => true, 'message' => 'Data sent successfully']);
	wp_die();
}

/**
 * Uploads a file to KeyCRM storage and returns the file ID.
 */
function upload_file_to_keycrm($file_path, $file_name, $api_key) {
	$upload_url = "https://openapi.keycrm.app/v1/storage/upload";

	$file_data = [
		'file' => new CURLFile($file_path, mime_content_type($file_path), $file_name)
	];
	$response = keycrm_api_request($upload_url, $file_data, $api_key, 'POST', true);
	echo "-----";
	var_dump($response);
	return $response['response']['id'] ?? null;
}

/**
 * Helper function to send requests to KeyCRM API.
 */
function keycrm_api_request($url, $data, $api_key, $method = 'POST', $is_file = false) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

	// Check if sending a file or JSON
	if ($is_file) {
		// Ensure the Authorization header is set correctly
		$headers = [
			"Authorization: Bearer $api_key"
		];
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	} else {
		$json_data = json_encode($data);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			"Content-Type: application/json",
			"Authorization: Bearer $api_key"
		]);
	}

	$result = curl_exec($ch);
	if ($is_file) {
		echo "FILE";
		var_dump($result);
	}
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get HTTP response code
	curl_close($ch);

	sleep(1); // Wait 1 second to avoid rate limit

	return [
		'response' => json_decode($result, true),
		'http_code' => $http_code
	];
}
