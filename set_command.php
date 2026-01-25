<?php
header("Content-Type: application/json");
require "config.php";

$token = $_POST["token"] ?? "";
$cmd   = $_POST["cmd"] ?? "";

$allowed = [
  "DNS_LOCK","DNS_UNLOCK",
  "WIFI_LOCK","WIFI_UNLOCK",
  "FR_LOCK","FR_UNLOCK",
  "LOCK","UNLOCK",
  "REBOOT",
  "DEV_TEMP_ON","DEV_TEMP_OFF"
];

if ($token !== MDM_TOKEN) {
    echo json_encode(["error"=>"invalid token"]); exit;
}

if (!in_array($cmd, $allowed)) {
    echo json_encode(["error"=>"invalid command"]); exit;
}

$data = [
  "command" => $cmd,
  "timestamp" => time(),
  "status" => "SENT"
];

file_put_contents(CMD_FILE, json_encode($data, JSON_PRETTY_PRINT));

echo json_encode([
  "status"=>"ok",
  "cmd"=>$cmd,
  "message"=>"Comando enviado, esperando ejecución"
]);
