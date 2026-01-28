<?php
require "config.php";
header("Content-Type: application/json");

$token  = $_POST["token"]  ?? "";
$device = $_POST["device"] ?? "unknown";
$model  = $_POST["model"]  ?? "unknown";
$android= $_POST["android"]?? "unknown";

if ($token !== MDM_TOKEN) {
    http_response_code(403);
    echo json_encode(["error"=>"invalid token"]);
    exit;
}

$devices = [];

if (file_exists(DEVICES_FILE)) {
    $devices = json_decode(file_get_contents(DEVICES_FILE), true);
    if (!is_array($devices)) $devices = [];
}

$devices[$device] = [
    "device"   => $device,
    "model"    => $model,
    "android"  => $android,
    "lastSeen" => time()
];

file_put_contents(
    DEVICES_FILE,
    json_encode($devices, JSON_PRETTY_PRINT)
);

echo json_encode([
    "status" => "ok",
    "device" => $device
]);
