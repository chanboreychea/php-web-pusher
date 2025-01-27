<?php

require __DIR__ . '../../vendor/autoload.php';

// // Define path to cacert.pem
// $cacertPath = 'C:/wamp64/bin/php/php8.2.13/extras/ssl/cacert.pem'; // Make sure the path is correct

// // Check if the certificate file exists
// if (!file_exists($cacertPath)) {
//     die("Certificate file not found at {$cacertPath}. Please check the path.");
// }

$options = array(
    'cluster' => 'ap1',
    'useTLS' => true,
    // 'curl_options' => [
    //     CURLOPT_CAINFO => $cacertPath,
    // ],
);

$pusher = new Pusher\Pusher(
    'e5c334e47fb12f7c46ff',
    '4688cd5bfdff76428cf7',
    '1883300',
    $options
);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    // Prepare data
    $data = [
        'email' => $email,
        'message' => $message,
    ];

    try {
        // Trigger event
        $pusher->trigger('my-channel', 'my-event', $data);
    } catch (Exception $e) {
        echo "Error triggering event: " . $e->getMessage();
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

</head>

<body>

    <div class="container mt-5 text-center">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Message <span class="text-danger">*</span></label>
                <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Send</button>
            </div>
        </form>
    </div>

</body>

</html>