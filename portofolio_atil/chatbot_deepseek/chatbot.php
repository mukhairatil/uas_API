<?php
// Chatbot backend handler using DeepSeek via OpenRouter

header('Content-Type: application/json');

// Ambil input JSON
$input = json_decode(file_get_contents('php://input'), true);
$userMessage = $input['message'] ?? '';

$apiKey = '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';
$url = $url = 'https://openrouter.ai/api/v1/chat/completions';


$headers = [
    "Authorization: Bearer $apiKey",
    "Content-Type: application/json",
    "HTTP-Referer: http://localhost/tes/",
    "X-Title: DeepSeekChatbot"
];

$payload = [
    "model" => "google/gemma-3n-e4b-it:free",
    "messages" => [
        ["role" => "user", "content" => $userMessage]
    ]
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
$reply = $data['choices'][0]['message']['content'] ?? 'Maaf, tidak dapat merespon.';

echo json_encode(["reply" => $reply]);
