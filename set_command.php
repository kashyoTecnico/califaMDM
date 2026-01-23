<?php
header("Content-Type: application/json; charset=utf-8");

require "config.php";

$token = $_POST["token"] ?? "";
$cmd   = $_POST["cmd"] ?? "";

$allowed = [
    "DNS_LOCK","DNS_UNLOCK",
    "WIFI_LOCK","WIFI_UNLOCK",
    "FR_LOCK","FR_UNLOCK",
    "UNLOCK","REBOOT",
    "DEV_TEMP_ON","DEV_TEMP_OFF"
];

if ($token !== MDM_TOKEN) {
    http_response_code(403);
    echo json_encode(["error"=>"invalid token"]);
    exit;
}

if (!in_array($cmd, $allowed)) {
    http_response_code(400);
    echo json_encode(["error"=>"invalid command"]);
    exit;
}

file_put_contents(CMD_FILE, json_encode([
    "command"   => $cmd,
    "timestamp" => time()
]));

echo json_encode(["status"=>"ok","cmd"=>$cmd]);
