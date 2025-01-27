<?php

require __DIR__ . '/vendor/autoload.php';

// Define path to cacert.pem
$cacertPath = 'C:/wamp64/bin/php/php8.2.13/extras/ssl/cacert.pem'; // Make sure the path is correct

// Check if the certificate file exists
if (!file_exists($cacertPath)) {
    die("Certificate file not found at {$cacertPath}. Please check the path.");
}

$options = array(
    'cluster' => 'ap1',
    'useTLS' => true,
    'curl_options' => [
        CURLOPT_CAINFO => $cacertPath,
    ],
);

$pusher = new Pusher\Pusher(
    'e5c334e47fb12f7c46ff',
    '4688cd5bfdff76428cf7',
    '1883300',
    $options
);

$data['message'] = 'hello world';

try {
    // Trigger event
    $pusher->trigger('my-channel', 'my-event', $data);
    echo "Pusher message sent successfully.";
} catch (Exception $e) {
    echo "Error triggering event: " . $e->getMessage();
}
