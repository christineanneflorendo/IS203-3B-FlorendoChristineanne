<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'twilio-php-main\src\Twilio\autoload.php';

    $sid = "ACa64c0010f5f5d25024caffd5c7e1ceb2"; // Your Account SID
    $token = "4c2011105bb2b8ad181db0ff013e6025"; // Your Auth Token
    $client = new Twilio\Rest\Client($sid, $token);

    $to = $_POST['to'];
    $message = $_POST['message'];

    try {
        $client->messages->create(
            $to, // Recipient's phone number
            [
                'from' => '+19495317839', // Twilio phone number
                'body' => $message
            ]
        );
        echo json_encode(["status" => "success"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
}
?>
