<?php

$phone = $_GET['phone'];
$amount = $_GET['amount'];
$url = "http://boom.nsmodz.top/";

$data = [
    'phone' => $phone,
    'amount' => $amount
];

$headers = [
    "Host: boom.nsmodz.top",
    "Connection: keep-alive",
    "Content-Length: 26",
    "Cache-Control: max-age=0",
    "Origin: http://boom.nsmodz.top",
    "Content-Type: application/x-www-form-urlencoded",
    "Upgrade-Insecure-Requests: 1",
    "User-Agent: Mozilla/5.0 (Linux; Android 10; SM-J400F Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.6723.106 Mobile Safari/537.36",
    "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
    "X-Requested-With: mark.via.gp",
    "Referer: http://boom.nsmodz.top/",
    "Accept-Encoding: gzip, deflate",
    "Accept-Language: en-GB,en-US;q=0.9,en;q=0.8"
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>