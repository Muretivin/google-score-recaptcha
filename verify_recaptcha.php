<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {
    $recaptcha_secret = 'your_secret_key';
    $recaptcha_response = $_POST['recaptcha_response'];

    // Make a POST request to the Google reCAPTCHA API to verify the response
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $recaptcha_secret,
        'response' => $recaptcha_response,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $result = json_decode($response, true);

    // Check if the reCAPTCHA verification was successful
    if ($result['success'] && $result['score'] >= 0.5) {
        echo "Verification successful. You are not a robot.";
        // Proceed with form submission
    } else {
        echo "Verification failed. Please try again.";
        // Handle the failure
    }
} else {
    echo "Invalid request.";
}
?>
