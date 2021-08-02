<?php

// function getUserIP() {
//     $ipaddress = '';
//     if (isset($_SERVER['HTTP_CLIENT_IP']))
//         $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
//     else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
//         $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
//     else if(isset($_SERVER['HTTP_X_FORWARDED']))
//         $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
//     else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
//         $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
//     else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
//         $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
//     else if(isset($_SERVER['HTTP_FORWARDED']))
//         $ipaddress = $_SERVER['HTTP_FORWARDED'];
//     else if(isset($_SERVER['REMOTE_ADDR']))
//         $ipaddress = $_SERVER['REMOTE_ADDR'];
//     else
//         $ipaddress = 'UNKNOWN';
//     return $ipaddress;
// }

// $hostname = getUserIP();

// echo $hostname;
?>

<?php
require '../vendor/autoload.php';
use Ahc\Jwt\JWT;
// use \Firebase\JWT\JWT;

$payload = array(
    'iss'  => 'http://example.org',
    'aud'  => 'http://example.com',
    'trr'  => 'ewewe',
    'nbf'  => '1357000000',

    // 'uid'    => 1,
    // 'aud'    => 'http://site.com',
    // 'scopes' => ['user'],
    // 'iss'    => 'http://api.mysite.com',
);


$jwt = new JWT('secret');
$token = $jwt->encode($payload);
print_r($token);
$decoded = $jwt->decode('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJ1c2VyX2xldmVsIjoiMCIsImZuYW1lIjoidGVzdCIsImxuYW1lIjoidGVzdCIsInRlbCI6IjA5ODc3NTY1NjYiLCJlbWFpbCI6InRlc3RAZ21haWwuY29tIiwiYWRkcmVzcyI6InRlc3N0IiwicmVmX2NvZGUiOiJ0ZXN0IiwicmVmX3JlbWFyayI6InRlc3QiLCJyZW1hcmsiOiJ0ZXN0IiwiZXhwIjoxNTk0OTI4MzgzfQ.nINeIJI--HFtr_ojyCu9LMfCDk1noxp7pFw1YKYYEFA');
print_r($decoded);


// $key = "example_key";
// $token = JWT::encode($payload, $key);
// $decoded = JWT::decode($token, $key, array('HS256'));
// print_r($token);
// print_r($decoded);

// $decoded_array = (array) $decoded;
// JWT::$leeway = 60; 
// $decoded = JWT::decode($jwt, $key, array('HS256'));

?>