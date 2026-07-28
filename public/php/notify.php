<?php

require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Payments\NotifyController;

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$rawBody = file_get_contents('php://input');
$headers = function_exists('getallheaders') ? getallheaders() : [];

$result = (new NotifyController())->handle($method, $rawBody, $headers);

http_response_code($result['status']);
echo $result['body'];
