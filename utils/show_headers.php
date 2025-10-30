<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$headers = function_exists('apache_request_headers') ? apache_request_headers() : [];
echo "<pre>";
print_r($headers);
echo "</pre>";