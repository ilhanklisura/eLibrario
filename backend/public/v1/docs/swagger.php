<?php

require __DIR__ . '/../../../vendor/autoload.php';

if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1') {
    define('BASE_URL', 'http://localhost:8888/TalentTrack/backend/');
} else {
    define('BASE_URL', 'https://softlitebh.com/backend/');
}

error_reporting(0);

$openapi = \OpenApi\Generator::scan(['../../../rest', './'], ['pattern' => '*.php']);

header('Content-Type: application/x-yaml');
echo $openapi->toYaml();
?>
