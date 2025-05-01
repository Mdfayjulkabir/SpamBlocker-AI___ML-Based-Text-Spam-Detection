<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];

    // Make an AJAX request to the Flask API
    $url = 'http://127.0.0.1:5000/predict';
    $data = json_encode(array("message" => $message));

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => $data,
        ),
    );

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    echo $response;
}
?>
