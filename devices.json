<?php
require "config.php";
header("Content-Type: application/json");

$token   = $_POST["token"] ?? "";
$device  = $_POST["device"] ?? "";
$model   = $_POST["model"] ?? "unknown";
$version = $_POST["android"] ?? "unknown";

if ($token !== MDM_TOKEN || !$device) {
    http_response_code(403);
    exit;
}

$file = __DIR__ . "/devices.json";
$data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

$data[$device] = [
    "model"      => $model,
    "android"    => $version,
    "last_seen"  => time()
];

file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

echo json_encode(["ok" => true]);
