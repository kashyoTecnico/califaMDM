<?php
header("Content-Type: application/json; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");

require "config.php";

$token  = $_POST["token"]  ?? "";
$cmd    = $_POST["cmd"]    ?? "";
$device = $_POST["device"] ?? "broadcast";

$allowed = [
    "LOCK","UNLOCK","REBOOT",
    "WIFI_LOCK","WIFI_UNLOCK",
    "DNS_LOCK","DNS_UNLOCK",
    "FR_LOCK","FR_UNLOCK",
    "DEV_TEMP_ON","DEV_TEMP_OFF"
];

if ($token !== MDM_TOKEN) {
    http_response_code(403);
    echo json_encode([
        "status" => "error",
        "error"  => "invalid token"
    ]);
    exit;
}

if (!in_array($cmd, $allowed, true)) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "error"  => "invalid command"
    ]);
    exit;
}

$data = [
    "command"   => $cmd,
    "timestamp" => time(),
    "device"    => $device
];

file_put_contents(CMD_FILE, json_encode($data, JSON_PRETTY_PRINT));

echo json_encode([
    "status"  => "ok",
    "cmd"     => $cmd,
    "ts"      => $data["timestamp"],
    "message" => "Comando enviado"
]);
