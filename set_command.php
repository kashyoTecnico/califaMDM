<?php
require "config.php";

header("Content-Type: application/json");

$cmd   = $_POST["cmd"]   ?? "";
$token = $_POST["token"] ?? "";

$allowed = [
    "LOCK",
    "UNLOCK",
    "REBOOT",
    "DNS_LOCK",
    "DNS_UNLOCK",
    "WIFI_LOCK",
    "WIFI_UNLOCK",
    "DEV_TEMP_ON",
    "DEV_TEMP_OFF"
];

if ($token !== MDM_TOKEN) {
    http_response_code(403);
    echo json_encode(["error"=>"TOKEN INVALIDO"]);
    exit;
}

if (!in_array($cmd, $allowed)) {
    http_response_code(400);
    echo json_encode(["error"=>"INVALID COMMAND"]);
    exit;
}

file_put_contents(CMD_FILE, json_encode([
    "cmd" => $cmd,
    "ts"  => time()
]));

echo json_encode([
    "status" => "ok",
    "cmd" => $cmd
]);
