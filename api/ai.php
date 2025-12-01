<?php

header("Access-Control-Allow-Origin: *");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$data = json_decode(file_get_contents("php://input"));
$text = $data->text ?? '';

// you need to get your own api key from google ai studio to use AI features
$apiKey = "HERE IS YOUR API KEY FROM GOOGLE AI STUDIO";
$model = "gemma-3-27b-it";

$postData = [
    "contents" => [
        [
            "parts" => [
                ["text" => $text]
            ]
        ]
    ]
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://generativelanguage.googleapis.com/v1beta/models/$model:generateContent");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "X-goog-api-key: $apiKey"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

$response = curl_exec($ch);
curl_close($ch);


$responseData = json_decode($response, true);

$text = $responseData['candidates'][0]['content']['parts'][0]['text'];

echo $text;
