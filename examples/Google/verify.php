<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$log = new Monolog\Logger('google-test');
$log->pushHandler(new Monolog\Handler\StreamHandler(__DIR__ . '/../../app.log', Monolog\Logger::INFO));
$log->info('Verifying Google Signin');

// Get $id_token via HTTPS POST.
// $rawJsonString = file_get_contents("php://input");
// $log->info($rawJsonString);

// //var_dump($rawJsonString);

// // Make it a associative array (true, second param)
// $jsonData = json_decode($rawJsonString, true);

$log->info($_POST['token']);

$client = new Google_Client(['client_id' => '140476648150-nc93kk88m8rhn636h0osgu1nfh0v3600.apps.googleusercontent.com']);  // Specify the CLIENT_ID of the app that accesses the backend
$payload = $client->verifyIdToken($_POST['token']);
if ($payload) {
  $userid = $payload['sub'];
  $log->info("valid token with user of".$userid);
  // If request specified a G Suite domain:
  //$domain = $payload['hd'];
} else {
  // Invalid ID token
  $log->info("invalid token");
}
?>